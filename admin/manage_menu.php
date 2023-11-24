<?php
include('../database/db.php')

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Manage Menu</title>
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
            <h3 class="text-primary"><i class="fa fa-cogs me-2"></i>Manage Menu</h3>
            </div>
            <!-- Sale & Revenue End -->
            <?php
if (isset($_POST['delete_selected'])) {
    if (!empty($_POST['delete_id'])) {
        $deleteIDs = implode(",", $_POST['delete_id']);

       

            // Now, perform the database deletion
            $deleteQuery = "DELETE FROM menu_items WHERE m_id IN ($deleteIDs)";
            $deleteResult = mysqli_query($conn, $deleteQuery);

            if ($deleteResult) {
                echo '<div class="alert alert-success" role="alert">Selected entries deleted successfully.</div>';
                // Redirect to a different page or refresh the current page after deletion
                // header("Location: yourpage.php");
            } else {
                echo '<div class="alert alert-danger" role="alert">Error deleting selected entries.</div>';
            }
       
    } else {
        echo '<div class="alert alert-warning" role="alert">No entries selected for deletion.</div>';
    }
}
?>







            <!-- Sales Chart Start -->
            <div class="container-fluid pt-4 px-4">
            <?php
$priceerr = $menuerr = $descerr = "";
if (isset($_POST["submit"])) {
    // Establish database connection - $conn should be your database connection object

    // Fetch and sanitize user inputs
    $name = $conn->real_escape_string($_POST['menu_name']);
    $desc = $conn->real_escape_string($_POST['desc']);
    $price = $conn->real_escape_string($_POST['price']);

    // Check for empty fields
    if (empty($name) || empty($price) || empty($desc)) {
        $menuerr = empty($name) ? "* This Field Is Required" : "";
        $priceerr = empty($price) ? "* This Field Is Required" : "";
        $descerr = empty($desc) ? "* This Field Is Required" : "";
    } else {
        // Create directory if it doesn't exist
        $sql3 = "CREATE TABLE IF NOT EXISTS menu_items (
            m_id int(50) AUTO_INCREMENT,
            status varchar(50) DEFAULT NULL,
            name varchar(255) NOT NULL,
            price varchar(555) NOT NULL,
            description LONGTEXT NOT NULL,
            a_date DATE NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (m_id)
        )";

        if ($conn->query($sql3) !== TRUE) {
            echo '<div class="alert alert-danger" role="alert">
                Error creating table 
            </div>';
        }

        $checkIfExists = "SELECT * FROM menu_items WHERE name = '$name'";
        $result = $conn->query($checkIfExists);

        if ($result->num_rows > 0) {
            // Service name already exists
            echo '<div class="alert alert-warning" role="alert">
                Menu name already taken. Please use a different name.
            </div>';
        } else {
            $sql4 = "INSERT INTO menu_items (name, price, description) 
            VALUES ('$name', '$price', '$desc')";

            if ($conn->query($sql4) === TRUE) {
                echo '<div class="alert alert-primary" role="alert">
                    Menu Item Added
                </div>';
            } else {
                echo "Error: " . $sql4 . "<br>" . $conn->error;
            }
        }
    }
}
?>
<?php
if (isset($_POST['delete_profile'])) {
    $id = $_POST['delete_id'];
 // File path from the database

    $deleteQuery = "DELETE FROM menu_items WHERE m_id='$id'";
    $deleteQuery_run = mysqli_query($conn, $deleteQuery);

    if ($deleteQuery_run) {
      

        echo '<div class="alert alert-danger" role="alert">
            Menu item Deleted. ID: ' . $id . '
        </div>';
    } else {
        echo '<div class="alert alert-warning" role="alert">
            Menu item Not Deleted. ID: ' . $id . '
        </div>';
    }
}
?>

  <?php
