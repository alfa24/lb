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
$html = '<section class="section-full bg-primary">
            <div class="container">
            	
                <div class="row equal-col-outer">
                    
                    '.do_shortcode( $content ).'
                    
                </div>
                
            </div>
        </section>';
$html = str_replace('<br />','',$html);
$html = str_replace('<p></p>','',$html);
?>

