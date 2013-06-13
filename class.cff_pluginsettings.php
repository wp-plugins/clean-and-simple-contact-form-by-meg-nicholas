<?php

class cff_PluginSettings
{
    static 
    function UseRecaptcha() 
    {

        /* @var $options type array*/
        $options = get_option('cff_options');
        
        return isset($options['use_recaptcha']) ? true : false;
    }
    static 
    function Theme() 
    {
        $options = get_option('cff_options');
        
        return isset($options['theme']) ? $options['theme'] : 'red';
    }
    static 
    function PublicKey() 
    {
        $options = get_option('cff_options');
        
        return $options['recaptcha_public_key'];
    }
    static 
    function PrivateKey() 
    {
        $options = get_option('cff_options');
        
        return $options['recaptcha_private_key'];
    }
    static 
    function SentMessageHeading() 
    {
        $options = get_option('cff_options');
        
        return isset($options['sent_message_heading']) ? $options['sent_message_heading'] : __('Message Sent','cleanandsimple');
    }
    static 
    function SentMessageBody() 
    {
        $options = get_option('cff_options');
        
        return isset($options['sent_message_body']) ? $options['sent_message_body'] : __('Thank you for your message, we will be in touch very shortly.','cleanandsimple');
    }
    static 
    function Message() 
    {
        $options = get_option('cff_options');
        
        return isset($options['message']) ? $options['message'] : __('Please enter your contact details and a short message below and I will try to answer your query as soon as possible.','cleanandsimple');
    }
    static 
    function LoadStyleSheet() 
    {
        $options = get_option('cff_options');
        
        return isset($options['load_stylesheet']) ? $options['load_stylesheet'] : true;
    }
    static 
    function UseClientValidation() 
    {
        $options = get_option('cff_options');
        
        return isset($options['use_client_validation']) ? $options['use_client_validation'] : true;
    }
    static
    function RecipientEmail() 
    {
        $options = get_option('cff_options');
        
        return isset($options['recipient_email']) ? $options['recipient_email'] : get_bloginfo('admin_email');
    }
    
    static
    function Subject() 
    {
        $options = get_option('cff_options');
        
        return isset($options['subject']) ? $options['subject'] : get_bloginfo('name') . __(' -  Web Enquiry','cleanandsimple');
    }
}

