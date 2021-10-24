if (window.location.pathname == '/') {
  var scrollTop
  var header = document.getElementById('header')
  window.addEventListener('scroll', function () {
    scrollTop = window.pageYOffset || document.documentElement.scrollTop
    if (scrollTop > 10) {
      header.classList.add('bg-white')
      header.classList.add('border-bottom')
    } else {
      header.classList.remove('bg-white')
      header.classList.remove('border-bottom')
    }
  })
}

jQuery(document).ready(function ($) {
  if (location.hash == '#home_properties') {
    var sectionProperties = $('.home_section_properties')
    var hHeder = $('header').height()
    $('html, body').animate(
      {
        scrollTop: sectionProperties.offset().top - hHeder,
      },
      300
    )
  }
})
