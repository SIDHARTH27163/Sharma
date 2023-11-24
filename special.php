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
        
        <link href="css/style.css" rel="stylesheet">
        <link href="css/responsive.css" rel="stylesheet">

  
    </head>
    <body>
        
        <!--================Main Header Area =================-->
		<?php
   
   include('./components/header.php')
   ?>
        <!--================End Main Header Area =================-->
        
        <!--================End Main Header Area =================-->
        <section class="banner_area">
        	<div class="container">
        		<div class="banner_text">
        			<h3>Special</h3>
        			<ul>
        				<li><a href="index.php">Home</a></li>
        				<li><a href="special.php">Special</a></li>
        			</ul>
        		</div>
        	</div>
        </section>
        <!--================End Main Header Area =================-->
        
        <!--================Special Area =================-->
		<div class="main_title">
		<div class="container">
        			<h2>Special Item of our Bakery</h2>
        			<h5>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</h5>
        		
				</div>
		<?php
try {
	$recordsPerPage = 2;

    // Get the current page number
    $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;

    // Calculate the starting point for fetching the records
    $startFrom = ($currentPage - 1) * $recordsPerPage;

    // Query to get a specific range of records
    $query = "SELECT * FROM recipes where status='1' ORDER BY ID DESC LIMIT $startFrom, $recordsPerPage";
    $query_run = mysqli_query($conn, $query);
    if ($query_run) {
        if (mysqli_num_rows($query_run) > 0) {
?>

        <section class="special_area p_100">
		<?php
        while ($row = mysqli_fetch_assoc($query_run)) {
            ?>
        	<div class="container">
        		
        		<div class="special_item_inner">
        			<div class="specail_item">
						<div class="row">
							<div class="col-lg-4">
								<div class="s_left_img">
									<img class="img-fluid" src="./admin/<?php echo $row['file_path']?>" alt="">
								</div>
							</div>
							<div class="col-lg-8">
								<div class="special_item_text">
									<h4><?php echo $row['p_name']?></h4>
									<p><?php echo $row['s_desc']?></p>
									<a class="pink_btn" href="#">Purchase now</a>
								</div>
							</div>
						</div>
        			</div>
        			
        		</div>
        	</div>
      
        <!--================End Special Area =================-->
        
        <!--================Our Bakery Area =================-->
        <section class="our_bakery_area making_area">
        	<div class="container">
        	<?php
            echo htmlspecialchars_decode($row['description'])
            ?>
        	</div>
        </section> 
		<?php
        }
        ?>
	
	</section>


		<?php
$totalPages = ceil(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM recipes")) / $recordsPerPage);
// Bootstrap Pagination
echo '<nav aria-label="Page navigation" class="start-50  container">
<ul class="pagination">';

// Previous button
if ($currentPage > 1) {
echo '<li class="page-item">
    <a class="page-link" href="?page=' . ($currentPage - 1) . '" tabindex="-1" aria-disabled="true">Previous</a>
  </li>';
} else {
echo '<li class="page-item disabled">
    <span class="page-link">Previous</span>
  </li>';
}

// Numbered pages
for ($i = 1; $i <= $totalPages; $i++) {
echo '<li class="page-item ' . ($currentPage == $i ? "active" : "") . '">
    <a class="page-link" href="?page=' . $i . '">' . $i . '</a>
  </li>';
}

// Next button
if ($currentPage < $totalPages) {
echo '<li class="page-item">
    <a class="page-link" href="?page=' . ($currentPage + 1) . '">Next</a>
  </li>';
} else {
echo '<li class="page-item disabled">
    <span class="page-link">Next</span>
  </li>';
}

echo '</ul></nav>';
        } else {
            echo '<div class="alert alert-warning" role="alert">
            No records found. Please add details.
            </div>';
        }
    }
} catch (mysqli_sql_exception $e) {
    $error_message = $e->getMessage();
    if (strpos($error_message, "Table 'sharma.recipies' doesn't exist") !== false) {
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
        <!--================End Our Bakery Area =================-->
        
        <!--================Newsletter Area =================-->
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