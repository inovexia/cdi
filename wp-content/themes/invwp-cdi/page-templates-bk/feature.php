<?php
/**
* Template Name: Features
*
* @package WordPress
* @subpackage Inovexia_Ecomm_Theme
* @since 2021
*/


get_header();
?>
<main id="primary" class="site-main">

    <?php
    $sidebar = get_field('sidebar', 'option');

      if($sidebar == 1 || $sidebar == 3){
        get_sidebar('left');
      }
    ?>


<!------ Include the above in your HEAD tag ---------->
<div class="services-section black-trans-bg">
        <div class="services-section-banner"></div>
        <div class="container">
            <div class="row">
                <div class="col-8 col-4 col-12 col-12">
                    <div class="services-head">
                        <h2 class="services-title"> <?php echo the_field('first_service_heading'); ?></h2>
                        <span class="services-title-border"></span>
                        <p class="services-text"><?php echo the_field('first_service'); ?></p>
                    </div>
                    <div class="services-content">
                        <div class="row">
                            <div class="col-6 ">
                                <div class="service-2">
                                    <div class="service-box">
                                        <div class="clearfix">
                                            <div class="iconset">
                                                 <img src="<?php echo the_field('service_image_1'); ?>" class="img-fluid " alt="<?php echo bloginfo('name'); ?>" loading="lazy" />
                                            </div>
                                            <div class="servicesB-content">
                                                <h4><?php echo the_field('first_service_1'); ?></h4>
                                                <p><?php echo the_field('description_service_1'); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="service-box">
                                        <div class="clearfix">
                                            <div class="iconset">
                                                <img src="<?php echo the_field('service_image_2'); ?>" class="img-fluid " alt="<?php echo bloginfo('name'); ?>" loading="lazy" />
                                            </div>
                                            <div class="servicesB-content">
                                                <h4><?php echo the_field('first_service_2'); ?></h4>
                                                <p><?php echo the_field('description_service_2'); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                             <div class="col-6 ">
                                <div class="service-2">
                                    <div class="service-box">
                                        <div class="clearfix">
                                            <div class="iconset">
                                                 <img src="<?php echo the_field('service_image_3'); ?>" class="img-fluid " alt="<?php echo bloginfo('name'); ?>" loading="lazy" />
                                            </div>
                                            <div class="servicesB-content">
                                                <h4><?php echo the_field('first_service_3'); ?></h4>
                                                <p><?php echo the_field('description_service_3'); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="service-box">
                                        <div class="clearfix">
                                            <div class="iconset">
                                                <img src="<?php echo the_field('service_image_4'); ?>" class="img-fluid " alt="<?php echo bloginfo('name'); ?>" loading="lazy" />
                                            </div>
                                            <div class="servicesB-content">
                                                <h4><?php echo the_field('first_service_4'); ?></h4>
                                                <p><?php echo the_field('description_service_4'); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<--------second service----------></--------second>
<?php get_template_part( 'template-parts/page/features/typesecond'); ?>

<!------ Include the above in your HEAD tag ---------->





<--------third service----------></--------third>
<section class="c-section">
    <h2 class="c-section__title"><span><?php echo the_field('third_service_heading'); ?></span></h2>
    <ul class="c-services">
        <li class="c-services__item">
            <h3><?php echo the_field('third_service_1'); ?></h3>
            <p><?php echo the_field('third_service_description_1'); ?></p>
        </li>
        <li class="c-services__item">
            <h3><?php echo the_field('third_service_2'); ?></h3>
            <p><?php echo the_field('third_service_description_2'); ?></p>
        </li>
        <li class="c-services__item">
            <h3><?php echo the_field('third_service_3'); ?></h3>
            <p><?php echo the_field('third_service_description_3'); ?></p>
        </li>
        <li class="c-services__item">
            <h3><?php echo the_field('third_service_4'); ?></h3>
            <p><?php echo the_field('third_service_description_4'); ?></p>
        </li>
        <li class="c-services__item">
            <h3><?php echo the_field('third_service_5'); ?></h3>
            <p><?php echo the_field('third_service_description_5'); ?></p>
        </li>
        <li class="c-services__item">
            <h3><?php echo the_field('third_service_6'); ?></h3>
            <p><?php echo the_field('third_service_description_6'); ?> </p>
        </li>
    </ul>
	
</section>
	

</main><!-- #main -->
<?php get_footer(); ?>
 
	