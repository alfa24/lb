/*
==========================
	Theme Name: Service Finder
	Theme URI: http://aonetheme.com/demo/
	Description: Service Finder Theme by aonetheme
	Version: 2.2
	Author: Aonetheme Team
	Author URI: http://themeforest.net/user/aonetheme
    Text Domain: service-finder
	Tags: two-columns, three-columns, left-sidebar, right-sidebar, custom-menu, editor-style, featured-images, sticky-post, theme-options, translation-ready
	License: 
	License URI: 
==========================
*/



/*
======================================
  || CSS TABLE CONTENT ||  
======================================

---------------------------------------------------------------
1. GENERAL 
---------------------------------------------------------------
---------------------------------------------------------------
2. HEADING & TITLE 
---------------------------------------------------------------
---------------------------------------------------------------
3. TITLE SEPARATOR LINE 
---------------------------------------------------------------
---------------------------------------------------------------
4. TEXT & PARAGRAPH 
---------------------------------------------------------------
---------------------------------------------------------------
5. LISTING STYLES 
---------------------------------------------------------------
---------------------------------------------------------------
6. BOX SPACING (inner & outer spacing)
	>padding
	>marging
---------------------------------------------------------------
---------------------------------------------------------------
7. POSITIONS css ( absolute & relative & statice)
---------------------------------------------------------------
---------------------------------------------------------------
8. COLOR (text & background) 
	>text color
	>background color
---------------------------------------------------------------
---------------------------------------------------------------
9. OVERLAY ( transparient background )
---------------------------------------------------------------
---------------------------------------------------------------
10. BOXES CSS 
---------------------------------------------------------------
---------------------------------------------------------------
11. IMAGES EFFECTS (overly animation)  
---------------------------------------------------------------
---------------------------------------------------------------
12. CUSTOM ELEMENTS 
---------------------------------------------------------------
---------------------------------------------------------------
13. TRANSITION (Slow animateion speed) 
---------------------------------------------------------------
---------------------------------------------------------------
14. BUTTONS STYLE 
---------------------------------------------------------------
---------------------------------------------------------------
15. FORM  ELEMENTS
---------------------------------------------------------------
---------------------------------------------------------------
16. TABLES 
---------------------------------------------------------------
---------------------------------------------------------------
17. WP DEFAULT 
---------------------------------------------------------------
---------------------------------------------------------------
18. BLOG
	>blog post listing
	>side bar
	>single blog
	>comment listing
	>comment form  
--------------------------------------------------------------- 
---------------------------------------------------------------
19. HRADER (top part of page)
---------------------------------------------------------------
---------------------------------------------------------------
20. PAGE TOP BAR (left & right content)
	>eamil-phone
	>social-links
	>language
---------------------------------------------------------------
---------------------------------------------------------------
21. LOGO ( company identify  symbol )
	>logo for header
	>logo for footer
---------------------------------------------------------------
---------------------------------------------------------------
22. MAIN BAR ( place logo & main-navigation )
---------------------------------------------------------------
---------------------------------------------------------------
23. NAVIGATIONS 
	>mena-menu
	>mobile-menu
	>footer-menu
--------------------------------------------------------------- 
---------------------------------------------------------------
24. BANNER
---------------------------------------------------------------
---------------------------------------------------------------
25. SLIDER
---------------------------------------------------------------
---------------------------------------------------------------
26. PAGINATION 
---------------------------------------------------------------
---------------------------------------------------------------
27. FOOTER
--------------------------------------------------------------- 
---------------------------------------------------------------
28. PAGE-CONTENT
---------------------------------------------------------------
---------------------------------------------------------------
29. INNER-CONTENT
---------------------------------------------------------------
---------------------------------------------------------------
30. AFTER-LOGIN-CONTENT
---------------------------------------------------------------

End Content

*/


/*---------------------------------------------------------------
1. GENERAL 
---------------------------------------------------------------*/
body {
	background-color:#fff;
	font-family: 'Open Sans', sans-serif;
	font-size:13px;
	font-weight:400; 
	color:#767676;
	padding:0;
	margin:0; 
	overflow-x: hidden;
}  


a {
  color: #767676;
  outline: 0 none;
  text-decoration:none;
}

a:hover,
a:focus {
  text-decoration:none;
  outline: 0 none;
}

a:active,
a:hover {
  color: <?php echo (!empty($data['color-scheme'])) ? esc_html($data['color-scheme']) : ''; ?>;
}

p a{
	color:#3396d1;
}

img {
    border-style: none;
    height: auto;
    max-width: 100%;
    vertical-align: middle;
}

section, 
article, 
aside, 
details, 
figcaption, 
figure, 
footer, 
header, 
hgroup, 
main, 
menu, 
nav, 
summary { 
	display:block; 
}

address {
	font-style:italic;
}

table {
    background-color: transparent;
    width: 100%;
}
table thead th {
	color:#333;
}
table th,
table td {
    padding:10px;
}

p, 
address, 
pre, 
hr, 
ul, 
ol, 
dl, 
dd, 
table {
	margin-bottom:24px;
}

.clear { 
	clear:both; 
}

.pull-none { 
	float:none;
}


::-moz-selection {
	background: <?php echo (!empty($data['color-scheme'])) ? esc_html($data['color-scheme']) : ''; ?>;
	color: #fff;
}
::selection {
	background: <?php echo (!empty($data['color-scheme'])) ? esc_html($data['color-scheme']) : ''; ?>;
	color: #fff;
}

/*---------------------------------------------------------------
2. HEADING & TITLE 
---------------------------------------------------------------*/
h1, 
h2, 
h3, 
h4, 
h5, 
h6 {
  margin-bottom:24px;
  text-transform:uppercase;
}

h1 {
  font-family:<?php echo (!empty($data['h1-size']['font-family'])) ? esc_html($data['h1-size']['font-family']) : ''; ?>;	
  font-weight: <?php echo (!empty($data['h1-size']['font-weight'])) ? esc_html($data['h1-size']['font-weight']) : ''; ?>;	
  font-size: <?php echo (!empty($data['h1-size']['font-size'])) ? esc_html($data['h1-size']['font-size']) : ''; ?>;
  line-height:<?php echo (!empty($data['h1-size']['line-height'])) ? esc_html($data['h1-size']['line-height']) : ''; ?>;
  color:<?php echo (!empty($data['h1-size']['color'])) ? esc_html($data['h1-size']['color']) : ''; ?>;
  text-transform:<?php echo (!empty($data['h1-size']['text-transform'])) ? esc_html($data['h1-size']['text-transform']) : ''; ?>;
}

h2 {
  font-family:<?php echo (!empty($data['h2-size']['font-family'])) ? esc_html($data['h2-size']['font-family']) : ''; ?>;	
  font-weight: <?php echo (!empty($data['h2-size']['font-weight'])) ? esc_html($data['h2-size']['font-weight']) : ''; ?>;	
  font-size: <?php echo (!empty($data['h2-size']['font-size'])) ? esc_html($data['h2-size']['font-size']) : ''; ?>;
  line-height:<?php echo (!empty($data['h2-size']['line-height'])) ? esc_html($data['h2-size']['line-height']) : ''; ?>;
  color:<?php echo esc_html($data['h2-size']['color']); ?>;
  text-transform:<?php echo (!empty($data['h2-size']['text-transform'])) ? esc_html($data['h2-size']['text-transform']) : ''; ?>;
}

h3 {
  font-family:<?php echo (!empty($data['h3-size']['font-family'])) ? esc_html($data['h3-size']['font-family']) : ''; ?>;	
  font-weight: <?php echo (!empty($data['h3-size']['font-weight'])) ? esc_html($data['h3-size']['font-weight']) : ''; ?>;	
  font-size: <?php echo (!empty($data['h3-size']['font-size'])) ? esc_html($data['h3-size']['font-size']) : ''; ?>;
  line-height:<?php echo (!empty($data['h3-size']['line-height'])) ? esc_html($data['h3-size']['line-height']) : ''; ?>;
  color:<?php echo (!empty($data['h3-size']['color'])) ? esc_html($data['h3-size']['color']) : ''; ?>;
  text-transform:<?php echo (!empty($data['h3-size']['text-transform'])) ? esc_html($data['h3-size']['text-transform']) : ''; ?>;
  margin-bottom:20px;
}

h4 {
  font-family:<?php echo (!empty($data['h4-size']['font-family'])) ? esc_html($data['h4-size']['font-family']) : ''; ?>;	
  font-weight: <?php echo (!empty($data['h4-size']['font-weight'])) ? esc_html($data['h4-size']['font-weight']) : ''; ?>;	
  font-size: <?php echo (!empty($data['h4-size']['font-size'])) ? esc_html($data['h4-size']['font-size']) : ''; ?>;
  line-height:<?php echo (!empty($data['h4-size']['line-height'])) ? esc_html($data['h4-size']['line-height']) : ''; ?>;
  color:<?php echo (!empty($data['h4-size']['color'])) ? esc_html($data['h4-size']['color']) : ''; ?>;
  text-transform:<?php echo (!empty($data['h4-size']['text-transform'])) ? esc_html($data['h4-size']['text-transform']) : ''; ?>;
  margin-bottom:15px;
}

h5 {
  font-family:<?php echo (!empty($data['h5-size']['font-family'])) ? esc_html($data['h5-size']['font-family']) : ''; ?>;
  font-weight: <?php echo (!empty($data['h5-size']['font-weight'])) ? esc_html($data['h5-size']['font-weight']) : ''; ?>;
  font-size: <?php echo (!empty($data['h5-size']['font-size'])) ? esc_html($data['h5-size']['font-size']) : ''; ?>;
  line-height:<?php echo (!empty($data['h5-size']['line-height'])) ? esc_html($data['h5-size']['line-height']) : ''; ?>;
  color:<?php echo (!empty($data['h5-size']['color'])) ? esc_html($data['h5-size']['color']) : ''; ?>;
  text-transform:<?php echo (!empty($data['h5-size']['text-transform'])) ? esc_html($data['h5-size']['text-transform']) : ''; ?>;
  margin-bottom:10px;
}

h6 {
  font-family:<?php echo (!empty($data['h6-size']['font-family'])) ? esc_html($data['h6-size']['font-family']) : ''; ?>;
  font-weight: <?php echo (!empty($data['h6-size']['font-weight'])) ? esc_html($data['h6-size']['font-weight']) : ''; ?>;
  font-size: <?php echo (!empty($data['h6-size']['font-size'])) ? esc_html($data['h6-size']['font-size']) : ''; ?>;
  line-height:<?php echo (!empty($data['h6-size']['line-height'])) ? esc_html($data['h6-size']['line-height']) : ''; ?>;
  color:<?php echo (!empty($data['h6-size']['color'])) ? esc_html($data['h6-size']['color']) : ''; ?>;
  text-transform:<?php echo (!empty($data['h6-size']['text-transform'])) ? esc_html($data['h6-size']['text-transform']) : ''; ?>;
  margin-bottom:10px;
}



/*---------------------------------------------------------------
3. TITLE SEPARATOR LINE 
---------------------------------------------------------------*/
.after-titile-line { 
    background-image:url(<?php echo (!empty($data['icon-between-devider']['url'])) ? esc_html($data['icon-between-devider']['url']) : ''; ?>) ;
    background-position:center;
    background-size:cover;
    width:26px; 
    height:26px; 
    margin:0 auto 10px; 
    display:block; 
    position:relative; 
}

.after-titile-line:before,
.after-titile-line:after { 
	content:""; 
	width:50px; 
	height:2px; 
	background:#a7a7a7; 
	position:absolute; 
	top:10px; 
	right:35px;
}

.after-titile-line:after { 
    right:auto; 
    left:35px; 
}

.line { 
	position:relative; 
}
.line:after { 
    background:<?php echo (!empty($data['color-scheme'])) ? esc_html($data['color-scheme']) : ''; ?>; 
    content:"";  
    width:80px; 
    height:2px; 
    display:inline-block; 
    margin:0px 0 30px; 
}

/*---------------------------------------------------------------
4. TEXT & PARAGRAPH 
---------------------------------------------------------------*/
p {
  line-height:24px;
  margin-bottom:24px;
}

strong { 
	font-weight:600;
}

/*text align*/
.text-left {
	text-align: left;
}

.text-center {
	text-align: center;
}

.text-right {
	text-align: right;
}

.text-justify {
	text-align: justify
}


/*text vertical align*/
.v-align-t { 
	vertical-align:top;
}

.v-align-m { 
	vertical-align:middle;
}

.v-align-b { 
	vertical-align:bottom;
}

/*text no line brack*/
.text-nowrap {
	white-space: nowrap
}


/*text transform*/
.text-lowercase {
	text-transform: lowercase
}

.text-uppercase {
	text-transform: uppercase
}

.text-capitalize {
	text-transform: capitalize
}


/*text size*/
.font-size-14 { 
	font-size:14px;
}

.font-size-16 { 
	font-size:16px;
}

.font-size-18 { 
	font-size:18px;
}

.font-size-20 { 
	font-size:20px;
}

/*text size*/
.font-weight-300{font-weight:300;}
.font-weight-400{font-weight:400;}
.font-weight-500{font-weight:500;}
.font-weight-600{font-weight:600;}
.font-weight-700{font-weight:700;}
.font-weight-800{font-weight:800;}
.font-weight-900{font-weight:900;}

/*---------------------------------------------------------------
5. LISTING STYLES 
---------------------------------------------------------------*/
dl, ul, ol {
    list-style-position: outside ;
    padding: 0;
}
ul, ol {
	margin-left:20px;
	margin-bottom:24px;
}
ul {
    list-style:disc;
}
ol {
    list-style:decimal;
}
 ul li,
 ol li {
    padding:0;
}
dl {
    margin-left:0;
	margin-bottom:30px;
}
dl dd{
    margin-bottom:10px;
}

.list-arrow,
.list-checked {
    margin: 0 0 20px 15px;
	list-style:none; 
}

.list-arrow li,
.list-checked li{
    padding:5px 5px 5px 20px;
    position: relative;
}

.list-arrow li:before,
.list-checked li:before{
	position: absolute;
	left: 0;
	top: 5px;
	display: block;
	font-family: "FontAwesome";
  
}

.list-arrow li:before{	content: "\f0da"; }
.list-checked li:before{	content: "\f046"; }

.page-content  ul li,
.page-content  ol li {
    padding:;
}

.page-content .list-arrow,
.page-content .list-checked {
    margin: 0 0 20px 15px;
	list-style:none; 
}

.page-content .list-arrow li,
.page-content .list-checked li{
    padding:5px 5px 5px 20px;
    position: relative;
}

.page-content dl.no-margin, 
.page-content ul.no-margin, 
.page-content ol.no-margin {
    margin: 0 0 0 0 !important;
	list-style:none;
}


/*---------------------------------------------------------------
6. BOX SPACING (inner & outer)
---------------------------------------------------------------*/
/*== >padding (around) ======*/
.padding-0 {padding:0;}
.padding-5 {padding:5px;}
.padding-10 {padding:10px;}
.padding-20 {padding:20px;}
.padding-30 {padding:30px;}
.padding-40 {padding:40px;}
.padding-50 {padding:50px;}

/*== >Padding (top) ==*/
.padding-t-0 {padding-top:0;}
.padding-t-5 {padding-top:5px;}
.padding-t-10 {padding-top:10px;}
.padding-t-20 {padding-top:20px;}
.padding-t-30 {padding-top:30px;}
.padding-t-40 {padding-top:40px;}
.padding-t-50 {padding-top:50px;}
.padding-t-60 {padding-top:60px;}
.padding-t-70 {padding-top:70px;}
.padding-t-80 {padding-top:80px;}
.padding-t-90 {padding-top:90px;}
.padding-t-100 {padding-top:100px;}

/*== >Padding (bottom) ==*/
.padding-b-0 {padding-bottom:0;}
.padding-b-5 {padding-bottom:5px;}
.padding-b-10 {padding-bottom:10px;}
.padding-b-20 {padding-bottom:20px;}
.padding-b-30 {padding-bottom:30px;}
.padding-b-40 {padding-bottom:40px;}
.padding-b-50 {padding-bottom:50px;}
.padding-b-60 {padding-bottom:60px;}
.padding-b-70 {padding-bottom:70px;}
.padding-b-80 {padding-bottom:80px;}
.padding-b-90 {padding-bottom:90px;}
.padding-b-100 {padding-bottom:100px;}

/*== >Padding (left) ==*/
.padding-l-0 {padding-left:0;}
.padding-l-5 {padding-left:5px;}
.padding-l-10 {padding-left:10px;}
.padding-l-20 {padding-left:20px;}
.padding-l-30 {padding-left:30px;}
.padding-l-40 {padding-left:40px;}
.padding-l-50 {padding-left:50px;}

/*== >Padding (right) ==*/
.padding-r-0 {padding-right:0;}
.padding-r-5 {padding-right:5px;}
.padding-r-10 {padding-right:10px;}
.padding-r-20 {padding-right:20px;}
.padding-r-30 {padding-right:30px;}
.padding-r-40 {padding-right:40px;}
.padding-r-50 {padding-right:50px;}

/*== >Padding (left right) ==*/
.padding-lr-0 {padding-left:0; padding-right:0; }
.padding-lr-5 {padding-left:5px; padding-right:5px;}
.padding-lr-10 {padding-left:10px; padding-right:10px;}
.padding-lr-20 {padding-left:20px; padding-right:20px;}
.padding-lr-30 {padding-left:30px; padding-right:30px;}
.padding-lr-40 {padding-left:40px; padding-right:40px;}
.padding-lr-50 {padding-left:50px; padding-right:50px;}

/*== >Padding (top bottom) ==*/
.padding-tb-0 {padding-bottom:0; padding-top:0; }
.padding-tb-5 {padding-bottom:5px; padding-top:5px;}
.padding-tb-10 {padding-bottom:10px; padding-top:10px;}
.padding-tb-20 {padding-bottom:20px; padding-top:20px;}
.padding-tb-30 {padding-bottom:30px; padding-top:30px;}
.padding-tb-40 {padding-bottom:40px; padding-top:40px;}
.padding-tb-50 {padding-bottom:50px; padding-top:50px;}
.padding-tb-60 {padding-bottom:60px; padding-top:60px;}
.padding-tb-70 {padding-bottom:70px; padding-top:70px;}
.padding-tb-80 {padding-bottom:80px; padding-top:80px;}
.padding-tb-90 {padding-bottom:90px; padding-top:90px;}
.padding-tb-100 {padding-bottom:100px; padding-top:100px;}


/*== >margin (around) ======*/
.margin-0 {margin:0;}
.margin-5 {margin:5px;}
.margin-10 {margin:10px;}
.margin-20 {margin:20px;}
.margin-30 {margin:30px;}
.margin-40 {margin:40px;}
.margin-50 {margin:50px;}

/*== >marging (top) ==*/
.margin-t-0 {margin-top:0;}
.margin-t-5 {margin-top:5px;}
.margin-t-10 {margin-top:10px;}
.margin-t-20 {margin-top:20px;}
.margin-t-30 {margin-top:30px;}
.margin-t-40 {margin-top:40px;}
.margin-t-50 {margin-top:50px;}

/*== >marging (bottom) ==*/
.margin-b-0 {margin-bottom:0;}
.margin-b-5 {margin-bottom:5px;}
.margin-b-10 {margin-bottom:10px;}
.margin-b-20 {margin-bottom:20px;}
.margin-b-30 {margin-bottom:30px;}
.margin-b-40 {margin-bottom:40px;}
.margin-b-50 {margin-bottom:50px;}

/*== >marging (left) ==*/
.margin-l-0 {margin-left:0;}
.margin-l-5 {margin-left:5px;}
.margin-l-10 {margin-left:10px;}
.margin-l-20 {margin-left:20px;}
.margin-l-30 {margin-left:30px;}
.margin-l-40 {margin-left:40px;}
.margin-l-50 {margin-left:50px;}

/*== >marging (right) ==*/
.margin-r-0 {margin-right:0;}
.margin-r-5 {margin-right:5px;}
.margin-r-10 {margin-right:10px;}
.margin-r-20 {margin-right:20px;}
.margin-r-30 {margin-right:30px;}
.margin-r-40 {margin-right:40px;}
.margin-r-50 {margin-right:50px;}

/*== >marging (left right) ==*/
.margin-lr-0 {margin-left:0; margin-right:0; }
.margin-lr-5 {margin-left:5px; margin-right:5px; }
.margin-lr-10 {margin-left:10px; margin-right:10px; }
.margin-lr-20 {margin-left:20px; margin-right:20px; }
.margin-lr-30 {margin-left:30px; margin-right:30px; }
.margin-lr-40 {margin-left:40px; margin-right:40px; }
.margin-lr-50 {margin-left:50px; margin-right:50px; }

/*== >marging (top bottom) ==*/
.margin-tb-0 {margin-bottom:0; margin-top:0; }
.margin-tb-5 {margin-bottom:5px; margin-top:5px; }
.margin-tb-10 {margin-bottom:10px; margin-top:10px; }
.margin-tb-20 {margin-bottom:20px; margin-top:20px; }
.margin-tb-30 {margin-bottom:30px; margin-top:30px; }
.margin-tb-40 {margin-bottom:40px; margin-top:40px; }
.margin-tb-50 {margin-bottom:50px; margin-top:50px; }


/*---------------------------------------------------------------
7. POSITIONS css ( absolute & relative & statice & z-index )
---------------------------------------------------------------*/
.absolute{position:absolute;}
.relative{position:relative;}
.static{position:static;}

.z-index1{z-index:1;}
.z-index2{z-index:2;}
.z-index3{z-index:3;}
.z-index4{z-index:4;}
.z-index5{z-index:5;}
.z-index6{z-index:6;}
.z-index7{z-index:7;}
.z-index8{z-index:8;}
.z-index9{z-index:9;}
.z-index10{z-index:10;}
.z-index100{z-index:100;}
.z-index999{z-index:999;}


/*---------------------------------------------------------------
8. COLOR (text & background)
---------------------------------------------------------------*/

