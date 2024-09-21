<?php
session_start();

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<link rel="stylesheet" href="jouly.css" />
<title>Jouly</title>
<link rel="icon" href="icone.ico">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css" />
<link rel="stylesheet" type="text/css" href="file:///C:/Users/User/Downloads/fontawesome-free-5.15.3-web/css/all.css">
<!--light-slider.css------------->
<link rel="stylesheet" type="text/css" href="lightslider.css">
<!--Jquery-------------------->
<script src="jQuery.js"></script>
<!--lightslider.js--------------->
<script type="text/javascript" src="lightslider.js"></script>
<?PHP
$link=mysqli_connect("localhost","root","","projetsqlphp");

if(mysqli_connect_errno()) {
	printf("ECHEC DE LA CONNEXION :%s\n",mysqli_connect_error());
	exit();}
	
    ?>
    
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
    <i class="fas fa-bars" id="menu-btn"  onclick="openmenu()"></i>
    <i class="fas fa-times" id="close-btn" style="display:none;" onclick="closemenu()"></i>
    <a href="home.php" class="logo">
      <h2>JOULY</h2>
    </a>
    <div class="wrapper">
    <div class="search-input">
      <form method="get" action="search.php">
        <input type="search"name="search" placeholder="Rechercher"><button  type="submit" class="btn">SEARCH</button>
       
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
            <i style="display:inline-block;" class="far fa-user">'.$_SESSION["client"].'</i>
            
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
                
                <i class="fas fa-sign-in-alt"></i>
              </a>';
      }
   
     ?>
     <?php 
        $query="SELECT * from `produit-commande`";
        $result=mysqli_query($link,$query);
        $NOMBRE=mysqli_num_rows($result);
        
      if(isset($_SESSION["client"]))
      {echo '
      <a href="cart.php">
        <i class="fas fa-shopping-cart">
        <span class="num-cart-product">'.$NOMBRE.'
        </span>
        </i>
      </a>';
     }
     else {
       $NOMBRE=0;
       $query="DELETE FROM `produit-commande`";
       $result=mysqli_query( $link,$query);
       echo '
      <a onclick="ErrorMessage()" href="#" class="user">
      <i class="fas fa-shopping-cart">
      <span class="num-cart-product">'.$NOMBRE.'
      </span>
      </i>
    </a>';}?>
    </div>
    </div>
</nav>
  
<!-------------------------------------------------login and password---------------------------------------------------------------->
<?php
if(!isset($_SESSION["client"])){
echo'<div class="form">
  <!-------------------login----------------------------->
  <div class="login-form">
    <a href="#" class="form-cancel">
      <i class="fas fa-times"></i>
    </a>
    <strong>Login</strong>
    <form method="post" action="connexion.php">
      <input type="text" placeholder="Username" name="username"  id="username" required></br>
      <input type="password" placeholder="Password" name="password"  id="password" required>
      <div class="choix">
       <label for="Type"><h4>Admin</h4></label><input type="radio" value="Admin" name="Type" required >
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <label for="Type"><h4>Client</h4></label>
     <input type="radio" value="Client" name="Type" required >
      &nbsp;&nbsp;<input type="submit" value="login">
      <h4 id="message" style="display:none;" ></h4>
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
</div>';
}?>
<section class="header">
	<div class="side-menu" id="side-menu" style="display:none;">
		<ul>
      <li>HOME</li>
			<li>Femmes<i class="fa fa-angle-right"></i>
               <ul>
            	<li><a href="femme-beaute.php">Beauté</a> </li>
            	<li><a href="femme-vetement.php"> Chaussures</a></li>
            	<li><a href="femme-robe.php">Robes & Pantalons</a></li>
              <li><a href="femme-accessoire.php">Accessoires</a></li>
                </ul>
			</li>
			<li>Hommes<i class="fa fa-angle-right"></i>
				<ul>
              <li><a href="homme-beaute.php">Beauté</a></li>
            	<li><a href="homme-vetement.php"> Chaussures</a></li>
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

<!---------------------------------------------------------------------slide-------------------------------------------------------------------->

<ul id="adaptive" class="cs-hidden">
  <!----------box-1------>
  <li class="item-a">
     <!----------box------->
     <div class="slide f-slide-1">
   <!------------slider-text--------------->
   <div class="slider-text">
    <div class="f-slide-text">
        <span>Limited offer</span>
        <strong>10% off<br/> with<font> promo code</font></strong>
        </div>
     </div>
     </div>
  </li>

  <!----------box-2------>
  <li class="item-a">
     <!----------box------->
     <div class="slide f-slide-2">
   <!------------slider-text--------------->
   <div class="slider-text">
    <div class="f-slide-text">
        <span>Limited offer</span>
        <strong>10% off<br/> with<font> promo code</font></strong>
        </div>
     </div>
     </div>
  </li>



    <!----------box-3------>
  <li class="item-a">
     <!----------box------->
     <div class="slide f-slide-3">
   <!------------slider-text--------------->
   <div class="slider-text">
    <div class="f-slide-text">
        <span>Limited offer</span>
        <strong>10% off<br/> with<font> promo code</font></strong>
        </div>
     </div>
     </div>
  </li>


</ul>

<!--------------------------------------------------------------------Collection------------------------------------------------------------>

 <div class="arrival-heading">
     <strong>New Arrival</strong>
    <p>We Provide You New Fasion Design Clothes</p>
 </div>
<br/><br/>

<div class="title-box">
<h2>HOMMES</h2>
</div>
<ul id="jeny" class="cs-hidden">

  
  <!----------box-1------>
  <?PHP 
   $query="SELECT NumPro,NomPro,PrixPro,ImgPro,RatingPro FROM `produits` WHERE NouvellePro='1' AND TypePro='Nouveaute homme'";
   $result =mysqli_query($link,$query);
  while($row = mysqli_fetch_array($result ,MYSQLI_ASSOC)) 
  {
   echo' <li class="item-1" id="item-1">
    
      <!--product-box-1---------->
                <div class="product-box">
                      <!--product-img------------>
                      <div class="product-img">
                          <!--img------>
                          <a href="produit.php?id='.$row["NumPro"].'"><img  src="'.$row["ImgPro"].'"></a>
                      </div>
                      <!--product-details-------->
                      <div class="product-details">
                          <a href="#" class="p-name">'.$row["NomPro"].'</a>
                          <div class="stars">';
                          $i=1;
                          while($i<=$row["RatingPro"])
                          {
                            echo'
                          <i class="fas fa-star"></i>';
                           $i++;
                          }?>
                          <?php
                          echo '</div>
                          <span class="p-price">'.$row["PrixPro"].'DH</span>
                          
                          
                           <a align="center" class="achat" href="produit.php?id='.$row["NumPro"].'" ><h4>Add to Cart&nbsp;&nbsp;<i class="fas fa-shopping-cart"></i></h4></a>
                          
                      </div>
                  </div>
              </div>
    </li>';
  }
  
                  
                ?>
</ul> 
<br/><br/><br/><br/>
<div class="title-box">
<h2>FEMMES</h2>
</div>
<ul id="jenny" class="cs-hidden">

  
  <!----------box-1------>
  <?PHP 
  $query="SELECT NumPro,NomPro,PrixPro,ImgPro,RatingPro FROM `produits` WHERE TypePro='Nouveaute femme'";
	$result =mysqli_query($link,$query);
  while($row = mysqli_fetch_array($result ,MYSQLI_ASSOC)) 
  {
   echo' <li class="item-1">
    
      <!--product-box-1---------->
                <div class="product-box">
                      <!--product-img------------>
                      <div class="product-img">
                          <!--img------>
                          <a href="produit.php?id='.$row["NumPro"].'"><img  src="'.$row["ImgPro"].'"></a>
                      </div>
                      <!--product-details-------->
                      <div class="product-details">
                          <a href="#" class="p-name">'.$row["NomPro"].'</a>
                          <div class="stars">';
                          $i=1;
                          while($i<=$row["RatingPro"])
                          {
                            echo'
                          <i class="fas fa-star"></i>';
                           $i++;
                          }?>
                          <?php
                          echo '</div>
                          <span class="p-price">'.$row["PrixPro"].'DH</span>';
                          if(isset($_SESSION["client"]))
                          {echo'
                           <a align="center" class="achat" href="produit.php?id='.$row["NumPro"].'" ><h4>Add to Cart&nbsp;&nbsp;<i class="fas fa-shopping-cart"></i></h4></a>';
                          }
                          else {
                          echo'
                           <a onclick="ErrorMessage()" href="#" class="user" align="center" style="width: 60%;
                           border: 5px solid grey;
                           font-size: 15px;
                           padding: 0px;
                           background: grey;
                           color: white; 
                           float: center;" ><h4>Add to Cart&nbsp;&nbsp;<i class="fas fa-shopping-cart"></i></h4></a>';
                          }
                     echo' </div>
                  </div>
              </div>
    </li>';

  }
  
  ?>
  </UL>
  <div class="title-box">
<h2>Enfants</h2>
</div>
<ul id="jennny" class="cs-hidden">

  
  <!----------box-1------>
  <?PHP 
  $query="SELECT NumPro,NomPro,PrixPro,ImgPro,RatingPro FROM `produits` WHERE NouvellePro='1' AND TypePro='Nouveaute enfants'";
	$result =mysqli_query($link,$query);
  while($row = mysqli_fetch_array($result ,MYSQLI_ASSOC)) 
  {
   echo' <li class="item-1">
    
      <!--product-box-1---------->
                <div class="product-box">
                      <!--product-img------------>
                      <div class="product-img">
                          <!--img------>
                        <a href="produit.php?id='.$row["NumPro"].'"><img  src="'.$row["ImgPro"].'"></a>
                      </div>
                      <!--product-details-------->
                      <div class="product-details">
                          <a href="#" class="p-name">'.$row["NomPro"].'</a>
                          <div class="stars">';
                          $i=1;
                          while($i<=$row["RatingPro"])
                          {
                            echo'
                          <i class="fas fa-star"></i>';
                           $i++;
                          }?>
                          <?php
                          echo '</div>
                          <span class="p-price">'.$row["PrixPro"].'DH</span>';
                          if(isset($_SESSION["client"]))
                          {echo'
                           <a align="center" class="achat" href="produit.php?id='.$row["NumPro"].'" ><h4>Add to Cart&nbsp;&nbsp;<i class="fas fa-shopping-cart"></i></h4></a>';
                          }
                          else {
                          echo'
                           <a onclick="ErrorMessage()" href="#" class="user" align="center" style="width: 60%;
                           border: 5px solid grey;
                           font-size: 15px;
                           padding: 0px;
                           background: grey;
                           color: white; 
                           float: center;" ><h4>Add to Cart&nbsp;&nbsp;<i class="fas fa-shopping-cart"></i></h4></a>';
                          }
                     echo' </div>
                  </div>
              </div>
    </li>';

  }
  ?>
  </UL>
<!-- Contact -->
   <header>
     <h1>C'est votre boutique, Vous etes chez-vous.</h1>
     <div class="buttons">
     
     <?php
     if(isset($_SESSION["client"]))
     {echo'
     <button ><a href="Contact.php">Contactez-nous</a></button>';
      }
      else {
        echo'
     <button ><a onclick="ErrorMessage()" href="#" class="user">Contactez-nous</a></button>';
      }
      ?></div>
   </header>
  <!-- Fin du Contact -->


<br/><br/><br/><br/>
<!-- Footer -->
  <footer id="footer" class="section footer" >
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
function ErrorMessage(){
  document.getElementById("message").style.display="inline";
  document.getElementById("message").innerHTML="Connectez-vous pour activer ce page";
  document.getElementById("message").style.color="red";
}

</script>

<script type="text/javascript">

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
focusScrollMethod = function getFocus() {
  document.getElementById("item-1").focus({preventScroll:false});
}
</script>

</form>
</body>
</html>