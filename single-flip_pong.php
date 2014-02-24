<?php 
/*
*
*single-flip_pong.php
*version:
1.3.1
*
*/
$height = get_post_meta( get_the_ID(), 'dbt_height', true);
$width = get_post_meta( get_the_ID(), 'dbt_width', true);
if(get_post_meta( get_the_ID(), 'dbt_header', true)== 'ok')get_header();
else{
?>
<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
</head>
<body>
<?php } ?>


<link type='text/css' rel='stylesheet' href="<?php echo plugins_url();  ?>/flip-pong-v/css/styleFlipBook.css" />

<div id="flipbook" style="height:<?php echo $height; ?>px; width:<?php echo $width*2; ?>px; <?php if(get_post_meta(get_the_ID(), 'dbt_shadow',true)== 'ok'){echo 'box-shadow:0 0 10px #040404;';}?>">	
	<?php
	$args = array( 'post_type' => 'attachment', 'numberposts' => -1, 'post_status' => null, 'post_parent' => $post->ID, 'orderby' => 'title', 'order'=> 'ASC' ); 
	$attachments = get_posts($args);
	if ($attachments) {
		foreach ( $attachments as $attachment ) {
			$flipimage = wp_get_attachment_image_src( $attachment->ID, 'full' );?>	
				<img class="flipbookimg" src="<?php echo $flipimage[0]; ?>" width="<?php echo $width; ?>" alt="flipbook page"/>	
	<?php }}?>
</div>
<div id="flipbuttons">
		<a href="javascript:;" onclick="$('#flipbook').turn('previous');"><img src="<?php echo plugins_url(); ?>/flip-pong-v/images/left.png" alt="Turn to previous page"/></a>
		<a href="javascript:;" onclick="supazoomin();"><img src="<?php echo plugins_url(); ?>/flip-pong-v/images/zoomin.png" alt="Zoom In"/></a>
		<a href="javascript:;" onclick="supazoomout();"><img src="<?php echo plugins_url(); ?>/flip-pong-v/images/zoomout.png" alt="Zoom Out"/></a>
		<a href="javascript:;" onclick="$('#flipbook').turn('next');"><img src="<?php echo plugins_url(); ?>/flip-pong-v/images/right.png" alt="Turn to next page"/></a>
</div>

<script type="text/javascript">
	function supazoomin(){
		$("#flipbook").turn("size", <?php echo(4*$width.', '.$height*2); ?>);
	}
	function supazoomout(){
		$("#flipbook").turn("size", <?php echo(2*$width.', '.$height); ?>);
	}
</script>
<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="<?php echo plugins_url();  ?>/flip-pong-v/js/turn.min.js"></script>
<script src="<?php echo plugins_url();  ?>/flip-pong-v/js/zoom.min.js"></script>
<script src="<?php echo plugins_url(); ?>/flip-pong-v/js/script.js"></script>
<?php if(get_post_meta( get_the_ID(), 'dbt_footer', true)== 'ok') get_footer();
else{ ?>
	</body>
	</html>
<?php } ?>