/*=== >text ===*/
.text-white{color:#fff;}
.text-primary{color:<?php echo (!empty($data['color-scheme'])) ? esc_html($data['color-scheme']) : ''; ?>;}
.text-black{color:#000;}
.text-gray{color:#666;}
.text-red{color:#F00;}
.text-green{color:#090;}
.text-yellow{color:#FF0;}

/*=== >background ===*/
.bg-transparent{background-color:transparent;}
.bg-primary{background-color:<?php echo (!empty($data['color-scheme'])) ? esc_html($data['color-scheme']) : ''; ?>;}
.bg-white{background-color:#FFF;}
.bg-black{background-color:#000;}
.bg-gray{background-color:#f7f8fa;}
.bg-red{background-color:#FF4045;}
.bg-green{background-color:#38E225;}
.bg-yellow{background-color:#F0F52E;}


/*---------------------------------------------------------------
9. OVERLAY ( transparient box style  )
---------------------------------------------------------------*/
.sf-overlay-wrapper {
	position:absolute;
	top:0;
	left:0;
	width:100%;
	height:100%;
}

/*use for section*/
.overlay-black-light,
.overlay-black-middle,
.overlay-black-dark,
.overlay-white-light,
.overlay-white-middle,
.overlay-white-dark { 
	position:relative; 
}

.overlay-black-light:after,
.overlay-black-middle:after,
.overlay-black-dark:after,
.overlay-white-light:after,
.overlay-white-middle:after,
.overlay-white-dark:after { 
	content:"";
	position:absolute;
	left:0;
	top:0;
	width:100%;
	height:100%;
}

.overlay-black-light:after,
.overlay-black-middle:after,
.overlay-black-dark:after { 
	background:#000;
}

.overlay-white-light:after,
.overlay-white-middle:after,
.overlay-white-dark:after { 
	background:#FFF;
}

.overlay-black-light:after { opacity:0.3;}
.overlay-black-middle:after { opacity:0.5;}
.overlay-black-dark:after { opacity:0.8;}

.overlay-white-light:after { opacity:0.3;}
.overlay-white-middle:after { opacity:0.5;  }
.overlay-white-dark:after { opacity:0.8;}

.overlay-black-light .container,
.overlay-black-middle .container,
.overlay-black-dark .container,
.overlay-white-light .container,
.overlay-white-middle .container,
.overlay-white-dark  .container{ 
	position:relative;
	z-index:1; 
}

/*use for box*/
.overlay-bx { 
	position:absolute; 
	left:0; 
	bottom:0; 
	width:100%; 
	height:100%; 
	text-align:center; 
	z-index:1; 
	opacity:0; 
	visibility:hidden; 
}

.overlay-icon { 
	list-style:none; 
	width:160px; 
	height:40px; 
	position:absolute; 
	left:50%; 
	top:50%; 
	margin:-20px -75px;    
}

.overlay-icon a { 
	display:inline-block; 
	padding:0;
	margin:0 2px;
}

.overlay-icon a i { 
	-moz-transform: translatey(80%);
	-webkit-transform: translatey(80%);
	-o-transform: translatey(80%);
	-ms-transform: translatey(80%);
	transform: translatey(80%);
}


.overlay-bx:hover a > i,
.sf-thum-bx:hover .overlay-bx  a > i,
.sf-element-bx:hover .overlay-bx  a > i { 

	opacity:1; 
	visibility:visible; 
	
	-moz-transform: translatey(0);
	-webkit-transform: translatey(0);
	-o-transform: translatey(0);
	-ms-transform: translatey(0);
	transform: translatey(0);
	
	-webkit-transition-delay:0.1s;
    -moz-transition-delay: 0.1s;
    -o-transition-delay: 0.1s;
    transition-delay: 0.1s;

}

.overlay-bx:hover,
.sf-thum-bx:hover .overlay-bx,
.sf-element-bx:hover .overlay-bx  { 
	opacity:1; 
	visibility:visible; 
}

/* show for text */
.overlay-text { 
	width:100%; 
	position:absolute;
	padding:20px;
	color:#FFF;
	left:0; 
	bottom:20px; 
}

.sf-address-bx {
	display:table;
	text-align:left;
	padding:20px 20px 20px 25px;
	width:100%;
	height:100%;
	position:relative;
	font-size:13px;
	vertical-align:middle;
    font-weight:600;
}
.sf-address-bx .fa{
	position:absolute;
	top:22px;
	left:5px;
	font-size:22px;
}
.col-md-3 .overlay-text {
	padding:5px;
}
.col-md-4 .overlay-text {
	padding:20px;
}
.sf-address2-bx {
	display:table;
	background:#eaeaea;
	padding:5px 10px;
	margin-bottom:10px
}


/*---------------------------------------------------------------
10. BOXES CSS 
---------------------------------------------------------------*/
.rounded-bx,
.sf-element-bx ,
.icon-bx ,
.icon-bx-small,
.sf-thum-bx,
.post-thum-bx {
	position:relative;	
}

.rounded-bx {
  -webkit-border-radius:100%; 
  -moz-border-radius:100%; 
  border-radius:100%; 	 
}


.section-head {
	margin-bottom:0;
}

.section-head h1,
.section-head h2,
.section-head h3 {
	margin-top:0;
}

.section-head p{
	font-size:14px;
	color:#939393;
	max-width:700px;
	margin:auto; 
}

.section-content{margin-top:50px;}

.w-t-element { color:#FFF; }
.w-t-element h1,
.w-t-element h2,
.w-t-element h3,
.w-t-element h4,
.w-t-element h5,
.w-t-element h6,
.w-t-element p { 
	color:#FFF; 
}
.w-t-element .after-titile-line:before, 
.w-t-element .after-titile-line:after { 
	background:#FFF; 
}

/*==box content==*/
.sf-element-bx { 
	margin-bottom:30px; 
}

/*==for icons==*/
.icon-bx-xl,
.icon-bx-lg,
.icon-bx-md,
.icon-bx-sm,
.icon-bx-xs {
	background-color: #f2f2f2;
    color: <?php echo (!empty($data['color-scheme'])) ? esc_html($data['color-scheme']) : ''; ?>;
	display:inline-block;
    margin: auto;
    text-align: center;
}

.icon-bx-xl {
	width:160px;
	height:160px;
	line-height:160px;
}

.icon-bx-lg {
	width:130px;
	height:130px;
	line-height:130px;
}

.icon-bx-md {
	width:100px;
	height:100px;
	line-height:100px;
}

.icon-bx-sm {
	width:80px;
	height:80px;
	line-height:80px;
}

.icon-bx-xs {
	width:40px;
	height:40px;
	line-height:40px;
}


.icon-bx-xl i
.icon-bx-lg i,
.icon-bx-md i,
.icon-bx-sm i,
.icon-bx-xs i {
	vertical-align:middle;
}


.icon-bx-xls i {
	font-size:80px;
}

.icon-bx-lg i {
	font-size:60px;
}

.icon-bx-md i {
	font-size:45px;
}

.icon-bx-sm i {
	font-size:30px;
}

.icon-bx-xs i {
	font-size:20px;
}

.icon-bx-xl img,
.icon-bx-lg img,
.icon-bx-md img,
.icon-bx-sm img,
.icon-bx-xs img {
	vertical-align:middle;
	max-width:100%;
	width:auto; 
}

.icon-bx-lg img {
	height:80px;
}

.icon-bx-lg img {
	height:60px;
}

.icon-bx-md img {
	height:40px;
}

.icon-bx-sm img {
	height:30px;
}

.icon-bx-xs img {
	height:20px;
}

/*==for images==*/
.sf-thum-bx { 
	background-color:#fff;
}

.sf-thum-bx img,
.post-thum-bx img,
.post-thum img { 
	width:100%; 
	height:auto; 
}


/*---------------------------------------------------------------
11. IMAGES EFFECTS (overly animation)  
---------------------------------------------------------------*/
.img-effect1,
.img-effect2,
.img-effect3,
.img-effect4,
.img-effect5,
.img-effect6,
.img-effect7,
.img-effect8,
.img-effect9 { 
	position:relative; 
}
.img-effect1:before,
.img-effect1:after,
.img-effect2:before,
.img-effect2:after,
.img-effect3:before,
.img-effect3:after,
.img-effect4:before,
.img-effect4:after,
.img-effect5:before,
.img-effect5:after,
.img-effect6:before,
.img-effect6:after,
.img-effect7:before,
.img-effect7:after,
.img-effect8:before,
.img-effect8:after,
.img-effect9:before,
.img-effect9:after {
	content:"";
	background:#000;
	position:absolute; 
	left:0; 
	top:0; 
	width:0; 
	height:0;
	opacity:0.5; 
	-webkit-transition:all 0.3s linear;
	-moz-transition:all 0.3s linear;
	-ms-transition:all 0.3s linear;
	-o-transition:all 0.3s linear;
	transition:all 0.3s linear;
}


.img-effect1:hover:before,
.img-effect1:hover:after,
.img-effect2:hover:before,
.img-effect2:hover:after,
.img-effect3:hover:before,
.img-effect3:hover:after,
.img-effect4:hover:before,
.img-effect4:hover:after,
.img-effect5:hover:before,
.img-effect5:hover:after,
.img-effect6:hover:before,
.img-effect6:hover:after,
.img-effect7:hover:before,
.img-effect7:hover:after,
.img-effect8:hover:before,
.img-effect8:hover:after,
.img-effect9:hover:before,
.img-effect9:hover:after {
	-webkit-transition: all 0.3s ease-in-out;
	-moz-transition: all 0.3s ease-in-out;
	-o-transition: all 0.3s ease-in-out;
	transition: all 0.3s ease-in-out;
}


/*effect 1*/
.img-effect1:before {
	width:100%;
	height:100%;
	opacity:0;
}

.img-effect1:hover:before,
.sf-element-bx:hover .img-effect1:before { 
	opacity:0.5;
}

/*effect 2*/
.img-effect2:before {
	left:50%; 
	top:50%;
}

.img-effect2:hover:before,
.sf-element-bx:hover .img-effect2:before  { 
	width:100%;
	height:100%;
	top:0;
	left:0;
}

/*effect 3*/
.img-effect3:before {
	left:50%; 
	top:0;
	height:100%;
}

.img-effect3:hover:before,
.sf-element-bx:hover .img-effect3:before { 
	width:100%;
	left:0;
}

/*effect 4*/
.img-effect4:before {
	left:0; 
	top:50%;
	width:100%;
}

.img-effect4:hover:before,
.sf-element-bx:hover .img-effect4:before { 
	height:100%;
	top:0;
}

/*effect 5*/
.img-effect5:before {
	left:0; 
	top:auto;
	bottom:0;
	width:100%;
}

.img-effect5:hover:before,
.sf-element-bx:hover .img-effect5:before { 
	height:100%;
}

/*effect 6*/
.img-effect6:before,
.img-effect6:after {
	height:100%;
}
.img-effect6:after {
	left:auto;
	right:0;
}
.img-effect6:hover:before,
.img-effect6:hover:after,
.sf-element-bx:hover .img-effect6:before,
.sf-element-bx:hover .img-effect6:after
 { 
	width:50%;
}

/*effect 7*/
.img-effect7:before,
.img-effect7:after {
	height:100%;
}
.img-effect7:after {
	left:auto;
	right:0;
}
.img-effect7:hover:before,
.img-effect7:hover:after,
.sf-element-bx:hover .img-effect7:before,
.sf-element-bx:hover .img-effect7:after { 
	width:100%;
	opacity:0.3;
}

/*effect 8*/
.img-effect8:before,
.img-effect8:after {
	
}
.img-effect8:after {
	left:auto;
	right:0;
	top:auto;
	bottom:0;
	
}
.img-effect8:hover:before,
.img-effect8:hover:after,
.sf-element-bx:hover .img-effect8:before,
.sf-element-bx:hover .img-effect8:after { 
	width:100%;
	height:100%; 
	opacity:0.3;
}

/*effect 9*/
.img-effect9:before,
.img-effect9:after {
	width:100%;
	height:100%;
	opacity:0;
}

.img-effect9:hover:before,
.sf-element-bx:hover .img-effect9:before { 
	opacity:0.5;
}

.img-effect9:hover:after,
.sf-element-bx:hover .img-effect9:after { 
	width:90%;
	height:80%;
	left:5%;
	top:10%; 
	opacity:0.5;
	background:none;
	border:1px dashed #FFFFFF; 
}


/*---------------------------------------------------------------
12. CUSTOM ELEMENTS ( tabs & accordian & modal pop )
---------------------------------------------------------------*/
/*no-radius*/
.btn,
.panel, 
.form-control,
.img-thumbnail,
.panel-heading,
.dropdown-menu,
.panel-group .panel,
.nav-tabs > li > a,
.modal-content,
.navbar-toggle,
.nav-pills > li > a,
.pager li > a, 
.pager li > span,
.well,
.alert
 {
  -webkit-border-radius: 0; 
  -moz-border-radius: 0; 
  border-radius: 0; 
 }
 
/*no-box-shadow*/ 
.panel,
.well { 
	box-shadow:none; 
	-webkit-box-shadow:none;
}
 
.panel-group .panel + .panel{margin:-1px 0 0;}

/*accodian style 1*/
.accodian-style1 .panel-heading { 
	position:relative;
}
.accodian-style1 .panel-heading a { 
	display:block; 
	position:relative; 
	z-index:1;
}
.accodian-style1 .indicator { 
	font-size:12px; 
	color:#9b9b9b; 
	position:absolute; 
	right:-1px; 
	top:-1px; 
	padding:18px; 
	text-align:center;  
	border:1px solid #e1e1e1;
}

/*accodian style 2*/
.accodian-style2 .indicator { 
	border:1px solid #e1e1e1;
}


/*tabs style 1*/
.tabbable  .nav-tabs { 
	margin:0; 
}
.tabbable .nav-tabs li { 
	padding:0;
	margin-right:10px; 
}

.tabbable .nav-tabs li a{ 
	border-width:1px;
	border-color:#e1e1e1 #e1e1e1 ;
	border-style:solid;
	background:#f6f6f6;
	color:#555555; 
	margin:0;
	text-transform:uppercase;
	font-size:13px;
	font-weight:600;
	padding:13px 20px;
}

.tabbable .nav-tabs li.active a,
.tabbable .nav-tabs li:hover a,
.tabbable .nav-tabs li:focus a{ 
	background:#FFFFFF;
	border-bottom-color:#FFF;
	color:#555555; 
}

.tabbable .tab-content { 
	border-width:0 1px 1px;
	border-color:#e1e1e1;
	border-style:solid;
	background:#FFF;
}

.tabbable .tab-pane { 
	padding:30px;
}

/*tabs left style*/
.tabbable.tabs-left .nav-tabs li,
.tabbable.tabs-right .nav-tabs li{
	float:none;
	margin:0 0 10px;
}

.tabbable.tabs-left .nav-tabs li:last-child,
.tabbable.tabs-right .nav-tabs lilast-child{
	margin-bottom:0;
}

.tabbable.tabs-left .nav-tabs,
.tabbable.tabs-right .nav-tabs {
	border-bottom:none;
}

.tabbable.tabs-left .nav-tabs {
	border-right: 1px solid #ddd;
	position:relative;
	z-index:1;
}

.tabbable.tabs-left .nav-tabs li{
	margin-right: -1px;
}

@media only screen and (max-width: 767px) {
	
.tabbable.tabs-left .nav-tabs li{
	margin-right: -1px;
	width:14.111%;
	float:left;
    overflow:hidden;
}
.tabbable.tabs-left .nav-tabs li a{
	font-size:11px;
	padding:13px 10px;
}

}

.tabbable.tabs-left .nav-tabs li.active a,
.tabbable.tabs-left .nav-tabs li:hover a,
.tabbable.tabs-left .nav-tabs li:focus a{ 
	border-right-color:#FFF;
	border-bottom-color:#e1e1e1;
}


.tabbable.tabs-left .tab-content,
.tabbable.tabs-right .tab-content { 
	min-height:300px;
}

.tabbable.tabs-left .tab-content,
.tabbable.tabs-right .tab-content { 
	border-width:1px;
	border-color:#e1e1e1;
	border-style:solid;
	
}

.tabbable.tabs-left .tab-content { 
	margin-left:-1px;
}


/*modal pop */

.city-autocomplete {
	width:100% !important;
    position: absolute;
	left:0 !important;
	top:auto !important;
    z-index: 10000;
    background: #fff;
    border: 1px solid #c3cacf;
    display: none;
    font-family: Arial, sans-serif;
    -webkit-box-shadow: 0 8px 17px 0 rgba(0, 0, 0, 0.2);
    -moz-box-shadow: 0 8px 17px 0 rgba(0, 0, 0, 0.2);
    box-shadow: 0 8px 17px 0 rgba(0, 0, 0, 0.2);
    -webkit-border-bottom-right-radius: 5px;
    -moz-border-radius-bottomright: 5px;
    border-bottom-right-radius: 5px;
    -webkit-border-bottom-left-radius: 5px;
    -moz-border-radius-bottomleft: 5px;
    border-bottom-left-radius: 5px;
}

.city-autocomplete > div {
    font-size: 13px;
    padding: 5px 10px;
    cursor: pointer;
}

.city-autocomplete > div:hover {
    background: #c3cacf;
}
.pac-container {
    background-color: #FFF;
    z-index:100;
    position:fixed;
    display: inline-block;
    float: left;
}
.modal{
    z-index: 100;   
}
.modal-backdrop{
    z-index: 50;        
}​

.modal {
}
.modal-header { 
	background:<?php echo (!empty($data['color-scheme'])) ? esc_html($data['color-scheme']) : ''; ?>;
	padding:15px 25px;
}

.modal-header .modal-title { 
	color:#fff;
}

.modal .modal-body {
	padding:25px;	
}

.modal-xlg {
	width:1000px;	
}

.provider_registration .bootstrap-select div.dropdown-menu ul li a,
.provider_registration_page .bootstrap-select div.dropdown-menu ul li a {
	font-weight:600;
}
.provider_registration .bootstrap-select div.dropdown-menu ul li a span.childcat,
.provider_registration_page .bootstrap-select div.dropdown-menu ul li a span.childcat { 
	font-weight:400;
    color:#7c7c7c;  
}

@media only screen and (max-width: 1024px) {
	
.modal-xlg {
	width:auto;
	margin-left:15px;
	margin-right:15px;	
}	

}

/* Data tables */
div.dataTables_filter,
div.dataTables_length,
div.dataTables_paginate,
div.dataTables_info {
	margin:0 -15px;
}


div.dataTables_filter input {
	margin-left:0;
	margin-right:5px;
}

@media only screen and (max-width:767px) {

div.dataTables_filter,
div.dataTables_length,
div.dataTables_paginate,
div.dataTables_info {
	margin:0;
}
div.dataTables_paginate,
div.dataTables_info {
	text-align:left;
}

div.dataTables_filter,
div.dataTables_length {
	display:table;
}

}


/*== > PRICING BOX CSS START ==*/
.pricingtable-inner {
	text-align:center;
}
.pricingtable-price {
	padding:20px 20px;
	background-color:#F4F7F8;
	border:1px solid #E9E9E9;
}
.pricingtable-bx {
	font-size:50px;
	font-family:Arial;
	color:#666666;
}
.pricingtable-type {
	font-size:20px;
	text-transform:uppercase;
	font-size:16px;
}
.pricingtable-type:before {
	content:"/";
	margin-right:3px;
	
}
.pricingtable-title {
	background-color:#1BBCE8;
	padding:20px;
	text-transform:uppercase;
	
}
.pricingtable-title * {
	margin:0;
	color:#fff;
	font-weight:800;
}
.pricingtable-features {
	margin:0;
	padding:0;
	list-style:none;
	border:1px solid #E9E9E9;
}
.pricingtable-features li {
	padding:12px;
	border-bottom:1px solid #E9E9E9;
}
.pricingtable-features li i{
	margin:0 3px;
}
.pricingtable-features li:nth-child(even) {
	background-color:#F4F7F8;
}
.pricingtable-features li:last-child {
	border-bottom:none;
}
.pricingtable-footer {
	margin-top:-1px;
	padding:20px;
	background-color:#F4F7F8;
	border:1px solid #E9E9E9;
}

.pricingtable-highlight {
	margin:-20px 0;
	-webkit-box-shadow: 0 0 10px 5px rgba(0,0,0,0.2);
	box-shadow: 0 0 10px 5px rgba(0,0,0,0.2);
	position:relative;
	z-index:99;
}
.pricingtable-highlight .pricingtable-price {
	padding:30px 20px;
}
.pricingtable-highlight .pricingtable-footer {
	padding:30px 20px;
}
.no-col-gap .pricingtable-wrapper {
    margin-left: -1px;
}



/*---------------------------------------------------------------
13. TRANSITION (Slow animateion speed) 
---------------------------------------------------------------*/
a,
.btn, 
.form-control,
.overlay-bx,
ul.overlay-icon li a i,
.icon-bx-xl,
.icon-bx-lg,
.icon-bx-md,
.icon-bx-sm,
.icon-bx-xs,
ul.share-social-bx li,
.indicator,
.profile-menu ul li,
.staff-member .member-done,
.how-sf-work .sf-element-bx .shadow-bx img,
.how-sf-work .sf-element-bx .step-no-bx {
	-webkit-transition:all 0.2s linear;
	-moz-transition:all 0.2s linear;
	-ms-transition:all 0.2s linear;
	-o-transition:all 0.2s linear;
	transition:all 0.2s linear;
 }

.animate-slow {
    -webkit-transition: all 0.3s ease-out;
    -moz-transition: all 0.3s ease-out;
    -o-transition: all 0.3s ease-out;
    -ms-transition: all 0.3s ease-out;
    transition: all 0.3s ease-out;
}
.animate-mid {
    -webkit-transition: all 0.5s ease-out;
    -moz-transition: all 0.5s ease-out;
    -o-transition: all 0.5s ease-out;
    -ms-transition: all 0.5s ease-out;
    transition: all 0.5s ease-out;
}
.animate-fast {
    -webkit-transition: all 0.8s ease-out;
    -moz-transition: all 0.8s ease-out;
    -o-transition: all 0.8s ease-out;
    -ms-transition: all 0.8s ease-out;
    transition: all 0.8s ease-out;
}

.admin-bar #header-part.fix-map-header .main-bar {
	top:28px;
}

/*---------------------------------------------------------------
14. BUTTON STYLE 
---------------------------------------------------------------*/
.btn {
    border-left: none;
    border-right: none;
    border-top: none;
    border-width: 2px;
    box-shadow: none !important;
    font-weight: normal;
    outline: 0 none !important;
    padding:9px 20px;
    text-decoration: none;
}

.btn-lg,
.btn-group-lg > .btn { 
padding:15px 30px;
} 

.btn-sm,
.btn-group-sm > .btn  {
    padding: 5px 10px;
}

.btn-xs,
.btn-group-xs > .btn 
 {
    padding: 1px 5px;
}



.btn-default {
    background-color: #f0f0f0;
}

.btn-primary,
.owl-prev,
.owl-next {
    background-color: <?php echo (!empty($data['button-primary-background-color'])) ? esc_html($data['button-primary-background-color']) : ''; ?>;
    border-color: <?php echo (!empty($data['button-primary-border-color'])) ? esc_html($data['button-primary-border-color']) : ''; ?>;
    color: <?php echo (!empty($data['button-primary-color'])) ? esc_html($data['button-primary-color']).'!important' : ''; ?>;
}

.btn-primary:hover, 
.btn-primary.focus, 
.btn-primary:focus, 
.btn-primary.active, 
.btn-primary:active, .open > 
.dropdown-toggle.btn-primary,
.owl-prev:hover,
.owl-prev:active,
.owl-prev:focus,
.owl-next:hover,
.owl-next:active,
.owl-next:focus
 {
    background-color: <?php echo (!empty($data['button-primary-hover-background-color'])) ? esc_html($data['button-primary-hover-background-color']) : ''; ?>;
    border-color: <?php echo (!empty($data['button-primary-hover-border-color'])) ? esc_html($data['button-primary-hover-border-color']) : ''; ?>;
    color: <?php echo (!empty($data['button-primary-hover-color'])) ? esc_html($data['button-primary-hover-color']).'!important' : ''; ?>;
}

.btn-primary.active.focus, 
.btn-primary.active:focus, 
.btn-primary.active:hover, 
.btn-primary.focus:active, 
.btn-primary:active:focus, 
.btn-primary:active:hover, 
.open > .dropdown-toggle.btn-primary.focus, 
.open > .dropdown-toggle.btn-primary:focus, 
.open > .dropdown-toggle.btn-primary:hover {
    background-color: <?php echo (!empty($data['button-primary-hover-background-color'])) ? esc_html($data['button-primary-hover-background-color']) : ''; ?>;
    border-color: <?php echo (!empty($data['button-primary-hover-border-color'])) ? esc_html($data['button-primary-hover-border-color']) : ''; ?>;
    color: <?php echo (!empty($data['button-primary-hover-color'])) ? esc_html($data['button-primary-hover-color']).'!important' : ''; ?>;
}

.btn-custom {
    background-color: <?php echo (!empty($data['button-secondary-background-color'])) ? esc_html($data['button-secondary-background-color']) : ''; ?>;
    border-color: <?php echo (!empty($data['button-secondary-border-color'])) ? esc_html($data['button-secondary-border-color']) : ''; ?>;
    color: <?php echo (!empty($data['button-secondary-color'])) ? esc_html($data['button-secondary-color']).'!important' : ''; ?>;
}

.btn-custom:hover, 
.btn-custom.focus, 
.btn-custom:focus, 
.btn-custom.active, 
.btn-custom:active, 
.open > .dropdown-toggle.btn-custom {
    background-color: <?php echo (!empty($data['button-secondary-hover-background-color'])) ? esc_html($data['button-secondary-hover-background-color']) : ''; ?>;
    border-color: <?php echo (!empty($data['button-secondary-hover-border-color'])) ? esc_html($data['button-secondary-hover-border-color']) : ''; ?>;
    color: <?php echo (!empty($data['button-secondary-hover-color'])) ? esc_html($data['button-secondary-hover-color']).'!important' : ''; ?>;
}

.btn-border{
	background:#FFF; 
	border:1px solid #e1e1e1;
	color:#767676;
}
a.btn.btn-border{
	color:#767676;
}
a.btn.btn-border:hover,
a.btn.btn-border:focus,
a.btn.btn-border:active{
	color:#767676;
}

.btn-border:hover, 
.btn-border.focus, 
.btn-border:focus, 
.btn-border.active, 
.btn-border:active, 
.open > .dropdown-toggle.btn-border {
    background-color: #F5F5F5;
}

.btn-icon {
   padding:9px 10px;
}

.btn .fa{margin:0 3px;}

.fileinput-remove-button{
    background-color: #d9534f;
    border-color: #d43f3a;
    color: #fff;
}

.fileinput-remove-button:hover, 
.fileinput-remove-button.focus, 
.fileinput-remove-button:focus, 
.fileinput-remove-button.active, 
.fileinput-remove-button:active {
    background-color: #d43f3a ;
    border-color: #ac2925;
    color: #fff;
}
/*error for select box*/
.has-error .bootstrap-select .dropdown-toggle,
.has-error .bootstrap-select .dropdown-toggle:hover,
.has-error .bootstrap-select .dropdown-toggle:focus {
 border-color:#a94442 !important; 
}
/*succes for select box*/
.has-success .bootstrap-select .dropdown-toggle,
.has-success .bootstrap-select .dropdown-toggle:hover,
.has-success .bootstrap-select .dropdown-toggle:focus {
 border-color:#3c763d !important; 
}

 /*---------------------------------------------------------------
15. FORM  ELEMENTS 
---------------------------------------------------------------*/
label {   
	font-weight: 600;
	margin-bottom:10px;
}


.form-control { 
	border:1px solid #e1e1e1; 
    box-shadow: none;
    height:40px;
	font-size:13px;
	line-height:20px;
	padding:9px 12px;
}


.form-control:focus {
	border-color:#e1e1e1; 
	outline:0; 
	
}

.form-control:focus,
.has-error .form-control:focus {
	-webkit-box-shadow:none;
	box-shadow:none;	
}

.form-control.kv-fileinput-caption{
	height:39px;	
}

.form-group.form-inline .radio,
.form-group.form-inline .checkbox {
	margin-right:15px;
}

/*input group*/

.input-group {width:100%;}

.input-group .form-control, 
.input-group-addon, 
.input-group-btn {
    display: table-cell;
}
.input-group-addon {
	border-radius:0;
	-webkit-border-radius:0;
	background:#fff;
	border-color:#e1e1e1;
	padding:6px 14px;
	font-size:16px;	
}

.input-group-addon.font-size-20 {
	font-size:20px;	
}

.input-group-addon.fixed-w {
	text-align:center;
	padding:6px 0;
	width:40px;	
}

.input-group-addon.v-align-t { 
	line-height:30px;
}

/*select box*/

.dropdown-menu {
	font-size:13px;
} 

.bootstrap-select {
  width: 100% ; 
}

.bootstrap-select .dropdown-toggle {
    border: 1px solid #e1e1e1 !important;
	background-color: #fff !important;
    height:40px;
	font-size:13px;
	color:#999;
}

.bootstrap-select .dropdown-toggle:after {
	display: none; 
}

.bootstrap-select .dropdown-toggle:active, 
.bootstrap-select .dropdown-toggle:focus, 
.bootstrap-select .dropdown-toggle:hover {
	background-color: #fff !important;
	border: 1px solid #e9e9e9 !important;
	box-shadow: none !important;
	outline: 0px !important; 
}

.bootstrap-select:active, 
.bootstrap-select:focus {
	border: 0px !important;
	box-shadow: none !important;
	outline: 0px !important; 
}

.bootstrap-select.open {
	box-shadow: none !important;
	outline: 0px !important; 
}

.bootstrap-select.open .dropdown-toggle {
	box-shadow: none !important;
	outline: 0px !important; 
}

.bootstrap-select div.dropdown-menu {
    border: 1px solid #e9e9e9;
    border-radius: 0;
    box-shadow: none;
    margin-top:-1px;
    padding: 0;
	font-size:13px;
} 

.bootstrap-select div.dropdown-menu ul li{
    padding: 0;
} 

.bootstrap-select div.dropdown-menu ul li a{
    padding:5px 15px;
}

.bootstrap-select div.dropdown-menu ul li a img {
	border-radius:100%;
	-webkit-border-radius:100%;
    margin-right:5px;
}

.bootstrap-select  .bs-searchbox .form-control {
	padding:5px 10px;
	height:30px;
}




/*radio & checkbox*/
input[type=checkbox], 
input[type=radio] {
  display:;
  opacity:0;
  margin-left:1px !important; 
}

input[type=checkbox] + label, 
input[type=radio] + label {
  display: block;
  padding-left:20px !important;
  position: relative; 
}
  
input[type=checkbox] + label:hover:before, 
input[type=radio] + label:hover:before {
	border-color: <?php echo (!empty($data['color-scheme'])) ? esc_html($data['color-scheme']) : ''; ?>; 
}

input[type=checkbox] + label:before, 
input[type=radio] + label:before {
  background-color: #fff;
  border: 2px solid #b6b7b8;
  border-radius: 0px;
  content: "";
  display: inline-block;
  height: 16px;
  line-height: 1;
  margin-left: -20px;
  position: absolute;
  top: 2px;
  transition: all linear 0.1s;
  width: 16px; 
}

input[type=checkbox] + label:after {
  color: #fff;
  content: "\f00c";
  font-family: FontAwesome;
  font-size: 0px;
  -webkit-font-smoothing: antialiased;
  left: 6px;
  position: absolute;
  top: 7px;
  transition: all linear 0.1s; 
}

input[type=checkbox]:checked + label:before {
  border-width:8px;
  border-color: <?php echo (!empty($data['color-scheme'])) ? esc_html($data['color-scheme']) : ''; ?>; 
}

input[type=checkbox]:checked + label:after {
  font-size: 10px;
  left: 2px;
  top: 2px; 
}

input[type=radio] + label:before {
  border-radius: 50%;
  content: ""; 
}

input[type=radio]:checked + label:before {
  border-color: <?php echo (!empty($data['color-scheme'])) ? esc_html($data['color-scheme']) : ''; ?>;
  border-width: 5px; 
}
 
.form-inline .checkbox input[type="checkbox"], 
.form-inline .radio input[type="radio"] {
	position:absolute;
	left:0;
	bottom:0;
}
  
  
/*touchspin input type number*/  

.bootstrap-touchspin .input-group-btn-vertical {
  position: relative;
  white-space: nowrap;
  width: 1%;
  vertical-align: middle;
  display: table-cell;
}

.bootstrap-touchspin .input-group-btn-vertical > .btn {
  display: block;
  float: none;
  width: 100%;
  max-width: 100%;
  padding:10px 10px 9px;
  margin-left: -1px;
  position: relative;
  border-width:1px;
  border-style:solid;
  border-color:#e1e1e1;
  background:#FFF;
}

.bootstrap-touchspin .input-group-btn-vertical .bootstrap-touchspin-up {
  border-radius: 0;
  border-top-right-radius:0;
}

.bootstrap-touchspin .input-group-btn-vertical .bootstrap-touchspin-down {
  margin-top: -2px;
  border-radius: 0;
  border-bottom-right-radius:0;
}

.bootstrap-touchspin .input-group-btn-vertical i {
  position: absolute;
  top: 4px;
  left: 5px;
  font-size: 9px;
  font-weight: normal;
  color:#9fa0a1;
}

  
/*rating star*/
.input-rating input[type=radio] {
  display: none;
}

.input-rating input[type=radio] + label {
  display: inline-block;
  margin-left: -4px;
  padding-left: 0px !important;
  padding-right: 0px;
  width: 24px; 
}
  
.input-rating input[type=radio] + label:first-of-type {
    margin-left: 0px; 
}

.input-rating input[type=radio] + label:before {
  background-color: transparent;
  border: none;
  color: #ffd925;
  content: "\f006";
  display: inline-block;
  font-family: FontAwesome;
  font-size: 20px;
  -webkit-font-smoothing: antialiased;
  height: 14px;
  line-height: 1;
  margin-left: 0px;
  position: static;
  text-align: center;
  top: 2px;
  transition: none;
  width: 14px; 
}

.input-rating input[type=radio]:checked + label:before,
.input-rating input[type=radio] + label.marked:before,
.input-rating input[type=radio] + label.filled:before,
.input-rating input[type=radio] + label.hovered.filled:before {
  content: "\f005"; }

.input-rating input[type=radio] + label.hovered:before {
  content: "\f006"; }

/*simple rating list*/
.rating-bx {
    color: #ffd925;
    font-size: 14px;
}
.rating-bx i {
    margin:0 2px;
}
.rating-container .rating-stars::before{
	text-shadow:none;
}
.rating-container {
    color: #c8c8c8;
}
.rating-container .rating-stars {
    color: <?php echo (!empty($data['color-scheme'])) ? esc_html($data['color-scheme']) : ''; ?>;
}

/*validation symbol*/

.has-feedback label ~ .form-control-feedback {
    top: 31px;
} 

/*loading*/
.loading-box{
 width:100%;
 height:100%;
 background-color:#FFF;
 position:fixed;
 left:0;
 top:0;
 opacity:0.7;
 z-index:9999;
}
.loading-pic{
 width:70px;
 height:70px;
 background:url(inc/images/loading.GIF) center no-repeat;
 position:fixed;
 left:50%;
 top:50%;
 margin:-35px;
 z-index:99999;
}

/*loading - 2*/
.loading-cover,
.loading-srh-bar,
.loading-map {
	background:rgba(255,255,255,0.8);
	position:absolute;
	left:0;
	top:0;
	width:100%;
	height:100%;
	z-index:2;
}
.loading-cover .fa-spinner,
.loading-srh-bar .fa-spinner,
.loading-map .fa-spinner{
	position:absolute;
	left:50%;
	top:50%;
	margin:-10px;
	font-size:25px;
	color:#333;
}

.sf-banner-outer {
	margin-bottom:0;
}

.sf-success-top,
.sf-error-top {
	margin-bottom:0;
}

.alert-bx.alert-info {
	padding:15px;
	border:1px solid #bce8f1;
} 


 /*---------------------------------------------------------------
16. TABLES 
---------------------------------------------------------------*/

.table > tbody > tr > td, 
.table > tbody > tr > th, 
.table > tfoot > tr > td, 
.table > tfoot > tr > th, 
.table > thead > tr > td, 
.table > thead > tr > th {
	padding:10px;
}
.table.borderless > tbody > tr > td,
.table.borderless > tbody > tr > th {
    border: none;
}

/*data table*/
.dataTable .sorting_asc .checkbox{
	margin-right:0;
}


/*---------------------------------------------------------------
17. WP DEFAULT  
---------------------------------------------------------------*/
.alignnone {
    margin:0;
}

.aligncenter,
div.aligncenter {
    display: block;
    margin: 5px auto 15px;
}

.alignright {
    float:right;
    margin: 5px 0 25px 25px;
}

.alignleft {
    float: left;
    margin: 5px 25px 25px 0;
}

a img.alignright {
    float: right;
    margin: 5px 0 25px 25px;
}

a img.alignnone {
    margin: 5px 0 25px 0;
}

a img.alignleft {
    float: left;
    margin: 5px 25px 25px 0;
}

a img.aligncenter {
    display: block;
    margin: 5px auto 15px;
}

.wp-caption {
    max-width: 100%;
    text-align: center;
}

.wp-caption img[class*="wp-image-"] {
    display: block;
    margin: 0;
}

.wp-caption.alignnone {
    margin: 5px 0 25px 0;
}

.wp-caption.alignleft {
    margin: 5px 25px 25px 0;
}

.wp-caption.alignright {
    margin: 5px 0 25px 25px;
}

.wp-caption img {
    border: 0 none;
    height: auto;
    margin: 0;
    max-width:100%;
    padding: 0;
    width: auto;
}

.wp-caption p.wp-caption-text {
	color:#9d9d9d;
    font-size: 13px;
    line-height: 18px;
    margin: 0;
    padding:10px 0;
	text-align:left;
}


blockquote {
	padding: 16px 20px 16px 80px;
	font-size:18px;
	font-style:italic;
	color: #555555;
	margin:40px 0;
	border-left:none;
	line-height:30px;
	position: relative;
	background:#f6f6f6;
    clear:both;
}
blockquote p {
	font-size:18px;
	color: #555555;
	line-height:30px;
	margin-bottom: 0px;
}
blockquote:before {
	content: '\f10d';
	font-family:"FontAwesome";
	color: <?php echo (!empty($data['color-scheme'])) ? esc_html($data['color-scheme']) : ''; ?>;
	font-size: 35px;
	position: absolute;
	left:20px;
	top:20px;
	font-style:normal;
}

.size-auto, 
.size-full,
.size-large,
.size-medium,
.size-thumbnail {
 max-width: 100%;
 height: auto;
}


 /*---------------------------------------------------------------
18. BLOG  
---------------------------------------------------------------*/ 

/*blog post listing 1*/
.blog-post .post-info {
	margin-bottom:40px;
}

.blog-post .post-info {
	background:#FFF;
	padding:30px 30px 0;
}

.blog-post .post-date {
	background:<?php echo (!empty($data['color-scheme'])) ? esc_html($data['color-scheme']) : ''; ?>;
	text-align:center;
	width:80px;
	color:#FFF;
	float:left;
	margin:0 30px 30px 0;
	
}

.blog-post .post-date strong,
.blog-post .post-date span{
	display:block;
}

.blog-post .post-date strong a,
.blog-post .post-date strong a:active,
.blog-post .post-date strong a:focus,
.blog-post .post-date strong a:hover {
 color:#fff;
}

.blog-post .post-title {
	margin-top:0;
    word-break:break-all;
}

.blog-post .post-date strong{
	padding:5px;
	font-size:30px;
	font-weight:800;
}

.blog-post .post-date span{
	background:<?php echo (!empty($data['seconday-color-scheme'])) ? esc_html($data['seconday-color-scheme']) : ''; ?>;
	padding:5px;
	font-size:13px;
}

.blog-post .post-meta {
	padding:22px 30px;
	margin:0 -30px;
	border-top:1px solid #e3e3e3;
	border-bottom:2px solid #e3e3e3;	
}

.blog-post .post-meta ul {
	margin:0 -4px;
	float:right;
}

.blog-post .post-meta ul li {
	display:inline-block;
	padding:0;
	color:#a9a9a9;
}

.blog-post .post-meta ul li i{
	color:#7b7b7b;
	margin:0 5px;
}

.blog-post .read-more{
	color:<?php echo (!empty($data['color-scheme'])) ? esc_html($data['color-scheme']) : ''; ?>;
	text-transform:uppercase;
	font-weight:600;
	margin-right:5px;
}

.blog-post .read-more:after{
	content:"\f101";
	font-family:"FontAwesome";
	margin-left:5px;
	font-size:15px;
}

@media only screen and (max-width:767px) {
.blog-post .post-meta ul {
	float:none;
	margin-bottom:10px;
    margin-left:-5px;
}	
}

/*if no image with blog post*/
.blog-post.no-img-post .post-date {
	position:static;
	float:left;
}

.blog-post.no-img-post .post-thum {
	display:none;
}

/*blog post listing 2*/
.blog-md.blog-post .post-thum {
	width:350px;
	float:left;
	margin-right:30px;
}

.blog-md.blog-post .post-date {
	position:absolute;
}

.blog-md.blog-post.no-img-post .post-date {
	position:static;
}

.blog-md.blog-post .post-meta {
	clear:both;
}


@media only screen and (max-width:640px) {

.blog-md.blog-post .post-thum {
    float:none;
    margin:0 0 10px;
    width: auto;
}

.blog-md.blog-post .post-date {
	position:static;
}

}


/*blog post Grid*/
.blog-grid.blog-post .post-info{
	margin-bottom:0;
}
.blog-grid.blog-post .post-meta ul {
	float:none;
}
.blog-grid.blog-post .read-more {
	margin-top:15px;
	display:inline-block;
}
.blog-grid.blog-post .post-date {
	width:60px;
	margin:0 20px 5px 0;
}

.blog-grid.blog-post .post-date strong {
	font-size:25px;	
}


/* Grid 3 css*/
#posts { 
	margin:0 auto 0; 
	padding:0 15px;
}
.post {
	margin: 0 0 30px;
	padding:0;
	width: 100%;
    position:relative;
}

#grid.container .post img { 
	padding: 0; 
}

/* small devices */
@media (max-width: 767px) {
	#grid > #posts  { margin:0 15px;}
	#grid > #posts .post { width:100%; left:0 !important; }
	#grid > #posts .post.cs2 { width: 100%; }
	.post img { padding: 0; }
}

/* Medium devices */
@media (min-width: 768px) {
	#grid > #posts .post { width: 345px; }
	#grid > #posts .post.cs2 { width: 100%; }
	.post img { padding: 0; }
}
/* Medium devices */
@media (min-width: 992px) {
	#grid > #posts .post { width: 455px; }
	#grid > #posts .post.cs2 { width: 100%; }
}
/* Large devices */
@media (min-width: 1200px) {
	#grid > #posts .post { width: 360px; }
	#grid > #posts .post.cs2 { width: 742px; }
	#grid > #posts .col-md-6.post { width:555px; }
}

@media (min-width: 1300px) {
#grid {
	left: 0;
	position: relative;
}
#grid.container {
	left: auto;
	padding-left: 15px;
	padding-right: 15px;
}
}

/* Grid 2 css*/
@media (min-width: 1200px) {
	#grid > #posts .col-md-6.post { width:555px; }
}


/*blog page pagination main*/

.nav-links:after {
    clear: both;
    content: "";
    display: table;
}
.screen-reader-text {
    clip: rect(1px, 1px, 1px, 1px);
    height: 1px;
    overflow: hidden;
    position: absolute !important;
    width: 1px;
}

.pagination .page-numbers {
	background-color: #fff;
	border: 1px solid #e0e0e0;
	color: #767676;
	padding:9px 15px;
	font-weight:600;
	font-size:12px;
	display:block;
	float:left;
	margin-left:-1px;
}
.pagination .page-numbers.current,
.pagination a.page-numbers:hover {
	background:#3396D1;
	color:#fff;
}


/*blog page pagination */
.pagination-blog  {
	list-style: none;
	margin:0 0 50px;
	padding: 0 0;
}

.pagination-blog:after {
	content: ".";
	display: block;
	clear: both;
	visibility: hidden;
	line-height: 0;
	height: 0;
}

.pagination-blog li {
	display:inline;
	margin:0;
	padding:0;
}

.pagination-blog a,
.pagination-blog span {
	background-color: #fff;
	border: 1px solid #e0e0e0;
	color: #767676;
	padding:9px 15px;
	font-weight:600;
	font-size:12px;
	display:block;
	float:left;
	margin-left:-1px;
}

.pagination-blog a span { 
	padding: 0 
}

.pagination-blog a:hover,
.pagination-blog a.current,
.pagination-blog a.current:hover,
.pagination-blog span:hover,
.pagination-blog span.current,
.pagination-blog span.current:hover {
	color:#fff;
	background-color:<?php echo (!empty($data['color-scheme'])) ? esc_html($data['color-scheme']) : ''; ?>;
	text-decoration: none;
	border: 1px solid <?php echo (!empty($data['color-scheme'])) ? esc_html($data['color-scheme']) : ''; ?>;
}

.pagination-blog:hover {
	text-decoration: none
}

/*blog page link css*/
.page-links {
	clear: both;
	font-family: "Noto Sans", sans-serif;
	margin-bottom: 1.3333em;
}

.page-links a,
.page-links > span {
	border: 1px solid #eaeaea;
	border: 1px solid rgba(51, 51, 51, 0.1);
	display: inline-block;
	font-size: 12px;
	font-size: 1.2rem;
	height: 2em;
	line-height: 2;
	margin: 0 0.3333em 0.3333em 0;
	text-align: center;
	width: 2em;
}

.page-links a {
	-webkit-tap-highlight-color: rgba(255, 255, 255, 0.3);
	background-color: #333;
	border-color: #333;
	color: #fff;
}

.page-links a:hover,
.page-links a:focus {
	background-color: #707070;
	background-color: rgba(51, 51, 51, 0.7);
	border-color: transparent;
	color: #fff;
}

.page-links > .page-links-title {
	border: 0;
	color: #707070;
	color: rgba(51, 51, 51, 0.7);
	height: auto;
	margin: 0;
	padding-right: 0.5em;
	width: auto;
}

/*blog paginated css*/
.nav-links .nav-next ,
.nav-links .nav-previous {
	display: inline;
}
.nav-links .nav-previous a,
.nav-links .nav-next a {
	display: inline-block;
	color:#3396d1 ;
	font-weight:600;
	margin-bottom:20px;
	outline:none !important;
	text-transform:uppercase;
}
.nav-links .nav-next a {
	float:right;
}

.nav-links .nav-previous a:hover,
.nav-links .nav-next a:hover {
	color:#0099CC;
}
.nav-links .nav-previous a:after,
.nav-links .nav-next a:after {
	content:"\f105";
	font-family:"FontAwesome";
	vertical-align:middle;
	margin-left:2px;
	color:#333;
	font-size:17px;
    display:inline-block;
    position:relative;
    top:-2px;
}

/*post navigation*/
.post-navigation {
	background-color:#fff;
	padding:30px;
	border-bottom:2px solid #e3e3e3;
}
.post-navigation .screen-reader-text {
	margin-top:0;
}
.post-navigation .nav-previous ,
.post-navigation .nav-next {
	display:inline-block;
	width:50%;
}
.post-navigation .nav-next {
	text-align:right;
}
.post-navigation .nav-previous a:after,
.post-navigation .nav-next a:after {
	display:none;
}
.post-navigation .nav-previous .post-title,
.post-navigation .nav-next .post-title {
	display:block;
	font-size:15px;
	color:#777777;
	margin-top:10px;
}

/*post panging*/
.sf-link-pages {
	padding:20px 0 30px;
}
.sf-link-pages a{
	color:#fff;
	padding:2px 6px;
    	font-size:12px;
	font-weight:600;
	background-color:#CCC;
	margin:0 2px;
}


/*Sticky Post*/
.sticky-post {
	position:absolute;
	right:0;
	top:0;
	background:#77c04b ;
	color:#FFF;
	padding:10px 15px;
	text-transform:uppercase;
	font-weight:600;
}

/*Post password form*/
.post-password-form {
	position:relative;
	clear:both;
}
.post-password-form input[type="password"] {
	width:100%;
	border:1px solid #ddd;
	padding:10px 100px 10px 15px;
	height:40px;
}
.post-password-form label {
	display:block;
}
.post-password-form input[type="submit"]{
	position:absolute;
	bottom:0;
	right:0;
	padding:10px 20px;
	background-color:#333;
	color:#FFF;
	border:none;
	height:40px;
	text-transform:uppercase;
	font-weight:600;
}

/*gallery css for blog post*/

.format-gallery [class*="galleryid-"] {
	clear:both;
	margin: 0 auto;
	overflow: hidden
}

.gallery .gallery-item {
	float: left;
	list-style: none;
	margin: 0px 0 0;
	overflow: hidden;
	padding: 0px 0px 5px 15px;
	text-align: center
}
.gallery .gallery-caption {
	padding-top:10px;
	font-size:13px;
}
.gallery .gallery-item img {
	float: left;
	padding: 0 0px;
	width: 100%;
	border:none !important;
}

.gallery-columns-2 .gallery-item {
	max-width: 50%;
}

.gallery-columns-3 .gallery-item {
	max-width: 33.33%;
}

.gallery-columns-4 .gallery-item {
	max-width: 25%;
}

.gallery-columns-5 .gallery-item {
	max-width: 20%;
}

.gallery-columns-6 .gallery-item {
	max-width: 16.66%;
}

.gallery-columns-7 .gallery-item {
	max-width: 14.28%;
}

.gallery-columns-8 .gallery-item {
	max-width: 12.5%;
}

.gallery-columns-9 .gallery-item {
	max-width: 11.11%;
}

.gallery-icon img {
	margin: 0 auto;
}

.gallery-caption {
	color: #707070;
	color: rgba(51, 51, 51, 0.7);
	display: block;
	font-family: "Noto Sans", sans-serif;
	font-size: 12px;
	font-size: 1.2rem;
	line-height: 1.5;
	padding: 0.5em 0;
}

.gallery-columns-6 .gallery-caption,
.gallery-columns-7 .gallery-caption,
.gallery-columns-8 .gallery-caption,
.gallery-columns-9 .gallery-caption {
	display: none;
}



/*side bar*/
.side-bar .widget{
	margin-bottom:30px;
}

@media only screen and (max-width: 991px) {
.side-bar { 
	margin-bottom:40px;
}
} 

.side-bar .widget-title {
    padding-bottom:15px;
	position:relative;
	border-bottom:1px solid #e1e1e1;
	margin-bottom:30px;
}

.side-bar .widget-title:after {
	position:absolute;
	bottom:-2px;
	content:"";
    height: 3px;
    margin:0 0 0;
    width: 70px;
}


.side-bar .widget .widget-title,
.side-bar .widget .post-title{
	text-transform:none;
}

.side-bar .recent-posts-entry ul,
.side-bar .category-entry ul{
	margin:0;
	list-style:none;
	padding:0;
}

/*Search-box*/
.side-bar .search-bx .btn { 
    border-left-color:#FFF;
    padding:9px 10px;  
    color:<?php echo (!empty($data['color-scheme'])) ? esc_html($data['color-scheme']) : ''; ?>;
}

/*Search-box sidebar default*/
.widget_search .screen-reader-text { 
    display:block;
}
.searchform { 
    position:relative;
}
.searchform input[type="text"] { 
    width:100%;
	height:40px;
	padding:10px 90px 10px 15px;
	border:1px solid #e1e1e1;
}
.searchform input[type="submit"] { 
	height:40px;
	padding:10px 15px;
	background-color:<?php echo (!empty($data['button-primary-background-color'])) ? esc_html($data['button-primary-background-color']) : ''; ?>;
	position:absolute;
	right:0;
	bottom:0;
	color:<?php echo (!empty($data['button-primary-color'])) ? esc_html($data['button-primary-color']).'!important' : ''; ?>;
	border-left: none;
	border-right: none;
	border-top: none;
	border-width: 2px;
	border-bottom-color:<?php echo (!empty($data['button-primary-border-color'])) ? esc_html($data['button-primary-border-color']) : ''; ?>;
}
.searchform input[type="submit"]:hover,
.searchform input[type="submit"]:focus,
.searchform input[type="submit"]:active { 
 background-color:<?php echo (!empty($data['button-primary-hover-background-color'])) ? esc_html($data['button-primary-hover-background-color']) : ''; ?>;
 color:<?php echo (!empty($data['button-primary-hover-color'])) ? esc_html($data['button-primary-hover-color']).'!important' : ''; ?>;
 border-bottom-color:<?php echo (!empty($data['button-primary-hover-border-color'])) ? esc_html($data['button-primary-hover-border-color']) : ''; ?>;
}

/*Recent-posts*/
.side-bar .recent-posts-entry .post-date, 
.side-bar .tweets-feed-entry .tweet-date {
	color:<?php echo (!empty($data['color-scheme'])) ? esc_html($data['color-scheme']) : ''; ?>;
	font-style:normal;
}

.side-bar .widget .post-title {
	font-size:13px;
	line-height:16px;
	margin-bottom:8x;
}

.side-bar .recent-posts-entry ul li{
	padding:0;
	border-bottom:1px solid #e1e1e1;
	min-height:85px;
    margin-bottom:10px;
}
.side-bar .recent-posts-entry ul li:last-child{
	border-bottom:none;
}

.side-bar .recent-posts-entry ul li .post-thum-bx {
	margin-top:2px;
	border:none;
}

.side-bar .recent-posts-entry .post-meta span{
	margin-right:10px;
}


/* side bar listing-wedget*/
.side-bar .widget_categories ul,
.side-bar .widget_archive ul,
.side-bar .widget_meta ul,
.side-bar .widget_pages ul,
.side-bar .widget_recent_comments ul,
.side-bar .widget_nav_menu ul,
.side-bar .widget_rss ul,
.side-bar .widget_recent_entries ul {
	list-style:none;
	margin:0;
}

.side-bar .widget_categories ul li,
.side-bar .widget_archive ul li,
.side-bar .widget_meta ul li,
.side-bar .widget_pages ul li,
.side-bar .widget_recent_comments ul li,
.side-bar .widget_nav_menu li,
.side-bar .widget_recent_entries ul li {
	padding-bottom:18px;
	margin-bottom:13px;
	border-bottom:1px solid #e1e1e1;
	position:relative;
	padding:10px 10px 10px 20px;
	margin-bottom:0;
	line-height:20px;
}

.side-bar .widget_categories ul li:before,
.side-bar .widget_archive ul li:before,
.side-bar .widget_meta ul li:before,
.side-bar .widget_pages ul li:before,
.side-bar .widget_recent_comments ul li:before,
.side-bar .widget_nav_menu  ul li:before,
.side-bar .widget_recent_entries  ul li:before {
	content: "\f046";
	position: absolute;
	left: 0;
	top:10px;
	display: block;
	font-family: "FontAwesome";
}

.side-bar .widget_categories ul li li,
.side-bar .widget_archive ul li li,
.side-bar .widget_meta ul li li,
.side-bar .widget_pages ul li li,
.side-bar .widget_recent_comments ul li li,
.side-bar .widget_nav_menu li li {
	border-bottom:none;
	padding-left:7px;
	padding-right:5px;
	padding-top:0;
	padding-bottom:0;
	line-height:28px;
}
.side-bar .widget_categories ul li li:before,
.side-bar .widget_archive ul li li:before,
.side-bar .widget_meta ul li li:before,
.side-bar .widget_pages ul li li:before,
.side-bar .widget_recent_comments ul li li:before,
.side-bar .widget_nav_menu li li:before {
	top:0;
	left:-12px;
}


/* side bar widget_meta*/
.side-bar .widget_meta ul li a abbr[title] {
	color:#333;
	border-bottom:none;
}

/*sidebar calender*/
.widget_calendar caption::after {
    color: #707070;
    content: ">";
    font-family: "FontAwesome";
    margin: 0 0 0 5px;
}

.widget_calendar table {
	border-collapse: separate;
	border-spacing: 2px;
	width:100%;
}
.widget_calendar thead {
	background-color:#999999
}
.widget_calendar tfoot tr td {
	border: none;
	padding: 0px
}
.widget_calendar tfoot tr td a {
	background-color: #fff;
	padding: 4px 10px
}
.widget_calendar table thead tr th {
	font-size: 11px;
	padding:5px;
	text-align: center;
	border: none;
	color: #fff;
	
}
.widget_calendar table tbody td {
	font-size: 13px;
	padding:6px 5px;
	text-align: center;
	background-color: #fff;
	border: none;
	color: #444;
}
.widget_calendar table tbody td#today {
	background-color: <?php echo (!empty($data['seconday-color-scheme'])) ? esc_html($data['seconday-color-scheme']) : ''; ?> ;
	color: #FFF; 
}
.widget_calendar table tbody td#today a {
	color: #FFF; 
}


/*tags-list*/
.side-bar .widget_tag_cloud a{
	padding:8px 10px;
	background-color:#e6e6e6;
	font-size:12px;
	display:inline-block;
	margin:0 0 5px;
	color:#555555; 
}
.side-bar .widget_tag_cloud a:hover{
	background-color:#CCCCCC;

}

/*widget archive*/
.widget_archive select  {
	width:100%;
	padding:5px;
	border:1px solid #CCC;
}

/*widget text*/
.widget_text  select {
	width:100%;
	padding:5px;
	border:1px solid #CCC;
}
.widget_text  select option {
	width:100%;
}

/*widget categories*/
.widget_categories select{
	width:100%;
	padding:5px;
	border:1px solid #CCC;
}

/*widget RSS*/
.widget_rss ul {
	margin:0;
	line-height:20px;
}
.widget_rss ul li{
	line-height:20px;
	margin-bottom:15px;
}
.widget_rss ul .rsswidget {
	color:#333;
}
.widget_rss ul .rss-date {
	color:#3396D1;
}
.widget_rss ul .rssSummary {
	padding:5px 0;
}
.widget_rss ul cite {
	color:#333;
	font-weight:600;
}

/*Search form*/
.widget_provider_search_form [class*="col-"] {
	float:none;
	width:100%;
	padding:0;
	margin-bottom:10px;
}


/*single blog*/
.blog-content .blog-detail .post-info {
	padding-top:0;
	padding-bottom:25px;
}
.blog-content .post-info .post-meta{
	margin-bottom:30px;
}

.blog-detail .post-info{
	padding-top:25px;
	border-bottom:2px solid #e3e3e3;	
}

.blog-detail.no-img-post .post-thum{
	display:none;
}

.blog-detail .post-meta{
	border-bottom:1px solid #e3e3e3;
	margin-bottom:0;	
}

.blog-detail .post-meta ul{
	float:none;	
}

/*= comment list = */
.comments-area {
    padding:0;
}

.comments-area .comments-title {
    text-transform: uppercase;
    font-size: 20px;
}

.comments-area .comments-title:first-letter {
    font-family: "Open Sans";
    font-weight: 600;
    color: <?php echo (!empty($data['color-scheme'])) ? esc_html($data['color-scheme']) : ''; ?>;
}

ol.comment-list {
    list-style: none;
    margin:0;
}

ol.comment-list li.comment {
    position: relative;
    padding: 0;
}

ol.comment-list li.comment .comment-body {
    position: relative;
    padding:15px 20px;
    margin-bottom:40px;
	margin-left:80px;
	position:relative;
	border:1px solid #e9e9e9;
}

ol.comment-list li.comment .comment-body:before,
ol.comment-list li.comment .comment-body:after {
    content: '';
    position: absolute;
    top: 20px;
    width: 0;
    height: 0;
    border-width: 10px 12px 10px 0;
    border-style: solid;
}
ol.comment-list li.comment .comment-body:before {
    border-color: transparent #fff transparent #fff;
    z-index: 1;
    left: -12px;
    top: 22px;
}
ol.comment-list li.comment .comment-body:after {
    border-color: transparent #e9e9e9 transparent #e9e9e9;
    border-width: 12px 14px 12px 0;
    left: -14px;
}

ol.comment-list li.comment .comment-author {
    display: block;
	margin-bottom:5px;
}

ol.comment-list li.comment .comment-author .avatar {
    position: absolute;
    top:0;
    left:-80px;
    width:56px;
	height:56px;
	border-radius:100%;
	-webkit-border-radius:100%;
    border: 2px solid #FFF;
}

ol.comment-list li.comment .comment-author .fn {
    display: inline-block;
    color: #555555;
	font-size:14px;
	text-transform:uppercase;
    font-weight: 600;
    font-style: normal;
}

ol.comment-list li.comment .comment-author .says {
    display: none;
    color: #999999;
    font-weight:600;
}

ol.comment-list li.comment .comment-meta {
    color: #8d8d8d;
	text-transform:uppercase;
	margin-bottom:10px;
}

ol.comment-list li.comment .comment-meta:before,
ol.comment-list li.comment .reply a:before {
	font-family:"FontAwesome";
	font-size:11px;
	vertical-align:top;
	
}

ol.comment-list li.comment .comment-meta:before {
	content:"\f133";
}
ol.comment-list li.comment .reply a:before {
	content:"\f064";
	font-weight:normal;
	color:#555555;
	margin-right:5px;
	vertical-align:middle;
}
ol.comment-list li.comment p {
    line-height: 18px;
    margin: 0 0 5px;
}
ol.comment-list li.comment .reply a {
    position: absolute;
    top: 50px;
    right: 30px;
    margin-top: -5px;
    color: <?php echo (!empty($data['color-scheme'])) ? esc_html($data['color-scheme']) : ''; ?>;
    font-weight: 600;
}
ol.comment-list li .children {
    list-style: none;
    margin-left:80px;
}
ol.comment-list li .children li {
    padding: 0;
}

@media only screen and (max-width: 767px) {

.comments-area .padding-30{
    padding:15px;
}
	
ol.comment-list li.comment .comment-body {
    margin-bottom: 30px;
    margin-left: 70px;
}	

ol.comment-list li.comment .comment-author .avatar {
	left:-75px;
    height: 60px;
    width: 60px;
}

ol.comment-list li .children {
    margin-left: 20px;
}

ol.comment-list li.comment .reply a {
	position:static;
}		

}

@media only screen and (max-width: 480px) {
	
ol.comment-list li.comment .comment-body {
    margin-left: 52px;
}	

ol.comment-list li.comment .comment-author .avatar {
    left: -55px;
    top: 12px;
    width: 40px;
	height: 40px;
}	

}

/*= comment form = */
.comment-respond {
    padding: 30px 30px;
	border:1px solid #e9e9e9;
}

.comment-respond .comment-reply-title {
    text-transform: uppercase;
    font-size: 20px;
}

.comment-respond .comment-reply-title {
    font-size:16px;
	font-weight:600;
}

.comments-area .comment-form {
    margin:0 -15px;
}
.comments-area .comment-form .comment-notes {
    display: none;
}

.comments-area .comment-form p {
    width: 33.333%;
    float: left;
	padding:0 15px;
	margin-bottom:30px;
	position:relative;
}

.comments-area .comment-form p.form-allowed-tags {
    width:100%;
}

ol.comment-list li.comment .comment-respond .comment-form p {
	padding:0 15px !important;
}

.comments-area .comment-form p label {
    display: none;
	line-height:18px;
	margin-bottom:10px;
}

.comments-area  p:before {
   font-family:"FontAwesome";
   display:inline-block;
   position:absolute;
   left:15px;
   top:0;
   font-size:16px;
   color:#ccc;
   width:40px;
   height:40px;
   line-height:40px;
   border:1px solid #e1e1e1;
   text-align:center;	
	
}

.comments-area  p.comment-form-author:before {
   content:"\f007";
}
.comments-area  p.comment-form-email:before {
   content:"\f0e0";
}
.comments-area  p.comment-form-url:before {
   content:"\f0ac";
}
.comments-area  p.comment-form-comment:before {
   content:"\f040";
}

.comments-area .comment-form p input[type="text"],
.comments-area .comment-form p textarea {
    width: 100%;
    height: 40px;
    line-height: 6px 12px;
    padding:10px 10px 10px 50px;
    border: 1px solid #e1e1e1;
}

.comments-area .comment-form p.comment-form-comment {
    width: 100%;
    display: block;
    clear: both;
}

.comments-area .comment-form p textarea {
    height: 120px;
}

.comments-area .comment-form p.form-submit {
    clear: both;
    float: none;
    width: 100%;
	margin:0;
}

.comments-area .comment-form p input[type="submit"] {
    background-color: <?php echo (!empty($data['color-scheme'])) ? esc_html($data['color-scheme']) : ''; ?>;
    border-color: #1f82bd;
    border-width: 0;
    border-bottom-width: 3px;
    border-style: solid;
    color: #fff;
    padding: 9px 20px;
    line-height: 1.42857;
    text-transform: uppercase;
}

.comments-area .comment-form p input[type="submit"]:hover, 
.comments-area .comment-form p input[type="submit"]:focus, 
.comments-area .comment-form p input[type="submit"]:active {
    background-color:#1f82bd;
    border-color: #0c6faa;
    color: #fff;
}

@media only screen and (max-width: 767px) {
	
.comments-area .comment-form p {
    width:100%;
    float: none;
	margin-bottom:20px;
}

.comment-respond {
    padding:20px;
}

}

/*---------------------------------------------------------------
19. HEADER (top part of page)
---------------------------------------------------------------*/
#header-part { 
	position:relative; 
	z-index:99; 
	background:#FFF;
    height:auto;
}

/*without top bar*/ 
.extra-nav {
	float:right; 
	padding:25px 0;
    margin-right:15px;
}

.extra-nav .extra-cell{
	display:inline-block;
	position:relative;
}
.extra-nav .btn-sm{
	margin:5px 0;
}


@media only screen and (max-width: 767px) {

.extra-nav {
    margin-right: 15px;
}

}


@media only screen and (max-width:480px) {

.extra-nav {
    width:100%;
	clear:both;
	margin:0;
    padding:15px 0;
    text-align:right;
}

}

/* map page header*/
#header-part.fix-map-header{
	height:90px;
}
#header-part.fix-map-header .main-bar{
	position:fixed;
	top:0;
	left:0;
	z-index:1;
	box-shadow:0 0 3px rgba(0,0,0,0.3);
	-webkit-box-shadow:0 0 3px rgba(0,0,0,0.3);
}

@media only screen and (max-width:480px) {

#header-part.fix-map-header{
	height:160px;
}

}

/*---------------------------------------------------------------
20. PAGE TOP BAR (left & right content)
---------------------------------------------------------------*/
.top-bar{
	background:<?php echo (!empty($data['top-bar-bg-color'])) ? esc_html($data['top-bar-bg-color']) : ''; ?>;
	color:<?php echo (!empty($data['top-bar-text-color'])) ? esc_html($data['top-bar-text-color']) : ''; ?>;
	padding:10px 0;
}
.top-bar ul,
.top-bar ol{
	margin-bottom:0;
}

@media only screen and (max-width: 767px) {
.top-bar ul,
.top-bar ol{
	margin-top:5px;
	margin-bottom:5px;
}
.top-bar{
	padding:0;
}
.top-bar	[class*="col-"]	{
	width:100%;
	text-align:right;
	padding:10px 15px;
	border-bottom:1px solid #45A8E3;
}
.top-bar	[class*="col-"]:last-child	{
	border-bottom:none;
}

}

/*=== >eamil-phone (left) ===*/
.e-p-bx {margin-left:0;}
.e-p-bx li{ display:inline-block; font-size:12px; padding-right:10px;}
.e-p-bx li a{ color:#FFF;}
.e-p-bx li i{margin-right:10px; vertical-align:middle; }

/*=== >social-links (right) ===*/
.social-bx,
.login-bx { 
	margin:0 0 0 15px;
	float:right;
}
.social-bx li,
.login-bx li { 
	font-size:12px; 
	margin:0;
	position:relative;
}
.social-bx li a,
.login-bx li a {
	 color:<?php echo (!empty($data['top-bar-text-color'])) ? esc_html($data['top-bar-text-color']) : ''; ?>;
}
.social-bx li i,
.login-bx li i { 
	vertical-align:baseline; 
	margin:0 5px 0 0;
}
.social-bx li span,
.login-bx li span { 
	vertical-align:baseline; 
	margin:0 2px 0;
	font-size:8px;
}

.login-bx li ul {
	top:25px;
	left:auto;
	right:0; 
	border:none;
	padding:0;
}

.login-bx li ul li { 
	border-bottom:1px solid #F7F7F7;
}
.login-bx li ul li a{ 
	color:#767676;
	padding:9px 15px;
}


.login-bx li > .dropdown-menu {
 width:250px;
}

.login-bx li > .dropdown-menu > li > a {
 white-space:normal;
}

.arrow-up-border:before,
.arrow-up:after {
  position: absolute;
  display: inline-block;
  content: '';
}
.arrow-up-border:before {
  top: -7px;
  right:19px;
  border-right: 7px solid transparent;
  border-bottom: 7px solid #F00;
  border-left: 7px solid transparent;
  border-bottom-color: rgba(0, 0, 0, 0.2);
}
.arrow-up:after {
  top: -6px;
  right:20px;
  border-right: 6px solid transparent;
  border-bottom: 6px solid #ffffff;
  border-left: 6px solid transparent;
}

.arrow-left:before {
  position: absolute;
  top: -7px;
  left: 9px;
  display: inline-block;
  border-right: 7px solid transparent;
  border-bottom: 7px solid #ccc;
  border-left: 7px solid transparent;
  border-bottom-color: rgba(0, 0, 0, 0.2);
  content: '';
}

.arrow-left:after {
  position: absolute;
  top: -6px;
  left: 10px;
  display: inline-block;
  border-right: 6px solid transparent;
  border-bottom: 6px solid #ffffff;
  border-left: 6px solid transparent;
  content: '';
}

/*=== >language-list () ===*/
.language-bx li{ display:inline; margin:0 10px;}

/*=== > Notifications ===*/
.sf-notifications span { 
	display:inline-block;
	min-width:18px;
	height:18px;
	line-height:18px;
	padding:0 2px;
	background-color:#FF2D32;
	color:#FFF;
	font-size:11px !important;
	font-weight:700;
	text-align:center;
	-webkit-border-radius:50px;
	border-radius: 50px;
}

/*---------------------------------------------------------------
21. LOGO ( company identify  symbol )
---------------------------------------------------------------*/

/*=== >logo for header ===*/
.logo-header { 
	display:table;
    float:left; 
	vertical-align:middle; 
	padding:0; 
	font-size:<?php echo (!empty($data['header-logo-title-fontsize'])) ? esc_html($data['header-logo-title-fontsize']).'px!important' : ''; ?>;
	color:<?php echo (!empty($data['color-scheme'])) ? esc_html($data['color-scheme']) : ''; ?>;
    margin-top: <?php echo (!empty($data['logo-margin']['margin-top'])) ? esc_html($data['logo-margin']['margin-top']) : ''; ?>;
    margin-bottom: <?php echo (!empty($data['logo-margin']['margin-bottom'])) ? esc_html($data['logo-margin']['margin-bottom']) : ''; ?>;
    margin-left: <?php echo (!empty($data['logo-margin']['margin-left'])) ? esc_html($data['logo-margin']['margin-left']) : ''; ?>;
    margin-right: <?php echo (!empty($data['logo-margin']['margin-right'])) ? esc_html($data['logo-margin']['margin-right']) : ''; ?>;
    width: <?php echo (!empty($data['logo-dimensions']['width'])) ? esc_html($data['logo-dimensions']['width']) : ''; ?>;
    height: <?php echo (!empty($data['logo-dimensions']['height'])) ? esc_html($data['logo-dimensions']['height']) : ''; ?>;
}

.logo-footer  { 
	display:table;
    float:left; 
	vertical-align:middle; 
	padding:0; 
	font-size:<?php echo (!empty($data['footer-logo-title-fontsize'])) ? esc_html($data['footer-logo-title-fontsize']).'px!important' : ''; ?>;  
	color:<?php echo (!empty($data['color-scheme'])) ? esc_html($data['color-scheme']) : ''; ?>;
    margin-top: <?php echo (!empty($data['logo-margin']['margin-top'])) ? esc_html($data['logo-margin']['margin-top']) : ''; ?>;
    margin-bottom: <?php echo (!empty($data['logo-margin']['margin-bottom'])) ? esc_html($data['logo-margin']['margin-bottom']) : ''; ?>;
    margin-left: <?php echo (!empty($data['logo-margin']['margin-left'])) ? esc_html($data['logo-margin']['margin-left']) : ''; ?>;
    margin-right: <?php echo (!empty($data['logo-margin']['margin-right'])) ? esc_html($data['logo-margin']['margin-right']) : ''; ?>;
    width: <?php echo (!empty($data['logo-dimensions']['width'])) ? esc_html($data['logo-dimensions']['width']) : ''; ?>;
    height: <?php echo (!empty($data['logo-dimensions']['height'])) ? esc_html($data['logo-dimensions']['height']) : ''; ?>;
}

@media only screen and (max-width: 767px) {

.logo-header { 
	display:table;
    float:left; 
	vertical-align:middle; 
	padding:0; 
	font-size:<?php echo (!empty($data['header-logo-title-fontsize-mobile'])) ? esc_html($data['header-logo-title-fontsize-mobile']).'px!important' : ''; ?>;
	color:<?php echo (!empty($data['color-scheme'])) ? esc_html($data['color-scheme']) : ''; ?>;
    margin-top: <?php echo (!empty($data['logo-margin-mobile']['margin-top'])) ? esc_html($data['logo-margin-mobile-mobile']['margin-top']) : ''; ?>;
    margin-bottom: <?php echo (!empty($data['logo-margin-mobile']['margin-bottom'])) ? esc_html($data['logo-margin-mobile']['margin-bottom']) : ''; ?>;
    margin-left: <?php echo (!empty($data['logo-margin-mobile']['margin-left'])) ? esc_html($data['logo-margin-mobile']['margin-left']) : ''; ?>;
    margin-right: <?php echo (!empty($data['logo-margin-mobile']['margin-right'])) ? esc_html($data['logo-margin-mobile']['margin-right']) : ''; ?>;
    width: <?php echo (!empty($data['logo-dimensions-mobile']['width'])) ? esc_html($data['logo-dimensions-mobile']['width']) : ''; ?>;
    height: <?php echo (!empty($data['logo-dimensions-mobile']['height'])) ? esc_html($data['logo-dimensions-mobile']['height']) : ''; ?>;
}

.logo-footer  { 
	display:table;
    float:left; 
	vertical-align:middle; 
	padding:0; 
	font-size:<?php echo (!empty($data['footer-logo-title-fontsize-mobile'])) ? esc_html($data['footer-logo-title-fontsize-mobile']).'px!important' : ''; ?>;  
	color:<?php echo (!empty($data['color-scheme'])) ? esc_html($data['color-scheme']) : ''; ?>;
    margin-top: <?php echo (!empty($data['logo-margin-mobile']['margin-top'])) ? esc_html($data['logo-margin-mobile']['margin-top']) : ''; ?>;
    margin-bottom: <?php echo (!empty($data['logo-margin-mobile']['margin-bottom'])) ? esc_html($data['logo-margin-mobile']['margin-bottom']) : ''; ?>;
    margin-left: <?php echo (!empty($data['logo-margin-mobile']['margin-left'])) ? esc_html($data['logo-margin-mobile']['margin-left']) : ''; ?>;
    margin-right: <?php echo (!empty($data['logo-margin-mobile']['margin-right'])) ? esc_html($data['logo-margin-mobile']['margin-right']) : ''; ?>;
    width: <?php echo (!empty($data['logo-dimensions-mobile']['width'])) ? esc_html($data['logo-dimensions-mobile']['width']) : ''; ?>;
    height: <?php echo (!empty($data['logo-dimensions-mobile']['height'])) ? esc_html($data['logo-dimensions-mobile']['height']) : ''; ?>;
}

}

.logo-header a,
.logo-footer a {
	display:table-cell;
	vertical-align:middle;
}

.logo-header a {
	color:<?php echo (!empty($data['header-logo-text-color'])) ? esc_html($data['header-logo-text-color']) : ''; ?>;
}

.logo-footer a {
	color:<?php echo (!empty($data['footer-logo-text-color'])) ? esc_html($data['footer-logo-text-color']) : ''; ?>;
}


.logo-header.center-block {
	margin-left:auto;
	margin-right:auto;
	float:none;
}

.logo-header img,
.logo-footer img { 
	max-width:100%; 
	height:auto; 
	vertical-align:middle;
}

.logo-header span,
.logo-footer span { 
	font-size:20px; 
	color:<?php echo (!empty($data['color-scheme'])) ? esc_html($data['color-scheme']) : ''; ?>; 
	letter-spacing:20px;
}

/*---------------------------------------------------------------
22. MAIN BAR ( place logo & main-navigation )
---------------------------------------------------------------*/
.main-bar{ 
	background:<?php echo (!empty($data['navigation-bg-color'])) ? esc_html($data['navigation-bg-color']) : ''; ?>; 
	width:100%;
	transition:0.8s top ease-in; 
	-webkit-transition:0.8s top ease-in;
	-moz-transition:0.8s top ease-in;
	-ms-transition:0.8s top ease-in;
	-o-transition:0.8s top ease-in;
}


/*---------------------------------------------------------------
23. NAVIGATIONS 
	>mena-menu
	>mobile-menu
	>footer-menu
---------------------------------------------------------------*/

/*== >mena-menu ==*/

#header-part .navbar-toggle { 
    border:2px solid <?php echo (!empty($data['color-scheme'])) ? esc_html($data['color-scheme']) : ''; ?>; 
    margin: 24px 0;
    padding: 12px 10px;
}



#header-part .navbar-toggle span { 
	background:#666;
}
.header-nav {
    position:static;
	padding:0;
}

.header-nav .nav {
    float:right;
}

.header-nav .nav i {
    font-size:8px; 
	margin-left:3px;
	vertical-align:middle;
}

.header-nav .nav > li {
    margin: 0px;
	font-weight:400;
	text-transform:uppercase;
    position:relative;
    font-weight: <?php echo (!empty($data['parent-navigation-menu-fontweight'])) ? esc_html($data['parent-navigation-menu-fontweight']) : ''; ?>;
}

.header-nav .nav > li > a {
    border-radius: 0px;
    color: <?php echo (!empty($data['navigation-text-color'])) ? esc_html($data['navigation-text-color']) : ''; ?>;
    font-size: <?php echo (!empty($data['parent-navigation-menu-fontsize'])) ? esc_html($data['parent-navigation-menu-fontsize']).'px' : '12px'; ?>;
    padding:35px 15px;
    cursor:pointer;
}

.header-nav .nav > li > a:hover {
    background-color: transparent;
    color: <?php echo (!empty($data['navigation-text-hover-color'])) ? esc_html($data['navigation-text-hover-color']) : ''; ?>;
}
.header-nav .nav > li > a:active,
.header-nav .nav > li > a:focus {
    background-color: transparent;
}

.header-nav .nav > li.active > a,
.header-nav .nav > li.current-menu-item > a {
    background-color: transparent;
    color: <?php echo (!empty($data['navigation-text-hover-color'])) ? esc_html($data['navigation-text-hover-color']) : ''; ?>;
}

.header-nav .nav > li:hover > a {
    color: <?php echo (!empty($data['navigation-text-hover-color'])) ? esc_html($data['navigation-text-hover-color']).'!important' : ''; ?>;
}

.header-nav .nav > li:hover > .sub-menu,
.header-nav .nav > li:hover > .mega-menu {
	opacity: 1;
	visibility: visible;
	
	-webkit-transition: opacity 0.s linear;
	-moz-transition: opacity 0.s linear;
	-o-transition: opacity 0.s linear;
	transition: opacity 0.s linear;
}

.header-nav .nav > li .sub-menu {
    background-color: <?php echo (!empty($data['navigation-dropdown-bg'])) ? esc_html($data['navigation-dropdown-bg']) : ''; ?>;
    border: 1px solid #e9e9e9;
    display: block;
    left: 0;
    list-style: none;
    margin: 0px;
    opacity: 0;
    padding: 0px;
    position: absolute;
    visibility: hidden;
    width: 220px;
    z-index: 10;
}

.header-nav .nav > li .sub-menu li {
    border-bottom: 1px solid #e9e9e9;
    position: relative;
    font-weight: <?php echo (!empty($data['child-navigation-menu-fontweight'])) ? esc_html($data['child-navigation-menu-fontweight']) : ''; ?>;
}

.header-nav .nav > li .sub-menu li a {
    color:<?php echo (!empty($data['navigation-dropdown-text-color'])) ? esc_html($data['navigation-dropdown-text-color']) : ''; ?>;
    display: block;
    font-size: <?php echo (!empty($data['child-navigation-menu-fontsize'])) ? esc_html($data['child-navigation-menu-fontsize']).'px' : '11px'; ?>;
    padding: 10px 20px;
    text-transform: uppercase;
    transition: all 0.15s linear;
}

.header-nav .nav > li .sub-menu li a:hover {
    background-color:<?php echo (!empty($data['navigation-dropdown-hover-bg'])) ? esc_html($data['navigation-dropdown-hover-bg']) : ''; ?>;
    color: <?php echo (!empty($data['navigation-dropdown-text-hover'])) ? esc_html($data['navigation-dropdown-text-hover']) : ''; ?>;
    text-decoration: none;
}

.header-nav .nav > li .sub-menu li:last-child {
    border-bottom: 0px;
}

.header-nav .nav > li .sub-menu li .fa {
    color: #363636;
    display: block;
    float: right;
    position: absolute;
    right: 10px;
    top: 12px;
}

.header-nav .nav > li .sub-menu li:hover > a {
    color: <?php echo (!empty($data['navigation-dropdown-text-hover'])) ? esc_html($data['navigation-dropdown-text-hover']) : ''; ?>;
}

.header-nav .nav > li .sub-menu li > .sub-menu {
    left: 220px;
}

.header-nav .nav > li .sub-menu li:hover > .sub-menu {
	left: 220px;
	margin: 0px;
	opacity: 1;
	top: -1px;
	visibility: visible;
	
	-webkit-transition: opacity 0.15s linear;
	-moz-transition: opacity 0.15s linear;
	-o-transition: opacity 0.15s linear;
	transition: opacity 0.15s linear; 
}

.header-nav .nav > li .sub-menu li:hover > .sub-menu:before {
    background-color: transparent;
    bottom: 0px;
    content: '';
    display: block;
    height: 100%;
    left: -6px;
    position: absolute;
    top: 0px;
    width: 6px;
}

.header-nav .nav > li.has-mega-menu {
    position: inherit;
}

.header-nav .nav > li .mega-menu {
     background-color: <?php echo (!empty($data['navigation-dropdown-bg'])) ? esc_html($data['navigation-dropdown-bg']) : ''; ?>;
    border: 1px solid #e9e9e9;
    display: table;
    left: 0px;
    list-style: none;
    opacity: 0;
    padding: 20px;
    position: absolute;
    right: 0px;
    visibility: hidden;
    width: 100%;
}

.header-nav .nav > li .mega-menu > li {
    display: table-cell;
    padding: 5px 0px;
    position: relative;
    vertical-align: top;
    width: 25%;
}

.header-nav .nav > li .mega-menu > li:after {
    background-color:#E9E9E9 ;
    bottom: 0px;
    content: '';
    display: block;
    height: 100%;
    margin: 0px 20px 0px 0px;
    position: absolute;
    right: 0px;
    top: 0px;
    width: 1px;
}

.header-nav .nav > li .mega-menu > li:last-child:after {
    display: none;
}

.header-nav .nav > li .mega-menu > li > a {
    color: #555555;
    display: block;
    font-size: 14px;
    margin: 0px;
    padding: 0px;
}

.header-nav .nav > li .mega-menu > li ul {
    list-style: none;
    margin: 10px 0px 0px 0px;
    padding: 0px;
}

.header-nav .nav > li .mega-menu > li ul a {
    color:<?php echo (!empty($data['navigation-dropdown-text-color'])) ? esc_html($data['navigation-dropdown-text-color']) : ''; ?>;
    display: block;
    font-size: 11px;
    line-height: 34px;
    text-transform: uppercase;
}

.header-nav .nav > li .mega-menu > li ul a:hover {
    color: <?php echo (!empty($data['navigation-dropdown-text-hover'])) ? esc_html($data['navigation-dropdown-text-hover']) : ''; ?>;
}

.header-nav .nav > li.menu-item-has-children:before {
	content: "\f078";
	display: block;
	font-family: "FontAwesome";
	right: 4px;
	position: absolute;
	top: 50%;
	color:#999;
	margin-top:-7px;
	font-size:8px; 
}


@media only screen and (max-width: 991px) {
	
header .logo{
	display:block;
	padding:4px 0;
}
.header-nav .nav > li > a {
    padding:;
}

.header-nav .nav > li.menu-item-has-children:before {
	right: 10px;
	top:0;
	margin-top:17px;
}
 
}

@media only screen and (max-width: 991px) {
	
/* responsive strat when medai screen [991px] css START*/

.navbar-header {
	float: none;
}
.navbar-toggle {
	display: block;
}
.navbar-collapse.collapse {
	display: none!important;
}
.navbar-collapse.collapse.in {  /* NEW */
	display: block!important; 
}

/* responsive strat when medai screen [991px] css END*/


.header-nav {
	clear:both;
	margin:0 -15px;
	border-bottom:1px solid #E9E9E9 ;
}
.header-nav .nav{
	float:none;
	margin:0;
    background:#fff;
}
.header-nav .nav li{
	float:none;
}

.header-nav .nav > li .sub-menu > li,
.header-nav .nav > li .mega-menu > li {
	float:none;
	display:block;
	width:auto;
}

.header-nav .nav > li > a {
    padding: 12px 15px;
	border-top:1px solid #E9E9E9 ;
}

.header-nav .nav i{
	float:right;	
}

.header-nav .nav > li > a:hover,
.header-nav .nav > li > a:active, 
.header-nav .nav > li > a:focus {
    background-color: #f0f0f0;
    text-decoration: none;
}

.header-nav .nav > li .mega-menu > li:after{
	display:none;
}

.header-nav .nav > li ul,
.header-nav .nav > li .sub-menu,
.header-nav .nav > li .mega-menu {
    display: none;
    position: static;
    visibility: visible;
    width:auto;
	background:#f9f9f9;
}

.header-nav .nav > li ul.mega-menu ul {
    display: none;
}

.header-nav .nav > li:hover > ul,
.header-nav .nav > li:hover .sub-menu,
.header-nav .nav > li:hover .mega-menu {
    opacity: 1;
    visibility: visible;
	display:block;
}

.header-nav .nav > li ul.mega-menu li:hover ul {
    display: block;
}
	
}


/*= when header is sticky =*/  
.is-sticky .main-bar {
	position:fixed;
	top:0;
	left:0;
}

 .is-sticky .logo-header {
	margin:6px 0;	
}

.is-sticky .header-nav .nav > li > a {
    padding:25px 15px;
}
.is-sticky .extra-nav { 
	padding:15px 0;
}

@media only screen and (max-width: 767px) {
.is-sticky .header-nav{
	overflow:auto;
	height:250px;
}	
.is-sticky .header-nav .nav > li > a {
    padding:12px 15px;
}
.is-sticky#header-part .navbar-toggle{
    margin:15px 0;
}
}


