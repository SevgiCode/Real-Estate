<?php

include "config.php";
$query = mysqli_query($con, "SELECT MIN(shop_price) as min_price, MAX(shop_price) as max_price FROM shop ");
$row = mysqli_fetch_array($query);
$min = (int) $row["min_price"];
$max = (int) $row["max_price"];


if(isset($_COOKIE['user_id'])){
    $user_id = $_COOKIE['user_id'];
 }else{
    $user_id = '';
 }
 
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>House.ks</title>

    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link  rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/jquery-ui.css">
    <link rel="stylesheet" href="assets/css/style.css">
   

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">



</head>
<?php include 'header.php'; ?>
<body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed" style="--kt-toolbar-height:55px;--kt-toolbar-height-tablet-and-mobile:55px" cz-shortcut-listen="true">
   


    <div class="d-flex flex-column flex-root">
 
        <div class="page d-flex flex-row flex-column-fluid">

            <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">

        

                <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                    
                    <div class="product d-flex flex-column-fluid" id="kt_product">
                        <div id="kt_content_container" class="container-xxl">

                            <div class="d-flex flex-column flex-xl-row">
                                <div class="flex-column flex-lg-row-auto w-100 w-xl-300px mb-1">
                                    <div class="card fs-6 text-gray-700 fw-bold card-flush ">
                                        <div class="card-header">
                                            <div class="card-title">
                                                <h2>Filters</h2>
                                            </div>
                                            <div class="card-toolbar d-block d-lg-none drop-inactive">
                                                <!-- <svg width="12" height="12" viewBox="0 0 16 27" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M16 23.207L6.11 13.161 16 3.093 12.955 0 0 13.161l12.955 13.161z" fill="#5e6278" ></path>
                                                </svg> -->
                                            </div>
                                        </div>
                                        <div class="card-body filter-card p-0">
                                            <div class="separator"></div>
                                            <div class="card card-flush ">
                                                <div class="card-header">
                                                    <div class="card-title">
                                                        <h4>Price</h4>
                                                    </div>
                                                    <div class="card-toolbar drop-active">
                                                        <!-- <svg width="12" height="12" viewBox="0 0 16 27" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M16 23.207L6.11 13.161 16 3.093 12.955 0 0 13.161l12.955 13.161z" fill="#5e6278" ></path>
                                                        </svg> -->
                                                    </div>
                                                </div>
                                                <div class="pt-0 card-body">
                                                    <div class="price-slider">
                                                        <input autocomplete="off" type="hidden" id="minimum_price" value="<?php echo $min; ?>" />
                                                        <input autocomplete="off" type="hidden" id="maximum_price" value="<?php echo $max; ?>" />
                                                        <p id="price_text">€<?php echo $min; ?> - €<?php echo $max; ?></p>
                                                        <div id="price_range"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="separator "></div>
                                            <div class="card card-flush ">
                                                <div class="card-header">
                                                    <div class="card-title">
                                                        <h4>City</h4>
                                                    </div>
                                                    <div class="card-toolbar drop-active">
                                                        <!-- <svg width="12" height="12" viewBox="0 0 16 27" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M16 23.207L6.11 13.161 16 3.093 12.955 0 0 13.161l12.955 13.161z" fill="#5e6278" ></path>
                                                        </svg> -->
                                                    </div>
                                                </div>
                                                <div class="pt-0 card-body">
                                                    <?php
                                                    $query = mysqli_query($con, "SELECT DISTINCT(city) FROM shop ORDER BY city ASC ");
                                                    while ($row = mysqli_fetch_array($query)) {
                                                        echo '<div class="mb-2 form-check form-check-custom form-check-solid me-10">
                                                            <input class="form-check-input" data-filter="city" type="checkbox" value="' . $row["city"] . '" id="city' . $row["city"] . '" />
                                                            <label class="form-check-label" for="city' . $row["city"] . '">
                                                                ' . $row["city"] . '
                                                            </label>
                                                        </div>';
                                                    }
                                                    ?>

                                                </div>
                                            </div>
                                            <div class="separator "></div>
                                            <div class="card card-flush ">
                                                <div class="card-header">
                                                    <div class="card-title">
                                                        <h4>Area</h4>
                                                    </div>
                                                    <div class="card-toolbar drop-active">
                                                        <!-- <svg width="12" height="12" viewBox="0 0 16 27" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M16 23.207L6.11 13.161 16 3.093 12.955 0 0 13.161l12.955 13.161z" fill="#5e6278" ></path>
                                                        </svg> -->
                                                    </div>
                                                </div>
                                                <div class="pt-0 card-body">
                                                    <?php
                                                    $query = mysqli_query($con, "SELECT DISTINCT(area) FROM shop ORDER BY area ASC ");
                                                    while ($row = mysqli_fetch_array($query)) {
                                                        echo '<div class="mb-2 form-check form-check-custom form-check-solid me-10">
                                                            <input class="form-check-input" data-filter="area" type="checkbox" value="' . $row["area"] . '" id="area' . $row["area"] . '" />
                                                            <label class="form-check-label" for="area' . $row["area"] . '">
                                                                ' . $row["area"] . '
                                                            </label>
                                                        </div>';
                                                    }
                                                    ?>

                                                </div>
                                            </div>
                                            <div class="separator "></div>
                                            <div class="card card-flush ">
                                                <div class="card-header">
                                                    <div class="card-title">
                                                        <h4>Occasion</h4>
                                                    </div>
                                                    <div class="card-toolbar drop-active">
                                                        <!-- <svg width="12" height="12" viewBox="0 0 16 27" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M16 23.207L6.11 13.161 16 3.093 12.955 0 0 13.161l12.955 13.161z" fill="#5e6278" ></path>
                                                        </svg> -->
                                                    </div>
                                                </div>
                                                <div class="pt-0 card-body">
                                                    <?php
                                                    $query = mysqli_query($con, "SELECT DISTINCT(occasion) FROM shop ORDER BY occasion ASC ");
                                                    while ($row = mysqli_fetch_array($query)) {
                                                        echo '<div class="mb-2 form-check form-check-custom form-check-solid me-10">
                                                            <input class="form-check-input" data-filter="occasion" type="checkbox" value="' . $row["occasion"] . '" id="occasion' . $row["occasion"] . '" />
                                                            <label class="form-check-label" for="occasion' . $row["occasion"] . '">
                                                                ' . $row["occasion"] . '
                                                            </label>
                                                        </div>';
                                                    }
                                                    ?>

                                                </div>
                                            </div>
                                            <div class="separator "></div>
                                            <div class="card card-flush ">
                                                <div class="card-header">
                                                    <div class="card-title">
                                                        <h4>Floor</h4>
                                                    </div>
                                                    <div class="card-toolbar drop-active">
                                                        <!-- <svg width="12" height="12" viewBox="0 0 16 27" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M16 23.207L6.11 13.161 16 3.093 12.955 0 0 13.161l12.955 13.161z" fill="#5e6278" ></path>
                                                        </svg> -->
                                                    </div>
                                                </div>
                                                <div class="pt-0 card-body">
                                                    <?php
                                                    $query = mysqli_query($con, "SELECT DISTINCT(floor) FROM shop ORDER BY floor ASC ");
                                                    while ($row = mysqli_fetch_array($query)) {
                                                        echo '<div class="mb-2 form-check form-check-custom form-check-solid me-10">
                                                            <input class="form-check-input" data-filter="floor" type="checkbox" value="' . $row["floor"] . '" id="floor' . $row["floor"] . '" />
                                                            <label class="form-check-label" for="floor' . $row["floor"] . '">
                                                                ' . $row["floor"] . '
                                                            </label>
                                                        </div>';
                                                    }
                                                    ?>

                                                </div>
                                            </div>
                                            <div class="separator "></div>
                                            <div class="card card-flush ">
                                                <div class="card-header">
                                                    <div class="card-title">
                                                        <h4>Numer of Floors</h4>
                                                    </div>
                                                    <div class="card-toolbar drop-active">
                                                        <!-- <svg width="12" height="12" viewBox="0 0 16 27" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M16 23.207L6.11 13.161 16 3.093 12.955 0 0 13.161l12.955 13.161z" fill="#5e6278" ></path>
                                                        </svg> -->
                                                    </div>
                                                </div>
                                                <div class="pt-0 card-body">
                                                    <?php
                                                    $query = mysqli_query($con, "SELECT DISTINCT(num_of_floor) FROM shop ORDER BY num_of_floor ASC ");
                                                    while ($row = mysqli_fetch_array($query)) {
                                                        echo '<div class="mb-2 form-check form-check-custom form-check-solid me-10">
                                                            <input class="form-check-input" data-filter="num_of_floor" type="checkbox" value="' . $row["num_of_floor"] . '" id="num_of_floor' . $row["num_of_floor"] . '" />
                                                            <label class="form-check-label" for="num_of_floor' . $row["num_of_floor"] . '">
                                                                ' . $row["num_of_floor"] . '
                                                            </label>
                                                        </div>';
                                                    }
                                                    ?>

                                                </div>
                                            </div>
                                           
                                          
                                            
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="flex-lg-row-fluid ms-lg-1">
                                    <div id="productsContainer" class="row g-1">

                                    </div>
                                    <div id="pagination">


                                    </div>
                                </div>
                            </div>



                        </div>
                    </div>
                </div>


              

            </div>
        </div>
    </div>
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/jquery-ui.js"></script>
    <script src="assets/js/script-shop.js"></script>





</body>

</html>