<?php
session_start();
if (!isset($_SESSION["loggedIn"]))
{
  //if user is not logged in
  header('Location: http://localhost/BendZu/login.php');
  exit;
}
$name = $_SESSION["name"];
$workshop = $_SESSION["workshops"];

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    unset($_SESSION["loggedIn"]);
    session_destroy();
    exit;
}
?>
<html>
<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

  <!-- Latest compiled JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Oswald|Fira+Sans" rel="stylesheet">
  <link href="css/dashboard.css" rel="stylesheet">
  <style>
  .jumbotron
  {
    background: #f4511e;
    color:white;
    padding: 100px 30px;
  }
  .jumbotron>h2
  {
    font-family:'Oswald';
    font-size: 45px;
    position: absolute;
  }
  td
  {
    padding:10px;
  }

  </style>
  <script>
  function logout()
  {
    var xhttp = new XMLHttpRequest();
    if (confirm("Do you want to logout ?")){
      xhttp.open("POST","dashboard.php");
      xhttp.send();
      window.location.assign("index.php");
  }
  }
  </script>
</head>
<body>
<div class="jumbotron text-center">
  <h1>Welcome <?php echo $name;?>
  </h1>
  <br>
  <div class="container">
    <div class="row">
      <div class="col-md-3"></div>
      <div class="col-md-3">
        <button type="button" onclick="logout()" class="btn btn-success btn-lg">Logout of BendZu</button></div>
      <div class="col-md-3">
        <a href="index.php" class="btn btn-primary btn-lg">Browse Workshops</a></div>
      </div>
      <div class="col-md-3"></div>
    </div>
</div>
<div class="enrolled">
  <h1 class="header">
    Enrolled workshops
  </h1>
  <div class="container">
    <div class="row">
      <div class="col-md-2"></div>
      <div class="col-md-8">
        <?php
        $server = "localhost";
        $DBusername = "root";
        $DBpassword = "fahim092";
        $DB = "bendzu";

        //connect to DB
        $conn = new mysqli($server,$DBusername,$DBpassword,$DB);
        if ($conn->connect_error) die("Database Connection Error ".$conn->connect_error);

        $enrolled = explode(',',$workshop);
        foreach ($enrolled as $info)
        {
            $sql = "SELECT name,description,date,time FROM workshop WHERE tag='$info'";
            $r = $conn->query($sql);

            if ($r->num_rows > 0)
            {
              while($row = $r->fetch_assoc()){
                echo '<div class="alert alert-danger">
              	 <nav class="navbar navbar-default">
              	 <div class="container-fluid">
              	 <div class="navbar-brand">'.$row["name"].'&nbsp;</div>
              	 <ul class="navbar-nav nav navbar-right">
              	 	<li> <a href="#"><span class="glyphicon glyphicon-thumbs-up"></span></a>
              	 	</li>
              	 	<li> <a href="#"><span class="glyphicon glyphicon-thumbs-down"></span></a>
              	 	</li>
              	 	<li> <a href="#"><span class="glyphicon glyphicon-share"></span> SHARE</a>
              	 	</li>

              	 </ul>
              	 </div>
              	 </nav>
              	 <div class="container-fluid">
              	 	<div class="row">
              	 	<div class="col-md-6">'.$row["description"].'</div>
              	 	<div class="col-md-4">
                  	 	<table class="table table-striped">
                  	 	<tr class="info">
                  	 		<td><b>Date</b></td>
                  	 		<td><span class="label label-info">'.$row["date"].'</span></td>
                  	 	</tr>
                  	 	<tr class="info">
                  	 		<td><b>Time</b></td>
                  	 		<td><span class="label label-info">'.$row["time"].'</span></td>
                  	 	</tr>
                  	 	</table></div>
                  	 	</div>
                  	 	</div>
                  	 </div>';
              }
            }
            else echo '<p class="empty">It\'s empty in here</p>';
        }
        ?>
      </div>
     <div class="col-md-2"></div>
   </div>
</div>
</div>
 </body>
 </html>
