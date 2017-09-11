<?php
  session_start();
  if (isset($_SESSION["loggedIn"]))
  {
    //if user is already logged in then redirect to dashboard
      header('Location: http://localhost/BendZu/dashboard.php');
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
  <link href="css/login.css" rel="stylesheet">
  <style>
    .btn-primary
    {
        float: left;
    }
    .btn-danger
    {
      float: right;
    }
  </style>
  <?php
    $error=0;
    $email=$password="";

    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
      if (empty($_POST["email"]) || empty($_POST["pass"])) $error=1;
      else
      {
        //sanitizing the email and password to prevent SQL Injection
        $email_temp = $_POST["email"];
        $email = filter_var($email_temp,FILTER_SANITIZE_EMAIL);
        $password_temp = $_POST["pass"];
        $password = filter_var($password_temp,FILTER_SANITIZE_STRING);

        //check if email id is a valid one
        if (filter_var($email,FILTER_VALIDATE_EMAIL) == false) $error=1;
        else
        {
          $server = "localhost";
          $DBusername = "root";
          $DBpassword = "fahim092";
          $DB = "bendzu";

          //connect to DB
          $conn = new mysqli($server,$DBusername,$DBpassword,$DB);
          if ($conn->connect_error) die("Database Connection Error ".$conn->connect_error);

          $sql = "SELECT email,name,workshops FROM users WHERE email='$email' AND password='$password'";
          $r = $conn->query($sql);

          if ($r->num_rows == 1)
          {
            while($row = $r->fetch_assoc()){
            //set session variables
            $_SESSION["loggedIn"] = true;
            $_SESSION["name"] = $row["name"];
            $_SESSION["email"] = $row["email"];
            $_SESSION["workshops"] = $row["workshops"];
            //reload window after successful login
            echo "<script>window.location.reload();</script>";
          }
          }
          else $error=2;
        }
      }
    }
  ?>
</head>
<body>
  <div class="login-panel panel panel-primary">
    <div class="panel-heading" style="text-align:center">Enter your login credentials</div>
    <div class="panel-body">
      <form method="post"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
          <input id="email" type="text" class="form-control" name="email" placeholder="Email">
        </div>
        <?php if ($error == 1)echo '<span class="error">*Invalid Email</span>'; ?>
        <br>
        <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
          <input id="pass" type="password" class="form-control" name="pass" placeholder="Password">
        </div>
        <?php if ($error == 2)echo '<span class="error">*Invalid Email/Password</span>'; ?>
        <br>
              <div class="col-md-6"><input type="submit" class="btn btn-primary" value="LOGIN"></div>
              <div class="col-md-6"><a href="index.php" class="btn btn-danger">CANCEL</a></div>
      </form>
    </div>
  </div>
</body>
</html>
