<?php

namespace AVD\Http\Controllers\Web;

use AVD\Events\SendContactEvent;
use AVD\Http\Controllers\Controller;

use AVD\Http\Requests\Web\ContactRequest;
use AVD\Interfaces\Web\UserInterface as InterUser;
use AVD\Interfaces\Web\StateInterface as InterState;
use AVD\Interfaces\Web\ContactInterface as InterModel;
use AVD\Interfaces\Web\SectionInterface as InterSection;
use AVD\Interfaces\Web\ConfigKeywordInterface as ConfigKeyword;
use AVD\Interfaces\Web\AccountTypeInterface as InterAccountType;
use AVD\Interfaces\Web\ConfigSubjectContactInterface as ConfigSubject;
use AVD\Interfaces\Web\ConfigProfileClientInterface as InterProfile;

use Illuminate\Support\Facades\Auth;


class ContactController extends Controller
{
    private $content;
    private $view = 'frontend.contacts';
    /**
     * @var ConfigSubject
     */

    public function __construct(
        InterUser $interUser,
        InterModel $interModel,
        InterState $interState,
        InterSection $interSection,
        InterProfile $interProfile,
        ConfigSubject $configSubject,
        ConfigKeyword $configKeyword,
        InterAccountType $interAccountType)
    {

        $this->interUser         = $interUser;
        $this->interModel        = $interModel;
        $this->interState        = $interState;
        $this->interSection      = $interSection;
        $this->interProfile      = $interProfile;
        $this->configKeyword     = $configKeyword;
        $this->configSubject     = $configSubject;
        $this->interAccountType  = $interAccountType;

        $this->content = array(
            'btn_send' => constLang('messages.contact.btn_send'),
            'contact_url' => route('contact'),
            'is_contact' => '1',
            'title' => constLang('messages.contact.title'),
            'sub_title' => constLang('messages.contact.sub_title'),
            'placeholder_subject' => constLang('messages.contact.placeholder_subject'),
            'debug_mode' => '',
            'error_json' => constLang('messages.contact.error_json'),
            'i18n_contact_error' => constLang('messages.contact.send_error')
        );
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu          = $this->interSection->getMenu();
        $types         = $this->interAccountType->getAll();
        $content       = typeJson($this->content);
        $profiles      = $this->interProfile->getAll();
        $configKeyword = $this->configKeyword->random();
        $configSubject = $this->configSubject->getAll();

        # Json countries
        $brasil = $this->interState->getAll();
        $states = collect($brasil)->all();
        $json_locale    = $this->getLocale();
        $json_countries = $this->getCountries($states);

        return view("{$this->view}.contact-1", compact(
            'menu','types','states','content','profiles','json_locale','json_countries',
            'configKeyword','configSubject')
        );
    }


    public function store(ContactRequest $request)
    {
        $input   = $request->contact;
        $name    = $input['name'];
        $email   = $input['email'];
        $message = null;
        $subject = $this->configSubject->setId($input['subject_id']);

        $exist = $this->interUser->setEmail($email);
        if ($exist) {
            $input['type']    = $exist->type_id;
            $input['client']  = 1;
            $input['user_id'] = $exist->id;
            if ($subject->send_user == 1) {
                $message = $subject->message;
            }
        } else {
            if ($subject->send_guest == 1) {
                $message = $subject->message;
            }
        }

        $input['subject'] = $subject->label;

        $locale = ipLocation('json');

        if ($locale) {

            isset($locale->postal) ? $zip_code = $locale->postal : $zip_code = "";

            $input['ip']        = $locale->ip;
            $input['city']      = $locale->city;
            $input['state']     = $locale->region;
            $input['country']   = $locale->country_name;
            $input['zip_code']  = $zip_code;
            $input['latitude']  = $locale->latitude;
            $input['longitude'] = $locale->longitude;

        } else {
            $input['ip'] = $_SERVER['REMOTE_ADDR'];
        }

        $create = $this->interModel->create($input);

        if ($create) {
            if ($message) {
                event(new SendContactEvent($email, $name, $subject->label, $message));
            }

            $success = view("$this->view.render.success-1", compact('name'))->render();
            $out = array(
                'result' => 'success',
                'success' => $success
            );

        } else {
            $message = constLang('messages.contact.send_error');
            $error = view("$this->view.render.error-1", compact('message'))->render();

            $out = array(
                'result' => 'failure',
                'message' => $error
            );
        }


        return response()->json($out);
    }



