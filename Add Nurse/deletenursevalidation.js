function sendRequest(u) {
	//Send request to a server
	//u a url as a string
	//async is a type of request
	var obj = $.ajax ({url: u, async: false});
	//Convert the json string to object
	var result = $.parseJSON(obj.responseText);
	return result; //return object
}



	function deletenurse(){
		//create variables to store values from the form
		
		
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
