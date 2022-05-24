<?php
/**
* Template Name: Sitemap Page
*
* @package WordPress
* @subpackage Inovexia_Ecomm_Theme
* @since 2021
*/

get_header();
?>

<main id="primary" class="site-main">

 

      <div class="content">

        <section class=" sitemap-wrp section-margin">
  <div class="container body-container">
    <div class="row ">
      <div class="col-3">
        <?php
              //get_sidebar();
              if(is_active_sidebar('sitemap-col-1')){
                dynamic_sidebar('sitemap-col-1');
              }
           ?>      

      </div>
      <div class="col-3">
        <?php
              //get_sidebar();
              if(is_active_sidebar('sitemap-col-2')){
                dynamic_sidebar('sitemap-col-2');
              }
              ?>
      
      </div>
      <div class="col-3">
        <?php
              //get_sidebar();
              if(is_active_sidebar('sitemap-col-3')){
                dynamic_sidebar('sitemap-col-3');
              }
           ?>
      
      </div>
      <div class="col-3">
        <?php
              //get_sidebar();
              if(is_active_sidebar('sitemap-col-4')){
                dynamic_sidebar('sitemap-col-4');
              }
              ?>
     
      </div>
    </div>
  </div>

</section>

      </div>



</main><!-- #main -->
<?php get_footer(); ?>
