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
        <title>Cake - Bakery</title>

        <!-- Icon css link -->
        <link href="css/font-awesome.min.css" rel="stylesheet">
        <link href="vendors/linearicons/style.css" rel="stylesheet">
        <link href="vendors/flat-icon/flaticon.css" rel="stylesheet">
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
        
        <link href="css/style.css?v=<?php echo time(); ?>" rel="stylesheet">
        <link href="css/responsive.css?v=<?php echo time(); ?>" rel="stylesheet">

    </head>
    <body>
        
        <!--================Main Header Area =================-->
		<?php
   
   include('./components/header.php')
   ?>
        <!--================End Main Header Area =================-->
        
        <!--================Slider Area =================-->
		<?php
try {
    $query = "SELECT * FROM banner ORDER BY id DESC";
    $query_run = mysqli_query($conn, $query);
	
    if ($query_run) {
        if (mysqli_num_rows($query_run) > 0) {
?>
        <section class="main_slider_area">
            <div id="main_slider" class="rev_slider" data-version="5.3.1.6">
                <ul>
				<?php
        while ($row = mysqli_fetch_assoc($query_run)) {
            ?>
                    <li data-index="<?php echo $row['ID']?>" data-transition="fade" data-slotamount="default" data-hideafterloop="0" data-hideslideonmobile="off"  data-easein="default" data-easeout="default" data-masterspeed="300"  data-thumb="./admin/<?php echo $row['file_path']?>"  data-rotate="0"  data-saveperformance="off"  data-title="Creative" data-param1="01" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-param10="" data-description="">
                    <!-- MAIN IMAGE -->
                    <img src="./admin/<?php echo $row['file_path']?>"  alt="" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" data-bgparallax="5" class="rev-slidebg" data-no-retina>

                        <!-- LAYER NR. 1 -->
                        <div class="slider_text_box">
                            <div class="tp-caption tp-resizeme first_text" 
                            data-x="['left','left','left','15','15']" data-hoffset="['0','0','0','0']" 
                            data-y="['top','top','top','top']" data-voffset="['175','175','125','165','160']" 
                            data-fontsize="['65','65','65','40','30']"
                            data-lineheight="['80','80','80','50','40']"
                            data-width="['800','800','800','500']"
                            data-height="none"
                            data-whitespace="normal"
                            data-type="text" 
                            data-responsive_offset="on" 
                            data-frames="[{&quot;delay&quot;:10,&quot;speed&quot;:1500,&quot;frame&quot;:&quot;0&quot;,&quot;from&quot;:&quot;y:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;&quot;,&quot;mask&quot;:&quot;x:0px;y:0px;s:inherit;e:inherit;&quot;,&quot;to&quot;:&quot;o:1;&quot;,&quot;ease&quot;:&quot;Power2.easeInOut&quot;},{&quot;delay&quot;:&quot;wait&quot;,&quot;speed&quot;:1500,&quot;frame&quot;:&quot;999&quot;,&quot;to&quot;:&quot;y:[175%];&quot;,&quot;mask&quot;:&quot;x:inherit;y:inherit;s:inherit;e:inherit;&quot;,&quot;ease&quot;:&quot;Power2.easeInOut&quot;}]"
                            data-textAlign="['left','left','left','left']"><?php echo $row['p_name']?></div>
                            
                            <div class="tp-caption tp-resizeme secand_text" 
                                data-x="['left','left','left','15','15']" data-hoffset="['0','0','0','0']" 
                                data-y="['top','top','top','top']" data-voffset="['345','345','300','300','250']"  
                                data-fontsize="['20','20','20','20','16']"
                                data-lineheight="['28','28','28','28']"
                                data-width="['640','640','640','640','350']"
                                data-height="none"
                                data-whitespace="normal"
                                data-type="text" 
                                data-responsive_offset="on"
                                data-transform_idle="o:1;"
                                data-frames="[{&quot;delay&quot;:10,&quot;speed&quot;:1500,&quot;frame&quot;:&quot;0&quot;,&quot;from&quot;:&quot;y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;&quot;,&quot;mask&quot;:&quot;x:0px;y:[100%];s:inherit;e:inherit;&quot;,&quot;to&quot;:&quot;o:1;&quot;,&quot;ease&quot;:&quot;Power2.easeInOut&quot;},{&quot;delay&quot;:&quot;wait&quot;,&quot;speed&quot;:1500,&quot;frame&quot;:&quot;999&quot;,&quot;to&quot;:&quot;y:[175%];&quot;,&quot;mask&quot;:&quot;x:inherit;y:inherit;s:inherit;e:inherit;&quot;,&quot;ease&quot;:&quot;Power2.easeInOut&quot;}]"><?php echo $row['description']?>
                            </div>
                            
                            
                        </div>
                    </li>
                    <?php } ?>
                </ul>
            </div>
        </section>
		<?php
        } else {
            echo '<div class="alert alert-warning" role="alert">
            No records found. Please add details.
            </div>';
        }
    }
} catch (mysqli_sql_exception $e) {
    $error_message = $e->getMessage();
    if (strpos($error_message, "Table 'sharma.banner' doesn't exist") !== false) {
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
        <!--================End Slider Area =================-->
        
        <!--================Welcome Area =================-->
        <section class="welcome_bakery_area">
        	<div class="container">
        		<div class="welcome_bakery_inner p_100">
        			<div class="row">
        				<div class="col-lg-6">
        					<div class="main_title">
								<h2>Welcome to our Bakery</h2>
								<p>Sharma Bakers provides beautiful and delicious wedding cakes to hundreds of satisfied customers each year. Our deliciously moist, artistic, and elegantly-designed cakes for weddings, anniversaries, birthdays, bridal showers, baby showers, and any type of special occasion will be remembered by your guests as a wonderful touch to your event.
</p>
							</div>
        					<div class="welcome_left_text">
        						<p>Our Bakery also offers cupcakes, cookies, brownies, seasonal specialties, "edible images" of cartoon characters, cakes for mundan and shagun ceremonies.

Our renowned and very popular  truffle Cake made from dark chocolate Sharma Bakers also offers other flavor  such as strawberry, black current, lemon, orange, pineapple, vanilla etc  with flowers, sugar decorations, nuts etc at very reasonable price</p>
        						<a class="pink_btn" href="#">Know more about us</a>
        					</div>
        				</div>
        				<div class="col-lg-6">
        					<div class="welcome_img">
        						<img class="img-fluid" src="img/bake.jpg" alt="Sharma Bakers">
        					</div>
        				</div>
        			</div>
        		</div>
        		<div class="cake_feature_inner">
        			<div class="main_title">
						<h2>Our Featured Products</h2>
						<h5> Seldolor sit amet consect etur</h5>
					</div>
					<?php
try {
    $query = "SELECT * FROM products where status='1' ORDER BY ID DESC LIMIT 10";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        if (mysqli_num_rows($query_run) > 0) {
?>
       				<div class="cake_feature_slider owl-carousel">
       					
					   <?php
        while ($row = mysqli_fetch_assoc($query_run)) {
            ?>
					
					   <div class="item">
       						<div class="cake_feature_item">
       							<div class="cake_img">
       								<img src="./admin/<?php echo $row['file_path']?>" alt="<?php echo $row['p_name']?>" class="file_p">
       							</div>
       							<div class="cake_text">
       								<h4><i class="fa fa-rupee text-success"></i><?php echo $row['price']?></h4>
       								<h3><?php echo $row['p_name']?></h3>
       								<a class="pest_btn" href="product-details.php?id=<?php echo $row["ID"] ;  ?>">Buy Now</a>
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
    }
} catch (mysqli_sql_exception $e) {
    $error_message = $e->getMessage();
    if (strpos($error_message, "Table 'sharma.products' doesn't exist") !== false) {
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
        </section>
        <!--================End Welcome Area =================-->
        
        <!--================Special Recipe Area =================-->
        <section class="special_recipe_area">
        	<div class="container">
        	<?php
try {
    $query = "SELECT * FROM recipes where status='1' ORDER BY ID DESC LIMIT 4";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        if (mysqli_num_rows($query_run) > 0) {
?>	
			<div class="special_recipe_slider owl-carousel">


           
			<?php
        while ($row = mysqli_fetch_assoc($query_run)) {
            ?>

        			<div class="item">
        				<div class="media">
        					<div class="d-flex">
        						<img src="./admin/<?php echo $row['file_path']?>" class="img-crousel-reci" alt="">
        					</div>
        					<div class="media-body">
        						<h4><?php echo $row['p_name']?></h4>
        						<p><?php echo $row['s_desc']?></p>
        						<a class="w_view_btn" href="special.php">View Details</a>
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
    }
} catch (mysqli_sql_exception $e) {
    $error_message = $e->getMessage();
    if (strpos($error_message, "Table 'sharma.recipes' doesn't exist") !== false) {
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
        </section>
        <!--================End Special Recipe Area =================-->
        
        <!--================Service Area =================-->
        <section class="service_area">
        	<div class="container">
        		<div class="single_w_title">
        			<h2>Main Services We Provide</h2>
        		</div>
        		<div class="row service_inner">
        			<div class="col-lg-4 col-6">
        				<div class="service_item">
        					<i class="flaticon-food-2"></i>
        					<h4>Cookies</h4>
        					<p>Sharma`s Cookies are very hygienically prepared without using any  preservative etc. 
</p>
        				</div>
        			</div>
        			<div class="col-lg-4 col-6">
        				<div class="service_item">
        					<i class="flaticon-food-1"></i>
        					<h4>Cake</h4>
        					<p>We make customized cakes as per your needs.. You can get your imagination transfer to the delicious cake.
</p>
        				</div>
        			</div>
        			<div class="col-lg-4 col-6">
        				<div class="service_item">
        					<i class="flaticon-food"></i>
        					<h4>Snacks</h4>
        					<p>The most awaited moment of the birthday party is the birthday cake and snacks. The minute the cake and snacks is wheeled in all attention goes onto what shape it is.</p>
        				</div>
        			</div>
        		</div>
        	</div>
        </section>
        <!--================End Service Area =================-->
        
        <!--================Discover Menu Area =================-->
        <section class="discover_menu_area">
        	<div class="discover_menu_inner">
        		<div class="container">
        			<div class="main_title">
						<h2>Discover Menu</h2>
						<h5>Duis aute irure dolor in reprehenderit voluptate</h5>
					</div>
       				<div class="">
       					<div class="col-lg-12">


                        	
				<?php
try {
    $query = "SELECT * FROM menu_items where status='1' ORDER BY name Limit 5 ";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        if (mysqli_num_rows($query_run) > 0) {
?>
       						<div class="discover_item_inner">
                               <?php
        while ($row = mysqli_fetch_assoc($query_run)) {
            ?>	

       							<div class="discover_item">
									<h4><?php echo $row['name']?></h4>
									<p><?php echo $row['description']?> <span><i class="fa fa-rupee text-success"></i><?php echo $row['price']?></span></p>
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
        <!--================End Discover Menu Area =================-->
        
        <!--================Client Says Area =================-->
        <!-- <section class="client_says_area p_100">
        	<div class="container">
        		<div class="client_says_inner">
        			<div class="c_says_title">
        				<h2>What Our Client Says</h2>
        			</div>
        			<div class="client_says_slider owl-carousel">
        				<div class="item">
        					<div class="media">
        						<div class="d-flex">
        							<img src="img/client/client-1.png" alt="">
        							<h3>“</h3>
        						</div>
        						<div class="media-body">
        							<p>Osed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci sed quia non numquam qui ratione voluptatem sequi nesciunt. Neque porro quisquam est.</p>
        							<h5>- Robert joe</h5>
        						</div>
        					</div>
        				</div>
        				<div class="item">
        					<div class="media">
        						<div class="d-flex">
        							<img src="img/client/client-1.png" alt="">
        						</div>
        						<div class="media-body">
        							<p>Osed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci sed quia non numquam qui ratione voluptatem sequi nesciunt. Neque porro quisquam est.</p>
        							<h5>- Robert joe</h5>
        						</div>
        					</div>
        				</div>
        				<div class="item">
        					<div class="media">
        						<div class="d-flex">
        							<img src="img/client/client-1.png" alt="">
        						</div>
        						<div class="media-body">
        							<p>Osed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci sed quia non numquam qui ratione voluptatem sequi nesciunt. Neque porro quisquam est.</p>
        							<h5>- Robert joe</h5>
        						</div>
        					</div>
        				</div>
                        

        			</div>
        		</div>
        	</div>
        </section> -->
        <!--================End Client Says Area =================-->
        
        <!--================End Client Says Area =================-->
       
        <!--================End Client Says Area =================-->
        
       <!-- footer area starts -->
        <?php
    
    include('./components/footer.php')
    ?>
        <!-- footer area ends -->
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
        <script src="vendors/datetime-picker/js/moment.min.js"></script>
        <script src="vendors/datetime-picker/js/bootstrap-datetimepicker.min.js"></script>
        <script src="vendors/nice-select/js/jquery.nice-select.min.js"></script>
        <script src="vendors/jquery-ui/jquery-ui.min.js"></script>
        <script src="vendors/lightbox/simpleLightbox.min.js"></script>
        
        <script src="js/theme.js"></script>
    </body>

</html>