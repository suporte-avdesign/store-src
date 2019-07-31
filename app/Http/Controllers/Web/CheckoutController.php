<?php

namespace AVD\Http\Controllers\Web;

use AVD\Events\UserRegisteredNoteEvent;
use AVD\Events\UserRegisterConfirmedEvent;
use AVD\Events\UserRegisteredCheckoutEvent;

use AVD\Http\Controllers\Controller;
use AVD\Interfaces\Web\CartInterface as InterCart;
use AVD\Interfaces\Web\UserInterface as InterUser;
use AVD\Interfaces\Web\StateInterface as InterState;
use AVD\Interfaces\Web\SectionInterface as InterSection;
use AVD\Interfaces\Web\ConfigSiteInterface as ConfigSite;
use AVD\Interfaces\Web\UserAddressInterface as InterAddress;
use AVD\Http\Requests\Web\CheckoutRequest as ValidateCheckout;
use AVD\Interfaces\Web\ConfigKeywordInterface as ConfigKeyword;
use AVD\Interfaces\Web\AccountTypeInterface as InterAccountType;
use AVD\Interfaces\Web\ConfigShippingInterface as ConfigShipping;
use AVD\Interfaces\Web\ConfigProfileClientInterface as InterProfile;
use AVD\Interfaces\Web\ConfigFormPaymentInterface as ConfigFormPayment;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\AuthenticatesUsers;


