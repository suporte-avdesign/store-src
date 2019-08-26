<div class="form-row form-row-wide" style="margin-left: 20px">
    <label class="indicate checkbox">
        <input class="input-checkbox"  id="indicate_transport" type="checkbox" name="transport[indicate]" value="1">
        <span>{{$content->address->text_indicate}} ({{constLang('optional')}})</span>
    </label>
</div>

<div class="indicate_transport" style="display: none">
    <p class="form-row form-row-first validate-required">
        <label for="transport_name" class="">{{$content->address->label_name_transport}} <span class="required">*</span></label>
        <input type="text" class="input-text" id="transport_name" name="transport[name]" value=""/>
    </p>
    <p class="form-row form-row-last validate-required">
        <label for="transport_phone" class="">{{$content->address->label_phone_transport}} <span class="required">*</span></label>
        <input type="text" class="input-text" id="transport_phone" name="transport[phone]" value="" />
    </p>
    <div class="clear"></div>
</div>