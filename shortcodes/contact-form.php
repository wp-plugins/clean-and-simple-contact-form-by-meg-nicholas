<?php
add_shortcode('contact-form', 'cff_ContactForm');

function cff_ContactForm() 
{
    
    $contact = new cff_Contact;
    
    if ($contact->IsValid()) 
    {
        $headers = 'From: "' . $contact->Name . '" <' . $contact->Email . '>';
        
        if (wp_mail(get_bloginfo('admin_email') , get_bloginfo('name') . ' -  Web Enquiry', $contact->Message, $headers)) 
        {
            $view = new CFF_View('message-sent'); 
            $view->Set('heading',cff_PluginSettings::SentMessageHeading());
            $view->Set('message',cff_PluginSettings::SentMessageBody());
        }
        else
        {
            $view = new CFF_View('message-not-sent');
        }
        
        return $view->Render();
    }
  
    //here we need some jquery scripts and styles, so load them here
    if ( cff_PluginSettings::UseClientValidation() == true) {
        wp_enqueue_script('jquery-validate');
        wp_enqueue_script('jquery-meta');
        wp_enqueue_script('jquery-validate-contact-form');
    }

    //only load the stylesheet if required
    if ( cff_PluginSettings::LoadStyleSheet() == true)
         wp_enqueue_style('bootstrap');

    //set-up the view
    if ( $contact->RecaptchaPublicKey<>'' && $contact->RecaptchaPrivateKey<>'') 
        $view = new CFF_View('contact-form-with-recaptcha'); 
    else
        $view = new CFF_View('contact-form'); 

    $view->Set('contact',$contact);
    $view->Set('message',cff_PluginSettings::Message());
    $view->Set('version', CFF_VERSION_NUM);
    
    return $view->Render();

}