/*= Header style designs strat =*/  

/*header style [1] & default*/  
.header-style1 {  
	padding-bottom:;
}



/*header style [2] & center content*/ 

.header-style2 .logo-header  {
	margin-left:auto;
	margin-right:auto;
	margin-bottom:0;
	float:none;
} 

.header-style2 .container{
	position:relative;	
}
.header-style2 .nav-outer {
	display:table;	
}

.header-style2 .main-bar-inr {
 display:table;
 margin:auto; 
}

.header-style2 .header-nav{
 display:inline-block;
 float:left;
}

.header-style2 .header-nav .nav {
    float: none;
}



@media only screen and (max-width: 767px) {
	
.header-style2 .navbar-toggle {
    position:static;
	display:table;
	margin:0 auto 20px !important;
	float:none;
}
	
.header-style2 .nav-outer {
	display:block;
	padding:22px 0 0;	
}

}


/*header style [3] & header transperent*/ 
.header-style3 .main-bar {
	position:absolute;
	background:none;	
}
.header-style3 .header-nav .nav > li > a {
	color:#FFF;	
}
.header-style3 .header-nav .nav > li.menu-item-has-children::before {
	color:#FFF;
}


.header-style3.is-sticky .main-bar {
	position:fixed;
	background:#fff;
}
.header-style3.is-sticky .header-nav .nav > li > a {
	color:#777777;	
}
.header-style3.is-sticky .header-nav .nav > li.menu-item-has-children::before {
	color:#999;
}
.header-style3 .navbar-toggle span {
    background:#FFF !important;
}
.header-style3.is-sticky .navbar-toggle span {
    background:#666 !important;
}

