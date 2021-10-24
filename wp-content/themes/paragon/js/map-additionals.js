function ZoomControl(controlDiv, map) {

    // Creating divs & styles for custom zoom control
    controlDiv.style.padding = '5px 10px';
    // Set CSS for the control wrapper
    var controlWrapper = document.createElement('div');
    controlDiv.classList.add('zoom-control')
    controlDiv.appendChild(controlWrapper);
    // Set CSS for the zoomIn
    var zoomInButton = document.createElement('div');
    zoomInButton.classList.add('zoomIn')
    controlWrapper.appendChild(zoomInButton);
    // Set CSS for the zoomOut
    var zoomOutButton = document.createElement('div');
    zoomOutButton.classList.add('zoomOut')
    controlWrapper.appendChild(zoomOutButton);
    // Setup the click event listener - zoomIn
    google.maps.event.addDomListener(zoomInButton, 'click', function () {
        map.setZoom(map.getZoom() + 1);
    });
    // Setup the click event listener - zoomOut
    google.maps.event.addDomListener(zoomOutButton, 'click', function () {
        map.setZoom(map.getZoom() - 1);
    });

}
////


function MapArrowsControl(controlDiv, map, lng, lat) {


    let step = 0.001
    zoomChanged = map.getZoom()

    function getStep(zoomChanged){
        switch (zoomChanged) {
            case 0: step = 256;
                break;
            case 1: step = 128;
                break;
            case 2: step = 64;
                break;
            case 3: step = 32;
                break;
            case 4: step = 16;
                break;
            case 5: step = 8;
                break;
            case 6: step = 4;
                break;
            case 7: step = 2;
                break;
            case 8: step = 1;
                break;
            case 9: step = 0.5;
                break;
            case 10: step = 0.25;
                break;
            case 11: step = 0.12;
                break;
            case 12: step = 0.06;
                break;
            case 13: step = 0.03;
                break;
            case 14: step = 0.015;
                break;
            case 15: step = 0.007;
                break;
            case 16: step = 0.003;
                break;
            case 17: step = 0.001;
                break;
            case 18: step = 0.001;
                break;
            default: step =0.001

        }
        return step
    }
    step = getStep(zoomChanged)


    map.addListener('zoom_changed',()=>{

        zoomChanged = map.getZoom()
        step = getStep(zoomChanged)
        //console.log('step='+ step +" zoom = "+map.getZoom())

    })

    let g = map.getCenter()
    let flag_left = true;
    let flag_right = true;
    let flag_up = true;
    let flag_down = true;
    ////////////// left //////////////////
    const left = document.createElement("div");
    left.classList.add("left-arrow-map");
    left.title = "go left";
    controlDiv.appendChild(left);
    ////////////// right //////////////////
    const right = document.createElement("div");
    right.classList.add("right-arrow-map");
    right.title = "go right";
    controlDiv.appendChild(right);
    ////////////// up //////////////////
    const up = document.createElement("div");
    up.classList.add("up-arrow-map");
    up.title = "go up";
    controlDiv.appendChild(up);
    ////////////// down //////////////////
    const down = document.createElement("div");
    down.classList.add("down-arrow-map");
    down.title = "go down";
    controlDiv.appendChild(down);
    /////////////////////////////////////////

    // Setup the click event listeners: simply set the map to Chicago.
    left.addEventListener("mousedown", go_left);
    left.addEventListener("mouseup", () => {
        flag_left = false;
    });
    right.addEventListener("mousedown", go_right);
    right.addEventListener("mouseup", () => {
        flag_right = false;
    });
    up.addEventListener("mousedown", go_up);
    up.addEventListener("mouseup", () => {
        flag_up = false;
    });
    down.addEventListener("mousedown", go_down);
    down.addEventListener("mouseup", () => {
        flag_down = false;
    });

    function go_left() {
        g = map.getCenter()
        lat = g.lat()
        lng = g.lng()
        lng = lng - step;
        start_point = {lat: lat, lng: lng};
        setTimeout(() => {
            map.setCenter(start_point);
            if (flag_left === true) {
                go_left();
            } else {
                flag_left = true;
                return;
            }
        }, 100);
    }

    function go_right() {
        g = map.getCenter()
        lat = g.lat()
        lng = g.lng()
        lng = lng + step;
        start_point = {lat: lat, lng: lng};
        setTimeout(() => {
            map.setCenter(start_point);
            if (flag_right === true) {
                go_right();
            } else {
                flag_right = true;
                return;
            }
        }, 100);
    }

    function go_up() {
        g = map.getCenter()
        lat = g.lat()
        lng = g.lng()
        lat = lat + step;
        start_point = {lat: lat, lng: lng};
        setTimeout(() => {
            map.setCenter(start_point);
            if (flag_up === true) {
                go_up();
            } else {
                flag_up = true;
                return;
            }
        }, 100);
    }

    function go_down() {
        g = map.getCenter()
        lat = g.lat()
        lng = g.lng()
        lat = lat - step;
        start_point = {lat: lat, lng: lng};
        setTimeout(() => {
            map.setCenter(start_point);
            if (flag_down === true) {
                go_down();
            } else {
                flag_down = true;
                return;
            }
        }, 100);
    }

}

///
//add to init_map function
//////////// arrows left-right-up-down
// const MapArrowsControlDiv = document.createElement("div");
// MapArrowsControlDiv.classList.add('map-arrows')
// MapArrowsControl(MapArrowsControlDiv, map, lng, lat);
// map.controls[google.maps.ControlPosition.RIGHT_BOTTOM].push(MapArrowsControlDiv);
// /////////// zoom control
// const zoomControlDiv = document.createElement('div');
// ZoomControl(zoomControlDiv, map);
// zoomControlDiv.index = 1;
// map.controls[google.maps.ControlPosition.LEFT_BOTTOM].push(zoomControlDiv);

//and to const map
// panControl: false,
//     zoomControl: false,
//     scaleControl: false,

// get lng&&lat from address
// adress = 'Lynnwood, WA, 2709 Lincoln Way'
// fetch(`https://maps.google.com/maps/api/geocode/json?address=${adress}&key=KEY`)
//     .then(response => response.json())
//     .then((commits) => {
//         let coordinates = commits.results[0].geometry.location
//         let latitude = coordinates.lat
//         let longitude = coordinates.lng
//         console.log("lat = "+latitude +" | lng = "+longitude)
//     });