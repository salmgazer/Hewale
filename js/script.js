/**
 * author@ Ali PF Njie
 */

//loads in the nurse login page
function load_login_nurse(){
	$("#welcome-container").load("views/login_nurse.html");
    document.getElementById("welcome-container").style.width = "300px";
    document.getElementById("welcome-container").style.marginTop = "130px";
    document.getElementById("welcome-container").style.marginRight = "-500px";
}

function logout(){
     var strUrl = "controller/controller.php?cmd=14";
     var objResult = sendRequest(strUrl);
     if(objResult.result == 1){
         alert(objResult.message);
         window.location.href = "index.html";
     return;
     }
    alert(objResult.message);
}


// loads in the register view page
function load_register_view() {
    $("#landing-1-cover").load("views/register.html");
}

//loads in the doctor login page
function load_login_doctor(){
	$("#welcome-container").load("views/login_doctor.html");
    document.getElementById("welcome-container").style.width = "300px";
    document.getElementById("welcome-container").style.marginTop = "130px";
    document.getElementById("welcome-container").style.marginRight = "-500px";
    document.getElementById("switch").innerHTML = "Switch to Nurse";
}

//load in add nurse view page for admin
function load_add_nurse() {
    $("#admin-focus").load("views/add_nurse.html");
   //getAllHospitals();
}

function getAllHospitals(){
    var strUrl = "controller/controller.php?cmd=7";
    var objResult = sendRequest(strUrl);
    if(objResult.result == 0){
        $("divStatus").text(objResult.message);
        return;
    }
    fillHospitals(objResult.hospitals);
}

function register(){
    hospitalname = $('#hospitalname').val();
    hospital_location = $('#hospital_location').val();
    phoneNumber = $('#phone').val();
    firstname = $('#firstname').val();
    lastname = $('#lastname').val();
    username = $('#username').val();
    password1 = $('#password1').val();
    password2 = $('#password2').val();

    //REGULAR EXPRESSIONS
    //checking hospital name
    if(hospitalname.length < 2){
        alert("Hospital name must be at least 2 characters long");
        return;
    }
    //checking location
    if(hospital_location.length < 2){
        alert("Location must be at least 2 characters long");
        return;
    }
    //checking phone number
    var x = /[0-9]{10}$/.test(phoneNumber);
    if(!x){
        alert("Phone number must be at least 10 ");
        return;
    }
    //checking firstname
    var x = /[a-z]{2,30}$/.test(firstname);
    if(!x){
        alert("Firstname must be at least 2 characters long ");
        return;
    }
    //checking lastname
    var x = /[a-z]{2,30}$/.test(lastname);
    if(!x){
        alert("Lastname must be at least 2 characters long ");
        return;
    }
    //checking username
    if(username.length < 6){
        alert("Username must be at least 6 characters long");
        return;
    }
    //checking password1
    if(password1.length < 8){
        alert("Password must be at least 8 characters long");
        return;
    }
    //checking password 2
    if(password1 != password2){
        alert("The passwords do not match");
        return;
    }
    //send request
    var strUrl = "controller/controller.php?cmd=13&hospitalname="+hospitalname+"&location="+hospital_location+"&phone="+phoneNumber
        +"&firstname="+firstname+"&lastname="+lastname+"&username="+username+"&password="+password1;
    var objResult = sendRequest(strUrl);
    if(objResult.result==0) {
        alert(objResult.message);
        return;
    }
    alert(objResult.message);
    window.location.href = "enter.html";
    return;

}

function fillHospitals(data){
    hospitalSelect = document.getElementById('hospitals');
    for(i = 0; i < data.length; i++) {
        hospitalSelect.options[hospitalSelect.options.length] = new Option(data[i]['hospital_name'], data[i]['hospital_id']);
    }
}

function getAllNurses(){
    fillNurses(getAllnurses('all'));
}

function getAllnurses(status){
    var strUrl = "controller/controller.php?cmd=9&nurse_status="+status;
    var objResult = sendRequest(strUrl);
    if(objResult.result==0){
        alert(objResult.message);
        return;
    }
    return objResult.nurses;
}

