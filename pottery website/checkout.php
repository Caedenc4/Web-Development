<?php
session_start(); 
require 'db.php'; 
include'header.php';

$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
if (empty($cart)) {
    header("Location: cart.php"); // Redirect if cart is empty
    exit;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']); 
    $address = trim($_POST['address']); 
    $phone = trim($_POST['phone']); 

    if (empty($name) || empty($address) || empty($phone)) {
        echo "Please fill in all fields.";
    } else {
        // Insert into the orders table
        $stmt = mysqli_prepare($conn, "INSERT INTO orders (customer_name, shipping_address, phone_number) VALUES (?, ?, ?)");
        mysqli_stmt_bind_param($stmt, 'sss', $name, $address, $phone);
        mysqli_stmt_execute($stmt);

        $order_id = mysqli_stmt_insert_id($stmt); 

        foreach ($cart as $productId => $cartItem) {
            $product = $cartItem['product'];
            $quantity = $cartItem['quantity'];
            $product_name = $product['name'];
            $product_price = $product['price'];

            $stmt = mysqli_prepare($conn, "INSERT INTO order_items (order_id, product_id, quantity, product_name, product_price) VALUES (?, ?, ?, ?, ?)");
            mysqli_stmt_bind_param($stmt, 'iiisd', $order_id, $productId, $quantity, $product_name, $product_price);
            mysqli_stmt_execute($stmt);
        }


        unset($_SESSION['cart']); 
        
     
        header("Location: order_success.php");
        exit;
    }
}
?>


    <title>Checkout</title>
     <style>
       
        .form-container {
            display: flex;
            justify-content: center; 
            align-items: center; 
            height: 100vh; 
            background-color: #f0f0f0; 
        }

    
        label {
            display: block; 
            font-weight: bold; 
            margin-bottom: 10px; 
            color: black;
        }

        input {
            width: 100%; 
            padding: 10px; 
            border: 1px solid #ccc; 
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); 
            margin-bottom: 20px; 
        }

        button {
          
            padding: 10px; 
            background-color: #4CAF50; 
            color: white; 
            border: none; 
            border-radius: 5px; 
            cursor: pointer; 
        }

        button:hover {
            background-color: #45a049; 
        }
    </style>
<div id="templatemo_content"   style="margin-bottom:500px;">
    <h2>Checkout </h2>
    <h3>Total : <?php echo  $_SESSION['total'];  ?>$</h3>
    <div class="form"> 
        <form action="checkout.php" method="POST"> 
            <label for="name">Name:</label>
            <input type="text" name="name" required> 

            <label for="address">Shipping Address:</label>
            <input type="text" name="address" required> 

            <label for="phone">Phone Number:</label>
            <input type="text" name="phone" required>

            <button type="submit">Submit Order</button> 
        </form>
    </div>
    <div style="padding: 10px;"></div>
</div>
 <?php include'footer.php'; ?>