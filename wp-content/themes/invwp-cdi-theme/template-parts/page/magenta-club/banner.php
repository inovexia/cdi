<?php
$image = get_field( 'magenta_banner_image' );
//if ( !empty( $image ) ) { ?>
<section class="magenta-club-banner"
    style="background-image:url('<?php //echo $image['url']; ?>');background-position: top center; background-repeat: no-repeat; background-size: cover; ">
    <?php //} ?>
    <div class="container">
        <div class="row">

            <div class="col-12 col-md-12 text-center py-5">
                <div class="magenta-banner-heading w-100">
                    <h1 class="section-title"><?php echo the_field('banner_heading'); ?></h1>
                    <h3 class=""><?php echo the_field('banner_subheading'); ?></h3>

                    <p class="py-2 ms-0"><?php echo the_field('banner_paragraph'); ?></p>
                    <div class="py-3 magenta-btn">
                        <a class="" href="#" data-target="login-modal" data-toggle="modal" data-signin="login">Join
                            Now</a>
                    </div>
                    <div class="clearfix"></div>
                    <div class=" magenta-signin pt-3">Already have an account? <a class="" href="#"
                            data-target="login-modal" data-toggle="modal" data-signin="login">Sign in.</a></div>
                </div>
            </div>

        </div>
    </div>
</section>