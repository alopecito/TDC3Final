<?php
include ("Connector/Credentials.php");


If (isset($_POST['username'])) {

    $db = connect_db();

    $username = $_POST['username'];
    $password = $_POST['password'];
    define('USERNAME', $username);
    define('PASSWORD', $password);
    

    $stmt = $db->prepare("SELECT * FROM users WHERE username=:username AND password=:password LIMIT 1");
    $stmt->bindValue(':username', USERNAME, PDO::PARAM_INT);
    $stmt->bindValue(':password', PASSWORD, PDO::PARAM_INT);
    $stmt->execute();
    $rows =$stmt->fetchColumn();

//    $res = $mysqli->query($sql);


    if ($rows == 1) {
        echo "<script> window.location.assign('projectsPage.php'); </script>";
        exit();
    }
    else {

        header("location: login.php");
        $msg = 'Login Failed!<br /> Please make sure that you enter the correct details';
        exit();
    }
}
?>

<!DOCTYPE htlm>
<html>
    <head>
        <meta charset="UTF-8">
        <title>McGill Immobilier | Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/form_login.css">

    </head>
    <body>

        <section>
            <nav id="nav1">
                <div id="div2">
                    <a href="contractMaker.php"><img src="images/McGill_FR_Black.png"></a>			 	

                </div >
            </nav>


            <div>

                <video id="vid1" controls muted autoplay loop poster="../images/McGill_EN_Black" id="bgvid">   
                    <source src="videos/video3.mp4" type="video/mp4" >  
                    Your browser does not support the video tag.
                </video>


            </div>

            <div class="formContainer">
                <h2 id="loginLevel">LOGIN</h2>

                <form method="post" action="login.php">


                    <div class="container">
                        <label><b>Username</b></label>
                        <input type="text" placeholder="Enter Username" name="username" required>

                        <label><b>Password</b></label>
                        <input type="password" placeholder="Enter Password" name="password" required>

                        <button type="submit">Login</button>
                        
                    </div>

                    <div class="container">
                        <button type="button" class="cancelbtn">Cancel</button>
                        <span class="psw">Forgot <a href="#">password?</a></span>
                    </div>
                </form>

            </div>
        </section>
    </body>
</html