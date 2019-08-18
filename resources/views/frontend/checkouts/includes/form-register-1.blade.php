<!-- FORM FATURED -->
<h3>{{constLang('messages.checkouts.detail_user')}}</h3>
<p class="form-row form-row-wide">
    @foreach($profiles as $profile)
        @if($loop->first)
            <input type="radio" class="input-radio" id="profile_{{$profile->id}}" name="register[profile_id]" value="{{$profile->id}}" checked /> <b>{{$profile->name}}</b>
            <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
        @endif
        @if($loop->last)
            <input type="radio" class="input-radio" id="profile_{{$profile->id}}" name="register[profile_id]" value="{{$profile->id}}" /> <b>{{$profile->name}}</b>
        @endif
    @endforeach
</p>
<p class="form-row form-row-wide">
    @foreach($types as $type)
        @if($loop->first)
            <input type="radio" class="input-radio" id="register_type_{{$type->id}}" name="register[type_id]" value="{{$type->id}}" checked /> <b>{{$type->name}}</b>
            <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
        @endif
        @if($loop->last)
            <input type="radio" class="input-radio" id="register_type_{{$type->id}}" name="register[type_id]"  value="{{$type->id}}" /> <b>{{$type->name}}</b>
        @endif
    @endforeach
</p>
<div id="person_legal" style="display:block">
    <p class="form-row form-row-first validate-required">
        <label for="first_name_1" class="">{{constLang('person_legal.first_name')}} <span class="required">*</span></label>
        <span class="woocommerce-input-wrapper">
            <input type="text" class="input-text" id="first_name_1" name="register[first_name_1]" autocomplete="off" value=""/>
        </span>
    </p>
    <p class="form-row form-row-last validate-required">
        <label for="last_name_1">{{constLang('person_legal.last_name')}}&nbsp;<span class="required">*</span></label>
        <span class="woocommerce-input-wrapper">
            <input type="text" class="input-text" id="last_name_1" name="register[last_name_1]" autocomplete="off" value="" />
        </span>
    </p>

    <p class="form-row form-row-first validate-required">
        <label for="document1_1">{{constLang('person_legal.document1')}} <span class="required">*</span></label>
        <span class="woocommerce-input-wrapper">
            <input type="text" class="input-text" id="reg_document1_1" name="register[document1_1]" autocomplete="off" value=""/>
        </span>
    </p>
    <p class="form-row form-row-last validate-required">
        <label for="document2_1">{{constLang('person_legal.document2')}}&nbsp;<span class="required">*</span></label>
        <span class="woocommerce-input-wrapper">
            <input type="text" class="input-text" id="document2_1" name="register[document2_1]" autocomplete="off" value="" />
        </span>
    </p>
</div>
<div id="person_physical" style="display: none">
    <p class="form-row form-row-first validate-required">
        <label for="first_name_2" class="">{{constLang('person_physical.first_name')}} <span class="required">*</span></label>
        <span class="woocommerce-input-wrapper">
            <input type="text" class="input-text" id="first_name_2" name="register[first_name_2]" autocomplete="off" value=""/>
        </span>
    </p>
    <p class="form-row form-row-last validate-required">
        <label for="last_name_2">{{constLang('person_physical.last_name')}}&nbsp;<span class="required">*</span></label>
        <span class="woocommerce-input-wrapper">
            <input type="text" class="input-text" id="last_name_2" name="register[last_name_2]" autocomplete="off" value="" />
        </span>
    </p>

    <p class="form-row form-row-first validate-required">
        <label for="document1_2">{{constLang('person_physical.document1')}} <span class="required">*</span></label>
        <span class="woocommerce-input-wrapper">
            <input type="text" class="input-text" id="reg_document1_2" name="register[document1_2]" autocomplete="off" value=""/>
        </span>
    </p>
    <p class="form-row form-row-last validate-required">
        <label for="document2_2">{{constLang('person_physical.document2')}}&nbsp;<span class="required">*</span></label>
        <span class="woocommerce-input-wrapper">
            <input type="text" class="input-text" id="document2_2" name="register[document2_2]" autocomplete="off" value="" />
        </span>
    </p>
