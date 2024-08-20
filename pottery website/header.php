<?php session_start();  ?>
<!DOCTYPE html >
<html x>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Pottery Shop</title>
<meta name="keywords" content="Pottery ShopL" />
<meta name="description" content="Pottery Shop" />
<link href="templatemo_style.css" rel="stylesheet" type="text/css" />

</head>
<body>
<div id="templatemo_container">
<div id="templatemo_top_panel">
    
        <div id="templatemo_shopping_cart">
       	   <span><a href="cart.php">  Shopping Cart</a></span>      
        </div>
  </div>
     
     <div id="templatemo_header">
     <h2> The Pottery Shop</h2>
     </div>
  
     
<div id="templatemo_menu_panel">
        <ul>
            <li><a href="index.php" class="current">Home</a></li>
            
<li><a href="Contact.php">Contact Us</a></li> 
<?php if (!isset( $_SESSION['user_id'])) {?>       
<li><a href="login.php">Login</a></li>        
<li><a href="SignUp.php">Sign Up</a></li>  

<?php  } ?>
<?php if (isset( $_SESSION['user_id'])) {?>
	<li><a href="UserProfile.php">User Profile</a></li>    

<?php echo $_SESSION['user_id']; } ?>

<?php if (isset( $_SESSION['user_id'])) {?>
	<li><a href="logout.php">logout</a></li>    

<?php  } ?>

               
        </ul> 
    </div> <!-- end of menu -->
    