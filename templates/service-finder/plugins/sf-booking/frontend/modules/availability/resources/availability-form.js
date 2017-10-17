/*****************************************************************************
*
*	copyright(c) - aonetheme.com - Service Finder Team
*	More Info: http://aonetheme.com/
*	Coder: Service Finder Team
*	Email: contact@aonetheme.com
*
******************************************************************************/

	
// When the browser is ready...
  jQuery(function() {
	'use strict';
	var dayname = 'Mon';
	var tabname = 'monday';
	var mflag = 0;
	var tflag = 0;
	var wflag = 0;
	var thflag = 0;
	var frflag = 0;
	var saflag = 0;
	var suflag = 0;
	var toval;
	var startval;
	
	var monarr = [];
	var tuearr = [];
	var wedarr = [];
	var thurarr = [];
	var friarr = [];
	var satarr = [];
	var sunarr = [];
	
	var monbookarr = [];
	var tuebookarr = [];
	var wedbookarr = [];
	var thubookarr = [];
	var fribookarr = [];
	var satbookarr = [];
	var sunbookarr = [];
	
	var x = [];
	
	
	var maxbooking = '';
	var resMessageSlots = '';
	var resMessageIds = '';
	/*Click event on subtabs*/
	jQuery('body').on('click', '#subTab li a', function(){
		dayname = jQuery(this).attr('href');													
		dayname = dayname.replace("#", "");
		tabname = dayname;
		dayname = dayname.replace("day", "");
		dayname = dayname.substr(0, 1).toUpperCase() + dayname.substr(1);
	});	
	jQuery('body').on('click', '.addslots', function(event){
		jQuery('form.'+tabname+'-timeslots').find('.saveslots').hide();													 
		jQuery('form.'+tabname+'-timeslots').find('ul.selected-time').html('');													 
		toval = jQuery('#getavl').find('#totime').val();
		service_finder_make_selected(dayname,startval,toval);
		bootbox.hideAll();
		ViewSelectedTimeslots(dayname,tabname);
		
	});	
	
	/*Click event on days/inner tab*/
	jQuery('body').on('click', '.time-zone li', function(event){
		if(!jQuery(this).hasClass("disable-slot")){
		jQuery('.loading-area').show();
		switch(tabname)
		{
			case 'monday':
			
				var startvaltext = jQuery(this).html();
				startval = jQuery(this).attr('id');
				
				startval = startval.split('Mon');			
				startval = startval[1];
				
				var tovaltext = service_finder_avl_slots(startval,dayname);
				
				jQuery('#getavl')
				.find('#startval').html(startvaltext).end()
				.find('#totime').html(tovaltext).end();
				jQuery('select').selectpicker('refresh');

				bootbox
				.dialog({
					title: param.select_timeslot,
					message: jQuery('#getavl'),
					show: false
				})
				.on('shown.bs.modal', function() {
					jQuery('.loading-area').hide();
					jQuery('#getavl')
					.show()
					.bootstrapValidator('resetForm');
				})
				.on('hide.bs.modal', function(e) {
					jQuery('#getavl').hide().appendTo('body');
				})
				.modal('show');
				
				if(mflag == 0){
					monarr = [];
					monbookarr = [];
					jQuery('#'+tabname+'-timeslots').find('ul.selected-time li').each(function(){
							monbookarr.push(jQuery(this).find('input').val());
							monarr.push(jQuery(this).attr('data-ids'));
					});	
					mflag++;
				}

			  break;
			case 'tuesday':
				
				var startvaltext = jQuery(this).html();
				startval = jQuery(this).attr('id');
				
				startval = startval.split('Tues');			
				startval = startval[1];
				
				var tovaltext = service_finder_avl_slots(startval,dayname);
				
				jQuery('#getavl')
				.find('#startval').html(startvaltext).end()
				.find('#totime').html(tovaltext).end();
				jQuery('select').selectpicker('refresh');

				bootbox
				.dialog({
					title: param.select_timeslot,
					message: jQuery('#getavl'),
					show: false
				})
				.on('shown.bs.modal', function() {
					jQuery('.loading-area').hide();
					jQuery('#getavl')
					.show()
					.bootstrapValidator('resetForm');
				})
				.on('hide.bs.modal', function(e) {
					jQuery('#getavl').hide().appendTo('body');
				})
				.modal('show');
				
				if(tflag == 0){
					tuearr = [];
					tuebookarr = [];
					jQuery('#'+tabname+'-timeslots').find('ul.selected-time li').each(function(){
							tuebookarr.push(jQuery(this).find('input').val());
							tuearr.push(jQuery(this).attr('data-ids'));
					});	
					tflag++;
				}
			  break;
			case 'wednesday':
				
				var startvaltext = jQuery(this).html();
				startval = jQuery(this).attr('id');
				
				startval = startval.split('Wednes');			
				startval = startval[1];
				
				var tovaltext = service_finder_avl_slots(startval,dayname);
				
				jQuery('#getavl')
				.find('#startval').html(startvaltext).end()
				.find('#totime').html(tovaltext).end();
				jQuery('select').selectpicker('refresh');

				bootbox
				.dialog({
					title: param.select_timeslot,
					message: jQuery('#getavl'),
					show: false
				})
				.on('shown.bs.modal', function() {
					jQuery('.loading-area').hide();
					jQuery('#getavl')
					.show()
					.bootstrapValidator('resetForm');
				})
				.on('hide.bs.modal', function(e) {
					jQuery('#getavl').hide().appendTo('body');
				})
				.modal('show');
				
				if(wflag == 0){
					wedarr = [];
					wedbookarr = [];	
					jQuery('#'+tabname+'-timeslots').find('ul.selected-time li').each(function(){
							wedbookarr.push(jQuery(this).find('input').val());
							wedarr.push(jQuery(this).attr('data-ids'));
					});	
					wflag++;
					
				}
			  break;
			case 'thursday':
				
				var startvaltext = jQuery(this).html();
				startval = jQuery(this).attr('id');
				
				startval = startval.split('Thurs');			
				startval = startval[1];
				
				var tovaltext = service_finder_avl_slots(startval,dayname);
				
				jQuery('#getavl')
				.find('#startval').html(startvaltext).end()
				.find('#totime').html(tovaltext).end();
				jQuery('select').selectpicker('refresh');

				bootbox
				.dialog({
					title: param.select_timeslot,
					message: jQuery('#getavl'),
					show: false
				})
				.on('shown.bs.modal', function() {
					jQuery('.loading-area').hide();
					jQuery('#getavl')
					.show()
					.bootstrapValidator('resetForm');
				})
				.on('hide.bs.modal', function(e) {
					jQuery('#getavl').hide().appendTo('body');
				})
				.modal('show');
				
				if(thflag == 0){
					thurarr = [];
					thubookarr = [];	
					jQuery('#'+tabname+'-timeslots').find('ul.selected-time li').each(function(){
							thubookarr.push(jQuery(this).find('input').val());
							thurarr.push(jQuery(this).attr('data-ids'));
					});	
					thflag++;	
				}
			  break;
			case 'friday':
				
				var startvaltext = jQuery(this).html();
				startval = jQuery(this).attr('id');
				
				startval = startval.split('Fri');			
				startval = startval[1];
				
				var tovaltext = service_finder_avl_slots(startval,dayname);
				
				jQuery('#getavl')
				.find('#startval').html(startvaltext).end()
				.find('#totime').html(tovaltext).end();
				jQuery('select').selectpicker('refresh');

				bootbox
				.dialog({
					title: param.select_timeslot,
					message: jQuery('#getavl'),
					show: false
				})
				.on('shown.bs.modal', function() {
					jQuery('.loading-area').hide();
					jQuery('#getavl')
					.show()
					.bootstrapValidator('resetForm');
				})
				.on('hide.bs.modal', function(e) {
					jQuery('#getavl').hide().appendTo('body');
				})
				.modal('show');
				
				if(frflag == 0){
					friarr = [];
					fribookarr = [];
					jQuery('#'+tabname+'-timeslots').find('ul.selected-time li').each(function(){
							fribookarr.push(jQuery(this).find('input').val());
							friarr.push(jQuery(this).attr('data-ids'));
					});	
					frflag++;
				}
			  break;
			case 'saturday':
				
				var startvaltext = jQuery(this).html();
				startval = jQuery(this).attr('id');
				
				startval = startval.split('Satur');			
				startval = startval[1];
				
				var tovaltext = service_finder_avl_slots(startval,dayname);
				
				jQuery('#getavl')
				.find('#startval').html(startvaltext).end()
				.find('#totime').html(tovaltext).end();
				jQuery('select').selectpicker('refresh');

				bootbox
				.dialog({
					title: param.select_timeslot,
					message: jQuery('#getavl'),
					show: false
				})
				.on('shown.bs.modal', function() {
					jQuery('.loading-area').hide();
					jQuery('#getavl')
					.show()
					.bootstrapValidator('resetForm');
				})
				.on('hide.bs.modal', function(e) {
					jQuery('#getavl').hide().appendTo('body');
				})
				.modal('show');
				
				if(saflag == 0){
					satarr = [];
					satbookarr = [];	
					jQuery('#'+tabname+'-timeslots').find('ul.selected-time li').each(function(){
							satbookarr.push(jQuery(this).find('input').val());
							satarr.push(jQuery(this).attr('data-ids'));
					});	
					saflag++;
				}
			  break;
			case 'sunday':
				
				var startvaltext = jQuery(this).html();
				startval = jQuery(this).attr('id');
				
				startval = startval.split('Sun');			
				startval = startval[1];
				
				var tovaltext = service_finder_avl_slots(startval,dayname);
				
				jQuery('#getavl')
				.find('#startval').html(startvaltext).end()
				.find('#totime').html(tovaltext).end();
				jQuery('select').selectpicker('refresh');

				bootbox
				.dialog({
					title: param.select_timeslot,
					message: jQuery('#getavl'),
					show: false
				})
				.on('shown.bs.modal', function() {
					jQuery('.loading-area').hide();
					jQuery('#getavl')
					.show()
					.bootstrapValidator('resetForm');
				})
				.on('hide.bs.modal', function(e) {
					jQuery('#getavl').hide().appendTo('body');
				})
				.modal('show');
				
				if(suflag == 0){
					sunarr = [];
					sunbookarr = [];	
					jQuery('#'+tabname+'-timeslots').find('ul.selected-time li').each(function(){
							sunbookarr.push(jQuery(this).find('input').val());
							sunarr.push(jQuery(this).attr('data-ids'));
					});	
					suflag++;
					
				}
			  break;
		  }
		
		//jQuery('#'+tabname+'-timeslots').find('.saveslots').hide();
		//jQuery(this).parents('form').find('ul.selected-time').html('');
		//service_finder_ToggleTimeslot(this);
		}
	});	
	
	/*Remove slots*/
	jQuery('body').on('click', '.removeSlot', function(){
		jQuery(this).parents('li').remove();
		var dataIds = jQuery(this).parents('li').attr('data-ids');
		dataIds = dataIds.split('-');
		var startid = dataIds[0].split(dayname);
		var endid = dataIds[1].split(dayname);
		
		for(i=parseInt(startid[1]);i<parseInt(endid[1]);i++){
			var j = i + 1;
			jQuery('#li'+dayname+i).css('background-color','');
			jQuery('#li'+dayname+i).removeClass('disable-slot');
			jQuery('#li'+dayname+j).removeAttr('data-point');	
		}
	});
	
	
	/*Save slots*/
	jQuery('body').on('click', '.saveslots', function(){
			maxbooking = '';										  
			var flag = 0;
			var resMessage = service_finder_GetSelectedTimeslots(dayname);
			
			resMessage = resMessage.split('|');
		    resMessageSlots = resMessage[0];
			resMessageIds = resMessage[1];
			
			
			jQuery('#'+tabname+'-timeslots').find('ul.selected-time li').each(function(){
			if(jQuery(this).find('input').val() == ""){
			jQuery(this).find('input').addClass('alert-danger');	
			flag++;
			}else{
			jQuery(this).find('input').removeClass('alert-danger');	
			}																					   
			maxbooking = maxbooking + jQuery(this).find('input').val() + ',';																	  
			});
			
			if(flag > 0 ){
			return false;	
			}
			
			var data = {
			  "action": "weekday_timeslots",
			  "day": tabname,
			  "slots": resMessageSlots,
			  "slotids": resMessageIds,
			  "maxbooking": maxbooking,
			  "user_id": user_id,
			};
			
			var formdata = jQuery.param(data);
			
			jQuery.ajax({

						type: 'POST',

						url: ajaxurl,
						
						dataType: "json",
						
						beforeSend: function() {
							jQuery(".alert").remove();
							jQuery('.loading-area').show();
						},
						
						data: formdata,

						success:function (data, textStatus) {
							jQuery('.loading-area').hide();
							
							if(data['status'] == 'success'){
								jQuery( "<div class='alert alert-success'>"+data['suc_message']+"</div>" ).insertBefore( "form."+tabname+"-timeslots" );
										
							}else if(data['status'] == 'error'){
								jQuery( "<div class='alert alert-danger'>"+data['err_message']+"</div>" ).insertBefore( "form."+tabname+"-timeslots" );
							}
							
							
						
						}

					});
	});
	
	
	
	
	var strColorOn = '#eaeaea';
    var strColorOff = '#ffffff';

    function service_finder_GetHexValue(strRGBColor)
    {
       var aryRGBValues;
       var strR;
       var strG;
       var strB;
       var strHexValue;

       strRGBColor = strRGBColor.replace(/\s*/g, '');
       strRGBColor = strRGBColor.replace(/rgb\(|\)/g, '');
       aryRGBValues = strRGBColor.split(',');
       strR = aryRGBValues[0];
       strG = aryRGBValues[1];
       strB = aryRGBValues[2];
	   
       strHexValue = '#' + service_finder_RGBtoHex(strR, strG, strB);
	 
       return strHexValue.toLowerCase();
    }

    function service_finder_RGBtoHex(strR, strG, strB)
    {
       var intR = strR * 1;
       var intG = strG * 1;
       var intB = strB * 1;
       return intR.toString(16) + intG.toString(16) + intB.toString(16)
    }

    function service_finder_ToggleTimeslot(tdTimeslot)
    {
      var strBackgroundColor;

      if (tdTimeslot.style.backgroundColor == 'undefined' || tdTimeslot.style.backgroundColor == 'null' || tdTimeslot.style.backgroundColor == '')
      {
        tdTimeslot.style.backgroundColor = strColorOn;
        return;
      }
      strBackgroundColor = tdTimeslot.style.backgroundColor;
	  
      if (strBackgroundColor.substr(0,1) != '#')
      {
        strBackgroundColor = service_finder_GetHexValue(strBackgroundColor);
      }
      if (strBackgroundColor == strColorOff)
      {
        tdTimeslot.style.backgroundColor = strColorOn;
      }
      else
      {
        tdTimeslot.style.backgroundColor = strColorOff;
      }
    }

    function service_finder_GetTimeSlotValue(intTimeslot, strStartOrEnd)
    {
      var strTimeslot;

      switch(intTimeslot)
      {
        case 1:
          if (strStartOrEnd == 'start')
          {
            strTimeslot = '00:00';
          }
          else
          {
            strTimeslot = '00:30';
          }
          break;
        case 2:
          if (strStartOrEnd == 'start')
          {
            strTimeslot = '00:30';
          }
          else
          {
            strTimeslot = '01:00';
          }
          break;
        case 3:
          if (strStartOrEnd == 'start')
          {
            strTimeslot = '01:00';
          }
          else
          {
            strTimeslot = '01:30';
          }
          break;
        case 4:
          if (strStartOrEnd == 'start')
          {
            strTimeslot = '01:30';
          }
          else
          {
            strTimeslot = '02:00';
          }
          break;
        case 5:
          if (strStartOrEnd == 'start')
          {
            strTimeslot = '02:00';
          }
          else
          {
            strTimeslot = '02:30';
          }
          break;
        case 6:
          if (strStartOrEnd == 'start')
          {
            strTimeslot = '02:30';
          }
          else
          {
            strTimeslot = '03:00';
          }
          break;
        case 7:
          if (strStartOrEnd == 'start')
          {
            strTimeslot = '03:00';
          }
          else
          {
            strTimeslot = '03:30';
          }
          break;
        case 8:
          if (strStartOrEnd == 'start')
          {
            strTimeslot = '03:30';
          }
          else
          {
            strTimeslot = '04:00';
          }
          break;
        case 9:
          if (strStartOrEnd == 'start')
          {
            strTimeslot = '04:00';
          }
          else
          {
            strTimeslot = '04:30';
          }
          break;
        case 10:
          if (strStartOrEnd == 'start')
          {
            strTimeslot = '04:30';
          }
          else
          {
            strTimeslot = '05:00';
          }
          break;
        case 11:
          if (strStartOrEnd == 'start')
          {
            strTimeslot = '05:00';
          }
          else
          {
            strTimeslot = '05:30';
          }
          break;
        case 12:
          if (strStartOrEnd == 'start')
          {
            strTimeslot = '05:30';
          }
          else
          {
            strTimeslot = '06:00';
          }
          break;
        case 13:
          if (strStartOrEnd == 'start')
          {
            strTimeslot = '06:00';
          }
          else
          {
            strTimeslot = '06:30';
          }
          break;
        case 14:
          if (strStartOrEnd == 'start')
          {
            strTimeslot = '06:30';
          }
          else
          {
            strTimeslot = '07:00';
          }
          break;
        case 15:
          if (strStartOrEnd == 'start')
          {
            strTimeslot = '07:00';
          }
          else
          {
            strTimeslot = '07:30';
          }
          break;
        case 16:
          if (strStartOrEnd == 'start')
          {
            strTimeslot = '07:30';
          }
          else
          {
            strTimeslot = '08:00';
          }
          break;
		 case 17:
          if (strStartOrEnd == 'start')
          {
            strTimeslot = '08:00';
          }
          else
          {
            strTimeslot = '08:30';
          }
          break;
        case 18:
          if (strStartOrEnd == 'start')
          {
            strTimeslot = '08:30';
          }
          else
          {
            strTimeslot = '09:00';
          }
          break;
        case 19:
          if (strStartOrEnd == 'start')
          {
            strTimeslot = '09:00';
          }
          else
          {
            strTimeslot = '09:30';
          }
          break;
        case 20:
          if (strStartOrEnd == 'start')
          {
            strTimeslot = '09:30';
          }
          else
          {
            strTimeslot = '10:00';
          }
          break;
        case 21:
          if (strStartOrEnd == 'start')
          {
            strTimeslot = '10:00';
          }
          else
          {
            strTimeslot = '10:30';
          }
          break;
        case 22:
          if (strStartOrEnd == 'start')
          {
            strTimeslot = '10:30';
          }
          else
          {
            strTimeslot = '11:00';
          }
          break;
        case 23:
          if (strStartOrEnd == 'start')
          {
            strTimeslot = '11:00';
          }
          else
          {
            strTimeslot = '11:30';
          }
          break;
        case 24:
          if (strStartOrEnd == 'start')
          {
            strTimeslot = '11:30';
          }
          else
          {
            strTimeslot = '12:00';
          }
          break;
		  case 25:
          if (strStartOrEnd == 'start')
          {
            strTimeslot = '12:00';
          }
          else
          {
            strTimeslot = '12:30';
          }
          break;
        case 26:
          if (strStartOrEnd == 'start')
          {
            strTimeslot = '12:30';
          }
          else
          {
            strTimeslot = '13:00';
          }
          break;
        case 27:
          if (strStartOrEnd == 'start')
          {
            strTimeslot = '13:00';
          }
          else
          {
            strTimeslot = '13:30';
          }
          break;
        case 28:
          if (strStartOrEnd == 'start')
          {
            strTimeslot = '13:30';
          }
          else
          {
            strTimeslot = '14:00';
          }
          break;
        case 29:
          if (strStartOrEnd == 'start')
          {
            strTimeslot = '14:00';
          }
          else
          {
            strTimeslot = '14:30';
          }
          break;
        case 30:
          if (strStartOrEnd == 'start')
          {
            strTimeslot = '14:30';
          }
          else
          {
            strTimeslot = '15:00';
          }
          break;
        case 31:
          if (strStartOrEnd == 'start')
          {
            strTimeslot = '15:00';
          }
          else
          {
            strTimeslot = '15:30';
          }
          break;
        case 32:
          if (strStartOrEnd == 'start')
          {
            strTimeslot = '15:30';
          }
          else
          {
            strTimeslot = '16:00';
          }
          break;
        case 33:
          if (strStartOrEnd == 'start')
          {
            strTimeslot = '16:00';
          }
          else
          {
            strTimeslot = '16:30';
          }
          break;
        case 34:
          if (strStartOrEnd == 'start')
          {
            strTimeslot = '16:30';
          }
          else
          {
            strTimeslot = '17:00';
          }
          break;
        case 35:
          if (strStartOrEnd == 'start')
          {
            strTimeslot = '17:00';
          }
          else
          {
            strTimeslot = '17:30';
          }
          break;
        case 36:
          if (strStartOrEnd == 'start')
          {
            strTimeslot = '17:30';
          }
          else
          {
            strTimeslot = '18:00';
          }
          break;
        case 37:
          if (strStartOrEnd == 'start')
          {
            strTimeslot = '18:00';
          }
          else
          {
            strTimeslot = '18:30';
          }
          break;
        case 38:
          if (strStartOrEnd == 'start')
          {
            strTimeslot = '18:30';
          }
          else
          {
            strTimeslot = '19:00';
          }
          break;
        case 39:
          if (strStartOrEnd == 'start')
          {
            strTimeslot = '19:00';
          }
          else
          {
            strTimeslot = '19:30';
          }
          break;
        case 40:
          if (strStartOrEnd == 'start')
          {
            strTimeslot = '19:30';
          }
          else
          {
            strTimeslot = '20:00';
          }
          break;
		 case 41:
          if (strStartOrEnd == 'start')
          {
            strTimeslot = '20:00';
          }
          else
          {
            strTimeslot = '20:30';
          }
          break;
        case 42:
          if (strStartOrEnd == 'start')
          {
            strTimeslot = '20:30';
          }
          else
          {
            strTimeslot = '21:00';
          }
          break;
        case 43:
          if (strStartOrEnd == 'start')
          {
            strTimeslot = '21:00';
          }
          else
          {
            strTimeslot = '21:30';
          }
          break;
        case 44:
          if (strStartOrEnd == 'start')
          {
            strTimeslot = '21:30';
          }
          else
          {
            strTimeslot = '22:00';
          }
          break;
        case 45:
          if (strStartOrEnd == 'start')
          {
            strTimeslot = '22:00';
          }
          else
          {
            strTimeslot = '22:30';
          }
          break;
        case 46:
          if (strStartOrEnd == 'start')
          {
            strTimeslot = '22:30';
          }
          else
          {
            strTimeslot = '23:00';
          }
          break;
        case 47:
          if (strStartOrEnd == 'start')
          {
            strTimeslot = '23:00';
          }
          else
          {
            strTimeslot = '23:30';
          }
          break;
        case 48:
          if (strStartOrEnd == 'start')
          {
            strTimeslot = '23:30';
          }
          else
          {
            strTimeslot = '00:00';
          }
          break;
        default:
          strTimeslot = '';
      }
      return strTimeslot;
    }

    function service_finder_GetSelectedTimeslots(strDay)
    {
      var strTimeslots = '';
      var intLastSelectedTimeslot = -1;
      var strBackgroundColor;
	  var strHasEndClass;
      var intCounter;
      var intNumOfTimeslots = 48;
	  var liId = '';
	  var chkpoint= '';

      intCounter = 1;
      while (intCounter <= intNumOfTimeslots)
      {
        strBackgroundColor = document.getElementById('li' + strDay + intCounter).style.backgroundColor;
		chkpoint = jQuery('#li' + strDay + intCounter).attr('data-point');
		
		if(chkpoint == "endpoint"){
			strHasEndClass = true;
		}else{
			strHasEndClass = false;
		}
        if (strBackgroundColor.substr(0,1) != '#')
        {
          strBackgroundColor = service_finder_GetHexValue(strBackgroundColor);
        }
        if (strBackgroundColor == strColorOn)
        {
          if (intCounter != (intLastSelectedTimeslot + 1) || strHasEndClass)
          {
			if(strHasEndClass){
				strTimeslots = strTimeslots + '-' + service_finder_GetTimeSlotValue(intLastSelectedTimeslot, 'end') + ', ';
				liId = liId + 'li' + strDay + intCounter + ',';
				strTimeslots = strTimeslots + service_finder_GetTimeSlotValue(intCounter, 'start');
				liId = liId + 'li' + strDay + intCounter + '-';
			}else{
				strTimeslots = strTimeslots + service_finder_GetTimeSlotValue(intCounter, 'start');
				liId = liId + 'li' + strDay + intCounter + '-';	
			}
			
          }
		  intLastSelectedTimeslot = intCounter;
		  
        }
        else
        {
          if (intCounter == (intLastSelectedTimeslot + 1))
          {
            strTimeslots = strTimeslots + '-' + service_finder_GetTimeSlotValue(intLastSelectedTimeslot, 'end') + ', ';
			liId = liId + 'li' + strDay + intCounter + ',';
          }
        }
        intCounter++
      }
      if (intLastSelectedTimeslot == intNumOfTimeslots)
      {
        strTimeslots = strTimeslots + '-' + service_finder_GetTimeSlotValue(intLastSelectedTimeslot, 'end') + ', ';
		if(intCounter == 49){
		intCounter = 1;	
		}
		liId = liId + 'li' + strDay + intCounter;
      }
      strTimeslots = strTimeslots.substr(0, (strTimeslots.length - 2));
      if (strTimeslots == '-')
      {
        strTimeslots = '';
      }

      return strTimeslots +'|'+ liId;
    }
	
	function service_finder_make_selected(dayname,from,to){
		  
		  to = parseInt(to) - 1;	
		  
		  while (parseInt(from) <= parseInt(to))
		  {
			jQuery('#li'+dayname+from).css("background-color", strColorOn);
			jQuery('#li'+dayname+from).addClass("disable-slot");	
			if(from == to){
			var newendpoint = parseInt(from) + 1;
			jQuery('#li'+dayname+newendpoint).attr("data-point","endpoint");		
			}
			from++
		  }
	}
	
	function service_finder_avl_slots(intCounter,strDay)
    {
      var intLastSelectedTimeslot = -1;
      var strBackgroundColor;
      var intNumOfTimeslots = 48;
	  var avlslots;
	  intCounter = parseInt(intCounter) + parseInt(1);	
	  
      while (intCounter <= intNumOfTimeslots)
      {
        strBackgroundColor = document.getElementById('li' + strDay + intCounter).style.backgroundColor;
        if (strBackgroundColor.substr(0,1) != '#')
        {
          strBackgroundColor = service_finder_GetHexValue(strBackgroundColor);
        }
        if (strBackgroundColor == strColorOn)
        {
			avlslots = avlslots + '<option value="'+intCounter+'">'+jQuery('#li'+strDay+intCounter).html()+'</option>';
			break;
        }
        else
        {
			avlslots = avlslots + '<option value="'+intCounter+'">'+jQuery('#li'+strDay+intCounter).html()+'</option>';
        }
        intCounter++
      }
      
      return avlslots;
    }

    function ViewSelectedTimeslots(dayname,tabname)
    {
      var strMessage = '';

      strMessage = service_finder_GetSelectedTimeslots(dayname);

	  strMessage = strMessage.split('|');
	  var strMessageSlots = strMessage[0];
	  var strMessageIds = strMessage[1];
	  var arr = strMessageSlots.split(', ');
	  var arrIds = strMessageIds.split(',');
	  
	   switch(tabname)
	   {
			case 'monday':
				 for(x in arr){
				  if(jQuery.inArray(arrIds[x],monarr) > -1){

					  var mindex = jQuery.inArray(arrIds[x],monarr);
				   jQuery('#'+tabname+'-timeslots').find('ul.selected-time').append('<li data-ids="'+arrIds[x]+'"><div class="input-group"><input type="text" class="form-control" value="'+monbookarr[mindex]+'" placeholder="'+param.allowed_booking+'"><div class="input-group-btn"><button type="button" class="btn btn-primary">'+arr[x]+'</button><button type="button" class="btn btn-danger removeSlot"><i class="fa fa-remove"></i></button></div></div></li>');
				  }else{
					  jQuery('#'+tabname+'-timeslots').find('ul.selected-time').append('<li data-ids="'+arrIds[x]+'"><div class="input-group"><input type="text" class="form-control" value="" placeholder="'+param.allowed_booking+'"><div class="input-group-btn"><button type="button" class="btn btn-primary">'+arr[x]+'</button><button type="button" class="btn btn-danger removeSlot"><i class="fa fa-remove"></i></button></div></div></li>');
				}
			  }
			break;
			case 'tuesday':
				
				for(x in arr){
				  if(jQuery.inArray(arrIds[x],tuearr) > -1){
					  var mindex = jQuery.inArray(arrIds[x],tuearr);
				   jQuery('#'+tabname+'-timeslots').find('ul.selected-time').append('<li data-ids="'+arrIds[x]+'"><div class="input-group"><input type="text" class="form-control" value="'+tuebookarr[mindex]+'" placeholder="'+param.allowed_booking+'"><div class="input-group-btn"><button type="button" class="btn btn-primary">'+arr[x]+'</button><button type="button" class="btn btn-danger removeSlot"><i class="fa fa-remove"></i></button></div></div></li>');
				  }else{
					  jQuery('#'+tabname+'-timeslots').find('ul.selected-time').append('<li data-ids="'+arrIds[x]+'"><div class="input-group"><input type="text" class="form-control" value="" placeholder="'+param.allowed_booking+'"><div class="input-group-btn"><button type="button" class="btn btn-primary">'+arr[x]+'</button><button type="button" class="btn btn-danger removeSlot"><i class="fa fa-remove"></i></button></div></div></li>');
				}
			  }
				
			  break;
			case 'wednesday':
				
								for(x in arr){
				  if(jQuery.inArray(arrIds[x],wedarr) > -1){
					  var mindex = jQuery.inArray(arrIds[x],wedarr);
				   jQuery('#'+tabname+'-timeslots').find('ul.selected-time').append('<li data-ids="'+arrIds[x]+'"><div class="input-group"><input type="text" class="form-control" value="'+wedbookarr[mindex]+'" placeholder="'+param.allowed_booking+'"><div class="input-group-btn"><button type="button" class="btn btn-primary">'+arr[x]+'</button><button type="button" class="btn btn-danger removeSlot"><i class="fa fa-remove"></i></button></div></div></li>');
				  }else{
					  jQuery('#'+tabname+'-timeslots').find('ul.selected-time').append('<li data-ids="'+arrIds[x]+'"><div class="input-group"><input type="text" class="form-control" value="" placeholder="'+param.allowed_booking+'"><div class="input-group-btn"><button type="button" class="btn btn-primary">'+arr[x]+'</button><button type="button" class="btn btn-danger removeSlot"><i class="fa fa-remove"></i></button></div></div></li>');
				}
			  }

				
			  break;
			case 'thursday':
				
								for(x in arr){
				  if(jQuery.inArray(arrIds[x],thurarr) > -1){
					  var mindex = jQuery.inArray(arrIds[x],thurarr);
				   jQuery('#'+tabname+'-timeslots').find('ul.selected-time').append('<li data-ids="'+arrIds[x]+'"><div class="input-group"><input type="text" class="form-control" value="'+thubookarr[mindex]+'" placeholder="'+param.allowed_booking+'"><div class="input-group-btn"><button type="button" class="btn btn-primary">'+arr[x]+'</button><button type="button" class="btn btn-danger removeSlot"><i class="fa fa-remove"></i></button></div></div></li>');
				  }else{
					  jQuery('#'+tabname+'-timeslots').find('ul.selected-time').append('<li data-ids="'+arrIds[x]+'"><div class="input-group"><input type="text" class="form-control" value="" placeholder="'+param.allowed_booking+'"><div class="input-group-btn"><button type="button" class="btn btn-primary">'+arr[x]+'</button><button type="button" class="btn btn-danger removeSlot"><i class="fa fa-remove"></i></button></div></div></li>');
				}
			  }

				
			  break;
			case 'friday':
				
								for(x in arr){
				  if(jQuery.inArray(arrIds[x],friarr) > -1){
					  var mindex = jQuery.inArray(arrIds[x],friarr);
				   jQuery('#'+tabname+'-timeslots').find('ul.selected-time').append('<li data-ids="'+arrIds[x]+'"><div class="input-group"><input type="text" class="form-control" value="'+fribookarr[mindex]+'" placeholder="'+param.allowed_booking+'"><div class="input-group-btn"><button type="button" class="btn btn-primary">'+arr[x]+'</button><button type="button" class="btn btn-danger removeSlot"><i class="fa fa-remove"></i></button></div></div></li>');
				  }else{
					  jQuery('#'+tabname+'-timeslots').find('ul.selected-time').append('<li data-ids="'+arrIds[x]+'"><div class="input-group"><input type="text" class="form-control" value="" placeholder="'+param.allowed_booking+'"><div class="input-group-btn"><button type="button" class="btn btn-primary">'+arr[x]+'</button><button type="button" class="btn btn-danger removeSlot"><i class="fa fa-remove"></i></button></div></div></li>');
				}
			  }

				
			  break;
			case 'saturday':
				
								for(x in arr){
				  if(jQuery.inArray(arrIds[x],satarr) > -1){
					  var mindex = jQuery.inArray(arrIds[x],satarr);
				   jQuery('#'+tabname+'-timeslots').find('ul.selected-time').append('<li data-ids="'+arrIds[x]+'"><div class="input-group"><input type="text" class="form-control" value="'+satbookarr[mindex]+'" placeholder="'+param.allowed_booking+'"><div class="input-group-btn"><button type="button" class="btn btn-primary">'+arr[x]+'</button><button type="button" class="btn btn-danger removeSlot"><i class="fa fa-remove"></i></button></div></div></li>');
				  }else{
					  jQuery('#'+tabname+'-timeslots').find('ul.selected-time').append('<li data-ids="'+arrIds[x]+'"><div class="input-group"><input type="text" class="form-control" value="" placeholder="'+param.allowed_booking+'"><div class="input-group-btn"><button type="button" class="btn btn-primary">'+arr[x]+'</button><button type="button" class="btn btn-danger removeSlot"><i class="fa fa-remove"></i></button></div></div></li>');
				}
			  }

				
			  break;
			case 'sunday':
				
							for(x in arr){
				  if(jQuery.inArray(arrIds[x],sunarr) > -1){
					  var mindex = jQuery.inArray(arrIds[x],sunarr);
				   jQuery('#'+tabname+'-timeslots').find('ul.selected-time').append('<li data-ids="'+arrIds[x]+'"><div class="input-group"><input type="text" class="form-control" value="'+sunbookarr[mindex]+'" placeholder="'+param.allowed_booking+'"><div class="input-group-btn"><button type="button" class="btn btn-primary">'+arr[x]+'</button><button type="button" class="btn btn-danger removeSlot"><i class="fa fa-remove"></i></button></div></div></li>');
				  }else{
					  jQuery('#'+tabname+'-timeslots').find('ul.selected-time').append('<li data-ids="'+arrIds[x]+'"><div class="input-group"><input type="text" class="form-control" value="" placeholder="'+param.allowed_booking+'"><div class="input-group-btn"><button type="button" class="btn btn-primary">'+arr[x]+'</button><button type="button" class="btn btn-danger removeSlot"><i class="fa fa-remove"></i></button></div></div></li>');
				}
			  }

				
			  break;
		  }
	  jQuery('#'+tabname+'-timeslots').find('.saveslots').show();

    }
	
  });
  