function displayAllNurses(status){
    allnurses = "all";
    workers = "full time nurse";
    intern = "student intern";
    thestatus = status;
    document.getElementById('admin-focus').innerHTML='<div id="view-nurse-container"><div id="nurse-views-container"><button id="nurse-views-button" onclick="displayAllNurses(allnurses)">All</button><button id="nurse-views-button" onclick="displayAllNurses(intern)">Intern Nurses</button><button id="nurse-views-button" onclick="displayAllNurses(workers)">Full-time Nurses</button></div><table id="viewnursetable"><tr id="view-nurse-header"> <td>Name</td> <td>Type</td> <td>Action</td> </tr></table> </div>';
    nurses = getAllnurses(status);
    for(i = 0; i < nurses.length; i++){
        row=viewnursetable.insertRow();
        row.style = "height: 35px;font-family: Century Gothic;font-size: 18px;color: brown;background-color:burlywood;";
        cell=row.insertCell(0);
        cell.innerHTML=nurses[i]['fullname'];
        cell = row.insertCell(1);
        cell.innerHTML = nurses[i]['status'];
        cell = row.insertCell(2);
        nurse_id = nurses[i]['nurse_id'];
        cell.innerHTML = '<img  id="nurse-delete" src="img/delete.png" onclick="removeNurse(nurse_id, thestatus)">';
    }
}

function removeNurse(id, status){
    var strUrl = "controller/controller.php?cmd=15&nurse_id="+id;
    var objResult = sendRequest(strUrl);
    if(objResult.result == 0){
        alert(objResult.message);
        return;
    }
    if(objResult.result == 1){
        alert(objResult.message);
        displayAllNurses(status);
        return;
    }
    if(objResult.result == 2){
        alert(objResult.message);
        window.location.href = "enter.html";
        return;
    }
}

function fillNurses(data){
    nursesSelect = document.getElementById('nurses');
    for(i = 0; i < data.length; i++){
        nursesSelect.options[nursesSelect.options.length] = new Option(data[i]['fullname'], data[i]['nurse_id']);
    }
}

//load in add task view page for admin
function load_add_task() {
    $("#admin-focus").load("views/add_task.html");
    getAllNurses();
}

// load in completion request page for admin
function load_completion_request() {
    $("#admin-focus").load("views/completion_request.html");
}

function sendRequest(u){
    // Send request to server
    //u a url as a string
    //async is type of request
    var obj=$.ajax({url:u,async:false});
    //Convert the JSON string to object
    var result=$.parseJSON(obj.responseText);
    return result;	//return object

}

function login(user_type){
    u = $('#username').val();
    p = $('#password').val();
    if(u == ""){ alert("Please enter your username"); return; }
    if(p == ""){ alert("Please enter your password");  return;}
    var strUrl="controller/controller.php?cmd=1&username="+u+"&password="+p+"&user_type="+user_type;
    var objResult=sendRequest(strUrl);
    if(objResult.result == 0) {
        alert(objResult.message);
        return;
    }else {
        if (user_type == 'nurse') {
            window.location.href = "nurse_home.html";
            return;
        }
        if (user_type == 'admin') {
            window.location.href = "admin_home.html";
            return;
        }
    }
}

function getAllNurseTasks(){
    //alert("Yes");
    var strUrl = "controller/controller.php?cmd=2";
    var objResult = sendRequest(strUrl);
    if(objResult.result == 0){
        alert(objResult.message);
        return;
    }
    if(objResult.result == 2){
        alert(objResult.message);
        window.location.href = "enter.html";
        return;
    }
   displayNurseTasks(objResult.tasks);
}

function getAllAdminTasks(){
    //alert("Yes");
    var strUrl = "controller/controller.php?cmd=4";
    var objResult = sendRequest(strUrl);
    if(objResult.result == 0){
        alert(objResult.message);
        return;
    }
    if(objResult.result == 2){
        alert(objResult.message);
        window.location.href = "enter.html";
        return;
    }
    displayAdminTasks(objResult.tasks);
}

function getAllAdminSpecTasks($task_status){
    //alert("Yes");
    var strUrl = "controller/controller.php?cmd=5&task_status="+$task_status;
    var objResult = sendRequest(strUrl);
    if(objResult.result == 0){
        alert(objResult.message);
        return;
    }

    document.getElementById('admin-focus').innerHTML="<table id='admintasklist'></table>";
    displayAdminTasks(objResult.tasks);
}

