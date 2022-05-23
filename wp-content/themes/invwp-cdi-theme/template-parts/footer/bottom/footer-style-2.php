<div class="row">
  <div class="col-12">
    <div class="container">
      <div class="site-info">
        <a href="<?php echo esc_url( __( 'https://wordpress.org/', 'invwp' ) ); ?>">
          <?php
          /* translators: %s: CMS name, i.e. WordPress. */
          printf( esc_html__( 'Proudly powered by %s', 'invwp' ), 'WordPress' );
          ?>
        </a>

        <span class="sep"> | </span>
          <?php
          /* translators: 1: Theme name, 2: Theme author. */
          printf( esc_html__( 'Theme: %1$s by %2$s.', 'invwp' ), 'invwp', '<a href="https://inovexiasoftware.com">Inovexia Software Services</a>' );
          ?>
      </div><!-- .site-info -->
    </div>
  </div>
</div>
