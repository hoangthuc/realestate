jQuery(document).ready(function($) {
  // The slider being synced must be initialized first
  $('#realty_carousel').flexslider({
    animation: "slide",
    controlNav: false,
    animationLoop: false,
    slideshow: false,
    itemWidth: 100,
    itemMargin: 15,
    asNavFor: '#realty_slider'
  });
 
  $('#realty_slider').flexslider({
    animation: "slide",
    controlNav: false,
    animationLoop: false,
    slideshow: false,
    sync: "#realty_carousel"
  });
});