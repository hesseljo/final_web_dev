<!DOCTYPE html>
<html lang="en">
<head>
    <title>Playground (web-scraping & APIs</title>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="script.js" type="text/javascript"></script>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/script.js"></script>
    <script src="scrapper.php"></script>
</head>
<body>

    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="home.html">JOINED Home</a>
            </div>

            <div>
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href="http://web.engr.oregonstate.edu/~hesseljo/playground/scrape.html">Stand-Alone Scrape</a>
                    </li>

                    <li>
                        <a href="http://web.engr.oregonstate.edu/~hesseljo/playground/geo.html">Stand-Alone GeoString</a>
                    </li>

                </ul>

                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <div class="navbar-header">
                            <a class="navbar-brand" href="#" id="welcome_message"></a>
                        </div>
                    </li>
                    <li>
                        <a href="http://web.engr.oregonstate.edu/~hesseljo/playground/registration.php">Register</a>
                    </li>

                    <li>
                        <a href="http://web.engr.oregonstate.edu/~hesseljo/playground/main_login.php">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>



    
<div class="container"><!-- container class is used to centered  the body of the browser with some decent width-->
    <div class="row"><!-- row class is used for grid system in Bootstrap-->
        <div class="col-md-4 col-md-offset-4"><!--col-md-4 is used to create the no of colums in the grid also use for medimum and large devices-->
            <div class="login-panel panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title">Registration</h3>
                </div>
                <div class="panel-body">
                    <form role="form" method="post" action="registration.php">
                        <fieldset>
                            <div class="form-group">
                                <input class="form-control" placeholder="Username" name="name" type="text" autofocus>
                            </div>

                            <div class="form-group">
                                <input class="form-control" placeholder="E-mail" name="email" type="email" autofocus>
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Password" name="pass" type="password" value="">
                            </div>


                            <input class="btn btn-lg btn-success btn-block" type="submit" value="register" name="register" >

                        </fieldset>
                    </form>
                    <center><b>Already registered ?</b> <br></b><a href="login.php">Login here</a></center><!--for centered text-->
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>

<?php
include_once 'config.php';

if(isset($_POST['register']))
{
    $myusername=$_POST['username'];//here getting result from the post array after submitting the form.
    $mypassword=$_POST['password'];//same
    
    if($myusername=='')
    {
        //javascript use for input checking
        echo"<script>alert('Please enter the name')</script>";
exit();//this use if first is not work then other will not show
    }

    if($mypassword=='')
    {
        echo"<script>alert('Please enter the password')</script>";
exit();
    }


//here query check weather if user already registered so can't register again.
    $check_username_query="select * from members WHERE user_email='$user_email'";
    $run_query=mysqli_query($dbcon,$check_email_query);

    if(mysqli_num_rows($run_query)>0)
    {
echo "<script>alert('Email $user_email is already exist in our database, Please try another one!')</script>";
exit();
    }
//insert the user into the database.
    $insert_user="insert into members (username,password) VALUE ('$myusername','$mypassword','$user_email')";
    if(mysqli_query($dbcon,$insert_user))
    {
        echo"<script>window.open('welcome.php','_self')</script>";
    }

}

?>

