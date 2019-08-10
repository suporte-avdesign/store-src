<div class="vc_row wpb_row vc_inner vc_row-fluid avd_custom_popup_payment vc_row-o-equal-height vc_row-flex">
    <div class="wpb_column vc_column_container vc_col-sm-8">

        <div class="vc_column-inner">
            <div class="wpb_wrapper">
                <div class="row">
                    <div class="col-md-3">
                        <div style="margin-top: 10px">
                            <img  src="{{asset('themes/images/payment/bradesco-logo.png')}}" alt="{{constLang('messages.payments.title_cash')}}" width="100px">
                        </div>

                    </div>
                    <div class="col-md-9">
                        <div class="title-wrapper  basel-title-color-default basel-title-style-default basel-title-size-small text-left ">
                            <h3 class="wpb_wrapper" style="margin-top: 10px">
                                <span>{{constLang('messages.payments.title_cash')}} </span> <strong class="total-value">R$ 142,67</strong>
                            </h3>
                        </div>
                        <div class="wpb_text_column wpb_content_element vc_custom_1484129453229">
                            <div class="wpb_wrapper">
                                <ul>

                                    <li>{{config('company._bank')}}:<strong> {{config('company.bank')}}</strong></li>
                                    <li>{{config('company._agency')}}:<strong> {{config('company.bank_agency_number')}}-{{config('company.bank_agency_digit')}}</strong></li>
                                    <li>{{config('company.bank_account_type')}}:<strong> {{config('company.bank_account_number')}}-{{config('company.bank_account_digit')}}</strong></li>
                                    <li>{{config('company._account_name')}}:<strong> {{config('company.bank_account_name')}}</strong></li>
                                    <li>{{config('company._cnpj')}}:<strong> {{config('company.document1')}}</strong></li>

                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <p>Faça seu pagamento diretamente em nossa conta bancária. Por favor, use o número do pedido como referência de pagamento. Seu pedido não será enviado até que os fundos sejam liberados em nossa conta.</p>
                    </div>

                </div>

                <div class="text-right">
                    <p>
                        <a href="#" title="{{constLang('messages.payments.btn_cash')}}" class="wpcf7-form-control wpcf7-submit btn btn-color-primary">{{constLang('messages.payments.btn_cash')}}</a>
                    </p>
                </div>
            </div>
        </div>


    </div>
    <div class="wpb_column vc_column_container vc_col-sm-4 vc_col-has-fill">
        <div class="vc_column-inner avd_custom_popup_payment_inner_info">
            <div class="wpb_wrapper">
                <div class="title-wrapper  basel-title-color-white basel-title-style-default basel-title-size-small text-left ">
                    <div class="liner-continer"> <span class="left-line"></span>
                        <h4 class="title">{{strtoupper(constLang('contacts'))}}
                            <span class="title-separator"><span></span></span>
                        </h4>
                        <span class="right-line"></span>
                    </div>
                </div>
                <div class=" basel-info-box2 text-left icon-alignment-left box-style-base color-scheme-light  with-animation " onclick="">
                    <div class="box-icon-wrapper">
                        <div class="info-box-icon">
                            <div class="info-svg-wrapper" style="width: 30px;height: 30px;">
                                <svg version="1.1" id="svg-5711" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="64px" height="64px" viewBox="0 0 64 64" enable-background="new 0 0 64 64" xml:space="preserve"><g><rect x="1" y="13" fill="none" stroke="#FFFFFF" stroke-width="2" stroke-miterlimit="10" width="62" height="37" /><polyline fill="none" stroke="#FFFFFF" stroke-width="2" stroke-miterlimit="10" points="1,13 32,33 63,13" /></g></svg>
                            </div>
                        </div>
                    </div>
                    <div class="info-box-content">
                        <div class="info-box-inner">
                            <p>
                                {{config('company.address')}}<br>
                                {{config('company.distric')}}<br>
                                {{config('company.city')}} - {{config('company.state')}}
                            </p>
                        </div>
                    </div>
                </div>
                <div class=" basel-info-box2 text-left icon-alignment-left box-style-base color-scheme-light  with-animation " onclick="">
                    <div class="box-icon-wrapper">
                        <div class="info-box-icon">
                            <div class="payment-contact info-svg-wrapper" style="width: 30px;height: 30px;">
                                <svg version="1.1" id="svg-8840" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="64px" height="64px" viewBox="0 0 64 64" enable-background="new 0 0 64 64" xml:space="preserve"><g><path fill="none" stroke="#FFFFFF" stroke-width="2" stroke-miterlimit="10" d="M53.92,10.081c12.107,12.105,12.107,31.732,0,43.838c-12.106,12.108-31.734,12.108-43.84,0c-12.107-12.105-12.107-31.732,0-43.838C22.186-2.027,41.813-2.027,53.92,10.081z" /><polyline fill="none" stroke="#FFFFFF" stroke-width="2" stroke-miterlimit="10" points="32,12 32,32 41,41" /><line fill="none" stroke="#FFFFFF" stroke-width="2" stroke-miterlimit="10" x1="4" y1="32" x2="8" y2="32" /><line fill="none" stroke="#FFFFFF" stroke-width="2" stroke-miterlimit="10" x1="56" y1="32" x2="60" y2="32" /><line fill="none" stroke="#FFFFFF" stroke-width="2" stroke-miterlimit="10" x1="32" y1="60" x2="32" y2="56" /><line fill="none" stroke="#FFFFFF" stroke-width="2" stroke-miterlimit="10" x1="32" y1="8" x2="32" y2="4" /></g></svg>
                            </div>
                        </div>
                    </div>
                    <div class="info-box-content">
                        <div class="info-box-inner">
                            <p>
                                {{config('company.monday_to_friday')}}<br>
                                {{config('company.monday_to_friday_horary')}}<br>
                                {{config('company.saturday')}}<br>
                                {{config('company.saturday_horary')}}
                            </p>
                        </div>
                    </div>
                </div>
                <div class=" basel-info-box2 text-left icon-alignment-left box-style-base color-scheme-light  with-animation " onclick="">
                    <div class="box-icon-wrapper">
                        <div class="info-box-icon">
                            <div class="info-svg-wrapper" style="width: 30px;height: 30px;">
                                <svg version="1.1" id="svg-8433" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="64px" height="64px" viewBox="0 0 64 64" enable-background="new 0 0 64 64" xml:space="preserve"><polygon fill="none" stroke="#FFFFFF" stroke-width="2" stroke-linejoin="bevel" stroke-miterlimit="10" points="1,30 63,1 23,41" /><polygon fill="none" stroke="#FFFFFF" stroke-width="2" stroke-linejoin="bevel" stroke-miterlimit="10" points="34,63 63,1 23,41" /></svg>
                            </div>
                        </div>
                    </div>
                    <div class="info-box-content">
                        <div class="info-box-inner">
                            <p>
                                <a href="{{route('contact')}}" target="_blank">{{config('company.email')}}</a><br>
                            </p>
                        </div>
                    </div>
                </div>
                <div class=" basel-info-box2 text-left icon-alignment-left box-style-base color-scheme-light  with-animation " onclick="">
                    <div class="info-box-icon">
                        <div class="info-svg-wrapper" style="width: 30px;height: 30px;"></div>
                    </div>
                    <div class="info-box-content">
                        <div class="info-box-inner">
                            <p>
                                {{config('company.phone')}} / {{config('company.phone2')}}<br>
                                {{config('company.whatsapp')}}<svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"width="32" height="32"viewBox="0 0 172 172"style=" fill:#000000;"><g fill="none" fill-rule="none" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none" fill-rule="nonzero"></path><g fill="#ffffff" fill-rule="evenodd"><g id="surface1"><path d="M131.70849,40.33349c-12.13574,-12.13574 -28.26074,-18.83349 -45.43555,-18.83349c-35.39941,0 -64.22705,28.80664 -64.22705,64.20606c-0.021,11.31689 2.93945,22.36084 8.56641,32.10303l-9.11231,33.27881l34.05567,-8.94433c9.36426,5.12305 19.94629,7.81055 30.69629,7.83154h0.02099c35.39942,0 64.20606,-28.80664 64.22705,-64.22705c0,-17.15381 -6.67676,-33.27881 -18.79151,-45.41455zM86.27295,139.12012h-0.02099c-9.57422,0 -18.98047,-2.58252 -27.16894,-7.43262l-1.95264,-1.15479l-20.21923,5.29102l5.39599,-19.69433l-1.25977,-2.01562c-5.35401,-8.50342 -8.16748,-18.32959 -8.16748,-28.40771c0,-29.41553 23.95654,-53.35108 53.41406,-53.35108c14.25634,0 27.65185,5.56397 37.72998,15.64209c10.07813,10.09912 15.62109,23.49462 15.62109,37.75097c0,29.43653 -23.95654,53.37207 -53.37207,53.37207zM115.54151,99.14356c-1.5957,-0.79785 -9.49023,-4.68213 -10.95996,-5.20703c-1.46972,-0.5459 -2.54053,-0.79785 -3.61133,0.79785c-1.0708,1.6167 -4.13623,5.22803 -5.08105,6.29883c-0.92383,1.04981 -1.86865,1.19678 -3.46435,0.39893c-1.6167,-0.79785 -6.78174,-2.49854 -12.9126,-7.97852c-4.76611,-4.24121 -7.99951,-9.51123 -8.92334,-11.10693c-0.94483,-1.6167 -0.10498,-2.47754 0.69287,-3.27539c0.73486,-0.71387 1.6167,-1.86866 2.41455,-2.81348c0.79785,-0.92383 1.0708,-1.5957 1.6167,-2.66651c0.5249,-1.0708 0.25195,-2.01562 -0.14697,-2.81347c-0.39893,-0.79785 -3.61133,-8.71338 -4.95508,-11.92578c-1.30176,-3.12842 -2.62451,-2.6875 -3.61133,-2.75049c-0.92383,-0.04199 -1.99463,-0.04199 -3.06543,-0.04199c-1.0708,0 -2.81348,0.39892 -4.2832,2.01563c-1.46973,1.5957 -5.60596,5.47998 -5.60596,13.37451c0,7.89453 5.75293,15.53711 6.55078,16.60791c0.79785,1.0498 11.3169,17.25879 27.4209,24.20849c3.82129,1.65869 6.80273,2.64551 9.1333,3.38037c3.84229,1.21778 7.34864,1.04981 10.12012,0.65088c3.08642,-0.46192 9.49023,-3.88428 10.83398,-7.64258c1.32275,-3.73731 1.32275,-6.94971 0.92383,-7.62158c-0.39893,-0.67187 -1.46973,-1.0708 -3.08643,-1.88965z"></path></g></g></g></svg>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
