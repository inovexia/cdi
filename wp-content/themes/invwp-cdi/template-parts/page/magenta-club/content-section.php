<section class="magenta-section-content-fullwidth section-padding">
  <div class="container">
    <div class="text-center">
      <div class="col-lg-6 mx-auto">
        <h2 class=" magenta-how-works-para section-title"><?php echo the_field("how_works_heading"); ?></h2>
        <p class=" pt-3"><?php echo the_field("how_works_subheading"); ?></p>
        <div class="">
        </div>
      </div>
    </div>
    <div class="row pt-5 gx-0">
        <?php if (have_rows('how_works_column')) :
              while (have_rows('how_works_column')) : the_row();
              $image = get_sub_field( 'how_works_icon' );
        ?>
        <div class="magenta-inner-column text-center col-4">
          <img src="<?php echo $image['url']; ?>" class="img-fluid" alt="<?php echo $image['alt']; ?>" />
          <h4 class="">
            <?php the_sub_field('how_work_column_title'); ?>
          </h4>
          <p class=""><?php the_sub_field('how_work_column_paragraph'); ?></p>
        </div>
        <?php
         endwhile;
         else : endif;
        ?>
    </div>

  </div>
</section>
<div class="clearfix"></div>

<section class="magenta-content-section section-padding">
  <div class="container">
    <div class="text-center">
      <div class="col-12 mx-auto pb-3">
        <h2 class=" magenta-how-works-para section-title"><?php echo the_field("price_table_heading"); ?></h2>
      </div>
    </div>

    <div class="row">
      <!-- <div class="col-1 mx-auto"></div> -->
        <div class="col-10 mx-auto">
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr class="text-center">
                    <th scope="col">&nbsp;</th>
                    <?php
                      if (have_rows('membership_sections')) :
                      while (have_rows('membership_sections')) : the_row();
                    ?>
                      <th scope="col"><div class="text-center py-2"><?php the_sub_field('membership_title'); ?></div>
                        <div class="mpoints py-2"><?php the_sub_field('membership_points'); ?></div>
                        <div class="py-2"><?php the_sub_field('membership_spend_text'); ?></div></th>
                    <?php
                     endwhile;
                     else : endif;
                    ?>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    if (have_rows('membership_sections1')) :
                    while (have_rows('membership_sections1')) : the_row();
                  ?>
                  <tr class="text-center">
                    <th class=""><?php the_sub_field('membership_title'); ?></th>
                    <td><i class="<?php the_sub_field('membership_icons'); ?>"></i></td>
                    <td><i class="<?php the_sub_field('membership_icons1'); ?>"></i></td>
                    <td><i class="<?php the_sub_field('membership_icons2'); ?>"></i></td>
                  </tr>
                  <?php
                   endwhile;
                   else : endif;
                  ?>
                </tbody>
            </table>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row magenta-earn-sections">


            
              <div class="col-12 mx-auto py-5">
        <p class="magenta-how-works-para text-center section-title"><?php echo the_field("earn_point_heading"); ?></p>
                <ul class="mx-auto">
                  <?php
                    if (have_rows('earn_point_list')) :
                    while (have_rows('earn_point_list')) : the_row();
                  ?>
                    <li class=""><?php the_sub_field('earn_point_para'); ?></li>
                  <?php
                   endwhile;
                   else : endif;
                  ?>
              </ul>


            <div class="text-center">
                <a class=" magenta-button" href="#" data-bs-toggle="modal" data-bs-target="#auth-modal">Join now</a>
            </div>
          </div>

    </div>

    </div>

  </div>
</section>
