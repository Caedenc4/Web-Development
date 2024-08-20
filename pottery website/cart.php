<?php

session_start(); // Start the session to access the cart
include'header.php';

$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
var_dump($_POST);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['remove'])) {
        $productId = (int)$_POST['product_id'];
        unset($cart[$productId]); 
        $_SESSION['cart'] = $cart;
    } elseif (isset($_POST['update'])) {

        $productId = (int)$_POST['product_id'];
        $quantity = (int)$_POST['quantity'];

        if ($quantity > 0) {
            $cart[$productId]['quantity'] = $quantity; 
        } else {
            unset($cart[$productId]); 
        }
        $_SESSION['cart'] = $cart; 
    }

    header("Location: cart.php");
    exit;
}
?>

<div id="templatemo_content"   style="margin-bottom:500px;">
    <h2>Your Shopping Cart</h2>
    <?php if (empty($cart)): ?>
        <p>Your cart is empty.</p>
    <?php else: ?>
        <table>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
            <?php
            $total = 0; // Calculate total cost
            foreach ($cart as $productId => $cartItem):
                $product = $cartItem['product'];
                $quantity = $cartItem['quantity'];
                $price = $product['price'];
                $subtotal = $quantity * $price;
                $total += $subtotal;
                $_SESSION['total'] = $total;
            ?>
                <tr>
                    <td><?php echo htmlspecialchars($product['name']); ?></td>
                    <td>
                        <!-- Form to update quantity -->
                        <form action="" method="POST">
                            <input type="hidden" name="product_id" value="<?php echo $productId; ?>">
                            <input type="number" name="quantity" min="1" value="<?php echo $quantity; ?>" onchange="this.form.submit()">
                        </form>
                    </td>
                    <td>$<?php echo number_format($price, 2); ?></td>
                    <td>$<?php echo number_format($subtotal, 2); ?></td>
                    <td>
                        <!-- Form to remove item -->
                        <form action="" method="POST">
                            <input type="hidden" name="product_id" value="<?php echo $productId; ?>">
                            <button type="submit" name="remove">Remove</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <p>Total: $<?php echo number_format($total, 2); ?></p>


    <?php endif; ?>

    
<div></div>
<div>
      <a href="index.php">Continue Shopping</a> 
       <?php if (!empty($cart)){ ?>
     <a href="checkout.php"><button class="buynow" type="submit">Proceed to Checkout</button></a>
<?php } ?>
</div>
</div>
       <?php include'footer.php'; ?>