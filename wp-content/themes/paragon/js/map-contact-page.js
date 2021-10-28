

let zoom = 19

function initMap() {
    let lat = 47.609799
    let lng = -122.331989
    let div = "<h5>Paragon Real Estate Advisors</h5>600 University St, Suite 2018. </br>Seattle, WA 98101<br>T: 206 623-8880<br>F: 206 623-7435";
    let icon_image = "http://paragon.vasterra.com/wp-content/uploads/2021/10/marker-image.png"

    const center = {lat: lat, lng: lng}

    const map = new google.maps.Map(document.getElementById("map"), {
        zoom: zoom,
        center: center,
        panControl: false,
        zoomControl: false,
        scaleControl: false,
        streetViewControl: true,
        streetViewControlOptions: {
            position: google.maps.ControlPosition.LEFT_CENTER,
        }
       // disableDefaultUI: true
    });
    const contentString = `<div>${div}</div>`;
    const infowindow = new google.maps.InfoWindow({
        content: contentString,
    });


    const marker = new google.maps.Marker({
        position: center,
        map,
        title: "Paragon Real Estate Advisors",
        icon: icon_image
    });
    infowindow.open({
        anchor: marker,
        map,
        shouldFocus: false,
    });
    marker.addListener("click", () => {
        infowindow.open({
            anchor: marker,
            map,
            shouldFocus: false,
        });
    });


    //////////// arrows left-right-up-down
    const MapArrowsControlDiv = document.createElement("div");
    MapArrowsControlDiv.classList.add("map-arrows")
    MapArrowsControl(MapArrowsControlDiv, map, lng, lat);
    map.controls[google.maps.ControlPosition.RIGHT_BOTTOM].push(MapArrowsControlDiv);
    /////////// zoom control
    const zoomControlDiv = document.createElement("div");
    ZoomControl(zoomControlDiv, map);
    zoomControlDiv.index = 1;
    map.controls[google.maps.ControlPosition.RIGHT_CENTER].push(zoomControlDiv);


}

const inputs = document.querySelectorAll('.wpcf7-form-control')
inputs.forEach((val) => {
    val.removeAttribute('size')
    val.removeAttribute('cols')
})

//////////////////////////////////
