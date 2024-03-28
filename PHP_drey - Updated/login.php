<?php
$Email = $password1 = "";
$EmailErr = $password1Err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["Email"])) {
        $EmailErr = "Email is Required";
    } else {
        $Email = $_POST["Email"];
    }

    if (empty($_POST["password1"])) {
        $password1Err = "Password is Required";
    } else {
        $password1 = $_POST["password1"];
    }

    if ($Email && $password1) {
        include("connection.php");

        $check_Email = mysqli_query($connections, "SELECT * FROM login_tbl WHERE Email='$Email'");
        $check_Email_row = mysqli_num_rows($check_Email);

        if ($check_Email_row > 0) {
            while ($row = mysqli_fetch_assoc($check_Email)) {
                $db_password1 = $row["Password"];
                $db_account_type = $row["Account_type"];
                if ($password1 == $db_password1) {
                if ($db_account_type == "1") {
                    echo "<script>window.location.href='admin.php';</script>";
                } else {
                    echo "<script>window.location.href='user.php';</script>";
                }
            } else {
                $password1Err = "Incorrect password";
            }
            }
         }
        
        else {
            $EmailErr = "Email is not registered";
        }
    }
    // Reset error messages when the page is loaded initially
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    $EmailErr = $password1Err = "";
}
}
?>


<style>
    *{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

.video-container{
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    overflow: hidden;
    z-index: -1; /* Ensure video is behind other content */
}
video {
    width: 100%;
    height: 100%;
    object-fit: cover; /* Cover entire container */
  }

section{
    display: flex;
    justify-content: center;
    align-items: center;
    height: 80vh;
    z-index: 1;
}

form{
    background-color: #fff;
    height: 60vh;
    width: 350px;
    position: relative;
    top: 50px;
    border-radius: 10px;
    background: transparent;
    backdrop-filter: blur(5px);
    border: 2px solid #fff;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;

}
.form-title{
    position: relative;
   top: -30px;
}
.form-title h2{
    font-size: 30px;
    font-weight: bold;
}

input{
    padding: 10px;
    border-radius: 5px;
    border: none;
    width: 250px;
    background: transparent;
    border-bottom: black 2px solid;
    outline: none;

}
input::placeholder{
    color: #000000;
    text-align: center;
    font-weight: bold;
    font-size: 15px;
}

.formbox{
    padding: 20px;
}
.input-button{
    position: relative;
    top: 40px;
}
input[type="submit"]{
    width: 250px;
    border: none;
    border-radius: 20px;
    background: radial-gradient(circle at 10% 20%, rgb(255, 132, 0) 0%, rgb(189, 146, 4) 90%);
    font-weight: bold;
    font-size: 15px;
    cursor: pointer;
    box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px;
    color: #fff;
    transition: .5s;
}
.iconimg{
    width: 35px;
    position: absolute;
    margin-top: -5px;
    left: 250px;
}
input[type="submit"]:hover{
    scale: 1.1;
}
.error-message{
   
    position: absolute;
    margin-top: 45px;
    left: 100px;
    font-weight: bold;
    color: red;

}
#passworderror{
    left: 110px;
}

.loverboy{
top: -50px;
position: relative;
display: none;
}
.create a{
    color: white;
    left: 100px;
    display: none;
         
                                                              
}
.forgot{
    position: relative;
    margin-top:  10px;
    color: #fff;
}
</style>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <div class="video-container">
        <video src="videos/Firewatch Day_Night Animation.mp4" muted loop autoplay></video>
    </div>
    <section>
        <form autocomplete="off" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <div class = "loverboy">
            <h1> Login </h1>
        </div>
               <div class="form-title">
                <h2>Login</h2>
               </div>

               <div class="form-container">
                    <div class="formbox">
                        <img src="icons/programmer.png" class="iconimg" alt="">
                        <input type="email" placeholder="Email" name="Email" required>
                        <span class="error-message"><?php echo $EmailErr; ?></span>
                    </div>

                    <div class="formbox">
                        <img src="icons/password.png" class="iconimg" alt="">
                        <input type="password" placeholder="Password" name="password1" required>
                        <span class="error-message" id = "passworderror"><?php echo $password1Err; ?></span>
                    
                    <div class="input-button">
                        <input type="submit" value="LOGIN">
                    </div>

                    <div class = "forgot">
                        <input type="checkbox">
                        <span>Forgot Password</span>
                    </div>    

                    <div class ="create">
                        <a href="">Create an Account</a>
                    </div>    

               </div>
            </form>
    </section>
</body>
</html>