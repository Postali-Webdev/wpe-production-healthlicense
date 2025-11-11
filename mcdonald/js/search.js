jQuery(document).ready(function () {
            jQuery('.toggle-horizontal-container').hide();
            jQuery('.toggle-horizontal-btn').click(function () {
                jQuery('.toggle-horizontal-container').animate({width:'toggle'},'800');;
               jQuery(this).toggleClass("closed");
                return false;
            });
        })