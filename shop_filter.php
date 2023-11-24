<!DOCTYPE html>
<html lang="en">
<?php
include('./database/db.php')
?>  
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <link rel="icon" href="img/fav-icon.png" type="image/x-icon" />
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Cake - Bakery filter shop</title>

        <!-- Icon css link -->
        <link href="css/font-awesome.min.css" rel="stylesheet">
        <link href="vendors/linearicons/style.css" rel="stylesheet">
        <link href="vendors/flat-icon/flaticon.css" rel="stylesheet">
        <link href="vendors/stroke-icon/style.css" rel="stylesheet">
        <!-- Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        
        <!-- Rev slider css -->
        <link href="vendors/revolution/css/settings.css" rel="stylesheet">
        <link href="vendors/revolution/css/layers.css" rel="stylesheet">
        <link href="vendors/revolution/css/navigation.css" rel="stylesheet">
        <link href="vendors/animate-css/animate.css" rel="stylesheet">
        
        <!-- Extra plugin css -->
        <link href="vendors/owl-carousel/owl.carousel.min.css" rel="stylesheet">
        <link href="vendors/magnifc-popup/magnific-popup.css" rel="stylesheet">
        <link href="vendors/jquery-ui/jquery-ui.min.css" rel="stylesheet">
        <link href="vendors/nice-select/css/nice-select.css" rel="stylesheet">
        
        <link href="css/style.css?v=<?php echo time(); ?>" rel="stylesheet">
        <link href="css/responsive.css?v=<?php echo time(); ?>" rel="stylesheet">

       
    </head>
    <body>
        
        <!--================Main Header Area =================-->
		<?php
   
   include('./components/header.php')
   ?>
        <!--================End Main Header Area =================-->
        
        <!--================End Main Header Area =================-->
        .
        <section class="banner_area">
        	<div class="container">
        		<div class="banner_text">
        			<h3>Shop</h3>
        			<ul>
        				<li><a href="index.html">Home</a></li>
        				<li><a href="shop.html">Shop</a></li>
        			</ul>
        		</div>
        	</div>
        </section>
        <!--================End Main Header Area =================-->
        
        <!--================Product Area =================-->
        <section class="product_area p_100">
        	<div class="container">
        		<div class="row product_inner_row">
        			<div class="col-lg-9">
                    <?php
try {
    $cat = mysqli_real_escape_string($conn, $_GET['cat']); // Sanitize the input
    echo " <h3>Showing Results For : " . $cat . "</h3>"; // Debug: Check the category received

    $query = "SELECT * FROM products WHERE category LIKE '%$cat%' ORDER BY p_name DESC LIMIT 12";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        if (mysqli_num_rows($query_run) > 0) {
?>
        <div class="row product_item_inner">
            <?php
            while ($row = mysqli_fetch_assoc($query_run)) {
            ?>
                <div class="col-lg-4 col-md-4 col-6">
                    <div class="cake_feature_item">
                        <div class="cake_img">
                            <img src="./admin/<?php echo $row['file_path'] ?>" alt="" class="file_p">
                        </div>
                        <div class="cake_text">
                            <h4><i class="fa fa-rupee text-success"></i><?php echo $row['price'] ?></h4>
                            <h3><?php echo $row['p_name'] ?></h3>
                            <a class="pest_btn" href="#">Buy Now</a>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    <?php
        } else {
            echo '<div class="alert alert-warning" role="alert">
            No records found. Please add details.
            </div>';
        }
    } else {
        throw new Exception(mysqli_error($conn)); // Throw an exception for database errors
    }
} catch (Exception $e) {
    // Handle exceptions or errors
    echo '<div class="alert alert-danger" role="alert">
    Error occurred: ' . $e->getMessage() . '
    </div>';
}
?>


						
        				<div class="">
        					
        				</div>
        			</div>
        			<div class="col-lg-3">
        				<div class="product_left_sidebar">
        					<aside class="left_sidebar search_widget">
        						<!-- <form class="input-group">
									<input type="text" class="form-control" placeholder="Enter Search Keywords">
									<div class="input-group-append">
										<button class="btn" type="button"><i class="icon icon-Search"></i></button>
									</div>
								</form> -->
        					</aside>
        					<aside class="left_sidebar p_catgories_widget">
        						<div class="p_w_title">
        							<h3>Product Categories</h3>
        						</div>
								<?php