@media only screen and (max-width: 767px) {
.header-style3 .header-nav .nav > li > a {
	color:#555555;	
}
.header-style3 .header-nav .nav > li.menu-item-has-children::before {
	color:#66666;
}	

}


@media only screen and (max-width: 767px) {
	

}

/*header style [4] & header white overlay */ 
.header-style4.overlay-bg-white .main-bar { 
	background-color:rgba(255,255,255,<?php echo (isset($data['header-bg-opacity'])) ? esc_html($data['header-bg-opacity']) : ''; ?>);
	position:absolute;
}

.header-style4.overlay-bg-white.is-sticky .main-bar {
	position:fixed;
	background:#fff;
}


/*header style [5] & header black overlay */ 
.header-style5.overlay-bg-black .main-bar { 
	background-color:rgba(0,0,0,<?php echo (isset($data['header-bg-opacity'])) ? esc_html($data['header-bg-opacity']) : ''; ?>);
	position:absolute;
}
.header-style5.overlay-bg-black .header-nav .nav > li > a {
	color:<?php echo (!empty($data['navigation-text-color'])) ? esc_html($data['navigation-text-color']) : ''; ?>;
}
.header-style5.overlay-bg-black .header-nav .nav > li.menu-item-has-children::before {
	color:#FFF;
}


.header-style5.overlay-bg-black.is-sticky .main-bar {
	position:fixed;
	background:#fff;
}
.header-style5.is-sticky .header-nav .nav > li > a {
	color:#777777;	
}
.header-style5.is-sticky .header-nav .nav > li.menu-item-has-children::before {
	color:#999;
}
.header-style5.overlay-bg-black .navbar-toggle span {
    background:#FFF !important;
}
.header-style5.overlay-bg-black.is-sticky .navbar-toggle span {
    background:#666 !important;
}

@media only screen and (max-width: 767px) {
.header-style5.overlay-bg-black  .header-nav .nav > li > a {
	color:#555555;	
}
.header-style5.overlay-bg-black  .header-nav .nav > li.menu-item-has-children::before {
	color:#66666;
}	

}



/*---------------------------------------------------------------
24. BANNER
---------------------------------------------------------------*/

.sf-banner-row,
.sf-banner-outer {
	position: relative;
    min-height:150px;
} 

.sf-bnr-pic {
	width: 100%;
	overflow: hidden;
}
.sf-bnr-pic img {
	width: 100%;
	height: auto;
	display: block;
}
.sf-bnr-text {
	position: absolute;
	left: 0;
	top: 41%;
	width: 100%;
	margin: 0;
	font-family: Raleway;
	color: #FFFFFF;
	font-family: "Raleway";
}
.sf-bnr-text strong {
	display: block;
	font-size: <?php echo (!empty($data['banner-heading-fontsize'])) ? esc_html($data['banner-heading-fontsize']).'px' : '72px'; ?>;
	font-weight: 700;
	line-height: <?php echo (!empty($data['banner-heading-line-height'])) ? esc_html($data['banner-heading-line-height']).'px' : '70px'; ?>;
	margin: 0 0 25px;
	color: #FFFFFF;
}
.sf-bnr-text span {
	font-size: <?php echo (!empty($data['banner-sub-heading-fontsize'])) ? esc_html($data['banner-sub-heading-fontsize']).'px' : '24px'; ?>;
	line-height: <?php echo (!empty($data['banner-sub-heading-line-height'])) ? esc_html($data['banner-sub-heading-line-height']).'px' : '30px'; ?>;
	font-weight: 400;
}

@media only screen and (max-width:1200px) {
.sf-bnr-text strong {
	font-size: 60px;
	line-height: 60px;
	margin: 0 0 15px;
}
.sf-bnr-text span {
	font-size: 20px;
	line-height: 24px;
}	
}

@media only screen and (max-width:991px) {
.sf-bnr-text strong {
	font-size:50px;
	line-height: 50px;
	margin: 0 0 10px;
}

}


@media only screen and (max-width:767px) {
.sf-bnr-text strong {
	font-size:40px;
	line-height: 40px;
	margin: 0 0 0;
}

}

@media only screen and (max-width:680px) {
.sf-bnr-text strong {
	font-size:30px;
	line-height: 30px;
	margin: 0 0 0;
}
.sf-bnr-text span {
    font-size: 14px;
    line-height: 18px;
}

}

@media only screen and (max-width:480px) {
.sf-bnr-text strong {
	font-size:20px;
	line-height: 20px;
}
.sf-bnr-text span {
    font-size: 12px;
    line-height: 16px;
}
}

/*== > inner page banner ==*/
.banner-inner-row { 
	height:400px;
	background-size:cover; 
    background-position:center center;
    position:relative;
}

@media only screen and (max-width:1400px) {
.banner-inner-row{
	height:300px;
}
}

@media only screen and (max-width:767px) {
.banner-inner-row{
	height:200px;
}
}

.banner-inner-row h1,
.banner-inner-row h2,
.banner-inner-row h3,
.banner-inner-row h4,
.banner-inner-row h5,
.banner-inner-row h6{ 
	color:#FFF;
}

.banner-inner-row .sf-find-bar{ 
	z-index:1;
	margin:0; 
}

.search-form .category-select ul li a span { 
	font-weight:600;
}

.search-form .category-select ul li a span.childcat { 
	font-weight:400;
	color:#7c7c7c;
}

.search-form .category-select ul li.active a span.childcat { 
	color:#FFFFFF;
}

.search-form .category-select ul li img { 
	width:36px;
	height:36px;
	margin-right:5px;
	border-radius:100%;
	-webkit-border-radius:100%;
}

.search-form .category-select .filter-option img { 
	width:20px;
	height:20px;
	margin-right:5px;
	border-radius:100%;
	-webkit-border-radius:100%;
}

.search-form .bootstrap-select .btn { 
	padding-left:10px;
}


/*== >  Provider banner off ==*/
.banner-inner-row.provider-banner-off {
	height:150px;
	background-image:url("inc/images/pattern/pattern1.jpg") !important;
	background-repeat:repeat;
	background-size:auto;
}
.provider-banner-off.overlay-black-middle::after {
    opacity: 0.1;
}

@media only screen and (max-width:980px) {
 
.banner-inner-row.provider-banner-off {
    height:230px;
}

}

@media only screen and (max-width:767px) {
 
.banner-inner-row.provider-banner-off {
    height:0;
}

}

/*service find bar demo1 */
.sf-search-benner {
	position:relative;
}
.sf-find-bar,
.sf-find-bar-inr { 
	width:100%; 
	position:absolute; 
	left:0;  
    bottom:0; 
    z-index:50; 
}
.sf-find-bar .search-form,
.sf-find-bar-inr .search-form { 
	padding:25px 10px;
	position:relative; 
}
.sf-find-bar .search-form:before,
.sf-find-bar-inr .search-form:before { 
	content:"";
	position:absolute;
	left:0;
	top:0;
	width:100%;
	height:100%;
	background:<?php echo (!empty($data['color-scheme'])) ? esc_html($data['color-scheme']) : ''; ?>;
	opacity:0.9;
}  .sf-find-bar .bootstrap-select.btn-group .dropdown-menu.inner,
.sf-find-bar-inr .bootstrap-select.btn-group .dropdown-menu.inner { 
	max-height:356px !important;
} 

.sf-find-bar .bootstrap-select .dropdown-toggle,
.sf-find-bar-inr .bootstrap-select .dropdown-toggle{
	border:1px solid #fff !important;
}
.sf-find-bar .type-address .form-control,
.sf-find-bar-inr .type-address .form-control {
	border-color:#fff ;
}
.sf-find-bar .search-col-6 { 
	width:16.6667%;
}
.sf-find-bar .search-col-5 { 
	width:20%;
}
.sf-find-bar .search-col-4 { 
	width:25%; 
}

@media only screen and (max-width: 1200px) {
	
.sf-find-bar .search-col-6 { 
	width:33.333%;
	margin:5px 0;
}

}


@media only screen and (max-width: 991px) {

.sf-find-bar {
	position:static;
}

.sf-find-bar .container{
	width:auto;
    padding:0;
}

.sf-find-bar .search-col-5 { 
	width:50%;
    margin-bottom:15px;
}	

.sf-find-bar .col-sm-12.search-col-5{ 
	width:100%;
}

.sf-find-bar-inr .search-col-5 { 
    margin-bottom:15px;
}	

.sf-find-bar .search-col-3 { 
	margin-bottom:10px;
}
.sf-find-bar .col-sm-12.search-col-3 { 
	margin-bottom:0;
}

}

@media only screen and (max-width:767px) {
	
.sf-find-bar .search-col-6 { 
	width:100%;
	margin:0 0 10px
}
.sf-find-bar .col-sm-12.search-col-6 { 
	width:100%;
	margin:0
}	
	
.sf-find-bar .search-col-5 { 
	float:left;
    margin-bottom:10px;
}

.sf-find-bar .col-sm-12.search-col-5{ 
	clear:both;
}
.sf-find-bar .search-col-5 { 
    margin-bottom:10px;	
	width:100%;
	float:none;
}

.sf-find-bar .col-sm-12.search-col-5{ 
	clear:both;
}

.sf-find-bar .search-col-4 { 
	width:100%;
	margin-bottom:10px;
}			
.sf-find-bar .col-sm-12.search-col-4 { 
	width:100%;
	margin-bottom:0;
}	

}

/*== Search Bar inner page==*/

.sf-find-bar-inr .search-col-4 {
	width:25%; 
}

.sf-find-bar-inr .search-col-6,
.sf-find-bar-inr .search-col-5 {
	width:20%; 
}

@media only screen and (max-width:991px) {

.sf-find-bar-inr .search-col-3 { 
	width:50%;
	margin-bottom:10px;
}	
.sf-find-bar-inr .col-sm-12.search-col-3 { 
   width:100%;
   margin-bottom:0;
} 	
	
.sf-find-bar-inr .search-col-4 {
	width:33.333%; 
}	
.sf-find-bar-inr .col-sm-12.search-col-4 { 
   width:100%;
}	

.sf-find-bar-inr .search-col-6,
.sf-find-bar-inr .search-col-5 { 
	width:50%;
	margin-bottom:10px;
}	
.sf-find-bar-inr .col-sm-12.search-col-5 { 
   width:100%;
   margin-bottom:0;
}

 
}

