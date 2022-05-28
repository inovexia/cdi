<?php
   /**
   * Template Name: Registration
   *
   * @package WordPress
   * @subpackage Inovexia_Ecomm_Theme
   * @since 2021
   */
   
   get_header();
   ?>
<main id="primary" class="site-main">
   <div class="content">
      <section class="registration-section section-margin section-padding">
         <div class="container">
            <div class="row">
               <div class="col-5 mx-auto">
                  <h2 class="section-title text-center"><strong>CUSTOMER REGISTRATION</strong> REGISTER AND START SAVING</h2>
               </div>
            </div>
            <div class="row">
               <div class="col-8 mx-auto">
                  <p>Registering an account is free, easy, and it allows you to place orders, track your prescriptions, and view your order history. It also keeps your information secure when you order.</p>
                  <form id="registration-form-wrp" class=" my-0 form-horizontal" <?php do_action( 'woocommerce_register_form_tag' ); ?>>
                     <div class="all-steps" id="all-steps"> <span class="step"></span> <span class="step"></span> <span class="step"></span> <span class="step"></span> </div>
                     <?php wp_nonce_field('user_register', 'reg_user_nonce', true, true ); ?>
                     <input type="hidden" name="action" value="register_user">
                     <!-- Step 1 -->
                     <fieldset id="cur-step1" class="registtration-tab">
                        <div class="form-group row">
                           <div class="col-12">
                              <label>Username <span>*</span></label>
                              <input type="text" class="form-control" name="username" id="reg_username" autocomplete="username"
                                 value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" placeholder="Username" required="required" />
                           </div>
                        </div>
                        <div class="form-group row">
                           <div class="col-4">
                              <label>Shopper First Name <span>*</span></label>
                              <input type="text" class="form-control" name="shopper_first_name" id="reg_first_name" autocomplete="shopper_first_name"
                                 value="<?php echo ( ! empty( $_POST['shopper_first_name'] ) ) ? esc_attr( wp_unslash( $_POST['shopper_first_name'] ) ) : ''; ?>" placeholder="First Name" /><?php // @codingStandardsIgnoreLine ?>
                           </div>
                           <div class="col-4">
                              <label>Shopper Middle Name</label>
                              <input type="text" class="form-control" name="shopper_middle_name" id="reg_last_name" autocomplete="shopper_middle_name"
                                 value="<?php echo ( ! empty( $_POST['shopper_middle_name'] ) ) ? esc_attr( wp_unslash( $_POST['shopper_middle_name'] ) ) : ''; ?>" placeholder="Middle Name" /><?php // @codingStandardsIgnoreLine ?>
                           </div>
                           <div class="col-4">
                              <label>Shopper Last Name <span>*</span></label>
                              <input type="text" class="form-control" name="shopper_last_name" id="reg_last_name" autocomplete="shopper_last_name"
                                 value="<?php echo ( ! empty( $_POST['shopper_last_name'] ) ) ? esc_attr( wp_unslash( $_POST['shopper_last_name'] ) ) : ''; ?>" placeholder="Last Name" /><?php // @codingStandardsIgnoreLine ?>
                           </div>
                        </div>
                        <div class="form-group row">
                           <div class="col-12">
                              <label>Email <span>*</span></label>
                              <input type="email" class="form-control" name="email" id="reg_email" autocomplete="email"
                                 value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : ''; ?>" placeholder="Email address" />
                           </div>
                        </div>
                        <div class="form-group row">
                           <div class="col-12">
                              <label>Confirm Your Email <span>*</span></label>
                              <input type="email" class="form-control" name="confirm_email" id="reg_email" autocomplete="confirm_email"
                                 value="<?php echo ( ! empty( $_POST['confirm_email'] ) ) ? esc_attr( wp_unslash( $_POST['confirm_email'] ) ) : ''; ?>" placeholder="Confirmed Email address" />
                           </div>
                        </div>
                        <div class="form-group row">
                           <div class="col-6">
                              <label>Password <span>*</span></label>
                              <input type="text" class="form-control" name="password" id="reg_first_name" autocomplete="password"
                                 value="<?php echo ( ! empty( $_POST['password'] ) ) ? esc_attr( wp_unslash( $_POST['password'] ) ) : ''; ?>" placeholder="Password" /><?php // @codingStandardsIgnoreLine ?>
                           </div>
                           <div class="col-6">
                              <label>Confirm Password <span>*</span></label>
                              <input type="text" class="form-control" name="confirm_password" id="reg_last_name" autocomplete="confirm_password"
                                 value="<?php echo ( ! empty( $_POST['confirm_password'] ) ) ? esc_attr( wp_unslash( $_POST['confirm_password'] ) ) : ''; ?>" placeholder="Confirm Password" /><?php // @codingStandardsIgnoreLine ?>
                           </div>
                        </div>
                        <div class="form-group row">
                           <div class="col-12">
                              <label>Street Address <span>*</span></label>
                              <input type="text" class="form-control" name="street_address" id="reg_address" autocomplete="street_address"
                                 value="<?php echo ( ! empty( $_POST['street_address'] ) ) ? esc_attr( wp_unslash( $_POST['street_address'] ) ) : ''; ?>"
                                 placeholder="Street Address" /><?php // @codingStandardsIgnoreLine ?>
                           </div>
                        </div>
                        <div class="form-group row">
                           <div class="col-6">
                              <label>City <span>*</span></label>
                              <input type="text" class="form-control" name="city" id="reg_city" autocomplete="city"
                                 value="<?php echo ( ! empty( $_POST['city'] ) ) ? esc_attr( wp_unslash( $_POST['city'] ) ) : ''; ?>" placeholder="City" />
                           </div>
                           <div class="col-6">
                              <label>Apt/Suite No</label>
                              <input type="text" class="form-control" name="app_no" id="reg_city" autocomplete="app_no"
                                 value="<?php echo ( ! empty( $_POST['app_no'] ) ) ? esc_attr( wp_unslash( $_POST['app_no'] ) ) : ''; ?>" placeholder="Apt/Suite No" />
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
                              <input type="text" class="form-control" name="zipcode" id="reg_zipcode" autocomplete="zipcode"
                                 value="<?php echo ( ! empty( $_POST['zipcode'] ) ) ? esc_attr( wp_unslash( $_POST['zipcode'] ) ) : ''; ?>" placeholder="Zip code" />
                           </div>
                        </div>
                        <div class="form-group row">
                           <div class="col-6">
                              <label>Phone Number <span>*</span></label>
                              <input type="email" class="form-control" name="shopper_phone" id="reg_email" autocomplete="shopper_phone"
                                 value="<?php echo ( ! empty( $_POST['shopper_phone'] ) ) ? esc_attr( wp_unslash( $_POST['shopper_phone'] ) ) : ''; ?>" placeholder="" />
                           </div>
                           <div class="col-6">
                              <label>Fax </label>
                              <input type="email" class="form-control" name="shopper-fax" id="reg_email" autocomplete="shopper-fax"
                                 value="<?php echo ( ! empty( $_POST['shopper-fax'] ) ) ? esc_attr( wp_unslash( $_POST['shopper-fax'] ) ) : ''; ?>" placeholder="" />
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
                     <div>
                        <h3>Patient Medical Questionnaire</h3>
                        <p>In order to safely review your order, we require information about the prescribed patient.</p>
                        <p>If you are ordering for yourself, please provide your information.</p>
                        <p>If you are ordering for a family member or pet, please answer these questions on their behalf.</p>
                     </div>
                     <!-- Step 2 -->
                     <fieldset id="cur-step2" class="registtration-tab">
                        <div class="form-group row">
                           <div class="col-6">
                              <label>Patient First and Name <span>*</span></label>
                              <input type="text" class="form-control" name="patient_first_name" id="reg_first_name" autocomplete="patient_first_name"
                                 value="<?php echo ( ! empty( $_POST['patient_first_name'] ) ) ? esc_attr( wp_unslash( $_POST['patient_first_name'] ) ) : ''; ?>" placeholder="First and Last name of Prescribed Patient" /><?php // @codingStandardsIgnoreLine ?>
                           </div>
                           <div class="col-6">
                              <label>Date of Birth <span>*</span></label>
                              <input type="date" id="birthday" name="date_of_birth">
                           </div>
                        </div>
                        <div class="form-group row">
                           <div class="col-6 radio-wrp">
                              <label>Gender <span>*</span></label>
                              <div class="radio-column">
                              <p><label for="patient_male" class="label-radio">Male</label>
                              <input type="radio" id="patient_male" name="patient_male" value="HTML" class="input-radio"></p>
                              <p><label for="patient_female" class="label-radio">Female</label>
                              <input type="radio" id="css" name="patient_female" value="CSS" class="input-radio"></p>
                              <p><label for="patient_other" class="label-radio">Other</label>
                              <input type="radio" id="javascript" name="patient_other" value="JavaScript" class="input-radio"></p>
                              </div>
                              
                              
                           </div>
                           <div class="col-6">
                              <label>Patient Relationship <span>*</span></label>
                              <?php
                                 ?>
                           </div>
                        </div>
                        <div class="form-group row">
                           <div class="col-12">
                              <label>Species <span>*</span></label>
                              <?php
                                 ?>
                           </div>
                        </div>
                        <div class="form-group row">
                           <div class="col-6">
                              <label>Height <span>*</span></label>
                              <?php
                                 ?>
                           </div>
                           <div class="col-6">
                              <label>Weight <span>*</span></label>
                              <?php
                                 ?>
                           </div>
                        </div>
                        <div class="form-group row">
                           <div class="col-12">
                              <label>Current Medical Conditions – Please list patient’s current medical condition(s) <span>*</span></label>
                              <input type="text" class="form-control" name="Conditions" id="reg_first_name" autocomplete="Conditions"
                                 value="<?php echo ( ! empty( $_POST['Conditions'] ) ) ? esc_attr( wp_unslash( $_POST['Conditions'] ) ) : ''; ?>" placeholder="" /><?php // @codingStandardsIgnoreLine ?>
                           </div>
                        </div>
                        <div class="form-group row">
                           <div class="col-12">
                              <label>Drug Allergies – Please list patient’s allergies and include any necessary comments <span>*</span></label>
                              <input type="text" class="form-control" name="drug" id="reg_first_name" autocomplete="drug"
                                 value="<?php echo ( ! empty( $_POST['drug'] ) ) ? esc_attr( wp_unslash( $_POST['drug'] ) ) : ''; ?>" placeholder="" /><?php // @codingStandardsIgnoreLine ?>
                           </div>
                        </div>
                        <div class="form-group row">
                           <div class="col-12">
                              <label>Current Medication – Please list all medications/supplements patient currently takes <span>*</span></label>
                              <input type="text" class="form-control" name="current_medicine" id="reg_first_name" autocomplete="current_medicine"
                                 value="<?php echo ( ! empty( $_POST['current_medicine'] ) ) ? esc_attr( wp_unslash( $_POST['current_medicine'] ) ) : ''; ?>" placeholder="" /><?php // @codingStandardsIgnoreLine ?>
                           </div>
                        </div>
                     </fieldset>
                     <h3>Doctor's Information</h3>
                     <fieldset id="cur-step3" class="registtration-tab">
                        <div class="form-group row">
                           <div class="col-6">
                              <label> First Name <span>*</span></label>
                              <input type="text" class="form-control" name="doctor_first_name" id="reg_first_name" autocomplete="doctor_first_name"
                                 value="<?php echo ( ! empty( $_POST['doctor_first_name'] ) ) ? esc_attr( wp_unslash( $_POST['doctor_first_name'] ) ) : ''; ?>" placeholder="First Name" /><?php // @codingStandardsIgnoreLine ?>
                           </div>
                           <div class="col-6">
                              <label> Last Name <span>*</span></label>
                              <input type="text" class="form-control" name="doctor_last_name" id="reg_last_name" autocomplete="doctor_last_name"
                                 value="<?php echo ( ! empty( $_POST['doctor_last_name'] ) ) ? esc_attr( wp_unslash( $_POST['doctor_last_name'] ) ) : ''; ?>" placeholder="Last Name" /><?php // @codingStandardsIgnoreLine ?>
                           </div>
                        </div>
                        <div class="form-group row">
                           <div class="col-12">
                              <label>Phone Number <span>*</span></label>
                              <input type="email" class="form-control" name="dr_phone" id="reg_email" autocomplete="dr_phone"
                                 value="<?php echo ( ! empty( $_POST['dr_phone'] ) ) ? esc_attr( wp_unslash( $_POST['dr_phone'] ) ) : ''; ?>" placeholder="" />
                           </div>
                        </div>
                        <div class="form-group row">
                           <div class="col-12">
                              <label>Clinic Name</label>
                              <input type="email" class="form-control" name="clinic_name" id="reg_email" autocomplete="clinic_name"
                                 value="<?php echo ( ! empty( $_POST['clinic_name'] ) ) ? esc_attr( wp_unslash( $_POST['clinic_name'] ) ) : ''; ?>" placeholder="Clinic Name" />
                           </div>
                        </div>
                        <div class="form-group row">
                           <div class="col-12">
                              <label>Clinic Address</label>
                              <input type="email" class="form-control" name="clinic_address" id="reg_email" autocomplete="clinic_address"
                                 value="<?php echo ( ! empty( $_POST['clinic_address'] ) ) ? esc_attr( wp_unslash( $_POST['clinic_address'] ) ) : ''; ?>" placeholder="Clinic Address" />
                           </div>
                        </div>
                        <div class="form-group row">
                           <div class="col-6">
                              <label>City</label>
                              <input type="text" class="form-control" name="dr_city" id="reg_city" autocomplete="dr_city"
                                 value="<?php echo ( ! empty( $_POST['dr_city'] ) ) ? esc_attr( wp_unslash( $_POST['dr_city'] ) ) : ''; ?>" placeholder="City" />
                           </div>
                           <div class="col-6">
                              <label>Apt/Suite No </label>
                              <input type="text" class="form-control" name="dr_app_no" id="reg_city" autocomplete="dr_app_no"
                                 value="<?php echo ( ! empty( $_POST['dr_app_no'] ) ) ? esc_attr( wp_unslash( $_POST['dr_app_no'] ) ) : ''; ?>" placeholder="Apt/Suite No" />
                           </div>
                        </div>
                        <div class="form-group row">
                           <div class="col-12">
                              <label>Country</label>
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
                           <label>State</label>
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
                           <label>Zip Code</label>
                              <input type="text" class="form-control" name="dr_zipcode" id="reg_zipcode" autocomplete="dr_zipcode"
                                 value="<?php echo ( ! empty( $_POST['dr_zipcode'] ) ) ? esc_attr( wp_unslash( $_POST['dr_zipcode'] ) ) : ''; ?>" placeholder="Zip code" />
                           </div>
                        </div>
                     </fieldset>
                     <fieldset id="cur-step4" class="checkout-user-register-tab">
                        <div class=" form-group row">
                           <div class="col-md-12">
                              <div id="terms-wrapper">
                                 <label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox">
                                 <input type="checkbox" class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox" name="terms_condition"
                                    <?php checked( apply_filters( 'woocommerce_terms_is_checked_default', isset( $_POST['terms_condition'] ) ), true ); ?> id="terms_condition" /> <span
                                    class="primary-colr"><?php printf( __( 'Acknowledgment *
                                    By clicking ‘create account’ you agree to the terms and conditions set out in the customer agreement (including schedule ‘a’) as found here, and you agree, on behalf of yourself, your heirs, successors, administrators and assigns, to be bound by our terms of use.', 'woocommerce' ), esc_url( wc_get_page_permalink( 'terms_condition' ) ) ); ?></span>
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
                           <button type="submit" class="woocommerce-Button woocommerce-button button woocommerce-form-register__submit reg-form-submit button-background-blue " name="register"
                              value="<?php esc_attr_e( 'SUBMIT', 'woocommerce' ); ?>"><?php esc_html_e( 'REGISTER', 'woocommerce' ); ?></button>
                        </p>
                        <p class="status"></p>
                     </div>
                     <?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
               </div>
               <div class="thanks-message text-center d-none" id="thanks-message">
               <p><i class="fa fa-ok fa-3x"></i></p>
               <h3>Thanks for your information!</h3> <span>Your information has been saved! we will contact you shortly!</p>
               </div>
               </form>
            </div>
         </div>
   </div>
   </section>
   </div>
</main>
<!-- #main -->
<?php get_footer(); ?>