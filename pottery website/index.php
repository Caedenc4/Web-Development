<?php include'header.php'; 


$products = [
    ['id' => 1, 'name' => 'Product 1', 'price' => 10.00 ,'image'=>'myimages/one.jpeg'],
    ['id' => 2, 'name' => 'Product 2', 'price' => 15.00,'image'=>'myimages/two.jpeg'],
    ['id' => 3, 'name' => 'Product 3', 'price' => 20.00,'image'=>'myimages/three.jpeg'],
    ['id' => 3, 'name' => 'Product 3', 'price' => 20.00,'image'=>'myimages/four.jpeg'],
    ['id' => 3, 'name' => 'Product 3', 'price' => 20.00,'image'=>'myimages/five.jpeg'],
    ['id' => 3, 'name' => 'Product 3', 'price' => 20.00,'image'=>'myimages/six.png'],
    ['id' => 3, 'name' => 'Product 3', 'price' => 20.00,'image'=>'myimages/seven.png'],
];



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productId = (int)$_POST['product_id']; 
    $quantity = (int)$_POST['quantity']; 


    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }


    if (isset($_SESSION['cart'][$productId])) {
        $_SESSION['cart'][$productId]['quantity'] += $quantity; 
    } else {
        $_SESSION['cart'][$productId] = ['quantity' => $quantity, 'product' => $products[$productId - 1]];
    }

    header("Location: cart.php"); 
    exit;
}


?>
   
    <div id="templatemo_content">
    
    	<div id="templatemo_content_left">
        	<h1>Welcome to Pottery Shop</h1>
            <p>"Clay & Glaze Pottery Shop" is your one-stop shop for handcrafted ceramic artistry and hands-on pottery experiences. The moment you walk in, you're greeted by the warm glow of glazed ceramics, each piece uniquely crafted by our talented artisans. The shop offers a diverse range of pottery, from everyday items like mugs and bowls to more intricate pieces like vases and sculptures</p>
          <p>You can find a perfect gift or a personal treasure among the shelves, each piece telling its own story through textures, colors, and designs.</p>
                        
             <div class="cleaner_with_height">&nbsp;</div>
               
             <h2>New Products</h2>
              <?php foreach ($products as $product): ?>
             <div class="product_box" style="
    margin-top: 10px;">
             	<form action="" method="POST" style="display: inline;">
             	<h3><?php echo $product['name']?></h3>
                <img src="<?php echo $product['image']?>" alt="image" style="height:200px; width: 200px;" />
                <div class="price">PRICE:<span><?php echo $product['price']?>$</span></div>  
                <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                  <input type="number" name="quantity" min="1" value="1">                         
   

                  <div class="buynow"><button class="buynow" type="submit">Add to Cart</button></div>

             	</form>
             </div>
            <?php endforeach; ?>
             
			<div class="cleaner_with_height">&nbsp;</div>
        </div> 
        
        <div id="templatemo_content_right">
        	<div class="templatemo_right_section">
            	<h4>Search</h4>
                <div class="templatemo_right_section_content">
                    <form method="get" action="#">
                            <input name="keyword" type="text" id="keyword"/>
                            <input type="submit" name="submit" class="button" value="Search" />
                     </form>
                 </div>
            </div>
            
        

         
        </div> 
       <?php include'footer.php'; ?>