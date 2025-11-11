jQuery('#menu-icon').click(function(e){
    e.preventDefault();
    jQuery('#mobile-nav').slideToggle(200);
    // Change this boolean number to adjust animation speed
    jQuery(this).toggleClass('open');
  });
  
  
// Add additional class for sidebar links
   jQuery(document).ready(function($){
       // Select an a element that has the matching href and apply a class of 'active'. Also prepend a - to the content of the link
       var url = window.location.href;
       $('.widget_recent_entries a[href="'+url+'"]').closest('li').addClass('current-menu-item');
   });
   
// searchbar script
   jQuery(document).ready(function () {
            jQuery('.toggle-horizontal-container').hide();
            jQuery('.toggle-horizontal-btn').click(function () {
                jQuery('.toggle-horizontal-container').animate({width:'toggle'},'800');;
               jQuery(this).toggleClass("closed");
                return false;
            });
        })