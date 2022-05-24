<?php
	// Load top header
	get_template_part('template-parts/header/top/header', 'style-1');

	// Load header nav
	get_template_part('template-parts/header/nav/header', 'style-1');

	// Load breadcrumb
	if (! is_page ('about')) {
		get_template_part('template-parts/header/crumbs/style-1');		
	}
?>
