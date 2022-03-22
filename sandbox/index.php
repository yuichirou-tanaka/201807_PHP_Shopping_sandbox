<?php
session_start();


$products = array(
    1=> array(
        'name' => 'スニーカー',
        'price' => 24.99,
        'category' => 'Shoes',
        'description' => 'Black sneakers. Good for walking or athletic activity'
    ),
    2=> array(
        'name' => 'シャツ',
        'price' => 39.99,
        'category' => 'Shirts',
        'description' => 'Shirts'
    ),
    3=> array(
        'name' => 'パンツ',
        'price' => 39.99,
        'category' => 'Pants',
        'description' => 'パンツ'
    ),
);


// make cart
if(!isset($_SESSION['shopping_cart'])){
    $_SESSION['shopping_cart'] = array();
}
// empty art
else if(isset($_GET['empty_cart'])){
    $_SESSION['shopping_cart'] = array();
}


if(isset($_POST['add_to_cart'])){
    $product_id = $_POST['product_id'];
    echo "Product: ".$_POST['product_id']."<br/>";
    
    //if()
    
    if(isset($_SESSION['shopping_cart'][$product_id])){
        echo '既に入っている';
    }else{    
        $_SESSION['shopping_cart'][$product_id]['product_id'] = $_POST['product_id'];
        $_SESSION['shopping_cart'][$product_id]['quantity'] = $_POST['quantity'];
    
    }
}



echo "<h2 style='text-align:center;'> Welcome to DropShop!</h2>"
. "<p style='text-align:center;'><a href='./index.php?view_cart'>View cart</a></p>"
        . "";




if(empty($products)){
    echo "在庫なし";
}else{
    echo "在庫あり";
}


//$cookies = array('chocolate_chip' => 1);
//
//if(empty($cookies)){
//    echo "クッキーなし";
//}else{
//    echo "クッキーあり";
//}

if(isset($_GET['view_product'])){
    $product_id = $_GET['view_product'];
    //echo "view $product_id <br/>";
    
    
    
    //display site links
    echo "<span>"
    . "<a href='index.php'>DropShop</a> &gt; <a href='./index.php'>".
            $products[$product_id]['category']."</a></span><br />";
    
    // display product
    echo "<p>"
        . "<span style='font-weight:bold;'>". $products[$product_id]['name']. "</span><br>
           <span style='font-weight:bold;'> Price:". $products[$product_id]['price']."</span><br>
           <span style='font-weight:bold;'> Category :".$products[$product_id]['category'] . "</span><br>
           <span style='font-weight:bold;'> description :".$products[$product_id]['description'] . "</span>
              <form action='./index.php?view_product=$product_id' method='post'>
                <select name='quantity'>
                  <option value='1'>1</option>
                  <option value='2'>2</option>
                  <option value='3'>3</option>
                </select>
                <input type='hidden' name='product_id' value='$product_id' />
                <input type='submit' name='add_to_cart' value='Add to cart' />
              </form>
        </p>";
            
}else if(isset($_GET['view_cart'])){
    echo "<p><a href='index.php'>DropShop</a></p>";
    //$product_id = $_POST['product_id'];
    //$product_id = $_GET['view_product'];
    //display site links
    echo "<span> Your Cart</span>".
    "<p>
            <a href='./index.php?empty_cart=1'>カートを空にする</a>
    </p>";
    
    
    if (empty($_SESSION['shopping_cart'])){
        echo 'カートは空です.<br/>';
    }
    else {
        foreach($_SESSION['shopping_cart'] as $id => $product){
            $product_id = $product['product_id'];
            //echo $product_id;
            echo $products[$product_id]['name']." "
                    ."Quantity:". $product['quantity']
                    . "<br>";
            //echo"cart[$id]=Product:".$product['product_id']." Quantity:" . $product['quantity']. "<br/>";
        }
    }
}else{
    //display site links
    echo "<span><a href='index.php'>DropShop</a>";

    echo "<h3>Our Products</h3>";

    
    echo "<table style='width:500px;' cellspacing='0'>";
    echo "<tr>
            <th style='border-bottom:1px solid #000000;'>Name</th>
            <th style='border-bottom:1px solid #000000;'>Price</th>
            <th style='border-bottom:1px solid #000000;'>Category</th>
    </tr>";

    foreach($products as $id => $product){
        echo "<tr>"
        . "<td style='font-weight:bold;'><a href='./index.php?view_product=$id'>".$product['name']. "</a></td>
           <td style='font-weight:bold;'>". $product['price']."</td>
           <td style='font-weight:bold;'>".$product['category'] . "</td>
        </tr>";
    }
    echo "</table>";
}


?>
