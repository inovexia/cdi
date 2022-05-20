<footer id="colophon" class="site-footer">
  <?php
  $footertop_enabled = get_field('footer_top', 'option');
  $footer_top_style = get_field('footer_top_style', 'option');
  $bottomfooter_enabled = get_field('bottom_footer', 'option');
  $bottom_footer_style = get_field('bottom_footer_style', 'option');

  if($footertop_enabled == 'Enable'){
      if($footer_top_style > 0 ){
        get_template_part('template-parts/footer/top/footer', 'style-'.$footer_top_style);
      }
      else{
        get_template_part('template-parts/footer/top/footer', 'style-3');
      }
  }

  if($bottomfooter_enabled == 'Enable'){
      if($bottom_footer_style > 0 ){
        get_template_part('template-parts/footer/bottom/footer', 'style-'.$bottom_footer_style);
      } else {
        get_template_part('template-parts/footer/bottom/footer', 'style-3');
      }
  }
  ?>
</footer>