function getAllNurseSpecTasks(task_status){
    //alert("Yes");
    var strUrl = "controller/controller.php?cmd=3&status="+task_status;
    var objResult = sendRequest(strUrl);
    if(objResult.result == 0){
        alert(objResult.message);
        return;
    }
    if(objResult.result == 2){
        alert(objResult.message);
        return;
    }
    displayNurseTasks(objResult.tasks);
}

//displays all nurse tasks
function allNurseTasks(){
    document.getElementById("tasklist").innerHTML =  "";
    getAllNurseTasks();
}


//function to display tasks assgined to a nurse
function displayNurseTasks(tasks){
    //alert("create table now");
    document.getElementById('nurse-focus').innerHTML = '<table id="tasklist"></table>';
    var row;
    var cell;
    for(i=0;i<tasks.length;i++){
        row=tasklist.insertRow();
        cell=row.insertCell(0);
        //cell.innerHTML = tasks[i]['summary'];
        cell.innerHTML='<div class="task-item"><div class="task-item-info"><div class="task-item-description">'+tasks[i]['summary']+'</div> <div class="task-item-status">'+tasks[i]['task_status']+'</div> <button class="task-item-button" onclick="nurse_viewtask('+tasks[i]['task_id']+')">View Task</button> </div> <div class="task-item-date">'+tasks[i]['end_time']+'</div> </div>';
   }
}

//function to display tasks assigned by an admin
function displayAdminTasks(tasks){
    //alert("create table now");
    document.getElementById('admin-focus').innerHTML="<table id='admintasklist'></table>";
    var row;
    var cell;
    for(i=0;i<tasks.length;i++){
        row=admintasklist.insertRow();
        cell=row.insertCell(0);
        //cell.innerHTML = tasks[i]['summary'];
        cell.innerHTML='<tr><td><div class="task-item"><div class="task-item-info"><div class="task-item-description">'+tasks[i]['summary']+'</div> <div class="task-item-nurse">Assigned To: '+tasks[i]['fullname']+'</div> <button class="task-item-button" onclick="admin_viewtask('+tasks[i]['task_id']+')">View Task</button> </div> <div class="task-item-date">'+tasks[i]['end_time']+'</div> </div> </td> </tr>';
    }
}

//function to get all tasks completion has been requested
function completion(){
    $("#admin-focus").load("views/completion_request.html");
    task_status = "requested completion";
    var strUrl = "controller/controller.php?cmd=5&task_status="+task_status;
    var objResult = sendRequest(strUrl);
    if(objResult.result == 0){
        alert(objResult.message);
        getAllAdminTasks();
        return;
    }
    displaycompletion(objResult.tasks);
}

//function for an admin to view list of tasks nurses have requested completion
function displaycompletion(tasks){
    var row;
    var cell;
    for(i=0;i<tasks.length;i++){
        row=completelist.insertRow();
        cell=row.insertCell(0);
        cell.innerHTML='<tr><td><div class="complete-item"><div class="task-item-description">'+tasks[i]['summary']+'</div> <div class="task-assigned" style="color:white; text-align:center; height:30%; padding-top:10px; font-weight:bold;">Task Status: '+tasks[i]['task_status']+'</div> <div id="completion-button-container"> <center> <button id="complete-button" style="background-color:darkgreen; border: 1px darkgreen;" onclick="accept('+tasks[i]['task_id']+')">Accept Request</button> <button id="complete-button" style="background-color:red; border: 1px red;" onclick="reject('+tasks[i]['task_id']+')">Reject Request</button> </center> </div> </div> </td> </tr>';
    }
}

//function for an admin to accept completion of a task
function accept(id){
    var strUrl = "controller/controller.php?cmd=11&task_id="+id;
    var objResult = sendRequest(strUrl);
    if(objResult.result == 0){
        alert(objResult.message);
        return;
    }
    if(objResult.result == 1){
        alert(objResult.message);
        completion();
        return;
    }
}

