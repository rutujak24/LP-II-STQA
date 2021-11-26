<?php


require_once 'header.php';

echo"<br><hr><marquee> <h1>ABOUT US<h1> </marquee><hr> <br>"



?>
<!--
<!doctype html>
<html ng-app>
  <head>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.7.9/angular.min.js"></script>
  </head>
  <body>
    <div>
      <label>Name:</label>
      <input type="text" ng-model="yourName" placeholder="Enter a name here">
      <hr>
      <h1>Hello {{yourName}}!</h1>
    </div>
  </body>
</html>
-->

<html>
<head>
    <title>ABOUT US</title>
	</head>
<body>

  
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.9/angular.min.js"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAkQjxWU8p4gWSHrq_o4z0_KXatE2nRYIA"></script>
    <script type="text/javascript">
        var app = angular.module('MyApp', [])
        app.controller('MyController', function ($scope) {
            $scope.Markers = [
            {
                "title": 'La Piccola Italia - Deccan',
                "lat": '18.520493',
                "lng": '73.8414',
                "description": 'Straight from the heart of Sicily, here in Pune city.'
            },
            {
                "title": 'La Piccola Italia - Wakad',
                "lat": '18.6028',
                "lng": '73.75',
                "description": 'Our most lively branch close to the Mumbai-Pune highway'
            },
            {
                "title": 'La Piccola Italia - Vimannagar',
                "lat": '18.556',
                "lng": '73.899',
                "description": 'New branch opened near to the Pune airport'
            }
           ];
 
            //Setting the Map options.
            $scope.MapOptions = {
                center: new google.maps.LatLng($scope.Markers[0].lat, $scope.Markers[0].lng),
                zoom: 10,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
 
            //Initializing the InfoWindow, Map and LatLngBounds objects.
            $scope.InfoWindow = new google.maps.InfoWindow();
            $scope.Latlngbounds = new google.maps.LatLngBounds();
            $scope.Map = new google.maps.Map(document.getElementById("dvMap"), $scope.MapOptions);
 
            //Looping through the Array and adding Markers.
            for (var i = 0; i < $scope.Markers.length; i++) {
                var data = $scope.Markers[i];
                var myLatlng = new google.maps.LatLng(data.lat, data.lng);
 
                //Initializing the Marker object.
                var marker = new google.maps.Marker({
                    position: myLatlng,
                    map: $scope.Map,
                    title: data.title
                });
 
                //Adding InfoWindow to the Marker.
                (function (marker, data) {
                    google.maps.event.addListener(marker, "click", function (e) {
                        $scope.InfoWindow.setContent("<div style = 'width:200px;min-height:40px'>" + data.description + "</div>");
                        $scope.InfoWindow.open($scope.Map, marker);
                    });
                })(marker, data);
 
                //Plotting the Marker on the Map.
                $scope.Latlngbounds.extend(marker.position);
            }
 
            //Adjusting the Map for best display.
            $scope.Map.setCenter($scope.Latlngbounds.getCenter());
            $scope.Map.fitBounds($scope.Latlngbounds);
        });
    </script>
    <div ng-app="MyApp" ng-controller="MyController" align="center">
         
		 
		 <div id="aboutText">
		 
	<p style="font-family: bookman">	 <h1>La Piccola Italia</h1> was founded in 1958 in Wichita, Kansas by Dan and Frank Carney. Our company is known for its Italian American cuisine menu, including pizza and pasta, as well as side dishes and desserts. We have 18,703 restaurants worldwide as of December 31, 2019, making us the world's largest pizza chain in terms of locations.

    Pizza Hut is split into several different restaurant formats: the original family-style dine-in locations; storefront delivery and carry-out locations; and hybrid locations that have carry-out, delivery, and dine-in options. Some full-size Pizza Hut locations have a lunch buffet, with "all-you-can-eat" pizza, salad, desserts, and breadsticks, and a pasta bar. Pizza Hut has other business concepts independent of the store type.

    In June 1996, Pizza Hut made its foray into India with a restaurant in Bangalore and was the first international restaurant chain to pioneer this category. The restaurant brand offers an exciting menu consisting of its signature pizzas, appetizers, pastas, desserts and beverages. Its trademark dining experience has been recognized by Brand Equity to make it the ‘Most Trusted Food Service Brand’ for 11 years in a row. Pizza Hut is the most preferred pizza brand in India, given its freshest, tastiest and affordable Pizzas.

    From day one, the Carney brothers could look their customers in the eye and promise them the finest pizza in town — because they knew the farmers who grew the ingredients, and they knew those farmers cared about quality. Since then, our farmers have grown right alongside us, and the ingredients we use are still our highest priority. No one loves pizza more than Pizza Hut. That’s why pizza is in our name — and always will be.

    At Pizza Hut, we don’t just make pizza. We make people happy. Pizza Hut was built on the belief that pizza night should be special, and we carry that belief into everything we do. With more than 55 years of experience under our belts, we understand how to best serve our customers through tried and true service principles: We create food we’re proud to serve and deliver it fast, with a smile.

    There’s nothing cookie-cutter about Pizza Hut. Not our pizzas. Not our people. And definitely not the way we live life. Around here, we don’t settle for anything less than food we’re proud to serve. And we don’t just clock in. Not when we can also become our best, make friends, and have fun while we’re at it. We’re the pizza company that lives life unboxed. 
		 </p>
		 </div>
		 
		 <div id="dvMap"  style="width: 400px; height: 400px">
         </div>
    </div>

	
	
</body>
</html>