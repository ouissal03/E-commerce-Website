<?php

session_start();

if (isset($_GET['id'])) {
  $link=mysqli_connect("localhost","root","","Projetsqlphp");
  if(mysqli_connect_errno()) {
      printf("ECHEC DE LA CONNEXION :%s\n",mysqli_connect_error());
      exit();}
    
	$id = preg_replace('#[^0-9]#i', '', $_GET['id']); 
 $query="SELECT * FROM produits WHERE NumPro='$id' LIMIT 1";
 $result=mysqli_query($link,$query);
	$productCount = mysqli_num_rows($result); 
    if ($productCount > 0) {
		
      while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
      { 
        $Nom = $row["NomPro"];
        $Prix = $row["PrixPro"];
        $details = $row["CaracPro"];
        $image = $row["ImgPro"];
        $type=$row["TypePro"];
        $QTE=$row["QtePro"];
        $rating=$row["RatingPro"];
          }
		 
	} else {
		echo "That item does not exist.";
	    exit();
	}
		
} else {
	echo "Data to render this page is missing.";
	exit();
}

?>


<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="jouly.css" />
<title><?php echo  $Nom;?></title>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css" />
<link rel="stylesheet" type="text/css" href="file:///C:/Users/User/Downloads/fontawesome-free-5.15.3-web/css/all.css">
<link rel="icon" href="icone.ico">
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
    <i class="fas fa-bars" id="menu-btn"></i>
    <a href="#" class="logo">
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
              <a href="deconnexion.php" class="user">
              <i class="fas fa-sign-out-alt"></i>
              </a>';
      }
      else
      {
        echo ' <form action="connexion.php" >
        <a href="connexion.php"></p></a>
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
  
<!-----------------------------------------login and password--------------------------------------------------------->
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

<!--------------------------------------------Infos Product------------------------------------------------------------>

<!-- partial:index.partial.html -->
<div class="contner" width="20%" height="50%">
  <br/>
  <div class="images">
    <img src="<?php echo $image;?>" />
  </div>
  <div class="slideshow-buttons">
    <div class="one"></div>
    <div class="two"></div>
    <div class="three"></div>
    <div class="four"></div>
  </div>
<div class="production">
    
 <p><?php echo $Nom;?></p>
 <div class="stars">
    <?php 
    $i=1;
    while($i<=$rating)
    {
      echo'
    <i class="fas fa-star"></i>';
     $i++;
    }?>
  </DIV>
    <br/>
    <div class="num"><em><?php echo $Prix.'&nbsp;DH'; ?></em></div>
    <br/>
    <form id="form1" name="form1" method="post" action="cart.php">
    <div class="quantit"><p>Quantity: <input type="number"min="1" max="<?PHP echo $QTE;?>" name="qte" id="qte"  value="1"/></p></div>
    <div class="desc">
    <p><?php echo $details; ?>
      </p>
    </div>
   
        <input type="hidden" name="pid" id="pid" value="<?php echo $id; ?>" />
    <div class="buttons">
      <?php
      if(isset($_SESSION["client"]))
      {echo'
      <button type="submit" name="button" id="button" class="addation">Add to Cart&nbsp;&nbsp;<i class="fas fa-shopping-cart"></i></button></form>'; }
      else {
       echo '<form action="connexion.php" >
       <a href="connexion.php"><p</p></a>
       </form>
       
             <a id="button"onclick="ErrorMessage()" href="#" class="user" style="border: 15px solid grey;
             font-size: 15px;
             padding: 5px;
             background: grey;
             color: white; 
             float: center;">
              Add to Cart&nbsp;&nbsp;<i class="fas fa-shopping-cart"></i>
             </a>';
      }?>
    
    </div>
</div>
  <br/><br/><br/><br/><br/><br/>
<div class="arrival-heading">
     <strong>Other Colletion</strong>
 </div>
<br/><br/>
<!--------------------------------------------------FIN----------------------------------------------------------->
<ul id="jeny" class="cs-hidden">
  <!--product-box-5---------->
  <?PHP 
  $query="SELECT NumPro,NomPro,PrixPro,ImgPro FROM `produits` WHERE NouvellePro='1' and NumPro!='$id'";
	$result =mysqli_query($link,$query);
  while($row = mysqli_fetch_array($result ,MYSQLI_ASSOC)) 
  {
   ?>
   <li class="item-1">
      <!--product-box-1---------->
                  <div class="product-box">
                      <!--product-img------------>
                      <div class="product-img">
                          <!--img------>
                          <?php
                          echo'
                          <a href="produit.php?id='.$row["NumPro"].'"><img  src="'.$row["ImgPro"].'"></a>';?>
                      <!--product-details-------->
                      </div>
                          <a href="#" class="p-name"><?= $row["NomPro"]; ?></a>
                          <div class="stars">
                        <i class="fas fa-star"></i>
                          <i class="fas fa-star"></i>
                          <i class="fas fa-star"></i>
                          <i class="fas fa-star"></i>
                          <i class="fas fa-star-half-alt"></i>
                         </div>
                          <span class="p-price"><?=$row["PrixPro"]; ?>&nbsp;DH</span>
                          <a class="achat" href="produit.php?id=<?=$row["NumPro"] ?>" ><h6 align="center">Add to Cart&nbsp;<i class="fas fa-shopping-cart"></i></h6></a>
              </div>
</li>

 <?php 

  }
                  mysqli_close($link);
                ?></ul><br/><br/>
               </div>
<!---------------------------------------------Fin infos Product------------------------------------------------------->
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
  <script>
$(document).ready(function() {
    $('#jeny').lightSlider({
        jeny:true,
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
function ErrorMessage(){
  document.getElementById("message").style.display="inline";
  document.getElementById("message").innerHTML="Connectez-vous pour activer ce page";
  document.getElementById("message").style.color="red";
}
  </script>

</form>
</body>
</html>  