@media only screen and (max-width:767px) {
.sf-find-bar-inr .search-col-3 { 
	width:100%;
}		
.sf-find-bar-inr .search-col-4 { 
	width:100%;
}	
.sf-find-bar-inr .search-col-5 { 
	width:100%;
	float:none;
}	
.sf-find-bar-inr .search-col-6 { 
	width:100%;
	margin-bottom:10px;
}	
.sf-find-bar-inr .col-sm-12.search-col-6 { 
   margin-bottom:0;
}
.sf-find-bar-inr {
	position:static;
}	
.sf-find-bar-inr > .container {
	padding-left:0;
	padding-right:0;
}		

}



/*---------------------------------------------------------------
25. SLIDER
	>rs slider
	>owl slider
---------------------------------------------------------------*/

/*== >rs slider ==*/

.tp-caption .font-weight-300{font-weight:300;}
.tp-caption .font-weight-400{font-weight:400;}
.tp-caption .font-weight-500{font-weight:500;}
.tp-caption .font-weight-600{font-weight:600;}
.tp-caption .font-weight-700{font-weight:700;}
.tp-caption .font-weight-800{font-weight:800;}
.tp-caption .font-weight-900{font-weight:900;}

.tp-caption .btn{font-weight:600; text-transform:uppercase; }
.tp-caption .btn-lg{padding-left:80px; padding-right:80px;}

.tp-caption h1, 
.tp-caption h2, 
.tp-caption h3, 
.tp-caption h4, 
.tp-caption h5, 
.tp-caption h6 {
  font-weight: 800;
  margin-bottom:24px;
  color:#FFFFFF;
}
.tp-caption h1 {
  font-size:70px;
  line-height:60px;
}
.tp-caption h2 {
  font-size: 60px;
  line-height:50px;
}
.tp-caption h3 {
  font-size: 50px;
  line-height:40px;
  margin-bottom:20px;
}
.tp-caption h4 {
  font-size: 40px;
  line-height:30px;
  margin-bottom:15px;
}
.tp-caption h5 {
  font-size:30px;
  line-height:4px;
  margin-bottom:10px;
}
.tp-caption h6 {
  font-size:20px;
  line-height:22px;
  margin-bottom:10px;
}

.tp-caption h4,
.tp-caption h5, 
.tp-caption h6 {
  font-weight: 600;

}
a.btn{color:#FFF;}

a.btn:hover,
a.btn:focus, 
a.btn:active {
	color:#FFF;
}


/*== >owl slider ==*/

/* next pre btn */
.owl-theme .owl-controls {
    margin-top:40px;
    text-align: center;
}

.owl-theme .owl-controls .owl-nav .owl-prev,
.owl-theme .owl-controls .owl-nav .owl-next {
    font-size: 13px;
    margin:0 5px;
    padding: 5px 11px;
    display: inline-block;
    cursor: pointer;
	border-bottom-width:2px;
	border-bottom-style:solid;

}

.owl-theme .owl-controls .owl-nav .owl-prev:hover,
.owl-theme .owl-controls .owl-nav .owl-next:hover {
    text-decoration: none;
}

.owl-theme .owl-controls .owl-nav .disabled {
    opacity: .5;
    cursor: default
}

/* owl dots button */
.owl-theme .owl-dots .owl-dot {
    display: inline-block;
    zoom: 1;
    *display: inline
}

.owl-theme .owl-dots .owl-dot span {
    width: 10px;
    height: 10px;
    margin: 5px 7px;
    background: #d6d6d6;
    display: block;
    -webkit-backface-visibility: visible;
    -webkit-transition: opacity 200ms ease;
    -moz-transition: opacity 200ms ease;
    -ms-transition: opacity 200ms ease;
    -o-transition: opacity 200ms ease;
    transition: opacity 200ms ease;
    -webkit-border-radius: 30px;
    -moz-border-radius: 30px;
    border-radius: 30px
}

.owl-theme .owl-dots .owl-dot.active span,
.owl-theme .owl-dots .owl-dot:hover span {
    background: #869791
}


.owl-btn-center-lr .owl-controls{
	margin:0;	
}

.owl-btn-center-lr .owl-controls .owl-nav .owl-prev,
.owl-btn-center-lr .owl-controls .owl-nav .owl-next { 
	position:absolute;  
	left:0; 
	top:50%; 
	margin:-17px 0;
}

.owl-btn-center-lr .owl-controls .owl-nav .owl-next { 
	left:auto; 
	right:0;
}

.owl-carousel .owl-item img{
	transform-style: inherit;
}

.galley-details { 
	position:relative;
}

.galley-details img { 
	width:100%;
	height:auto;
}

.gallery-thums { 
	margin:20px 0 0; 
	padding:0 50px;
}

.gallery-thums .item { 
	padding:0 5px;
}


/*---------------------------------------------------------------
26. MAP BANNER
---------------------------------------------------------------*/

.sf-map-row { 
	position:relative; 
}
#gmap_wrapper { 
	position:relative; 
}

.gmap_home {
	height:<?php echo (!empty($data['map-height-desktop'])) ? esc_html($data['map-height-desktop']).'px' : '600px'; ?>;
}

@media only screen and (max-width:768px) {
.gmap_home {
	height:<?php echo (!empty($data['map-height-ipad'])) ? esc_html($data['map-height-ipad']).'px' : '650px'; ?>;
}	
}

@media only screen and (max-width:767px) {
.gmap_home {
	height:<?php echo (!empty($data['map-height-mobile'])) ? esc_html($data['map-height-mobile']).'px' : '350px'; ?>;
}	
}

#no-result{
	position:absolute;
	left:25%;
	bottom:35%;
	width:270px;
	color:#FFF;
	font-size:23px;
	font-weight:800;
	text-transform:uppercase;
	margin:-20px -100px;
	padding:20px 10px;
	background:rgba(0,0,0,0.4);
}

#no-result .container{
	width:auto;
}

 
/*= Map marker =*/

.map-marker {
	background-color: <?php echo (!empty($data['color-scheme'])) ? esc_html($data['color-scheme']) : ''; ?>;
	/*background-image: linear-gradient(#00d2b8, #009f8b);*/
	border-radius:40px 40px 4px 40px;
	height:40px;
	display: block;
	position: relative;
	top: 0px;
	transition: top .15s linear;
	width:40px;
    cursor:pointer; 
	-moz-transform: rotate(45deg);
	-webkit-transform: rotate(45deg);
	-o-transform: rotate(45deg);
	-ms-transform: rotate(45deg);
	transform: rotate(45deg);
  
 }
  
.map-marker:before {
    background-color: rgba(0, 0, 0, 0.13);
    border-radius: 50%;
    bottom: -3px;
	left:28px;
	width:25px;
    content:'';
    height:5px;
    position: absolute;
    transition: all .15s linear; 
    -moz-transform: rotate(-45deg);
    -webkit-transform: rotate(-45deg);
    -o-transform: rotate(-45deg);
    -ms-transform: rotate(-45deg);
    transform: rotate(-45deg);
}

.map-marker:after {

}

.map-marker:hover {
    top: -4px; 
}

.map-marker:hover:before {
    bottom: -6px;
    left: 34px;
    width: 18px;
}

.map-marker:hover {
    top: -4px;
	-moz-transform: scale(1.4) rotate(45deg);
	-webkit-transform: scale(1.4) rotate(45deg);
	-o-transform: scale(1.4) rotate(45deg);
	-ms-transform: scale(1.4) rotate(45deg);
	transform: scale(1.4) rotate(45deg);
}

.map-marker.active:hover {
    bottom: -6px;
    left: 34px;
    width: 18px;
 } 
 
.map-marker.active {
    top: -4px;
	-moz-transform: scale(1.4) rotate(45deg);
	-webkit-transform: scale(1.4) rotate(45deg);
	-o-transform: scale(1.4) rotate(45deg);
	-ms-transform: scale(1.4) rotate(45deg);
	transform: scale(1.4) rotate(45deg);
}

.map-marker.active:before {
    bottom: -6px;
    left: 34px;
    width: 18px;
 } 
 
.map-marker .icon {
	background:#333333;
	display: block;
    width:28px;
	height: 28px;
	line-height: 28px;
	margin: 0px auto;
	padding:4px;
	position: relative;
	overflow: hidden;
	text-align: center;
	top:6px;
	left:0;
	border:2px solid #FFF;
	
	border-radius:100%;
	-webkit-border-radius:100%;
	
	-moz-transform: rotate(-45deg);
	-webkit-transform: rotate(-45deg);
	-o-transform: rotate(-45deg);
	-ms-transform: rotate(-45deg);
	transform: rotate(-45deg); 
}

.map-marker .icon img {
	max-width:100%;
	height:auto;
	display:block;
}

.cluster .cluster-inner{
	width:30px !important;
	height:30px ;
	line-height:28px !important;
	background:<?php echo (!empty($data['map-color-cluster'])) ? esc_html($data['map-color-cluster']) : ''; ?>;
	border:2px solid #FFF;
	font-size:13px !important;
	border-radius:100%;
	-webkit-border-radius:100%;
}

.cluster .cluster-inner {
-webkit-animation: as-basic-fast 2s linear infinite;
-moz-animation: as-basic-fast 2s linear infinite;
animation: as-basic-fast 2s linear infinite;
}


.cluster:hover .cluster-inner{
	-moz-transform: scale(1.1);
	-webkit-transform: scale(1.1);
	-o-transform: scale(1.1);
	-ms-transform: scale(1.1);
	transform: scale(1.1);
}

@keyframes as-basic-fast {
0%, 100% {
-webkit-box-shadow: 0 0 0 3px <?php echo (!empty($data['map-color-cluster'])) ? esc_html($data['map-color-cluster']) : ''; ?>;
-moz-box-shadow: 0 0 0 3px <?php echo (!empty($data['map-color-cluster'])) ? esc_html($data['map-color-cluster']) : ''; ?>;
box-shadow: 0 0 0 3px <?php echo (!empty($data['map-color-cluster'])) ? esc_html($data['map-color-cluster']) : ''; ?>;
}
50% {
-webkit-box-shadow: 0 0 0 5px <?php echo (!empty($data['map-color-cluster'])) ? esc_html($data['map-color-cluster']) : ''; ?>;
-moz-box-shadow: 0 0 0 5px <?php echo (!empty($data['map-color-cluster'])) ? esc_html($data['map-color-cluster']) : ''; ?>;
box-shadow: 0 0 0 5px <?php echo (!empty($data['map-color-cluster'])) ? esc_html($data['map-color-cluster']) : ''; ?>;
}
}

@-webkit-keyframes as-basic-fast / Safari and Chrome / {
0%, 100% {
-webkit-box-shadow: 0 0 0 3px <?php echo (!empty($data['map-color-cluster'])) ? esc_html($data['map-color-cluster']) : ''; ?>;
-moz-box-shadow: 0 0 0 3px <?php echo (!empty($data['map-color-cluster'])) ? esc_html($data['map-color-cluster']) : ''; ?>;
box-shadow: 0 0 0 3px <?php echo (!empty($data['map-color-cluster'])) ? esc_html($data['map-color-cluster']) : ''; ?>;
}
50% {
-webkit-box-shadow: 0 0 0 5px <?php echo (!empty($data['map-color-cluster'])) ? esc_html($data['map-color-cluster']) : ''; ?>;
-moz-box-shadow: 0 0 0 5px <?php echo (!empty($data['map-color-cluster'])) ? esc_html($data['map-color-cluster']) : ''; ?>;
box-shadow: 0 0 0 5px <?php echo (!empty($data['map-color-cluster'])) ? esc_html($data['map-color-cluster']) : ''; ?>;
}
}


/*= Map infobox =*/
.info_details{
    padding: 0px;
    width: 320px;
    height:152px;
    margin-top: -210px;
	margin-left: -160px; 
    position: absolute;
    background: #ffffff;
    box-shadow: 1px 1px 48px #ccc;
    box-shadow: 0px 2px 6px 0px rgba(0, 0, 0, 0.39);
	padding:6px; 
}

.info_details:after {
    top: 100%;
    border: solid transparent;
    content: " ";
    height: 0;
    width: 0;
    position: absolute;
    border-top-color: #fff;
    border-width: 15px;
    left: 50%;
    margin-left: -15px;
}

.contact_info_details{
    height: 120px;
    margin-top: -8px;
    margin-left: -64px;

}

.contact_info_details h2{
    font-size:30px;
    color:#b881fc;
    background-color: #fff;
    float:left;
    width:100%;
    text-align: center;
}

.info_details img{
    max-width: 100%;
    width: 100%;
    height: auto;
    float:left;
    max-height:200px;
}

#infocloser{
    position: absolute;
    width:18px;
    height:18px;
    z-index: 999999;
 	background-color:<?php echo (!empty($data['color-scheme'])) ? esc_html($data['color-scheme']) : ''; ?>;
    cursor: pointer;
    top:6px;
    left:6px;
    text-align:center;
    color:#fff
}

.infoimage{
	width:140px;
    height:140px;
    float:left;
    margin-right:15px;
    background-size: cover;
    background-position: 50% 50%;
    border-top-left-radius: 3px;
    border-top-right-radius: 3px;
}

#infobox_title{
	display:block;
	font-size: 16px;
    line-height: 1.1em;
    color: #707070;
	text-transform:uppercase;
    padding:5px 0px ;
    font-weight: 700;
}

.map-company{
	font-size: 13px;
    line-height:16px;
    color: #707070;
    padding:0 0px 5px;
}

.map-address {
	padding-top:5px;
	padding-right:5px;
}

#infobox_title:hover,
.info_details a:hover{
    color:#3396D1;
}

.map-category {
    background:<?php echo (!empty($data['color-scheme'])) ? esc_html($data['color-scheme']) : ''; ?>;
    color: #fff;
    display: inline;
    font-size: 12px;
    font-weight: 800;
    margin-bottom: 10px;
    padding: 0 5px;
    text-transform: uppercase;
}



#info_inside{
    padding-left: 13px;
    float: left;
    font-size: 14px;
    margin-top: 13px;
    color: #717374;
    width: 100%;
}

.prop_detailsx{
    float: left;
    display: inline;
    font-size: 14px!important;
    color: #8A8F9A;
    padding: 11px 15px 7px 15px;
    background-color: #fff;
    box-sizing: border-box;
    -moz-box-sizing: border-box;
    margin-top: 0px;
    font-weight: 400!important;
    font-family: 'Raleway', sans-serif;
}

#googleMapSlider .prop_detailsx{
    margin-top: 2px;
}

.prop_pricex{
float: left;
    display: inline;
    color: #fff;
    color: #009F8B;
    font-size: 20px;
    opacity: 1;
    line-height: 0px;
    position: absolute;
    right: 15px;
    bottom: 68px;
    font-weight: 700;
    font-family: 'Open Sans', sans-serif;
}

.infogradient{
	display:none;
    width: 100%;
    height: 66px;
    position: absolute;
    top:74px;
    left: 0px;
    /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#2b313e+0,282f3d+100&amp;0+0,1+82 */
   background: -moz-linear-gradient(top,  rgba(43,49,62,0) 0%, rgba(41,47,61,1) 82%, rgba(40,47,61,1) 100%); /* FF3.6+ */
   background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(43,49,62,0)), color-stop(82%,rgba(41,47,61,1)), color-stop(100%,rgba(40,47,61,1))); /* Chrome,Safari4+ */
   background: -webkit-linear-gradient(top,  rgba(43,49,62,0) 0%,rgba(41,47,61,1) 82%,rgba(40,47,61,1) 100%); /* Chrome10+,Safari5.1+ */
   background: -o-linear-gradient(top,  rgba(43,49,62,0) 0%,rgba(41,47,61,1) 82%,rgba(40,47,61,1) 100%); /* Opera 11.10+ */
   background: -ms-linear-gradient(top,  rgba(43,49,62,0) 0%,rgba(41,47,61,1) 82%,rgba(40,47,61,1) 100%); /* IE10+ */
   background: linear-gradient(to bottom,  rgba(43,49,62,0) 0%,rgba(41,47,61,1) 82%,rgba(40,47,61,1) 100%); /* W3C */
   filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#002b313e', endColorstr='#282f3d',GradientType=0 ); /* IE6-9 */

}

.infodetails{
    position: relative;
    float: right;
    margin-top: 15px;
    margin-right: 12px;
    margin-left: 0px;
    color: #8A8F9A;
}

/*= Map controls =*/
#gmap-controls-wrapper{
    width:36px;
    position: absolute;
    top:50%;
    left:20px;
    margin-top:-55px;
    z-index: 9;
    pointer-events: none;
}

.provider-map #gmap-controls-wrapper{
    width:30px;
    top:auto;
    left:auto;
	right:20px;
	bottom:20px;
    margin:0;
}

.provider-map #gmap-controls-wrapper [id*="gma"] {
    width:30px;
	height:24px;
	line-height:24px;
	font-size:10px;
    margin-bottom:2px;
}

.provider-map #gmap-controls-wrapper [id*="gma"]:last-child {
    display:none;
}


@media only screen and (max-width:767px) {

#gmap-controls-wrapper{
	width:32px;  
    top:15px;
    left:15px;
    margin-top:0;
}

}

#gmapzoomplus,
#gmapzoomminus,
#geolocation-button,
#gmap-full,
#gmap-prev,
#gmap-next{
    pointer-events: auto;
}

#geolocation-button,
#gmap-full,
#gmap-next,
#gmap-prev,
#gmapstreet,
#gmapzoomplus,
#gmapzoomminus{
    background-color: #333;
    color: #FFFFFF;
    font-size: 10px;
    width: 30px;
    height:26px;
	line-height:24px;
	text-align:center;
    border: 1px solid #333;
    z-index: 99;
    -webkit-transition: all 0.2s ease;
    -moz-transition: all 0.2s ease;
    -o-transition: all 0.2s ease;
    transition: all 0.2s ease;
    pointer-events: auto;
    float: left;
    margin-bottom:2px;
    cursor:pointer;
}

@media only screen and (max-width:767px) {
	
#geolocation-button, 
#gmap-full, 
#gmap-next, 
#gmap-prev, 
#gmapstreet, 
#gmapzoomplus, 
#gmapzoomminus {
	width:32px;  
}
	
}

#gmap-controls-wrapper.fullscreenon{
    z-index: 99999;
	position:fixed;
}

.google_map_on_list_wrapper{
    position: relative;
    width: 100%;
    float: left;
}

.google_map_on_list_wrapper #gmapzoomminus{
    position:absolute;
    top:15px;
    left:52px;
}
.google_map_on_list_wrapper #gmapzoomplus{
    position:absolute;
    top:15px;
    left:15px;
}
.google_map_on_list_wrapper #gmapstreet{
    position:absolute;
    top:15px;
    left:89px;
}

.boxed  .google_map_on_list_wrapper #gmapzoomplus{
    left:24px;
}

.boxed .google_map_on_list_wrapper #gmapzoomminus{
    left:61px;
}

.boxed .google_map_on_list_wrapper #gmapstreet{
    left:98px;
}
   

#gmapzoomminus.smallslidecontrol{
    left:15px;
    top:96px;
    padding-top:5px;
    display:none;
}

#gmapzoomplus.smallslidecontrol{
    top:63px;
    left:15px;
    padding-top:5px;
    display:none;
}


#gmap-control-list{
    position: absolute;
    top: 0px;
    right: 0px;
    width: 100%;
    height: 60px;
    box-sizing: border-box;
    z-index: 100;
    text-align: left;
    opacity:1;
    padding: 10px 10px 0px 10px;
    z-index:1;
}

/* Map Full Screen */
.full-screen-map {
	position:fixed;
	width:100%;
	height:100%;
	left:0;
	top:0;
}

.full-screen-map .search-result-listing {
	z-index:0;
} 

.full-screen-map #header-part{
	z-index:1;
}

.full-screen-map #no-result{
	position:absolute;
	left:50%;
	bottom:50%;
	width:270px;
	margin:-20px -135px;
}

.fullmap {
    height: 100%;
    left: 0;
    margin: 0;
    padding: 0;
    position: fixed !important;
    top: 0;
    width: 100%;
    z-index: 99;
}

/*---------------------------------------------------------------
26. PAGINATION 
---------------------------------------------------------------*/
/* pagination style-1 */
.pagination-bx .pagination,
.cvf-universal-pagination  .pagination { 
	margin:0;
}
.pagination { 
	padding:10px 0;
}


.pagination > li:first-child > a, 
.pagination > li:first-child > span {
    border-bottom-left-radius: 0;
    border-top-left-radius: 0;
    margin-left: 0;
}
.pagination > li:last-child > a, 
.pagination > li:last-child > span {
    border-bottom-right-radius: 0;
    border-top-right-radius: 0;
}

.pagination > li > a, 
.pagination > li > span {
    background-color: #fff;
    border: 1px solid #e0e0e0;
    color: #767676;
    padding:8px 14px;
	font-weight:600;
	font-size:12px;
}

.pagination > li > a:hover, 
.pagination > li > span:hover, 
.pagination > li > a:focus, 
.pagination > li > span:focus {
 	background-color: <?php echo (!empty($data['color-scheme'])) ? esc_html($data['color-scheme']) : ''; ?>;
    border:1px solid rgba(0, 0, 0, 0.2);
	color: #fff;
}

.pagination > .active > a, 
.pagination > .active > span, 
.pagination > .active > a:hover, 

.pagination > .active > span:hover, 
.pagination > .active > a:focus, 
.pagination > .active > span:focus {
    background-color: <?php echo (!empty($data['color-scheme'])) ? esc_html($data['color-scheme']) : ''; ?>;
    border:1px solid rgba(0, 0, 0, 0.2);

}

.pagination > .previous > a, 
.pagination > .next > a {
    padding:8px 14px;
	font-size:12px;
}

/*DataTable  pagination */
.dataTables_paginate ul.pagination {margin:0;}
.dataTables_paginate .pagination > li{padding:0;}

/*---------------------------------------------------------------
27. FOOTER 
---------------------------------------------------------------*/
footer h1, 
footer h2,
footer h3, 
footer h4, 
footer h5, 
footer h6 { 
	color: #fff;
}


footer a,
footer a:visited { 
	color: #fff;
}

footer a:active,
footer a:focus,
footer a:hover { 
	color: <?php echo (!empty($data['color-scheme'])) ? esc_html($data['color-scheme']) : ''; ?>;
}

footer#footer { 
	background-position:center;
	background-size:cover;
} 

.sf-top-footer-overlay,
.sf-bottom-footer-overlay {
	position:relative;
}
.sf-top-footer-overlay .container,
.sf-bottom-footer-overlay .container {
	position:relative;
	z-index:1;
}
.sf-top-footer-overlay:before,
.sf-bottom-footer-overlay:before {
	content:"";
	background:#000;
	position:absolute;
	top:0;
	left:0;
	width:100%;
	height:100%;	
}
.sf-top-footer-overlay:before {
	opacity:<?php echo (isset($data['footer-bg-opacity'])) ? esc_html($data['footer-bg-opacity']) : ''; ?>;
}
.sf-bottom-footer-overlay:before {
	opacity:<?php echo (isset($data['bottom-footer-bg-opacity'])) ? esc_html($data['bottom-footer-bg-opacity']) : ''; ?>;
}

footer p { 
 color: #fff;
 line-height:22px;
 margin-bottom:10px;
}

footer p a{ 
	color: <?php echo (!empty($data['color-scheme'])) ? esc_html($data['color-scheme']) : ''; ?>;
}

footer .widget ul{
	list-style:none;
	margin-top:5px;
	margin-left:0;
	margin-right:0;
	margin-bottom:0;
}

.widget {
	
}

.widget i.fa{
	margin-right:5px;
}

.widget-title {
	margin:15px 0 25px;
}

.widget-title:after {
	content:"";
	width:50px;
	height:2px;
	display:block;
	margin:10px 0;
	background:<?php echo (!empty($data['color-scheme'])) ? esc_html($data['color-scheme']) : ''; ?>;
}

#footer .widget_categories ul li:before,
#footer .widget_archive ul li:before,
#footer .widget_meta ul li:before,
#footer .widget_pages ul li:before,
#footer .widget_recent_comments ul li:before,
#footer .widget_nav_menu ul li:before, 
#footer .widget_recent_entries ul li:before  {
	font-family: "FontAwesome";
	content: "\f0da";
	color:#FFF;
	position: absolute;
	left: 0;
	top:10px;
	display: block; 
}


#footer .widget_categories li,
#footer .widget_meta li,
#footer .widget_recent_comments  li,
#footer .widget_archive li,
#footer .widget_pages li,
#footer .widget_nav_menu li, 
#footer .widget_recent_entries li  {
	position:relative;
	padding:10px 10px 10px 15px;
	border-bottom:1px dashed #313131;
	color:#FFF; 
}

#footer .widget_categories li:last-child,
#footer .widget_meta li:last-child,
#footer .widget_recent_comments  li:last-child,
#footer .widget_archive li:last-child, 
#footer .widget_pages li:last-child,
#footer .widget_nav_menu li ,
#footer .widget_recent_entries li  {
	border-bottom:none; 
}

#footer .widget_categories li li,
#footer .widget_meta li li,
#footer .widget_recent_comments  li li,
#footer .widget_archive li li,
#footer .widget_pages li li,
#footer .widget_nav_menu li li, 
#footer .widget_recent_entries li li  {
	border-bottom:none;
	padding-left:7px;
	padding-right:5px;
	padding-top:0;
	padding-bottom:0;
	line-height:28px;
}
#footer .widget_categories li li:before,
#footer .widget_meta li li:before,
#footer .widget_recent_comments  li li:before,
#footer .widget_archive li li:before,
#footer .widget_pages li li:before,
#footer .widget_nav_menu li li:before, 
#footer .widget_recent_entries li li:before {
	top:0;
	left:-12px;
}


/* Recent posts & Recent tweets */
.recent-posts-entry li:last-child,
.tweets-feed-entry li:last-child { 
	border-bottom:none; 
}

.recent-posts-entry li,
.tweets-feed-entry li {
	margin-bottom: 0;
	min-height: 96px;
	padding-bottom: 12px;
	padding-top: 10px;
	width: 100%;
	clear:both;
	border-bottom:1px dashed #3d3d3d;
}

.recent-posts-entry p,
.tweets-feed-entry p { 
	margin:0 0 2px;  
}

.recent-posts-entry .post-date,
.tweets-feed-entry .tweet-date { 
	color:<?php echo (!empty($data['color-scheme'])) ? esc_html($data['color-scheme']) : ''; ?>; 
	font-size:12px; 
	font-style:italic;
}

.recent-posts-entry .post-thum-bx { 
	width:70px; 
	float:left;
	margin-top:3px; 
	margin-right:15px; 
	border:1px solid #FFF;
}

.recent-posts-entry .post-title { 
	margin:0 0 2px;  
}
.recent-posts-entry .post-text-bx { 
	margin-left:75px;
}




.tweets-feed-entry .post-date { 
	color:#08c7a6; 
	font-size:12px; 
	font-style:italic;
}

.tweets-feed-entry a { 
	color:#08c7a6; 
}

.recent-posts-entry ul li.no-img-post {
	min-height:60px;
}

.recent-posts-entry ul li.no-img-post .post-thum-bx{
	display:none;
}

.recent-posts-entry ul li.no-img-post .post-text-bx{
	margin-left:0;
}

/* footer Mata */


/* footer Tags  */
#footer .widget_tag_cloud a{
	padding:8px 10px;
	background-color:#e6e6e6;
	font-size:12px;
	display:inline-block;
	margin:0 0 5px;
	color:#555555; 
}
#footer .widget_tag_cloud a:hover{
	background-color:#CCCCCC;
}

/*Twitter Recent feeds*/
#footer .tweet_algo .twit-text {
	padding:0 0 10px;
}
#footer .tweet_algo .twit-info strong {
	text-transform:uppercase;
}
#footer .tweet_algo .twit-info strong:after {
	content:"/";
	padding-left:3px;
}

/*Footer Archive*/
#footer .widget_archive label {
	display:block;
}
#footer .widget_archive select  {
	width:100%;
	border:1px solid #CCC;
	padding:5px;
}


/*Footer categories*/
.widget_categories select{
	width:100%;
	padding:5px;
	border:1px solid #CCC;
}

.widget_archive .bootstrap-select ul li,
.widget_text .bootstrap-select ul li,
.widget_categories .bootstrap-select ul li {
	padding:0 !important;
}
.widget_archive .bootstrap-select ul li:before,
.widget_text .bootstrap-select ul li:before,
.widget_categories .bootstrap-select ul li:before {
	display:none;
}


/*Footer Widget RSS */
#footer .widget_rss li {
	border-bottom:1px dashed #313131;
	padding-bottom:10px;
	margin-bottom:10px;
}

#footer .widget_rss  .rsswidget{
	text-transform:uppercase; 
	font-weight:600;
	color:#fff;
}
#footer .widget_rss .rss-date {
	color:#999;
	
}
#footer .widget_rss .rssSummary {
	padding:5px 0;
	color:#fff;
}
#footer .widget_rss cite {
	color:#3396d1 ;
}

/*Footer calender */
#footer .widget_calendar tfoot tr td a {
	background-color:transparent;
}
#footer .widget_calendar caption:after,
#footer .widget_calendar caption {
	color:#FFF;
}

/* footer logo */
.widget_text .f-logo{
	margin:15px 0;
}

.footer-top { 
    background:<?php echo (!empty($data['footer-background-color'])) ? esc_html($data['footer-background-color']) : ''; ?>; 
    background-size:cover; 
    background-position:center;  
    padding:50px 0;
}

.footer-bottom { 
    background:<?php echo (!empty($data['bottom-footer-bg-color'])) ? esc_html($data['bottom-footer-bg-color']) : ''; ?>;  
    padding:30px 0; 
    color:<?php echo (!empty($data['bottom-footer-text-color'])) ? esc_html($data['bottom-footer-text-color']) : ''; ?>; 
}

.footer-bottom .socila-box{ 
    margin-bottom:0;
}

@media only screen and (max-width: 767px) {
	
.footer-bottom [class*="col-"] { 
    width:100%;
	float:none;
	text-align:center;
}

.footer-bottom [class*="col-"]:first-child { 
    margin-bottom:15px;
}	
	
.footer-bottom .socila-box{ 
	float:none !important;
}		

}