if (isset($_POST['change_status'])) {
    $id = $_POST['id'];

    // Assuming $conn is your database connection
    // Fetch the current status from the database for the given ID
    $statusQuery = "SELECT status FROM menu_items WHERE m_id = $id";
    $statusResult = $conn->query($statusQuery);

    if ($statusResult) {
        $row = $statusResult->fetch_assoc();
        $currentStatus = $row['status'];

        // Toggle the status based on the current value
        $newStatus = ($currentStatus === '1') ? 'NULL' : '1';

        // Update the status for the given ID
        $updateQuery = "UPDATE menu_items SET status = $newStatus WHERE m_id = $id";
        $updateResult = $conn->query($updateQuery);

        if ($updateResult) {
           
            echo'<div class="alert alert-primary" role="alert">
            Status for ID: '.$id.' changed successfully !
</div>';
        } else {
           
            echo'<div class="alert alert-warning" role="alert">
            Error updating status: '. $conn->error.' !
</div>';
        }
    } else {
     
        echo'<div class="alert alert-warning" role="alert">
        Error fetching status:: '. $conn->error.' !
</div>';
    }
}
?>


                <div class="row g-4">
                <div class="col-sm-12 ">
                <form action="manage_menu.php" enctype="multipart/form-data" name="submit" class="bg-light rounded h-100 p-4" method="post">
    <h3 class="mb-4">Add Menu You Offer</h3>
    <div class="form-floating">
        <input name="menu_name" type="text" class="form-control" id="floatingInput" placeholder="celebration cake">
        <label for="floatingInput">Add menu Name</label>
    </div>
    <p class="text-alerts"><?php echo $menuerr ?></p>
    <div class="form-floating">
        <input name="price" type="text" class="form-control" id="floatingPassword" placeholder="file">
        <label for="floatingPassword">Price</label>
    </div>
    <p class="text-alerts"><?php echo $priceerr ?></p>
    <div class="form-floating">
        <textarea name="desc" class="form-control" placeholder="Add Menu Description" id="floatingTextarea"
            style="height: 100px;"></textarea>
        <label for="floatingTextarea">Menu Description</label>
    </div>
    <p class="text-alerts"><?php echo $descerr ?></p>
    <button name="submit" type="submit" class="btn btn-primary m-2"><i class="fa fa-file-code me-2"></i>Submit</button>
</form>
                    </div>
                </div>
            </div>
            <!-- Sales Chart End -->


            <!-- Recent Sales Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-light text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Your Added Menu Items</h6>
                     
                    </div>
                    <div class="table-responsive">
                    <form action="" method="POST">
                    <?php
try {
    $query = "SELECT * FROM menu_items ORDER BY m_id DESC";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        if (mysqli_num_rows($query_run) > 0) {
?>
            <table class="table text-start align-middle table-bordered table-hover mb-0">
        <thead>
            <tr class="text-dark">
                <th scope="col">Select</th>
                <th scope="col">Date</th>
                <th scope="col">menu Name</th>
                
                <th scope="col">price</th>
                <th scope="col">Description</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
        while ($row = mysqli_fetch_assoc($query_run)) {
            ?>
            <tr>
                <td> <input class="form-check-input" type="checkbox" name="delete_id[]" value="<?php echo $row['m_id']; ?>"></td>
                <td><?php echo $row['a_date']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td>Rs.<?php echo $row['price']; ?></td>
               
                <td><?php echo $row['description']; ?></td>
                <td> <?php
                        if ($row['status'] === null) {
                          
                            echo '<div class="alert alert-danger" role="alert">
                            NotActivated
                          </div>';
                        } else {
                             echo '<div class="alert alert-primary" role="alert">
                          Activated
                          </div>';
                        }
                        ?></td>
                <td>
            
                    <form action="" class="mt-1" onclick="return confirm('Are you sure you wish to change status of this Album ?');" method="POST"> 
                <input type="hidden" name="id" value="<?php echo $row['m_id'] ?>">
                <button type ="submit" name="change_status" class="btn btn-sm btn-warning" >Activate/Deactivate</button>  </form>
                <form action="" class="mt-1" onclick="return confirm('Are you sure you wish to delete this Album ?');" method="POST"> 
                <input type="hidden" name="delete_id" value="<?php echo $row['m_id'] ?>">
                <button type ="submit" name="delete_profile" class="btn btn-sm btn-danger mt-1" >Delete</button>  </form>
            </td>
          
            </tr>
        <?php
        }
        ?>
        </tbody>
    </table>
    <div class="d-flex align-items-center justify-content-between mb-4 mt-4">
                        <h6 class="mb-0">Delete Selected Entries</h6>
                        <button type="submit" name="delete_selected" class="btn btn-sm btn-danger mt-1">Delete Selected</button>
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