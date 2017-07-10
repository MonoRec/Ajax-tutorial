<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        #entry {
            margin: 2em 1em;
        }

        #location {
            margin: 1em;
        }
    </style>
</head>
<body>
<?php echo "Welcome"; ?>

<div id="main">
    This is the original text when the page first loads.
</div>
<button id="ajax_button" type="button"> Update content with Ajax</button>

<div id="entry">
    Zip code: <input id="zipcode" type="text" name="zipcode"/>
    <button id="ajax_button_2" type="button"> Submit</button>
</div>

<div id="location">

</div>
</body>
</html>

<script>

    var api = 'https://maps.googleapis.com/maps/api/geocode/json';

    function findLocation() {

        var zipcode = document.getElementById("zipcode");
        var location = document.getElementById("location");
        var url = api + '?address=' + zipcode.value;
        var xhr = new XMLHttpRequest();

        xhr.open('GET', url, true);
        xhr.onreadystatechange = function () {
            console.log("readyState: " + xhr.readyState);
            if (xhr.readyState < 4) {
                showLoading();
            }
            if (xhr.readyState == 4 && xhr.status == 200) {
                outputLocation(xhr.responseText);
            }
        };
        xhr.send();
    }

    function showLoading() {
        var target = document.getElementById('location');
        target.innerHTML = "Loading ......";
    }

    function outputLocation(data) {
        var target = document.getElementById('location');
        var json = JSON.parse(data);
        console.log(data);
        var address = json.results[0].formatted_address;
        target.innerHTML = address;
    }

    var button = document.getElementById("ajax_button_2");
    button.addEventListener("click", findLocation);


    function replaceText() {
        var target = document.getElementById("main");
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'new_content.txt', true);
        xhr.onreadystatechange = function () {
            console.log("readyState: " + xhr.readyState);
            if (xhr.readyState == 2) {
                target.innerHTML = 'Loading ....';
            }
            if (xhr.readyState == 4 && xhr.status == 200) {
                target.innerHTML = xhr.responseText;
            }
        };
        xhr.send();
    }
    var button = document.getElementById("ajax_button");
    button.addEventListener("click", replaceText);

</script>
