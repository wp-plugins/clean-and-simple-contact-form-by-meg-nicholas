jQuery(document).ready(function($) {
    
    var $form = $("#frmCSCF");
    
    $('#recaptcha_response_field').focus(function() {

    $errele = $form.find("div[for='cscf_recaptcha']");
    $errele.html('');
        
    });

    
    
    $form.validate({ 

            errorElement: 'span',
            errorClass: 'help-inline',
            
            highlight: function(element) {
                                $(element).closest('.control-group').removeClass('success').addClass('error');
                                },
            success: function(element) {
                                element.closest('.control-group').removeClass('error').addClass('success');
            } 


        });
        
    $form.submit(function (event) {
        
        event.preventDefault();

        if ($form.validate().valid() ) {
        
            $.ajax({
            type : "post",
            dataType : "json",
            cache: false,
            url : cscfvars.ajaxurl,
            data : $($form).serialize() + "&action=cscf-submitform", 
            success: function(response,strText) {
                                                    if (response.valid === true) { 
                                                        $($form).html(response.sentmsg); 
                                                    }

                                                    else { 

                                                        $.each(response.errorlist, function(name, value) {
                                                            $errele = $($form).find("div[for='cscf_" + name +"']");
                                                            $errele.html(value);
                                                            $($errele).closest('.control-group').removeClass('success').addClass('error');
                                                        });

                                                    }
                                                 },
            error: function(XMLHttpRequest, textStatus, errorThrown) { 
                    if (window.console) {
                        console.log("Status: " + textStatus + "Error: " + errorThrown + "Response: " + XMLHttpRequest.responseText);
                    }
                    
                } 													

            }); 
        
        };
    });  
    
});