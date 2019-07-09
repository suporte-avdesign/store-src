@php
    $user = null;
    if ($user) {
        $session = md5($user_id);
    } else {
        $session = md5($_SERVER['REMOTE_ADDR']);
    }
@endphp
<script type='text/javascript'>
    var wc_cart_fragments_params = {!! json_encode([
        "ajax_url" => route('cart'),
        "wc_ajax_url" => route('cart.fragments'),
        "fragment_name" => "wc_fragments_".\Illuminate\Support\Str::slug(config('app.name'), '_'),
        "cart_hash_key" => "wc_cart_hash_{$session}",
        "csrf_token" => csrf_token()
    ]) !!};
</script>
