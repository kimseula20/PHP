<!DOCTYPE html>
<html>
<head>
    <title>searchlocation</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <style>
        #map {height: 100%;}
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
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
        window.onload = function(){initMap();}
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDN1yp-gFxigWRMfq2jLA4bP5f8z-s1jNI"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
</head>
<body>
<div id="floating-panel">
    <input id="addr1" type="textbox" value="" name="address">
    <input id="submit" name="submit" type="submit" value="검색하기"  />
</div>
<div id="map"></div>
<script>
    var map;
    var marker =[];
    var geocoder;
    var geocodemarker = [];
    var GreenIcon = new google.maps.MarkerImage(
        "http://labs.google.com/ridefinder/images/mm_20_green.png",
        new google.maps.Size(15, 25),
        new google.maps.Point(0, 0),
        new google.maps.Point(6, 20));
    // 녹색 마커 아이콘을 정의하는 부분
    function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
            zoom: 17,
            center: {lat: 37.566535, lng: 126.97796919}
        });
        var geocoder = new google.maps.Geocoder();
        document.getElementById('submit').addEventListener('click', function() {
            codeAddress(geocoder);
        });
    }

    function Setmarker(latLng) {
        if (marker.length > 0) {
            marker[0].setMap(null);
        }
        marker = [];
        marker.length = 0;
        marker.push(new google.maps.Marker({
            position: latLng,
            map: map
        }));
    }

    function codeAddress(geocoder) {
        if (geocodemarker.length > 0) {
            for (var i=0;i<geocodemarker.length ;i++ ) {
                geocodemarker[i].setMap(null);
            }
            geocodemarker =[];
            geocodemarker.length = 0;
        }
        var address = document.getElementById("addr1").value;

        geocoder.geocode( {'address': address}, function(results, status) {
            // console.log("results : "+results);
            // console.log("status : "+status);
            // console.log(typeof results[0].geometry.location.lat()+": "+results[0].geometry.location.lat());
            // console.log(typeof results[0].geometry.location.lng()+": "+results[0].geometry.location.lng());
            var infoWindow = new google.maps.InfoWindow();
            if (status == google.maps.GeocoderStatus.OK){
                for(var i=0;i<results.length;i++){
                    map.setCenter(results[i].geometry.location);
                    geocodemarker.push(new google.maps.Marker({
                        center: results[i].geometry.location,
                        position: results[i].geometry.location,
                        icon: GreenIcon,
                        map: map,
                    }));
                }
                $.ajax({
                    type:"POST",
                    url:"dbcon.php",
                    data:{LAT:results[0].geometry.location.lat(),
                        LNG:results[0].geometry.location.lng()},
                    dataType:"json",
                    success: function(data){
                        var pos = {
                            lat: results[0].geometry.location.lat(),
                            lng: results[0].geometry.location.lng()
                        };
                        infoWindow.setPosition(pos);
                        infoWindow.setContent('검색한 위치 : '+address);
                        infoWindow.open(map);
                        map.setCenter(pos);
                        console.log(data);
                        $.each(data, function(i){
                            console.log(data[i].tname);
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
                        mymarker.setMap(map,infoWindow);
                        infoWindow.open(map, mymarker);
                        for (var index in data) addMarker(data[index]);

                        function addMarker(data) {
                            var marker = new google.maps.Marker({
                                position: new google.maps.LatLng(data.lat, data.lng),
                                map: map
                            });
                            if(data.newaddr===""){var addr = data.addr;} else{var addr = data.newaddr;}
                            var contentString = "타입 : "+data.toilettype+'<br>'+"이름 : "+data.tname+'<br>'+"개방시간 : "+data.opentime+'<br>'+"주소 : "+addr;
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
            }
            else {
                alert("Geocode was not successful for the following reason: " + status);
            }
        });
    }
</script>
</body>
</html>