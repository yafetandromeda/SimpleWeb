<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Simple Web</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <form method="post">
    <div id="wrap">
      <div id="login">        
        <table>
          <tr><td><h2>Login</h2></td><td></td></tr>
          <tr><td><label id="lblusername">Username </label></td><td><input id="userLogin" type="text" name="userLogin"></td></tr>
          <tr><td><label id="lblpass">Password </label></td><td><input id="passLogin" type="password" name="passLogin"></td><td><input type="checkbox" onclick="showLoginPassword()">Show Password</td></tr>
          <tr><td></td><td align="right"><input id="submitLogin" type="submit" name="submitLogin" value="Log In"/></td></tr>
        </table>
      </div>
      <div id="register">
        <table>
          <tr><td><h2>Register</h2></td><td></td></tr>
          <tr><td><label id="lblemaileRegis">Email </label></td><td><input id="emailRegis" type="text" name="emailRegis"></td></tr>
          <tr><td><label id="lblusernameRegis">Username </label></td><td><input id="userRegis" type="text" name="userRegis"></td></tr>
          <tr><td><label id="lblpass">Password </label></td><td><input id="passRegis" type="password" name="passRegis"></td><td><input type="checkbox" onclick="showRegisPassword()">Show Password</td></tr>
          <tr><td></td><td align="right"><input id="submitRegis" type="submit" name="submitRegis" value="Register"/></td></tr>
        </table>
      </div>
    </div>
  </form>
</body>
</html>
<script type="text/javascript">
  function showLoginPassword() {
    var x = document.getElementById("passLogin");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
  }
  function showRegisPassword() {
    var x = document.getElementById("passRegis");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
  }
</script>

<?php 
  require_once("connectdb.php");

  if (!empty($_POST['submitLogin'])){
    //username dan password yg dikirim dari form
    $username=$_POST['userLogin'];
    $password=$_POST['passLogin'];
    $sql="SELECT * FROM users WHERE name='".$username."' AND password=md5('".$password."')";
    $result=mysql_query($sql);

    //mysql_num_row sedang menghitung jumlah baris yang match
    $count=mysql_num_rows($result);
    if ($data=mysql_fetch_assoc($result)){$namauser=$data['name']; $pass=$data['password'];}

    //jika username dan password match, baris tabel berjumlah 1
    if($count==1){      
      header("location:result.php");
      exit();
    } else{
      echo "<script>alert(\"Email or password was incorrect.\");</script>";
    }
  }

  if(!empty($_POST['submitRegis'])){

    $emailRegis=$_POST['emailRegis'];
    $userRegis=$_POST['userRegis'];
    $passRegis=$_POST['passRegis'];

    $sqlCheckRegis="SELECT * FROM users WHERE email='".$emailRegis."' OR name='".$userRegis."'";
    $checkRegis=mysql_query($sqlCheckRegis);
    mysql_error();
    $countMember=mysql_num_rows($checkRegis);
    if($data=mysql_fetch_assoc($checkRegis)){$user=$data['name']; $email=$data['email'];}

    if($countMember>=1){
      echo "<script>alert(\"Email or Username already registered\");</script>";
    }else{
      if (!filter_var($emailRegis, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert(\"Invalid email format.\");</script>";
      }else{
        $sqlInsertRegis="INSERT INTO users(email,name,password) VALUES ('".$emailRegis."','".$userRegis."',md5('".$passRegis."'))";
        $result = mysql_query($sqlInsertRegis);
        header("location:result.php");
        exit();
      }
    }
  }
 ?>