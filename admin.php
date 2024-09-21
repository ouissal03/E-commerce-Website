<?php 
session_start();
error_reporting(E_ERROR | E_PARSE);
ini_set('display_errors', '1');
if (!isset($_SESSION["admin"])) {
    header("location: connexion.php"); 
    exit();
}

$id = preg_replace('#[^0-9]#i', '', $_SESSION["id"]); 
$admin = preg_replace('#[^A-Za-z0-9]#i', '', $_SESSION["admin"]);
$password = preg_replace('#[^A-Za-z0-9]#i', '', $_SESSION["password"]); 
 
$link=mysqli_connect("localhost","root","","Projetsqlphp");
if(mysqli_connect_errno()) {
    printf("ECHEC DE LA CONNEXION :%s\n",mysqli_connect_error());
    exit();} 
$query = "SELECT * FROM `tableadmin` WHERE ID='$id' AND USERNAME='$admin' AND PASSWORD='$password' LIMIT 1"; 
$result =mysqli_query($link,$query);
$existCount = mysqli_num_rows($result); 
if ($existCount == 0) { 
	 echo "Your login session data is not on record in the database.";
     exit();
}

 if(isset($_POST["product_name"])&&isset($_POST["price"])&&isset($_POST["qte"])&&isset($_POST["type"])&&isset($_POST["details"])&&isset($_POST["image"]))
  {$product_name=$_POST["product_name"];
    $price=$_POST["price"];
    $qte=$_POST["qte"];
    $type=$_POST["type"];
    $details=$_POST["details"];
    $img=$_POST["image"];
    
    
    $query = "UPDATE produits  SET NomPro='$product_name', PrixPro='$price',QtePro='$qte',TypePro='$type',CaracPro='$details',NouvellePro='1',ImgPro='$img'WHERE NumPro='$idchange' ";

    $result =mysqli_query($link,$query);
    if($result)
    {
       
    }
  }


if(isset($_POST["name"])&&isset($_POST["prix"])&&isset($_POST["Qte"])&&isset($_POST["Type"])&&isset($_POST["Details"])&&isset($_POST["Image"]))
  {$product_name=$_POST["name"];
    $price=$_POST["prix"];
    $qte=$_POST["Qte"];
    $type=$_POST["Type"];
    $details=$_POST["Details"];
    $img=$_POST["Image"];
    
   

    $query = "INSERT INTO produits (`NomPro`,`PrixPro`,`QtePro`, `TypePro`, `CaracPro`,`NouvellePro`,`ImgPro`) VALUES ('$product_name','$price','$qte' ,'$type', '$details','1','$img')"; 
    $result =mysqli_query($link,$query);
    if($result)
    {
       
    }
  }
 
 if(isset($_POST["idvoir"]))
{$idvoir=$_POST["idvoir"];
    $query="SELECT * FROM produits WHERE NumPro=$idvoir LIMIT 1";
    $result =mysqli_query($link,$query);
    while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
    {
     $name=$row["NomPro"];
    $prix=$row["PrixPro"];
    $Qte=$row["QtePro"];
    $Type=$row["TypePro"];
    $info=$row["CaracPro"];
    $image=$row["ImgPro"];
    }
    mysqli_free_result($result);
}

if(isset($_POST["idsupprimer"]))
{$idsupprimer=$_POST["idsupprimer"];
    $query="DELETE FROM produits where NumPro ='$idsupprimer' LIMIT 1";
    $result =mysqli_query($link,$query);
}

