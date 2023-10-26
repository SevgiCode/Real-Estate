<?php
include "config.php";
if(isset($_COOKIE['user_id'])){
    $user_id = $_COOKIE['user_id'];
 }else{
    $user_id = '';
 }
 
$page = isset($_POST["page"]) ? $_POST["page"] : 1;
$sql = '';

if (isset($_POST["minimumPrice"], $_POST["maximumPrice"])) {
    $minimumPrice = $_POST["minimumPrice"];
    $maximumPrice = $_POST["maximumPrice"];
    $sql .= "shop_price BETWEEN '" . $minimumPrice . "' AND '" . $maximumPrice . "' ";
}

if (isset($_POST["city"])) {
    $city = $_POST["city"];
    $city = implode("','", $city);
    $customSql = "city IN('" . $city . "') ";
    $sql .= empty($sql) ? $customSql : "AND ($customSql)";
}
if (isset($_POST["area"])) {
    $area = $_POST["area"];
    $area = implode("','", $area);
    $customSql = "area IN('" . $area . "') ";
    $sql .= empty($sql) ? $customSql : "AND ($customSql)";
}
if (isset($_POST["occasion"])) {
    $occasion = $_POST["occasion"];
    $occasion = implode("','", $occasion);
    $customSql = "occasion IN('" . $occasion . "') ";
    $sql .= empty($sql) ? $customSql : "AND ($customSql)";
}
if (isset($_POST["floor"])) {
    $floor = $_POST["floor"];
    $floor = implode("','", $floor);
    $customSql = "floor IN('" . $floor . "') ";
    $sql .= empty($sql) ? $customSql : "AND ($customSql)";
}
if (isset($_POST["num_of_floor"])) {
    $num_of_floor = $_POST["num_of_floor"];
    $num_of_floor = implode("','", $num_of_floor);
    $customSql = "num_of_floor IN('" . $num_of_floor . "') ";
    $sql .= empty($sql) ? $customSql : "AND ($customSql)";
}



if (isset($_POST["searchKeyword"])) {
    $searchKeyword = $_POST["searchKeyword"];
    $customSql = "
    city LIKE ('%" . $searchKeyword . "%') ||
    shop__name LIKE ('%" . $searchKeyword . "%') ||
    shop__price LIKE ('%" . $searchKeyword . "%') ||
    area LIKE ('%" . $searchKeyword . "%') ||
    occasion LIKE ('%" . $searchKeyword . "%') ||
    floor LIKE ('%" . $searchKeyword . "%')||
    num_of_floor LIKE ('%" . $searchKeyword . "%')";
    $sql .= empty($sql) ? $customSql : "AND ($customSql)";
}

//Pagination
$recordsPerPage = 12;
$recordsFetched = ($page - 1) * $recordsPerPage;  
$totalRecords = mysqli_num_rows(mysqli_query($con,"SELECT * FROM shop WHERE $sql"));
$totalPages = ceil($totalRecords / $recordsPerPage);

$completeSql = "SELECT * FROM shop WHERE $sql ORDER BY id DESC  LIMIT $recordsFetched,$recordsPerPage ";
$query = mysqli_query($con, $completeSql);
$products = '';

$paginationData = '';
if ($page > 1) {
    $paginationData .=  '<li class="paginate_button page-item previous" ><a data-page="' . ($page - 1) . '" class="page-link"><i class="previous"></i></a></li>';
} 

for ($i = 1; $i <= $totalPages; $i++) {
    $active = $i == $page ? "active": "";
    $paginationData .= '<li class="paginate_button page-item '. $active. '"><a data-page="' .$i. '" class="page-link">' . $i . '</a></li>';
}

if ($totalPages > $page) {
    $paginationData .= '<li class="paginate_button page-item next" ><a data-page="' . ($page + 1) . '" class="page-link"><i class="next"></i></a></li>';
}

$pagination = empty($paginationData) ? '' :  '<div class="card my-2 py-4">
                           <ul class="pagination"> ' . $paginationData . '</ul>
                </div>';

while ($row = mysqli_fetch_array($query)) {
    $total_images = 0;
    if(!empty($row['image_02'])){
        $image_coutn_02 = 1;
     }else{
        $image_coutn_02 = 0;
     }
     if(!empty($row['image_03'])){
        $image_coutn_03 = 1;
     }else{
        $image_coutn_03 = 0;
     }
     if(!empty($row['image_04'])){
        $image_coutn_04 = 1;
     }else{
        $image_coutn_04 = 0;
     }
     if(!empty($row['image_05'])){
        $image_coutn_05 = 1;
     }else{
        $image_coutn_05 = 0;
     }

     $total_images = (1 + $image_coutn_02 + $image_coutn_03 + $image_coutn_04 + $image_coutn_05);

    $products .= '<div class="product-card ">
                                    <div class="card h-100">
                                       
                                        <div class="separator separator-dashed"></div>
                                        <div class="card-body p-4">
                                        <div id="post">
                                        <div id="post-left">
                                        <img src="uploaded_files/' . $row['image_01'] . '" alt="">
                                        </div>
                                        <div id="post-right">
                                            <a class="fs-5 wrap-text-1 fw-bold" >' . $row["shop_name"] . '</a>

                                        <div class="fs-4 text-gray-700 d-flex">
                                            <span class="fw-bold">Price:</span>
                                            <div class="ms-2 fw-bolder">€' . number_format($row["shop_price"],2) . '</div>
                                        </div>

                                        <div class="fs-4 text-gray-700 d-flex">
                                            <span class="fw-bold">City:</span>
                                            <div class="ms-2 fw-bolder">' . $row["city"] . ' </div>
                                        </div>
                                        <div class="fs-4 text-gray-700 d-flex">
                                            <span class="fw-bold">Occasion:</span>
                                            <div class="ms-2 fw-bolder">' . $row["occasion"] . ' </div>
                                        </div>
                                        <div class="fs-4 text-gray-700 d-flex">
                                            <span class="fw-bold">Area:</span>
                                            <div class="ms-2 fw-bolder">' . $row["area"] . ' </div>
                                        </div>
                                        
                                        </div>
                                        
                                        </div>
                                        <a href="view_shop.php?get_id= '.$row['id'].'" class="btn">view shop</a>
                                        
                                        
                                        </div>
                                    </div>
                                </div>';
}

if(!mysqli_num_rows($query)) $products .= '<div class="card min-h-400px col-lg-12">
    <div div="" class="card-body justify-align-center less-container">
        <center><img style="width: 200px;opacity: .5;"
                src="assets/images/empty_search.jpg" alt="">
            <h2>Sorry, no results found!</h2>
            <h4 class="text-muted">Please check the spelling or try searching for something else:)</h4>
        </center>
    </div>
</div>';

$output = new stdClass;
$output->products = $products;
$output->pagination = $pagination;
echo json_encode($output);
