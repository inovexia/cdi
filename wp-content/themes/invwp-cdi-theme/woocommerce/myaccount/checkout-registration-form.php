<div class="row">
   <div class="col-5 mx-auto">
      <h2 class="section-title text-center"><strong>CUSTOMER REGISTRATION</strong> REGISTER AND START SAVING</h2>
   </div>
</div>

<div class="row">
   <div class="col-10 mx-auto">
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
                  <input type="text" class="form-control" name="street_address" id="street_address" autocomplete="street_address" value="<?php echo ( ! empty( $_POST['street_address'] ) ) ? esc_attr( wp_unslash( $_POST['street_address'] ) ) : ''; ?>"
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
               <label>State </label>
                  <?php
					/*
                     woocommerce_form_field('mspa_state_field', array(
                         'type'       => 'state',
                         'class'      => array( 'chzn-drop', 'form-select' ),
                         'id'         => 'mspa_state_field',
                         'placeholder'    => __('Select a State')
                         )
                     );
					 */

                     ?>
					<select name="mspa_state_field" id="mspa_state_field" class="chzn-drop form-select">
						<option value="">Select a State</option>
					</select>
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
                  <label>Patient First and Last Name <span>*</span></label>
                  <input type="text" class="form-control" name="patient_name" id="patient_name" autocomplete="patient_name" value="<?php echo ( ! empty( $_POST['patient_name'] ) ) ? esc_attr( wp_unslash( $_POST['patient_name'] ) ) : ''; ?>" placeholder="First and Last name of Prescribed Patient" /><?php // @codingStandardsIgnoreLine ?>
               </div>
               <div class="col-6">
                  <label>Date of Birth <span>*</span></label>
                  <input type="date" id="patient_dob" name="patient_dob">
               </div>
            </div>
            <div class="form-group row">
               <div class="col-6 radio-wrp">
                  <label>Gender <span>*</span></label>
                  <div class="radio-column">
                    <p><label for="patient_gender_male" class="label-radio">Male</label>
                    <input type="radio" id="patient_gender_male" name="patient_gender" value="m" class="input-radio"></p>
                    <p><label for="patient_gender_female" class="label-radio">Female</label>
                    <input type="radio" id="patient_gender_female" name="patient_gender_female" value="f" class="input-radio"></p>
                    <p><label for="patient_gender_other" class="label-radio">Other</label>
                    <input type="radio" id="patient_gender_other" name="patient_gender_other" value="o" class="input-radio"></p>
                  </div>
               </div>
               <div class="col-6">
                  <label>Patient Relationship <span>*</span></label>
                  <select class="" name="patient_relationship">
                    <option value="Shopping for myself" >Shopping for myself</option>
                    <option value="Parent" >Parent</option>
                    <option value="Child" >Child</option>
                    <option value="Spouse" >Spouse</option>
                    <option value="Friend" >Friend</option>
                    <option value="Pet" >Pet</option>
                    <option value="Other" >Other</option>
                  </select>
                  <?php
                     ?>
               </div>
            </div>
            <div class="form-group row">
               <div class="col-12">
                  <label>Species <span>*</span></label>
                  <select class="" name="patient_species">
                    <option value="Human">Human</option>
                    <option value="Canine">Canine</option>
                    <option value="Feline">Feline</option>
                  </select>
                  <?php
                     ?>
               </div>
            </div>
            <div class="form-group row">
               <div class="col-6">
                  <label>Height <span>*</span></label>
                  <select class="" name="patient_height">
                    <option value="" selected disabled>Height*</option>
                    <option value="Animal" >Animal</option>
                    <option value="3′0″ (91.44cm)" >3′0″ (91.44cm)</option>
                    <option value="3′1″ (93.98cm)" >3′1″ (93.98cm)</option>
                    <option value="3′2″ (96.52cm)" >3′2″ (96.52cm)</option>
                    <option value="3′3″ (99.06cm)" >3′3″ (99.06cm)</option>
                    <option value="3′4″ (101.6cm)" >3′4″ (101.6cm)</option>
                    <option value="3′5″ (104.14cm)" >3′5″ (104.14cm)</option>
                    <option value="3′6″ (106.68cm)" >3′6″ (106.68cm)</option>
                    <option value="3′7″ (109.22cm)" >3′7″ (109.22cm)</option>
                    <option value="3′8″ (111.76cm)" >3′8″ (111.76cm)</option>
                    <option value="3′9″ (114.3cm)" >3′9″ (114.3cm)</option>
                    <option value="3′10″ (116.84cm)" >3′10″ (116.84cm)</option>
                    <option value="3′11″ (119.38cm)" >3′11″ (119.38cm)</option>
                    <option value="4′0″ (121.92cm)" >4′0″ (121.92cm)</option>
                    <option value="4′1″ (124.46cm)" >4′1″ (124.46cm)</option>
                    <option value="4′2″ (127cm)" >4′2″ (127cm)</option>
                    <option value="4′3″ (129.54cm)" >4′3″ (129.54cm)</option>
                    <option value="4′4″ (132.08cm)" >4′4″ (132.08cm)</option>
                    <option value="4′5″ (134.62cm)" >4′5″ (134.62cm)</option>
                    <option value="4′6″ (137.16cm)" >4′6″ (137.16cm)</option>
                    <option value="4′7″ (139.7cm)" >4′7″ (139.7cm)</option>
                    <option value="4′8″ (142.24cm)" >4′8″ (142.24cm)</option>
                    <option value="4′9″ (144.78cm)" >4′9″ (144.78cm)</option>
                    <option value="4′10″ (147.32cm)" >4′10″ (147.32cm)</option>
                    <option value="4′11″ (149.86cm)" >4′11″ (149.86cm)</option>
                    <option value="5′0″ (152.4cm)" >5′0″ (152.4cm)</option>
                    <option value="5′1″ (154.94cm)" >5′1″ (154.94cm)</option>
                    <option value="5′2″ (157.48cm)" >5′2″ (157.48cm)</option>
                    <option value="5′3″ (160.02cm)" >5′3″ (160.02cm)</option>
                    <option value="5′4″ (162.56cm)" >5′4″ (162.56cm)</option>
                    <option value="5′5″ (165.1cm)" >5′5″ (165.1cm)</option>
                    <option value="5′6″ (167.64cm)" >5′6″ (167.64cm)</option>
                    <option value="5′7″ (170.18cm)" >5′7″ (170.18cm)</option>
                    <option value="5′8″ (172.72cm)" >5′8″ (172.72cm)</option>
                    <option value="5′9″ (175.26cm)" >5′9″ (175.26cm)</option>
                    <option value="5′10″ (177.8cm)" >5′10″ (177.8cm)</option>
                    <option value="5′11″ (180.34cm)" >5′11″ (180.34cm)</option>
                    <option value="6′0″ (182.88cm)" >6′0″ (182.88cm)</option>
                    <option value="6′1″ (185.42cm)" >6′1″ (185.42cm)</option>
                    <option value="6′2″ (187.96cm)" >6′2″ (187.96cm)</option>
                    <option value="6′3″ (190.5cm)" >6′3″ (190.5cm)</option>
                    <option value="6′4″ (193.04cm)" >6′4″ (193.04cm)</option>
                    <option value="6′5″ (195.58cm)" >6′5″ (195.58cm)</option>
                    <option value="6′6″ (198.12cm)" >6′6″ (198.12cm)</option>
                    <option value="6′7″ (200.66cm)" >6′7″ (200.66cm)</option>
                    <option value="6′8″ (203.2cm)" >6′8″ (203.2cm)</option>
                    <option value="6′9″ (205.74cm)" >6′9″ (205.74cm)</option>
                    <option value="6′10″ (208.28cm)" >6′10″ (208.28cm)</option>
                    <option value="6′11″ (210.82cm)" >6′11″ (210.82cm)</option>
                    <option value="7′0″ (213.36cm)" >7′0″ (213.36cm)</option>
                    <option value="7′1″ (215.9cm)" >7′1″ (215.9cm)</option>
                    <option value="7′2″ (218.44cm)" >7′2″ (218.44cm)</option>
                    <option value="7′3″ (220.98cm)" >7′3″ (220.98cm)</option>
                    <option value="7′4″ (223.52cm)" >7′4″ (223.52cm)</option>
                    <option value="7′5″ (226.06cm)" >7′5″ (226.06cm)</option>
                    <option value="7′6″ (228.6cm)" >7′6″ (228.6cm)</option>
                    <option value="7′7″ (231.14cm)" >7′7″ (231.14cm)</option>
                    <option value="7′8″ (233.68cm)" >7′8″ (233.68cm)</option>
                    <option value="7′9″ (236.22cm)" >7′9″ (236.22cm)</option>
                    <option value="7′10″ (238.76cm)" >7′10″ (238.76cm)</option>
                    <option value="7′11″ (241.3cm)" >7′11″ (241.3cm)</option>
                    <option value="8′0″ (243.84cm)" >8′0″ (243.84cm)</option>
                  </select>
               </div>
               <div class="col-6">
                  <label>Weight <span>*</span></label>
                  <select class="" name="patient_weight">
                    <option value="" selected disabled>Weight*</option>
                    <option value="Animal" >Animal</option>
                    <?php
                      $formula = 2.2;
                      for ($i=30; $i<=300; $i++) {
                        $weight_kg = $i;
                        $weight_lbs = $i * $formula;
                        $weight_lbs = round ($weight_lbs );
                        ?>
                        <option value="<?php echo $weight_kg; ?> kg / <?php echo $weight_lbs; ?> lbs" ><?php echo $weight_kg; ?> kg / <?php echo $weight_lbs; ?> lbs</option>
                        <?php
                      }
                    ?>
                  </select>
                  <?php
                     ?>
               </div>
            </div>
            <div class="form-group row">
               <div class="col-12">
                  <label>Current Medical Conditions – Please list patient’s current medical condition(s) <span>*</span></label>
                  <input type="text" class="form-control" name="patient_conditions" id="patient_conditions" autocomplete="patient_conditions" value="<?php echo ( ! empty( $_POST['patient_conditions'] ) ) ? esc_attr( wp_unslash( $_POST['patient_conditions'] ) ) : ''; ?>" placeholder="" /><?php // @codingStandardsIgnoreLine ?>
               </div>
            </div>
            <div class="form-group row">
               <div class="col-12">
                  <label>Drug Allergies – Please list patient’s allergies and include any necessary comments <span>*</span></label>
                  <input type="text" class="form-control" name="patient_drug_allergies" id="patient_drug_allergies" autocomplete="patient_drug_allergies"
                     value="<?php echo ( ! empty( $_POST['patient_drug_allergies'] ) ) ? esc_attr( wp_unslash( $_POST['patient_drug_allergies'] ) ) : ''; ?>" placeholder="" /><?php // @codingStandardsIgnoreLine ?>
               </div>
            </div>
            <div class="form-group row">
               <div class="col-12">
                  <label>Current Medication – Please list all medications/supplements patient currently takes <span>*</span></label>
                  <input type="text" class="form-control" name="patient_current_medication" id="patient_current_medication" autocomplete="patient_current_medication"
                     value="<?php echo ( ! empty( $_POST['patient_current_medication'] ) ) ? esc_attr( wp_unslash( $_POST['patient_current_medication'] ) ) : ''; ?>" placeholder="" /><?php // @codingStandardsIgnoreLine ?>
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
            <p>
               <button type="submit" class="woocommerce-Button woocommerce-button button button-block woocommerce-form-register__submit reg-form-submit button-background-blue " name="register" value="<?php esc_attr_e( 'SUBMIT', 'woocommerce' ); ?>"><?php esc_html_e( 'REGISTER', 'woocommerce' ); ?></button>
            </p>
            <p class="status"></p>
            <p class=" align-center already-acc-btn">Already have an account? <a href="" data-target="login-modal" data-toggle="modal" style="cursor:pointer;"
                            data-signin="login">Log-In</a></p>
         </div>

         <?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
         <div class="thanks-message text-center d-none" id="thanks-message">
           <p><i class="fa fa-ok fa-3x"></i></p>
           <h3>Thanks for your information!</h3> <span>Your information has been saved! we will contact you shortly!</p>
         </div>
     </form>
  </div>
</div>
