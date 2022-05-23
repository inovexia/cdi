<div class="row">
    <div class="col-md-12">
        <h4 class="product-innertitle montserrat-semi-bold-ebony-clay-18px text-uppercase">Product Reviews</h4>

        <?php
      global $product;
      $Cid = $product->get_id();

      $args = array ('post_type' => 'product', 'post_id' => $Cid);
      $comments = get_comments( $args );

      if( $comments ) {
        foreach( $comments as $commenta ) { ?>
        <div class="card-review">
            <div class="d-flex justify-content-between">

                <p class="card-title review-title montserrat-bold-ebony-clay-10px">
                    <?php echo $commenta->comment_content; ?>
                </p>

                <div class="review-rating text-right">
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                </div>

            </div>

            <div class="card-body montserrat-normal-ebony-clay-12px">
                <?php echo $commenta->comment_content; ?>
            </div>

            <div class="d-flex justify-content-between">
                <div class="review-author-name montserrat-bold-ebony-clay-10px">
                    <?php echo $commenta->comment_author; ?>
                </div>
                <div class="review-date montserrat-bold-ebony-clay-10px">
                    <?php //echo $commenta->comment_date;
                $timestamp = strtotime( $commenta->comment_date ); //Changing comment time to timestamp
                $date = date('d.m.Y', $timestamp);
                ?>
                    <time datetime="<?php echo $commenta->comment_date; ?>"><?php echo $date; ?></time>
                </div>
            </div>

        </div>
        <?php
        }
      } else { ?>
        <div class="card-review">
            <div class="card-body">
                <p class="card-title review-title montserrat-normal-ebony-clay-12px"> This product has no review yet.
                </p>
            </div>
        </div>
        <?php
      }
      ?>
    </div>
</div>