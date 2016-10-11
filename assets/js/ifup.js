////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//
// Global vars
//
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// Vars

  // currentUser
    // Contient toutes les informations liés à l'utilisateur connecté

    var currentUser = false;

  // Service
    // Contient toutes les informations liés au service en cours

    var service = false;

  // secondUser
    // Contient toutes les informations liés à l'utilisateur connecté

    var secondUser = false;

  // StartDate
    // Date de début du service, lorsque le prestataire est arrivé

    var StartDate = false;

  // StopDate
    // Date de fin du service, lorsque le le client clic sur terminé

    var StopDate = false;

  // Page
    // Page actuelle
    var page = false;

  // Time 
    var d = new Date();
    var time = false;

  // Notif
    var notif = false;

  // Time rate
    var timerate = 0;

  // Map style 
    var styles = [
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

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//
// Functions
//
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// Page 

  function getPage(){
    page = $('#page').val();
    console.log(page);

    if (page == 'index') {
      id = 'map-if';
    } else if (page == 'mode-up') {
      id = 'map-other';
    } else {
      setUserOffline();
      id = "map-other";;
    }
  }

// Geolocation
  function getLocation(){
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(setLocation, logLocationError);
    } else {
      return false;
    }
  }

  function setLocation(position){
    currentUser.glat = position.coords.latitude;
    currentUser.glen = position.coords.longitude;
    console.log('User location lat = ' + currentUser.glat);
    console.log('User location len = ' + currentUser.glen);
    setPos();
    reverseGeocode();
    if (page == 'index') {
      //set online
      setUserOnline();
      currentUser.ifup_user_online = 1;

      //set status
      setUserIffer();
      currentUser.ifup_user_status = 0;
      
      tosend = {"action": "setCurrentUser", "data" : currentUser};
      tosendjson = JSON.stringify(tosend);
      socket.send(tosendjson);
      
    } else if (page == 'mode-up') {
      //set online
      setUserOnline();
      currentUser.ifup_user_online = 1;

      //set status
      setUserUpper();
      currentUser.ifup_user_status = 1;
      
      tosend = {"action": "setCurrentUser", "data" : currentUser};
      tosendjson = JSON.stringify(tosend);
      socket.send(tosendjson);
      
    } else {
      setUserOffline(); 
    }  
  }

  function logLocationError(error) {
    switch(error.code) {
      case error.PERMISSION_DENIED:
        console.log("User denied the request for Geolocation.");
        break;
      case error.POSITION_UNAVAILABLE:
        console.log("Location information is unavailable.");
        break;
      case error.TIMEOUT:
        console.log("The request to get user location timed out.");
        break;
      case error.UNKNOWN_ERROR:
        console.log("An unknown error occurred.");
        break;
    }
  }

  function reverseGeocode(){
    latlng = currentUser.glat + ',' + currentUser.glen;
    $.getJSON('https://maps.googleapis.com/maps/api/geocode/json', {latlng: latlng}, function(json, textStatus) {
          console.log(json.results[0]);
          console.log(json.results[0].formatted_address);
          $('input[name="ifup_service_address"]').val(json.results[0].formatted_address);
    });
  }

