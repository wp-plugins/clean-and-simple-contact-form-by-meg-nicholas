<?php

/*
 * creates the settings page for the plugin
*/

class cff_settings
{
    public 
    function __construct() 
    {
        
        if (is_admin()) 
        {
            add_action('admin_menu', array(
                $this,
                'add_plugin_page'
            ));
            add_action('admin_init', array(
                $this,
                'page_init'
            ));
        }
    }
    public 
    function add_plugin_page() 
    {

        // This page will be under "Settings"
        add_options_page('Settings Admin', 'Contact Form', 'manage_options', 'contact-form-settings', array(
            $this,
            'create_admin_page'
        ));
    }
    public 
    function create_admin_page() 
    {
?>
	<div class="wrap">
	    <?php screen_icon(); ?>
	    <h2><?php _e('Clean and Simple Contact Form Settings','cleanandsimple');?></h2>
        <hr/>
        <p><?php _e('You are using version','cleanandsimple'); ?> <?php echo CFF_VERSION_NUM;?></p>
        <p><?php _e('If you find this plugin useful please consider','cleanandsimple'); ?> 
            <a  target="_blank"
                href="http://wordpress.org/support/view/plugin-reviews/<?php echo CFF_PLUGIN_NAME; ?>">
                <?php _e('leaving a review', 'cleanandsimple'); ?>
                        </a>
            . <?php _e('Thank you!','cleanandsimple'); ?>
        </p>
	    <form method="post" action="options.php">
	    <?php
        submit_button(); 

        /* This prints out all hidden setting fields*/
        settings_fields('test_option_group');
        do_settings_sections('contact-form-settings');
        
        submit_button();
        ?>
	    </form>
	</div>
	<?php
    }
    public 
    function page_init() 
    {
        add_settings_section('section_recaptcha', '<h3>' . __('ReCAPTCHA Settings','cleanandsimple') . '</h3>', array(
            $this,
            'print_section_info_recaptcha'
        ) , 'contact-form-settings');
        register_setting('test_option_group', 'array_key', array(
            $this,
            'check_form'
        ));
        add_settings_field('use_recaptcha',__('Use reCAPTCHA :','cleanandsimple'), array(
            $this,
            'create_fields'
        ) , 'contact-form-settings', 'section_recaptcha', array(
            'use_recaptcha'
        ));
        add_settings_field('theme',__('reCAPTCHA Theme :','cleanandsimple'), array(
            $this,
            'create_fields'
        ) , 'contact-form-settings', 'section_recaptcha', array(
            'theme'
        ));
        add_settings_field('recaptcha_public_key', __('reCAPTCHA Public Key :','cleanandsimple'), array(
            $this,
            'create_fields'
        ) , 'contact-form-settings', 'section_recaptcha', array(
            'recaptcha_public_key'
        ));
        add_settings_field('recaptcha_private_key',__('reCAPTCHA Private Key :','cleanandsimple'), array(
            $this,
            'create_fields'
        ) , 'contact-form-settings', 'section_recaptcha', array(
            'recaptcha_private_key'
        ));
        add_settings_section('section_message', '<h3>'.__('Message Settings','cleanandsimple').'</h3>', array(
            $this,
            'print_section_info_message'
        ) , 'contact-form-settings');
        add_settings_field('recipient_email', __('Recipient Email :','cleanandsimple'), array(
            $this,
            'create_fields'
        ) , 'contact-form-settings', 'section_message', array(
            'recipient_email'
        ));
        add_settings_field('subject', __('Email Subject :','cleanandsimple'), array(
            $this,
            'create_fields'
        ) , 'contact-form-settings', 'section_message', array(
            'subject'
        ));
        add_settings_field('message', __('Message :','cleanandsimple'), array(
            $this,
            'create_fields'
        ) , 'contact-form-settings', 'section_message', array(
            'message'
        ));
        add_settings_field('sent_message_heading', __('Message Sent Heading :','cleanandsimple'), array(
            $this,
            'create_fields'
        ) , 'contact-form-settings', 'section_message', array(
            'sent_message_heading'
        ));
        add_settings_field('sent_message_body', __('Message Sent Content :','cleanandsimple'), array(
            $this,
            'create_fields'
        ) , 'contact-form-settings', 'section_message', array(
            'sent_message_body'
        ));
        add_settings_section('section_styling', '<h3>'.__('Styling and Validation','cleanandsimple').'</h3>', array(
            $this,
            'print_section_info_styling'
        ) , 'contact-form-settings');
        add_settings_field('load_stylesheet', __('Use the plugin default stylesheet (un-tick to use your theme style sheet instead) :','cleanandsimple'), array(
            $this,
            'create_fields'
        ) , 'contact-form-settings', 'section_styling', array(
            'load_stylesheet'
        ));
        add_settings_field('use_client_validation', __('Use client side validation (AJAX) :','cleanandsimple'), array(
            $this,
            'create_fields'
        ) , 'contact-form-settings', 'section_styling', array(
            'use_client_validation'
        ));
    }
    public 
    function check_form($input) 
    {
        $options = get_option(CFF_OPTIONS_KEY);
        
        //use_recaptcha
        if (isset($input['use_recaptcha'])) 
            $options['use_recaptcha'] = true;
        else
            unset($options['use_recaptcha']);
        
        //recaptcha theme
        if (isset($input['theme'])) $options['theme'] = filter_var($input['theme'], FILTER_SANITIZE_STRING);
        
        //recaptcha_public_key
        if (isset($input['recaptcha_public_key'])) $options['recaptcha_public_key'] = filter_var($input['recaptcha_public_key'], FILTER_SANITIZE_STRING);
        
        //recaptcha_private_key
        if (isset($input['recaptcha_private_key'])) $options['recaptcha_private_key'] = filter_var($input['recaptcha_private_key'], FILTER_SANITIZE_STRING);
        
        //sent_message_heading
        $options['sent_message_heading'] = filter_var($input['sent_message_heading'], FILTER_SANITIZE_STRING);
        
        //sent_message_body
        $options['sent_message_body'] = filter_var($input['sent_message_body'], FILTER_SANITIZE_STRING);
        
        //message
        $options['message'] = filter_var($input['message'], FILTER_SANITIZE_STRING);
        
        //load_stylesheet
        if (isset($input['load_stylesheet'])) 
            $options['load_stylesheet'] = true;
        else 
            $options['load_stylesheet'] = false;
        
        //use_client_validation
        if (isset($input['use_client_validation'])) 
            $options['use_client_validation'] = true;
        else 
            $options['use_client_validation'] = false;
        
        //recipient_email
        if (!filter_var($input['recipient_email'], FILTER_VALIDATE_EMAIL)) {
            unset($options['recipient_email']);
        }
        else {
            $options['recipient_email']=$input['recipient_email'];
        }
        
        //subject
        $options['subject'] = trim(filter_var($input['subject'], FILTER_SANITIZE_STRING));
        if ( empty($options['subject']) ) {
            unset($options['subject']);
        }
        
        //update the options
        update_option(CFF_OPTIONS_KEY, $options);
            
                
        
        return $input;
    }
    public 
    function print_section_info_recaptcha() 
    {
        print __('Enter your reCAPTCHA settings below :','cleanandsimple');
        print "<p>" . __('To use reCAPTCHA you must get an API key from','cleanandsimple')." <a target='_blank' href='https://www.google.com/recaptcha/admin/create'>https://www.google.com/recaptcha/admin/create</a></p>";
    }
    public 
    function print_section_info_message() 
    {
        print __('Enter your message settings below :','cleanandsimple');
    }
    public 
    function print_section_info_styling() 
    {

        //print 'Enter your styling settings below:';
        
    }
    public 
    function create_fields($args) 
    {
        $fieldname = $args[0];
        
        switch ($fieldname) 
        {
        case 'use_recaptcha':
            $checked = cff_PluginSettings::UseRecaptcha() == true ? "checked" : "";
?><input type="checkbox" <?php echo $checked; ?>  id="use_recaptcha" name="array_key[use_recaptcha]"><?php
        break;
        case 'load_stylesheet':
            $checked = cff_PluginSettings::LoadStyleSheet() == true ? "checked" : "";
?><input type="checkbox" <?php echo $checked; ?>  id="load_stylesheet" name="array_key[load_stylesheet]"><?php
        break;
        case 'recaptcha_public_key':
            $disabled = cff_PluginSettings::UseRecaptcha() == false ? "disabled" : "";
?><input <?php echo $disabled; ?> type="text" size="60" id="recaptcha_public_key" name="array_key[recaptcha_public_key]" value="<?=cff_PluginSettings::PublicKey(); ?>" /><?php
        break;
        case 'recaptcha_private_key':
            $disabled = cff_PluginSettings::UseRecaptcha() == false ? "disabled" : "";
?><input <?php echo $disabled; ?> type="text" size="60" id="recaptcha_private_key" name="array_key[recaptcha_private_key]" value="<?=cff_PluginSettings::PrivateKey(); ?>" /><?php
        break;
        case 'recipient_email':
?><input type="text" size="60" id="recipient_email" name="array_key[recipient_email]" value="<?=cff_PluginSettings::RecipientEmail(); ?>" /><?php
        break;
        case 'subject':
?><input type="text" size="60" id="subject" name="array_key[subject]" value="<?=cff_PluginSettings::Subject(); ?>" /><?php
        break;
        case 'sent_message_heading':
?><input type="text" size="60" id="sent_message_heading" name="array_key[sent_message_heading]" value="<?=cff_PluginSettings::SentMessageHeading(); ?>" /><?php
        break;
        case 'sent_message_body':
?><textarea cols="63" rows="8" name="array_key[sent_message_body]"><?=cff_PluginSettings::SentMessageBody(); ?></textarea><?php
        break;
        case 'message':
?><textarea cols="63" rows="8" name="array_key[message]"><?=cff_PluginSettings::Message(); ?></textarea><?php
        break;
        case 'theme':
            $theme = cff_PluginSettings::Theme();
            $disabled = cff_PluginSettings::UseRecaptcha() == false ? "disabled" : "";
?>
                <select <?php echo $disabled; ?> id="array_key[theme]" name="array_key[theme]">
                    <option <?php echo $theme == "red" ? "selected" : ""; ?> value="red"><?php _e('Red', 'cleanandsimple'); ?></option>
                    <option <?php echo $theme == "white" ? "selected" : ""; ?>  value="white"><?php _e('White','cleanandsimple'); ?></option>
                    <option <?php echo $theme == "blackglass" ? "selected" : ""; ?> value="blackglass"><?php _e('Blackglass', 'cleanandsimple'); ?></option>
                    <option <?php echo $theme == "clean" ? "selected" : ""; ?> value="clean"><?php _e('Clean','cleanandsimple'); ?></option>
                </select>        
                <?php
        break;
        case 'use_client_validation':
            $checked = cff_PluginSettings::UseClientValidation() == true ? "checked" : "";
?><input type="checkbox" <?php echo $checked; ?>  id="use_client_validation" name="array_key[use_client_validation]"><?php
        break;
        default:
        break;
        }
    }
}

