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

$available = (isset($a['available'])) ? esc_html($a['available']) : '';
$availableclass = ($available == 'yes') ? 'fa-check' : 'fa-times';
$notavailableclass = ($available == 'no') ? 'sf-featued-no-provide' : '';
$html = '<li class="'.sanitize_html_class($notavailableclass).'"><i class="fa '.sanitize_html_class($availableclass).'"></i> '.esc_html($a['title']).'</li>'; 

?>