// User 
  function getUser(){
    $.getJSON('?module=ajax&action=get-user-connect', {}, function(json, textStatus) {
        currentUser = json;
        console.log(currentUser);
        if (currentUser.ifup_user_firstname != "") {
          getLocation();
        }
    });
  }

  function leavePage(){
    console.log('leavePage init');
    window.onbeforeunload = function (e){
      var message = "Merci d'avoir utilisé IFUP :)",
      e = e || window.event;
      // For IE and Firefox
      if (e) {
        setUserOffline();  
      }

      // For Safari
      setUserOffline();   
    }
  }

  function leavePageIfUp(){
    window.onbeforeunload = function (e) {
      var message = "Merci d'avoir utilisé IFUP :)",
      e = e || window.event;
      // For IE and Firefox
      if(currentUser.ifup_user_status == 0){
        err = "Votre demande à été annulée";
      } else {
        err = "Service annulé";
      }


      data = {
        "ifup_user_id" : currentUser.ifup_user_id,
        "ifup_service_id"  : service.ifup_service_id
      };

      if (e) {
        if(service.ifup_service_id != null) { 
          setUserOffline();
          tosend = {"action": "setOffline", "data": data};
          tosendjson = JSON.stringify(tosend);
          console.log(tosend);
          socket.send(tosendjson);
          err = "Votre demande à été annulée";
          setErr(err);
          return err;
        }
      }

      // For Safari

      if(service.ifup_service_id != null) {
        setUserOffline();        
        err = "Votre demande à été annulée";
        tosend = {"action": "setOffline", "data": data};
        tosendjson = JSON.stringify(tosend);
        console.log(tosend);
        socket.send(tosendjson);
          setErr(err);
        return err;
      }
    };
  }

  function setUserOffline(){
    $.ajax({
      url: '?module=ajax&action=set-user-offline',
      type: 'POST',
      dataType: 'json',
      data: {userID: currentUser.ifup_user_id}
    })
    .always(function(json) {
      console.log("setUserOffline -- " + json);
      currentUser.ifup_user_online = null;
    });
  }

  function setUserOnline(){
    $.ajax({
      url: '?module=ajax&action=set-user-online',
      type: 'POST',
      dataType: 'json',
      data: {userID: currentUser.ifup_user_id},
    })
    .always(function(json) {
      console.log("setUserOnline -- " + json);
      currentUser.ifup_user_online = 1;
    });
  }

  function setUserIffer(){
    $.ajax({
      url: '?module=ajax&action=set-user-iffer',
      type: 'POST',
      dataType: 'json',
      data: {userID: currentUser.ifup_user_id}
    })
    .always(function(json) {
      console.log("setUserIffer -- " + json);
      currentUser.ifup_user_status = 0;
    });
  }

  function setUserUpper(){
    $.ajax({
      url: '?module=ajax&action=set-user-upper',
      type: 'POST',
      dataType: 'json',
      data: {userID: currentUser.ifup_user_id},
    })
    .always(function(json) {
      console.log("setUserUpper -- " + json);
      currentUser.ifup_user_status = 1;
    });
  }

  function selectUserImg(imgid){
    $.ajax({
      url: '?module=ajax&action=select-user-img',
      type: 'POST',
      dataType: 'json',
      data: {imageID: imgid},
    })
    .always(function(json) {
      console.log("selectUserImg -- " + json.ifup_image_id);
      console.log("selectUserImg -- " + json.ifup_image_file);
      $('#span-profil').attr('src', json.ifup_image_file);
    });
  }

// Autocomplete place api
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

  function initializeAutocomplete(id){

    var element = document.getElementById(id);

    var option=
    {
      types: ['geocode']
    };

    if (element) 
    {
      var autocomplete = new google.maps.places.Autocomplete(element, option);
      google.maps.event.addListener(autocomplete, 'place_changed', onPlaceChanged)  ;
    }
  }

// Map 
  function setPos(){
    if (currentUser.glat != "" && currentUser.glen != "") {

      var pos = {
        lat: currentUser.glat,
        lng: currentUser.glen
      };
      console.log(pos);
      map.setCenter(pos);
    } 
  }

  function initMap(){
    getPage(); // Initialise la variable globale page et du mode selon la page

    map = new google.maps.Map(document.getElementById(id), {
      center: {lat: 48.8587741, lng: 2.2074741},
      zoom: 17,
      scrollwheel : false
    });
    map.setOptions({styles: styles});

    getUser();
  }

  function initMapMeet(data){
    var directionsService = new google.maps.DirectionsService;
    var directionsDisplay = new google.maps.DirectionsRenderer;
    map = new google.maps.Map(document.getElementById('map-meet'), {
      center: {lat: 48.9021449, lng: 2.4699208},
      zoom: 12,
      scrollwheel : false
    });
    map.setOptions({styles: styles});
    directionsDisplay.setMap(map);
    orig = data.service.ifup_service_up_lat_len;
    dest = data.service.ifup_service_if_lat_len;
    calculateAndDisplayRoute(directionsService, directionsDisplay, orig, dest);
    distance(orig, dest);
  }

  function calculateAndDisplayRoute(directionsService, directionsDisplay, orig, dest){
    directionsService.route({
      origin: orig,
      destination: dest,
      travelMode: google.maps.TravelMode.DRIVING
    }, function(response, status) {
      if (status === google.maps.DirectionsStatus.OK) {
        directionsDisplay.setDirections(response);
      } else {
        window.alert('Directions request failed due to ' + status);
      }
    });
  }

  function distance(origin,destination){
      var service = new google.maps.DistanceMatrixService();
      service.getDistanceMatrix(
          {
          origins: [origin],
          destinations: [destination],
          travelMode: google.maps.TravelMode.DRIVING,
          durationInTraffic: true
          }, 
          distanceCallback);
  }

  function distanceCallback(response, status){
      if (status == google.maps.DistanceMatrixStatus.OK) 
      {
          var origins      = response.originAddresses;
          var destinations = response.destinationAddresses;

          for (var i = 0; i < origins.length; i++)
          {
              var results = response.rows[i].elements;
              for (var j = 0; j < results.length; j++) 
              {
                var element  = results[j];
                var dist     = element.distance.text;
                var duration = element.duration.text;
                var from     = origins[i];
                var to       = destinations[j];

                console.log(dist + ' - ' + duration);
                $('#span-time').prepend(dist + ' - ' + duration);
              }
          }
      }   
  }

