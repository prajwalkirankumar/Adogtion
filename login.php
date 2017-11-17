<?php
$dbname="users";
$username="root";
$password="";
$host="localhost";
$myconnection=mysqli_connect($host,$username,$password,$dbname);
$fnameErr = $emailErr = $lnameErr = $passwordErr = $noMatchErr = "";
$emailErr1 = $pwordErr1 = "";
$fname = $lname = $pword1 = $pword2 = $email = $address = $email1 = $pword3 = "";
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
  if (empty($_POST["fname"])) {
    $fnameErr = "Name is required";
  } else {
    $fname = test_input($_POST["fname"]);
    if (!preg_match("/^[a-zA-Z ]*$/",$fname)) {
      $fnameErr = "Only letters and white space allowed";
  }
  }

  if (empty($_POST["lname"])) {
    $lnameErr = "Name is required";
  } else {
    $lname = test_input($_POST["lname"]);
    if (!preg_match("/^[a-zA-Z ]*$/",$lname)) {
  $lnameErr = "Only letters and white space allowed";
}
  }

  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  $emailErr = "Invalid email format";
}
}

  if (empty($_POST["pword1"])) {
    $passwordErr = "Password is required";
  } else {
    $pword1 = test_input($_POST["pword1"]);
  }

  if (empty($_POST["pword2"])) {
    $passwordErr = "Confirm password required";
  } else {
    $pword2 = test_input($_POST["pword2"]);
  }

  if (empty($_POST["address"])) {
    $addressErr = "Address required";
  } else {
    $address = test_input($_POST["address"]);
  }

}
if($pword1!=$pword2)
{
  $passwordErr = "Passwords dont match.";
}

else
{
  $query = "INSERT INTO login_details VALUES (".$fname.",".$lname.",".$email.",".$pword1.",".$address.")";
  $results=mysqli_query($myconnection,$query);
}

