<div class="row">
    <div class="col-12 col-md-12">
        <h4 class="product-innertitle ">Refer Colleagues & earn credit</h4>
        <div class="card-review1 ">
            <div class="card-body ">
                <p class="refer-text"> Share your referal link with colleagues and earn
                    <?php //echo get_woocommerce_currency_symbol(); ?>$500 credit </p>
                <div class="row collegues-row">
                    <div class="refer-link">
                        <!--<a class="domain-link" href="/" ><?php echo home_url('?channel=MedicalSpaRXReferral'); ?></a>	-->
                        <!--<input type="text" disabled class="domain-link " value="<?php echo home_url('?channel=MedicalSpaRXReferral'); ?>" id="referal-domain-link">
            <span id="msg-clipboard"></span>-->
                        <input type="text" disabled class="domain-link"
                            value="<?php echo home_url('?channel=MedicalSpaRXReferral'); ?>" id="copiedclipInput">
                    </div>
                    <div class="refer-actions">
                        <div class="copy-refer-link">
                            <!--<a href="javascript:void(0)" class="ref-btn ref-btn1" data-clipboard-text="<?php //echo home_url('?channel=MedicalSpaRXReferral'); ?>">COPY LINK</a>-->
                            <!--<a href="javascript:void(0)" id="referal-copy" class="button-background-blue ref-btn" onclick="myFunction()">COPY LINK</a>-->
                            <div class="tooltip">
                                <a href="javascript:void(0)"
                                    class="button-background-blue ref-btn button button-primary text-uppercase"
                                    onclick="copyclipboardFunction()" onmouseout="copiedclipFunc()">
                                    <span class="tooltiptext" id="copiedclipTooltip">Copy to clipboard</span>
                                    Copy text
                                </a>
                            </div>
                        </div>
                        <div class="refer-learn-more">
                            <a href="<?php echo home_url('/referral/'); ?>"
                                class="button button-secondary text-uppercase button-background-white ref-btn ">learn
                                more</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>