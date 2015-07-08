<div id="cscf" class="cscfBlock">
	<div class="cscfMessageSent" style="display:none;">
		<?php echo $messageSentView->Render(); ?>
	</div>
	<div class="cscfMessageNotSent" style="display:none;">
		<?php echo $messageNotSentView->Render(); ?>
	</div>
	<div class="cscfForm">
		<p><?php echo $message; ?></p>

		<form role="form" id="frmCSCF" name="frmCSCF" method="post">
			<?php wp_nonce_field( 'cscf_contact', 'cscf_nonce' ); ?>
			<input type="hidden" name="post-id" value="<?php echo $postID; ?>">

			<?php if ( isset( $contact->Errors['recaptcha'] ) ) { ?>
				<div class="control-group form-group">
					<p class="text-error"><?php echo $contact->Errors['recaptcha']; ?></p>
				</div>
			<?php } ?>

			<!-- name -->
			<div class="control-group form-group<?php if ( isset( $contact->Errors['name'] ) ) {
				echo ' error has-error';
			} ?>">
				<label for="cscf_name"><?php _e( 'Name:', 'cleanandsimple' ); ?></label>


				<div class="<?php echo cscf_PluginSettings::InputIcons() ? "input-group" : ""; ?>">
					<?php if ( cscf_PluginSettings::InputIcons() == true ) { ?>
						<span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
					<?php } ?>
					<input class="form-control input-xlarge"
					       data-rule-required="true"
					       data-msg-required="<?php _e( 'Please give your name.', 'cleanandsimple' ); ?>"
					       type="text" id="cscf_name" name="cscf[name]"
					       value="<?php echo esc_attr( $contact->Name ); ?>"
					       placeholder="<?php _e( 'Your Name', 'cleanandsimple' ); ?>"
						/>
				</div>
                <span for="cscf_name" class="help-inline help-block error"
                      style="display:<?php echo isset( $contact->Errors['name'] ) ? 'block' : 'none'; ?>;">

                    <?php if ( isset( $contact->Errors['name'] ) ) {
	                    echo $contact->Errors['name'];
                    } ?>
                </span>
			</div>


			<!--email address-->
			<div class="control-group form-group<?php if ( isset( $contact->Errors['email'] ) ) {
				echo ' error has-error';
			} ?>">
				<label for="cscf_email"><?php _e( 'Email Address:', 'cleanandsimple' ); ?></label>

				<div class="<?php echo cscf_PluginSettings::InputIcons() ? "input-group" : ""; ?>">
					<?php if ( cscf_PluginSettings::InputIcons() == true ) { ?>
						<span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
					<?php } ?>
					<input class="form-control input-xlarge"
					       data-rule-required="true"
					       data-rule-email="true"
					       data-msg-required="<?php _e( 'Please give your email address.', 'cleanandsimple' ); ?>"
					       data-msg-email="<?php _e( 'Please enter a valid email address.', 'cleanandsimple' ); ?>"
					       type="email" id="cscf_email" name="cscf[email]"
					       value="<?php echo esc_attr( $contact->Email ); ?>"
					       placeholder="<?php _e( 'Your Email Address', 'cleanandsimple' ); ?>"
						/>
				</div>
                <span for="cscf_email" class="help-inline help-block error"
                      style="display:<?php echo isset( $contact->Errors['email'] ) ? 'block' : 'none'; ?>;">
                    <?php if ( isset( $contact->Errors['email'] ) ) {
	                    echo $contact->Errors['email'];
                    } ?>
                </span>
			</div>

			<?php if ( $confirmEmail ) { ?>
				<!--confirm email address -->
				<div class="control-group form-group<?php if ( isset( $contact->Errors['confirm-email'] ) ) {
					echo ' error has-error';
				} ?>">
					<label for="cscf_confirm-email"><?php _e( 'Confirm Email Address:', 'cleanandsimple' ); ?></label>
					<div class="<?php echo cscf_PluginSettings::InputIcons() ? "input-group" : ""; ?>">
						<?php if ( cscf_PluginSettings::InputIcons() == true ) { ?>
							<span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
						<?php } ?>
						<input class="form-control input-xlarge"
						       data-rule-required="true"
						       data-rule-email="true"
						       data-rule-equalTo="#cscf_email"
						       data-msg-required="<?php _e( 'Please enter the same email address again.', 'cleanandsimple' ); ?>"
						       data-msg-email="<?php _e( 'Please enter a valid email address.', 'cleanandsimple' ); ?>"
						       data-msg-equalTo="<?php _e( 'Please enter the same email address again.', 'cleanandsimple' ); ?>"
						       type="email" id="cscf_confirm-email" name="cscf[confirm-email]"
						       value="<?php echo esc_attr( $contact->ConfirmEmail ); ?>"
						       placeholder="<?php _e( 'Confirm Your Email Address', 'cleanandsimple' ); ?>"
							/>
					</div>
                <span for="cscf_confirm-email" class="help-inline help-block error"
                      style="display:<?php echo isset( $contact->Errors['confirm-email'] ) ? 'block' : 'none'; ?>;">
                    <?php if ( isset( $contact->Errors['confirm-email'] ) ) {
	                    echo $contact->Errors['confirm-email'];
                    } ?>
                </span>
				</div>
			<?php } ?>


			<!-- message -->
			<div class="control-group form-group<?php if ( isset( $contact->Errors['message'] ) ) {
				echo ' error has-error';
			} ?>">
				<label for="cscf_message"><?php _e( 'Message:', 'cleanandsimple' ); ?></label>
				<div class="<?php echo cscf_PluginSettings::InputIcons() ? "input-group" : ""; ?>">
					<?php if ( cscf_PluginSettings::InputIcons() == true ) { ?>
						<span class="input-group-addon"><span class="glyphicon glyphicon-comment"></span></span>
					<?php } ?>
					<textarea class="form-control input-xlarge"
					          data-rule-required="true"
					          data-msg-required="<?php _e( 'Please give a message.', 'cleanandsimple' ); ?>"
					          id="cscf_message" name="cscf[message]" rows="10"
					          placeholder="<?php _e( 'Your Message', 'cleanandsimple' ); ?>"><?php echo esc_textarea( $contact->Message ); ?></textarea>
				</div>

					<span for="cscf_message" class="help-inline help-block error"
					      style="display:<?php echo isset( $contact->Errors['message'] ) ? 'block' : 'none'; ?>;">
                    <?php if ( isset( $contact->Errors['message'] ) ) {
	                    echo $contact->Errors['message'];
                    } ?>
                </span>
			</div>

			<?php if ( cscf_PluginSettings::EmailToSender() ) { ?>
				<!-- email to sender -->
				<div class="control-group form-group<?php if ( isset( $contact->Errors['email-sender'] ) ) {
					echo ' error has-error';
				} ?>">
					<label for="cscf_email-sender"><?php _e( 'Send me a copy:', 'cleanandsimple' ); ?></label>
					<div class="<?php echo cscf_PluginSettings::InputIcons() ? "input-group" : ""; ?>">
						<?php if ( cscf_PluginSettings::InputIcons() == true ) { ?>
							<span class="input-group-addon"><span class="glyphicon glyphicon-comment"></span></span>
						<?php } ?>
						<input <?php echo $contact->EmailToSender == true ? 'checked' : ''; ?> type="checkbox"
						                                                                       id="cscf_email-sender"
						                                                                       name="cscf[email-sender]">
					</div>
						<span for="cscf_email-sender" class="help-inline help-block error"
						      style="display:<?php echo isset( $contact->Errors['email-sender'] ) ? 'block' : 'none'; ?>;">
                        <?php if ( isset( $contact->Errors['email-sender'] ) ) {
	                        echo $contact->Errors['email-sender'];
                        } ?>
                    </span>
				</div>
			<?php } ?>

			<!-- recaptcha -->
			<?php if ( $contact->RecaptchaPublicKey <> '' && $contact->RecaptchaPrivateKey <> '' ) { ?>

				<div class="control-group form-group<?php
				if ( isset( $contact->Errors['recaptcha'] ) ) {
					echo ' error has-error';
				} ?>">
					<div id="recaptcha_div">
						<div class="g-recaptcha" data-theme="<?php echo cscf_PluginSettings::Theme(); ?>"
						     data-sitekey="<?php echo $contact->RecaptchaPublicKey; ?>"></div>


						<div for="cscf_recaptcha"
						     class="help-block has-error error"><?php if ( isset( $contact->Errors['recaptcha'] ) ) {
								echo $contact->Errors['recaptcha'];
							} ?></div>


						<noscript>
							<div style="width: 302px; height: 422px;">
								<div style="width: 302px; height: 422px; position: relative;">
									<div style="width: 302px; height: 422px; position: absolute;">
										<iframe
											src="https://www.google.com/recaptcha/api/fallback?k=<?php echo $contact->RecaptchaPublicKey; ?>"
											frameborder="0" scrolling="no"
											style="width: 302px; height:422px; border-style: none;">
										</iframe>
									</div>
									<div style="width: 300px; height: 60px; border-style: none;
                  bottom: 12px; left: 25px; margin: 0px; padding: 0px; right: 25px;
                  background: #f9f9f9; border: 1px solid #c1c1c1; border-radius: 3px;">
        <textarea id="g-recaptcha-response" name="g-recaptcha-response"
                  class="g-recaptcha-response"
                  style="width: 250px; height: 40px; border: 1px solid #c1c1c1;
                         margin: 10px 25px; padding: 0px; resize: none;">
        </textarea>
									</div>
								</div>
							</div>
						</noscript>

					</div>
				</div>
			<?php } ?>
			<input type="submit" class="btn btn-default" value="<?php _e( 'Send Message', 'cleanandsimple' ); ?>"/>
		</form>
	</div>
</div>