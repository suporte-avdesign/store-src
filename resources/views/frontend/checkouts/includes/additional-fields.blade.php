<div class="woocommerce-shipping-fields">
    <h3>
        <label class="checkbox">
            <input class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox" id="indicate_transport" type="checkbox" name="transport[indicate]" value="1" style="margin-left: 10px;position: relative">
            <span>{{constLang('messages.checkouts.indicate_transport')}}</span>
        </label>
    </h3>

    <div class="indicate_transport" style="display:none">
        <div class="woocommerce-shipping-fields__field-wrapper">

            @if(empty($transport))

                <p class="form-row form-row-first validate-required">
                    <label for="transport_name" class="">{{constLang('name')}} <span class="required">*</span></label>
                    <input type="text" class="input-text" id="transport_name" autocomplete="off" name="transport[name]" value=""/>
                </p>
                <p class="form-row form-row-last validate-required">
                    <label for="transport_phone" class="">{{constLang('phone')}}&nbsp;<span class="required">*</span></label>
                    <input type="text" class="input-text" id="transport_phone" name="transport[phone]" autocomplete="off" value=""/>
                </p>

             @else

                <p class="form-row form-row-first validate-required">
                    <label for="transport_name" class="">{{constLang('name')}} <span class="required">*</span></label>
                    <input type="text" class="input-text" id="transport_name" name="transport[name]" value="{{$transport->name}}"/>
                </p>
                <p class="form-row form-row-last validate-required">
                    <label for="transport_phone" class="">{{constLang('phone')}}&nbsp;<span class="required">*</span></label>
                    <input type="text" class="input-text" id="transport_phone" name="transport[phone2]" value="{{$transport->phone}}"/>
                </p>

            @endif

        </div>
    </div>
</div>
<div class="woocommerce-additional-fields">
    <div class="woocommerce-additional-fields__field-wrapper">
        <p class="form-row notes" id="order_comments_field" data-priority="">
            <label for="order_comments" class="">{{constLang('note')}}&nbsp;<span class="optional">({{constLang('optional')}})</span></label>
            <textarea name="order_comments" class="input-text " id="order_comments" placeholder="{{constLang('messages.checkouts.note_order')}}" rows="2" cols="5"></textarea>
        </p>
    </div>
</div>