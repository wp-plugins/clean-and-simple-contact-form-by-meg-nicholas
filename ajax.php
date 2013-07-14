<?php 
add_action("wp_ajax_cscf-submitform", "cscfsubmitform");
add_action("wp_ajax_nopriv_cscf-submitform", "cscfsubmitform");

//http://wp.smashingmagazine.com/2011/10/18/how-to-use-ajax-in-wordpress/
function cscfsubmitform() {
    
    $contact = new cscf_Contact;
    
    if ($contact->IsValid()) 
    {
       
        if ( $contact->SendMail() ) 
        {
            $view = new CSCF_View('message-sent'); 
            $view->Set('heading',cscf_PluginSettings::SentMessageHeading());
            $view->Set('message',cscf_PluginSettings::SentMessageBody());
        }
        else
        {
            $view = new CSCF_View('message-not-sent');
        }
        $result['valid']=true;
        $result['sentmsg'] = $view->Render();
        
    }
    else {
        $result['valid']=false;
        $result['errorlist'] = $contact->Errors;
    }
    
	echo json_encode($result);
    die();
}