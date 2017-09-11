<?php
session_start();
$tag = $_GET["tag"];
if (!isset($_SESSION["loggedIn"])) echo "notRegistered";
else
{
  $server = "localhost";
  $DBusername = "root";
  $DBpassword = "fahim092";
  $DB = "bendzu";

  //connect to DB
  $conn = new mysqli($server,$DBusername,$DBpassword,$DB);
  if ($conn->connect_error) die("Database Connection Error ".$conn->connect_error);

  $email = $_SESSION["email"];
  $sql = "SELECT workshops FROM users WHERE email='$email'";
  $result = $conn->query($sql);
  if ($result->num_rows > 0)
  {
    while($row = $result->fetch_assoc()){
      if ($row["workshops"] != "nil")
      {
        $enrolled = explode(',',$row["workshops"]);
        if (in_array($tag,$enrolled)) echo "alreadyEnrolled";
        else
        {
          $new = $row["workshops"].",".$tag;
          $up = "UPDATE users SET workshops='$new' WHERE email='$email'";
          if($conn->query($up)) echo "successfullyEnrolled";
          else echo "sorryProblems";
        }
      }
      else{
        $up = "UPDATE users SET workshops='$tag' WHERE email='$email'";
        if($conn->query($up)) echo "successfullyEnrolled";
        else echo "sorryProblems";
      }
    }
  }
}
?>
