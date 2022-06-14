<?php 
            session_start();
            $product_ids = array();
            //session_destroy();

            // check if add to cart button has been clicked
            if (isset($_POST['add_to_cart'])) {
               if (isset($_SESSION['shopping_cart'])) {
                   # keep track of shopping cart product
                   $count = count ($_SESSION['shopping_cart']);
                   $products_ids = array_column($_SESSION['shopping_cart'], 'id');
                    if (!in_array(filter_input(INPUT_GET, 'id'), $product_ids)) {
                            $_SESSION['shopping_cart'][$count] = array(

                                'id' => filter_input(INPUT_GET, 'id'),
                                'product_name' => filter_input(INPUT_POST, 'product_name'),
                                'description' => filter_input(INPUT_POST, 'description'),
                                'new_price' => filter_input(INPUT_POST, 'new_price'),
                                'quantity' => filter_input(INPUT_POST, 'quantity'),
                                'old_price' => filter_input(INPUT_POST, 'old_price'),
                                'product_img' => filter_input(INPUT_POST, 'product_img')

                            );
                    }else {
                            for ($i = 0 ; $i < count ($product_ids); $i++){
                                    if ($product_ids[$i]  == filter_input(INPUT_GET, 'id')) {
                                            $_SESSION['shopping_cart'][$i]['quantity'] += filter_input(INPUT_POST, 'quantity');
                                    }
                            }
                    }
               }else {
                   # if shopping cart doesn't exist, create first product with array key
                   $_SESSION['shopping_cart'][0] = array(
                    'id' => filter_input(INPUT_GET, 'id'),
                    'product_name' => filter_input(INPUT_POST, 'product_name'),
                    'description' => filter_input(INPUT_POST, 'description'),
                    'new_price' => filter_input(INPUT_POST, 'new_price'),
                    'quantity' => filter_input(INPUT_POST, 'quantity'),
                    'old_price' => filter_input(INPUT_POST, 'old_price'),
                    'product_img' => filter_input(INPUT_POST, 'product_img')


                   );
               }
            }
            # delete item from the cart
            if (filter_input(INPUT_GET, 'action') == 'delete') {
                # go through the products to check a product that matches the Get Id
                    foreach ($_SESSION['shopping_cart'] as $key => $product) {
                        if ($product['id'] == filter_input(INPUT_GET, 'id')) {
                            # remove the item
                            unset($_SESSION['shopping_cart'][$key]);
                        }
                    }
                    // reset session array keys so they match with product ids number array
                    $_SESSION['shopping_cart'] =array_values($_SESSION['shopping_cart']);
            }

            //check out

if (filter_input(INPUT_GET, 'action')  == 'checkout') {
    // go through the products to check a product that matches the GET ID
    foreach ($_SESSION['shopping_cart'] as $key => $product) {
        # remove the iitem
        unset($_SESSION['shopping_cart'] [$key]);
        
    }
     // reset session array keys so they match with product ids number array
     $_SESSION['shopping_cart'] =array_values($_SESSION['shopping_cart']);
}

           // pre_r ($_SESSION);

            function pre_r($array){
            echo '<pre>';
            print_r($array);
            echo '<pre>';
            }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alışveriş Sepeti :: Satış Siparişi</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="css/vendors/@fortawesome/fontawesome-free/css/all.min.css">
    
</head>
</body>
<!--- Navigation Start here ----> 
<nav class="navbar navbar-expand-md navbar-light bg-light">
    <div class="container-fluid">
        <a href="#" class="navbar-brand">
            <h4>Alışveriş Sepeti</h4>
        </a>
            <button class="navbar-toggler" type="button"
            data-toggle="collapse"
            data-target = "#collapse"
            aria-controls = "navbarCollapse"
            aria-expanded="false"
            aria-label="Toggle navigation"
            >
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapse">
                <ul class="navbar-nav mr-auto mb-2 mb-md-0">

                <li class="nav-item active">
                        <a href="index.php" class="nav-link">Ev</a>
                    </li>
                    <li class="nav-item ">
                        <a href="#" class="nav-link">Ürünler</a>
                    </li>
                    <li class="nav-item ">
                        <a href="#" class="nav-link">İletişim</a>
                    </li>

                </ul>
                <div class="dflex">
                    <a href="#" class="cart"> <i class="fa fa-shopping-cart"></i>
                        <span class="text-warning bg-dark">  0</span>
                    </a>
                </div>
            </div>
    </div>
</nav>
<!--- Navigation Ends here ---> 

<!--- Checkout products section ends here --->
<div class="container-fluid md-5">

    <div class="row px-5 py-2">
   
    <br>
    <hr>
    
        <div class="col-md-7">
        
            <h4>Siparişlerim</h4>
            <?php
                if (!empty ($_SESSION['shopping_cart'])):
                    $total = 0 ;
                    foreach ($_SESSION['shopping_cart'] as $key => $product):
                   
            ?>
           
            <div class="card  mb-5">
            
                <div class="card-body">
                    <div class="row">

                    <!--- Product image --->  
                    <div class="col-md-2">
                    <img src="<?php echo $product ['product_img'];?>" class="img-fluid "  alt="product image">
                    </div>
                        <div class="col-md-3">
                            <h4><?php echo $product ['product_name'];?></h4>
                          
                        </div>
                       
                        <div class="col-md-2">
                           <h6>Miktar:  <b><?php echo $product['quantity']?></b></h6>
                        </div>
                        <div class="col-md-2">
                           <h6>Fiyat:  <b><?php echo $product['new_price']?></b></h6>
                        </div>
                        <?php   $total = $total + ($product['quantity'] * $product['new_price']); ?>
                        <div class="col-md-2 ">
                           <h6>Toplam: <b><?php echo $total;?></b></h6>
                        </div>
                    </div>
                </div>
            </div>
               <?php 
                  
                    endforeach;
               ?>
    <?php endif;  ?>
        </div>
<!--- Checkout products section ends here ---> 
        <!--- Total Price section ---> 
        <?php 
            if(!empty ($_SESSION['shopping_cart'])):
                if(count($_SESSION['shopping_cart']) > 0);
        ?>
        
<div class="col-md-5 py-5 px5">

    <div class="card">
    
        <div class="card-body">
            <b>Fiyat Detayları</b>
            <hr>
            <div class="row">
                <div class="col-md-5">
                    <h5>Fiyat (  <?php echo $product['quantity']?> öğeler)</h5>
                </div>
                <div class="col-md-5">
                    <h5 class="float-right">
                        <?php echo $total;?>
                    </h5>
                </div>
                <!--- Price section ---> 
                <div class="row">
                <div class="col-md-5 py-2">
                    <h5><b>Teslimat maliyeti</b></h5>
                </div>
                <div class="col-md-5 py-2">
                    <h5 class="float-right">0</h5>
                </div>
            </div>
                  
                    <!--- Total price section --->
            <div class="row">
                <div class="col-md-5 py-2">
                    <h5><b>Ödenecek tutar</b></h5>
                </div>
                <div class="col-md-5 py-2">
                    <h5 class="float-right"><b><?php echo $total;?></b></h5>
                </div>
            </div>
                </div>
            </div>
           
        </div>
        <a href="profile.php">
        <br> <br>
                                <div class="btn btn-warning btn-block mb-5  px-5">Siparişi Gönder</div>
                           </a>
    </div>
    
</div>

                <?php 
                        endif;
                ?>
        
        
        <!--- Total Price section ends here --->
    </div>
</div>
<script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>