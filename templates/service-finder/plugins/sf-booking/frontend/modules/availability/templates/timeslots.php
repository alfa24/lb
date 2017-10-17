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
<!--Availability Template-->

<div class="profile-form-bx">
  <div class="auther-availability form-inr clearfix">
    <div class="alert alert-warning">
      <?php esc_html_e('You need to put available hours for the booking system to work', 'service-finder'); ?>
    </div>
    <p>
      <?php esc_html_e('Set Up time slots for each week day', 'service-finder'); ?>
    </p>
    <div class="tabbable tabs-left">
      <ul class="nav nav-tabs col-md-3 col-sm-3 padding-0" id="subTab">
        <?php foreach($days as $day){ 

                                                $class = ($day == 'monday') ? 'active' : '';
												switch($day){
												case 'monday':
													$dayname = esc_html__('Monday','service-finder');
													break;
												case 'tuesday':
													$dayname = esc_html__('Tuesday','service-finder');
													break;
												case 'wednesday':
													$dayname = esc_html__('Wednesday','service-finder');
													break;
												case 'thursday':
													$dayname = esc_html__('Thursday','service-finder');
													break;
												case 'friday':
													$dayname = esc_html__('Friday','service-finder');
													break;
												case 'saturday':
													$dayname = esc_html__('Saturday','service-finder');
													break;
												case 'sunday':
													$dayname = esc_html__('Sunday','service-finder');
													break;						
												}

												echo '<li class="'.sanitize_html_class($class).'"><a data-toggle="tab" href="#'.$day.'">'.$dayname.'</a></li>';

                                                }?>
      </ul>
      <div class="tab-content col-md-9 col-sm-9 padding-0 avl-min-hight">
        <?php 

   

										   foreach($days as $day){

										   ?>
        <div id="<?php echo esc_attr($day); ?>" class="tab-pane <?php echo ($day == 'monday') ? 'active' : '';?>">
          <div class="tabs-inr">
            <form class="form-availability input_pro_slots <?php echo esc_attr($day); ?>-timeslots" id="<?php echo esc_attr($day); ?>-timeslots" method="post">
              <?php

														$liday = ucfirst(str_replace("day","",$day));

														$timeslots = $getTimeSlot->service_finder_getTimeSlots($day,$globalproviderid);

														$liarr = array();
														$endarr = array();

														if(!empty($timeslots)){

															foreach($timeslots as $timeslot){

															$slotids = explode('-',$timeslot->slotids);

                                                        

															$startid = explode($liday,$slotids[0]);

															$endid = explode($liday,$slotids[1]);

															

															$startid = $startid[1];

															$endid = $endid[1];
															
															
															$endarr[] = $endid;


																for ($x = $startid; $x <= $endid-1; $x++) {

																	$liarr[] = $x;

																}

															}

														}	

														

														?>
	  <?php if($time_format){ ?>
      <ul class="time-zone clearfix">
        <li id="li<?php echo esc_attr($liday) ?>1" <?php echo (in_array(10,$endarr)) ? 'data-point="endpoint"' : ''?> <?php echo (in_array('1',$liarr)) ? 'style="background-color: rgb(234, 234, 234);" class="disable-slot"' : ''?>>00:00</li>
        <li id="li<?php echo esc_attr($liday) ?>2" <?php echo (in_array(2,$endarr)) ? 'data-point="endpoint"' : ''?> <?php echo (in_array('2',$liarr)) ? 'style="background-color: rgb(234, 234, 234);" class="disable-slot"' : ''?>>00:30</li>
        <li id="li<?php echo esc_attr($liday) ?>3" <?php echo (in_array(3,$endarr)) ? 'data-point="endpoint"' : ''?> <?php echo (in_array(3,$liarr)) ? 'style="background-color: rgb(234, 234, 234);" class="disable-slot"' : ''?>>01:00</li>
        <li id="li<?php echo esc_attr($liday) ?>4" <?php echo (in_array(4,$endarr)) ? 'data-point="endpoint"' : ''?> <?php echo (in_array(4,$liarr)) ? 'style="background-color: rgb(234, 234, 234);" class="disable-slot"' : ''?>>01:30</li>
        <li id="li<?php echo esc_attr($liday) ?>5" <?php echo (in_array(5,$endarr)) ? 'data-point="endpoint"' : ''?> <?php echo (in_array(5,$liarr)) ? 'style="background-color: rgb(234, 234, 234);" class="disable-slot"' : ''?>>02:00</li>
        <li id="li<?php echo esc_attr($liday) ?>6" <?php echo (in_array(6,$endarr)) ? 'data-point="endpoint"' : ''?> <?php echo (in_array(6,$liarr)) ? 'style="background-color: rgb(234, 234, 234);" class="disable-slot"' : ''?>>02:30</li>
        <li id="li<?php echo esc_attr($liday) ?>7" <?php echo (in_array(7,$endarr)) ? 'data-point="endpoint"' : ''?> <?php echo (in_array(7,$liarr)) ? 'style="background-color: rgb(234, 234, 234);" class="disable-slot"' : ''?>>03:00</li>
        <li id="li<?php echo esc_attr($liday) ?>8" <?php echo (in_array(8,$endarr)) ? 'data-point="endpoint"' : ''?> <?php echo (in_array(8,$liarr)) ? 'style="background-color: rgb(234, 234, 234);" class="disable-slot"' : ''?>>03:30</li>
        <li id="li<?php echo esc_attr($liday) ?>9" <?php echo (in_array(9,$endarr)) ? 'data-point="endpoint"' : ''?> <?php echo (in_array(9,$liarr)) ? 'style="background-color: rgb(234, 234, 234);" class="disable-slot"' : ''?>>04:00</li>
        <li id="li<?php echo esc_attr($liday) ?>10" <?php echo (in_array(10,$endarr)) ? 'data-point="endpoint"' : ''?> <?php echo (in_array(10,$liarr)) ? 'style="background-color: rgb(234, 234, 234);" class="disable-slot"' : ''?> >04:30</li>
        <li id="li<?php echo esc_attr($liday) ?>11" <?php echo (in_array(12,$endarr)) ? 'data-point="endpoint"' : ''?> <?php echo (in_array(11,$liarr)) ? 'style="background-color: rgb(234, 234, 234);" class="disable-slot"' : ''?>>05:00</li>
        <li id="li<?php echo esc_attr($liday) ?>12" <?php echo (in_array(12,$endarr)) ? 'data-point="endpoint"' : ''?> <?php echo (in_array(12,$liarr)) ? 'style="background-color: rgb(234, 234, 234);" class="disable-slot"' : ''?>>05:30</li>
        <li id="li<?php echo esc_attr($liday) ?>13" <?php echo (in_array(13,$endarr)) ? 'data-point="endpoint"' : ''?> <?php echo (in_array(13,$liarr)) ? 'style="background-color: rgb(234, 234, 234);" class="disable-slot"' : ''?>>06:00</li>
        <li id="li<?php echo esc_attr($liday) ?>14" <?php echo (in_array(14,$endarr)) ? 'data-point="endpoint"' : ''?> <?php echo (in_array(14,$liarr)) ? 'style="background-color: rgb(234, 234, 234);" class="disable-slot"' : ''?>>06:30</li>
        <li id="li<?php echo esc_attr($liday) ?>15" <?php echo (in_array(15,$endarr)) ? 'data-point="endpoint"' : ''?> <?php echo (in_array(15,$liarr)) ? 'style="background-color: rgb(234, 234, 234);" class="disable-slot"' : ''?>>07:00</li>
        <li id="li<?php echo esc_attr($liday) ?>16" <?php echo (in_array(16,$endarr)) ? 'data-point="endpoint"' : ''?> <?php echo (in_array(16,$liarr)) ? 'style="background-color: rgb(234, 234, 234);" class="disable-slot"' : ''?>>07:30</li>
        <li id="li<?php echo esc_attr($liday) ?>17" <?php echo (in_array(17,$endarr)) ? 'data-point="endpoint"' : ''?> <?php echo (in_array(17,$liarr)) ? 'style="background-color: rgb(234, 234, 234);" class="disable-slot"' : ''?>>08:00</li>
        <li id="li<?php echo esc_attr($liday) ?>18" <?php echo (in_array(18,$endarr)) ? 'data-point="endpoint"' : ''?> <?php echo (in_array(18,$liarr)) ? 'style="background-color: rgb(234, 234, 234);" class="disable-slot"' : ''?>>08:30</li>
        <li id="li<?php echo esc_attr($liday) ?>19" <?php echo (in_array(19,$endarr)) ? 'data-point="endpoint"' : ''?> <?php echo (in_array(19,$liarr)) ? 'style="background-color: rgb(234, 234, 234);" class="disable-slot"' : ''?>>09:00</li>
        <li id="li<?php echo esc_attr($liday) ?>20" <?php echo (in_array(20,$endarr)) ? 'data-point="endpoint"' : ''?> <?php echo (in_array(20,$liarr)) ? 'style="background-color: rgb(234, 234, 234);" class="disable-slot"' : ''?>>09:30</li>
        <li id="li<?php echo esc_attr($liday) ?>21" <?php echo (in_array(21,$endarr)) ? 'data-point="endpoint"' : ''?> <?php echo (in_array(21,$liarr)) ? 'style="background-color: rgb(234, 234, 234);" class="disable-slot"' : ''?>>10:00</li>
        <li id="li<?php echo esc_attr($liday) ?>22" <?php echo (in_array(22,$endarr)) ? 'data-point="endpoint"' : ''?> <?php echo (in_array(22,$liarr)) ? 'style="background-color: rgb(234, 234, 234);" class="disable-slot"' : ''?>>10:30</li>
        <li id="li<?php echo esc_attr($liday) ?>23" <?php echo (in_array(23,$endarr)) ? 'data-point="endpoint"' : ''?> <?php echo (in_array(23,$liarr)) ? 'style="background-color: rgb(234, 234, 234);" class="disable-slot"' : ''?>>11:00</li>
        <li id="li<?php echo esc_attr($liday) ?>24" <?php echo (in_array(24,$endarr)) ? 'data-point="endpoint"' : ''?> <?php echo (in_array(24,$liarr)) ? 'style="background-color: rgb(234, 234, 234);" class="disable-slot"' : ''?>>11:30</li>
        <li id="li<?php echo esc_attr($liday) ?>25" <?php echo (in_array(25,$endarr)) ? 'data-point="endpoint"' : ''?> <?php echo (in_array(25,$liarr)) ? 'style="background-color: rgb(234, 234, 234);" class="disable-slot"' : ''?>>12:00</li>
        <li id="li<?php echo esc_attr($liday) ?>26" <?php echo (in_array(26,$endarr)) ? 'data-point="endpoint"' : ''?> <?php echo (in_array(26,$liarr)) ? 'style="background-color: rgb(234, 234, 234);" class="disable-slot"' : ''?>>12:30</li>
        <li id="li<?php echo esc_attr($liday) ?>27" <?php echo (in_array(27,$endarr)) ? 'data-point="endpoint"' : ''?> <?php echo (in_array(27,$liarr)) ? 'style="background-color: rgb(234, 234, 234);" class="disable-slot"' : ''?>>13:00</li>
        <li id="li<?php echo esc_attr($liday) ?>28" <?php echo (in_array(28,$endarr)) ? 'data-point="endpoint"' : ''?> <?php echo (in_array(28,$liarr)) ? 'style="background-color: rgb(234, 234, 234);" class="disable-slot"' : ''?>>13:30</li>
        <li id="li<?php echo esc_attr($liday) ?>29" <?php echo (in_array(29,$endarr)) ? 'data-point="endpoint"' : ''?> <?php echo (in_array(29,$liarr)) ? 'style="background-color: rgb(234, 234, 234);" class="disable-slot"' : ''?>>14:00</li>
        <li id="li<?php echo esc_attr($liday) ?>30" <?php echo (in_array(30,$endarr)) ? 'data-point="endpoint"' : ''?> <?php echo (in_array(30,$liarr)) ? 'style="background-color: rgb(234, 234, 234);" class="disable-slot"' : ''?>>14:30</li>
        <li id="li<?php echo esc_attr($liday) ?>31" <?php echo (in_array(31,$endarr)) ? 'data-point="endpoint"' : ''?> <?php echo (in_array(31,$liarr)) ? 'style="background-color: rgb(234, 234, 234);" class="disable-slot"' : ''?>>15:00</li>
        <li id="li<?php echo esc_attr($liday) ?>32" <?php echo (in_array(32,$endarr)) ? 'data-point="endpoint"' : ''?> <?php echo (in_array(32,$liarr)) ? 'style="background-color: rgb(234, 234, 234);" class="disable-slot"' : ''?>>15:30</li>
        <li id="li<?php echo esc_attr($liday) ?>33" <?php echo (in_array(33,$endarr)) ? 'data-point="endpoint"' : ''?> <?php echo (in_array(33,$liarr)) ? 'style="background-color: rgb(234, 234, 234);" class="disable-slot"' : ''?>>16:00</li>
        <li id="li<?php echo esc_attr($liday) ?>34" <?php echo (in_array(34,$endarr)) ? 'data-point="endpoint"' : ''?> <?php echo (in_array(34,$liarr)) ? 'style="background-color: rgb(234, 234, 234);" class="disable-slot"' : ''?>>16:30</li>
        <li id="li<?php echo esc_attr($liday) ?>35" <?php echo (in_array(35,$endarr)) ? 'data-point="endpoint"' : ''?> <?php echo (in_array(35,$liarr)) ? 'style="background-color: rgb(234, 234, 234);" class="disable-slot"' : ''?>>17:00</li>
        <li id="li<?php echo esc_attr($liday) ?>36" <?php echo (in_array(36,$endarr)) ? 'data-point="endpoint"' : ''?> <?php echo (in_array(36,$liarr)) ? 'style="background-color: rgb(234, 234, 234);" class="disable-slot"' : ''?>>17:30</li>
        <li id="li<?php echo esc_attr($liday) ?>37" <?php echo (in_array(37,$endarr)) ? 'data-point="endpoint"' : ''?> <?php echo (in_array(37,$liarr)) ? 'style="background-color: rgb(234, 234, 234);" class="disable-slot"' : ''?>>18:00</li>
        <li id="li<?php echo esc_attr($liday) ?>38" <?php echo (in_array(38,$endarr)) ? 'data-point="endpoint"' : ''?> <?php echo (in_array(38,$liarr)) ? 'style="background-color: rgb(234, 234, 234);" class="disable-slot"' : ''?>>18:30</li>
        <li id="li<?php echo esc_attr($liday) ?>39" <?php echo (in_array(39,$endarr)) ? 'data-point="endpoint"' : ''?> <?php echo (in_array(39,$liarr)) ? 'style="background-color: rgb(234, 234, 234);" class="disable-slot"' : ''?>>19:00</li>
        <li id="li<?php echo esc_attr($liday) ?>40" <?php echo (in_array(40,$endarr)) ? 'data-point="endpoint"' : ''?> <?php echo (in_array(40,$liarr)) ? 'style="background-color: rgb(234, 234, 234);" class="disable-slot"' : ''?>>19:30</li>
        <li id="li<?php echo esc_attr($liday) ?>41" <?php echo (in_array(41,$endarr)) ? 'data-point="endpoint"' : ''?> <?php echo (in_array(41,$liarr)) ? 'style="background-color: rgb(234, 234, 234);" class="disable-slot"' : ''?>>20:00</li>
        <li id="li<?php echo esc_attr($liday) ?>42" <?php echo (in_array(42,$endarr)) ? 'data-point="endpoint"' : ''?> <?php echo (in_array(42,$liarr)) ? 'style="background-color: rgb(234, 234, 234);" class="disable-slot"' : ''?>>20:30</li>
        <li id="li<?php echo esc_attr($liday) ?>43" <?php echo (in_array(43,$endarr)) ? 'data-point="endpoint"' : ''?> <?php echo (in_array(43,$liarr)) ? 'style="background-color: rgb(234, 234, 234);" class="disable-slot"' : ''?>>21:00</li>
        <li id="li<?php echo esc_attr($liday) ?>44" <?php echo (in_array(44,$endarr)) ? 'data-point="endpoint"' : ''?> <?php echo (in_array(44,$liarr)) ? 'style="background-color: rgb(234, 234, 234);" class="disable-slot"' : ''?>>21:30</li>
        <li id="li<?php echo esc_attr($liday) ?>45" <?php echo (in_array(45,$endarr)) ? 'data-point="endpoint"' : ''?> <?php echo (in_array(45,$liarr)) ? 'style="background-color: rgb(234, 234, 234);" class="disable-slot"' : ''?>>22:00</li>
        <li id="li<?php echo esc_attr($liday) ?>46" <?php echo (in_array(46,$endarr)) ? 'data-point="endpoint"' : ''?> <?php echo (in_array(46,$liarr)) ? 'style="background-color: rgb(234, 234, 234);" class="disable-slot"' : ''?>>22:30</li>
        <li id="li<?php echo esc_attr($liday) ?>47" <?php echo (in_array(47,$endarr)) ? 'data-point="endpoint"' : ''?> <?php echo (in_array(47,$liarr)) ? 'style="background-color: rgb(234, 234, 234);" class="disable-slot"' : ''?>>23:00</li>
        <li id="li<?php echo esc_attr($liday) ?>48" <?php echo (in_array(48,$endarr)) ? 'data-point="endpoint"' : ''?> <?php echo (in_array(48,$liarr)) ? 'style="background-color: rgb(234, 234, 234);" class="disable-slot"' : ''?>>23:30</li>
      </ul>	
      <?php }else{ ?>
      <h5>AM</h5>
      <ul class="time-zone clearfix">
        <li id="li<?php echo esc_attr($liday) ?>1" <?php echo (in_array(1,$endarr)) ? 'data-point="endpoint"' : ''?> <?php echo (in_array('1',$liarr)) ? 'style="background-color: rgb(234, 234, 234);" class="disable-slot"' : ''?>>00:00</li>
        <li id="li<?php echo esc_attr($liday) ?>2" <?php echo (in_array(2,$endarr)) ? 'data-point="endpoint"' : ''?> <?php echo (in_array('2',$liarr)) ? 'style="background-color: rgb(234, 234, 234);" class="disable-slot"' : ''?>>00:30</li>
        <li id="li<?php echo esc_attr($liday) ?>3" <?php echo (in_array(3,$endarr)) ? 'data-point="endpoint"' : ''?> <?php echo (in_array(3,$liarr)) ? 'style="background-color: rgb(234, 234, 234);" class="disable-slot"' : ''?>>01:00</li>
        <li id="li<?php echo esc_attr($liday) ?>4" <?php echo (in_array(4,$endarr)) ? 'data-point="endpoint"' : ''?> <?php echo (in_array(4,$liarr)) ? 'style="background-color: rgb(234, 234, 234);" class="disable-slot"' : ''?>>01:30</li>
        <li id="li<?php echo esc_attr($liday) ?>5" <?php echo (in_array(5,$endarr)) ? 'data-point="endpoint"' : ''?> <?php echo (in_array(5,$liarr)) ? 'style="background-color: rgb(234, 234, 234);" class="disable-slot"' : ''?>>02:00</li>
        <li id="li<?php echo esc_attr($liday) ?>6" <?php echo (in_array(6,$endarr)) ? 'data-point="endpoint"' : ''?> <?php echo (in_array(6,$liarr)) ? 'style="background-color: rgb(234, 234, 234);" class="disable-slot"' : ''?>>02:30</li>
        <li id="li<?php echo esc_attr($liday) ?>7" <?php echo (in_array(7,$endarr)) ? 'data-point="endpoint"' : ''?> <?php echo (in_array(7,$liarr)) ? 'style="background-color: rgb(234, 234, 234);" class="disable-slot"' : ''?>>03:00</li>
        <li id="li<?php echo esc_attr($liday) ?>8" <?php echo (in_array(8,$endarr)) ? 'data-point="endpoint"' : ''?> <?php echo (in_array(8,$liarr)) ? 'style="background-color: rgb(234, 234, 234);" class="disable-slot"' : ''?>>03:30</li>
        <li id="li<?php echo esc_attr($liday) ?>9" <?php echo (in_array(9,$endarr)) ? 'data-point="endpoint"' : ''?> <?php echo (in_array(9,$liarr)) ? 'style="background-color: rgb(234, 234, 234);" class="disable-slot"' : ''?>>04:00</li>
        <li id="li<?php echo esc_attr($liday) ?>10" <?php echo (in_array(10,$endarr)) ? 'data-point="endpoint"' : ''?> <?php echo (in_array(10,$liarr)) ? 'style="background-color: rgb(234, 234, 234);" class="disable-slot"' : ''?> >04:30</li>
        <li id="li<?php echo esc_attr($liday) ?>11" <?php echo (in_array(11,$endarr)) ? 'data-point="endpoint"' : ''?> <?php echo (in_array(11,$liarr)) ? 'style="background-color: rgb(234, 234, 234);" class="disable-slot"' : ''?>>05:00</li>
        <li id="li<?php echo esc_attr($liday) ?>12" <?php echo (in_array(12,$endarr)) ? 'data-point="endpoint"' : ''?> <?php echo (in_array(12,$liarr)) ? 'style="background-color: rgb(234, 234, 234);" class="disable-slot"' : ''?>>05:30</li>
        <li id="li<?php echo esc_attr($liday) ?>13" <?php echo (in_array(13,$endarr)) ? 'data-point="endpoint"' : ''?> <?php echo (in_array(13,$liarr)) ? 'style="background-color: rgb(234, 234, 234);" class="disable-slot"' : ''?>>06:00</li>
        <li id="li<?php echo esc_attr($liday) ?>14" <?php echo (in_array(14,$endarr)) ? 'data-point="endpoint"' : ''?> <?php echo (in_array(14,$liarr)) ? 'style="background-color: rgb(234, 234, 234);" class="disable-slot"' : ''?>>06:30</li>
        <li id="li<?php echo esc_attr($liday) ?>15" <?php echo (in_array(15,$endarr)) ? 'data-point="endpoint"' : ''?> <?php echo (in_array(15,$liarr)) ? 'style="background-color: rgb(234, 234, 234);" class="disable-slot"' : ''?>>07:00</li>
        <li id="li<?php echo esc_attr($liday) ?>16" <?php echo (in_array(16,$endarr)) ? 'data-point="endpoint"' : ''?> <?php echo (in_array(16,$liarr)) ? 'style="background-color: rgb(234, 234, 234);" class="disable-slot"' : ''?>>07:30</li>
        <li id="li<?php echo esc_attr($liday) ?>17" <?php echo (in_array(17,$endarr)) ? 'data-point="endpoint"' : ''?> <?php echo (in_array(17,$liarr)) ? 'style="background-color: rgb(234, 234, 234);" class="disable-slot"' : ''?>>08:00</li>
        <li id="li<?php echo esc_attr($liday) ?>18" <?php echo (in_array(18,$endarr)) ? 'data-point="endpoint"' : ''?> <?php echo (in_array(18,$liarr)) ? 'style="background-color: rgb(234, 234, 234);" class="disable-slot"' : ''?>>08:30</li>
        <li id="li<?php echo esc_attr($liday) ?>19" <?php echo (in_array(19,$endarr)) ? 'data-point="endpoint"' : ''?> <?php echo (in_array(19,$liarr)) ? 'style="background-color: rgb(234, 234, 234);" class="disable-slot"' : ''?>>09:00</li>
        <li id="li<?php echo esc_attr($liday) ?>20" <?php echo (in_array(20,$endarr)) ? 'data-point="endpoint"' : ''?> <?php echo (in_array(20,$liarr)) ? 'style="background-color: rgb(234, 234, 234);" class="disable-slot"' : ''?> >09:30</li>
        <li id="li<?php echo esc_attr($liday) ?>21" <?php echo (in_array(21,$endarr)) ? 'data-point="endpoint"' : ''?> <?php echo (in_array(21,$liarr)) ? 'style="background-color: rgb(234, 234, 234);" class="disable-slot"' : ''?>>10:00</li>
        <li id="li<?php echo esc_attr($liday) ?>22" <?php echo (in_array(22,$endarr)) ? 'data-point="endpoint"' : ''?> <?php echo (in_array(22,$liarr)) ? 'style="background-color: rgb(234, 234, 234);" class="disable-slot"' : ''?>>10:30</li>
        <li id="li<?php echo esc_attr($liday) ?>23" <?php echo (in_array(23,$endarr)) ? 'data-point="endpoint"' : ''?> <?php echo (in_array(23,$liarr)) ? 'style="background-color: rgb(234, 234, 234);" class="disable-slot"' : ''?>>11:00</li>
        <li id="li<?php echo esc_attr($liday) ?>24" <?php echo (in_array(24,$endarr)) ? 'data-point="endpoint"' : ''?> <?php echo (in_array(24,$liarr)) ? 'style="background-color: rgb(234, 234, 234);" class="disable-slot"' : ''?>>11:30</li>
      </ul>
      <h5>PM</h5>
      <ul class="time-zone clearfix">
        <li id="li<?php echo esc_attr($liday) ?>25" <?php echo (in_array(25,$endarr)) ? 'data-point="endpoint"' : ''?> <?php echo (in_array(25,$liarr)) ? 'style="background-color: rgb(234, 234, 234);" class="disable-slot"' : ''?>>12:00</li>
        <li id="li<?php echo esc_attr($liday) ?>26" <?php echo (in_array(26,$endarr)) ? 'data-point="endpoint"' : ''?> <?php echo (in_array(26,$liarr)) ? 'style="background-color: rgb(234, 234, 234);" class="disable-slot"' : ''?>>12:30</li>
        <li id="li<?php echo esc_attr($liday) ?>27" <?php echo (in_array(27,$endarr)) ? 'data-point="endpoint"' : ''?> <?php echo (in_array(27,$liarr)) ? 'style="background-color: rgb(234, 234, 234);" class="disable-slot"' : ''?>>01:00</li>
        <li id="li<?php echo esc_attr($liday) ?>28" <?php echo (in_array(28,$endarr)) ? 'data-point="endpoint"' : ''?> <?php echo (in_array(28,$liarr)) ? 'style="background-color: rgb(234, 234, 234);" class="disable-slot"' : ''?>>01:30</li>
        <li id="li<?php echo esc_attr($liday) ?>29" <?php echo (in_array(29,$endarr)) ? 'data-point="endpoint"' : ''?> <?php echo (in_array(29,$liarr)) ? 'style="background-color: rgb(234, 234, 234);" class="disable-slot"' : ''?>>02:00</li>
        <li id="li<?php echo esc_attr($liday) ?>30" <?php echo (in_array(30,$endarr)) ? 'data-point="endpoint"' : ''?> <?php echo (in_array(30,$liarr)) ? 'style="background-color: rgb(234, 234, 234);" class="disable-slot"' : ''?>>02:30</li>
        <li id="li<?php echo esc_attr($liday) ?>31" <?php echo (in_array(31,$endarr)) ? 'data-point="endpoint"' : ''?> <?php echo (in_array(31,$liarr)) ? 'style="background-color: rgb(234, 234, 234);" class="disable-slot"' : ''?>>03:00</li>
        <li id="li<?php echo esc_attr($liday) ?>32" <?php echo (in_array(32,$endarr)) ? 'data-point="endpoint"' : ''?> <?php echo (in_array(32,$liarr)) ? 'style="background-color: rgb(234, 234, 234);" class="disable-slot"' : ''?>>03:30</li>
        <li id="li<?php echo esc_attr($liday) ?>33" <?php echo (in_array(33,$endarr)) ? 'data-point="endpoint"' : ''?> <?php echo (in_array(33,$liarr)) ? 'style="background-color: rgb(234, 234, 234);" class="disable-slot"' : ''?>>04:00</li>
        <li id="li<?php echo esc_attr($liday) ?>34" <?php echo (in_array(34,$endarr)) ? 'data-point="endpoint"' : ''?> <?php echo (in_array(34,$liarr)) ? 'style="background-color: rgb(234, 234, 234);" class="disable-slot"' : ''?>>04:30</li>
        <li id="li<?php echo esc_attr($liday) ?>35" <?php echo (in_array(35,$endarr)) ? 'data-point="endpoint"' : ''?> <?php echo (in_array(35,$liarr)) ? 'style="background-color: rgb(234, 234, 234);" class="disable-slot"' : ''?>>05:00</li>
        <li id="li<?php echo esc_attr($liday) ?>36" <?php echo (in_array(36,$endarr)) ? 'data-point="endpoint"' : ''?> <?php echo (in_array(36,$liarr)) ? 'style="background-color: rgb(234, 234, 234);" class="disable-slot"' : ''?>>05:30</li>
        <li id="li<?php echo esc_attr($liday) ?>37" <?php echo (in_array(37,$endarr)) ? 'data-point="endpoint"' : ''?> <?php echo (in_array(37,$liarr)) ? 'style="background-color: rgb(234, 234, 234);" class="disable-slot"' : ''?> >06:00</li>
        <li id="li<?php echo esc_attr($liday) ?>38" <?php echo (in_array(38,$endarr)) ? 'data-point="endpoint"' : ''?> <?php echo (in_array(38,$liarr)) ? 'style="background-color: rgb(234, 234, 234);" class="disable-slot"' : ''?>>06:30</li>
        <li id="li<?php echo esc_attr($liday) ?>39" <?php echo (in_array(39,$endarr)) ? 'data-point="endpoint"' : ''?> <?php echo (in_array(39,$liarr)) ? 'style="background-color: rgb(234, 234, 234);" class="disable-slot"' : ''?>>07:00</li>
        <li id="li<?php echo esc_attr($liday) ?>40" <?php echo (in_array(40,$endarr)) ? 'data-point="endpoint"' : ''?> <?php echo (in_array(40,$liarr)) ? 'style="background-color: rgb(234, 234, 234);" class="disable-slot"' : ''?>>07:30</li>
        <li id="li<?php echo esc_attr($liday) ?>41" <?php echo (in_array(41,$endarr)) ? 'data-point="endpoint"' : ''?> <?php echo (in_array(41,$liarr)) ? 'style="background-color: rgb(234, 234, 234);" class="disable-slot"' : ''?>>08:00</li>
        <li id="li<?php echo esc_attr($liday) ?>42" <?php echo (in_array(42,$endarr)) ? 'data-point="endpoint"' : ''?> <?php echo (in_array(42,$liarr)) ? 'style="background-color: rgb(234, 234, 234);" class="disable-slot"' : ''?>>08:30</li>
        <li id="li<?php echo esc_attr($liday) ?>43" <?php echo (in_array(43,$endarr)) ? 'data-point="endpoint"' : ''?> <?php echo (in_array(43,$liarr)) ? 'style="background-color: rgb(234, 234, 234);" class="disable-slot"' : ''?>>09:00</li>
        <li id="li<?php echo esc_attr($liday) ?>44" <?php echo (in_array(44,$endarr)) ? 'data-point="endpoint"' : ''?> <?php echo (in_array(44,$liarr)) ? 'style="background-color: rgb(234, 234, 234);" class="disable-slot"' : ''?>>09:30</li>
        <li id="li<?php echo esc_attr($liday) ?>45" <?php echo (in_array(45,$endarr)) ? 'data-point="endpoint"' : ''?> <?php echo (in_array(45,$liarr)) ? 'style="background-color: rgb(234, 234, 234);" class="disable-slot"' : ''?>>10:00</li>
        <li id="li<?php echo esc_attr($liday) ?>46" <?php echo (in_array(46,$endarr)) ? 'data-point="endpoint"' : ''?> <?php echo (in_array(46,$liarr)) ? 'style="background-color: rgb(234, 234, 234);" class="disable-slot"' : ''?>>10:30</li>
        <li id="li<?php echo esc_attr($liday) ?>47" <?php echo (in_array(47,$endarr)) ? 'data-point="endpoint"' : ''?> <?php echo (in_array(47,$liarr)) ? 'style="background-color: rgb(234, 234, 234);" class="disable-slot"' : ''?>>11:00</li>
        <li id="li<?php echo esc_attr($liday) ?>48" <?php echo (in_array(48,$endarr)) ? 'data-point="endpoint"' : ''?> <?php echo (in_array(48,$liarr)) ? 'style="background-color: rgb(234, 234, 234);" class="disable-slot"' : ''?>>11:30</li>
      </ul>
      <?php } ?>
              
              <ul class="selected-time">
                <?php
				$time_format = (!empty($service_finder_options['time-format'])) ? $service_finder_options['time-format'] : '';

                                                        if(!empty($timeslots)){

															foreach($timeslots as $timeslot){
															
															if($time_format){
																$showslots = date('H:i',strtotime($timeslot->start_time)).'-'.date('H:i',strtotime($timeslot->end_time));
															}else{
																$showslots = date('h:i a',strtotime($timeslot->start_time)).'-'.date('h:i a',strtotime($timeslot->end_time));
															}

															echo '<li data-ids="'.esc_attr($timeslot->slotids).'">

                                                                <div class="input-group">

                                                                    <input type="text" value="'.esc_attr($timeslot->max_bookings).'" class="form-control" placeholder="'.esc_html__('Number of bookings allowed','service-finder').'">

                                                                    <div class="input-group-btn">

                                                                        <button type="button" class="btn btn-primary">'.$showslots.'</button>

                                                                        <button type="button" class="btn btn-danger removeSlot"><i class="fa fa-remove"></i></button>

                                                                    </div>

                                                                </div>

                                                            </li>';

															}

														}

														?>
              </ul>
              <div class="form-group">
                <button <?php echo (empty($timeslots)) ? 'style="display:none;"' : ''; ?> class="btn btn-primary margin-r-10 saveslots" name="Save" type="button" >
                <?php esc_html_e('Submit', 'service-finder'); ?>
                </button>
              </div>
            </form>
          </div>
        </div>
        <?php

										   }

										   ?>
      </div>
    </div>
  </div>
</div>

<!--Modal Popup-->
<form method="post" class="get-avl default-hidden" id="getavl">
    <div class="clearfix row input_fields_wrap">
      
      <div class="col-md-6">
        <div class="form-group form-group padding-tb-5 font-size-18">
            <strong class="text-primary"><?php esc_html_e('From:', 'service-finder'); ?></strong> <span id="startval"></span>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <select class="form-control" name="totime" id="totime" data-live-search="true" title="<?php esc_html_e('To', 'service-finder'); ?>">
            <option value=""><?php esc_html_e('To', 'service-finder'); ?></option>
          </select>  
        </div>
      </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">
      <?php esc_html_e('Cancel', 'service-finder'); ?>
      </button>
      <input type="button" class="btn btn-primary addslots" name="addslots" value="<?php esc_html_e('Ok', 'service-finder'); ?>" />
    </div>
</form>
