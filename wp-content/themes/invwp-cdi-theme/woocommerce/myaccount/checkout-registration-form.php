<div class="row">
   <div class="col-5 mx-auto">
      <h4 class="section-title text-center"><strong>CUSTOMER REGISTRATION</strong> REGISTER AND START SAVING</h4>
   </div>
</div>

<div class="row">
   <div class="col-8 mx-auto">
      <p>Registering an account is free, easy, and it allows you to place orders, track your prescriptions, and view your order history. It also keeps your information secure when you order.</p>
      <form id="user-custom-register-form" class=" my-0 form-horizontal" <?php do_action( 'woocommerce_register_form_tag' ); ?>>
         <div class="all-steps" id="all-steps"> <span class="step"></span> <span class="step"></span> <span class="step"></span> <span class="step"></span> </div>
         <?php wp_nonce_field('user_register', 'reg_user_nonce', true, true ); ?>
         <input type="hidden" name="action" value="register_user">
         <!-- Step 1 -->
         <fieldset id="cur-step1" class="registtration-tab">
            <div class="form-group row">
               <div class="col-12">
                  <label>Username <span>*</span></label>
                  <input type="text" class="form-control" name="username" id="username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" placeholder="Username" required="required" />
               </div>
            </div>
            <div class="form-group row">
               <div class="col-4">
                  <label>Shopper First Name <span>*</span></label>
                  <input type="text" class="form-control" name="first_name" id="first_name" autocomplete="first_name" value="<?php echo ( ! empty( $_POST['first_name'] ) ) ? esc_attr( wp_unslash( $_POST['first_name'] ) ) : ''; ?>" placeholder="First Name" /><?php // @codingStandardsIgnoreLine ?>
               </div>
               <div class="col-4">
                  <label>Shopper Middle Name</label>
                  <input type="text" class="form-control" name="middle_name" id="middle_name" autocomplete="middle_name" value="<?php echo ( ! empty( $_POST['middle_name'] ) ) ? esc_attr( wp_unslash( $_POST['middle_name'] ) ) : ''; ?>" placeholder="Middle Name" /><?php // @codingStandardsIgnoreLine ?>
               </div>
               <div class="col-4">
                  <label>Shopper Last Name <span>*</span></label>
                  <input type="text" class="form-control" name="last_name" id="last_name" autocomplete="last_name" value="<?php echo ( ! empty( $_POST['last_name'] ) ) ? esc_attr( wp_unslash( $_POST['last_name'] ) ) : ''; ?>" placeholder="Last Name" /><?php // @codingStandardsIgnoreLine ?>
               </div>
            </div>
            <div class="form-group row">
               <div class="col-12">
                  <label>Email <span>*</span></label>
                  <input type="email" class="form-control" name="email" id="reg_email" autocomplete="email" value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : ''; ?>" placeholder="Email address" />
               </div>
            </div>
            <div class="form-group row">
               <div class="col-12">
                  <label>Confirm Your Email <span>*</span></label>
                  <input type="email" class="form-control" name="confirm_email" id="confirm_email" autocomplete="confirm_email" value="<?php echo ( ! empty( $_POST['confirm_email'] ) ) ? esc_attr( wp_unslash( $_POST['confirm_email'] ) ) : ''; ?>" placeholder="Confirmed Email address" />
               </div>
            </div>
            <div class="form-group row">
               <div class="col-6">
                  <label>Password <span>*</span></label>
                  <input type="password" class="form-control" name="password" id="password" autocomplete="password" value="<?php echo ( ! empty( $_POST['password'] ) ) ? esc_attr( wp_unslash( $_POST['password'] ) ) : ''; ?>" placeholder="Password" /><?php // @codingStandardsIgnoreLine ?>
               </div>
               <div class="col-6">
                  <label>Confirm Password <span>*</span></label>
                  <input type="password" class="form-control" name="confirm_password" id="confirm_password" autocomplete="confirm_password" value="<?php echo ( ! empty( $_POST['confirm_password'] ) ) ? esc_attr( wp_unslash( $_POST['confirm_password'] ) ) : ''; ?>" placeholder="Confirm Password" /><?php // @codingStandardsIgnoreLine ?>
               </div>
            </div>
            <div class="form-group row">
               <div class="col-12">
                  <label>Street Address <span>*</span></label>
                  <input type="text" class="form-control" name="street_address" id="street_address" autocomplete="street_address"
                     value="<?php echo ( ! empty( $_POST['street_address'] ) ) ? esc_attr( wp_unslash( $_POST['street_address'] ) ) : ''; ?>"
                     placeholder="Street Address" /><?php // @codingStandardsIgnoreLine ?>
               </div>
            </div>
            <div class="form-group row">
               <div class="col-6">
                  <label>City <span>*</span></label>
                  <input type="text" class="form-control" name="city" id="city" autocomplete="city" value="<?php echo ( ! empty( $_POST['city'] ) ) ? esc_attr( wp_unslash( $_POST['city'] ) ) : ''; ?>" placeholder="City" />
               </div>
               <div class="col-6">
                  <label>Apt/Suite No</label>
                  <input type="text" class="form-control" name="app_no" id="app_no" autocomplete="app_no" value="<?php echo ( ! empty( $_POST['app_no'] ) ) ? esc_attr( wp_unslash( $_POST['app_no'] ) ) : ''; ?>" placeholder="Apt/Suite No" />
               </div>
            </div>
            <div class="form-group row">
               <div class="col-12">
                  <label>Country <span>*</span></label>
                  <?php
                     woocommerce_form_field('mspa_country_field', array(
                        'type'       => 'country',
                        'class'      => array( 'chzn-drop', 'form-select' ),
                        'id'         => 'mspa_country_field',
                        'placeholder'=> __('Select a Country')
                         )
                     );
                     ?>
               </div>
            </div>
            <div class="form-group row">
               <div class="col-6">
               <label>State <span>*</span></label>
                  <?php
                     woocommerce_form_field('mspa_state_field', array(
                         'type'       => 'state',
                         'class'      => array( 'chzn-drop', 'form-select' ),
                         'id'         => 'mspa_state_field',
                         'placeholder'    => __('Select a State')
                         )
                     );
                     ?>
               </div>
               <div class="col-6">
                  <label>Zip Code <span>*</span></label>
                  <input type="text" class="form-control" name="zipcode" id="zipcode" autocomplete="zipcode" value="<?php echo ( ! empty( $_POST['zipcode'] ) ) ? esc_attr( wp_unslash( $_POST['zipcode'] ) ) : ''; ?>" placeholder="Zip code" />
               </div>
            </div>
            <div class="form-group row">
               <div class="col-6">
                  <label>Phone Number <span>*</span></label>
                <input type="text" class="form-control" name="phone" id="phone" autocomplete="phone" value="<?php echo ( ! empty( $_POST['phone'] ) ) ? esc_attr( wp_unslash( $_POST['phone'] ) ) : ''; ?>" placeholder="123-456-7890" />
               </div>
               <div class="col-6">
                  <label>Fax </label>
                  <input type="text" class="form-control" name="fax" id="fax" autocomplete="fax" value="<?php echo ( ! empty( $_POST['fax'] ) ) ? esc_attr( wp_unslash( $_POST['fax'] ) ) : ''; ?>" placeholder="123-456--7890" />
               </div>
            </div>
            <div class=" form-group row">
               <div class="col-12">
                  <label>How did you hear about us?</label>
                  <select class="hear_about_us form-select" name="hear_about_us" id="hear_about_us" style="background-image: url('<?php echo site_url(); ?>/wp-content/uploads/2021/08/Polygon-5.png');">
                     <option value="0">How did you hear about us?</option>
                     <option value="Friends">Friends</option>
                     <option value="Website">Website</option>
                     <option value="Social Media">Social Media</option>
                     <option value="Other">Other</option>
                  </select>
               </div>
            </div>
         </fieldset>


         <fieldset id="cur-step4" class="checkout-user-register-tab">
            <div class=" form-group row">
               <div class="col-md-12">
                  <div id="terms-wrapper">
                     <h6>Acknowledgement</h6>
                     <label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox">
                     <input type="checkbox" class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox" name="terms_condition" <?php checked( apply_filters( 'woocommerce_terms_is_checked_default', isset( $_POST['terms_condition'] ) ), true ); ?> id="terms_condition" />
                     <span class="primary-colr"><?php printf( __( 'By clicking ‘create account’ you agree to the terms and conditions set out in the customer agreement (including schedule ‘a’) as found here, and you agree, on behalf of yourself, your heirs, successors, administrators and assigns, to be bound by our terms of use.', 'woocommerce' ), esc_url( wc_get_page_permalink( 'terms_condition' ) ) ); ?></span>
                     <span class="required">*</span>
                     </label>
                     <input type="hidden" name="terms-field" value="1" />
                  </div>
               </div>
            </div>
         </fieldset>

         <div class="woocommerce-form-row form-row ">
            <p class=" align-center already-acc-btn">Already have an account? <a href="#customer_login" id="login-action-link"
               class="lato-bold-black-pearl-14px">Log-In</a></p>
            <p>
               <button type="submit" class="woocommerce-Button woocommerce-button button button-block woocommerce-form-register__submit reg-form-submit button-background-blue " name="register" value="<?php esc_attr_e( 'SUBMIT', 'woocommerce' ); ?>"><?php esc_html_e( 'REGISTER', 'woocommerce' ); ?></button>
            </p>
            <p class="status"></p>
         </div>
         <?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
         <div class="thanks-message text-center d-none" id="thanks-message">
           <p><i class="fa fa-ok fa-3x"></i></p>
           <h3>Thanks for your information!</h3> <span>Your information has been saved! we will contact you shortly!</p>
         </div>
     </form>
  </div>
</div>
