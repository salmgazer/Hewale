$(function () {
	$("#login-form").submit(function (e) {
		e.preventDefault();
		login();
	});
});

function sendRequest(u){
    // Send request to server
    //u a url as a string
    //async is type of request
    var obj=$.ajax({url:u,async:false});
    //Convert the JSON string to object
    var result=$.parseJSON(obj.responseText);
    return result;	//return object
}

/** Functions **/
function login() {
	email = document.getElementById('email').value;
  password = document.getElementById('password').value;
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
			nurseTableBody += "<tr><td>"+(i+1)+"</td><td>"+nurses[i]['fullname']+"</td><td>"+nurses[i]['location']+"</td><td><button>Try</button></td></tr>"
		}
		document.getElementById("nurses").innerHTML = nurseTableBody;
	}
}
