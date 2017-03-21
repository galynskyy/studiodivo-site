$(document).ready(function() {
	$(".fancybox").fancybox();
});

$(".fancybox").click(function() {
	yaCounter42619424.reachGoal("portfolio");
});

$(".footer-social__link").click(function() {
	yaCounter42619424.reachGoal("social");
});

$(".feedback-form__scroll").click(function() {
	var height = $("body").height(); 
	$("body").animate({"scrollTop": height}, "slow"); 
});

$(".feedback-form").on("submit", function() {
	yaCounter42619424.reachGoal("feedback");

	var name = $("#feedback__name");
	var email = $("#feedback__email");
	var phone = $("#feedback__phone");

	if(name.val() == "") {
		name.focus();
	} else if (email.val() == "") {
		email.focus();
	} else if (phone.val() == "") {
		phone.focus();
	} else {
		$.ajax({
			type: "POST",
			url: "../ajax/feedback.php",
			data: {
				"name": name.val(),
				"email": email.val(),
				"phone": phone.val()
			},
			dataType: "json",
			success: function(data){
				alert(data.status);
			}
		});
	}
});