    /**
     * Retorna os Estados
     *
     * @param $states
     * @return array
     */
    public function getCountries($states)
    {
        foreach ($states as $state) {
            $arr[$state->uf] = $state->name;
        }

        $countrie = array('BR' => $arr);

        $countries = array(
            "countries" => json_encode( $countrie ),
            "i18n_select_state_text" => constLang('select_state'),
            "i18n_no_matches" => constLang('not_found'),
            "i18n_ajax_error" => constLang('loading_failed'),
            "i18n_input_too_short_1" => constLang('please_enter').' 1 '. constLang('validation.caracteres.required'),
            "i18n_input_too_short_n" => constLang('please_enter')." %qty% ".constLang('validation.caracteres.required'),
            "i18n_input_too_long_1" => constLang('please_delete').' 1 '. constLang('validation.caracteres.1'),
            "i18n_input_too_long_n" => constLang('please_delete')." %qty% ".constLang('validation.caracteres.2'),
            "i18n_selection_too_long_1" => constLang('validation.selects.select1').' 1 '. constLang('item'),
            "i18n_selection_too_long_n" => constLang('validation.selects.select1')." %qty% ". constLang('items'),
            "i18n_load_more" => constLang('loading_more')."...",
            "i18n_searching" => constLang('searching')."...",
        );
        return $countries;
    }

    /**
     * Retorna as validações do CEP dos estados
     *
     * @return array
     */
    public function getLocale()
    {
        $arr1 = array(
            "postcode" => array(
                "label" => constLang('zip_code'),
                "required" => false,
                "hidden" => false
            ),
            "state" => array(
                "label" => constLang('state'),
                "required" => false,
                "hidden" => false
            ),
            "city" => array(
                "label" => constLang('city'),
                "required" => false,
                "hidden" => false
            )

        );

        $default = array(
            "first_name" => array(
                "label" => constLang('person_physical.first_name'),
                "required" => false,
                "class" => ["form-row-first"],
                "autocomplete" => "given-name",
                "priority" => 10

            ),
            "last_name" => array(
                "label" => constLang('person_physical.last_name'),
                "required" => false,
                "class" => ["form-row-last"],
                "autocomplete" => "family-name",
                "priority" => 20
            ),
            "company" => array(
                "label" => constLang('person_legal.first_name'),
                "class" => ["form-row-wide"],
                "autocomplete" => "organization",
                "priority" => 30,
                "required" => false
            ),
            "country" => array(
                "type" => "country",
                "label" =>  constLang('city'),
                "required" => false,
                "class" => ["form-row-wide","address-field","update_totals_on_change"],
                "autocomplete" => "country",
                "priority" => 40
            ),

            "address_1" => array(
                "label" => constLang('address'),
                "placeholder" => constLang('address'),
                "required" => false,
                "class" => ["form-row-wide", "address-field"],
                "autocomplete" => "address-line1",
                "priority" => 50

            ),
            "address_2" => array(
                "label" => constLang('cmplement'),
                "label_class" => ["screen-reader-text"],
                "placeholder" => constLang('cmplement'),
                "class" => ["form-row-wide","address-field"],
                "autocomplete" => "address-line2",
                "priority" => 60,
                "required" => false
            ),
            "city" => array(
                "label" => constLang('city'),
                "required" => false,
                "class" => ["form-row-wide","address-field"],
                "autocomplete" => "address-level2",
                "priority" => 70
            ),
            "state" => array(
                "type" => "state",
                "label" => constLang('state'),
                "required" => false,
                "class" => ["form-row-wide","address-field"],
                "validate" => ["state"],
                "autocomplete" => "address-level1",
                "priority" => 80
            ),
            "postcode" => array(
                "label" => constLang('zip_code'),
                "required" => false,
                "class" => ["form-row-wide","address-field"],
                "validate"=> ["postcode"],
                "autocomplete" => "postal-code",
                "priority" => 90
            )
        );

        $countrie = array('BR' => $arr1, "default" => $default);
        $locale_fields = array(
            "address_1" => "#billing_address_1_field,#shipping_address_1_field",
            "address_2" => "#billing_address_2_field,#shipping_address_2_field",
            "state" => "#billing_state_field,#shipping_state_field,#calc_shipping_state_field",
            "postcode" => "#billing_postcode_field,#shipping_postcode_field,#calc_shipping_postcode_field",
            "city" => "#billing_city_field,#shipping_city_field,#calc_shipping_city_field"
        );

        $locale = array(
            "locale" => json_encode( $countrie ),
            "locale_fields" => json_encode( $locale_fields ),
            "i18n_required_text" => "required",
            "i18n_optional_text" => "optional"
        );

        return $locale;
    }

}
