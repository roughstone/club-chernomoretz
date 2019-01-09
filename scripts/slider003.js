$( document ).ready(function() {
    $(".slide").first().addClass("active");
});

setInterval(runinterval,6000)

function runinterval(){
	var currentSlide = $(".slide.active");
    var nextSlide = currentSlide.next();
    
	currentSlide.fadeOut(0).removeClass("active");
	nextSlide.fadeIn(500).addClass("active");

	if (nextSlide.length == 0) {
		$(".slide").first().fadeIn(500).addClass("active");
	};
};

$( document ).ready(function() {
	$(".leftArrow").click(function() {
		var currentSlide = $(".slideFrame.visible");
		var prevSlide = currentSlide.prev();
	
		currentSlide.fadeOut(0).removeClass("visible");
		prevSlide.fadeIn(500).addClass("visible");
	
		if (prevSlide.length == 0) {
			$(".slideFrame").last().fadeIn(500).addClass("visible");
		};
	});
});

$( document ).ready(function() {
	$(".rightArrow").click(function() {
		var currentSlide = $(".slideFrame.visible");
		var nextSlide = currentSlide.next();
	
		currentSlide.fadeOut(0).removeClass("visible");
		nextSlide.fadeIn(500).addClass("visible");
	
		if (nextSlide.length == 0) {
			$(".slideFrame").first().fadeIn(500).addClass("visible");
		};
	});
});

