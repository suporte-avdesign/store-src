@if($user->type_id == 1)
    <div id="person_legal" style="display:block">
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
    </div>
@else
    <div id="person_legal" style="display:none">
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
@endif
