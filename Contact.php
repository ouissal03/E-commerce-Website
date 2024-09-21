<?php 

session_start();
if (!isset($_SESSION["client"])) {
    header("location: home.php"); 
    exit();
}
if(isset($_POST["nom"])&&(isset($_POST["prenom"]))&& (isset($_POST["email"]))&& (isset($_POST["site"]))&& (isset($_POST["message"])))
{

$nom=$_POST["nom"];
$email=$_POST["email"];
$prenom=$_POST["prenom"];
$site=$_POST["site"];
$message=$_POST["message"];
$_SESSION["message"]=$message;
$link=mysqli_connect("localhost","root","","Projetsqlphp");
if(mysqli_connect_errno()) {
    printf("ECHEC DE LA CONNEXION :%s\n",mysqli_connect_error());
    exit();}
    $query="INSERT INTO contact(`NumClient`, `Nom`,`Prenom`,`Site`,`Email`,`Message`) VALUES ( '2','$nom','$prenom','$site','$email','$message')";
    $result=mysqli_query($link,$query);
  header("location:home.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="jouly.css" />
<title>Contactez-nous</title>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css" />
<link rel="stylesheet" type="text/css" href="file:///C:/Users/User/Downloads/fontawesome-free-5.15.3-web/css/all.css">
<link rel="icon" href="icone.ico">
<!--light-slider.css------------->
<link rel="stylesheet" type="text/css" href="lightslider.css">

<!--lightslider.js--------------->
<script type="text/javascript" src="lightslider.js"></script>
</head>
<body>
<nav>
  <div class="social-call">
    <div class="social">
      <a href="#"><i class="fab fa-facebook-square"></i></a>
      <a href="#"><i class="fab fa-youtube"></i></a>
      <a href="#"><i class="fab fa-twitter"></i></a>
      <a href="#"><i class="fab fa-instagram"></i></a>
    </div>
    <div class="phone">
      <span>Call +212 67450012</span>
    </div>
  </div>
  <div class="navigation">
    <a href="home.php" class="logo">
      <h2>JOULY</h2>
    </a>
    <div class="wrapper">
    <div class="search-input">
      <form method="get" action="search.php">
        <input type="search"name="search" placeholder="Rechercher"><button class="btn">SEARCH</button>
      </form>
      <div class="autocom-box">
      </div>
    </div>
    </div>

    <?PHP 
      if(isset($_SESSION["client"]) && isset($_SESSION["password"]))
      {
        echo ' 
        
            <div class="right-menu">
              <a href="deconnexion.php" class="user">
              <i class="fas fa-sign-out-alt"></i>
              </a>';
      }
      else
      {
        echo ' <form action="connexion.php" >
        <a href="connexion.php"><p</p></a>
        </form>
        
            <div class="right-menu">
              <a href="#" class="user">
                <i class="far fa-user"></i>
              </a>';
      }
   
     ?>
     <?php 
     $link=mysqli_connect("localhost","root","","Projetsqlphp");
     if(mysqli_connect_errno()) {
         printf("ECHEC DE LA CONNEXION :%s\n",mysqli_connect_error());
         exit();}
        $query="SELECT * from `produit-commande`";
        $result=mysqli_query($link,$query);
        $NOMBRE=mysqli_num_rows($result);
        
        ?>
      <a href="cart.php">
        <i class="fas fa-shopping-cart">
        <span class="num-cart-product"><?php echo $NOMBRE;?>
        </span>
        </i>
      </a>
    </div>
    </div>
</nav>
  
<!-------------------------------------------------login and password---------------------------------------------------------------->
<div class="form">
  <!-------------------login----------------------------->
  <div class="login-form">
    <a href="#" class="form-cancel">
      <i class="fas fa-times"></i>
    </a>
    <strong>Login</strong>
    <form method="post" action="connexion.php">
      <input type="text" placeholder="username" name="username"  id="username" required>  
      <input type="password" placeholder="Password" name="password"  id="password" required>
      <div class="choix">
       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<h3>Admin</h3>&nbsp;&nbsp;<input type="radio" value="Admin" name="Type" >
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <h3>Client</h3>&nbsp;&nbsp;&nbsp;<input type="radio" value="Client" name="Type" >
      <input type="submit" value="login">
      <a href="#" class="sign-up-btn">Create Account</a>
    </div>
    </form>
  </div>

  <div class="sign-up-form">
    <a href="#" class="form-cancel">
      <i class="fas fa-times"></i>
    </a>
    <strong>Sign Up</strong>
    <form method="post" action="connexion.php">
    <input type="text" placeholder="Username"  name="pseudo" required>
    <input type="password" placeholder="Password" name="pass" required>
      <input type="submit" value="sign up">
       <a href="#" class="already-account">Already Have Account?</a>
    </form>
  </div>
</div>


<section class="header">
  <div class="side-menu" id="side-menu">
    <ul>
      <li><a href="home.php">HOME</a></li>
      <li>Femmes<i class="fa fa-angle-right"></i>
               <ul>
              <li><a href="femme-beaute.php">Beauté</a> </li>
              <li><a href="femme-vetement.php">Vetements sportifs & chaussures</a></li>
              <li><a href="femme-robe.php">Robes & Pantalons</a></li>
              <li><a href="femme-accessoire.php">Accessoire</a></li>
                </ul>
      </li>
      <li>Hommes<i class="fa fa-angle-right"></i>
        <ul>
              <li><a href="homme-beaute.php">Beauté</a></li>
              <li><a href="homme-vetement.php">Vetements sportifs & Chaussures</a></li>
              <li><a href="homme-chemise.php">Chemises & Pantalons</a></li>
              <li><a href="homme-accessoire.php">Accessoires</a></li>
                </ul>
      </li>
      <li>Enfants<i class="fa fa-angle-right"></i>
        <ul>
              <li><a href="fille.php">Mode Fille</a></li>
              <li><a href="garçon.php">Mode Garçon</a></li>
                </ul>
      </li>
      <ul><li>&nbsp;</li></ul>
      <ul><li>&nbsp;</li></ul>
      <ul><li>&nbsp;</li></ul>
      <ul><li>&nbsp;</li></ul>
      <ul><li>&nbsp;</li></ul>
      <ul><li>&nbsp;</li></ul>
      <ul><li>&nbsp;</li></ul>
      <ul><li>&nbsp;</li></ul>
    </ul> 
  </div>
  
</section>

<!-------------------------------Contact Us------------------------------------------------------------------>


<div class="contain" id="contain">
  <div class="text">Responsive Contact Us Form</div>
  <form  method="post" action="Contact.php">
    <div class="form-row">
      <div class="input-data">
        <input type="text" name="nom" required  >
        <div class="underline"></div>
        <label>First Name</label>
      </div>
      <div class="input-data">
        <input type="text"name="prenom" required>
        <div class="underline" ></div>
        <label>Last Name</label>
      </div>
      <div class="input-data">
        <input type="text" name="email"  required>
        <div class="underline"></div>
        <label>Email Address</label>
      </div>
      <div class="input-data">
        <input type="text" name="site"required>
        <div class="underline" ></div>
        <label>Website Name</label>
      </div>
    </div>
    <div class="form-row">
      <div class="input-data textarea">
        <textarea cols="30" rows="10" name="message" required></textarea>
        <div class="underline"></div>
        <label>Write your Message</label>
      </div>
    </div>
    <div class="form-row submit-btn">
      <div class="input-data">
        <div class="inner"></div>
        <input type="submit" name="submit">
      </div>
    </div>
  </form>
</div>


<!--------------------------------Fin Contact--------------------------------------------------------------------->

<br/><br/><br/><br/>
<!-- Footer -->
  <footer id="footer" class="section footer">
    <div class="container">
      <div class="footer-container">
        <div class="footer-center">
          <h3>EXTRAS</h3>
          <a href="#">Brands</a>
          <a href="#">Gift Certificates</a>
          <a href="#">Affiliate</a>
          <a href="#">Specials</a>
          <a href="#">Site Map</a>
        </div>
        <div class="footer-center">
          <h3>INFORMATION</h3>
          <a href="#">About Us</a>
          <a href="#">Privacy Policy</a>
          <a href="#">Terms & Conditions</a>
          <a href="#">Contact Us</a>
          <a href="#">Site Map</a>
        </div>
        <div class="footer-center">
          <h3>MY ACCOUNT</h3>
          <a href="#">My Account</a>
          <a href="#">Order History</a>
          <a href="#">Wish List</a>
          <a href="#">Newsletter</a>
          <a href="#">Returns</a>
        </div>

             <div class="footer-center">
          <h3>FOLLOW US</h3>
          <div>
            <span>
              <i class="fab fa-facebook"></i>
            </span>
            FACEBOOK
          </div>
          <div>
            <span>
              <i class="fab fa-youtube"></i>
            </span>
            YOUTUBE
          </div>
          <div>
            <span>
              <i class="fab fa-linkedin"></i>
            </span>
            LINKEDIN
          </div>
          <div>
            <span>
              <i class="fab fa-twitter-square"></i>
            </span>
            TWITTER
          </div>
        </div>
      </div>
    </div>
    </div>
  </footer>
  <!-- End Footer -->


<!-----------full-slide-script-------------------->
<script>
$(document).on('click','.user',function(){
     $('.form').addClass('login-active')
});

$(document).on('click','.form-cancel',function(){
     $('.form').removeClass('login-active')
});
<!-----------full-slide-script-------------------->

  function openmenu(){
  document.getElementById("side-menu").style.display="block";
  document.getElementById("menu-btn").style.display="none";
  document.getElementById("close-btn").style.display="block";
  
}

function closemenu(){
  document.getElementById("side-menu").style.display="none";
  document.getElementById("menu-btn").style.display="block";
  document.getElementById("close-btn").style.display="none";
 
}




$(document).ready(function() {
    $('#adaptive').lightSlider({
        adaptiveHeight:true,
        auto:true,
        item:1,
        slideMargin:0,
        loop:true
    });
});

$(document).ready(function() {
    $('#jeny').lightSlider({
        jeny:true,
        item:5,
        slideMargin:0,
        loop:true
    });
});

$(document).ready(function() {
    $('#jenny').lightSlider({
        jenny:true,
        item:5,
        slideMargin:0,
        loop:true
    });
});

$(document).ready(function() {
    $('#jennny').lightSlider({
        jennny:true,
        item:5,
        slideMargin:0,
        loop:true
    });
});

$(document).on('click','.user,.already-account',function(){
     $('.form').addClass('login-active').removeClass('sign-up-active')
});

$(document).on('click','.sign-up-btn',function(){
     $('.form').addClass('sign-up-active').removeClass('login-active')
});

$(document).on('click','.form-cancel',function(){
     $('.form').removeClass('login-active').removeClass('sign-up-active')
});


</script>
</form>
</body>
</html>