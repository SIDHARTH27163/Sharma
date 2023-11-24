<?php
include('../database/db.php')

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Add Product</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css?v=<?php echo time(); ?>" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css?v=<?php echo time(); ?>" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css?v=<?php echo time(); ?>" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css?v=<?php echo time(); ?>" rel="stylesheet">
</head>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <!-- <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div> -->
        <!-- Spinner End -->


        <!-- Sidebar Start -->
        <?php
            include('./components/sidebar.php')
            ?>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <?php
            include('./components/admin_navbar.php')
            ?>
            <!-- Navbar End -->


            <!-- Sale & Revenue Start -->
            <div class="container-fluid pt-4 px-4">
            <h3 class="text-primary"><i class="fa fa-cogs me-2"></i>Manage Products You Offer</h3>
            </div>
            <!-- Sale & Revenue End -->
          

            <!-- Sales Chart Start -->
            <div class="container-fluid pt-4 px-4">
            <?php
$serviceerr = $fileerr = $descerr = $caterr=$priceerr ="";
if(isset($_POST["submit"])) {

    // Establish database connection - $conn should be your database connection object

    // Fetch and sanitize user inputs
    $p_name = $conn->real_escape_string($_POST['service_name']);
    $desc = $conn->real_escape_string($_POST['desc']);
    $cat = $conn->real_escape_string($_POST['cat']);
    $price = $conn->real_escape_string($_POST['price']);
    $file = $_FILES['service_file']; // File details

    // Check for empty fields
    if (empty($p_name) || empty($file['name']) || empty($desc)|| empty($cat) ||empty($price)) {
        $serviceerr = empty($p_name) ? "* This Field Is Required" : "";
        $fileerr = empty($file['name']) ? "* This Field Is Required" : "";
        $descerr = empty($desc) ? "* This Field Is Required" : "";
        $caterr = empty($desc) ? "* This Field Is Required" : "";
        $priceerr = empty($price) ? "* This Field Is Required" : "";
    } else {
        // Create directory if it doesn't exist
       
      
        $sql3 = "CREATE TABLE IF NOT EXISTS products (
            ID int(50) AUTO_INCREMENT,
            status varchar(50) DEFAULT NULL,
            z_link varchar(250) DEFAULT '0',
            s_link varchar(250) DEFAULT '0',
            p_name varchar(255) NOT NULL,
            category varchar(255) NOT NULL,
            price varchar(255) NOT NULL,
            file_path varchar(255) NOT NULL,
            original_name varchar(555) NOT NULL,
            description LONGTEXT NOT NULL,
            a_date DATE NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (ID)
        )";
        

        if ($conn->query($sql3) !== TRUE) {
            echo '<div class="alert alert-danger" role="alert">
                Error creating table 
            </div>';
        }

      

        // $checkIfExists = "SELECT * FROM products WHERE p_name = '$p_name'";
        // $result = $conn->query($checkIfExists);
    
        // if ($result->num_rows > 0) {
           
        //     echo '<div class="alert alert-warning" role="alert">
        //         Product name already taken. Please use a different name.
        //     </div>';
        // } else {
            $uploadDir = 'products/';
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
    
            $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION); // Get the file extension
            $newFileName = 'sharma' . uniqid() . '.' . $fileExtension; // Create a new unique filename
            $fileName = $uploadDir . $newFileName;
            $FILE = $file['name']; // Original file name
    
            // Image resizing logic (assuming it's an image)
            if ($fileExtension == 'jpg' || $fileExtension == 'jpeg' || $fileExtension == 'png') {
                $image = imagecreatefromstring(file_get_contents($file['tmp_name']));
                $resized = imagescale($image, 500); // Resize the image to a maximum width of 800px (adjust as needed)
                imagejpeg($resized, $fileName); // Save the resized image as a JPEG
            } else {
                move_uploaded_file($file['tmp_name'], $fileName); // For non-image files, directly move to the uploads folder
            }
    
            $file_path = $conn->real_escape_string($fileName);
            // Service name doesn't exist, proceed with insertion
            $sql4 = "INSERT INTO products (p_name, file_path, description, original_name , category , price) 
            VALUES ('$p_name', '$file_path', '$desc', '$newFileName' , '$cat' , '$price')";
    
            if ($conn->query($sql4) === TRUE) {
                echo '<div class="alert alert-primary" role="alert">
                    Product Added
                </div>';
            } else {
                echo "Error: " . $sql4 . "<br>" . $conn->error;
            }
        }
    }
// }
?>


                <div class="row g-4">
                <div class="col-sm-12 ">
                        <form action="add_product.php" enctype="multipart/form-data" name="submit" class="bg-light rounded h-100 p-4" method="post">
                            <h3 class="mb-4">Add Product You Offer</h3>
                            <div class="form-floating ">
                                <input  name="service_name" type="text" class="form-control" id="floatingInput"
                                    placeholder="celebration cake">
                                    
                                <label for="floatingInput">Add Product Name</label>

                            </div>
                            <p class="text-alerts"><?php echo $serviceerr?></p>
                            <div class="form-floating ">
                                <input  name="service_file" type="file" class="form-control" id="floatingPassword"
                                    placeholder="file">
                                <label for="floatingPassword">Image For Service</label>
                            </div>
                            <p class="text-alerts"><?php echo $fileerr?></p>
                         
                          
                           <div class="col-sm-12">
                           <?php
try {
    $query = "SELECT * FROM services where status=1 ORDER BY id DESC";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        if (mysqli_num_rows($query_run) > 0) {
?>
<select name="cat"class="form-select form-select-lg " aria-label=".form-select-lg example">
                                <option selected value="">Select Category</option>
                                <?php
        while ($row = mysqli_fetch_assoc($query_run)) {
            ?>
                                <option ><?php echo $row['service_name']; ?></option>
                                <?php
        }
        ?>
</select>
<p class="text-alerts"><?php echo $caterr?></p>

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
?>        </div>   
                            <div class="form-floating">
                                <textarea  name="desc" class="form-control" placeholder="Add Product Description"
                                    id="floatingTextarea" style="height: 100px;"></textarea>
                                <label for="floatingTextarea">Product Description</label>
                            </div>
                            <p class="text-alerts"><?php echo $descerr?></p>
                           <div class="row">
                            <div class="col-sm-6">
                            <div class="form-floating ">
                                <input  name="z_link" type="url" class="form-control" id="floatingInput"
                                    placeholder="link to the external website">
                                    
                                <label for="floatingInput">Add Zomato link </label>

                            </div>
                           
                            </div>
                            <div class="col-sm-6">
                            <div class="form-floating ">
                                <input  name="s_link" type="url" class="form-control" id="floatingInput"
                                    placeholder="link to the external website">
                                    
                                <label for="floatingInput">Add Swiggy link </label>

                            </div>
                           
                            </div>
                           </div>
                           <div class="col-sm-12 mt-2">
                            <div class="form-floating ">
                                <input  name="price" type="text" class="form-control" id="floatingInput"
                                    placeholder="product price">
                                    
                                <label for="floatingInput">Add Product Price </label>
                             
                            </div>
                            <p class="text-alerts"><?php echo $priceerr?></p>
                            </div>
                            <button  name="submit" type="submit" class="btn btn-primary m-2"><i class="fa fa-file-code me-2"></i>Submit</button>
                           
                        </form>
                    </div>
                </div>
            </div>
          


        


           


          
        </div>
        <!-- Content End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>