if (empty($_POST["email1"])) {
  $emailErr1 = "Email Required";
} else {
  $email1 = test_input($_POST["address"]);
  if (!filter_var($email1, FILTER_VALIDATE_EMAIL)) {
  $emailErr1 = "Invalid email format";
}}
if (empty($_POST["pword3"])) {
  $pwordErr1 = "Password Required";
} else {
  $pword3 = test_input($_POST["address"]);
  $query = "SELECT * FROM login_details WHERE email_address=".$email1."AND password=".$pword3;
  $results=mysqli_query($myconnection,$query);

  if(mysqli_num_rows($results)!=1)
    $noMatchErr="Email Id and Password dont match!";
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>


<!DOCTYPE html>
<html>
<head>
  <style>
  body{
    margin:0;
    padding:0;
  }
  ul {
      list-style-type: none;
      margin: 0;
      padding: 0;
      overflow: hidden;
      background-color: #333;
  }

  li {
      float: left;
      width:20%;
      height:50px;
      padding:0;
      margin:0;
  }

  li a{
      display: block;
      color: white;
      text-align: center;
      padding: 14px 16px;
      text-decoration: none;
  }

  a:hover:not(.active) {
      background-color: #111;
  }

  .active {
  background-color:#4CAF50;
  }

  #cover{
    height:250px;
    width:1000px;
    margin:0;
    padding:0;
  }
  #logo{
    width:1500px;
    max-width:100%;
    max-height: 100%;
    margin: 0;
  }
  li a:hover, .dropdown:hover .dropbtn {
      background-color: black;
  }

  li.dropdown {
      display: inline-block;
  }

  .dropdown-content {
      display: none;
      position: absolute;
      background-color: #f9f9f9;
      min-width: 160px;
      box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
      z-index: 1;
  }

  .dropdown-content a {
      color: black;
      padding: 12px 16px;
      text-decoration: none;
      display: block;
      text-align: left;
      width: 173px;
      height: 15px;
  }

  .dropdown-content a:hover {background-color: #f1f1f1}

  .dropdown:hover .dropdown-content {
      display: block;
  }
  #navbar{
    margin: 0;
  }

  *, *:before, *:after {
    box-sizing: border-box;
  }

  html {
    overflow-y: scroll;
  }

  body {
    background: #c1bdba;
    font-family: 'Titillium Web', sans-serif;
  }

  a {
    text-decoration: none;
    color: #1ab188;
    -webkit-transition: .5s ease;
    transition: .5s ease;
  }
  a:hover {
    color: #179b77;
  }

  .form {
    background: rgba(19, 35, 35, 0.5);
    padding: 40px;
    max-width: 600px;
    margin: 40px auto;
    border-radius: 4px;
    box-shadow: 0 4px 10px 4px rgba(19, 35, 47, 0.3);
  }

  .tab-group {
    list-style: none;
    padding: 0;
    margin: 0 0 40px 0;
  }
  .tab-group:after {
    content: "";
    display: table;
    clear: both;
  }
  .tab-group li a {
    display: block;
    text-decoration: none;
    padding: 15px;
    background: rgba(160, 179, 176, 0.25);
    color: #a0b3b0;
    font-size: 20px;
    float: left;
    width: 260px;
    text-align: center;
    cursor: pointer;
    -webkit-transition: .5s ease;
    transition: .5s ease;
  }
  .tab-group li a:hover {
    background: #179b77;
    color: #ffffff;
  }
  .tab-group .active a {
    background: #1ab188;
    color: #ffffff;
    width:260px;
  }

  .tab-content > div:last-child {
    display: none;
  }

  h1 {
    text-align: center;
    color: #ffffff;
    font-weight: 300;
    margin: 0 0 40px;
  }

  label {
    position: absolute;
    -webkit-transform: translateY(6px);
            transform: translateY(6px);
    left: 13px;
    color: rgba(255, 255, 255, 0.5);
    -webkit-transition: all 0.25s ease;
    transition: all 0.25s ease;
    -webkit-backface-visibility: hidden;
    pointer-events: none;
    font-size: 22px;
  }
  label .req {
    margin: 2px;
    color: #1ab188;
  }

  label.active {
    -webkit-transform: translateY(50px);
            transform: translateY(50px);
    left: 2px;
    font-size: 14px;
  }
  label.active .req {
    opacity: 0;
  }

  label.highlight {
    color: #ffffff;
  }

  input, textarea {
    font-size: 22px;
    display: block;
    width: 100%;
    height: 100%;
    padding: 5px 10px;
    background: none;
    background-image: none;
    border: 1px solid #a0b3b0;
    color: #ffffff;
    border-radius: 0;
    -webkit-transition: border-color .25s ease, box-shadow .25s ease;
    transition: border-color .25s ease, box-shadow .25s ease;
  }
  input:focus, textarea:focus {
    outline: 0;
    border-color: #1ab188;
  }

  textarea {
    border: 2px solid #a0b3b0;
    resize: vertical;
  }

  .field-wrap {
    position: relative;
    margin-bottom: 40px;
  }

  .top-row:after {
    content: "";
    display: table;
    clear: both;
  }
  .top-row > div {
    float: left;
    width: 48%;
    margin-right: 4%;
  }
  .top-row > div:last-child {
    margin: 0;
  }

  .button {
    border: 0;
    outline: none;
    border-radius: 0;
    padding: 15px 0;
    font-size: 2rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: .1em;
    background: #1ab188;
    color: #ffffff;
    -webkit-transition: all 0.5s ease;
    transition: all 0.5s ease;
    -webkit-appearance: none;
  }
  .button:hover, .button:focus {
    background: #179b77;
  }

  .button-block {
    display: block;
    width: 100%;
  }

  .forgot {
    margin-top: -20px;
    text-align: right;
  }
  div.background {
    background: url(login1.jpg);
    border: 2px solid black;
    background-size:100%;
    height:800px;
    width:100%;
    bottom:0;
    background-repeat: no-repeat;
  }

  </style>
  <meta charset="UTF-8">
  <title>Sign-Up/Login Form</title>
