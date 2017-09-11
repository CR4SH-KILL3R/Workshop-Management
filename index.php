<?php
  session_start();

?>
<html>
<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

  <!-- Latest compiled JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Oswald|Fira+Sans" rel="stylesheet">
  <link href="css/index.css" rel="stylesheet">
  <script src="js/index.js">
  </script>
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
    }
    button
    {
      margin: 10px;
    }
    div.alert
    {
      transition: transform 0.5s;
    }
    div.alert:hover
    {
      transform: scale(1.05,1.05);
      box-shadow: 0 0 5px black;
    }
    a{
      margin:15px;
    }
  </style>
</head>
<body   style="background:#f6f6f6">
  <div class="jumbotron text-center" >
    <h2> BendZu</h2>
    <p>Helping students improve their skills</p>
    <p>
      <center <?php if(isset($_SESSION["loggedIn"])) echo 'style="display:none"'; ?>>
          <a href="login.php" class="btn btn-success">SIGN IN</a>
          <a href="signup.php" class="btn btn-primary">SIGN UP</a>
      </center>
      <span <?php if(!isset($_SESSION["loggedIn"])) echo 'style="display:none"'; else echo 'style="display:block"'; ?>>Logged in as <a href="dashboard.php" class="label label-danger"><?php echo $_SESSION["name"] ?></a></span>
    </p>
  </div>

  <div class="showcase">
    <h1 class="header">
      Workshops
    </h1>
    <div class="container-fluid">
      <div class="row">
        <?php
        $server = "localhost";
        $DBusername = "root";
        $DBpassword = "fahim092";
        $DB = "bendzu";

        //connect to DB
        $conn = new mysqli($server,$DBusername,$DBpassword,$DB);
        if ($conn->connect_error) die("Database Connection Error ".$conn->connect_error);

            $sql = "SELECT * FROM workshop";
            $r = $conn->query($sql);
            $i=1;
            if ($r->num_rows > 0)
            {
              while($row = $r->fetch_assoc()){
                echo '<div class="col-md-3">
                  <div class="alert alert-danger">
                   <nav class="navbar navbar-default">
                   <div class="container-fluid">
                   <div class="navbar-brand">'.$row["name"].'&nbsp;</div>
                   </div>
                   </nav>
                  <p class="descriptor">'.$row["description"].'</p>
                  <br>
                  <span class="label label-primary">Last Date : '.$row["lastDate"].'</span>
                  <br>
                  <button type="button" id="'.$row["tag"].'" onclick="register(this.id)" class="register-btn">Apply</button>
                  </div>
                </div>';
                if (($i%4) == 0){
                echo '</div><div class="row">';
                }
                $i++;
              }
            }
        ?>
      </div>
    </div>
  </div>
</body>
</html>
