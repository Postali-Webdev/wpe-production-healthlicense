jQuery('#menu-icon').click(function(e){
    e.preventDefault();
    jQuery('#mobile-nav').slideToggle(200);
    // Change this boolean number to adjust animation speed
    jQuery(this).toggleClass('open');
  });