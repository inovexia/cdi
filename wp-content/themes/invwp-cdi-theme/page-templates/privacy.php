<?php
/**
* Template Name: Privacy Policy
*
* @package WordPress
* @subpackage Inovexia_Ecomm_Theme
* @since 2021
*/

get_header();
?>
<main id="primary" class="site-main">



  <div class="content">

    <section class="section-privacyfullwidth section-margin">
      <div class="container">
        <div class="row">
          <div class="col-12 privacy-inner-content">
            <!-- <h4 class="text-uppercase"><?php echo the_field('privacy_title'); ?></h4> -->
            <div class="">
              <p><?php echo the_content(); ?></p>
            </div>
          </div>
        </div>
      </div>
    </section>

  </div>



</main><!-- #main -->
<?php get_footer(); ?>