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
<!-- Featured Providers Outer Start -->
<?php
$html = '<section class="section-full text-center bg-white why-use-sf ">
  <div class="container">
    <div class="section-head">
      <h2 class="text-uppercase">'.esc_html($a['title']).'</h2>
      '.service_finder_title_separator().'
      <p>'.esc_html($a['tagline']).'</p>
    </div>
    <div class="section-content">
      <div class="row equal-col-outer">
        '.do_shortcode( $content ).'
      </div>
    </div>
  </div>
</section>
';
$html = str_replace('<br />','',$html);
$html = str_replace('<br>','',$html);
$html = str_replace('<p></p>','',$html);

?>
<!-- Featured Providers Outer End -->
