<?php
$topbar_enabledisable = get_field('topbar', 'option');
$topbar_header_style = get_field('top_header_style', 'option');
$navigation_style = get_field('navigation_style', 'option');

  if($topbar_enabledisable == 'Enable'){
      if($topbar_header_style > 0 ){
        get_template_part('template-parts/header/top/header', 'style-'.$topbar_header_style);
      }
      else{
        get_template_part('template-parts/header/top/header', 'style-1');
      }
  }

  if($navigation_style > 0 ){
      get_template_part('template-parts/header/nav/header', 'style-'.$navigation_style);
  }
  else{
    get_template_part('template-parts/header/nav/header', 'style-1');
  }
?>
