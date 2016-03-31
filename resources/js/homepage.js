var $body,
	$fullscreen,
	$menu;

$(function() {
	// $('nav#menu').mmenu();
	$fullscreen = $('#full-screen');

	handleWindowResize();
	$(window).on('resize', handleWindowResize);
});

// $(document).ready(function(){
// 	$body = $('body');
// 	$fullscreen = $('#full-screen');
// 	$menu = $('#menu');
// 	handleWindowResize();
// 	$(window).on('resize', handleWindowResize);
// 	$('.js-click-side').on('click', showOnlyOneSide);
// 	$('.js-click-party').on('click', showOnlyOneParty);
// 	$('.hamburger').on('click', toggleHamburger);
// });

function handleWindowResize() {
	$fullscreen.removeClass('orientation-wide').removeClass('orientation-high');
	if (window.innerWidth > window.innerHeight) {
		$fullscreen.addClass('orientation-wide');
	} else {
		$fullscreen.addClass('orientation-high');
	}
}

// function toggleHamburger() {
// 	$body.toggleClass('menu-open')
// 	$menu.toggleClass('open');
// }

// function showOnlyOneSide(e) {
// 	e.preventDefault();
// }

// function showOnlyOneParty(e) {
// 	e.preventDefault();
// }