// Test champs

  function testSearch(){
    
    var err = new Array();

    if ($('#ifup_service_filter_id').val() == "") {
      err.push('#ifup_service_filter_id');
    }

    if ($('#ifup_service_address').val() == "") {
      err.push('#ifup_service_address');
    }

    if ($('#ifup_service_message').val() == "") {
      err.push('#ifup_service_message');
    }

    if (currentUser.glat == "") {
      err.push('#link-if');
    }

    return err;
  }

// Service

  function setService(){
    setServiceValues();

    $.getJSON('https://maps.googleapis.com/maps/api/geocode/json', 
      {address: service.ifup_service_address,
       key: 'AIzaSyCjsjm3Uxe0NMzwvv0C3EcfFJ7rv0m68mY'}, 
      function(json, textStatus) {
        if(json.results != "") {
          returnLat = json.results[0].geometry.location.lat;
          returnLng = json.results[0].geometry.location.lng;
          service.ifup_service_if_lat_len = returnLat + ',' + returnLng;
          if(json.results[0].address_components[6] === undefined){
            err = "L'adresse n'est pas valide, saisissez une addresse complète svp (ex. 2 rue Jean, 75001,Paris).";
            setErr(err);
          } else {
            service.ifup_service_district = json.results[0].address_components[6].short_name;
            console.log('Service userIF positon --> ' + service.ifup_service_if_lat_len);
            addService();
          }
        } else {
          //  err
          err = "L'adresse saisie n'est pas valide, ou le service est indisponible, veuillez recommencer svp";
          setErr(err);
        }
    });
  }

  function setServiceValues(){
    service = {};
    service.ifup_service_filter_id = $('#ifup_service_filter_id').val();
    service.ifup_service_address = $('#ifup_service_address').val();
    service.ifup_service_message = $('#ifup_service_message').val();
  }

  function addService(){
    $.ajax({
      url: '?module=ajax&action=add-service',
      type: 'POST',
      dataType: 'json',
      data: {ifup_service_address : service.ifup_service_address,
        ifup_service_message : service.ifup_service_message,
        ifup_service_filter_id : service.ifup_service_filter_id,
        ifup_service_if_lat_len : service.ifup_service_if_lat_len,
        userID : currentUser.ifup_user_id },
    })
    .always(function(json) {
      if(json != 'X_BD000') {
        service.ifup_service_id = json;
        leavePageIfUp();

        console.log(service);
        tosend = {"action": "setService", "data": service};
        console.log(tosend);
        tosendjson = JSON.stringify(tosend);
        socket.send(tosendjson);
        time = d.getTime();
      } else {
        err = "Impossible de créer le service.";
        setErr(err);
      }

    });  
  }

  function setServiceFinish(){
    $.ajax({
      url: '?module=ajax&action=set-service-finish',
      type: 'POST',
      dataType: 'json',
      data: {ifup_service_id: service.ifup_service_id},
    })
    .always(function(json) {
      console.log(json);
      service = new Array();
    });    
  }

  function selectUsersUp(){
    $.ajax({
      url: '?module=ajax&action=select-users-up',
      type: 'POST',
      dataType: 'json',
      data: {ifup_service_id: service.ifup_service_id,
        ifup_service_filter_id: service.ifup_service_filter_id},
    })
    .always(function(json) {
      console.log("complete");
      console.log(json);
    });
  }

// Erreur

  function setErr(err){
    // SetServiceFinish
    if(service.ifup_service_id != null) {
      setServiceFinish();
    }
    // DispErr leavepageIfUp
    setUserOffline();
    errPopUp(err);
    if(currentUser.ifup_user_status == 0) {
      setTimeout(function(){window.location.replace("?module=back");}, 5000);
    } else {
      setTimeout(function(){window.location.replace("?module=back&action=mode-up");}, 5000);
    }   
  }

  function errPopUp(err = "Une erreur inconnue s'est produite."){
    $('#err-container').show();
    $('#err-container').load('view/back/layout/errjs.back.inc.php',
      function(){
      $('#err-msg').prepend(err);
      $('#err-back').fadeIn('slow').promise().done(function(){
        $('#err-disp').fadeIn('slow');
      });
    });
  }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//
