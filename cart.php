<?php 

session_start(); 
error_reporting(E_ERROR | E_PARSE);
/*error_reporting(E_ALL);
ini_set('display_errors', '1');*/


if (!isset($_SESSION["client"])) {
    header("location: connexion.php"); 
    exit();
}
$link=mysqli_connect("localhost","root","","Projetsqlphp");
if(mysqli_connect_errno()) {
    printf("ECHEC DE LA CONNEXION :%s\n",mysqli_connect_error());
    exit();}  


if (isset($_POST['pid'])&& isset($_POST['qte'])) 
{  $pid = $_POST['pid'];
    $qte =$_POST['qte'];
	$exist = false;
	$i = 0;
$query="SELECT NomPro,PrixPro,QtePro,ImgPro from produits WHERE NumPro='$pid' LIMIT 1";
$result =mysqli_query($link,$query);
$productCount=mysqli_num_rows($result);
  if ($productCount > 0)
  {
		
		while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
    { $prix=$row["PrixPro"];
			if($qte > $row["QtePro"]) 
      {
         $qte = $row["QtePro"];
      }
      $max=$row["QtePro"];
      $prixtotal=$prix*$qte;
      $image=$row["ImgPro"];
      $nom=$row["NomPro"];
			 
     }
		 
	} 
  else 
  {
		echo "That item does not exist.";
	    exit();
	}
    mysqli_free_result($result);
    
    $client=$_SESSION["id"];
	
	if (!isset($_SESSION["commande"])) { 
	    
		$_SESSION["commande"] =true;
    $query="INSERT INTO `produit-commande` (`NumClient`,`NumPro`,`Nom`, `Prix`, `Qte`,`Img`, `Total`) VALUES ('$client','$pid','$nom' ,'$prix', '$qte','$image','$prixtotal')";
    $result=mysqli_query( $link,$query);
    

	} 
  else {
    $query="SELECT Qte FROM `produit-commande` WHERE NumPro='$pid'";
    $result=mysqli_query($link,$query);
    while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
    {
      $exist=true;
      $quantity=$row["Qte"];
    }
    
    if($exist==false)
    {
		$query="INSERT INTO `produit-commande` (`NumClient`,`NumPro`,`Nom`, `Prix`, `Qte`,`Img`, `Total`) VALUES ('$client','$pid','$nom' ,'$prix', '$qte','$image','$prixtotal')";
    $result=mysqli_query($link,$query);
    
    }
   else if($exist==true)
    { $qte=$qte+$quantity;
      $query="UPDATE `produit-commande`  SET Qte='$quantity' WHERE NumPro='$pid' ";
      $result=mysqli_query( $link,$query);
   }
		
	
}
	header("location: cart.php"); 
    exit();
}
?>
<?php 
if (isset($_GET['cmd']) && $_GET['cmd'] == "vide") {
  $query="DELETE FROM `produit-commande`";
  $result=mysqli_query( $link,$query);
  
}
?>
<?php 
if (isset($_GET['choix']) && $_GET['choix'] == "vrai") {
  
  $client=$_SESSION["id"];
  $total=$_SESSION["total"];
  $query="INSERT INTO commande(`NumClient`,`Montant`) VALUES ('$client','$total')";
  $result=mysqli_query( $link,$query);
 
  $query="SELECT produits.QtePro,`produit-commande`.`Qte`,produits.NumPro FROM produits,`produit-commande` WHERE produits.NumPro=`produit-commande`.`NumPro`";
  $result=mysqli_query( $link,$query);
  while($row=mysqli_fetch_array($result,MYSQLI_NUM)) {
    $new=$row['0']-$row['1'];
    
    $idpro=$row['2'];
    
  }
    
  
  $query="UPDATE produits SET QtePro='$new' WHERE NumPro='$idpro' ";
  $result=mysqli_query( $link,$query);
  

  $query="DELETE FROM `produit-commande`";
  $result=mysqli_query( $link,$query);
 

}
?>
<?PHP
if (isset($_POST['change']) && $_POST['change'] != "") {
    // execute some code
	$idchange = $_POST['change'];
	$quantity = preg_replace('#[^0-9]#i', '', $_POST['qte']); // filter everything but numbers
	if ($quantity == "") { $quantity = 1; }
  $query="UPDATE `produit-commande`  SET Qte='$quantity' WHERE NumPro='$idchange' ";
  $result=mysqli_query( $link,$query);
  
	
}
?>
<?php 
if (isset($_POST['supprimer']) && $_POST['supprimer'] != "") {
    // Access the array and run code to remove that array index
 	$idsupprimer = $_POST['supprimer'];
   $query="DELETE FROM `produit-commande`   WHERE NumPro='$idsupprimer' ";
   $result=mysqli_query( $link,$query);
   
   
}
?>
<?PHP
$query="SELECT produits.QtePro FROM produits,`produit-commande` WHERE produits.NumPro=`produit-commande`.`NumPro`";
  $result=mysqli_query( $link,$query);
  while($row=mysqli_fetch_array($result,MYSQLI_NUM)) {
    
    $QTE=$row['0'];

    
  }?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<link rel="stylesheet" href="jouly.css" />
<title>Cart</title>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css" />
<link rel="stylesheet" type="text/css" href="file:///C:/Users/User/Downloads/fontawesome-free-5.15.3-web/css/all.css">
<link rel="icon" href="icone.ico">
<!--light-slider.css------------->
<link rel="stylesheet" type="text/css" href="lightslider.css">

