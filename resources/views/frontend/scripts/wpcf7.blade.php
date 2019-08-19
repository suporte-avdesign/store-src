<script type="text/javascript">
    var wpcf7  = {!! json_encode([
        "apiSettings" => array(
            "root" => route('contact'),
            "namespace" => "form/contact-form-7/v1"
        ),
        "recaptcha" => array(
            "messages" => array(
                "empty" => "Verifique se você não é um robô."
            ),
            "namespace" => "contact-form-7/v1"
        ),
        "cached" => "1"
    ]) !!};
</script>