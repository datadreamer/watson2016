var pollanswer;

/* smooth scrolling hack */
$(document).ready(function(){
	$('a[href^="#"]').on('click',function (e) {
	    e.preventDefault();

	    var target = this.hash;
	    var $target = $(target);
	    var $header = $('#header');

	    $('html, body').stop().animate({ 'scrollTop': $target.offset().top - $header.height() }, 900, 'swing');
	});
});

function pollanswer(answer){
	pollanswer = answer;
	$.get("_html/poll.html", function(data) {
	     $("#poll").replaceWith(data);
	});
}