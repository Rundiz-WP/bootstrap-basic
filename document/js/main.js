/**
 * document javascript
 * 
 * @author Vee Winch
 */


$(function() {
	/**
	 * smooth scroll to bookmark.
	 * create by css-tricks.com
	 * 
	 * @link http://css-tricks.com/snippets/jquery/smooth-scrolling/
	 */
	$('.navbar-nav a').click(function() {
		if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') || location.hostname == this.hostname) {
			var target = $(this.hash);
			target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');

			if (target.length) {
				$('html,body').animate({
					scrollTop: ((target.offset().top)-80)
				}, 1000);
				return false;
			}
		}
	});// smooth scroll to bookmark
});

