<?php

namespace AVD\Http\Controllers\Auth;

use AVD\Events\UserRegisteredEvent;
use AVD\Http\Controllers\Controller;
use AVD\Events\UserRegisteredNoteEvent;
use AVD\Events\UserRegisterConfirmedEvent;
use AVD\Http\Requests\Web\RegisterRequest;
use AVD\Events\UserRegisteredNewsletterEvent;
use AVD\Interfaces\Web\UserInterface as InterModel;
use AVD\Interfaces\Web\StateInterface as InterState;
use AVD\Interfaces\Web\SectionInterface as InterSection;
use AVD\Interfaces\Web\UserAddressInterface as InterAddress;
use AVD\Interfaces\Web\ConfigKeywordInterface as ConfigKeyword;
use AVD\Interfaces\Web\AccountTypeInterface as InterAccountType;
use AVD\Interfaces\Web\UserTransportInterface as InterTransport;
use AVD\Interfaces\Web\ConfigProfileClientInterface as InterProfile;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\RegistersUsers;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/login';
    private $content;
    private $view = 'frontend.auth';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        InterModel $interModel,
        InterState $interState,
        InterAddress $interAddress,
        InterSection $interSection,
        InterProfile $interProfile,
        ConfigKeyword $configKeyword,
        InterTransport $interTransport,
        InterAccountType $interAccountType)
    {
        $this->middleware('guest');

        $this->interModel = $interModel;
        $this->interState = $interState;
        $this->interAddress = $interAddress;
        $this->interSection = $interSection;
        $this->interProfile = $interProfile;
        $this->configKeyword = $configKeyword;
        $this->interTransport = $interTransport;
        $this->interAccountType = $interAccountType;

        $this->content = array(
            'title' => 'Cadastro',
            'title_detail_user' => 'Perfil do Cliente',
            'title_detail_address' => 'Endereço de Entrega',
            'title_btn_send' => 'Enviar Cadastro',
            'title_indicate_transport' => 'Quer indicar uma transportadora?',
            'label_name_transport' => 'Nome da transportadora?',
            'label_phone_transport' => 'Telefone da transportadora?',
            'label_newsletter' => constLang('messages.newsletter.label_newsletter')." ".config('company.name'),
        );


    }


    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        $menu            = $this->interSection->getMenu();
        $types           = $this->interAccountType->getAll();
        $content         = typeJson($this->content);
        $profiles        = $this->interProfile->getAll();
        $configKeyword   = $this->configKeyword->random();


        # Json countries
        $brasil = $this->interState->getAll();
        $states = collect($brasil)->all();
        $json_locale    = $this->getLocale();
        $json_countries = $this->getCountries($states);


        return view("{$this->view}.register-1", compact(
            'menu', 'types','states', 'content','adresses','profiles',
            'json_locale','configKeyword','json_countries','method_selected'));
    }


    /**
     * @param RegisterRequest $request
     * @return Json
     */
    protected function register(RegisterRequest $request)
    {
        try{
            DB::beginTransaction();

            $dataForm = $request->all();


            if (isset($dataForm['newsletter'])) {
                $dataForm['register']['newsletter'] = 1;
            }

            $user = $this->interModel->create($dataForm['register']);

            $dataForm['address']['user_id'] = $user->id;
            $address = $this->interAddress->create($dataForm['address']);

            if (isset($dataForm['transport']['indicate']) && $dataForm['transport']['indicate'] == 1) {
                $dataForm['transport']['user_id'] = $user->id;
                $indicate = $this->interTransport->create($dataForm['transport']);
            }

            event(new UserRegisteredEvent($user));
            $note = [
                'user_id' => $user->id,
                'admin' => constLang('profile_name.user'),
                'label' => constLang('messages.register.note_register'),
                'description' => ipLocation()
            ];

            event(new UserRegisteredNoteEvent($note));

            DB::commit();

            $email   = $user->email;
            $message = view("$this->view.render.register-success-1", compact('email','message'))->render();
            $out = array(
                'result' => 'success',
                'success' => $message
            );

            return response()->json($out);

        } catch(\Exception $e){
            DB::rollback();
            //return $e->getMessage();
            $message = view("$this->view.render.register-error-1")->render();

            $out = array(
                'result' => 'failure',
                'message' => $message
            );

            return response()->json($out);
        }

    }


    protected function verifyToken($email, $token)
    {
        if (empty($token)) {
            return redirect()->route('login');
        }
        $user = $this->interModel->setEmail($email);

        if ($user) {

            if ($user->token == $token) {

                $ip = $_SERVER['REMOTE_ADDR'];
                $visits = $user->visits + 1;
                $update = $user->update([
                    'active' => constLang('active_true'),
                    'last_login' => date('Y-m-d H:i:s'),
                    'visits' => $visits,
                    'token' => NULL,
                    'ip' => $ip
                ]);
                if ($update) {

                    event(new UserRegisterConfirmedEvent($user));

                    $note = [
                        'user_id' => $user->id,
                        'admin' => constLang('profile_name.user'),
                        'label' => constLang('messages.register.note_confirmed'),
                        'description' => ipLocation()
                    ];

                    event(new UserRegisteredNoteEvent($note));

                    event(new UserRegisteredNewsletterEvent($user));

                    Auth::loginUsingId($user->id, true);
                    return redirect(route('account'));

                } else {

                    session()->flash('error', constLang('error_server1'));

                    return redirect(route('login'));
                }
            } elseif (empty($user->token) && $user->active == constLang('active_true')) {

                return redirect(route('login'))->with('success', constLang('active_token_null'));

            } elseif (empty($user->token) && $user->active == constLang('active_false')) {

                return redirect(route('contact'))->with('error', constLang('account_inactive'));
            }

        }


        return redirect(route('login'))->with('error', constLang('no_account'));
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
