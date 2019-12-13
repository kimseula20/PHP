<!DOCTYPE html>
<html>
<head>
    <title>mylocation</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <style>
        #map {height: 100%;}
        html, body {height: 100%;margin: 0;padding: 0;}
        #floating-panel {
            position: absolute;
            top: 10px;
            left: 25%;
            z-index: 5;
            background-color: #fff;
            padding: 5px;
            border: 1px solid #999;
            text-align: center;
            font-family: 'Roboto','sans-serif';
            line-height: 30px;
            padding-left: 10px;
        }
    </style>
    <script>
        window.onload = function(){
            initMap();
        }
    </script>
</head>
<body>
<div id="floating-panel">
    <b>이동수단: </b>
    <select id="mode">
        <option value="DRIVING">자가용</option>
        <option value="WALKING">도보</option>
        <option value="BICYCLING">자전거</option>
        <option value="TRANSIT">대중교통</option>
    </select>
</div>
<div id="map"></div>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDN1yp-gFxigWRMfq2jLA4bP5f8z-s1jNI"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<!--<input type="hidden" value="" id="loc_lat"/>-->
<!--<input type="hidden" value="" id="loc_lng"/>-->
<script>
    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: 37.564756, lng: 126.9753673}, //서울시청
            zoom: 16
        });
        infoWindow = new google.maps.InfoWindow;
        if(navigator.geolocation){
            navigator.geolocation.getCurrentPosition(function(position) {
                var pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };
                infoWindow.open(map);
                // $("#loc_lat").val(pos.lat);
                // $("#loc_lng").val(pos.lng);

                $.ajax({
                    type:"POST",
                    url:"querylocation.php",
                    data:{LAT:position.coords.latitude,
                        LNG:position.coords.longitude},
                    dataType:"json",
                    async:false,
                    success: function(data){
                        console.log(data);
                        navigator.geolocation.getCurrentPosition(function(position) {
                            var pos = {
                                lat: position.coords.latitude,
                                lng: position.coords.longitude
                            };
                            infoWindow.setPosition(pos);
                            infoWindow.setContent('현재 내 위치');
                            infoWindow.open(map);
                            map.setCenter(pos);
                            // $.each(data, function(i){
                            //     console.log(data[i].tname);
                            // });
                        });
                        map = new google.maps.Map(document.getElementById('map'), {
                            center: pos,
                            zoom: 16
                        });
                        var div = document.getElementById("marker");
                        mymarker = new google.maps.Marker({
                            map:map,
                            position:map.getCenter(),
                            content:div
                        });
                        mymarker.setMap(map);
                        // 마커 생성
                        for (var index in data) addMarker(data[index]);

                        function addMarker(data) {
                            var marker = new google.maps.Marker({
                                position: new google.maps.LatLng(data.lat, data.lng),
                                map: map
                            });
                            if(data.newaddr===""){
                                var addr = data.addr;
                            }
                            else{
                                var addr = data.newaddr;
                            }
                            var contentString =
                                "타입 : "+data.toilettype+'<br>'+
                                "이름 : "+data.tname+'<br>'+
                                "개방시간 : "+data.opentime+'<br>'+
                                "주소 : "+addr+'<br>'+
                                '<button onclick="direction(\'' + data.num +'\')">길 안내하기</button>';
                            var infowindow = new google.maps.InfoWindow({ content: contentString});
                            google.maps.event.addListener(marker, "click", function() {
                                infowindow.open(map,marker);
                            });
                        }
                    }, error:function(xhr){
                        console.log(xhr.responseText);
                        return;
                    }
                });
            });
        }else {
            handleLocationError(false, infoWindow, map.getCenter());
            alert('해당 브라우져는 위치정보를 제공하지 않습니다.');
        }
    }
    function direction(data){
        navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };
            var directionsRenderer = new google.maps.DirectionsRenderer;
            var directionsService = new google.maps.DirectionsService;
            var map = new google.maps.Map(document.getElementById('map'),{
                zoom: 16,
                center: pos
            });
            directionsRenderer.setMap(map);
            calculateAndDisplayRoute(directionsService, directionsRenderer,pos,data);
            // document.getElementById('mode').addEventListener('change', function() {
            //     calculateAndDisplayRoute(directionsService, directionsRenderer,pos,data);
            // });
        });
    }
    function calculateAndDisplayRoute(directionsService, directionsRenderer,pos,data) {
        console.log(data);
        $.ajax({
            type: "POST",
            url: "querydirection.php",
            data: {num: data},
            dataType: "json",
            async:false,
            success: function (data) {
                console.log(data);
                var selectedMode = document.getElementById('mode').value;
                directionsService.route({
                    origin: pos,
                    destination: data,
                    travelMode: google.maps.TravelMode[selectedMode]
                }, function (response, status) {
                    if (status == 'OK') {
                        directionsRenderer.setDirections(response);
                    } else {
                        window.alert('Directions request failed due to ' + status);
                    }
                });
            }, error: function (xhr) {
                console.log(xhr.responseText);
                return;
            }
        });
    }
</script>
</body>
</html>