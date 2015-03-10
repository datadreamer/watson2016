var answer;

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

function pollanswer(_answer){
	// load the form and store the answer
	answer = _answer;
	$.get("_html/poll.html", function(data) {
		$("#poll").replaceWith(data);

		// set submit listener when form has been loaded
		$("#watsonpollform").submit(function (e) {
			e.preventDefault();
			var age = $("#age").val(); 
			var gender = $("#gender").val();
			var party = $("#party").val();
			var zipcode = $("#zipcode").val();
			var reason = $("#reason").val();
			var dataString = 'answer='+answer+'&age='+age+'&gender='+gender+'&party='+party+'&zipcode='+zipcode+'&reason='+reason;
			console.log(dataString);
			$.ajax({
				type:'POST',
				data:dataString,
				url:'_php/pollsubmit.php',
				success:function(data) {
					//console.log(data);
					$("#watsonpollform").replaceWith(data);
				}
			});
		});

	});
}