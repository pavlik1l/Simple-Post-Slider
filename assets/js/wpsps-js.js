jQuery(document).ready(function($) {
    $('.slider-wpsps').slick({
      autoplay: true,
      autoplaySpeed: 6000,
      fade: true,
      infinite: true,
      slidesToShow: 1,
      arrows: false,
      dots: true,
      pauseOnFocus: false,
      pauseOnHover: false,
      slidesToScroll: 1
    });
});