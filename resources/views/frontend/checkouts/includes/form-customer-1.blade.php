<!-- FORM FATURED -->
<h3>{{constLang('messages.checkouts.detail_user')}}</h3>

<div style="display: none;">
    <input type="hidden" name="register[type_id]" value="{{$user->type_id}}"/>
    <input type="hidden" name="register[profile_id]" value="{{$user->profile_id}}"/>
</div>

@if($user->type_id == 1)
    <p class="form-row form-row-first validate-required">
        <label for="first_name_1" class="">{{constLang('person_legal.first_name')}} <span class="required">*</span></label>
        <span class="woocommerce-input-wrapper">
            <input type="text" class="input-text" id="first_name_1" name="register[first_name_1]" autocomplete="off" value="{{$user->first_name}}"/>
        </span>
    </p>
    <p class="form-row form-row-last validate-required">
        <label for="last_name_1">{{constLang('person_legal.last_name')}}&nbsp;<span class="required">*</span></label>
        <span class="woocommerce-input-wrapper">
            <input type="text" class="input-text" id="last_name_1" name="register[last_name_1]" autocomplete="off" value="{{$user->last_name}}" />
        </span>
    </p>

    <p class="form-row form-row-first validate-required">
        <label for="document1_1">{{constLang('person_legal.document1')}} <span class="required">*</span></label>
        <span class="woocommerce-input-wrapper">
            <input type="text" class="input-text" id="reg_document1_1" name="register[document1_1]" autocomplete="off" value="{{$user->document1}}"/>
        </span>
    </p>
    <p class="form-row form-row-last validate-required">
        <label for="document2_1">{{constLang('person_legal.document2')}}&nbsp;<span class="required">*</span></label>
        <span class="woocommerce-input-wrapper">
            <input type="text" class="input-text" id="document2_1" name="register[document2_1]" autocomplete="off" value="{{$user->document2}}" />
        </span>
    </p>
@else
    <p class="form-row form-row-first validate-required">
        <label for="first_name_2" class="">{{constLang('person_physical.first_name')}} <span class="required">*</span></label>
        <span class="woocommerce-input-wrapper">
            <input type="text" class="input-text" id="first_name_2" name="register[first_name_2]" autocomplete="off" value="{{$user->first_name}}"/>
        </span>
    </p>
    <p class="form-row form-row-last validate-required">
        <label for="last_name_2">{{constLang('person_physical.last_name')}}&nbsp;<span class="required">*</span></label>
        <span class="woocommerce-input-wrapper">
            <input type="text" class="input-text" id="last_name_2" name="register[last_name_2]" autocomplete="off" value="{{$user->last_name}}" />
        </span>
    </p>

    <p class="form-row form-row-first validate-required">
        <label for="document1_2">{{constLang('person_physical.document1')}} <span class="required">*</span></label>
        <span class="woocommerce-input-wrapper">
            <input type="text" class="input-text" id="reg_document1_2" name="register[document1_2]" autocomplete="off" value="{{$user->document1}}"/>
        </span>
    </p>
    <p class="form-row form-row-last validate-required">
        <label for="document2_2">{{constLang('person_physical.document2')}}&nbsp;<span class="required">*</span></label>
        <span class="woocommerce-input-wrapper">
            <input type="text" class="input-text" id="document2_2" name="register[document2_2]" autocomplete="off" value="{{$user->document2}}" />
        </span>
    </p>
@endif
<p class="form-row form-row-first validate-required">
    <label for="reg_email">{{constLang('email')}} <span class="required">*</span></label>
    <span class="woocommerce-input-wrapper">
        <input type="email" class="input-text" id="reg_email" name="register[email]" autocomplete="off" value="{{$user->email}}" />
    </span>
</p>
<p class="form-row form-row-last validate-required">
    <label for="reg_date">{{constLang('date_birth')}} &nbsp;<span class="required">*</span></label>
    <span class="woocommerce-input-wrapper">
       <input type="text" class="input-text" id="reg_date" name="register[date]" autocomplete="off" value="{{$user->date}}" />
    </span>
</p>
<p class="form-row form-row-first validate-required">
    <label for="reg_cell">{{constLang('cell')}}/Whatsapp <span class="required">*</span></label>
    <span class="woocommerce-input-wrapper">
        <input type="text" class="input-text" id="reg_cell" name="register[cell]" autocomplete="off" value="{{$user->cell}}" />
    </span>
</p>

<p class="form-row form-row-last">
    <label for="reg_phone">{{constLang('other')}} {{constLang('phone')}} &nbsp;<span class="required">*</span></label>
    <span class="woocommerce-input-wrapper">
       <input type="text" class="input-text" id="reg_phone" name="register[phone]" autocomplete="off" value="{{$user->phone}}" />
    </span>
</p>

<p class="form-row form-row-wide validate-required">
    <label for="address">{{constLang('address')}} <span class="required">*</span></label>
    <span class="woocommerce-input-wrapper">
        <input type="text" class="input-text" id="address" name="address[address]" autocomplete="off" value="{{$adresses->address}}"/>
    </span>
</p>

<p class="form-row form-row-first validate-required">
    <label for="reg_number">{{constLang('number')}} <span class="required">*</span></label>
    <span class="woocommerce-input-wrapper">
        <input type="text" class="input-text" id="reg_number" name="address[number]" autocomplete="off" value="{{$adresses->number}}"/>
    </span>
</p>

<p class="form-row form-row-last">
    <label for="complement">{{constLang('complement')}} <span class="required"></span></label>
    <span class="woocommerce-input-wrapper">
       <input type="text" class="input-text" id="complement" name="address[complement]" autocomplete="off" value="{{$adresses->complement}}"/>
    </span>
</p>
<p class="form-row form-row-first validate-required">
    <label for="district">{{constLang('district')}} <span class="required">*</span></label>
    <span class="woocommerce-input-wrapper">
        <input type="text" class="input-text" id="district" name="address[district]" autocomplete="off" value="{{$adresses->district}}"/>
    </span>
</p>
<p class="form-row form-row-last validate-required">
    <label for="city">{{constLang('city')}} <span class="required">*</span></label>
    <span class="woocommerce-input-wrapper">
        <input type="text" class="input-text" id="city" name="address[city]" autocomplete="off" value="{{$adresses->city}}"/>
    </span>
</p>

<p class="form-row form-row-first validate-required">
    <label for="zip_code">{{constLang('zip_code')}} &nbsp;<span class="required">*</span></label>
    <span class="woocommerce-input-wrapper">
       <input type="text" class="input-text" id="zip_code" name="address[zip_code]" autocomplete="off" value="{{$adresses->zip_code}}"/>
    </span>
</p>

<p class="form-row form-row-last validate-required validate-state">
    <label for="state" class="">{{constLang('state')}}<span class="required">*</span></label>
    <span class="woocommerce-input-wrapper">
        <select name="address[state]" id="state" autocomplete="off" class="state_select">
            <option value="">{{constLang('select_state')}}</option>
            @foreach($states as $state)
                <option value="{{$state->uf}}" @if($adresses->state == $state->uf) selected @endif>{{$state->name}}</option>
            @endforeach
        </select>
    </span>
</p>