class CheckoutController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = 'login';

    private $view = 'frontend.checkouts';

    /**
     * CheckoutController constructor.
     * @param InterCart $interCart
     * @param InterSection $interSection
     */
    public function __construct(
        InterCart $interCart,
        InterUser $interUser,
        InterState $interState,
        ConfigSite $configSite,
        InterAddress $interAddress,
        InterSection $interSection,
        InterProfile $interProfile,
        ConfigKeyword $configKeyword,
        ConfigShipping $configShipping,
        InterAccountType $interAccountType,
        ConfigFormPayment $configFormPayment)
    {

        $this->interCart = $interCart;
        $this->interUser = $interUser;
        $this->interState = $interState;
        $this->configSite = $configSite;
        $this->interAddress = $interAddress;
        $this->interSection = $interSection;
        $this->interProfile = $interProfile;
        $this->configKeyword = $configKeyword;
        $this->configShipping = $configShipping;
        $this->interAccountType  = $interAccountType;
        $this->configFormPayment  = $configFormPayment;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $menu           = $this->interSection->getMenu();
        $types          = $this->interAccountType->getAll();
        $profiles       = $this->interProfile->getAll();
        $configKeyword  = $this->configKeyword->random();
        $configShipping = $this->configShipping->getAll();
        $configPayment  = $this->configFormPayment->getAll();

        # Json countries
        $brasil = $this->interState->getAll();
        $states = collect($brasil)->all();
        $json_locale    = $this->getLocale();
        $json_countries = $this->getCountries($states);


        if (Auth::user()) {
            $user_id = Auth::id();
            $user    = $this->interUser->setId($user_id);
            $adresses = $user->adresses()->orderBy('id','desc')->first();
        } else {
            $user = null;
            $user_id = 0;
            $adresses = null;
        }
        $session = md5($_SERVER['REMOTE_ADDR']);


        $configSite = $this->configSite->setId(1);
        if ($user_id != 0 && $configSite->order == 'wishlist'){
            dd('Cart = Lista de desejo');
        } else {
            $cart = $this->interCart->getAll($session);

        }

        $total = $this->interCart->getTotal($cart);
        # Identificar qual método de pagamento e envio
        $payment_selected = 3;
        $method_selected = 1;

        return view("{$this->view}.checkout-1", compact(
            'user', 'menu', 'cart', 'total', 'types',
            'states', 'adresses', 'profiles', 'json_locale',
            'configPayment', 'configKeyword', 'configShipping',
            'json_countries', 'method_selected', 'payment_selected')
        );
    }


    public function getCountries($states)
    {
        foreach ($states as $state) {
            $arr[$state->uf] = $state->name;
        }
        $countries = array(
            "countries" => array(
                "BR" => $arr
             ),
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
        return json_encode($countries);
    }


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

        $locale = array(
            "locale" => array(
                'BR' => $arr1,
                "default" => $default
            ),
            "locale_fields" => array(
                "address_1" => "#billing_address_1_field,#shipping_address_1_field",
                "address_2" => "#billing_address_2_field,#shipping_address_2_field",
                "state" => "#billing_state_field,#shipping_state_field,#calc_shipping_state_field",
                "postcode" => "#billing_postcode_field,#shipping_postcode_field,#calc_shipping_postcode_field",
                "city" => "#billing_city_field,#shipping_city_field,#calc_shipping_city_field"
            ),
            "i18n_required_text" => "required",
            "i18n_optional_text" => "optional"
        );

        return json_encode($locale);
    }

    public function method(Request $request)
    {
        $selected = $request['shipping_method'][0];
        if ($selected) {

            $states = $this->interState->getAll();
            $configShipping = $this->interModel->getAll();

            $configSite = $this->configSite->setId(1);
            (Auth::user() ? $user_id = Auth::id() : $user_id = 0);
            $session = md5($_SERVER['REMOTE_ADDR']);


            if ($user_id != 0 && $configSite->order == 'wishlist') {
                dd('Cart = Lista de desejo');
            } else {
                $cart = $this->interCart->getAll($session);
            }

            $values = $this->interCart->getTotal($cart);
            $methods = $this->interModel->getAll();
            foreach ($methods as $method) {
                if ($method->id == $selected) {
                    $tax = $method->tax_unique;
                }
            }

            $total['quantity'] = $values['quantity'];
            $total['price_cash'] = $values['price_cash'];
            $total['price_card'] = $values['price_card'];

            return view("{$this->view}.method-1", compact(
                    'configShipping',
                    'selected',
                    'states',
                    'total',
                    'cart',
                    'tax')
            );
        }


    }



    /**
     * Atualizar Valores do frete
     */
    public function review(Request $request)
    {
        (Auth::user() ? $user_id = Auth::id() : $user_id = 0);
        $session = md5($_SERVER['REMOTE_ADDR']);
        $configSite = $this->configSite->setId(1);
        if ($user_id != 0 && $configSite->order == 'wishlist'){
            dd('Cart = Lista de desejo');
        } else {
            $cart = $this->interCart->getAll($session);

            dd($cart);
        }

        $configPayment  = $this->configFormPayment->getAll();
        $configShipping = $this->configShipping->getAll();

        $shipping_method = $request->input('shipping_method');
        $method_selected = $shipping_method[0];
        $payment_selected = $request->input('payment_method').


        $order_method = view("{$this->view}.includes.method-1", compact(
            'cart',
            'total',
            'method_selected',
            'configShipping'))->render();

        $payment = view("{$this->view}.includes.payment-1", compact(
            'configPayment',
            'payment_selected'))->render();

        $out = array(
            "result" => "success",
            "messages" => "",
            "reload" => "false",
            "fragments" => array(
                ".woocommerce-checkout-review-order-table" => $order_method,
                ".woocommerce-checkout-payment" => $payment
            )
        );

        return response()->json($out);

    }



    public function login(Request $request)
    {

        $messages = [
            'page.password.required' => constLang('validation.password.required'),
            'page.email.required' => constLang('validation.email.required'),
            'page.email.email' => constLang('validation.email.email'),
            'page.email.exists' => constLang('messages.register.no_account')
        ];

        $validator = Validator::make($request->all(), [
            'page.password' => 'required',
            'page.email' => 'required|email|exists:users,email,active,'.constLang('active_true')
        ],$messages);


        if ($validator->fails()) {
            return redirect('checkout')
                ->withErrors($validator)
                ->withInput();
        }

        $dataForm = $request['page'];
        $email    = $dataForm['email'];
        $password = $dataForm['password'];
        $remember = (isset($dataForm['remember']) ? true : false);

        $exist = $this->interUser->setEmail($email);
        if ($exist) {
            if ($exist->active == constLang('active_true')) {
                if (Auth::attempt(['email' => $email, 'password' => $password ], $remember)) {
                    if(Auth::check()) {
                        $visits = $exist->visits + 1;
                        $ip = $_SERVER['REMOTE_ADDR'];
                        $access = [
                            "visits" => $visits,
                            "last_login	" => date('Y-m-d H:i:s'),
                            "ip" => $ip
                        ];
                        $update = $this->interUser->update($access, $exist->id);
                        if ($update)
                            return $this->index();
                    }
                }
            } else {
                $message = 'Nome de usuário ou senha inválido. <a href="'.route('password.request').'">Esqueceu a senha?</a>';
                $validator->errors()->add('inactive', $message);
            }

        } else {
            $message = 'login';
        }


    }

    /**
     * Obrigatório para limitar as tentativas de accesso..
     *
     * @return string
     */
    public function username()
    {
        return 'email';
    }




    public function store(ValidateCheckout $request)
    {
        $dataForm = $request->all();
        //dd($dataForm);
        $new_account = $request['new_account'];
        if ($new_account == 1) {
            $user = $this->interUser->create($dataForm['register']);
            if ($user) {

                $note = [
                    'user_id' => $user->id,
                    'admin' => constLang('profile_name.user'),
                    'label' => constLang('register'),
                    'description' => ipLocation()
                ];

                event(new UserRegisteredCheckoutEvent($user));

                event(new UserRegisteredNoteEvent($note));

                $dataForm['address']['user_id'] = $user->id;
                $address = $dataForm['address'];
                $create_address = $this->interAddress->create($address);
                if ($create_address) {

                    $transport = $dataForm['transport'];
                    # Indicado pelo cliente
                    if ($transport['indicate'] == 1) {
                        $create_transport = [
                            'order_id' => '1', #order->id
                            'user_id' => $user->id,
                            'config_shipping_id' => 'Verificar',
                            'indicate' => $transport['indicate'],
                            'phone' => $transport['phone'],
                            'name' => $transport['name']
                        ];
                    } else {
                        # Método de envio
                        $shipping_method = $dataForm['shipping_method[0]'];
                        dd($shipping_method);

                    }


                }




                $message = "Falta pouco para concretizar a compra, entre no Email {$user->email} e clique em concluir cadastro.";
                $messages = view("{$this->view}.messages.info-1", compact('message'))->render();
                $out = array(
                    "result" => "confirmation",
                    "messages" => $messages,
                    "refresh" => false,
                    "reload" => false
                );
                return response()->json($out);
            }
        } else {

        }

        dd($dataForm);



        $result = 2;
        if ($result == 2) {
            $terms = $request->input('terms');
            // Error
            $message = "Preencha os campos vazios {$result}";
            if (empty($terms)) {
                $message = 'Por favor ler e aceitar os termos e condições para prosseguir com o seu pedido.';
            }
            $messages = view("{$this->view}.messages.error-1", compact('message'))->render();
            $out = array(
                "result" => "failure",
                "messages" => $messages,
                "refresh" => false,
                "reload" => false
            );
        } else {
            $id = (int)(12345);
            $order_name = 'pedido-recebido';
            $out = array(
                "result" => "success",
                "redirect" => route('checkout.received', [$order_name, $id])
            );
        }


        return response()->json($out);
    }


    protected function verifyToken($email, $token)
    {

        if (empty($token)) {
            return $this->redirectTo;
        }
        $user = $this->interUser->setToken($token);
        if (empty($user)) {
            return $this->redirectTo;        }

        if ($user) {
            if ($user->token == $token) {

                if ($user->email != $email) {
                    return $this->redirectTo;
                }
                $visits = $user->visits + 1;
                $input = [
                    'active' => constLang('active_true'),
                    'last_login' => date('Y-m-d H:i:s'),
                    'visits' => $visits,
                    'token' => NULL,
                    'ip' => $_SERVER['REMOTE_ADDR']
                ];
                $update = $this->interUser->update($input, $user->id);
                if ($update) {

                    event(new UserRegisterConfirmedEvent($user));

                    Auth::loginUsingId($user->id, true);

                    return $this->index();

                } else {
                    session()->flash('error', constLang('error_server1'));
                    return redirect(route('login'));
                }
            }

        }

    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($order, $id)
    {

        $bank_name = 'BRADESCO';
        $account_type = 'Conta Corrente';
        $account_name = config('app.name');
        $branch_number = "841";
        $account_number = "10168-0";
        $document_name = "CNPJ";
        $document_number = "65.590.366/0001-03";
        $reference_name = "Referencia";
        $reference_number = $id;



        return view("{$this->view}.checkout-1-received", compact(
            'bank_name',
            'account_type',
            'account_name',
            'branch_number',
            'account_number',
            'document_name',
            'document_number',
            'reference_name',
            'reference_number'
        ));
    }

    public function endpoint(Request $request)
    {
        $ac = $request->input('ajax');
        if ($ac == 'update_order_review') {


            $shipping_method = $request->input('shipping_method');
            $method = $shipping_method[0];

            ($method == null ? $method = 'legacy_flat_rate' : $method = $method);


            $order = view("{$this->view}.includes.method-1", compact('method'))->render();
            $payment = view("{$this->view}.includes.payment-1")->render();

            $out = array(
                "result" => "success",
                "messages" => "",
                "reload" => "false",
                "fragments" => array(
                    ".woocommerce-checkout-review-order-table" => $order,
                    ".woocommerce-checkout-payment" => $payment
                )
            );

            return response()->json($out);

        }



    }




}
