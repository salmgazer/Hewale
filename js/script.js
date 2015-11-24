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

function display_all_nurses() {
	var strUrl = "./controller/controller.php?cmd=2";
	var objResult = sendRequest(strUrl);
	if (objResult.result == 1) {
		nurses = objResult.nurse;
		nurseTableBody = "";
		for (var i = 0; i < nurses.length; i++) {
			nurseTableBody += "<tr><td>"+i+"</td><td>"+nurses['fullname']+"</td><td>"+nurses['location']+"</td><td><button>Try<button></td></tr>"
		}
	}
}