/* scroll top btn css */
button.scroltop { 
	background:#161616;  
	border:none;   
	position: fixed;   
	right: 10px;   
	bottom:20px;  
	color: #fff; 
	margin:0;   
	cursor: pointer;    
	display: none;    
	height: 30px;  
	width: 30px;
    padding:8px;
	text-align:center;  
	-webkit-border-radius:50px;
	border-radius:50px;
}


@media only screen and (max-width:991px) {


#footer .container {
	width:100%;
	padding-left:30px;
	padding-right:30px;
}

#footer .footer-4-col {
	width:50%;
	margin-bottom:40px;
}
	
}


@media only screen and (max-width: 767px) {

.footer-clear {
	display:block !important;
    clear:both;
}

#footer .footer-4-col {
	width:100%;
}	

#footer .footer-3-col {
 width:100%;
}

.footer-bottom [class*="clo-"] { 
	width:100%;
}

}


/*---------------------------------------------------------------
28. PAGE-CONTENT
---------------------------------------------------------------*/
.page-wraper { 
	background:#f7f8fa;
}
.page-content { 
	margin-top:0; 
	padding-bottom:50px;
}
.section-full { 
    padding:80px 0;
    position:relative;  
}
.section-full > .container { 
	z-index:1;
	position:relative; 
}
.section-full:last-child { 
	margin-bottom:-50px;
}

@media only screen and (max-width:1024px) {
	
.section-full{
	background-attachment:scroll !important; 
}

}
@media only screen and (max-width: 991px) {
	
.page-content {
    margin-top: 0;
}
.section-full { 
	padding:50px 0; 
}
}

/*== >How Service Finder Works ==*/
.how-sf-work .icon-bx{ 
	margin-bottom:5px; 
}

.how-sf-work .sf-element-bx .shadow-bx { 
	width:100px;
	margin:auto;
}

.how-sf-work .sf-element-bx .shadow-bx img{ 
	width:100%;
}

.how-sf-work p {
	margin-bottom:10px;
	line-height:20px;
}

.how-sf-work .sf-element-bx .step-no-bx { 
	font-size:72px; 
	color:#eaeaea; 
	font-weight:700; 
	font-family:Arial;
}

.how-sf-work .sf-element-bx:hover .icon-bx-lg {
	-moz-transform: translateY(-10px);
	-webkit-transform: translateY(-10px);
	-o-transform: translateY(-10px);
	-ms-transform: translateY(-10px);
	transform: translateY(-10px); 
}

.how-sf-work .sf-element-bx:hover .shadow-bx  {
	width:50px; 
}

.how-sf-work .sf-element-bx:hover .step-no-bx  {
	color:#999999; 
}

.line-bx {
	bottom:60px; 
	left:0; 
	width:100%; 
	position:absolute; 
}

.line-bx .pull-left,
.line-bx .pull-right { 
	width:60%;
}

@media only screen and (max-width: 991px) {
	
.how-sf-work .padding-lr-30 {
	padding-left:10px;
	padding-right:10px;
}

.line-bx .pull-left,
.line-bx .pull-right { 
	display:none;
}

}


/*== >Service Finder Categories ==*/

.sf-title-bx {
	padding: 15px 20px;
	background:<?php echo (!empty($data['color-scheme'])) ? esc_html($data['color-scheme']) : ''; ?>;
	color: #FFF;
}

.service-name {
	margin: 0;
	color: #FFF;
	font-weight: 500;
	position:absolute;
	left:0;
	bottom:0;
	padding:10px 20px;
    z-index:1;
}

.service-name a{
	color: #FFF;
}

.service-plus {
	background:<?php echo (!empty($data['seconday-color-scheme'])) ? esc_html($data['seconday-color-scheme']) : ''; ?>;
	color:#FFF;
    top: 20px;
    font-size: 13px; 
    font-weight: 700;
    left: 20px;
    padding: 2px 10px;
    position: absolute;
    z-index:1;
	box-shadow:0px 4px 10px rgba(0,0,0,0.2);
	-webkit-box-shadow:0px 4px 10px rgba(0,0,0,0.2);    
}

.service-plus i {
	margin-right: 5px;
}

.overlay-bg:before{
	content:"";
	background:#000;
	position:absolute;
	left:0;
	top:0;
	width:100%;
	height:100%;
	opacity:0.3;
    opacity:<?php echo (isset($data['overlay-hover-opacity'])) ? esc_html($data['overlay-hover-opacity']) : ''; ?>;
	z-index:1;
}

.sf-cate-no-img .sf-thum-bx {
	min-height:250px;
	border:1px dashed #ddd;
	box-shadow:none;
	-webkit-box-shadow:none;
}

@media only screen and (max-width:1200px) {
.sf-cate-no-img .sf-thum-bx {
    min-height: 220px;
}
}

@media only screen and (max-width:991px) {
.sf-cate-no-img .sf-thum-bx {
    min-height: 258px;
}
}

.sf-cate-no-img:hover .sf-thum-bx:before,
.sf-cate-no-img:hover .sf-thum-bx:after {
	display:none;
}
.sf-cate-no-img.overlay-bg:before {
	display:none;
}
.sf-cate-no-img sf-thum-bx:before,
.sf-cate-no-img sf-thum-bx:after {
	display:none;
}
.sf-cate-no-img .service-name {
    color: #777777;
}

.provider-sub-category .sf-cate-no-img .sf-thum-bx {
	min-height:247px;
}

@media only screen and (max-width:1200px) {
.sf-cate-no-img .sf-thum-bx {
    min-height: 196px;
}
}

@media only screen and (max-width:991px) {
.sf-cate-no-img .sf-thum-bx {
    min-height: 230px;
}
}


/*== > Who's on servicefinder.com ==*/
.who-fs-com { 
	background-image:url(inc/images/background/bg1.jpg); 
	background-size:cover; 
	background-attachment:fixed;
	background-position:center;
}

.sf-about-text p {
    color: #fff;
    font-size: 16px;
}


/*== > Why Use servicefinder ==*/
.why-use-sf .icon-bx-md{
	border:2px solid <?php echo (!empty($data['color-scheme'])) ? esc_html($data['color-scheme']) : ''; ?>;
	margin-bottom:20px;
}
.why-use-sf .icon-bx-md i{
	margin:-6px 0 0;
}

.why-use-sf .sf-element-bx:hover .icon-bx-md {
	background-color:<?php echo (!empty($data['color-scheme'])) ? esc_html($data['color-scheme']) : ''; ?>;
}

.why-use-sf .sf-element-bx:hover .icon-bx-md i{
	color:#FFFFFF;
}

.why-use-sf p{
	line-height:20px;
	margin-bottom:0;
}

@media only screen and (max-width:767px) {
	
.why-use-sf .padding-lr-30{
	padding-left:0;
    padding-right:0;
}
	
}

@media only screen and (max-width:480px) {
	
.why-use-sf [class*="col-"]{
	width:100%;
}
.why-use-sf .padding-lr-30{
	padding-left:20px;
    padding-right:20px;
}	
}



/*== > Featured Providers ==*/
.sf-category-tag {
	position:absolute;
	left:0;
	bottom:0;
    margin:20px;
	background:#ff650d;
	color:#FFF;
	text-transform:uppercase;
	padding:3px 10px;
	font-size:14px;
    z-index:3;
    background-attachment:fixed;
}
.sf-company-name {
	display:block;
	margin-bottom:15px;
}
.sf-category-tag a{
	color:#FFF;
}
.sf-featured-bx {
 background:#FFF;
 margin:0 15px;
}
.sf-featured-label,
.sf-hired-label {
	background:url(inc/images/featured-label.png) 0 0 no-repeat ;
	width:82px;
	height:82px;
	position:absolute;
	top:0;
	left:0;
    z-index:1;
    color:#FFF;
}

.sf-featured-label span,
.sf-hired-label span {
	bottom: 45px;
    display: block;
    font-size: 12px;
    left: 0;
    position: absolute;
	-moz-transform: rotate(-46deg);
	-webkit-transform: rotate(-46deg);
	-o-transform: rotate(-46deg);
	-ms-transform: rotate(-46deg);
	transform: rotate(-46deg);
    text-shadow:0 0 2px rgba(0,0,0,0.5);
}
.sf-hired-label {
	background:url(inc/images/hired-label.png) right bottom no-repeat ;
	top:auto;
	left:auto;
	right:0;
	bottom:0;
}
.sf-hired-label span {
	bottom:20px;
	left:auto;
	right:12px;
}
.sf-job-title-bx {
	font-size:15px;
	text-transform:uppercase;
}

.sf-featured-bx {
	background:#FFF;
}
.sf-featured-bx .padding-20{
	padding:15px 15px 10px;
}
.sf-featured-bx .btn{
	padding:8px 10px;
}

.sf-featured-bx .sf-title{
	text-transform:uppercase;
	margin-top:0;
}

.sf-featured-bx  p{
	text-transform:uppercase;
    margin:0;
}


/*== >Service Finder Categories 2 ==*/
.sf-category2 [class*="icon-bx-"]{
	background:none;
	background:<?php echo (!empty($data['color-scheme'])) ? esc_html($data['color-scheme']) : ''; ?>;
	margin-bottom:20px;	
}
.sf-category2 .sf-title{
	margin:0 0 5px;	
}
.show_more_main {
	clear:both;
    padding-top:20px;
}

/*== > Providers Follow us ==*/
.providers-follow {
	padding:150px 0; 
	background-image:url(../images/background/bg5.jpg); 
    background-position: center center;
    background-size: cover;
}

.providers-follow .sf-title{
	font-size:48px;
	text-transform:uppercase;
	font-weight:700;
	display:block;
	margin-bottom:15px;
}
.providers-follow .sf-title span{
	color:#3396d1;
}

.providers-follow .sf-follow-text{
	font-size:18px;
	padding:0 15%;
}

/*== >  Latest-blog ==*/

.latest-blog .post-thum{
 position:relative;
}

.latest-blog .post-date {
	position:absolute;
	bottom:30px;
	left:30px;
}
.latest-blog .post-info {
	background:#f7f8fa;
	padding:30px;
	border-bottom:2px solid #e9e9e9;
}
.latest-blog .post-meta {
    border-bottom:none;
    border-top:none;
    margin: 0;
    padding:10px 0;
}

.latest-blog .post-meta ul {
    float:none;
}

.latest-blog .sf-no-img-blog .post-date {
    position:static;
    margin:30px 30px 10px 30px;
}


/*== > testimonial ==*/

.testimonial-bx { 
	margin-bottom:0; 
	padding:0px 30px; 
	position:relative;
}

.sf-testimonials .col-md-6:first-child:after { 
	content:""; 
	border-bottom:1px solid #e0e0e0; 
	border-right:1px solid #e0e0e0; 
	position:absolute; 
	right:0; 
	top:0; 
	width:0; 
	height:100%; 
}


.testimonial-pic {
	background:#FFF; 
	width:100px; 
	height:100px;
	overflow:; 
	border:5px solid #FFF;  
	position:relative;
	float:left;
	border-radius:100%; 
	-webkit-border-radius:100%;
	-webkit-box-shadow:2px 3px 6px -3px rgba(0, 0, 0, 0.35);
	-moz-box-shadow: 2px 3px 6px -3px rgba(0, 0, 0, 0.35);
	box-shadow:2px 3px 6px -3px rgba(0, 0, 0, 0.35);
	
}

.testimonial-pic img { 
	width:90px; 
	height:90px;
	border-radius:100%; 
	-webkit-border-radius:100%;
	
}

.testimonial-pic:before {
	content:"\f10d"; 
	font-family: "FontAwesome";
	display:block;
	width:36px; 
	height:36px;
	line-height:36px;
	font-size:16px;
	background:<?php echo (!empty($data['color-scheme'])) ? esc_html($data['color-scheme']) : ''; ?>;
	color:#FFF;
	text-align:center;
	position:absolute ;
	left:0;
	top:65px;
	border-radius:100%; 
	-webkit-border-radius:100%;
	z-index:10;
	
}


.testimonial-text {
	margin-left:120px;
	line-height:20px;
	padding: 10px;
}

.testimonial-text p {
	margin-bottom:0;
	line-height:22px;
	color:#555;
}

.testimonial-text .testimonial-detail {
	margin-top:15px;
}

.testimonial-text strong {
	font-size:16px;
	color:#3396d1; 
	display:inline-block; 
	position:relative; 
	margin-right:5px; 
}

.testimonial-text strong:after{ 
	content:"/"; 
	color:#333;
	margin-left:3px;
}

.testimonial-text span {
	font-size:14px;
	color: #333333; 
	font-style:italic;  
}

@media only screen and (max-width: 480px) {
	
.testimonial-bx { 
	padding:0; 
}	
.testimonial-pic {
	float:none;
	margin:0 auto 15px;
}
.testimonial-text {
    margin-left:0;
	text-align:center;
}
.testimonial-text .testimonial-detail {
	padding-top:10px;
}

}


/*---------------------------------------------------------------
29. INNER-CONTENT
---------------------------------------------------------------*/

/*== > filter sort by ==*/
.title-section {
	clear:both;
	padding: 15px 0;
	margin-top: 50px;
	border-top: 1px solid #e1e1e1;
	border-bottom: 1px solid #e1e1e1;
}
.title-section .result-title {
	margin:10px 0;
}
.title-section .result-title strong{
	color:#3396d1;
}
.sort-filter-bx {
}
.sort-filter-bx .f-f-left, .sort-filter-bx .f-f-right {
	display: inline-block;
}
.sort-filter-bx .f-f-left .form-group {
	display: inline-block;
	margin:3px 0;
}
.sort-filter-bx .f-f-right ul {
	margin: 0;
}
.sort-filter-bx .f-f-right ul li {
	padding: 0 0px;
}
.sort-filter-bx .f-f-right ul li .btn {
	background: #FFF;
	color: #333;
}
.sort-filter-bx .f-f-right ul li .btn i {
	font-size: 14px;
}

@media only screen and (max-width:767px) {
.title-section [class*="col-"] {
	width:100%;
	float:none;
}	

.sort-filter-bx.pull-right{
	float:none !important;
} 	
}


/*== > search result ==*/
.sf-map-serach-page .listing-box,
.sf-map-serach-page .listing-grid-box {
	padding-top:30px;
}
.result-listing  { 
	background:#FFF;
}
.result-listing .sf-thum-bx { 
	width:400px;
	float:left;
	min-height:280px;
	margin-right:30px;
}
.result-listing .result-text { 
	padding:20px;
}
.result-listing .sf-title { 
	margin-top:0;
    margin-right:90px;
    text-transform:uppercase;
}
.result-listing .sf-company-name{
	display:block; 
	margin-bottom:10px;
}
.result-listing .rating-container { 
	position:absolute;
	top:15px;
	right:15px;
}
.result-listing a.btn { 
	position:absolute;
	bottom:20px;
	right:15px;
	background:none;
	border:none;
	padding:0;
	color:#ccc 	!important;
	font-size:0;
}
.result-listing a.btn:hover,
.result-listing a.btn:active,
.result-listing a.btn:focus { 
	color:#666 !important;
	background:none;
}

.result-listing a.btn:hover { 
	color:#ccc !important;
}
.result-listing a.btn .fa{ 
	font-size:16px;
}
.result-listing a.btn.remove-favorite .fa{ 
	color:#77c04b;
}

@media only screen and (max-width:991px) {
.result-listing .sf-thum-bx {
    width:300px;
}
}
@media only screen and (max-width:767px) {
.result-listing .sf-thum-bx { 
	min-height:225px;
}
}

@media only screen and (max-width:640px) {
.result-listing .sf-thum-bx {
    width: 100%;
	float:none;
	margin:0 0 15px;
}
.result-listing .result-text {
	position:relative;
}
}

/*== > provider box ==*/
.sf-provider-bx { 
	text-align:center;
}

.sf-provider-bx .sf-title {
    text-transform:uppercase;
}

.sf-provider-bx .sf-category-tag {
    font-size: 12px;
    padding: 2px 5px;
}
.sf-provider-bx .btn {
    padding:9px 2px;
}
.sf-provider-bx .sf-company-name {
    min-height:20px;
	margin-bottom:5px;
	display:block;
}

/*== > provider box thum height manage ==*/
.sf-listing-grid-4 .sf-thum-bx { 
	min-height:203px;
}
.sf-listing-grid-3 .sf-thum-bx { 
	min-height:278px;
}
.sf-listing-grid-2 .sf-thum-bx { 
	min-height:236px;
}

@media only screen and (max-width:1200px) {
.sf-listing-grid-4 .sf-thum-bx  { 
	min-height:160px;
}
.sf-listing-grid-3 .sf-thum-bx { 
	min-height:220px;
}	
}

@media only screen and (max-width:991px) {
.sf-listing-grid-4 .sf-thum-bx { 
	min-height:259px;
}
.sf-listing-grid-3 .sf-thum-bx { 
	min-height:259px;
}
.sf-listing-grid-2 .sf-thum-bx { 
	min-height:262px;
}		
}	

@media only screen and (max-width:767px) {
.sf-listing-grid-4 .sf-thum-bx,
.sf-listing-grid-3 .sf-thum-bx,
.sf-listing-grid-2 .sf-thum-bx { 
	min-height:160px;
}	

.sf-listing-grid-4 .equal-col,
.sf-listing-grid-3 .equal-col,
.sf-listing-grid-2 .equal-col {
	margin-bottom:30px;
}
}	


/*== > provider rating ==*/
.sf-show-rating .star-rating .caption,
.sf-show-rating .star-rating .clear-rating  { 
	display:none;
}
.sf-show-rating .rating-container { 
	letter-spacing:2px;
	font-size:15px;
}
.sf-show-rating .rating-sm { 
	font-size:15px;
}
.sf-show-rating .rating-disabled { 
	cursor:text;
}

/*== > no result found ==*/
.sf-nothing-found,
sf-nothing-found2 {
	padding:20px;
	margin:24% 0;
}
.sf-nothing-found2 .sf-tilte,
.sf-nothing-found2 .sf-tilte {
	font-size:40px;
	font-weight:600;
	text-transform:uppercase;
}
.sf-nothing-found2 p,
.sf-nothing-found2 p {
	font-size:16px;
}

sf-nothing-found2 {
	margin:0;
}


/*== > provider sub category result ==*/
.provider-sub-category,
.provider-sub-category-center {
	padding:40px 0;
}

.provider-sub-category-center {
	text-align:center;
}

.provider-sub-category-center .icon-bx-md {
	background:<?php echo (!empty($data['color-scheme'])) ? esc_html($data['color-scheme']) : ''; ?>;
    margin-bottom:20px;
}

.provider-sub-category-center .icon-bx-md p{
	min-height:30px;
}


/*== > search result + Map==*/

.listing-map #header-part .container{
 width:auto; 
}

.google-map-fixed{
    position:fixed;
    left:0; 
    bottom:0;
    width:100%;
    height:100%;
    padding-right:700px;
    z-index:1;
}

.search-result-listing {
    width:700px;
    float:right;
    position:relative;
	z-index:2;
}

.search-result-listing .search-form {
    padding:15px 10px;
}

.search-result-listing .search-form .search-col-3,
.search-result-listing .search-form .search-col-4,
.search-result-listing .search-form .search-col-5,
.search-result-listing .search-form .search-col-6 {
	padding:0 10px;
	margin:10px 0;
}

.search-result-listing .search-form .search-col-3 {
    width:33.333%;
	padding:0 10px;
	margin:10px 0;
}
.search-result-listing .search-form .search-col-4 {
    width:33.333%;
	padding:0 10px;
	margin:10px 0;
}
.search-result-listing .search-form .search-col-5 {
    width:50%;
	padding:0 10px;
	margin:10px 0;
}
.search-result-listing .search-form .search-col-6 {
    width:50%;
	padding:0 10px; 
	margin:10px 0;
}
.search-result-listing .search-form .col-sm-12.search-col-4,
.search-result-listing .search-form .col-sm-12.search-col-5,
.search-result-listing .search-form .col-sm-12.search-col-6 {
    width:100%;
}

@media only screen and (max-width:767px) {
.search-result-listing .search-form .search-col-3, 	
.search-result-listing .search-form .search-col-4,
.search-result-listing .search-form .search-col-5,
.search-result-listing .search-form .search-col-6 {
    width:100%;
}	
.search-result-listing .search-form .col-sm-12.search-col-3,
.search-result-listing .search-form .col-sm-12.search-col-4,
.search-result-listing .search-form .col-sm-12.search-col-5,
.search-result-listing .search-form .col-sm-12.search-col-6 {
	margin-top:0;
}
}

.search-result-listing .title-section .result-title {
	margin:10px 0;
}

.listing-wraper{
	padding:20px 20px 20px; 
}

.listing-wraper .search-form{
    padding:20px 20px 20px;
    background:#FFF;
    margin-bottom:30px; 
    position:relative; 
}

.listing-wraper .result-listing .sf-thum-bx {
    width:300px;
}

.listing-wraper .sf-category-tag {
    font-size:12px;
}

.search-result-listing .result-listing .sf-thum-bx {
    min-height: 225px;
}

@media only screen and (max-width:1200px) {
.google-map-fixed{
    width: %;
}

.search-result-listing {
    width: %;
}		
}

@media only screen and (max-width:991px) {
.google-map-fixed{
    padding-right:0;
	display:none;
}

.search-result-listing {
    width:100%;
}		
}


@media only screen and (max-width:767px) {
.search-result-listing [class*="col-sm-4"],
.search-result-listing [class*="col-sm-12"] {
    width:50%;
	float:left;
}
.search-result-listing .title-section .result-title {
	margin-bottom:15px;
}
}

@media only screen and (max-width:640px) {
.listing-wraper .result-listing .sf-thum-bx {
    width: 100%;
	float:none;
	margin:0 0 15px;
}
.result-listing .result-text {
	position:relative;
}
}

@media only screen and (max-width:480px) {
.search-result-listing [class*="col-sm-4"],
.search-result-listing [class*="col-sm-12"] {
    width:100%;
	float:none;
}
}


/*== > breadcrumb menu ==*/
.breadcrumb-row { 
	background:#e8e9e9; 
	padding:20px 0;
}

.breadcrumb-row ul { 
	margin:0;  
}

.breadcrumb-row ul li { 
	padding:0; 
	margin-right:3px;  
	color:#333333;
}
.breadcrumb-row ul li:after { 
	content:"/"; 
	margin-left:7px;
}

.breadcrumb-row ul li a { 
	color:<?php echo (!empty($data['color-scheme'])) ? esc_html($data['color-scheme']) : ''; ?>;	
}

.breadcrumb-row ul li:last-child { 
	color:#676767;
}

.breadcrumb-row ul li:last-child:after { 
	display:none;
}


/*== > Provider Details ==*/
.provider-details { 
	border-bottom:1px solid #efeded;
    min-height:120px;  
}
.provider-details .provider-logo { 
	width:200px; 
	float:left; 
	margin-right:30px; 
	text-align:center; 
    padding:10px;
	border:1px solid #E5E5E5;
    margin-bottom:15px;
	text-align:center;
	position:relative;
}
.provider-details .provider-text{ 
	min-height:255px;
}
.about-info .sf-provider-des .sf-average-question,
.provider-details .sf-average-question,
.result-listing .sf-average-question,
.listing-grid-box .sf-average-question,
.sf-featured-bx .sf-average-question,
.sf-map-serach-page .sf-average-question { 
 position:absolute;
 top:10px;
 right:10px;
 padding:3px;
 width:24px;
 height:24px;
 text-align:center;
 background-color:rgba(255,255,255,0.8);
 cursor:pointer;
 z-index:99;
}
.sf-featured-bx .sf-average-question { 
 top:208px;
 right:15px;
}
.about-info .sf-provider-des .sf-average-question { 
	top:15px;
	right:15px;
}
.result-listing .sf-average-question { 
	top:15px;
	right:15px;
}

.provider-details .btn { 
	margin:5px 0;
}

.provider-social { 
	padding-top:15px; 
}

.provider-social .social-bx { 
	float:left;
    margin:0; 
}
.provider-social .social-bx li a{ 
	border: 1px solid #ccc;
	color: #999;
	height: 25px;
	padding:5px;
	width: 25px;
	margin:0 3px;
}

.provider-social .rating-container{ 
	float:right; 
}

@media only screen and (max-width: 480px) {
.provider-details .provider-logo { 
	width:auto;
	height:auto; 
	float:none;
	margin: 0 0 20px;
}	
}

.provider-details .provider-logo img { 
	width:100%; 
	height:auto; 
	display:block; 
}




@media only screen and (max-width: 480px) {
.provider-details .provider-text {
    margin-left: 0;
}	
	
}

.provider-details .provider-text h5 { 
	margin-top:0; 
	margin-bottom:5px;
}

.provider-details .provider-text .tagline { 
	text-transform:uppercase;
	font-weight:600;
	
}

.provider-post-info { 
	padding:15px 0 0; 
}

.provider-post-info i { 
	margin:0 5px 0 10px; 
	color:<?php echo (!empty($data['color-scheme'])) ? esc_html($data['color-scheme']) : ''; ?>; 
}


/* shared buttons */
ul.sharebtn-bx {
	float:left;
}

ul.share-social-bx { 
	float:right; 
}

ul.sharebtn-bx ,
ul.share-social-bx { 
	list-style:none;
	margin:0;
	min-height:34px;
}

ul.sharebtn-bx li,
ul.share-social-bx li { 
	display:inline-block; 
	border:1px solid #efeded; 
	padding:0px 10px 0 0; 
	height:34px; 
	margin-right:8px;
}

ul.sharebtn-bx li a,
ul.share-social-bx li a { 
	display:inline-block;
}

ul.sharebtn-bx li i,
ul.share-social-bx li i  { 
	display:inline-block; 
	text-align:center; 
	color:<?php echo (!empty($data['color-scheme'])) ? esc_html($data['color-scheme']) : ''; ?>; 
	padding:10px; 
	margin-right:10px; 
	border-right:1px solid #efeded; 
	font-size:11px;
}


/* shared style 1*/

/* shared style 2*/
ul.share-social-bx li { 
	border:none; 
	width:36px; 
	display:block; 
	float:left;  
	white-space:nowrap;
	overflow:hidden; 
	margin-right:0; 
 }
 
ul.share-social-bx li a { 
	color:#FFF;
}

ul.share-social-bx li i { 
	border-right:none; 
	font-size:14px; 
	color:#FFF; 
	width:36px; 
	height:34px;
	line-height:34px; 
	padding:0; 
	text-align:center; 
}

ul.share-social-bx li.fb {
	background: #354d89;
}
ul.share-social-bx li.fb i {
	background: #3a5799;
}
ul.share-social-bx li.gp {
	background: #d34b2b;
}
ul.share-social-bx li.gp i {
	background: #e35736;
}
ul.share-social-bx li.tw {
	background: #029fdf;
}
ul.share-social-bx li.tw i {
	background: #00abf0;
}
ul.share-social-bx li.dig {
	background:#1d61aa;
}
ul.share-social-bx li.dig i {
	background: #2B6FB8;
}
ul.share-social-bx li.lin {
	background: #0176be ;
}
ul.share-social-bx li.lin i {
	background: #0082CA;
}
ul.share-social-bx li.pin {
	background:#ac0104;
}
ul.share-social-bx li.pin i {
	background: #BD0E15;
}

ul.share-social-bx li:hover {
	width: 90px;
}


@media only screen and (max-width:767px) {
	
ul.sharebtn-bx,
ul.share-social-bx {
	float:none;
}

ul.sharebtn-bx {
	margin-bottom:10px;
}

}

/* Business Hours table */
.sf-business-hours {
	text-align:center;
	text-transform:uppercase;
}
.sf-business-hours tr th{
	background:#EFEFEF;
	text-align:center;
}
.sf-business-hours .sf-to{
	display:block;
    font-weight:400;
    font-size:13px;
}
.sf-business-hours span{
	color:#999;
    font-size:14px;
	color:#767676;
	font-weight:600; 
}
.sf-business-hours tr td.sf-closed-day{
	vertical-align:middle;
	font-weight:600;
	color:#F87C80; 
}


/* Provider info table */

.provider-info-outer {
	overflow:hidden;
}
.provider-info-outer ul.provider-info { 
	margin-top:-1px !important;
}
ul.provider-info li { 
	padding:15px 10px 15px 10px; 
	margin-bottom:0;
	width:50%;
	border-top:1px solid #efeded;
	border-right:1px solid #efeded;
	width:50%;
	float:left;
	line-height:20px;
}
ul.provider-info li:nth-child(2n+0) {
	border-right:none;
}
ul.provider-info li span { 
	display:block;
	padding-left:25px;
}

ul.provider-info li i { 
	margin-right:10px; 
	color:<?php echo (!empty($data['color-scheme'])) ? esc_html($data['color-scheme']) : ''; ?>; 
	font-size:20px; 
	vertical-align:middle; 
}
ul.provider-info li strong { 
	font-weight:600; 
	font-size:14px;
	text-transform:uppercase;
}
ul.provider-info li strong:after { 
	content:"";
	display:block;
	clear:both;
	margin-bottom:5px;  
}

@media only screen and (max-width:767px) {
ul.provider-info li { 
	width:auto;
	float:none;
}
ul.provider-info li { 
	border-right:none;
}
}

/* provider-map */
.provider-map #gmap_canvas {
	width:100% !important;
}
.provider-map #map_canvas {
	width:100% !important;
}


/* provider-services */
.provider-services ul {
	margin: 0;
	list-style: none;
}
.provider-services ul li {
	margin: 0 0 15px;
	padding: 0 0 15px 25px;
	border-bottom: 1px solid #e1e1e1;
	position: relative;
}
.provider-services ul li i {
	position: absolute;
	left: 0;
	top: 2px;
	font-size: 16px;
	color: <?php echo (!empty($data['color-scheme'])) ? esc_html($data['color-scheme']) : ''; ?>;
}
.provider-services ul li .p-s-title {
	margin: 0 0 0 0px;
}

.provider-services ul li .p-s-title .cost{
	float:right;
	color:<?php echo (!empty($data['color-scheme'])) ? esc_html($data['color-scheme']) : ''; ?>;
}

.provider-services ul li .p-s-title .cost i{
	position:static;
}