// Socket
//
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// Functions
  
  function socketErr(data){
    console.log("Erreur : " + data);
    var err;
    var d = new Date();
    var localtime = d.getTime();
    var compare = localtime - time;
    var disp = 0;

    switch(data) {
      case 'X_BD013':
        if(compare < 600000) {
          tosend = {"action": "setService", "data": service};
          tosendjson = JSON.stringify(tosend);
          setTimeout(function(){socket.send(tosendjson)}, 5000);
        } else {
          err = "Aucun utilisateur en ligne ne correspond à votre demande, réésayer plus tard !";
          disp = 1;
        }
        break;
      case 'X_BD013bis':
          err = "Aucun utilisateur n'est intérréssé par votre demande, réésayer plus tard !";
          disp = 1;
        break;
      case 'X_GMZIP':
        err = "L'adresse n'est pas valide, saisissez une addresse complète svp (ex. 2 rue Jean, 75001,Paris).";
        disp = 1;
        break;
      case 'X_SV000':
        err = "Le service à déjà été accepté par une autre personne, prenez le prochain !";
        disp = 1;
        break;
      case 'X_SV000bis':
        $err = "Le service à déjà été accepté par une autre personne, prenez le prochain !"
        disp = 1;
        break;
      case 'X_BD111':
        err = "Il y a eu un problème, impossible de sélectionner le service.";
        disp = 1;
        break;
      case 'X_BDH10': 
        err = "Le second utilisateur à mis fin au service. Tous les échanges ont été arrétés. Retour au menu principale.";
        disp = 1;
        break;
      case 'X_BD020':
        console.log('X_BD020');
        data = {  
          "ifup_service_id" : service.ifup_service_id,
          "ifup_user_id" : currentUser
        };
        tosend = {"action": "startService", "data": data};
        tosendjson = JSON.stringify(tosend);
        console.log(tosend);
        socket.send(tosendjson);
        break;
    }

    if (disp == 1) {
      setErr(err);
      console.log(err);
    }
  }

  function setCandidates(data){
    console.log('Utilisateurs trouvés : ' + data );
    setTimeout(function(){
      $('#wainting-if .ctr').empty().prepend('Nous avons trouvé '+data+' utilisateur(s) correspondants à votre demande.');
      $('#loading').css('animation-timing-function', 'ease');
    }, 1000);
  }

  function setNotif(data){
    console.log(data);
    
    $('#err-container').load('view/back/layout/notifjs.back.inc.php',
      function(){
      $('#notif-filter').prepend(data['filter']['ifup_filter_name']);
      $('#notif-district').prepend(data['district']['ifup_district_name']);
      $('#notif-address').prepend(data['address']);
      $('#notif-msg').prepend(data['msg']);
      $('#err-container').show();
      $('#err-back').fadeIn('slow').promise().done(function(){
        $('#err-disp').fadeIn('slow');
      });
    });

    notif = {
      "ifup_service_id" : data['serviceID'],
      "user" : currentUser
    };
  }

  function setMeeting(data){
    console.log(data);
    service = data.service;
    filter = data.filter;
    district = data.district;
    if(currentUser.ifup_user_status == 0){
      user = data.userUP;
    } else {
      user = data.userIF;
    } 

    leavePageIfUp();
    
    $('#err-container').fadeOut('slow', function() {
      $('#content-container').load("view/back/meeting.php #meeting", {}, function(){
        $('#span-name').prepend(user.ifup_user_firstname);
        $('#span-msg').prepend(service.ifup_service_message);
        $('#span-filter').prepend(filter.ifup_filter_name);
        $('#span-address').prepend(service.ifup_service_address);
        $('#span-phone').prepend(user.ifup_user_phone);
        if(currentUser.ifup_user_status == 0){
          $('#start-legend').prepend(user.ifup_user_firstname+' est arrivé(e) ?');
          $('#start-button-container').prepend('<a href="#!" class="btn" id="start-button">Appuyez ici pour démarrer !</a>');
        } else {
          $('.links').not($('#link-up')).fadeOut('slow');
          $('#link-cancel').fadeIn();
        }
        initMapMeet(data);
        if(data.userIF.ifup_user_id == currentUser.ifup_user_id) {
          selectUserImg(data.userUP.ifup_user_image_id);
        } else {
          selectUserImg(data.userIF.ifup_user_image_id);
        }
      }); // .done initmap   
    });
  }

  function setCount(data){
    console.log(data);
    userUP = data;
    now = data.now;
    $('#content-container').hide('slow', function() {
      $('#content-container').load('view/back/count.php',{},function(){
          $('#content-container').fadeIn('slow', function() {
          });
          $('#count-tarif').prepend(userUP.ifup_user_time_rate);
          if (currentUser.ifup_user_status == 0){
            $('#count-legend').prepend('Le service est terminé ?');
            $('#count-btn').prepend('<a href="#!" class="btn" id="stop-button">Appuyez ici !</a>');
          }
      });
    });
    var h = 0; // Heure
    var m = 0; // Minute
    var s = 0; // Seconde
    
    temps = setInterval(function(){
      s++;
      if(s > 59){
        m++;
        s = 0;
      }
       
      if(m > 59){
        h++;
        m = 0;
      }
      
      timerateM = (userUP.ifup_user_time_rate / 60)*m;           
      timerateH = userUP.ifup_user_time_rate*h;
      timerate = timerateH + timerateM;
      timerate = Math.round((timerate) * 100) / 100;

      $("#sec").empty().prepend(dchiffre(s));
      $("#min").empty().prepend(dchiffre(m));
      $("#heu").empty().prepend(dchiffre(h));
      $('#count-price').empty().prepend(timerate);       
    },1000);
  }

    function dchiffre(nb){
        if(nb < 10) // si le chiffre indiqué est inférieurs à dix ...
        {
            nb = "0"+nb; // .. on ajoute un zéro devant avant affichage
        }
         
        return nb;
    }

  function setFinish(data){
    if(currentUser.ifup_user_status == 0){
      err = 'Vous devez ' + data.price + '€ à ' + data.firstname + ' pour ce service :) </br> A bientôt !';
    } else {
      err = data.firstname + ' vous doit '+ data.price +'€ pour ce service :) </br> A bientôt !';
    }
    setErr(err);
  }

