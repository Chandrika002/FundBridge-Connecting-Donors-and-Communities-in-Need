<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>homepage</title>
    <style>
    /* Reset default margin and padding */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Set the background image for the entire window */
slideshow-container {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    overflow: hidden;
    background: linear-gradient(rgba(159, 165, 190, 0.7), rgba(104, 109, 126, 0.7)), 
            no-repeat center center; 
    background-size: cover;
    z-index: -1; /* Send the background to the back */
}

.slide {
    position: absolute;
    width: 100%;
    height: 100%;
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    opacity: 0;
    transition: opacity 1.5s ease-in-out;
}
.text-box{
    width: 90%;
    color: #c45b15;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    text-align: center;
}
.text-box h1{
    font-size: 42px;
}
.text-box p{
    margin: 10px 0 40 px;
    font-size: 26px;
}
    </style>
</head>
<body>
    <div class="slideshow-container">
        <!-- Background slides -->
        <div class="slide"style="background-image: url('1stimg.jpg');"></div>
        <div class="slide"style="background-image: url('2ndimg.jpg');"></div>
        <div class="slide"style="background-image: url('3rdimg.jpg');"></div>
    </div>
    <section class="header">

        <!-- <nav>
            <div class="nav-links">
                <ul>
                    <li><a href="sign_in.php">SIGN IN</a></li>
                    <li><a href="signup.php">SIGN UP</a></li> -->
                    <!-- <li><a href="donations.php">DONATIONS</a></li> -->
                    <!-- <li><a href="">ABOUT</a></li> -->
                    <!-- <li><a href="">CONTACT</a></li> -->
                <!-- </ul>
            </div>
        </nav> -->
        <div class="text-box">
            <h1>Welcome to FundBridge</h1><br>
            <p>Connecting donors and needy recipients for impactful change</p>
            <p><a href="signin.php">Get Started</a><br><br>
            New One! <a href="signup.php">Join us</a></p>
        </div>
        
    </section>
    <!-- <script src="script.js"></script> -->
</body>
</html>