<!--  <link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>-->
<!--  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">-->



</head>

<body>
  <div id="cover">
  <img id="logo" src="adogtion11.png"></img>
  </div>
  <div id="navbar">
  <ul>
    <li><a class="active" href="#home">Home</a></li>
    <li class="dropdown">
      <a href="javascript:void(0)" class="dropbtn">About</a>
      <div class="dropdown-content">
        <a href="#">About Us</a>
        <a href="#">Contact Us</a>
      </div>
    </li>
    <li class="dropdown">
      <a href="javascript:void(0)" class="dropbtn">Dog World</a>
      <div class="dropdown-content">
        <a href="#">About Dogs</a>
        <a href="#">Dog Health</a>
        <a href="#">Dog Shop</a>
      </div>
    </li>
    <li><a class="nav" href="#about">News</a></li>
    <li><a class="nav" href="#contact">Login</a></li>
  </ul>
  </div>
  <div class="background">
  <div class="form">

      <ul class="tab-group">
        <li class="tab active"><a href="#signup" onclick="loadsignup()">Sign Up</a></li>
        <li class="tab"><a href="#login" onclick="loadlogin()">Log In</a></li>
      </ul>

      <div class="tab-content">
        <div id="signup">
          <h1>Sign Up for Free</h1>

          <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">

          <div class="top-row">
            <div class="field-wrap">
              <label>
                First Name<span class="req">*<?php echo $fnameErr;?></span>
              </label>
              <input type="text" required autocomplete="off" name="fname" value="<?php echo $fname;?>"/>
            </div>

            <div class="field-wrap">
              <label>
                Last Name<span class="req">* <?php echo $lnameErr;?></span>
              </label>
              <input type="text"required autocomplete="off" name="lname" value="<?php echo $lname;?>"/>
            </div>
          </div>

          <div class="field-wrap">
            <label>
              Email Address<span class="req">* <?php echo $emailErr;?></span>
            </label>
            <input type="email"required autocomplete="off" name="email" value="<?php echo $email;?>"/>
          </div>

          <div class="field-wrap">
            <label>
              Enter Password<span class="req">* <?php echo $passwordErr;?></span>
            </label>
            <input type="password"required autocomplete="off" name="pword1"/>
          </div>

          <div class="field-wrap">
            <label>
              Confirm Password<span class="req">* <?php echo $passwordErr;?></span>
            </label>
            <input type="password"required autocomplete="off" name="pword2"/>
          </div>

          <div class="field-wrap">
            <label>
              Address<span class="req">*</span>
            </label>
            <input type="address"required autocomplete="off" name="address" value="<?php echo $address;?>"/>
          </div>


          <button type="submit" class="button button-block" onclick="validate()"/>SIGN UP!</button>

          </form>

        </div>

        <div id="login" style="visibility:hidden;">
          <h1>Welcome Back!</h1>

          <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
            <div class="field-wrap">
            <label>
              Email Address<span class="req">* <?php echo $emailErr;?></span>
            </label>
            <input type="email"required autocomplete="off" value=<?php echo $email1;?> name="email1"/>
          </div>

          <div class="field-wrap">
            <label>
              Password<span class="req">* <?php echo $wrongPassErr;?></span>
            </label>
            <input type="password"required autocomplete="off" name="pword3"/>
          </div>

          <p class="forgot"><a href="#">Forgot Password?</a></p>

          <button class="button button-block"/>Log In</button>

          </form>

        </div>

      </div><!-- tab-content -->

</div> <!-- /form -->
</div>


</body>
</html>


<script>
var login=document.getElementById("login");
var signup=document.getElementById("signup");

function loadlogin()
{
    signup.style.visibility="hidden";
    login.style.visibility="visible";
}

function loadsignup()
{
    login.style.visibility="hidden";
    signup.style.visibility="visible";
}

function validate()
{
  if(document.getElementsByName("pword1").value!==document.getElementsByName("pword2").value)
  {
    alert("Passwords do not match!");
    location.reload();
  }
}
</script>
