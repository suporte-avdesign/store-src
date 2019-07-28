<div class="woocommerce-form-coupon-toggle">
    <div class="woocommerce-info">{{constLang('messages.coupons.question')}}
        <a href="#" class="showcoupon">{{constLang('messages.coupons.showcoupon')}}</a>
    </div>
</div>
<form class="checkout_coupon woocommerce-form-coupon" method="post" style="display:none">
    <p>{{constLang('messages.coupons.info')}}</p>
    <p class="form-row form-row-first">
        <input type="text" name="coupon_code" class="input-text" placeholder="{{constLang('messages.coupons.code')}}" id="coupon_code" value="" />
    </p>
    <p class="form-row form-row-last">
        <button type="submit" class="button" name="apply_coupon" value="{{constLang('messages.coupons.apply')}}">{{constLang('messages.coupons.apply')}}</button>
    </p>
    <div class="clear"></div>
</form>
