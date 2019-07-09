( function( $ ) {

    postFormJson = function(id) {
        var form  = $('#'+id),
            url   = form.attr('action'),
            btn   = $('#'+id+'-submit'),
            ret   = $('#return-'+id);
        text  = btn.text();
        jQuery.ajax({
            type: 'POST',
            dataType: "json",
            url: url,
            data: form.serialize(),
            beforeSend: function() {
                btn.prop('disabled', true);
                btn.text(wc_add_to_cart_params.loader);
            },
            success: function(data){
                btn.html(text);
                btn.prop('disabled', false);
                ret.show();
                ret.html('<ul class="avdesign-info">'+data.success+'</ul>');

                $('#'+id).each (function(){
                    this.reset();
                })


                if (typeof data.redirect !== 'undefined') {
                    setTimeout(function() {
                        window.location.href = data.redirect
                    }, 3000);
                } else {
                    setTimeout(function(){ ret.hide(); }, 30000);
                }
            },
            error: function(xhr) {
                btn.text(text);
                btn.prop('disabled', false);
                ajaxFormError(xhr, 'return-'+id);
            }
        });
    };


    ajaxFormError = function(xhr, div)
    {
        $("#"+div).empty();
        if (xhr.status == 422) {
            var obj = $.parseJSON(xhr.responseText), message = '';
            $.each( obj, function( key, value ) {

                if (key == 'errors') {
                    $.each(obj[key], function(i, error) {
                        message += '<li>'+error+'</li>';
                    });
                }
            });
            $("#"+div).show();
            $("#"+div).html('<ul class="woocommerce-Message woocommerce-Message--info woocommerce-info">'+ message +'</ul>');
            setTimeout(function(){ $("#"+div).hide(); }, 6000);
        }
    }

    /** Form Profile (change account e register user)
     *
     * @param url
     */
    formProfile = function (url) {
        var token = $("#_token").val();
        $.ajax({
            type: "POST",
            url: url,
            headers: {
                'X-CSRF-TOKEN': token
            },
            success: function (data) {
                $('#load-profile').html(data);
            }
        });
    }


    setVendor = function (opc) {
        if (opc == 1) {
            $("#list-vendors").show();
        } else {
            $("#list-vendors").hide();
        }
    }

    /**
     * Logout User
     * @param url
     * @param token
     */
    logoutUser = function (url, token) {
        var form = document.createElement("form");
        var element1 = document.createElement("input");
        form.method = "POST";
        form.action = url;
        element1.name="_token";
        element1.value=token;
        form.appendChild(element1);
        document.body.appendChild(form);
        form.submit();
    }


    $("input[name='register[type_id]']:radio")
        .change(function() {
            $("#person_legal").toggle($(this).attr('id') == 'register_type_1');
            $("#person_physical").toggle($(this).attr('id') == 'register_type_2');
        });




} )( jQuery );