if(isset($_POST["requete"])){
  $requete=$_POST["requete"];
  $query="$requete";
  $result =mysqli_query($link,$query);
  if($result)
  {
    echo 'Requete Executee<a href="admin.php">Click ici</a>';
  }
  else {
    echo 'Il y a une error dans la requete<a href="admin.php">Click ici</a>';
  }

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

<!--lightslider.js--------------->
<script type="text/javascript" src="lightslider.js"></script>
<?PHP
$link=mysqli_connect("localhost","root","","projetsqlphp");

if(mysqli_connect_errno()) {
  printf("ECHEC DE LA CONNEXION :%s\n",mysqli_connect_error());
  exit();}
  $query="SELECT NumPro,NomPro,PrixPro,ImgPro FROM `produits` WHERE NouvellePro='1' and NumPro!='$id'";
  $result =mysqli_query($link,$query);
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
        <input type="search"name="search" placeholder="Rechercher"><button class="btn">SEARCH</button>
      </form>
    </div>
    </div>

      <?PHP 
      if(isset($_SESSION["admin"]) && isset($_SESSION["password"]))
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
<?php
if(!isset($_SESSION["admin"])){
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
              <li><a href="garcon.php">Mode Garçon</a></li>
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

  <div class="Contner" id="Contner">
<div class="descrip">
<h2 align="center">Welcome  <?php echo $admin;  ?></h2>
<div class="nompro">
<p><h3>&nbsp;&nbsp;&nbsp;Executer une requete SQL</h3>
<?php 
if(!isset($_POST["requete"]))
{
echo '<form method="post" action="admin.php"  name="myForm" id="myform" >
<div class="search-input">
<textarea name="requete" id="requete" style="margin-left:20px;"cols="64" rows="5"/></textarea>
</br></div>
<input type="submit" name="button" class="bton" id="button" value="Executer"style="margin-left:20px;" />
</form></div>';
}
?></p>
<br/>
<p>Inserer un Objet</p>
<form method="post" action="admin.php"  name="myForm" id="myform" >
    <table width="90%" border="0" cellspacing="0" cellpadding="6">
      <tr>
        <td width="30%" align="left"><h4>Product Name :</h4></td>
        <td width="80%"><label>
          <div class="search-input"><input name="name" type="text" id="product_name" size="64" required/></div>
        </label></td>
      </tr>
      <tr>
        <td align="left"><h4>Product Price :</h4></td>
        <td><label>
          <div class="search-input"><input name="prix" type="text" id="price" size="64" required /></div>
        </label></td>
      </tr>
      <tr>
      <td align="left"><h4>Product Quantity :</h4></td>
        <td><label>
          <div class="search-input"><input name="qte" type="number" id="qte" size="64" required /></div>
        </label></td>
      </tr>
      <tr>
        <td align="left"><h4>Product Type :</h4></td>
        <td><select name="Type" id="type" class="opt" required>
          <option value=" "></option>
          <option value="fille">fille</option>
          <option value="garçon">garçon</option>
          <option value="beaute femme ">beaute femme </option>
          <option value="beaute homme">beaute homme</option>
          <option value="Nouveaute femme">Nouveaute femme</option>
          <option value="Nouveaute homme">Nouveaute homme</option>
          <option value="accessoire">accessoire</option>
          <option value="femmes chaussures">femmes chaussures</option>
           <option value="femmes robe&pantalon">femmes robe&pantalon</option>
            <option value="homme accessoire">homme accessoire</option>
            <option value="homme accessoire">homme accessoire</option>
            <option value="homme chaussures">homme chaussures</option>
            <option value="homme chemise&pantalon">homme chemise&pantalon</option>
            <option value="Nouveaute enfants">Nouveaute enfants</option>
            <option value="Nouveaute femme">Nouveaute femme</option>
            <option value="Nouveaute homme">Nouveaute homme</option>
          </select></td>
      </tr>
      <tr>
        <td align="left"><h4>Product Details :</h4></td>
        <td><label>
        <div class="search-input">  
        <textarea name="Details" id="details" cols="68" rows="5" required></textarea>
        </div></label></td>
      </tr>
      <tr>
        <td align="left"><h4>Product Image :</h4></td>
        <td><label>
          <div class="search-input"><input type="text" name="Image" id="image" size="64" required/></div>
        </label></td>
      </tr>      
      <tr>
        <td><label>
        <div class="nompro"><input type="submit" name="button" class="bnN" id="button" value="Insert"/></div>
        </label></td>
      </tr>
    </table>
    </form>
    <br>
<!--------idchange----->
<p>Voir un objet</p>
<?php 
if(!isset($_POST["idvoir"]))
{
echo '<form method="post" action="admin.php"  name="myForm" id="myform">
<div class="nompro">
<h4><div class="search-input">NumPro :<input type= "number" name="idvoir" id="idvoir" required/></div></h4>
<input type="submit" name="button" class="bton" id="button" value="Voir" /></div>
</form>';
}
else 
{
  



    echo ' <table width="100%" border="1" cellspacing="0" cellpadding="6">
       <tr>
         <td width="35%"  class="colonne"><strong>Produit</strong></td>
         
         <td width="12%" class="colonne"><strong> Prix</strong></td>
         <td width="20%" class="colonne"><strong>Quantity</strong></td>
         <td width="12%" class="colonne"><strong>Details</strong></td>
       </tr>';
       echo'<tr>';
		echo'<td>' .$name.' <br /><img src="'. $image .'" alt="'. $name.'" width="250" height="200" border="1" /></td>';
		
		echo'<td align="center">'.$prix.'DH</td>';
		echo '<td align="center">' .$Qte .'DH</td>';
		
		echo '<td align="center">'. $info .'</td>';
		echo '</tr>';
    
    
      echo '</table>';
}
?>


<br>
<br>
<br>
<p>Changer un objet</p>
<?php 
if(!isset($_POST["idchange"]))
{
echo '<form method="post" action="admin.php"  name="myForm" id="myform" >
<div class="nompro">
<h4><div class="search-input">NumPro :<input type= "number" name="idchange" id="idchange" required/></div></h4>
<input  type="submit"  name="button" class="bton" id="button" value="Changer"/></div>
</form>';
}
else 
{   
    $idchange=$_POST["idchange"];
    $query="SELECT * FROM produits where NumPro='$idchange' LIMIT 1";
    $result =mysqli_query($link,$query);
    while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
    {
        $product_name=$row["NomPro"];
    $price=$row["PrixPro"];
    $qte=$row["QtePro"];
    $type=$row["TypePro"];
    $details=$row["CaracPro"];
    $img=$row["ImgPro"];
    }
    echo ' 
    <form action="admin.php"  name="myForm" id="myform" method="post">
    <table width="90%" border="0" cellspacing="0" cellpadding="6">
      <tr>
        <td width="20%" align="right"><h4>Product Name</h4></td>
        <td width="80%"><label>
          <input name="product_name" type="text" id="product_name" size="64" value=" '.$product_name.'" required/>
        </label></td>
      </tr>
      <tr>
        <td align="right"><h4>Product Price</h4></td>
        <td><label>
          
          <input name="price" type="text" id="price" size="12" value="'. $price.'DH" required/>
        </label></td>
      </tr>
      <tr>
      <td align="right"><h4>Product Quantity</h4></td>
        <td><label>
          
          <input name="qte" type="number" id="qte" size="12" value="'. $qte.'" required/>
        </label></td>
      </tr>
      <tr>
        <td align="right"><h4>Product Type</h4></td>
        <td><select name="type" id="type">
          <option value="'. $type.'">'.$type.'</option>
          <option value="fille">fille</option>
          <option value="garçon">garçon</option>
          <option value="beaute femme ">beaute femme </option>
          <option value="beaute homme">beaute homme</option>
          <option value="Nouveaute femme">Nouveaute femme</option>
          <option value="Nouveaute homme">Nouveaute homme</option>
          <option value="accessoire">accessoire</option>
          <option value="femmes chaussures">femmes chaussures</option>
           <option value="femmes robe&pantalon">femmes robe&pantalon</option>
            <option value="homme accessoire">homme accessoire</option>
            <option value="homme accessoire">homme accessoire</option>
            <option value="homme chaussures">homme chaussures</option>
            <option value="homme chemise&pantalon">homme chemise&pantalon</option>
            <option value="Nouveaute enfants">Nouveaute enfants</option>
            <option value="Nouveaute femme">Nouveaute femme</option>
            <option value="Nouveaute homme">Nouveaute homme</option>
          </select></td>
      </tr>
      <tr>
        <td align="right">Product Details</td>
        <td><label>
          <textarea name="details" id="details" cols="64" rows="5" required>'. $details.'</textarea>
        </label></td>
      </tr>
      <tr>
        <td align="right">Product Image</td>
        <td><label>
          <input type="text" name="image" id="image"  value="'.$img.'" required/>
        </label></td>
      </tr>      
      <tr>
        <td>&nbsp;</td>
        <td><label>
          <input name="thisID" type="hidden" value="'.$idchange.'" required/>
          <input type="submit" name="button" class="btn" id="button" value="Make Changes" style="width:200px; />
        </label></td> </tr>
    </table>
    </form>';
}
?>
</br>
</br>
</br>
<p>Supprimer un objet</p>
<form action="admin.php"  name="myForm" id="myform" method="post">
  <div class="nompro">
  <h4><div class="search-input">NumPro :<input type= "number" name="idsupprimer" id="idsupprimer"/></div></h4>
<input type="submit" name="button" class="bton" id="button" value="Supprimer" /></div>
</form><br/><br/><br/>
<p>Les dernieres commandes</p>
<table border="1" style="font-size:18px;" class="content-table" align="center">
  <thead>
  <tr ><th witdh="30%"align="center" class="colonne" >N°commande</th>
  <th witdh="30%" align="center" class="colonne" >NomClient</th>
  <th witdh="30%"align="center" class="colonne" >Date</th>
  <th witdh="30%"align="center" class="colonne" >Montant</th></tr></thead>
<?php
 $query = "SELECT `commande`.`N°commande`,tableclient.USER,commande.Montant,commande.DATE FROM `commande`,`tableclient`WHERE commande.NumClient=tableclient.NumClient ORDER BY `commande`.`N°commande` DESC LIMIT 5";
  $result=mysqli_query($link,$query);
  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
  {
   echo '<tbody><tr><td align="center" >'.$row["N°commande"].'</TD>
    <td align="center" >'.$row["USER"].'</TD>
    <td align="center" >'.$row["DATE"].'</TD>
    <td align="center" >'.$row["Montant"].'DH</TD></tr></tbody>' ;
    $profit+=$row["Montant"];
  }
?>
<tr><td colspan="2">Profit</td>
<td align="center" colspan="2"><?php echo $profit;?>&nbsp;DH</TD></TR>
</table>
</br>
<div class="nompro"><a href="admin.php" class="bton" id="button" align="center">Refresh</a></div>
</div></div>

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
    $(document).on('click','.user,.already-account',function(){
     $('.form').addClass('login-active').removeClass('sign-up-active')
});

$(document).on('click','.sign-up-btn',function(){
     $('.form').addClass('sign-up-active').removeClass('login-active')
});

$(document).on('click','.form-cancel',function(){
     $('.form').removeClass('login-active').removeClass('sign-up-active')
});

function AugmenterHeight() {
document.getElementById("Contner").style.height="3000px";
}
  </script>

</form>
</body>
</html>  