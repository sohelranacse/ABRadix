
$(document).ready(function () {

    var carousel = $("#owl-demo");
    carousel.owlCarousel({
    items : 5,   
    pagination: false,
    navigation:true,
    navigationText: [
     "<i class='fa fa-angle-left'></i>",
     "<i class='fa fa-angle-right'></i>"
      ],
    autoPlay : true,
  });
});


$(document).ready(function(){
		$(function(){
    	    $('.dropdown').hover(function() {
    	        $(this).addClass('open');
    	    },
    	    function() {
    	        $(this).removeClass('open');
    	    });
    	});

    	var progress = setInterval(function () {
		    var $bar = $("#bar");

		    if ($bar.width() >= 600) {
		        clearInterval(progress);
		    } else {
		        $bar.width($bar.width() + 60);
		    }
		    $bar.text($bar.width() / 6 + "%");
		    if ($bar.width() / 6 == 100){
		      $bar.text("Loading... " + $bar.width() / 6 + "%");
		    }
		}, 800);

		$(window).load(function() {
		  $("#bar").width(600);
		  $(".loader").delay(5000).fadeOut(400);
		});
});
