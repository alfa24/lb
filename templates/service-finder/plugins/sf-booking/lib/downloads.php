<?php
require_once('../../../../wp-load.php');
$wp_filesystem = service_finder_plugin_global_vars('wp_filesystem');
if ( empty( $wp_filesystem ) ) {
  require_once ABSPATH . '/wp-admin/includes/file.php';
  WP_Filesystem();
}
if(isset($_SERVER["HTTPS"])){
$fullPath = $_SERVER['DOCUMENT_ROOT'].'/'.str_replace('https://'.$_SERVER['HTTP_HOST'].'/','',$_REQUEST['file']);
}else{
$fullPath = $_SERVER['DOCUMENT_ROOT'].'/'.str_replace('http://'.$_SERVER['HTTP_HOST'].'/','',$_REQUEST['file']);
}
if($wp_filesystem->exists($fullPath)){
    $fsize = filesize($fullPath);
    $path_parts = pathinfo($fullPath);
    $ext = strtolower($path_parts["extension"]);
    switch ($ext) {
        case "pdf":
        header("Content-Type: application/pdf"); // add here more headers for diff. extensions
        header("Content-Disposition: attachment; filename=\"".$path_parts["basename"]."\""); // use 'attachment' to force a download
        break;
		case "doc":
        header("Content-Type: application/msword"); // add here more headers for diff. extensions
        header("Content-Disposition: attachment; filename=\"".$path_parts["basename"]."\""); // use 'attachment' to force a download
        break;
        default;
        header("Content-Type: application/octet-stream");
        header("Content-Disposition: filename=\"".$path_parts["basename"]."\"");
    }
    header("Content-length: $fsize");
    header("Cache-control: private"); //use this to open files directly
	$buffer = $wp_filesystem->get_contents($fullPath);
    echo $buffer;
}
exit;

