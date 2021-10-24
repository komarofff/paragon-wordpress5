$('.slider').slick({
    // infinite: true,
    // dots: true,
    // slidesToShow: 1,
    // slidesToScroll: 1

    infinite: true,
    dots: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    touchMove: true,
    swipeToSlide: true,
    arrows: true,
    prevArrow: '<span class="arrow-prev"> <svg width="17" height="8" viewBox="0 0 17 8" fill="none" xmlns="http://www.w3.org/2000/svg">\n' +
        '<path d="M0.646446 3.64645C0.451185 3.84171 0.451185 4.15829 0.646446 4.35355L3.82843 7.53553C4.02369 7.7308 4.34027 7.7308 4.53553 7.53553C4.7308 7.34027 4.7308 7.02369 4.53553 6.82843L1.70711 4L4.53553 1.17157C4.7308 0.976311 4.7308 0.659728 4.53553 0.464466C4.34027 0.269204 4.02369 0.269204 3.82843 0.464466L0.646446 3.64645ZM17 3.5L1 3.5V4.5L17 4.5V3.5Z" fill="black"/>\n' +
        '</svg>\n </span>',
    nextArrow: '<span class="arrow-next"> <svg width="17" height="8" viewBox="0 0 17 8" fill="none" xmlns="http://www.w3.org/2000/svg">\n' +
        '<path d="M16.3536 4.35355C16.5488 4.15829 16.5488 3.84171 16.3536 3.64645L13.1716 0.464466C12.9763 0.269204 12.6597 0.269204 12.4645 0.464466C12.2692 0.659728 12.2692 0.976311 12.4645 1.17157L15.2929 4L12.4645 6.82843C12.2692 7.02369 12.2692 7.34027 12.4645 7.53553C12.6597 7.7308 12.9763 7.7308 13.1716 7.53553L16.3536 4.35355ZM0 4.5H16V3.5H0V4.5Z" fill="black"/>\n' +
        '</svg>\n </span>',
    responsive: [{
        breakpoint: 768,
        settings: {
            //  centerMode: true,
            // infinite: false,
            slidesToShow: 1.08,
            slidesToScroll: 1,
            arrows: false,
            dots: false
        }
    }]
});