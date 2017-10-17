jQuery(document).ready(function($) {
'use strict';

var country = jQuery("#country").val();

var catid = jQuery("#categorysrh").val();

var city = jQuery("#city").val();

service_finder_loadSearchResult('all','',city,catid,country);


/*Call the function for load search results in map as markers*/
function service_finder_loadSearchResult(allproviers,address,city,catid,country){
	
	
	var data = {

		action: "load-markers",

		allproviers: allproviers,

		address: address,

		city: city,

		catid: catid,

		country: country,

	};

		

  var formdata = jQuery.param(data);

  

  jQuery.ajax({



					type: 'POST',



					url: ajaxurl,



					data: formdata,

					

					dataType: "json",
					
					beforeSend: function() {
						
					},



					success:function (data, textStatus) {

						

						if(data['count'] > 0){

						jQuery("#no-result").hide();

							if(data['address'] == "" && data['city'] == "" && data['country'] == ""){

							googlecode_regular_vars.page_custom_zoom = zoomlevel;

							googlecode_regular_vars.general_latitude = defaultlat;

							googlecode_regular_vars.general_longitude = defaultlng;

							}else if(data['address'] != ""){

							googlecode_regular_vars.page_custom_zoom = zoom_level_address;

							googlecode_regular_vars.general_latitude = data['lat'];

							googlecode_regular_vars.general_longitude = data['lng'];

							}else if(data['city'] != ""){

							googlecode_regular_vars.page_custom_zoom = zoom_level_city;

							googlecode_regular_vars.general_latitude = data['lat'];

							googlecode_regular_vars.general_longitude = data['lng'];

							}else if(data['country'] != ""){

							googlecode_regular_vars.page_custom_zoom = zoom_level_country;

							googlecode_regular_vars.general_latitude = data['lat'];

							googlecode_regular_vars.general_longitude = data['lng'];

							}else{

							googlecode_regular_vars.page_custom_zoom = zoomlevel;

							googlecode_regular_vars.general_latitude = defaultlat;

							googlecode_regular_vars.general_longitude = defaultlng;

							}

							

							var  new_markers = jQuery.parseJSON(data['markers']);

							refresh_marker(map, new_markers);

						}else{

							jQuery("#no-result").show();

							if(data['address'] == "" && data['city'] == "" && data['country'] == ""){

							googlecode_regular_vars.page_custom_zoom = zoomlevel;

							googlecode_regular_vars.general_latitude = defaultlat;

							googlecode_regular_vars.general_longitude = defaultlng;

							}else if(data['address'] != ""){

							googlecode_regular_vars.page_custom_zoom = zoom_level_address;

							googlecode_regular_vars.general_latitude = data['lat'];

							googlecode_regular_vars.general_longitude = data['lng'];

							}else if(data['city'] != ""){

							googlecode_regular_vars.page_custom_zoom = zoom_level_city;

							googlecode_regular_vars.general_latitude = data['lat'];

							googlecode_regular_vars.general_longitude = data['lng'];

							}else if(data['country'] != ""){

							googlecode_regular_vars.page_custom_zoom = zoom_level_country;

							googlecode_regular_vars.general_latitude = data['lat'];

							googlecode_regular_vars.general_longitude = data['lng'];

							}else{

							googlecode_regular_vars.page_custom_zoom = zoomlevel;

							googlecode_regular_vars.general_latitude = defaultlat;

							googlecode_regular_vars.general_longitude = defaultlng;

							}

							
							var  new_markers = jQuery.parseJSON(data['markers']);

							refresh_marker(map, new_markers);
							

						}

							initializeSearchMap();

							jQuery('#no-result').hide();

					

					}



				});

   

}


/*Category onchange event*/
jQuery('body').on('change', '#categorysrh', function(){

	var catid = jQuery(this).val();

	var country = jQuery("#country").val();

	var city = jQuery("#city").val();

	service_finder_loadSearchResult('','',city,catid,country);

   

});

/*Country onchange event*/
jQuery('body').on('change', '#country', function(){

	var country = jQuery(this).val();

	var catid = jQuery("#categorysrh").val();

	var data = {
		  "action": "load_cities",
		  "country": country
		};
		
  var formdata = jQuery.param(data);
  
  jQuery.ajax({

					type: 'POST',

					url: ajaxurl,

					data: formdata,
					
					dataType: "json",
					
					success:function (data, textStatus) {
						if(data['status'] == 'success'){
							
							jQuery("select[name='city']").html(data['html']);
							jQuery("select[name='city']").selectpicker('refresh');
						}
					
					}

				});
	

	service_finder_loadSearchResult('','','',catid,country);

   

});

/*City onchange event*/	
jQuery('body').on('change', '#city', function(){

	var city = jQuery(this).val();

	var catid = jQuery("#categorysrh").val();

	var country = jQuery("#country").val();

	service_finder_loadSearchResult('','',city,catid,country);

   

});




/*Autofill address script*/
function service_finder_initAutoComplete(){

var address = document.getElementById('searchAddress');

var my_address = new google.maps.places.Autocomplete(address);



google.maps.event.addListener(my_address, 'place_changed', function() {

var place = my_address.getPlace();



// if no location is found

if (!place.geometry) {

return;

}

var country_long_name = '';

var country_short_name = '';



for(var i=0; i<place.address_components.length; i++){

var address_component = place.address_components[i];

var ty = address_component.types;



for (var k = 0; k < ty.length; k++) {

	if (ty[k] === 'locality' || ty[k] === "sublocality" || ty[k] === "sublocality_level_1"  || ty[k] === 'postal_town') {

		var city = address_component.long_name;

	} else if (ty[k] === "administrative_area_level_1" || ty[k] === "administrative_area_level_2") {

		var state = address_component.long_name;

	} else if(ty[k] === 'country'){

		var country = address_component.long_name;

	}

}

}



var address = jQuery("#searchAddress").val();

var new_address = address.replace(city,"");

new_address = new_address.replace(state,"");



new_address = new_address.replace(country_long_name,"");

new_address = new_address.replace(country_short_name,"");

new_address = jQuery.trim(new_address);





new_address = new_address.replace(/,/g, '');

new_address = new_address.replace(/ +/g," ");

jQuery("#searchAddress").val(address);



var catid = jQuery("#categorysrh").val();
/*Call the search function on page load*/
service_finder_loadSearchResult('',new_address,city,catid,country);

});

}

google.maps.event.addDomListener(window, 'load', service_finder_initAutoComplete);

});