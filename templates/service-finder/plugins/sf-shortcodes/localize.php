<?php
/*****************************************************************************
*
*	copyright(c) - aonetheme.com - Service Finder Team
*	More Info: http://aonetheme.com/
*	Coder: Service Finder Team
*	Email: contact@aonetheme.com
*
******************************************************************************/
?>
<?php
$string_array = array(
	'fullname' => esc_html__( 'Please insert your name', 'service-finder' ),
	'email' => esc_html__( 'The input is not a valid email address', 'service-finder' ),
	'comment' => esc_html__( 'Please insert comment', 'service-finder' ),
	'myfav' => esc_html__( 'My Favorite', 'service-finder' ),
	'addtofav' => esc_html__( 'Add to Fav', 'service-finder' ),
);
wp_localize_script( 'service_finder-js-plugin-contactform', 'args', $string_array );
wp_localize_script( 'service_finder-js-featured-providers', 'args', $string_array );





?>