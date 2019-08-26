<?php

namespace AVD\Http\Controllers\Web;

use AVD\Http\Controllers\Controller;
use AVD\Http\Requests\Web\AddressRequest;
use AVD\Http\Requests\Web\ProfileRequest;
use AVD\Interfaces\Web\UserInterface as InterModel;
use AVD\Interfaces\Web\OrderInterface as InterOrder;
use AVD\Interfaces\Web\StateInterface as InterState;
use AVD\Interfaces\Web\SectionInterface as InterSection;
use AVD\Interfaces\Web\ConfigSiteInterface as ConfigSite;
use AVD\Interfaces\Web\AccountTypeInterface as AccountType;
use AVD\Interfaces\Web\UserAddressInterface as InterAddress;
use AVD\Interfaces\Web\ConfigColorPositionInterface as ConfigImages;
use AVD\Interfaces\Web\UserTransportInterface as InterUserTransport;
use AVD\Interfaces\Web\ConfigProfileClientInterface as InterProfile;

use AVD\Interfaces\Web\ConfigProductInterface as ConfigProduct;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    private $view = 'frontend.accounts';
    private $content;



    public function __construct(
        InterModel $interModel,
        InterOrder $interOrder,
        InterState $interState,
        ConfigSite $configSite,
        AccountType $accountType,
        InterSection $interSection,
        ConfigImages $configImages,
        InterAddress $interAddress,
        InterProfile $interProfile,
        ConfigProduct $configProduct,
        InterUserTransport $interUserTransport)
    {
       $this->middleware('auth');

        $this->interModel    = $interModel;
        $this->interOrder    = $interOrder;
        $this->interState    = $interState;
        $this->configSite    = $configSite->setId(1);
        $this->phatFiles     = env('APP_PANEL_URL');
        $this->accountType   = $accountType;
        $this->interSection  = $interSection;
        $this->interAddress  = $interAddress;
        $this->interProfile  = $interProfile;
        $this->configImages  = $configImages->setName('default', 'T');
        $this->configProduct = $configProduct->setId(1);
        $this->interUserTransport = $interUserTransport;

        $this->content = array(
            'title' => 'Minha Conta',
            'profile' => array(
                'title' => 'Meu Perfil',
                'btn_submit' => 'Alterar Perfil',
                'update_password' => 'Alterar Senha',
                'text_change_password' => '(deixe em branco para manter a mesma senha)',
            ),
            'address' => array(
                'title' => 'Endereço de Entrega',
                'label_name_transport' => 'Nome da Transportadora',
                'label_phone_transport' => 'Telefone da Transportadora',
                'btn_submit' => 'Alterar Endereço',
                'text_indicate' => 'Quero indicar uma transportadora',
                'text_details' => 'O seguinte endereço será usado ​​na entrega do pedido.'
            ),
            'orders' => array(
                'title' => 'Meus Pedidos',
                'title_note' => 'Observações',
                'grid' => 'Grade',
                'order' => 'Pedido',
                'value' => 'Valor',
                'color' => 'Cor',
                'product' => 'Produto',
                'date' => 'Data',
                'status' => 'Status',
                'subtotal' => 'Subtotal',
                'total' => 'Total',
                'actions' => 'Ações',
                'freight' => 'Frete',
                'method_payment' => 'Método de Pagamento',
                'text_created' => 'foi feito',
                'text_status' => 'e o status é',
                'text_details' => 'Detalhes do Pedido',
                'text_indicate' => 'Transporte Indicado',
                'text_empty_order' => 'Você ainda não fez nenhum pedido.'
            ),
            'dashboard' => array(
                'hello' => 'Olá',
                'salutation' => 'bem-vindo ao seu seu painel.',
                'text_salutation' => '',
                'text' => 'No painel da sua conta, você pode acompanhar seus pedidos, alterar endereço de entrega e sua senha.',
            ),
            'sidebar' => array(
                'title' => 'Minha Conta',
                'dashboard' => 'Painel',
                'orders' => 'Meus Pedidos',
                'downloads' => 'Downloads',
                'address' => 'Endereço de Entrega',
                'profile' => 'Detalhes da conta',
                'wishlist' => 'Lista de Desejo',
                'logout' => 'Sair da Conta',
            ),
            'newsletter' => array(
                'text' => 'Quero receber informações e promoções da '.config('company.name')
            ),
            'messages' => array(
                'change_true' => 'O dados foram alterados com sucesso!',
                'change_error' => 'Não foi possível alterar os dados, tente mais tarde.',
                'error_password_current' => 'A senha atual não é valída.'
            )
        );

    }

    public function index()
    {
        $user    = $this->interModel->setId(Auth::id());
        $menu    = $this->interSection->getMenu();
        $content = typeJson($this->content);
        $sidebar = 'dashboard';

        $user->type_id == 1 ? $name = $user->last_name : $name = $user->first_name;

        $content->dashboard->text_salutation = "{$content->dashboard->hello} {$name}, {$content->dashboard->salutation}";

        return view("{$this->view}.dashboard-1", compact(
            'user','menu','sidebar', 'content')
        );
    }

    public function order()
    {
        $user    = $this->interModel->setId(Auth::id());
        $menu    = $this->interSection->getMenu();
        $orders  = $this->interOrder->getAll($user);
        $content = typeJson($this->content);
        $sidebar = 'orders';

        return view("{$this->view}.order-1", compact(
            'menu','sidebar', 'orders', 'content'
        ));
    }

    public function orderView($reference)
    {
        $user      = $this->interModel->setId(Auth::id());
        $menu      = $this->interSection->getMenu();
        $order     = $this->interOrder->setOrder($user, $reference);
        $notes     = collect($order->notes);
        $items     = collect($order->items);
        $address   = $user->adresses()->orderBy('id', 'desc')->first();
        $content   = typeJson($this->content);
        $sidebar   = 'orders';
        $shippings = collect($order->shippings);

        $user->type_id == 1 ? $name = $user->last_name : $name = $user->first_name;

        return view("{$this->view}.order-1-view", compact(
            'menu','user', 'name', 'notes', 'order', 'items', 'sidebar', 'content', 'address','shippings'
        ));

    }

    public function address()
    {
        $user      = $this->interModel->setId(Auth::id());
        $menu      = $this->interSection->getMenu();
        $sidebar   = 'address';
        $content   = typeJson($this->content);
        $address   = $user->adresses()->orderBy('id', 'desc')->first();
        $transport = $user->transport()->orderBy('id', 'desc')->first();

        # Json countries
        $brasil = $this->interState->getAll();
        $states = collect($brasil)->all();
        $json_locale    = $this->getLocale();
        $json_countries = $this->getCountries($states);

        return view("{$this->view}.address-1", compact(
            'menu', 'user', 'states','sidebar','content', 'address',
            'transport', 'json_locale', 'json_countries'
        ));

    }

    public function addressUpdate(AddressRequest $request)
    {
        $dataForm  = $request->all();
        $user      = $this->interModel->setId(Auth::id());
        $update    = true;
        $content   = typeJson($this->content);
        $address   = $user->adresses()->orderBy('id', 'desc')->first();
        $current = array(
            "address" => $address->address,
            "number" => $address->number,
            "complement" => $address->complement,
            "district" => $address->district,
            "city" => $address->city,
            "state" => $address->state,
            "zip_code" => $address->zip_code
        );
        $input = $dataForm['address'];

        if($current != $input) {
            $page    = 'account';
            $update  = $this->interAddress->update($input, $page);
        }

        $transport = $dataForm['transport'];
        if (isset($transport['indicate'])) {
            $update = $this->interUserTransport->update($transport, $user);
        } else {
            $transport = $user->transport()->orderBy('id', 'desc')->first();
            if ($transport) {
                $update = $this->interUserTransport->delete($user);
            }
        }

        if ($update) {

            $message = $content->messages->change_true;
            $html  = view("{$this->view}.messages.success-1", compact('message'))->render();
            $out = array('result' => 'success','success' => $html);

        } else {
            $message = $content->messages->change_error;
            $html  = view("{$this->view}.messages.error-1", compact('message'))->render();
            $out = array('result' => 'error','message' => $html);
        }

        return response()->json($out);
    }

    public function profile()
    {
        $user      = $this->interModel->setId(Auth::id());
        $menu      = $this->interSection->getMenu();
        $types     = $this->accountType->getAll();
        $sidebar   = 'profile';
        $content   = typeJson($this->content);
        $profiles  = $this->interProfile->getAll();

        return view("{$this->view}.profile-1", compact(
            'user', 'menu','types', 'sidebar', 'content', 'profiles'
        ));

    }

    public function profileUpdate(ProfileRequest $request)
    {
        $input     = $request->register;
        $content   = typeJson($this->content);

        if (!empty($input['password_current'])) {
            if (Hash::check($input['password_current'], Auth::user()->password)) {
                $update = $this->interModel->update($input);
            } else {
                $message = $content->messages->error_password_current;
                $html  = view("{$this->view}.messages.error-1", compact('message'))->render();
                $out = array('result' => 'error','message' => $html);
                return response()->json($out);
            }
        } else {
            $update = $this->interModel->update($input);
        }


        if ($update) {

            $message = $content->messages->change_true;
            $html  = view("{$this->view}.messages.success-1", compact('message'))->render();
            $out = array('result' => 'success','success' => $html);

        } else {
            $message = $content->messages->change_error;
            $html  = view("{$this->view}.messages.error-1", compact('message'))->render();
            $out = array('result' => 'error','message' => $html);
        }

        return response()->json($out);

    }


    /**
     * FALTA FAZER
     */
    public function wishlist()
    {
        $menu     = $this->interSection->getMenu();
        $sidebar  = 'wishlist';

        $id = 3;

        $product = array(
            "category" => "categoria",
            "section" => "secao",
            "slug" => "produto-1002"
        );

        return view("{$this->view}.wishlist-1", compact(
            'menu',
            'sidebar',
            'product',
            'id'
        ));
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
