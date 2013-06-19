<?php
add_shortcode('contact-form', 'cscf_ContactForm');
add_shortcode('cscf-contact-form', 'cscf_ContactForm');

function cscf_ContactForm() 
{
    
    $contact = new cscf_Contact;
    $filters = new cscf_Filters;
    
    if ($contact->IsValid()) 
    {
        $filters->fromEmail=$contact->Email;
        $filters->fromName=$contact->Name;
        
        //add filters
        $filters->add('wp_mail_from');
        $filters->add('wp_mail_from_name');
       
        if (wp_mail(cscf_PluginSettings::RecipientEmail() , cscf_PluginSettings::Subject(), $contact->Message)) 
        {
            $view = new CSCF_View('message-sent'); 
            $view->Set('heading',cscf_PluginSettings::SentMessageHeading());
            $view->Set('message',cscf_PluginSettings::SentMessageBody());
        }
        else
        {
            $view = new CSCF_View('message-not-sent');
        }
        
        //remove filters (play nice)
        $filters->remove('wp_mail_from');
        $filters->remove('wp_mail_from_name');
        
        return $view->Render();
    }
  
    //here we need some jquery scripts and styles, so load them here
    if ( cscf_PluginSettings::UseClientValidation() == true) {
        wp_enqueue_script('jquery-validate');
        wp_enqueue_script('jquery-meta');
        wp_enqueue_script('jquery-validate-contact-form');
    }

    //only load the stylesheet if required
    if ( cscf_PluginSettings::LoadStyleSheet() == true)
         wp_enqueue_style('cscf-bootstrap');

    //set-up the view
    if ( $contact->RecaptchaPublicKey<>'' && $contact->RecaptchaPrivateKey<>'') 
        $view = new CSCF_View('contact-form-with-recaptcha'); 
    else
        $view = new CSCF_View('contact-form'); 

    $view->Set('contact',$contact);
    $view->Set('message',cscf_PluginSettings::Message());
    $view->Set('version', CSCF_VERSION_NUM);
    
    return $view->Render();

}



