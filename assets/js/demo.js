function initMap(){
	map = new google.maps.Map(document.getElementById('map-home'), {
	  center: {lat: 48.8587741, lng: 2.2074741},
	  zoom: 15,
	  scrollwheel : false
	});

	styles = [
      {
        "featureType": "landscape",
        "stylers": [
          { "visibility": "on" },
          { "color": "#bdc3c7" },
          { "lightness": 60 }
        ]
      },{
        "featureType": "road.highway",
        "stylers": [
          { "visibility": "simplified" },
          { "hue": "#7700ff" },
          { "lightness": 20 }
        ]
      },{
        "featureType": "water",
        "stylers": [
          { "color": "#3498db" },
          { "lightness": 15 },
          { "visibility": "simplified" }
        ]
      },{
        "featureType": "transit",
        "stylers": [
          { "visibility": "simplified" },
          { "hue": "#7700ff" },
          { "saturation": 10 }
        ]
      },{
        "featureType": "poi.park",
        "stylers": [
          { "color": "#59B9B1" }
        ]
      }
    ];
    map.setOptions({styles: styles});
	getLocation();
}

function getLocation(){
	if (navigator.geolocation) {
	  navigator.geolocation.getCurrentPosition(setLocation);
	} else {
	  return false;
	}
}

function setLocation(position){
	var pos = {
		lat: position.coords.latitude,
		lng: position.coords.longitude
	};
	map.setCenter(pos);
	latlng = pos.lat + "," + pos.lng;
	reverseGeocodeLocation(latlng); 
}

function reverseGeocodeLocation(latlng){
	$.getJSON('https://maps.googleapis.com/maps/api/geocode/json', {latlng: latlng}, function(json, textStatus) {
      $('#demo-position').val(json.results[0].formatted_address);
	});
}

function initializeAutocomplete(id){

	var element = document.getElementById(id);
	var option={
	types: ['geocode']
	};
	if (element) {
		var autocomplete = new google.maps.places.Autocomplete(element, option);
		google.maps.event.addListener(autocomplete, 'place_changed', onPlaceChanged)  ;
	}
}

function onPlaceChanged(){
	var place = this.getPlace();
	//console.log(select);
	//console.log(place);  // Uncomment this line to view the full object returned by Google API.
	for (var i in place.address_components) 
	{
		var component = place.address_components[i];
		for (var j in component.types)  // Some types are ["country", "political"]
		{
			var type_element = document.getElementById(component.types[j]);
			if (type_element) 
			{
				type_element.value = component.long_name;
			}
		}
	}
}

 //remove console log
console.log = function() {};

$(window).load(function() {
	initializeAutocomplete('demo-position');
});

$('#submit-home').click(function(event) {
	event.preventDefault();
	filter = $('#demo-filter').val();
	filterID = parseInt(filter);

	if (Number.isInteger(filterID)) {
		$.ajax({
		url: '?module=ajax&action=select-users-signin',
		type: 'POST',
		dataType: 'json',
		data: {filterID: filter},
		})
		.always(function(json) {
			console.log(json);
			console.log("complete");
			$('#demo-result').prepend(json);
			$('#err-back').fadeIn('400', function() {
				$('#err-disp').fadeIn('400');
			});
		});
	}
	
});

$('#err-button').click(function(event) {
	$('#err-container').fadeOut('400', function() {});
});