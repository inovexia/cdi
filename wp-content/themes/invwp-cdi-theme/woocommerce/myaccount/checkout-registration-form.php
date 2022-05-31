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
                    <option value="" selected disabled>Weight*</option><option value="Animal" >Animal</option><option value="30 kg / 66 lbs" >30 kg / 66 lbs</option><option value="31 kg / 68 lbs" >31 kg / 68 lbs</option><option value="32 kg / 70 lbs" >32 kg / 70 lbs</option><option value="33 kg / 72 lbs" >33 kg / 72 lbs</option><option value="34 kg / 74 lbs" >34 kg / 74 lbs</option><option value="35 kg / 77 lbs" >35 kg / 77 lbs</option><option value="36 kg / 79 lbs" >36 kg / 79 lbs</option><option value="37 kg / 81 lbs" >37 kg / 81 lbs</option><option value="38 kg / 83 lbs" >38 kg / 83 lbs</option><option value="39 kg / 85 lbs" >39 kg / 85 lbs</option><option value="40 kg / 88 lbs" >40 kg / 88 lbs</option><option value="41 kg / 90 lbs" >41 kg / 90 lbs</option><option value="42 kg / 92 lbs" >42 kg / 92 lbs</option><option value="43 kg / 94 lbs" >43 kg / 94 lbs</option><option value="44 kg / 97 lbs" >44 kg / 97 lbs</option><option value="45 kg / 99 lbs" >45 kg / 99 lbs</option><option value="46 kg / 101 lbs" >46 kg / 101 lbs</option><option value="47 kg / 103 lbs" >47 kg / 103 lbs</option><option value="48 kg / 105 lbs" >48 kg / 105 lbs</option><option value="49 kg / 108 lbs" >49 kg / 108 lbs</option><option value="50 kg / 110 lbs" >50 kg / 110 lbs</option><option value="51 kg / 112 lbs" >51 kg / 112 lbs</option><option value="52 kg / 114 lbs" >52 kg / 114 lbs</option><option value="53 kg / 116 lbs" >53 kg / 116 lbs</option><option value="54 kg / 119 lbs" >54 kg / 119 lbs</option><option value="55 kg / 121 lbs" >55 kg / 121 lbs</option><option value="56 kg / 123 lbs" >56 kg / 123 lbs</option><option value="57 kg / 125 lbs" >57 kg / 125 lbs</option><option value="58 kg / 127 lbs" >58 kg / 127 lbs</option><option value="59 kg / 130 lbs" >59 kg / 130 lbs</option><option value="60 kg / 132 lbs" >60 kg / 132 lbs</option><option value="61 kg / 134 lbs" >61 kg / 134 lbs</option><option value="62 kg / 136 lbs" >62 kg / 136 lbs</option><option value="63 kg / 138 lbs" >63 kg / 138 lbs</option><option value="64 kg / 141 lbs" >64 kg / 141 lbs</option><option value="65 kg / 143 lbs" >65 kg / 143 lbs</option><option value="66 kg / 145 lbs" >66 kg / 145 lbs</option><option value="67 kg / 147 lbs" >67 kg / 147 lbs</option><option value="68 kg / 149 lbs" >68 kg / 149 lbs</option><option value="69 kg / 152 lbs" >69 kg / 152 lbs</option><option value="70 kg / 154 lbs" >70 kg / 154 lbs</option><option value="71 kg / 156 lbs" >71 kg / 156 lbs</option><option value="72 kg / 158 lbs" >72 kg / 158 lbs</option><option value="73 kg / 160 lbs" >73 kg / 160 lbs</option><option value="74 kg / 163 lbs" >74 kg / 163 lbs</option><option value="75 kg / 165 lbs" >75 kg / 165 lbs</option><option value="76 kg / 167 lbs" >76 kg / 167 lbs</option><option value="77 kg / 169 lbs" >77 kg / 169 lbs</option><option value="78 kg / 171 lbs" >78 kg / 171 lbs</option><option value="79 kg / 174 lbs" >79 kg / 174 lbs</option><option value="80 kg / 176 lbs" >80 kg / 176 lbs</option><option value="81 kg / 178 lbs" >81 kg / 178 lbs</option><option value="82 kg / 180 lbs" >82 kg / 180 lbs</option><option value="83 kg / 183 lbs" >83 kg / 183 lbs</option><option value="84 kg / 185 lbs" >84 kg / 185 lbs</option><option value="85 kg / 187 lbs" >85 kg / 187 lbs</option><option value="86 kg / 189 lbs" >86 kg / 189 lbs</option><option value="87 kg / 191 lbs" >87 kg / 191 lbs</option><option value="88 kg / 194 lbs" >88 kg / 194 lbs</option><option value="89 kg / 196 lbs" >89 kg / 196 lbs</option><option value="90 kg / 198 lbs" >90 kg / 198 lbs</option><option value="91 kg / 200 lbs" >91 kg / 200 lbs</option><option value="92 kg / 202 lbs" >92 kg / 202 lbs</option><option value="93 kg / 205 lbs" >93 kg / 205 lbs</option><option value="94 kg / 207 lbs" >94 kg / 207 lbs</option><option value="95 kg / 209 lbs" >95 kg / 209 lbs</option><option value="96 kg / 211 lbs" >96 kg / 211 lbs</option><option value="97 kg / 213 lbs" >97 kg / 213 lbs</option><option value="98 kg / 216 lbs" >98 kg / 216 lbs</option><option value="99 kg / 218 lbs" >99 kg / 218 lbs</option><option value="100 kg / 220 lbs" >100 kg / 220 lbs</option><option value="101 kg / 222 lbs" >101 kg / 222 lbs</option><option value="102 kg / 224 lbs" >102 kg / 224 lbs</option><option value="103 kg / 227 lbs" >103 kg / 227 lbs</option><option value="104 kg / 229 lbs" >104 kg / 229 lbs</option><option value="105 kg / 231 lbs" >105 kg / 231 lbs</option><option value="106 kg / 233 lbs" >106 kg / 233 lbs</option><option value="107 kg / 235 lbs" >107 kg / 235 lbs</option><option value="108 kg / 238 lbs" >108 kg / 238 lbs</option><option value="109 kg / 240 lbs" >109 kg / 240 lbs</option><option value="110 kg / 242 lbs" >110 kg / 242 lbs</option><option value="111 kg / 244 lbs" >111 kg / 244 lbs</option><option value="112 kg / 246 lbs" >112 kg / 246 lbs</option><option value="113 kg / 249 lbs" >113 kg / 249 lbs</option><option value="114 kg / 251 lbs" >114 kg / 251 lbs</option><option value="115 kg / 253 lbs" >115 kg / 253 lbs</option><option value="116 kg / 255 lbs" >116 kg / 255 lbs</option><option value="117 kg / 257 lbs" >117 kg / 257 lbs</option><option value="118 kg / 260 lbs" >118 kg / 260 lbs</option><option value="119 kg / 262 lbs" >119 kg / 262 lbs</option><option value="120 kg / 264 lbs" >120 kg / 264 lbs</option><option value="121 kg / 266 lbs" >121 kg / 266 lbs</option><option value="122 kg / 269 lbs" >122 kg / 269 lbs</option><option value="123 kg / 271 lbs" >123 kg / 271 lbs</option><option value="124 kg / 273 lbs" >124 kg / 273 lbs</option><option value="125 kg / 275 lbs" >125 kg / 275 lbs</option><option value="126 kg / 277 lbs" >126 kg / 277 lbs</option><option value="127 kg / 280 lbs" >127 kg / 280 lbs</option><option value="128 kg / 282 lbs" >128 kg / 282 lbs</option><option value="129 kg / 284 lbs" >129 kg / 284 lbs</option><option value="130 kg / 286 lbs" >130 kg / 286 lbs</option><option value="131 kg / 288 lbs" >131 kg / 288 lbs</option><option value="132 kg / 291 lbs" >132 kg / 291 lbs</option><option value="133 kg / 293 lbs" >133 kg / 293 lbs</option><option value="134 kg / 295 lbs" >134 kg / 295 lbs</option><option value="135 kg / 297 lbs" >135 kg / 297 lbs</option><option value="136 kg / 299 lbs" >136 kg / 299 lbs</option><option value="137 kg / 302 lbs" >137 kg / 302 lbs</option><option value="138 kg / 304 lbs" >138 kg / 304 lbs</option><option value="139 kg / 306 lbs" >139 kg / 306 lbs</option><option value="140 kg / 308 lbs" >140 kg / 308 lbs</option><option value="141 kg / 310 lbs" >141 kg / 310 lbs</option><option value="142 kg / 313 lbs" >142 kg / 313 lbs</option><option value="143 kg / 315 lbs" >143 kg / 315 lbs</option><option value="144 kg / 317 lbs" >144 kg / 317 lbs</option><option value="145 kg / 319 lbs" >145 kg / 319 lbs</option><option value="146 kg / 321 lbs" >146 kg / 321 lbs</option><option value="147 kg / 324 lbs" >147 kg / 324 lbs</option><option value="148 kg / 326 lbs" >148 kg / 326 lbs</option><option value="149 kg / 328 lbs" >149 kg / 328 lbs</option><option value="150 kg / 330 lbs" >150 kg / 330 lbs</option><option value="151 kg / 332 lbs" >151 kg / 332 lbs</option><option value="152 kg / 335 lbs" >152 kg / 335 lbs</option><option value="153 kg / 337 lbs" >153 kg / 337 lbs</option><option value="154 kg / 339 lbs" >154 kg / 339 lbs</option><option value="155 kg / 341 lbs" >155 kg / 341 lbs</option><option value="156 kg / 343 lbs" >156 kg / 343 lbs</option><option value="157 kg / 346 lbs" >157 kg / 346 lbs</option><option value="158 kg / 348 lbs" >158 kg / 348 lbs</option><option value="159 kg / 350 lbs" >159 kg / 350 lbs</option><option value="160 kg / 352 lbs" >160 kg / 352 lbs</option><option value="161 kg / 355 lbs" >161 kg / 355 lbs</option><option value="162 kg / 357 lbs" >162 kg / 357 lbs</option><option value="163 kg / 359 lbs" >163 kg / 359 lbs</option><option value="164 kg / 361 lbs" >164 kg / 361 lbs</option><option value="165 kg / 363 lbs" >165 kg / 363 lbs</option><option value="166 kg / 366 lbs" >166 kg / 366 lbs</option><option value="167 kg / 368 lbs" >167 kg / 368 lbs</option><option value="168 kg / 370 lbs" >168 kg / 370 lbs</option><option value="169 kg / 372 lbs" >169 kg / 372 lbs</option><option value="170 kg / 374 lbs" >170 kg / 374 lbs</option><option value="171 kg / 377 lbs" >171 kg / 377 lbs</option><option value="172 kg / 379 lbs" >172 kg / 379 lbs</option><option value="173 kg / 381 lbs" >173 kg / 381 lbs</option><option value="174 kg / 383 lbs" >174 kg / 383 lbs</option><option value="175 kg / 385 lbs" >175 kg / 385 lbs</option><option value="176 kg / 388 lbs" >176 kg / 388 lbs</option><option value="177 kg / 390 lbs" >177 kg / 390 lbs</option><option value="178 kg / 392 lbs" >178 kg / 392 lbs</option><option value="179 kg / 394 lbs" >179 kg / 394 lbs</option><option value="180 kg / 396 lbs" >180 kg / 396 lbs</option><option value="181 kg / 399 lbs" >181 kg / 399 lbs</option><option value="182 kg / 401 lbs" >182 kg / 401 lbs</option><option value="183 kg / 403 lbs" >183 kg / 403 lbs</option><option value="184 kg / 405 lbs" >184 kg / 405 lbs</option><option value="185 kg / 407 lbs" >185 kg / 407 lbs</option><option value="186 kg / 410 lbs" >186 kg / 410 lbs</option><option value="187 kg / 412 lbs" >187 kg / 412 lbs</option><option value="188 kg / 414 lbs" >188 kg / 414 lbs</option><option value="189 kg / 416 lbs" >189 kg / 416 lbs</option><option value="190 kg / 418 lbs" >190 kg / 418 lbs</option><option value="191 kg / 421 lbs" >191 kg / 421 lbs</option><option value="192 kg / 423 lbs" >192 kg / 423 lbs</option><option value="193 kg / 425 lbs" >193 kg / 425 lbs</option><option value="194 kg / 427 lbs" >194 kg / 427 lbs</option><option value="195 kg / 429 lbs" >195 kg / 429 lbs</option><option value="196 kg / 432 lbs" >196 kg / 432 lbs</option><option value="197 kg / 434 lbs" >197 kg / 434 lbs</option><option value="198 kg / 436 lbs" >198 kg / 436 lbs</option><option value="199 kg / 438 lbs" >199 kg / 438 lbs</option><option value="200 kg / 441 lbs" >200 kg / 441 lbs</option><option value="201 kg / 443 lbs" >201 kg / 443 lbs</option><option value="202 kg / 445 lbs" >202 kg / 445 lbs</option><option value="203 kg / 447 lbs" >203 kg / 447 lbs</option><option value="204 kg / 449 lbs" >204 kg / 449 lbs</option><option value="205 kg / 452 lbs" >205 kg / 452 lbs</option><option value="206 kg / 454 lbs" >206 kg / 454 lbs</option><option value="207 kg / 456 lbs" >207 kg / 456 lbs</option><option value="208 kg / 458 lbs" >208 kg / 458 lbs</option><option value="209 kg / 460 lbs" >209 kg / 460 lbs</option><option value="210 kg / 463 lbs" >210 kg / 463 lbs</option><option value="211 kg / 465 lbs" >211 kg / 465 lbs</option><option value="212 kg / 467 lbs" >212 kg / 467 lbs</option><option value="213 kg / 469 lbs" >213 kg / 469 lbs</option><option value="214 kg / 471 lbs" >214 kg / 471 lbs</option><option value="215 kg / 474 lbs" >215 kg / 474 lbs</option><option value="216 kg / 476 lbs" >216 kg / 476 lbs</option><option value="217 kg / 478 lbs" >217 kg / 478 lbs</option><option value="218 kg / 480 lbs" >218 kg / 480 lbs</option><option value="219 kg / 482 lbs" >219 kg / 482 lbs</option><option value="220 kg / 485 lbs" >220 kg / 485 lbs</option><option value="221 kg / 487 lbs" >221 kg / 487 lbs</option><option value="222 kg / 489 lbs" >222 kg / 489 lbs</option><option value="223 kg / 491 lbs" >223 kg / 491 lbs</option><option value="224 kg / 493 lbs" >224 kg / 493 lbs</option><option value="225 kg / 496 lbs" >225 kg / 496 lbs</option><option value="226 kg / 498 lbs" >226 kg / 498 lbs</option><option value="227 kg / 500 lbs" >227 kg / 500 lbs</option><option value="228 kg / 502 lbs" >228 kg / 502 lbs</option><option value="229 kg / 504 lbs" >229 kg / 504 lbs</option><option value="230 kg / 507 lbs" >230 kg / 507 lbs</option><option value="231 kg / 509 lbs" >231 kg / 509 lbs</option><option value="232 kg / 511 lbs" >232 kg / 511 lbs</option><option value="233 kg / 513 lbs" >233 kg / 513 lbs</option><option value="234 kg / 515 lbs" >234 kg / 515 lbs</option><option value="235 kg / 518 lbs" >235 kg / 518 lbs</option><option value="236 kg / 520 lbs" >236 kg / 520 lbs</option><option value="237 kg / 522 lbs" >237 kg / 522 lbs</option><option value="238 kg / 524 lbs" >238 kg / 524 lbs</option><option value="239 kg / 526 lbs" >239 kg / 526 lbs</option><option value="240 kg / 529 lbs" >240 kg / 529 lbs</option><option value="241 kg / 531 lbs" >241 kg / 531 lbs</option><option value="242 kg / 533 lbs" >242 kg / 533 lbs</option><option value="243 kg / 535 lbs" >243 kg / 535 lbs</option><option value="244 kg / 538 lbs" >244 kg / 538 lbs</option><option value="245 kg / 540 lbs" >245 kg / 540 lbs</option><option value="246 kg / 542 lbs" >246 kg / 542 lbs</option><option value="247 kg / 544 lbs" >247 kg / 544 lbs</option><option value="248 kg / 546 lbs" >248 kg / 546 lbs</option><option value="249 kg / 549 lbs" >249 kg / 549 lbs</option><option value="250 kg / 551 lbs" >250 kg / 551 lbs</option><option value="251 kg / 553 lbs" >251 kg / 553 lbs</option><option value="252 kg / 555 lbs" >252 kg / 555 lbs</option><option value="253 kg / 557 lbs" >253 kg / 557 lbs</option><option value="254 kg / 560 lbs" >254 kg / 560 lbs</option><option value="255 kg / 562 lbs" >255 kg / 562 lbs</option><option value="256 kg / 564 lbs" >256 kg / 564 lbs</option><option value="257 kg / 566 lbs" >257 kg / 566 lbs</option><option value="258 kg / 568 lbs" >258 kg / 568 lbs</option><option value="259 kg / 571 lbs" >259 kg / 571 lbs</option><option value="260 kg / 573 lbs" >260 kg / 573 lbs</option><option value="261 kg / 575 lbs" >261 kg / 575 lbs</option><option value="262 kg / 577 lbs" >262 kg / 577 lbs</option><option value="263 kg / 579 lbs" >263 kg / 579 lbs</option><option value="264 kg / 582 lbs" >264 kg / 582 lbs</option><option value="265 kg / 584 lbs" >265 kg / 584 lbs</option><option value="266 kg / 586 lbs" >266 kg / 586 lbs</option><option value="267 kg / 588 lbs" >267 kg / 588 lbs</option><option value="268 kg / 590 lbs" >268 kg / 590 lbs</option><option value="269 kg / 593 lbs" >269 kg / 593 lbs</option><option value="270 kg / 595 lbs" >270 kg / 595 lbs</option><option value="271 kg / 597 lbs" >271 kg / 597 lbs</option><option value="272 kg / 599 lbs" >272 kg / 599 lbs</option><option value="273 kg / 601 lbs" >273 kg / 601 lbs</option><option value="274 kg / 604 lbs" >274 kg / 604 lbs</option><option value="275 kg / 606 lbs" >275 kg / 606 lbs</option><option value="276 kg / 608 lbs" >276 kg / 608 lbs</option><option value="277 kg / 610 lbs" >277 kg / 610 lbs</option><option value="278 kg / 612 lbs" >278 kg / 612 lbs</option><option value="279 kg / 615 lbs" >279 kg / 615 lbs</option><option value="280 kg / 617 lbs" >280 kg / 617 lbs</option><option value="281 kg / 619 lbs" >281 kg / 619 lbs</option><option value="282 kg / 621 lbs" >282 kg / 621 lbs</option><option value="283 kg / 624 lbs" >283 kg / 624 lbs</option><option value="284 kg / 626 lbs" >284 kg / 626 lbs</option><option value="285 kg / 628 lbs" >285 kg / 628 lbs</option><option value="286 kg / 630 lbs" >286 kg / 630 lbs</option><option value="287 kg / 632 lbs" >287 kg / 632 lbs</option><option value="288 kg / 635 lbs" >288 kg / 635 lbs</option><option value="289 kg / 637 lbs" >289 kg / 637 lbs</option><option value="290 kg / 639 lbs" >290 kg / 639 lbs</option><option value="291 kg / 641 lbs" >291 kg / 641 lbs</option><option value="292 kg / 643 lbs" >292 kg / 643 lbs</option><option value="293 kg / 646 lbs" >293 kg / 646 lbs</option><option value="294 kg / 648 lbs" >294 kg / 648 lbs</option><option value="295 kg / 650 lbs" >295 kg / 650 lbs</option><option value="296 kg / 652 lbs" >296 kg / 652 lbs</option><option value="297 kg / 654 lbs" >297 kg / 654 lbs</option><option value="298 kg / 657 lbs" >298 kg / 657 lbs</option><option value="299 kg / 659 lbs" >299 kg / 659 lbs</option><option value="300 kg / 661 lbs" >300 kg / 661 lbs</option>
                    
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
