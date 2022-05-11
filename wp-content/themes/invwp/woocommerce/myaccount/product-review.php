
<div class="user-pdt-review">
	<div class="rev-header d-flex">
		<h2>Product reviews</h2><span>Add review <img src="<?php echo site_url(); ?>/wp-content/uploads/2022/05/rev-plus.png"/></span>
	</div>

</div>
<div class="myaccount-comment">
	<?php
	global $current_user;

	$recent_comments = get_comments( array(
		'post_author' => $current_user->ID,
	 'status'    => 'approve'
	 ) );
	if( $recent_comments ){
		 foreach($recent_comments as $c) {
			$the_comment = mb_strimwidth($c->comment_content, 0, 80, "...", "UTF-8");
			$pdt_title = get_the_title( $c->comment_post_ID );
			$permalink = get_permalink( $c->comment_post_ID );
			$dt = date('d,M, Y', strtotime($c->comment_date));
			?>
			<div class="comment-outer">
				<div class="comment-header d-flex align-items-center justify-content-between">
					<div class="comment-pdt-title"><a href="<?php echo $permalink; ?>"><?php echo $pdt_title; ?></a></div>
					<div class="product-rev-rating"></div>
				</div>
				<div class="comment-body">
					<p><?php echo $the_comment; ?></p>
				</div>
				<div class="comment-footer d-flex align-items-center justify-content-between">
					<div class="pdt-comment-date"><?php echo $dt; ?></div>
					<div class="comment-delete-action"><a href="">Delete</a></div>
				</div>
			</div>
			<?php

		}
	} else {
		echo "There are no reviews yet.";
	}
?>
</div>