</div>
<p class="form-row form-row-first validate-required">
    <label for="reg_email">{{constLang('email')}} <span class="required">*</span></label>
    <span class="woocommerce-input-wrapper">
        <input type="email" class="input-text" id="reg_email" name="register[email]" autocomplete="off" autocomplete="email" value="" />
    </span>
</p>
<p class="form-row form-row-last validate-required">
    <label for="reg_date">{{constLang('date_birth')}} &nbsp;<span class="required">*</span></label>
    <span class="woocommerce-input-wrapper">
       <input type="text" class="input-text" id="reg_date" name="register[date]" autocomplete="off" value="" />
    </span>
</p>
<p class="form-row form-row-first validate-required">
    <label for="reg_cell">{{constLang('cell')}}/Whatsapp <span class="required">*</span></label>
    <span class="woocommerce-input-wrapper">
        <input type="text" class="input-text" id="reg_cell" name="register[cell]" autocomplete="off" value="" />
    </span>
</p>

<p class="form-row form-row-last">
    <label for="reg_phone">{{constLang('other')}} {{constLang('phone')}} &nbsp;<span class="required">*</span></label>
    <span class="woocommerce-input-wrapper">
       <input type="text" class="input-text" id="reg_phone" name="register[phone]" autocomplete="off" value="" />
    </span>
</p>

<p class="form-row form-row-first validate-required">
    <label for="reg_password">{{constLang('password')}} <span class="required">*</span></label>
    <span class="woocommerce-input-wrapper">
        <input type="password" class="input-text" id="reg_password" name="register[password]" autocomplete="off" value="" />
    </span>
</p>

<p class="form-row form-row-last validate-required">
    <label for="reg_password_confirm">{{constLang('password_confirm')}} <span class="required">*</span></label>
    <span class="woocommerce-input-wrapper">
        <input type="password" class="input-text" id="reg_password_confirm" name="register[password_confirmation]" autocomplete="off" value="" />
    </span>
</p>

<p class="form-row form-row-wide validate-required">
    <label for="address">{{constLang('address')}} <span class="required">*</span></label>
    <span class="woocommerce-input-wrapper">
        <input type="text" class="input-text" id="address" name="address[address]" autocomplete="off" value="" />
    </span>
</p>

<p class="form-row form-row-first validate-required">
    <label for="address_number">{{constLang('number')}} <span class="required">*</span></label>
    <span class="woocommerce-input-wrapper">
        <input type="text" class="input-text" id="address_number" name="address[number]" autocomplete="off" value="" />
    </span>
</p>

<p class="form-row form-row-last">
    <label for="address_complement">{{constLang('complement')}} <span class="required"></span></label>
    <span class="woocommerce-input-wrapper">
       <input type="text" class="input-text" id="address_complement" name="address[complement]" autocomplete="off" value="" />
    </span>
</p>
<p class="form-row form-row-first validate-required">
    <label for="district">{{constLang('district')}} <span class="required">*</span></label>
    <span class="woocommerce-input-wrapper">
        <input type="text" class="input-text" id="district" name="address[district]" autocomplete="off" value="" />
    </span>
</p>
<p class="form-row form-row-last validate-required">
    <label for="city">{{constLang('city')}} <span class="required">*</span></label>
    <span class="woocommerce-input-wrapper">
        <input type="text" class="input-text" id="city" name="address[city]" autocomplete="off" value="" />
    </span>
</p>

<p class="form-row form-row-first validate-required">
    <label for="zip_code">{{constLang('zip_code')}} &nbsp;<span class="required">*</span></label>
    <span class="woocommerce-input-wrapper">
       <input type="text" class="input-text" id="zip_code" name="address[zip_code]" value="" autocomplete="off" />
    </span>
</p>

<p class="form-row form-row-last address-field validate-required validate-state" id="billing_state_field" data-priority="80">
    <label for="state" class="select2-selection__rendered">{{constLang('state')}}<span class="required">*</span></label>
    <span class="woocommerce-input-wrapper">
        <select name="address[state]" id="state" autocomplete="off" class="state_select">
            <option value="">{{constLang('select_state')}}</option>
            @foreach($states as $state)
                <option value="{{$state->uf}}">{{$state->name}}</option>
            @endforeach
        </select>
    </span>
</p>


