function sendRequest(u) {
	//Send request to a server
	//u a url as a string
	//async is a type of request
	var obj = $.ajax ({url: u, async: false});
	//Convert the json string to object
	var result = $.parseJSON(obj.responseText);
	return result; //return object
}

function checkemail()  {
		var email = document.getElementById('email').value; 
		var x = /[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}$/.test(email);
		return x;
						  } 

function checkname()  {
		var name = document.getElementById('name').value; 
		var x = /[a-z]{2,30}$/.test(name);
		return x;
							} 

	function addnurse(){
		//create variables to store values from the form
		if(!checkname()){
			alert("check name");
			return;
		}
		if(checkemail()==true){
			alert("check email");
			return;
		}
		
		var name = $("#name").val();
		var account = $("#account").val();
		var email = $("#email").val();
		var password = $("#password").val();
		//store url 
		var strUrl = "http://cs.ashesi.edu.gh/~csashesi/class2016/adjoa-kwakye/Add%20Nurse/ajaxnurse.php?cmd=1&name="+name+"&account="+account+"&email="+email+"&password="+password;
	// var strUrl = "response.php?cmd=6";
	var objResult=sendRequest(strUrl);
	if(objResult.result==1){
		alert("Success adding a nurse");
	}
	else{
		alert("Unable to add");
	}
}

function deletenurse(){
		
		
		
		var id = $("#id").val();
		
		//store url 
		var strUrl = "http://cs.ashesi.edu.gh/~csashesi/class2016/adjoa-kwakye/Add%20Nurse/ajaxnurse.php?cmd=2&id="+id;
	// var strUrl = "response.php?cmd=6";
	var objResult=sendRequest(strUrl);
	if(objResult.result==1){
		alert("Success deleting a nurse");
	}
	else{
		alert("Unable to delete");
	}
}

function searchnurse(){
		//create variables to store values from the form
		if(!checkname()){
			alert("check name");
			return;
				
		var name = $("#name").val();
		//store url 
		var strUrl = "http://cs.ashesi.edu.gh/~csashesi/class2016/adjoa-kwakye/Add%20Nurse/ajaxnurse.php?cmd=3&name="+name;
	// var strUrl = "response.php?cmd=6";
	var objResult=sendRequest(strUrl);
	if(objResult.result==1){
		alert("Success searching a nurse");
	}
	else{
		alert("Unable to find nurse");
	}
}
