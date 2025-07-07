/**
 * @name speciality carousel
 * @function handle carousel tag
 */

$(function() {
  // Handle carousel tag
  var $carousel = $('#speciality_carousel');
  $carousel.slick({
    dots: false,
    infinite: true,
    speed: 500,
    centerMode: true,
    arrows: false,
    autoplay: true,
    autoplaySpeed: 3000,
    slidesToShow: 1,
    slidesToScroll: 1,
    vertical: true
  });
});