// Init & Control
  var socket = new WebSocket('ws://dev.etudiant-eemi.com:8000/ifup');

  socket.onmessage = function(e){
    decode = $.parseJSON(e.data);

    action = decode.action;
    data = decode.data;

    if(typeof window[action] == 'function') {
      window[action](data);
    }
  }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//
// Events
//
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

  console.log = function() {}; //remove console log

  $(window).load(function() {
    initializeAutocomplete('ifup_service_address');
    leavePage();
  });

  $("#search").submit(function(event) {

    event.preventDefault();

    console.log('--------------------------------');
    console.log('SEARCH SUBMIT');
    console.log('--------------------------------');

    var err = testSearch();

    if (err == "") {

      $('#mode-ifup').fadeOut('slow', function() {
        $('#content-container').load("view/back/waiting-if.php #wainting-if");
        $('.links').not($('#link-if')).fadeOut('slow');
        $('#link-cancel').fadeIn();
      });

      setService();
      console.log(service);

    } else {
      for (var i = err.length - 1; i >= 0; i--) {
        console.log(err[i]);
        $(err[i]).css('border', '3px solid #e74c3c');
      }
    }
  });

  $('#link-cancel').click(function(event) {
    data = {
      "ifup_user_id" : currentUser.ifup_user_id,
      "ifup_service_id"  : service.ifup_service_id
    };
    tosend = {"action": "setOffline", "data": data};
    tosendjson = JSON.stringify(tosend);
    console.log(tosend);
    socket.send(tosendjson);
    err = "Votre demande à été annulée";
    setErr(err);
  });

  var accepted = 0;
  $(document).on('click', '#notif-accept', function(event) {
    event.preventDefault();
    if (accepted == 0) {
      tosend = {"action": "acceptService", "data": notif};
      tosendjson = JSON.stringify(tosend);
      console.log(tosend);
      socket.send(tosendjson);
      accepted = 1;
    };
  });

  $(document).on('click', '#notif-denie', function(event) {
    event.preventDefault();
    $('#err-container').fadeOut('slow', function() {
      $('#err-container').empty();
    });
    tosend = {"action": "denieService", "data": notif};
    tosendjson = JSON.stringify(tosend);
    console.log(tosend);
    notif = {};
    socket.send(tosendjson);
  });

  $(document).on('click', '#start-button', function(event) {
    event.preventDefault();
    data = {  
    "ifup_service_id" : service.ifup_service_id,
    "ifup_user_id" : currentUser
    };
    
    tosend = {"action": "startService", "data": data};
    tosendjson = JSON.stringify(tosend);
    socket.send(tosendjson);
    console.log(tosend);
  });

  $(document).on('click', '#stop-button', function(event) {
    event.preventDefault();
    data = {
      "ifup_service_id" : service.ifup_service_id,
      "timerate" : timerate,
      "status" : currentUser.ifup_user_status
    };
    tosend = {"action": "stopService", "data": data};
    tosendjson = JSON.stringify(tosend);
    console.log(tosend);
    socket.send(tosendjson);
  });