//function for an admin to reject completion of a task
function reject(id){
    var strUrl = "controller/controller.php?cmd=12&task_id="+id;
    var objResult = sendRequest(strUrl);
    if(objResult.result == 0){
        alert(objResult.message);
        return;
    }
    if(objResult.result == 1){
        alert(objResult.message);
        completion();
        return;
    }
}

//function for an admin to view details of a task
function admin_viewtask(task_id){
    var strUrl = "controller/controller.php?cmd=6&user_type=admin&task_id="+task_id;
    var objResult = sendRequest(strUrl);
    if(objResult.result == 0){
        alert(objResult.message);
        return;
    }
    mytask = objResult.task[0];
    summary = mytask['summary'];
    description = mytask['description'];
    end = mytask['end_time'];
    start = mytask['start_time'];
    nurse = mytask['fullname'];
    status = mytask['task_status'];
    //document.getElementById("admin-focus").innerHTML = "yes";
    document.getElementById("admin-focus").innerHTML = '<div id="view-task"><center><br><label class="view-label">Task Summary:</label> <div id="task-summary" style="color: #000000;">'+summary+'</div><br><label class="view-label">Task Description:</label> <div id="task-description">'+description+' </div> <div id="task-cover"> <br><label class="view-label">Task Status:  </label><br> <div id="task-status">'+status+'</div> </div> <div id="task-cover"> <label class="view-label">Assigned To:  </label><br> <div id="task-assigned">'+nurse+'</div> </div> <div id="task-dates"> <div id="task-cover"> <label class="view-label">Date Assigned:  </label><br> <div id="date-assigned">'+start+'</div> </div> <div id="task-cover"><label class="view-label">Due Date:  </label><br> <div id="due-date">'+end+'</div> </div></div> </center> </div>';
}

//function to for a nurse to view details of a task
function nurse_viewtask(task_id){
   // alert(task_id);
    var $strUrl = "controller/controller.php?cmd=6&user_type=nurse&task_id="+task_id;
    var objResult = sendRequest($strUrl);
    if(objResult.result == 0){
        alert(objResult.message);
        return;
    }
    mytask = objResult.task[0];
    summary = mytask['summary'];
    description = mytask['description'];
    end = mytask['end_time'];
    start = mytask['start_time'];
    admin = mytask['firstname']+' '+mytask['lastname'];
    status = mytask['task_status'];

    document.getElementById('nurse-focus').innerHTML = '<div id="view-task"><center> <br><label class="view-label">Task Summary:</label> <div id="task-summary" style="color: #000000;">'+summary+'</div> <br><label class="view-label">Task Description:</label> <div id="task-description">'+description+'</div> <div id="task-cover"> <br><label class="view-label">Task Status:  </label><br> <div id="task-status">'+status+'</div> </div> <div id="task-cover"> <label class="view-label">Assigned By:  </label><br> <div id="task-admin">'+admin+'</div> </div> <div id="task-dates"> <div id="task-cover"> <label class="view-label">Date Assigned:  </label><br> <div id="date-assigned">'+start+'</div> </div> <div id="task-cover"> <label class="view-label">Due Date:  </label><br> <div id="due-date">'+end+'</div></div> </div> </center> </div>';

}

//function to add new nurse
function addNurse(){
    name = $("#nurse_name").val();
    uname = $("#nurse_username").val();
    pass = $("#nurse_password").val();
    status = $("#nurse_status").val();
    var strUrl = "controller/controller.php?cmd=8&name="+name+"&uname="+uname+"&pass="+pass+"&status="+status;
    var objResult = sendRequest(strUrl);
    if(objResult.result == 0){
        alert(objResult.message);
        return;
    }
    alert(objResult.message);
    load_add_nurse();
}

//function to assign a task to a nurse
function addTask(){
    desc = $("#description").val();
    summ = $("#summary").val();
    start = $("#start").val();
    end = $("#end").val();
    nurse_id = $("#nurses").val();
    var strUrl = "controller/controller.php?cmd=10&desc="+desc+"&summ="+summ+"&start="+start+"&end="+end+"&nurse_id="+nurse_id;
    var objResult = sendRequest(strUrl);
    if(objResult.result == 0) {
        alert(objResult.message);
        return;
    }
    alert(objResult.message);
    load_add_task();
}