<!--lightslider.js--------------->
<script type="text/javascript" src="lightslider.js"></script>

<style>
 a {
  text-decoration:none;
  color:grey;
      }
.colonne {
border-left-style:none;
 border-right-style:none;
 font-size:28px;
      }
      .colonne1 {
border-left-style:none;
 border-right-style:none;
 font-size:34px;
      }
  table {
    margin-left:145px;
    border-color:grey;
  }
 .saisie{
    height:40px;
    width:125px;
    font-size:18px;

  }
  .button{
    height:40px;
    width:150px;
    font-size:22px;
    color:black;
    background-color:grey;
    border-radius:4px;
  }
  .button:hover{
    
    color:black;
    background-color:rgb(187, 187, 187);
    box-shadow:2px;
  }
  .button1{
    padding:20px;
    font-size:18px;
    color:black;
    background-color:grey;
    border-radius:4px;
    
  }
  .button:hover{
    
    color:black;
    background-color:#858282;
    box-shadow:2px;
  }
</style>  
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
        <input type="search"name="search" placeholder="Rechercher"><button type="submit" style="border:none; background:grey; color:#fff; padding:18px;">SEARCH</button>
       
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
     
    </div>
    </div>
</nav>
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
      <li><a href="home.php">HOME</a></li>
			<li>Femmes<i class="fa fa-angle-right"></i>
               <ul>
            	<li><a href="femme-beaute.php">Beauté</a> </li>
            	<li><a href="femme-vetement.php">Vetements sportifs & chaussures</a></li>
            	<li><a href="femme-robe.php">Robes & Pantalons</a></li>
              <li><a href="femme-accessoire.php">Accessoires</a></li>
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
		</ul>	
	</div>
	
</section>


    
<?PHP
if (!isset($_SESSION["commande"])) 
{
    echo '<h2 align="center">Your shopping cart is empty</h2>';

} 
else 
{   $i=0;
	  $id=$_SESSION["id"];
		$query = "SELECT * FROM `produit-commande` WHERE NumClient='$id' ";
		$result =mysqli_query($link,$query);
    $commande=mysqli_num_rows($result);
    if (isset($_SESSION["commande"])&&($commande!=0))
    {
      echo ' <table width="85%" border="1"  cellspacing="0" cellpadding="6" >
       <tr>
         <td width="35%"  class="colonne"><strong>Produit</strong></td>
         
         <td width="15%" class="colonne"><strong> Prix</strong></td>
         <td width="35%" class="colonne"><strong>Quantity</strong></td>
         <td width="15%" class="colonne"><strong>Total</strong></td>
         <td width="25%" class="colonne"><strong>Remove</strong></td>
       </tr>';
    }
    if($commande>0)
    {
      /*$i=0;
      while($i<=$commande)
      {*/
        while ($row = mysqli_fetch_array($result ,MYSQLI_ASSOC)) 
        { $i++;
          $idpro=$row["NumPro"];
          $name = $row["Nom"];
          $prix = $row["Prix"];
          $img =$row["Img"];
          $qte =$row["Qte"];
          $prixtotal = $row["Prix"] * $row["Qte"];
        $cartTotal += $prixtotal;
      
        echo'<tr>';
        echo'<td class="colonne1"><a href="produit.php?id='. $idpro .'">' . $name . '</a><br /><img src="'. $img .'" alt="'. $name.'" width="250" height="200" border="1" /></td>';
        
        echo'<td align="center" class="colonne1">' . $prix . 'DH</td>';
        echo '<td  align="center" class="colonne1"><form action="cart.php" method="post">';?>
        <input name="qte" type="number" min="1" max="<?PHP echo $QTE;?>" size="1"  placeholder="<?PHP echo $qte;?>" class="saisie"/>&nbsp;&nbsp;&nbsp;
        <?php echo '<input name="update' . $idpro . '" type="submit" value="Changer" class="button"/>';
        echo '<input name="change" type="hidden" value="' . $idpro . '" />';
        echo '</form></td>';
        echo '<td align="center"class="colonne1">' . $prixtotal . 'DH</td>';
        echo'<td align="center" class="colonne1"><form action="cart.php" method="post"><input name="delete' . $idpro . '" type="submit" value="Supprimer" class="button"/>
        
        <input name="supprimer" type="hidden" value="' . $idpro . '" /></form></td>';
        echo '</tr>';
        
        }
       /* 
       $i++;
      }*/
      
      $_SESSION["total"]=$cartTotal;
      
      echo '</table>';
      echo' <div style="font-size:24px; margin-top:12px;  margin-right:120px;" align="right" >Cart Total : '.$cartTotal.' DH</div>';
   }
    if($commande==0 &&$_GET['choix'] != "vrai")
    {
     echo '<h2 align="center">Your shopping cart is empty</h2>';
    }
   if($commande==0 && $_GET['choix'] == "vrai")
   {
    echo '<h2 align="center">Your shopping cart is confirmed</BR></BR></BR> Thank you for Shopping in JOULY</h2>';
   }
}
?>   
     
    <br />
    <?php
    if (isset($_SESSION["commande"])&&($commande!=0))
    {
    echo '<a href="cart.php?cmd=vide" class="button1" style="margin-left:500px;">Click Here to Empty Your Shopping Cart</a>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <a href="cart.php?choix=vrai" class="button1">Confirm</a>';
    }
    ?>
    </div>
   <br />
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