function initMap() {
    var myLatLng = {lat: 23.8151, lng: 90.4255};

    var map = new google.maps.Map(document.getElementById('map'), {
      zoom:18,
      center: myLatLng
    });

    var marker = new google.maps.Marker({
      position: myLatLng,
      map: map,
      title: 'North South University!'
    });
  }
