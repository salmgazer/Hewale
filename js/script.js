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
    //alert(email);
	var strUrl = "./controller/controller.php?cmd=1&email="+email+"&password="+password;
	var objResult = sendRequest(strUrl);
	if (objResult.result == 1) {
		window.location.href = "home.html";
	}
    else if(objResult.result == 0){
        alert("wrong details");
    }
}