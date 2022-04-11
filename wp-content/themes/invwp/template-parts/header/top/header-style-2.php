<section class="full-width">
  <div class="container">
    <div class="top-header">
      <div class="row">
        <div class="col-4">
          Call: <a href="tel:1-844-560-7790">1-844-560-7790</a>
        </div>
        <div class="col-4">
          Email:<a href="mailto:service@canadianinsulin.com">service@canadianinsulin.com</a>
        </div>
        <div class="col-4">
          <form role="search" method="get" id="searchform" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
              <div>
                  <label class="screen-reader-text" for="s"><?php _x( 'Search for:', 'label' ); ?></label>
                  <input type="text" value="<?php echo get_search_query(); ?>" name="s" id="s" />
                  <input type="submit" id="searchsubmit" value="<?php echo esc_attr_x( 'Search', 'submit button' ); ?>" />
              </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
