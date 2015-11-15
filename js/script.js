$(function () {
	$("#login").submit(function (e) {
		e.preventDefault();
		login();
	});
});


/** Functions **/
function login() {
    email = document.getElementById('email').value;
    password = document.getElementById('password').value;
	var strUrl = "../controller/controller.php?email="+email+"&password="+password;
	var objResult = sendRequest(strUrl);
	if (objResult.result == 1) {
		window.location.href = "home.html";
	}
}