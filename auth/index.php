<?php
ob_start();
require_once("resource/Database.php"); //db connection ?>
<?php $page_title = "Ubicomp Userpage"; ?>
<?php require_once("patches/header.php"); ?>

    <div class="container">


      <div class="flag">
        <h1>UBICOMP</h1>
        <p class="lead">Welcome to Ubicomp User's page .<br>
         </p>

         
        <?php if(!isset($_SESSION['username'])): ?>
        <p> You are currently not sign in <a href="login.php"><strong><h4>Login </h4></strong></a>Not yet a member?
            <a href="signup.php"><strong><h4>Sign up </h4></strong></a>
        </p>
        <?php else: 
        $ur = $_SESSION['username'];
        $ad = "admin";
        ?>
        <?php $em = $_SESSION['email'];

        $boardnos = "";
        $sqlQuery = "SELECT * FROM users WHERE username = :username "; //check if user exist in database
        $statement = $db->prepare($sqlQuery);
        $statement->execute(array(':username' => $ur));

        if($row = $statement->fetch()){
            $boardnos = $row['boardno'];
            $link = $row['link']; 
            $ssid = $row['wifissid'];
            $wipass = $row['wifipass'];
        }


                $boardn = $_SESSION['boardno'];
                ?>
        <p>
            <h4> You are logged in as <strong><em><span id="red_font"><?php echo $_SESSION['username']; ?></span></em></strong></h4>
        </p>
      </div>      
    </div>
<?php if($ur === $ad): ?>
      <div class="row">
          <br/>
          <br/>
          <div class="col-md-6" ></div>
          <p>
              
           </p>
        </div>

<?php else: ?>
   <div class="row">
            <br/>
            <br/>
            <div class="col-md-5" ></div>
            <p>
               YOUR DETAILS ARE AS FOLLOWS <br/><br/>
             <marquee><b><h4">  If board no and  link are not shown, wait for one day to be assigned by the admin after the product
             installation or you have to buy a product first.</h4>    </b></marquee> 
            
            </p><hr/>
            <div class="col-md-5" >
            <p>
                &nbsp &nbsp &nbsp &nbsp Email :&nbsp &nbsp &nbsp &nbsp &nbsp&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  <?php echo $em;  ?>
                <br/>
                &nbsp &nbsp &nbsp &nbsp Board No : &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp <?php echo $boardnos;  ?>
                <br/>
                &nbsp &nbsp &nbsp &nbsp Link to control devices: &nbsp &nbsp <?php echo " <a href=\"http://$link\" target=\"_new\">$link</a>";  ?> 
                <br/>
                &nbsp &nbsp &nbsp &nbsp Wifi SSID :&nbsp &nbsp&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  <?php echo $ssid;  ?>
                <br/>
                &nbsp &nbsp &nbsp &nbsp Wifi PASS : &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp <?php echo $wipass;  ?>
                <br/> 
            </p></div>
        </div>

<?php endif ?>
<?php endif ?>

<?php require_once("patches/footer.php"); ?>