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
		nurseContent = "";
		for (var i = 0; i < nurses.length; i++) {
			nurseContent += '<div class="col s12 m3"><div class="card"><center><div class="card-image waves-effect waves-block waves-light"><img class="activator" src="img/nurse.png"></div></center><div class="card-content"><span class="card-title activator grey-text text-darken-4">'+nurses[i]["fullname"]+'<i class="fa fa-ellipsis-v right"></i></i></span></div><div class="card-reveal"><span class="card-title grey-text text-darken-4">'+nurses[i]["fullname"]+'<i class="fa fa-times right"></i></span><p>Email:<br> '+nurses[i]["email"]+'<div class="divider"></div> PhoneNumber:<br> '+nurses[i]["phonenumber"]+'</p></div></div></div>';
		}
		document.getElementById("content-container").innerHTML = nurseContent;
	}
}