.provider-services ul li .p-s-text {
	display: none;
	margin: 0;
	padding: 10px 0s;
}
.provider-services ul li:last-child {
	border-bottom: none;
	margin-bottom: 0;
	padding-bottom: 0;
}
.provider-services ul li:hover .p-s-text {
	display: block;
}

/* documents-download */
.sf-documents-table .panel {
	margin-bottom:0;
}

.sf-documents-table .panel-heading {
	padding-left:40px;
	position:relative;
	min-height:60px;
}

.sf-documents-table .price-bx{
	position:absolute;
	left:15px;
	top:10px;
}

@media only screen and (max-width:767px) {
.sf-documents-table td {
	padding:0;
	display:block;
}	
}


/* recent info table */
.recent-services-bx ul{ 
	list-style:none;
	margin:0;  
}

.recent-services-bx ul li{ 
	width:100%; 
	min-height:100px;
	clear:both;
	padding:0 0 20px;
	margin-bottom:20px; 
	border-bottom:1px solid #ededed;  
}

.recent-services-bx ul li:last-child{ 
	border-bottom:none; 
	margin:0;
	padding:0;
	min-height:80px; 
}

.recent-services-bx p{ 
	margin:0;
	line-height:18px;  
}


.recent-services-bx .post-thum-bx { 
	width:80px; 
	float:left;
	margin-right:15px; 
	border:1px solid #FFF;
}

.recent-services-bx .post-title { 
	margin:0 0 2px;  
}
.recent-services-bx .post-text-bx { 
	margin-left:90px;
}

ul.timeslots,
ul.protimelist {
	margin:20px 0;
}
ul.timeslots li,
ul.protimelist li {
	padding:10px 15px;
	margin:0 10px 10px 0;
	background:#F0F0F0;
	text-transform:uppercase;
	border-bottom:3px solid #e1e1e1;
    cursor:pointer;
}
ul.timeslots li.active,
ul.protimelist li.active {
 background:#dadada;
 border-bottom:2px solid #bfbfbf;
}

/* booking status indigate */
ul.indiget-booking{
	margin:0;
}
ul.indiget-booking li{
	display:inline-block;
    padding:0;
    margin-right:30px;
}
ul.indiget-booking li b {
	width:10px;
	height:10px;
	background:#CCC;
	display:inline-block;
	margin-right:10px
}

ul.indiget-booking li.allbooked b{
 background:#f6dfec ;
}
ul.indiget-booking li.unavailable b{
 background:#edbfbf ;
}




/* booking form */

.mincost { 
	color:<?php echo (!empty($data['color-scheme'])) ? esc_html($data['color-scheme']) : ''; ?>;
	float:right;
}
.mincost strong{ 
	color:<?php echo (!empty($data['seconday-color-scheme'])) ? esc_html($data['seconday-color-scheme']) : ''; ?>;
	font-weight:800;
}



.form-step-bx {
    position: relative;
}

.form-step-bx h6 {
    position: relative;
    margin-left: 15px;
    margin-right: 15px;
    border-bottom: 1px solid #E1E1E1;
    margin-bottom: 30px;
    padding-bottom: 15px;
}

.form-step-bx h6 strong {
    position: absolute;
    left: -30px;
    font-size: 18px;
    color: <?php echo (!empty($data['color-scheme'])) ? esc_html($data['color-scheme']) : ''; ?>;
    font-weight:800;
}

.form-step-bx .btn.edit {
    position: absolute;
    right: 0;
    top: -5px;
}

.form-step-bx label {
    margin-bottom: 10px;
}

.form-step-bx .form-group,
.profile-form-bx .form-group,
.modal-body .form-group,
.form-group {
    margin-bottom: 25px;
}

.staff-member { 
	text-align:center;
}
.staff-member h6{ 
	text-align:left;
}

.staff-member .sf-thum-bx{ 
	border:5px solid <?php echo (!empty($data['color-scheme'])) ? esc_html($data['color-scheme']) : ''; ?>;
	overflow:hidden;
	cursor:pointer;
    min-height:40px;
}

.staff-member .member-done{ 
	position:absolute;
	bottom:-30px;
	right:0;
	width:30px;
	height:30px;
	line-height:30px;
	font-size:14px;
	color:#FFF;
	background:<?php echo (!empty($data['color-scheme'])) ? esc_html($data['color-scheme']) : ''; ?>;
}

.staff-member .member-name{ 
	color:#FFF;
	border:none;
	padding:0;
	margin:0 0 0px;
	min-height:40px;
}

.staff-member .sf-title-bx{ 
	padding:5px 5px 5px;
	border:none;
	min-height:60px;
	line-height:16px;
}

.staff-member .rating-bx{ 
	font-size:10px;
}
.staff-member .rating-container .rating-stars{ 
	color:#FC0;
}
.staff-member .rating-container { 
	color:#fff;
	font-size:12px;
}

.staff-member .sf-element-bx:hover .overlay-black-light:after{ 
	opacity:0;
}
.staff-member .sf-element-bx:hover .member-done{ 
	bottom:0;
}

.staff-member .sf-element-bx.selected .member-done{ 
	width:100%;
	bottom:-10px;
}
.staff-member .sf-element-bx.selected .overlay-black-light:after{ 
	opacity:0;
}

/* payment card */
.pay-source {
	padding: 0 15px 25px;
}
.pay-source a {
	display: inline-block;
	margin-right: 10px;
}
.pay-source a img {
	max-width: 100%;
	height: 30px;
	border: 1px solid #E1E1E1;
}

/* Featured box */
#feature-req-bx .alert-bx {
	padding:10px 15px;
	margin:0 15px 15px;
}


/* Amount status */
.sf-adminfee-bx {
	list-style:none;
	width:100%;
	max-width:500px;
	padding:10px 20px;
	border:1px solid #ddd;
}
.sf-adminfee-bx li {
	padding:5px 0 !important;
	border-top:1px solid #ddd;
	font-weight:600;
	font-size:14px;
}
.sf-adminfee-bx li strong{
	float:right;
	color:#555555;
}
.sf-adminfee-bx li:first-child {
	border:none;
}
.sf-adminfee-bx li:last-child {
	border-width:2px;
}


/*== > Provider Details demo2 ==*/

/*about-info*/
.about-info .sf-about-box {
	padding:20px;
}
.about-info .sf-title {
	margin:0 0 20px;
}

.about-info .tagline {
	margin:0 0 10px;
	display:block;
}

.about-info .sf-provider-des{
	padding:15px;
	background:#FFF;
	text-align:center;
	margin:0 15px 15px 0;
    position:relative;
}
.about-info .rating-bx{
	position:absolute;
	left:0;
	bottom:20px;
	width:100%;
	padding:0 10px;
	z-index:1;
}
.about-info .rating-container .rating-stars{ 
	color:#FC0;
}
.about-info .rating-container { 
	color:#fff;
}
.about-info .sf-provider-name{
	display:block;
	font-size:16px;
	padding-top:15px;
	font-weight:600;
    color:#333;
}

.about-info .social-bx {
	margin:15px 0 10px;
	float:none;
}
.about-info .social-bx li {
	padding:0;
	margin:0 2px;
}
.about-info .social-bx li a{
	border:1px solid #CCC;
	padding:7px;
	width:30px;
	height:30px;
	color:#999;
}
.about-info .shared-bx{
	min-height:34px;
	position:relative;
	margin-bottom:15px;
}
.about-info .shared-bx .sharebtn-bx li{
	background:#FFF;
}

@media only screen and (max-width:767px) {
.about-info .col-xs-4 {
	width:300px;
}
}
@media only screen and (max-width:640px) {
.about-info .col-xs-4 {
	width:100%;
	float:none;
}
}

/*gallery-thums*/
.gallery-row {
	background: url(inc/images/background/bg4.jpg) center fixed no-repeat;
	background-size: cover;
}
.gallery-row .gallery-thums2 .item {
	padding: 0 15px;
    
}
.gallery-row .gallery-thums2 .item .sf-thum-bx {
	border: 5px solid #FFF;
    background:#FFF;
}

/*address-info*/
.address-info .sf-element-bx {
	margin-bottom: 40px;
}
.address-info .icon-bx-md {
	border:2px solid <?php echo (!empty($data['color-scheme'])) ? esc_html($data['color-scheme']) : ''; ?>;
	line-height: 94px;
	margin-bottom: 20px;
}
.address-info h6 {
	margin-bottom: 5px;
}
.address-info p {
	margin-bottom:0;
}
.address-info .info-3-col-clear, .address-info .info-2-col-clear {
	clear: both;
}

 @media only screen and (max-width:991px) {
	.address-info .info-3-col-clear {
	display: none;
}
.address-info .info-2-col-clear {
	display: block !important;
}
}

/*lacation-point*/
.map-location #gmap_canvas {
	width: 100% !important;
}
 @media only screen and (max-width:768px) {
.map-location .gmap-outer, 
.map-location #gmap_canvas {
	height: 300px !important;
}
}


/*video-demo*/
.video-row .embed-responsive {
	box-shadow:0 0 10px #eaeaea;
	-webkit-box-shadow:0 0 10px #eaeaea;
}
.video-row .embed-responsive iframe {
	border:15px solid #FFF;
}


/*services-row*/
.services-row table tr td {
    width: 50%;
}
.services-row table tr td:first-child {
    padding-right: 15px;
}
.services-row table tr td:last-child {
    padding-left: 15px;
}
.services-row table tr td:first-child:last-child {
    padding: 0 15px 0 0;
}
.services-row table tr td {
    border: none;
    padding: 0 0;
}
.services-row .panel-heading {
    background: #FFF;
    display: table;
    color: #555555;
}
.services-row .panel-heading .price-bx {
    display: table-cell;
    border-right: 1px solid #CCC;
    padding: 10px 12px;
    font-size: 18px;
    font-weight: 800;
}
.services-row .panel-heading .service-title {
    display: table-cell;
    padding: 15px;
    width: 100%;
    vertical-align: top;
}

.sf-services-list {
	list-style:none;
	margin:0 !important;
}
.sf-services-list li {
	padding:0 15px !important;
}
.sf-services-list li .panel-heading {
	padding:0;
	position:relative;
	cursor:pointer;
}

.sf-services-list li:nth-child(2n+1) {
	clear:both;
	content:"";
	display:table;
}
.sf-services-list .panel-heading[aria-expanded]:before { 
	content:"\f067";
	font-family:"FontAwesome";
	position:absolute;
	top:15px;
	right:15px;
	font-size:14px;
}
.sf-services-list .panel-heading[aria-expanded=true]:before { 
	content:"\f068";
}

@media only screen and (max-width:767px) {
.sf-services-list li:nth-child(2n+1) {
 display:block;
 clear:none;
}
}


/*booking-row*/
.book-now-row .mincost {
	text-transform:uppercase;
	font-weight:800;
	font-size:22px;
	display:block;
	float:none;
	margin-bottom:20px;
}
.book-now-row .mincost {
	text-transform:uppercase;
	font-weight:800;
	font-size:22;
	color:<?php echo (!empty($data['color-scheme'])) ? esc_html($data['color-scheme']) : ''; ?>;
}
.book-now-row .mincost strong{
	color:<?php echo (!empty($data['seconday-color-scheme'])) ? esc_html($data['seconday-color-scheme']) : ''; ?>;
	font-weight:800;
}

.book-now-row .booking-desc-bx{
	padding:0 15%;
	line-height:24px;
}

.form-wizard {
	background: #FFF;
}
.form-nav .nav {
	margin: 0 0 20px;
}
.form-nav .nav li {
	padding: 0;
	border-right: 2px solid #fff;
}
.form-nav .nav li:last-child {
	border-right: none;
}
.form-nav .nav li a {
	padding: 30px 10px;
	background: #f0f0f0;
	font-size: 16px;
	font-weight: 600;
	color: #555555;
}
.form-nav .nav li a:hover {
	background: #f0f0f0;
}
.form-nav .nav li.active a:hover, 
.form-nav .nav li.active a:focus, 
.form-nav .nav li.active a:active, 
.form-nav .nav li.active a {
	background: #FFFFFF;
	color: #555555;
}
.form-wizard .progress {
	height: 10px;
	margin: 0 20px 20px;
}
.form-wizard .progress .progress-bar {
	font-size: 0;
	background:<?php echo (!empty($data['color-scheme'])) ? esc_html($data['color-scheme']) : ''; ?>;
}
.form-wizard .tab-pane {
	border-top: 1px solid #e1e1e1;
	border-bottom: 1px solid #e1e1e1;
}
.form-wizard .wizard-actions {
	list-style: none;
	margin: 0;
	padding: 40px;
}
.form-wizard .wizard-actions li {
	padding:0;
	display:inline;
}
.form-wizard .wizard-actions .previous {
	display:inline-block;
}

.otp-section .otp {
	color:#3396D1;
	font-size:12px;
	font-style:italic;
}

.form-wizard .sf-zipcode-area .fa-refresh{
	width:36px;
	height:36px;
	line-height:36px;
	text-align:center;	
}


/*quotes-row*/
.quotes-row{
	background:url(inc/images/background/bg3.jpg) center fixed no-repeat; 
	background-size:cover;
	font-size:18px;
}
@media only screen and (max-width: 480px) {
.quotes-row .padding-lr-50{
	padding:0;
}
}

/*---------------------------------------------------------------
30. AFTER-LOGIN-CONTENT
---------------------------------------------------------------*/

/*left-menu*/
.profile-menu ul { 
	margin:0; 
	list-style:none; 
	background:#FFF;
}

.profile-menu ul li { 
	padding:10px 40px 10px 50px;
	border-bottom:1px solid #e8e9e9;
	position:relative;
	min-height:50px;
	line-height:30px;
	font-weight:600;
	font-size:14px;
}

.profile-menu ul li a{ 
	color:#555555;
	text-transform:uppercase;
	display:block;
}

.profile-menu ul li:hover,
.profile-menu ul li.active { 
	color:#FFFFFF;
	background:<?php echo (!empty($data['color-scheme'])) ? esc_html($data['color-scheme']) : ''; ?>;
}

.profile-menu ul li:hover a,
.profile-menu ul li.active a{ 
	color:#FFFFFF;
}

.profile-menu ul li:hover span,
.profile-menu ul li.active span{ 
	color:<?php echo (!empty($data['color-scheme'])) ? esc_html($data['color-scheme']) : ''; ?>;
	background:#FFF;
}



.profile-menu ul li i { 
	width:30px;
	height:30px;
	border-right:1px solid #e8e9e9;
	text-align:center;
	line-height:30px;
	margin-right:10px;
	position:absolute;
	top:10px;
	left:10px;
	font-size:15px;
}

.profile-menu ul li span{ 
	height:22px;
	min-width:22px;
	line-height:22px;
	font-size:10px;
	text-align:center;
	position:absolute;
	right:10px;
	top:15px;
	background:<?php echo (!empty($data['color-scheme'])) ? esc_html($data['color-scheme']) : ''; ?>;
	color:#FFFFFF;
	border-radius:100%;
	-webkit-border-radius:100%;
}


/*features nav*/
.features-nav ul { 
	margin:0; 
	list-style:none; 
	background:#FFF;
	text-transform:uppercase;
}

.features-nav ul li { 
	position:relative;
	font-weight:600;
	font-size:14px;
	padding:0;
}

.features-nav ul li a{ 
	border-bottom:1px solid #e8e9e9;
	padding:10px 10px 10px 40px;
	min-height:50px;
	line-height:30px;
	color:#555555;
	display:block;
}

.features-nav ul li a:hover,
.features-nav ul li a.active { 
	color:#FFFFFF;
	background:#3396d1;
}

.features-nav ul ul li a:hover { 
	padding-left:45px;
}

.features-nav ul ul li a:hover:before,
.features-nav ul ul li a.active:before { 
	color:#FFFFFF;
}

.features-nav ul li.current_page_item a{ 
	color:#FFFFFF;
	background:#3396d1;
}
.features-nav ul li.current_page_item a:before{ 
	color:#FFFFFF;
}


.features-nav ul li i { 
	width:30px;
	height:30px;
	text-align:center;
	line-height:30px;
	position:absolute;
	top:10px;
	left:10px;
	font-size:15px;
}

.features-nav ul li span{ 
	height:22px;
	min-width:22px;
	line-height:22px;
	font-size:10px;
	text-align:center;
	position:absolute;
	right:10px;
	top:15px;
	background:#3396d1;
	color:#FFFFFF;
	border-radius:100%;
	-webkit-border-radius:100%;
}

.features-nav ul ul{ 
	text-transform:none;
}
.features-nav ul ul li { 
	font-weight:400;
	font-size:14px;
}
.features-nav ul ul li a { 
	border-bottom-color:#F2F2F2;
	color:#999999;
	padding:6px 10px 6px 40px;
	line-height:20px;
	min-height:0;
}

.features-nav ul ul li a:before{
    color: #999999;
    content: "\f0da";
    font-family: FontAwesome;
    font-size: 14px;
    left:20px;
    margin-top: -9px;
    position: absolute;
    top: 50%;
}


/*right-box*/
.profile-form-bx { 
    padding:30px; 
    background:#FFF;
}
.profile-form-bx .btn{ 
    margin:0 2px 2px 0;
}
.profile-form-bx .form-inr { 
	padding:30px; 
	border:1px solid #e1e1e1;
	margin-bottom:30px;
}

.profile-form-bx .sf-table-outer{
	margin:0 -15px;
}
.profile-form-bx .row{
	margin:0;
}

@media only screen and (max-width: 767px) {
.profile-form-bx .sf-table-outer{
	margin:0 ;
}
	
.profile-form-bx,
.profile-form-bx .form-inr,
.panel-body.padding-30,
.tabbable .tab-pane { 
	padding:15px; 
}

.profile-form-bx .dataTables_length { 
	text-align:left;
}

.profile-form-bx .dataTables_filter { 
	text-align:left;
}

}

.profile-form-bx .form-inline .radio label,
.profile-form-bx .form-inline .checkbox label{ 
	text-transform:none;
}


.profiles-content{
	
}
.profiles-content h3,
.profiles-content h4,
.profiles-content h5,
.profiles-content h6 { 
	text-transform:uppercase;
	margin-top:0;
}

.profiles-content label {
    text-transform: uppercase;
}
.profiles-content .panel-group {
    margin-bottom: 30px;
}
.auther-bx {
    padding: 30px 20px 20px;
    margin-top: 5px;
    text-align: center;
    background: url(inc/images/autherbg.jpg) no-repeat center top;
    background-size: cover;
}
.auther-bx .auther-pic {
    width: 90px;
    height: 90px;
    margin: 0 auto 15px;
}
.auther-bx .auther-pic img {
    border-radius: 100%;
    -webkit-border-radius: 100%;
    width: 100%;
    height: auto;
    border: 3px solid #FFF;
}
.auther-bx h6{
    font-size:12px;
}
.auther-bx h6,
.auther-bx p {
    color: #FFF;
    text-transform: uppercase;
    margin: 0;
}
.form-bx {
    background: #FFF;
}

/*avtar pic set*/

.auther-pic-text .profile-pic-bx {
    float: left;
    width: 180px;
    position: relative;
}

.auther-pic-text .profile-pic-bx div.RWMB-drag-drop {
    height: auto;
}

.auther-pic-text .profile-pic-bx .drag-drop-inside p{
   display:none;
}

.auther-pic-text .profile-pic-bx .drag-drop-inside p.drag-drop-buttons{
   display:block;
}

.auther-pic-text .profile-pic-bx .rwmb-images li{
    min-height:180px;
}

.auther-pic-text .profile-text-bx {
    margin-left: 200px;
}

.auther-pic-text .profile-text-bx p {
    color: #888888;
    font-size: 14px;
    line-height: 24px;
    padding-top: 15px;
    margin-bottom: 15px;
}

@media only screen and (max-width: 767px) {

.auther-pic-text .profile-text-bx p {
    padding-top:0;
}

}

@media only screen and (max-width:480px) {
	
.auther-pic-text .profile-pic-bx {
    float: none;
    width: auto;
    margin-bottom:30px;
}
.auther-pic-text .profile-text-bx {
    margin-left: 0;
}

} 

.auther-pic-text .profile-text-bx ul {
    margin: 0;
    text-transform: uppercase;
}
.auther-pic-text .profile-text-bx ul li {
    padding: 4px 0;
}
.auther-pic-text .profile-text-bx ul li strong {
    display: inline-block;
    color: #555555;
    width: 130px;
}

.profile-pic-bx .rwmb-input .drag-drop-inside {
	padding:0;
}

.profile-pic-bx .rwmb-input .drag-drop-inside img {
	position:static;
	left:0;
	top:0;
	width:100%;
	height:auto;
}

.profile-pic-bx  p.drag-drop-buttons {
	position:absolute;
	left:0;
	bottom:0;
	margin:0;
	width:100%;
}
.profile-pic-bx  p.drag-drop-buttons .btn {
	width:100%;
}
.profile-pic-bx  ul.rwmb-images li {
	width:auto;
	float:none;
	margin:0;
}
.profile-pic-bx  ul.rwmb-images li .rwmb-image-bar{
	padding:5px 6px;
}


/*Profile panel box*/
.pro-setting .panel-heading { 
	padding:12px 25px;
	border-bottom:1px solid #e1e1e1;
}
.pro-setting .panel-heading .panel-tittle{ 
	margin:0;
}

/*attachments*/
.form-control[readonly] {
	background:#FFF;
}



/*address map*/
.pro-setting .rwmb-map-wrapper{
	padding:0 15px; 
}

/*availability*/
.form-availability .time-zone,
.form-availability .selected-time {
	list-style:none;
	margin:0 0 15px;
}
.form-availability .time-zone li{
	width:16.777%;
	border:1px solid #CCC;
	display:block;
	float:left;
	margin:0 -1px -1px 0;
	padding:10px 10px;
    cursor:pointer;
}

@media only screen and (max-width:460px) {
	
.form-availability .time-zone li{
	width:25%;
}

}

.form-availability .time-zone li.selected{
	background:#CCCCCC;
	color:#FFFFFF;
}

.form-availability .selected-time li {
	padding:0;
	margin-bottom:10px;
}

/*schedule*/
.scheduledata-bx {
	border-bottom: 1px solid #ddd;
    margin-bottom: 30px;
    padding-bottom: 20px;
}	

.scheduledata-bx .tabbable {
	margin-bottom:20px;
}	
.scheduledata-bx #membertab li {
	margin:0 10px 10px 0px;
}	

.scheduledata-bx .month-title {
	float:left;
}

.scheduledata-bx .month-title  {
	float:left;
	margin:10px 0 10px;
}

.scheduledata-bx .staffmembers-bx {
	float:right;
}

.scheduledata-bx .staffmembers-bx .btn-group{
	margin-left:10px;
}

.scheduledata-bx .multiselect  {
	background:#FFF;
	border:1px solid #e1e1e1;
}
.scheduledata-bx .btn:focus,
.scheduledata-bx .btn:active,
.scheduledata-bx .btn:hover,
.scheduledata-bx .btn-default.active, .btn-default:active, 
.scheduledata-bx .open > .dropdown-toggle.btn-default  {
	background:#FFF;
	border:1px solid #e1e1e1;
}

.scheduledata-bx .btn-group .dropdown-menu{ 
	margin:0;
	
}
.scheduledata-bx .btn-group .dropdown-menu li{
	padding:0;
}
.scheduledata-bx .btn-group .dropdown-menu li a{
	padding:8px 10px;
}

.scheduledata-bx .btn-group .dropdown-menu li .checkbox{
	margin:0;
}

#schedule .pull-right.form-inline{
	float:none !important;
}

.member-thumb {
	border:1px solid #CCC;
	background:#fff;
	padding:5px;
	float:left;
	text-align:center;
}

.member-thumb img {
	display:block;
	margin-bottom:5px;
}

@media only screen and (max-width:680px) {

	
#schedule .pull-right.form-inline .btn-group{
	display:block;
	clear:both;
} 

#schedule .pull-right.form-inline .btn-group:first-child .btn {
	display:table-cell;
	width:33.333%;
}
#schedule .pull-right.form-inline .btn-group:last-child .btn {
	display:table-cell;
	width:25%; 
}

} 

/*invoice*/
.add-invoice .col-xs-offset-1,
.invoiceservices-bx .col-xs-offset-1,
.add-booking-invoice .col-xs-offset-1  {
	margin-left:0;
}
.add-invoice .has-feedback input.form-control { 
	padding:9px 12px;
}

.add-invoice .text-nowrap .num-hours,
.invoiceservices-bx .text-nowrap .num-hours { 
	width:65px !important;
	display:inline-block ;
}

.invoiceservices-bx  .has-feedback .form-control {
	padding-right:12px;
}

.invoiceservices-bx  .has-feedback .bootstrap-select.form-control {
	padding-right:0;
}



/*add invoice popup*/
.servicearea-group {
	margin-left:-15px;
	margin-right:-15px;
}

.invoiceservices-bx {
	position:relative;
    padding-bottom:30px
}

.sf-invoice-addbtn {
	position:absolute;
	bottom:0;
	right:-22px;
} 


/*Invoice Manager status*/
.invoice-view .invoice-status{
	padding:10px 0;
	display:block;
	border-top:1px solid #CCC;
	border-bottom:1px solid #CCC;
	font-size:24px;
	color:#3396d1;
	margin-bottom:30px;
    text-transform:uppercase;
}

#booking-details .member-thumb {
	display:inline-block;
	text-align:center;
	text-transform:uppercase;
	font-size:11px;
	color:#333;
}
#booking-details .member-thumb img{
	display:block;
	border:1px solid #FFF;
}

.profile-form-bx #feature-req-bx .sf-card-group {
	margin:15px 0;
	position:relative;	
}
.profile-form-bx #feature-req-bx .sf-card-group .radio{
	position:relative;
	display:inline-block;
	margin-right:15px;	
}
.profile-form-bx #feature-req-bx .sf-card-group .btn.btn-block{
	margin:15px -15px 0;	
}
.profile-form-bx #feature-req-bx #featurecardinfo{
	margin:0 -15px;	
}


/*send reminder mail popup*/
.send-reminder-form .control-label{
	margin-bottom:10px;
}
.send-reminder-form .control-label{
	margin-bottom:10px;
}
.send-reminder-form .reminder-text-area{
	margin-bottom:20px;
}
/*calender css*/
.zabuto_calendar,
.zabuto_calendar th,
.zabuto_calendar td,
.zabuto_calendar .calendar-month-navigation{
	text-align:center;
	cursor:pointer;
}

.zabuto_calendar .allbooked{
	background:#f3e7f3 !important;
	cursor:not-allowed !important;
	color:#b699b6;
	font-weight:600;
}

.zabuto_calendar .unavailable{
	background:#fbdede !important;
	cursor:not-allowed !important;
	color:#c79797;
	font-weight:600;
}

.zabuto_calendar .selected {
	background:#bce1f7 !important;
	color:#6999b5;
	font-weight:600;
}

.zabuto_calendar .badge-today {
    background-color: #f1f1f1 !important;
    color:#757575 !important;
	font-weight:600;
}
.zabuto_calendar .badge {
    border-radius: 0;
    display: table-cell;
    min-width: auto;
}
div.zabuto_calendar .table tr.calendar-dow-header th {
    background-color: #f0f0f0;
    padding: 14px 0;
}
div.zabuto_calendar .table tr.calendar-month-header th {
    background-color: #fff;
}


@media only screen and (max-width:991px) {
.servicearea-group .form-group.has-feedback:after{
	content:"";
	border-bottom:2px solid #e1e1e1;
	display:block;
	margin:0 15px;
}
.servicearea-group .col-xs-3{
	width:33.333%;
	margin-bottom:15px;
}
.servicearea-group .col-xs-2{
	width:33.333%;
	margin-bottom:15px;
}
.servicearea-group .col-xs-2{
	width:33.333%;
	margin-bottom:15px;
	clear:both;
}
.servicearea-group .col-xs-1{
	width:65%;
	margin-bottom:15px;
}
}

@media only screen and (max-width:767px) {

.servicearea-group .col-xs-3{
	width:50%;
}
.servicearea-group .col-xs-2{
	width:50%;
}
.servicearea-group .col-xs-2{
	width:50%;
	clear:none;
}
.servicearea-group .col-xs-1{
	width:100%;
	clear:both;
}
.servicearea-group .col-xs-3 .form-group.form-inline{
	margin-bottom:15px;
}
.servicearea-group .col-xs-3 .radio{
	display:inline-block;
}

}

@media only screen and (max-width:420px) {

.servicearea-group .col-xs-3{
	width:100%;
}
.servicearea-group .col-xs-2{
	width:100%;
}
.servicearea-group .col-xs-2{
	width:100%;
	clear:none;
}
.servicearea-group .col-xs-1{
	width:100%;
	clear:both;
}
}


/*Category*/
.category-drop .text {
	font-weight:600;
} 

.category-drop .childcat {
	padding-left:10px;
} 

/*gallery & document attachment */

div.RWMB-drag-drop { 
	border:2px dashed #ddd !important;
}

.gallery-images .rwmb-input .rwmb-drag-drop,
.attachment-files .rwmb-input .rwmb-drag-drop,
.profile-pic-bx  .rwmb-input .rwmb-drag-drop{
	border-width:2px;
}

.gallery-images .rwmb-input .drag-drop-inside,
.attachment-files .rwmb-input .drag-drop-inside,
.profile-pic-bx .rwmb-input .drag-drop-inside {
	padding:30px;
}

.gallery-images .rwmb-input .drag-drop-inside p,
.attachment-files .rwmb-input .drag-drop-inside p,
.profile-pic-bx  .rwmb-input .drag-drop-inside p{
	margin:0 0 5px;
	font-size:20px;
	text-transform:uppercase;
}
.gallery-images .rwmb-input p.drag-drop-buttons,
.attachment-files .rwmb-input p.drag-drop-buttons,
.profile-pic-bx .rwmb-input p.drag-drop-buttons{ 
	margin:10px 0 0 ;
}
.gallery-images ul.rwmb-images,
.attachment-files ul.rwmb-images{
	list-style:none;
	margin:0 -15px;
}
.gallery-images ul.rwmb-images li {
	margin:0 0 30px;
	padding:0 15px;
	width:25%;
	height:auto;
    min-height:100px;
}

@media only screen and (max-width:480px) {

.gallery-images ul.rwmb-images li {
	width:33.333%;
}

}

