<?php

namespace AVD\Http\Controllers\Web;

use AVD\Http\Controllers\Controller;
use AVD\Interfaces\Web\CartInterface as InterCart;
use AVD\Interfaces\Web\UserInterface as InterUser;
use AVD\Interfaces\Web\StateInterface as InterState;
use AVD\Interfaces\Web\SectionInterface as InterSection;
use AVD\Interfaces\Web\ConfigSiteInterface as ConfigSite;
use AVD\Interfaces\Web\ConfigKeywordInterface as ConfigKeyword;
use AVD\Interfaces\Web\AccountTypeInterface as InterAccountType;
use AVD\Interfaces\Web\ConfigShippingInterface as ConfigShipping;
use AVD\Interfaces\Web\ConfigProfileClientInterface as InterProfile;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\AuthenticatesUsers;


class CheckoutController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = 'checkout';

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
        InterSection $interSection,
        InterProfile $interProfile,
        ConfigKeyword $configKeyword,
        ConfigShipping $configShipping,
        InterAccountType $interAccountType)
    {

        $this->interCart = $interCart;
        $this->interUser = $interUser;
        $this->interState = $interState;
        $this->configSite = $configSite;
        $this->interSection = $interSection;
        $this->interProfile = $interProfile;
        $this->configKeyword = $configKeyword;
        $this->configShipping = $configShipping;
        $this->interAccountType  = $interAccountType;
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
        $states         = $this->interState->getAll();
        $profiles       = $this->interProfile->getAll();

        $configKeyword  = $this->configKeyword->random();
        $configShipping = $this->configShipping->getAll();

        (Auth::user() ? $user_id = Auth::id() : $user_id = 0);
        $session = md5($_SERVER['REMOTE_ADDR']);


        $configSite = $this->configSite->setId(1);
        if ($user_id != 0 && $configSite->order == 'wishlist'){
            dd('Cart = Lista de desejo');
        } else {
            $cart = $this->interCart->getAll($session);

        }

        $total = $this->interCart->getTotal($cart);



        # Identificar qual método
        $method = null;
        ($method == null ? $method = 'legacy_flat_rate' : $method = $method);



        return view("{$this->view}.checkout-1", compact(
            'menu',
            'cart',
            'total',
            'types',
            'states',
            'method',
            'profiles',
            'configKeyword',
            'configShipping')
        );
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
        $selected = $request['shipping_method'][0];
        $configShipping = $this->configShipping->getAll();


        $shipping_method = $request->input('shipping_method');
        $method = $shipping_method[0];

        ($method == null ? $method = 'legacy_flat_rate' : $method = $method);




        (Auth::user() ? $user_id = Auth::id() : $user_id = 0);
        $session = md5($_SERVER['REMOTE_ADDR']);


        $configSite = $this->configSite->setId(1);
        if ($user_id != 0 && $configSite->order == 'wishlist'){
            dd('Cart = Lista de desejo');
        } else {
            $cart = $this->interCart->getAll($session);

        }

        $order = view("{$this->view}.includes.method-1", compact(
            'cart',
            'total',
            'method',
            'selected',
            'configShipping'))->render();
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





    public function store(Request $request)
    {
        $result = rand(1,2);
        if ($result == 2) {
            $terms = $request->input('terms');
            // Error
            $message = "Preencha os campos vazios {$result}";
            if (empty($terms)) {
                $message = 'Por favor ler e aceitar os termos e condições para prosseguir com o seu pedido.';
            }
            $messages = view('frontend.messages.error-checkout-1', compact('message'))->render();
            $out = array(
                "result" => "failure",
                "messages" => $messages,
                "refresh" => false,
                "reload" => true
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
