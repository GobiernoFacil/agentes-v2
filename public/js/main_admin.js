// hamburger
$( ".hamburger" ).on("click",function() {
	$( ".apertus_nav nav" ).slideToggle( "fast", function() {
		$( ".hamburger" ).toggleClass("close");
	});
});