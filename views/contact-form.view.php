<p><?php echo $message; ?></p>

<form id="frmCSCF" name="frmCSCF" method="post">

<?php wp_nonce_field('cscf_contact','cscf_nonce'); ?>

<!-- Clean and Simple Contact Form by megnicholas. Version <?php echo $version; ?> -->

  <!--email address -->
  <div class="control-group<?php 
    if (isset($contact->Errors['email'])) echo ' error'; ?>">
     <label class="control-label" for="cscf[email]"><?php _e('Email Address:','cleanandsimple');?></label>
     <div class="controls">
       <input class="input-xlarge {email:true, required:true, messages:{required:'<?php _e('Please give your email address.','cleanandsimple');?>',email:'<?php _e('Please enter a valid email address.','cleanandsimple');?>'}}" type="text" id="email" name="cscf[email]" value="<?php echo $contact->Email; ?>" placeholder="<?php _e('Your Email Address','cleanandsimple');?>">
       <span for="cscf[email]" generated="true" class="help-inline" style=""><?php if (isset($contact->Errors['email'])) echo $contact->Errors['email']; ?></span>
     </div>
  </div>

  <!--confirm email address -->
  <div class="control-group<?php 
    if (isset($contact->Errors['confirm-email'])) echo ' error'; ?>">
     <label class="control-label" for="cscf[confirm-email]"><?php _e('Confirm Email Address:','cleanandsimple');?></label>
     <div class="controls">
       <input class="input-xlarge {email:true, required:true, equalTo:'#email', messages:{equalTo:'<?php _e('Please enter the same email address again.','cleanandsimple');?>',required:'<?php _e('Please enter the same email address again.','cleanandsimple');?>'}}" type="text" id="confirm-email" name="cscf[confirm-email]" value="<?php echo $contact->ConfirmEmail; ?>" placeholder="<?php _e('Confirm Your Email Address','cleanandsimple');?>">
       <span for="cscf[confirm-email]" generated="true" class="help-inline" style=""><?php if (isset($contact->Errors['confirm-email'])) echo $contact->Errors['confirm-email']; ?></span>
     </div>
  </div>              

<!-- name --> 
 <div class="control-group<?php 
    if (isset($contact->Errors['name'])) echo ' error'; ?>">
     <label class="control-label" for="cscf[name]"><?php _e('Name:','cleanandsimple');?></label>
     <div class="controls">
       <input class="input-xlarge {required:true, messages:{required:'<?php _e('Please give your name.','cleanandsimple');?>'}}" type="text" id="name" name="cscf[name]" value="<?php echo $contact->Name; ?>" placeholder="<?php _e('Your Name','cleanandsimple');?>">
       <span for="cscf[name]" generated="true" class="help-inline" style=""><?php if (isset($contact->Errors['name'])) echo $contact->Errors['name']; ?></span>
     </div>
  </div>  

 <!-- message -->
  <div class="control-group<?php 
    if (isset($contact->Errors['message'])) echo ' error'; ?>">
     <label class="control-label" for="cscf[message]"><?php _e('Message:','cleanandsimple');?></label>
     <div class="controls">
       <textarea class="input-xlarge {required:true, messages:{required:'<?php _e('Please give a message.','cleanandsimple');?>'}}" id="message" name="cscf[message]" rows="10" placeholder="<?php _e('Your Message','cleanandsimple');?>"><?php echo $contact->Message; ?></textarea>
       <span for="cscf[message]" generated="true" class="help-inline" style=""><?php if (isset($contact->Errors['message'])) echo $contact->Errors['message']; ?></span>
     </div>
  </div>

  <div class="control-group">
    <div class="controls">
        <button type="submit" class="btn"><?php _e('Send Message','cleanandsimple');?></button>
    </div>
  </div>	  
</form>