<?php


?>
<!DOCTYPE html>
<html>
<body>

<p id="demo">Click the button to save your position in the Database.</p>
GebruikerId<input id="gebruikerId" type="number" value="1" />
<button onclick="getLocation()">Just click it</button>
<label id="lat"></label>
<label id="lon"></label>

<div id="mapholder"></div>
<div id="response"></div>

<script type="text/javascript">
        var x = document.getElementById("demo");

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition, showError);
                updateUserInDb();
            } else {
                x.innerHTML = "Geolocation is not supported by this browser.";
            }
        }

        function updateUserInDb() {
            alert( document.getElementById("gebruikerId").value + " " + document.getElementById("lat").innerHTML + " " + document.getElementById("lon").innerHTML)
            var request = new Request("http://localhost/public/index.php/gebruiker/geolocationSave/", {
                method: 'POST',
                mode: 'no-cors',
                redirect: 'follow',
                headers: new Headers({
                    'Content-Type': 'application/json'
                }),
                body: JSON.stringify({
                    id: document.getElementById("gebruikerId").value,
                    lat: document.getElementById("lat").textContent,
                    lon: document.getElementById("lon").textContent
                })
            });

            fetch(request).then(function (response) {
                return response.json();
            }).then(function (response) {
                document.getElementById("response").innerHTML = "Good job";
            });
        }

        function showPosition(position) {
            var latlon = position.coords.latitude + "," + position.coords.longitude;

            var img_url = "https://maps.googleapis.com/maps/api/staticmap?center="
                + latlon + "&zoom=14&size=400x300&sensor=false&key=AIzaSyCbRiLdC9i5nAI-3nmp5oZS-extoa4sHYM";
            document.getElementById("mapholder").innerHTML = "<img src='" + img_url + "'>";
            document.getElementById("lat").innerHTML = position.coords.latitude + "";
            document.getElementById("lon").innerHTML = position.coords.longitude + "";
        }

        //To use this code on your website, get a free API key from Google.
        //Read more at: https://www.w3schools.com/graphics/google_maps_basic.asp

        function showError(error) {
            switch (error.code) {
                case error.PERMISSION_DENIED:
                    x.innerHTML = "User denied the request for Geolocation."
                    break;
                case error.POSITION_UNAVAILABLE:
                    x.innerHTML = "Location information is unavailable."
                    break;
                case error.TIMEOUT:
                    x.innerHTML = "The request to get user location timed out."
                    break;
                case error.UNKNOWN_ERROR:
                    x.innerHTML = "An unknown error occurred."
                    break;
            }
        }
</script>

</body>
</html>

