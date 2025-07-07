/**
 * @name services carouses
 * @function handle slick carousel for services lit
 */

$(document).ready(function(){
  var $carousel = $('#facilities_carousel');
  // Slick go to the last slide
  if ($("html").attr("dir") === "rtl") {
    var lastSlide = Math.floor($carousel.data('length') - 2)
    setTimeout(function() {
      $carousel.slick('slickGoTo', lastSlide);
    }, 100);
  }

  // slick carousel config
  $carousel.slick({
    dots: false,
    infinite: false,
    speed: 500,
    slidesToShow: 4,
    arrows: false,
    slidesToScroll: 1,
    variableWidth: true,
    responsive: [
      {
        breakpoint: 800,
        settings: {
          slidesToShow: 2
        }
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 1
        }
      }
    ]
  });
  
  // Fade effect
  var sliderArt = $('#art_facilities');
  $carousel.on('afterChange', function(slick, currentSlide){
    if (currentSlide.currentSlide >= 1) {
      sliderArt.addClass('faded');
    } else {
      sliderArt.removeClass('faded');
    }
  });

  // Handle slick navigation
  $('#prev_facility').click(function() {
    $carousel.slick('slickPrev');
  });
  $('#next_facility').click(function() {
    $carousel.slick('slickNext');
  });
})