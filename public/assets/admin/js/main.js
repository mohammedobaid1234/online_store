$(function() {
    $('#a').click(function(e) {
        // e.priventD
       // remove classes from all
       $('#a').removeClass("active");
       // add class to the one we clicked
       $(this).addClass("active");
    });
 });