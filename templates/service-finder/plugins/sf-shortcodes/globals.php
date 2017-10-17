<?php
/*****************************************************************************
*
*	copyright(c) - aonetheme.com - Service Finder Team
*	More Info: http://aonetheme.com/
*	Coder: Service Finder Team
*	Email: contact@aonetheme.com
*
******************************************************************************/

//Return global variable $service_finder_ThemeParams
function service_finder_shortcode_global_vars($global_var)
{
	global $wpdb, $service_finder_Tables;

	switch($global_var){
	case 'wpdb':
		return $wpdb;
		break;
	case 'service_finder_Tables':
		return $service_finder_Tables;
		break;
	default:
		break;		
	}
}
