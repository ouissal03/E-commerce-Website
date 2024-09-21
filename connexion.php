<?php 
session_start();
if (isset($_SESSION["admin"])) {
    header("location: admin.php"); 
    exit();
}
?>
<?php 
$link=mysqli_connect("localhost","root","","Projetsqlphp");
if(mysqli_connect_errno()) {
    printf("ECHEC DE LA CONNEXION :%s\n",mysqli_connect_error());
    exit();}
	
if (isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["Type"])) 
{
    
        $person = preg_replace('#[^A-Za-z0-9]#i', '', $_POST["username"]); 
$password = preg_replace('#[^A-Za-z0-9]#i', '', $_POST["password"]); 
$type =$_POST["Type"];
if($type =='Admin') {

   
    $query="SELECT ID FROM `tableadmin` WHERE USERNAME ='$person' AND PASSWORD='$password' LIMIT 1";
    $result =mysqli_query($link,$query);
    $existCount = mysqli_num_rows( $result); 
 if ($existCount == 1) 
 { 
    
     
   while($row = mysqli_fetch_array($result ,MYSQLI_ASSOC))
     { 
     $id = $row["ID"];
	   }
		 $_SESSION["id"] = $id;
		 $_SESSION["admin"] = $person;
		 $_SESSION["password"] = $password;
		 header("location: admin.php");
         exit();
 } 
  else 
   {
		echo 'That information is incorrect, try again <a href="admin.php">Click Here</a>';
		exit();
	  }
    mysqli_free_result($result);

}

if($type =='Client')
{
    $query="SELECT NumClient FROM `tableclient` WHERE USER='$person' AND PASS ='$password' LIMIT 1";/*** */
     $result =mysqli_query($link,$query);
    $existCount = mysqli_num_rows($result); 
 if ($existCount == 1) 
 { 
   
     
   while($row = mysqli_fetch_array($result ,MYSQLI_ASSOC))
     { 
     $id = $row["NumClient"];
	   }
		 $_SESSION["id"] = $id;
		 $_SESSION["client"] = $person;
		 $_SESSION["password"] = $password;
		 header("location:home.php");
         exit();
 } 
 else 
  {
		echo 'That information is incorrect, try again <a href="home.php">Click Here</a>';
		exit();
	}
    mysqli_free_result($result);
}

}
if (isset($_POST["pseudo"]) && isset($_POST["pass"]))
{

    $client = preg_replace('#[^A-Za-z0-9]#i', '', $_POST["pseudo"]); 
    $pass = preg_replace('#[^A-Za-z0-9]#i', '', $_POST["pass"]); 
    $query="INSERT INTO `tableclient` ( `USER`, `PASS`) VALUES ('$client', '$pass')";
    $result =mysqli_query($link,$query);

    $query="SELECT NumClient FROM `tableclient` WHERE USER='$client' AND PASS ='$pass' LIMIT 1";
    $result =mysqli_query($link,$query);
    $existCount = mysqli_num_rows($result); 
 if ($existCount == 1)
  {
     while($row = mysqli_fetch_array($result ,MYSQLI_ASSOC))
     { 
     $id = $row["NumClient"];
	   }
		 $_SESSION["id"] = $id;
		 $_SESSION["client"] = $client;
		 $_SESSION["password"] = $pass;
		 header("location:home.php");
         exit();
  }
   
 else 
 {
		echo 'That information is incorrect, try again <a href="home.php">Click Here</a>';
		exit();
	}
    mysqli_free_result($result);

} 

mysqli_close($link);
?>