.attachment-files ul.rwmb-images li {
	margin:0 0 30px;
	padding:0 15px;
	width:25%;
	height:auto;
	min-height:60px;
}

@media only screen and (max-width:480px) {

.attachment-files ul.rwmb-images li {
	width:33.333%;
	min-height:50px;
}

}

.gallery-images .rwmb-image-bar,
.attachment-files .rwmb-image-bar {
	padding:3px 5px;
	right:15px;
}
.gallery-images ul.rwmb-images li img,
.attachment-files ul.rwmb-images li img{
	width:100%;
	height:auto;
}

.profile-pic-bx ul.rwmb-images,
.profile-pic-bx ul.rwmb-images li{
	margin:0;
	padding:0;
	list-style:none;
}
.profile-pic-bx ul.rwmb-images li img{
	width:100%;
	height:auto;
}

.rwmb-image-bar a.rwmb-delete-file {
	color:#FFF;
}

.rwmb-image-bar a.rwmb-delete-file:hover {
	color:#FFF;
}

/*calender-css*/
.cal-context #cal-slide-content{
	background-image:none;
	background-color:#f1f1f1;
	box-shadow:none;
	-webkit-box-shadow:none;
}
.cal-context #cal-slide-content:hover{
	background-color:#f1f1f1;
}
.cal-context #cal-slide-content ul{
	margin:0;
}
.cal-context #cal-slide-content ul li{
	padding:0;
	margin-bottom:10px;
    border-bottom: 1px dashed #ccc;
}
.cal-context .cal-event-list .event.pull-left{
	 margin-top: 6px;
}
.cal-context .event-info{
	background-color:<?php echo (!empty($data['color-scheme'])) ? esc_html($data['color-scheme']) : ''; ?>;
}
.cal-context #cal-slide-content a.event-item {
	display:inline-block;
	color:#777777;
}
.cal-context #cal-slide-content a.event-item strong {
	text-transform:uppercase;
}
.cal-context #cal-slide-content a.event-item p {
	margin:0;
}

.event-info.sf-pending {
	background-color:#FF8040;
}
.event-info.sf-complete {
	background-color:#10C21E;
}
.event-info.sf-cancel {
	background-color:#F80C12;
}


/*Embeded Code*/
.rwmb-input.ui-sortable{
	position:relative;
}
.rwmb-input.ui-sortable .show-embed {
	position:absolute;
	top:0;
	right:0;
}
.rwmb-input.ui-sortable .form-control{
	margin-bottom:30px;
	padding-right:95px;
}

/*pop content */
.edit-member .profile-pic-bx,
.add-new-member .profile-pic-bx {
	max-width:200px;
	margin:0 auto 30px;
}
.edit-member .profile-pic-bx img,
.add-new-member  .profile-pic-bx img{
	width:100%;
	height:auto;
}

/*Payment Card*/
.sf-card-group {
	margin:20px -15px !important;
	padding:0 5px 0 0;
}

.sf-card-group img,
.sf-card-my-account img {
	margin-top:-3px;
	margin-right:5px;
	width:40px;
	height:auto;
}
.sf-card-group.margin-less {
	margin:20px 0;
	padding:0 15px;
}


/* Customer login */
.current-booking{border:1px solid #e1e1e1; padding:30px; position:relative;}
.current-booking .provider-pic{float:left; margin-right:30px; width:200px;}
.current-booking .meta-d-t span{display:block; font-size:15px; margin-bottom:10px;}
.current-booking .btn{position:absolute; right:30px; top:50px; }


/* Bookings list  */
table.booking-listing tr th{ display:none;}
table.booking-listing tr td{ padding:15px 10px;}
table.booking-listing .provider-pic img{ width:70px; height:auto; }
table.booking-listing .booking-date-time span{ display:block; margin-bottom:10px;}
table.booking-listing .booking-date-time span i{ margin-right:5px; color:#555555;}
table.booking-listing .bootstrap-select { width:auto !important;}

/*=== Contact us page ==== */

.banner-contact-row {
	height:300px;
    background-size:cover;
	background-position:center;
}
.banner-contact-row *{
	color:#FFF;
}
.banner-contact-row .container {
	display:table;
    height:100%;
}
.banner-contact-row h1 {
	display:table-cell;
	vertical-align:middle;
}

ul.contact-info { 
	min-height:293px;
}

ul.contact-info li { 
	padding:0 0 15px 25px; 
	margin-bottom:15px;
	border-bottom:1px solid #e1e1e1;
	position:relative; 
	line-height:20px;
}

ul.contact-info li:last-child { 
	padding-bottom:0; 
	margin-bottom:0;
	border-bottom:none;
}

ul.contact-info li h4
ul.contact-info li h5,
ul.contact-info li h6 { 
	margin:0 0 10px;
}
ul.contact-info li p { 
	line-height:20px; 
	margin:0;
}
ul.contact-info li .fa { 
	position:absolute; 
	left:0; 
	top:2px; 
	color:<?php echo (!empty($data['color-scheme'])) ? esc_html($data['color-scheme']) : ''; ?>; 
	font-size:16px;
}

/*page not found*/
.page-notfound {
	padding:50px 0;
}
.page-notfound strong {
	font-size:200px;
	font-weight:900;
	line-height:140px;
	display:block;
}
.page-notfound strong i {
	font-size:190px;
	margin:0 10px;
}
.page-notfound .searchform { 
    position:relative;
	text-align:left;
	max-width:420px;
	margin:30px auto;
}


.sticky{
	clear:both;
}

.gallery-caption{
	clear:both;	
}

.bypostauthor{
	clear:both;
}

.page-notfound span {
	font-size:48px;
	display:block;
	color:#333;
	font-weight:600;
	text-transform:uppercase;
	margin-bottom:30px;
}


/*--------------------------------------------------------------- 
31. themeforest required classes
---------------------------------------------------------------*/
/* Text meant only for screen readers. */

.screen-reader-text {
 clip: rect(1px, 1px, 1px, 1px);
 position: absolute !important;
 height: 1px;
 width: 1px;
 overflow: hidden;
}

.screen-reader-text:focus {
 background-color: #f1f1f1;
 border-radius: 3px;
 box-shadow: 0 0 2px 2px rgba(0, 0, 0, 0.6);
 clip: auto !important;
 color: #21759b;
 display: block;
 font-size: 14px;
 font-size: 0.875rem;
 font-weight: bold;
 height: auto;
 left: 5px;
 line-height: normal;
 padding: 15px 23px 14px;
 text-decoration: none;
 top: 5px;
 width: auto;
 z-index: 100000; / Above WP toolbar. /
}

/*---------------------------------------------------------------
32. Autocomplete script UI
---------------------------------------------------------------*/
.ui-autocomplete {
    position: absolute;
    top: 100%;
    left: 0;
    z-index: 1000;
    float: left;
    display: none;
    min-width: 160px;   
    padding: 4px 0;
    margin: 0 0 10px 25px;
    list-style: none;
    background-color: #ffffff;
    border-color: #ccc;
    border-color: rgba(0, 0, 0, 0.2);
    border-style: solid;
    border-width: 1px;
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    border-radius: 5px;
    -webkit-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
    -moz-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
    box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
    -webkit-background-clip: padding-box;
    -moz-background-clip: padding;
    background-clip: padding-box;
    *border-right-width: 2px;
    *border-bottom-width: 2px;
}

.ui-menu-item > a.ui-corner-all {
    display: block;
    padding: 3px 15px;
    clear: both;
    font-weight: normal;
    line-height: 18px;
    color: #555555;
    white-space: nowrap;
    text-decoration: none;
}

.ui-state-hover, .ui-state-active {
    color: #ffffff;
    text-decoration: none;
    background-color: #0088cc;
    border-radius: 0px;
    -webkit-border-radius: 0px;
    -moz-border-radius: 0px;
    background-image: none;
}

.ui-helper-hidden-accessible{ display:none;}

.contact-area-bx{
	overflow:hidden;
    height:350px;
    width:100%;
}

.default-hidden{
	display:none;
}

.update-nag{
	display:block;
    clear:both;
}

.datepicker{z-index:1200 !important;}



/*== Clear Floating afetr & beftore classes ==*/
ul.job_listings li.job_listing:after,
ul.job_listings li.job_listing:before,
.job_filters .showing_jobs:after,
.job_filters .showing_jobs:before,
.sf-cati-all:after,
.sf-cati-all:before {
  content: ".";
  display: block;
  clear: both;
  visibility: hidden;
  line-height: 0;
  height: 0;
}


/*job css*/

.job_filters .search_jobs {
    padding:30px;
	background-color:<?php echo (!empty($data['color-scheme'])) ? esc_html($data['color-scheme']) : ''; ?>;
}

.job_filters .search_jobs div.search_keywords,
.job_filters .search_jobs div.search_location,
.job_filters .search_jobs div.search_provider_categories,
.job_filters .search_jobs div.search_categories {
    float: left;
    padding:0 15px;
    width: 33.333%;
	clear:none;
}

.job_filters .search_jobs input {
	width:100%;
	border: 1px solid #fff;
	font-size: 13px;
	height: 40px;
	line-height: 20px;
	padding: 9px 12px;
}
.job_filters .dropdown-toggle {
	border: 1px solid #fff !important;
}
.job_filters .job_types {
    background: #fff;
    border-top: none;
	border-right: 1px solid #ddd;
	border-left: 1px solid #ddd;
    font-size:14px;
	padding-left:13px;
}

.job_filters .job_types li {
    border-right: 1px solid #ddd;
    padding: 16px;
	float: left;
	font-size:14px;
	line-height:18px;
}

.job_filters .job_types li [type="checkbox"]{
    position:absolute;
}


@media only screen and (max-width:991px) {

.job_filters .search_jobs {
    padding:30px 15px;
}
.job_filters .search_jobs div.search_keywords, 
.job_filters .search_jobs div.search_location, 
.job_filters .search_jobs div.search_provider_categories, 
.job_filters .search_jobs div.search_categories {
    float: none;
    margin:0 0 15px;
    padding: 0;
	width:auto;
}
	
.job_filters .job_types {
	padding:30px 30px 20px;
}
.job_filters .job_types li {
	border: 1px solid #ddd;
	display: inline-block;
	float: none;
	margin-right:5px;
	margin-bottom:10px;
	padding: 10px 16px;
}
.job_filters .job_types li:last-child {
    border-right:inherit;
}
}

.job_filters .job_types li .checkbox{
    margin:0;
	line-height:20px;
}

.job_filters .job_types li label {
    margin:0;
}
.job_filters .showing_jobs {
    background: #fff;
	border-top: 1px solid #ddd;
	border-right: 1px solid #ddd;
	border-left: 1px solid #ddd;
    font-size:14px;
	padding: 15px 30px;
}

.showing_jobs > span {
    display: block;
    float: left;
    width: 70%;
}

.job_filters .showing_jobs a.rss_link:before,
.job_filters .showing_jobs a.reset:before {
	content:"\f09e";
	font-family: 'FontAwesome';
	color:#fff;
	margin-right:5px;
	font-size:13px;
	font-weight:normal;
}
.job_filters .showing_jobs a.rss_link {
	color:#fff;
	display:block;
	background-color:#f08d3c;
	font-weight:600;
	padding:2px 10px;
}
.job_filters .showing_jobs a.rss_link:before {
	content:"\f09e";
}

.job_filters .showing_jobs a.reset {
	color:#fff;
	display:block;
	background-color:#707070;
	font-weight:600;
	padding:2px 10px;
	margin-left:10px;
}
.job_filters .showing_jobs a.reset:before {
	content:"\f01e";
}

ul.job_listings {
    border-top: 1px solid #ddd;
}

ul.job_listings li.job_listing {
	background: #fff;
	border-right: 1px solid #ddd;
	border-left: 1px solid #ddd;
	border-bottom: 1px solid #ddd;
	font-size:14px;
	padding: 15px 30px;
	position:relative;
}

ul.job_listings li.job_listing a.job-clickable-box {
	padding:0;
	position:absolute;
	left:0;
	top:0;
	width:100%;
	height:100%;
	background:none;
}

ul.job_listings .job_listing .job-comapny-logo{
    width:120px;
	float:left;
}

ul.job_listings .job_listing .job-comapny-logo img{

}
.job_listing .location {
	position:relative;
}
.job_listing .location:before {
	content:"\f041";
	font-family: 'FontAwesome';
	position:absolute;
	left:7px;
	top:0;
	font-size:22px;
    color:#767676; 
}

.job-comapny-info {
	padding-top:15px;
	padding-left:120px;
}
.job-comapny-info .position,
.job-comapny-info .location,
.job-comapny-info .meta {
	vertical-align:top;
	padding-left:30px;
	display:inline-block;
}

.job-comapny-info .position {
	width:47%;
} 
.job-comapny-info .position h3{
	margin-bottom:5px;
	text-transform:none;
} 
.job-comapny-info .position .company strong{
	font-weight:normal;
} 
.job-comapny-info .location {
	width:27.999%;
	font-size:16px;
} 
.job-comapny-info .meta {
	width:24%;
	list-style:none;
	margin-left:0;
}
 
.job_listing .meta li{
    text-align:center;
	line-height:22px;
	padding:0 10px;
}
.job_listing .job-type {
    color: #fff;
	font-weight:600;
	text-transform:uppercase;
	font-size:13px;
	background-color:#3396D1;
}
.job_listing .job-type.hourly {
	background-color:#3396D1;
}
.job_listing .job-type.full-time {
	background-color:#77c04b;
}
.job_listing .job-type.part-time {
	background-color:#ebc23a;
}
.job_listing .job-type.freelance {
	background-color:#E34C43;
}
.job_listing .job-type.temporary {
	background-color:#E9616F;
}
.job_listing .job-type.fix-price {
	background-color:#EB6725;
}
.job_listing .job-type.internship {
	background-color:#8645A6;
}
.job_listing .date {
    color: #666;
	background-color:#EFEFEF;
}
.job_listing .date date:before {
    content:"\f017";
	font-family: 'FontAwesome';
	margin-right:5px;
}

@media only screen and (max-width:991px) {
.job-comapny-info .position {
	width:46.555%;
} 	
.job-comapny-info .position,
.job-comapny-info .location,
.job-comapny-info .meta {
	padding-left:25px;
}
}

@media only screen and (max-width:767px) {
.job-comapny-info .position {
	width:46.555%;
} 	
.job-comapny-info .position,
.job-comapny-info .location {
	display:block;
	width:auto;
	padding-right:130px;
}
.job-comapny-info .meta {
	width:auto;
	min-width:120px;
	position:absolute;
	right:30px;
	top:40px;
	padding-left:0;
}
.job-comapny-info .location {
	padding-left:42px;
}
.job_listing .location:before {
    font-size: 18px;
    left: 25px;
}
}

@media only screen and (max-width:600px) {

ul.job_listings .job_listing .job-comapny-logo {
    width:50px;
}
.job-comapny-info {
    padding-left: 40px;
    padding-top: 0;
}
.job-comapny-info .meta {
	width:auto;
	min-width:120px;
	position:static;
	margin-left:25px;
}
.job-comapny-info .position,
.job-comapny-info .location {
	padding-right:0;
	margin-bottom:5px;
}

}

/*JOB-MANAGER-FORM CSS*/

.job-manager-form {
	background-color:#fff;
	border:2px solid #e1e1e1;
	padding:20px 0;
}
.job-manager-form h2 {
	padding:0 30px;
}
.job-manager-form fieldset {
	padding:15px 30px;
	border-bottom:none;
}
.job-manager-form fieldset .account-sign-in {
	padding:15px;
	border: 1px solid #e1e1e1;
	background-color:#f8f8f8;
	font-weight:600;
}

.job-manager-form .chosen-container-multi .chosen-choices {
	border: 1px solid #e1e1e1;
	outline:none;
}
.job-manager-form fieldset input.input-text {
	border: 1px solid #e1e1e1;
	font-size: 13px;
	height: 40px;
	line-height: 20px;
	padding: 9px 12px;
}
.job-manager-form fieldset textarea{
	border: 1px solid #e1e1e1;
	box-shadow: none;
	font-size: 13px;
	padding: 9px 12px;
}
.job-manager-form fieldset .wp-editor-container {
    border: 1px solid #e1e1e1;
    border-radius: 0;
	-webkit-border-radius:0;
}
.job-manager-form fieldset input.wp-job-manager-file-upload {
    padding:0;
	border:none;
}
.job-manager-form fieldset .account-sign-in .button {
	float:right;
}
.job-manager-form input[type="submit"] {
	margin-left:31%;
}
.job-manager-form input[type="submit"],
.job-manager-form fieldset .account-sign-in .button,
.single_job_listing .application .application_button,
.load_more_jobs strong {
	background-color: #77c04b;
    color: #ffffff;
	padding:9px 20px;
	line-height:1.5;
	display:inline-block;
	border-top:none;
	border-left:none;
	border-right:none;
	font-size:14px;
	border-bottom:2px solid #62a643;
	font-weight:normal;
}

.job-manager-form input[type="submit"]:hover,
.job-manager-form input[type="submit"]:focus,
.job-manager-form fieldset .account-sign-in .button:hover,
.job-manager-form fieldset .account-sign-in .button:focus,
.single_job_listing .application .application_button:hover,
.single_job_listing .application .application_button:focus,
.load_more_jobs strong:hover,
.load_more_jobs strong:focus {
	background-color: #6ab33e;
	border-color: #5a9e2f;
	color: #ffffff;
}	

@media only screen and (max-width:767px) {
	
.job-manager-form fieldset label,
.job-manager-form fieldset div.field {
    float: none;
    width: auto;
}
	
}


	
/*job detail css*/

.sf-job-info {
	background-color:#fff;
	padding:30px;
}

.sf-job-info .company-logo-info {
	width:150px;
	float:left;
}

.sf-job-info .sf-job-detail {
	clear:both;
}

.sf-job-title-company {
	margin-left:170px;
}
.sf-job-company-name {
	font-size:18px;
}
.sf-job-company-name strong {
	font-weight:normal;
}
.job_application.application {
	position:absolute;
	right:30px;
	top:50px;
}

.single_job_listing .meta {
	padding:30px 0;
	margin-bottom:0;
}



@media only screen and (max-width:767px) {
.sf-job-title {
	margin:0 0 10px;
}	
.sf-job-info .company-logo-info {
    width: 90px;
}	
.sf-job-title-company {
    margin-left: 100px;
    margin-right: 0;
}
.job_application.application {
    margin-left: 100px;
    margin-top: 15px;
    position: static;
}
}


/*== Job Dashboard ==*/
#job-manager-job-dashboard table td, 
#job-manager-job-dashboard table th {
    padding: 10px;
}


.sf-cati-row ul {
	padding-bottom:20px;
	margin:0 0 20px;
	border-bottom:1px dashed #CCC;
}
.sf-cati-row:last-child ul {
	margin:0 0 0;
	border-bottom:none;
}
.sf-cati-row ul li {
	width:33%;
	display:inline-block;
	padding:10px 20px 10px 0;
	font-size:15px;
}
.sf-cati-row ul li [class*="icon-bx"]{
	width:25px;
	height:25px;
	background-color:#FFF;
	line-height:25px;
	margin-right:15px;
}
.sf-cati-row ul li [class*="icon-bx"] img {
	height:22px;
}

@media only screen and (max-width:991px) {
.sf-cati-row ul li {
 width:49.555%;
} 
}
@media only screen and (max-width:767px) {
.sf-cati-row ul li {
 width:100%;
} 
}

/*== choose service in bookin form css ==*/
.tab-service-area {
	padding-top:0;
	padding-bottom:20px;
}
.aon-service-outer{
	margin-bottom:30px;
	position:relative;
}
.aon-service-outer .bootstrap-touchspin {
	position:absolute;
	bottom:0;
	left:0;
	padding:0 15px;
}
.aon-service-outer .bootstrap-touchspin .btn {
	border:1px solid #e1e1e1;
	font-size:16px;
	font-weight:600;
	padding:8px 20px;
	height:40px;
}
.aon-service-outer .bootstrap-touchspin .bootstrap-touchspin-postfix {
	border-left:none;
	font-size:12px;
	text-transform:uppercase;
	font-weight:600;
}
.aon-service-outer .bootstrap-touchspin .form-control {
	font-size:12px;
	font-weight:600;
}

.sf-service-fixhr-bx .input-table-bx{
	display:table;
	width:100%;
}
.sf-service-fixhr-bx .input-cell-bx{
	display:table-cell;
	width:1%;
	border:1px solid #ddd;
	background-color:#fff;
	text-align:center;
	vertical-align:middle;
	font-weight:600;
}
.sf-service-fixhr-bx .input-cell-bx input{
	border:none;
	text-align:center;
}


.aon-service-bx {
	background-color:#fff;
	border:1px solid #e1e1e1;
	text-align:center;
	position:relative;
	cursor:pointer;
}

.aon-service-done {
	position:absolute;
	content:"";
	top:0;
	left:0;
	width:40%;
	height:40%;
	margin:30%;
	background-color:rgba(255,255,255,0.5);
	opacity:0;
	
}
.aon-service-done .fa {
	content:"\f00c";
	font-family:"FontAwesome";
	position:absolute;
	top:50%;
	left:50%;
	margin:-35px;
	font-size:50px;
	color:#77c04b;	
	-moz-transform: scale(0);
	-webkit-transform: scale(0);
	-o-transform: scale(0);
	-ms-transform: scale(0);
	transform: scale(0);
}

.selected .aon-service-done .fa {
	-moz-transform: scale(1);
	-webkit-transform: scale(1);
	-o-transform: scale(1);
	-ms-transform: scale(1);
	transform: scale(1);
}

.selected .aon-service-done {
	top:0;
	left:0;
	width:100%;
	height:100%;
	margin:0;
	opacity:1;
	background-color:rgba(255,255,255,0.9);
}

.aon-service-outer{
	margin-bottom:30px;
}

/*== all categories ==*/

.aon-service-bx [class*="icon-bx-"] {
	background:none;
	height:70px;
	width:100%;
	line-height:70px;
}
.aon-service-name *{
	margin:0;
	padding:10px 5px 15px;
	text-transform:none;
	min-height:70px;
}
.aon-service-price {
	background-color:#f0f0f0;
	color:#605f5f;
	font-weight:600;
	font-family:Arial;
	padding:7px 15px;
	border:1px solid #e1e1e1;
	margin:-1px;
	font-size:18px;
	
}


/*== all service ==*/

.sf-cati-all {
	padding:25px 0 35px;
}
.sf-cati-all ul {
	margin:0 -1.5%;
}
.sf-cati-all ul li {
	width:30%;
	display:inline-block;
	padding:20px 0;
	font-size:15px;
	margin:0 1.5%;
	border-bottom:1px dashed #ddd;
}
.sf-cati-all ul li span{
	float:right;
	color:#3396D1;
	font-weight:600;
	font-size:14px;
}
.sf-cati-all ul li span .fa{
	font-weight:300;
}


@media only screen and (max-width:991px) {

.sf-cati-all ul li {
	width:45.666%;
	margin:0 2%;
    padding:5px 0;
}

}

@media only screen and (max-width:767px) {

.sf-cati-all ul li {
	width:auto;
	margin:0 15px;
	display:block;
}

}

/*== Provider categories ==*/
.sf-provider-cat {
	margin-bottom:20px;
	margin-right:300px;	
}
.sf-provider-cat a{
	margin-left:5px;	
}

.sf-provider-cat.sf-p-c-v2 {
	margin-right:0;	
}

.provider-content {
	padding-top:40px;	
}
.provider-quotation {
	margin:-15px 0 15px;
}

#applicants-listing {
	padding-top:50px;
}

#autocity #signup_city {
	padding-right:12px;
}

/*== listing set thum height ==*/
.sf-featured-thum,
.sf-listing-thum,
.sf-catagories-listing {
	position:relative;
	height:220px;
	background-color:#EEE;
	background-repeat:no-repeat;
	background-size:cover;
	background-position:center;
}
.sf-featured-thum .sf-featured-link,
.sf-listing-thum .sf-listing-link {
	position:absolute;
	top:0;
	left:0;
	height:100%;
	width:100%;
	z-index:2;
}

.sidebar-postion{ 
	float: <?php echo (!empty($data['sidebar-position'])) ? esc_html($data['sidebar-position']) : ''; ?>;
}

.show_more_main_v2 {
	clear:both;
}



.pixrating_title {
	font-size:12px;
	font-weight:600;
	margin:0 0 3px;
}
.review_rate {
	font-size:8px;
	color:#F4BE36;
}
.comments-area .comment-form .logged-in-as,
.comments-area .comment-form .review-title-form,
.comments-area .comment-form #add_comment_rating_wrap {
	float:none;
	width:auto;
	display:block;
}
.comments-area .comment-form .logged-in-as {
	margin-bottom:15px;
}
.comments-area .comment-form .logged-in-as a {
	color:#999999;
}
.comments-area .comment-form .logged-in-as a:last-child {
	color:#333333;
}
.comments-area .comment-form p.review-title-form {
	max-width:700px;
}
.comments-area .comment-form p.review-title-form input {
	padding-left:15px;
}
.comments-area .comment-form #add_comment_rating_wrap {
	padding:0 15px;
	width:240px;
	margin:0 0 20px;
}
.comments-area .comment-form #add_comment_rating_wrap label {
	display:block;
	font-size:13px;
}
.comments-area .comment-form #add_comment_rating_wrap [class*="star-"] {
	color:#F4BE36;
}
.comments-area .comment-form #add_comment_rating_wrap #add_post_rating {
    bottom: 6px;
	right:15px;
	color:#333333;
	font-weight:600;
}

/* Proder rating */
.sf-stats-rating {
	width:170px;
	display:inline-block;
	text-align:right;
	margin-right:10px;
	vertical-align:top;
}

.sf-stats-rating .sf-rating-holder,
.sf-stats-rating .sf-completed-tasks,
.sf-stats-rating .sf-average-reviews,
.sf-stats-rating .sf-rate-persent,
.sf-stats-rating .sf-average-question {
	padding-top:1px;
	padding-bottom:1px;
}

.sf-stats-rating .sf-rating-holder {
	color:#F4BE36;
	font-size:16px;
}
.sf-stats-rating .sf-average-reviews {
	display:inline-block;
	font-weight:600;
}
.sf-stats-rating .sf-rate-persent,
.sf-stats-rating .sf-average-question {
	display:inline-block;
	color:#CCCCCC;
}
.sf-stats-rating .sf-completed-tasks {
	font-size:11px;
}


.sf-reviews-summary {
	width:150px;
	display:inline-block;
	vertical-align:top;
}
.sf-reviews-summary .sf-reviews-row {
	display:table;
	width:100%;
}
.sf-reviews-summary .sf-reviews-star,
.sf-reviews-summary .sf-reviews-star-no {
	display:table-cell;
}
.sf-reviews-summary .sf-reviews-star {
	text-align:right;
	padding-right:10px;
	color:#F4BE36;
	font-size:12px;
}
.sf-reviews-summary .sf-reviews-star-no {
	width:60px;
	text-align:left;
}

/*tooltip css*/
.sf-provider-tooltip .btn{
	margin:0 5px 10px !important;
	padding:4px 5px;
	width:40px;
}

.tooltip-inner {
	padding:10px;
	font-weight:600;
	border-radius:0;
	width:100%
}

/*Plans css*/
.profile-form-bx .sf-plans-list{
	margin:0 -15px 30px;
}
.sf-plans-bx {
	border:1px solid #e1e1e1;
	padding:30px 20px;
	text-align:center;
	position:relative;
}
.sf-plans-bx .sf-plans-name {
	margin-top:0;
}
.sf-plans-bx .sf-plans-price {
	font-size:30px;
	font-weight:800;
	margin-bottom:10px;
	color:##3396D1;
}
.sf-plans-bx .sf-plans-connects {
	font-size:14px;
	font-weight:600;
}
.sf-plans-done {
	position:absolute;
	content:"";
	top:0;
	left:0;
	width:40%;
	height:40%;
	margin:30%;
	background-color:rgba(255,255,255,0.5);
	opacity:0;
	
}
.sf-plans-done .fa {
	content:"\f00c";
	font-family:"FontAwesome";
	position:absolute;
	top:50%;
	left:50%;
	margin:-25px;
	font-size:50px;
	color:#77c04b;	
	-moz-transform: scale(0);
	-webkit-transform: scale(0);
	-o-transform: scale(0);
	-ms-transform: scale(0);
	transform: scale(0);
}
.selected .sf-plans-done .fa {
	-moz-transform: scale(1);
	-webkit-transform: scale(1);
	-o-transform: scale(1);
	-ms-transform: scale(1);
	transform: scale(1);
}
.selected .sf-plans-done {
	top:0;
	left:0;
	width:100%;
	height:100%;
	margin:0;
	opacity:1;
	background-color:rgba(255,255,255,0.9);
}
.selected-plan > .sf-plans-bx {
	background-color:#3396D1;
	border-color:#3396D1;
}
.selected-plan * {
	color:#fff;
}

.sf-plans-available {
	margin-bottom:30px;
}
.sf-plans-available li {
	margin-bottom:10px;
}
.sf-plans-available strong {
	color:#333333;
}

.sf-overlay-wraper {
	position:absolute;
	left:0;
	top:0;
	width:100%;
	height:100%;
	background-color:#333;
	opacity:0.5;
}

.sf-alert-bx {
 padding:15px;
 background-color: #f2dede;
 border-color: #ebccd1;
 color: #a94442;
 margin: 0 15px; 
}

/*popup set marker position*/
.set-marker-popup {
	display:none ;
	position:fixed;
	top:0;
	left:0;
	width:100%;
	height:100%;
	z-index:9999;
}
.set-marker-popup .set-marker-map {
	position:absolute;
	top:0;
	left:0;
	width:100%;
	height:100%;
	z-index:1;
}
.set-marker-popup .set-marker-popup-close {
	position:absolute;
	top:8px;
	right:8px;
	width:30px;
	height:30px;
	z-index:2;
	color:#fff;
	text-align:center;
	line-height:30px;
	cursor:pointer;
	border:1px solid rgba(0,0,0,0);
	background-color:rgba(0,0,0,0.8);
}
.set-marker-popup .set-marker-popup-close:hover {
	background-color:rgba(0,0,0,1);
}

ul.fs-customer-status {
 margin-top:-10px;
 margin-bottom:-10px;
 padding-top:10px;
 padding-bottom:10px;
 
}
ul.fs-customer-status:hover ul {
 display:block;
}