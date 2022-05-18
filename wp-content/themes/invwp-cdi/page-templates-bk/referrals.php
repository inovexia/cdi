<?php
/**
* Template Name: Referal
*
* @package WordPress
* @subpackage INV_WPinvwpsTARTER
* @since 2021
*/

get_header();
?>
<!-- Hero single image -->
<?php get_template_part( 'template-parts/page/referral/banner', ''); ?>

<!-- full width content section -->
<div class="referal-one-column">
    <?php get_template_part( 'template-parts/component/one-column/center-content', ''); ?>
</div>
<!-- Content Area Section -->
<div class="about-two-column referal-two-column">
<?php get_template_part( 'template-parts/component/Two-column/left-column-image', ''); ?>
</div>


<?php
get_footer ();
?>
