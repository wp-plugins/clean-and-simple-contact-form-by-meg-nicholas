<!--Clean and Simple Contact Form by Meg Nicholas Version <?php echo $version; ?>-->
<div id="cscf" class="cscfBlock">
    <div class="cscfMessageSent" style="display:none;">
        <?php echo $messageSentView->Render(); ?>
    </div>
    <div class="cscfMessageNotSent" style="display:none;">
        <?php echo $messageNotSentView->Render(); ?>
    </div>
    <div class="cscfForm">
        <p><?php echo $message; ?></p>
        <form id="frmCSCF" name="frmCSCF" method="post">
            <?php wp_nonce_field('cscf_contact','cscf_nonce'); ?>
            
            <?php if (isset($contact->Errors['recaptcha'])) { ?>
                <div class="control-group">
                    <div class="controls">
                    <p class="text-error"><?php echo $contact->Errors['recaptcha']; ?></p>
                    </div>
                </div>            
            <?php } ?>

            <!--email address -->
            <div class="control-group<?php if (isset($contact->Errors['email'])) echo ' error'; ?>">
                <label class="control-label" for="cscf_email"><?php _e('Email Address:','cleanandsimple');?></label>
                <div class="controls">
                    <input class="input-xlarge"
                    data-rule-required="true"
                    data-rule-email="true"
                    data-msg-required="<?php _e('Please give your email address.','cleanandsimple');?>"
                    data-msg-email="<?php _e('Please enter a valid email address.','cleanandsimple');?>"
                    type="email" id="cscf_email" name="cscf[email]" 
                    value="<?php echo $contact->Email; ?>" 
                    placeholder="<?php _e('Your Email Address','cleanandsimple');?>"/>
                    <span class="help-inline"><?php if (isset($contact->Errors['email'])) echo $contact->Errors['email']; ?></span>
                </div>
            </div>

            <!--confirm email address -->
            <div class="control-group<?php if (isset($contact->Errors['confirm-email'])) echo ' error'; ?>">
                <label class="control-label" for="cscf_confirm-email"><?php _e('Confirm Email Address:','cleanandsimple');?></label>
                <div class="controls">
                    <input class="input-xlarge"
                    data-rule-required="true"
                    data-rule-email="true"
                    data-rule-equalTo="#cscf_email"
                    data-msg-required="<?php _e('Please enter the same email address again.','cleanandsimple');?>"
                    data-msg-email="<?php _e('Please enter a valid email address.','cleanandsimple');?>"
                    data-msg-equalTo="<?php _e('Please enter the same email address again.','cleanandsimple');?>"
                    type="email" id="cscf_confirm-email" name="cscf[confirm-email]" 
                    value="<?php echo $contact->ConfirmEmail; ?>" 
                    placeholder="<?php _e('Confirm Your Email Address','cleanandsimple');?>"/>
                    <span class="help-inline"><?php if (isset($contact->Errors['confirm-email'])) echo $contact->Errors['confirm-email']; ?></span>
                </div>
            </div>              

            <!-- name --> 
            <div class="control-group<?php if (isset($contact->Errors['name'])) echo ' error'; ?>">
                 <label class="control-label" for="cscf_name"><?php _e('Name:','cleanandsimple');?></label>
                 <div class="controls">
                    <input class="input-xlarge"
                    data-rule-required="true"
                    data-msg-required="<?php _e('Please give your name.','cleanandsimple');?>"
                    type="text" id="cscf_name" name="cscf[name]" 
                    value="<?php echo $contact->Name; ?>" 
                    placeholder="<?php _e('Your Name','cleanandsimple');?>"/>
                    <span class="help-inline"><?php if (isset($contact->Errors['name'])) echo $contact->Errors['name']; ?></span>
                 </div>
            </div>  

            <!-- message -->
            <div class="control-group<?php if (isset($contact->Errors['message'])) echo ' error'; ?>">
                <label class="control-label" for="cscf_message"><?php _e('Message:','cleanandsimple');?></label>
                <div class="controls">
                    <textarea class="input-xlarge"
                    data-rule-required="true"
                    data-msg-required="<?php _e('Please give a message.','cleanandsimple');?>"
                    id="cscf_message" name="cscf[message]" rows="10" 
                    placeholder="<?php _e('Your Message','cleanandsimple');?>"><?php echo $contact->Message; ?></textarea>
                    <span class="help-inline"><?php if (isset($contact->Errors['message'])) echo $contact->Errors['message']; ?></span>
                </div>
            </div>

            <!-- recaptcha -->
            <?php if ( $contact->RecaptchaPublicKey<>'' && $contact->RecaptchaPrivateKey<>'') { ?>
                <script type="text/javascript">
                 var RecaptchaOptions = {
                    theme : '<?php echo cscf_PluginSettings::Theme(); ?>'
                 };
                 </script>            
                <div class="control-group<?php 
                    if (isset($contact->Errors['recaptcha'])) echo ' error'; ?>">
                        <div id="recaptcha_div" class="controls">
                            <?php echo recaptcha_get_html($contact->RecaptchaPublicKey,null,isset($_SERVER['HTTPS'])); ?>
                        <div for="cscf_recaptcha" class="help-inline"><?php if (isset($contact->Errors['recaptcha'])) echo $contact->Errors['recaptcha']; ?></div> 
                     </div>	
                </div>	
            <?php } ?>     

          <div class="control-group">
            <div class="controls">
                <button type="submit" class="btn"><?php _e('Send Message','cleanandsimple');?></button>
            </div>
          </div>	  
        </form>
    </div>
</div>