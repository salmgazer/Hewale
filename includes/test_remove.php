<?php
include ("task_controller.php");



?>


<html>
<head>
    <meta charset "UTF=8">
    <title></title>
</head>
<body bgcolor="#E6E6FA"> >

<a href =" nurse-project.php">Home</a></br>

<form action ="<?php echo $_SERVER['PHP_SELF']; ?>" method = "POST">
    <div>TASK_ID <input type ="text" name ="desc" required/></div>
    <div>
    </div><br>
    <div><input type ="submit" value= "SAVE" name="ss"/></div>
</form>



</body>
</html>

