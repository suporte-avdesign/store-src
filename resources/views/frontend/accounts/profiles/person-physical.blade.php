@if($user->type_id == 2)

    <div id="person_physical" style="display: block">
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
    </div>

@else

    <div id="person_physical" style="display: none">
        <p class="form-row form-row-first validate-required">
            <label for="first_name_2" class="">{{constLang('person_physical.first_name')}} <span class="required">*</span></label>
            <span class="woocommerce-input-wrapper">
                <input type="text" class="input-text" id="first_name_2" name="register[first_name_2]" value=""/>
            </span>
        </p>
        <p class="form-row form-row-last validate-required">
            <label for="last_name_2">{{constLang('person_physical.last_name')}}&nbsp;<span class="required">*</span></label>
            <span class="woocommerce-input-wrapper">
                <input type="text" class="input-text" id="last_name_2" name="register[last_name_2]" value="" />
            </span>
        </p>
        <p class="form-row form-row-first validate-required">
            <label for="document1_2">{{constLang('person_physical.document1')}} <span class="required">*</span></label>
            <span class="woocommerce-input-wrapper">
                <input type="text" class="input-text" id="reg_document1_2" name="register[document1_2]" value=""/>
            </span>
        </p>
        <p class="form-row form-row-last validate-required">
            <label for="document2_2">{{constLang('person_physical.document2')}}&nbsp;<span class="required">*</span></label>
            <span class="woocommerce-input-wrapper">
                <input type="text" class="input-text" id="document2_2" name="register[document2_2]" value="" />
            </span>
        </p>
    </div>

@endif