try {
    $query = "SELECT * FROM services where status='1' ORDER BY service_name DESC LIMIT 12";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        if (mysqli_num_rows($query_run) > 0) {
?>
        						<ul class="list_style">
								<?php
        while ($row = mysqli_fetch_assoc($query_run)) {
            ?>
        							<li><a href="shop_filter.php?cat=<?php echo $row["service_name"] ;  ?>"><?php echo $row['service_name']?></a></li>
        							<?php
        }
        ?>
        				
        						</ul>

								<?php
        } else {
            echo '<div class="alert alert-warning" role="alert">
            No records found. Please add details.
            </div>';
        }
    }
} catch (mysqli_sql_exception $e) {
    $error_message = $e->getMessage();
    if (strpos($error_message, "Table 'sharma.services' doesn't exist") !== false) {
        echo '<div class="alert alert-danger" role="alert">
        Table not found. Please create the table or add the necessary details.
        </div>';
    } else {
        // For any other unexpected database error
        echo '<div class="alert alert-danger" role="alert">
        Unexpected database error occurred.
        </div>';
    }
}
?>
        					</aside>
        					
							<?php
try {
    $query = "SELECT * FROM products where status='1' ORDER BY ID DESC LIMIT 8";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        if (mysqli_num_rows($query_run) > 0) {
?>
        					<aside class="left_sidebar p_sale_widget">
        						<div class="p_w_title">
        							<h3>Top Sale Products</h3>
        						</div>
								<?php
        while ($row = mysqli_fetch_assoc($query_run)) {
            ?>	
        						<div class="media">
        							<div class="d-flex">
        								<img src="./admin/<?php echo $row['file_path']?>" class="side_img" alt="<?php echo $row['p_name']?>">
        							</div>
        							<div class="media-body">
        								<a href="#"><h4><?php echo $row['p_name']?></h4></a>
        								
        								<h5><i class="fa fa-rupee text-success"></i><?php echo $row['price']?></h5>
        							</div>
        						</div>
        						
        						
								<?php
        }
        ?>
        					</aside>
							<?php
        } else {
            echo '<div class="alert alert-warning" role="alert">
            No records found. Please add details.
            </div>';
        }
    }
} catch (mysqli_sql_exception $e) {
    $error_message = $e->getMessage();
    if (strpos($error_message, "Table 'sharma.services' doesn't exist") !== false) {
        echo '<div class="alert alert-danger" role="alert">
        Table not found. Please create the table or add the necessary details.
        </div>';
    } else {
        // For any other unexpected database error
        echo '<div class="alert alert-danger" role="alert">
        Unexpected database error occurred.
        </div>';
    }
}
?>
        				</div>
        			</div>
        		</div>
        	</div>
        </section>
        <!--================End Product Area =================-->
        
       
        
        <!--================Footer Area =================-->
		<?php
   
   include('./components/footer.php')
   ?>
        <!--================End Footer Area =================-->
        
        
        <!--================Search Box Area =================-->
        <div class="search_area zoom-anim-dialog mfp-hide" id="test-search">
            <div class="search_box_inner">
                <h3>Search</h3>
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button"><i class="icon icon-Search"></i></button>
                    </span>
                </div>
            </div>
        </div>
        <!--================End Search Box Area =================-->
        
        
        
        
        
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="js/jquery-3.2.1.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/popper.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <!-- Rev slider js -->
        <script src="vendors/revolution/js/jquery.themepunch.tools.min.js"></script>
        <script src="vendors/revolution/js/jquery.themepunch.revolution.min.js"></script>
        <script src="vendors/revolution/js/extensions/revolution.extension.actions.min.js"></script>
        <script src="vendors/revolution/js/extensions/revolution.extension.video.min.js"></script>
        <script src="vendors/revolution/js/extensions/revolution.extension.slideanims.min.js"></script>
        <script src="vendors/revolution/js/extensions/revolution.extension.layeranimation.min.js"></script>
        <script src="vendors/revolution/js/extensions/revolution.extension.navigation.min.js"></script>
        <!-- Extra plugin js -->
        <script src="vendors/owl-carousel/owl.carousel.min.js"></script>
        <script src="vendors/magnifc-popup/jquery.magnific-popup.min.js"></script>
        <script src="vendors/isotope/imagesloaded.pkgd.min.js"></script>
        <script src="vendors/isotope/isotope.pkgd.min.js"></script>
        <script src="vendors/datetime-picker/js/moment.min.js"></script>
        <script src="vendors/datetime-picker/js/bootstrap-datetimepicker.min.js"></script>
        <script src="vendors/nice-select/js/jquery.nice-select.min.js"></script>
        <script src="vendors/jquery-ui/jquery-ui.min.js"></script>
        <script src="vendors/lightbox/simpleLightbox.min.js"></script>
        
        <script src="js/theme.js"></script>
    </body>

</html>