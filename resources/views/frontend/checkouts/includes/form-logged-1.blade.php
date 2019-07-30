<!-- FORM FATURED -->
<div class="woocommerce-billing-fields">
    <h3>{{constLang('messages.checkouts.detail_user')}}</h3>

    <div class="woocommerce-additional-fields__field-wrapper">
        <p class="form-row notes" id="order_comments_field" data-priority="">
            <label for="order_comments" class="">{{constLang('note')}}&nbsp;<span class="optional">({{constLang('optional')}})</span></label>
            <span class="woocommerce-input-wrapper">
            <textarea name="order_comments" class="input-text " id="order_comments" placeholder="{{constLang('messages.checkouts.note_order')}}" rows="2" cols="5"></textarea>
        </span>
        </p>
        <p class="form-row form-row-wide create-account woocommerce-validated">
            <label class="checkbox">
                <input class="input-checkbox" id="indicate_transport" type="checkbox" name="indicate_transport" value="1">
                <span>{{constLang('messages.checkouts.indicate_transport')}}</span>
            </label>
        </p>
        <div class="indicate_transport" style="display:none">
            <p class="form-row form-row-first validate-required">
                <label for="transport_name" class="">{{constLang('name')}} <span class="required">*</span></label>
                <span class="woocommerce-input-wrapper">
                <input type="text" class="input-text" id="transport_name" name="transport[name]" value=""/>
            </span>
            </p>
            <p class="form-row form-row-last validate-required">
                <label for="transport_phone" class="">{{constLang('phone')}}&nbsp;<span class="required">*</span></label>
                <span class="woocommerce-input-wrapper">
                <input type="text" class="input-text" id="transport_phone" name="transport[phone]" value="" />
            </span>
            </p>
        </div>
    </div>

    @if($user->profile_id == 1)
        <p class="form-row form-row-first validate-required">
            <label for="first_name_1" class="">{{constLang('person_legal.first_name')}} <span class="required">*</span></label>
            <span class="woocommerce-input-wrapper">
                <input type="text" class="input-text" id="first_name_1" name="register[first_name_1]" value="{{$user->first_name}}"/>
            </span>
        </p>
        <p class="form-row form-row-last validate-required">
            <label for="last_name_1">{{constLang('person_legal.last_name')}}&nbsp;<span class="required">*</span></label>
            <span class="woocommerce-input-wrapper">
                <input type="text" class="input-text" id="last_name_1" name="register[last_name_1]" value="{{$user->last_name}}" />
            </span>
        </p>

        <p class="form-row form-row-first validate-required">
            <label for="document1_1">{{constLang('person_legal.document1')}} <span class="required">*</span></label>
            <span class="woocommerce-input-wrapper">
                <input type="text" class="input-text" id="reg_document1_1" name="register[document1_1]" value="{{$user->document1}}"/>
            </span>
        </p>
        <p class="form-row form-row-last validate-required">
            <label for="document2_1">{{constLang('person_legal.document2')}}&nbsp;<span class="required">*</span></label>
            <span class="woocommerce-input-wrapper">
                <input type="text" class="input-text" id="document2_1" name="register[document2_1]" value="{{$user->document2}}" />
            </span>
        </p>
    @else
        <p class="form-row form-row-first validate-required">
            <label for="first_name_2" class="">{{constLang('person_physical.first_name')}} <span class="required">*</span></label>
            <span class="woocommerce-input-wrapper">
                <input type="text" class="input-text" id="first_name_2" name="register[first_name_2]" value="{{$user->first_name}}"/>
            </span>
        </p>
        <p class="form-row form-row-last validate-required">
            <label for="last_name_2">{{constLang('person_physical.last_name')}}&nbsp;<span class="required">*</span></label>
            <span class="woocommerce-input-wrapper">
                <input type="text" class="input-text" id="last_name_2" name="register[last_name_2]" value="{{$user->last_name}}" />
            </span>
        </p>

        <p class="form-row form-row-first validate-required">
            <label for="document1_2">{{constLang('person_physical.document1')}} <span class="required">*</span></label>
            <span class="woocommerce-input-wrapper">
                <input type="text" class="input-text" id="reg_document1_2" name="register[document1_2]" value="{{$user->document1}}"/>
            </span>
        </p>
        <p class="form-row form-row-last validate-required">
            <label for="document2_2">{{constLang('person_physical.document2')}}&nbsp;<span class="required">*</span></label>
            <span class="woocommerce-input-wrapper">
                <input type="text" class="input-text" id="document2_2" name="register[document2_2]" value="{{$user->document2}}" />
            </span>
        </p>
    @endif
    <p class="form-row form-row-first validate-required">
        <label for="reg_email">{{constLang('email')}} <span class="required">*</span></label>
        <span class="woocommerce-input-wrapper">
            <input type="email" class="input-text" id="reg_email" name="register[email]" autocomplete="email" value="{{$user->email}}" />
        </span>
    </p>
    <p class="form-row form-row-last validate-required">
        <label for="reg_date">{{constLang('date_birth')}} &nbsp;<span class="required">*</span></label>
        <span class="woocommerce-input-wrapper">
           <input type="text" class="input-text" id="reg_date" name="register[date]" value="{{$user->date}}" />
        </span>
    </p>
    <p class="form-row form-row-first validate-required">
        <label for="reg_cell">{{constLang('cell')}}/Whatsapp <span class="required">*</span></label>
        <span class="woocommerce-input-wrapper">
            <input type="text" class="input-text" id="reg_cell" name="register[cell]" value="{{$user->cell}}" />
        </span>
    </p>

    <p class="form-row form-row-last">
        <label for="reg_phone">{{constLang('other')}} {{constLang('phone')}} &nbsp;<span class="required">*</span></label>
        <span class="woocommerce-input-wrapper">
           <input type="text" class="input-text" id="reg_phone" name="register[phone]" value="{{$user->phone}}" />
        </span>
    </p>

    <p class="form-row form-row-wide validate-required">
        <label for="address">{{constLang('address')}} <span class="required">*</span></label>
        <span class="woocommerce-input-wrapper">
            <input type="text" class="input-text" id="address" name="address[address]" value="{{$adresses->address}}" />
        </span>
    </p>

    <p class="form-row form-row-first validate-required">
        <label for="reg_number">{{constLang('number')}} <span class="required">*</span></label>
        <span class="woocommerce-input-wrapper">
            <input type="text" class="input-text" id="reg_number" name="address[number]" value="{{$adresses->number}}" />
        </span>
    </p>

    <p class="form-row form-row-last">
        <label for="complement">{{constLang('complement')}} <span class="required"></span></label>
        <span class="woocommerce-input-wrapper">
           <input type="text" class="input-text" id="complement" name="address[complement]" value="{{$adresses->complement}}" />
        </span>
    </p>
    <p class="form-row form-row-first validate-required">
        <label for="district">{{constLang('district')}} <span class="required">*</span></label>
        <span class="woocommerce-input-wrapper">
            <input type="text" class="input-text" id="district" name="address[district]" value="{{$adresses->district}}" />
        </span>
    </p>
    <p class="form-row form-row-last validate-required">
        <label for="city">{{constLang('city')}} <span class="required">*</span></label>
        <span class="woocommerce-input-wrapper">
            <input type="text" class="input-text" id="city" name="address[city]" value="{{$adresses->city}}" />
        </span>
    </p>

    <p class="form-row form-row-first validate-required">
        <label for="zip_code">{{constLang('zip_code')}} &nbsp;<span class="required">*</span></label>
        <span class="woocommerce-input-wrapper">
           <input type="text" class="input-text" id="zip_code" name="address[zip_code]" value="{{$adresses->zip_code}}" />
        </span>
    </p>

    <p class="form-row form-row-last validate-required validate-state">
        <label for="state" class="">{{constLang('state')}}<span class="required">*</span></label>
        <span class="woocommerce-input-wrapper">
            <select name="address[state]" id="state" class="state_select">
                <option value="">{{constLang('select_state')}}</option>
                @foreach($states as $state)
                    <option value="{{$state->uf}}" @if($adresses->state == $state->uf) selected @endif>{{$state->name}}</option>
                @endforeach
            </select>
        </span>
    </p>
</div>
