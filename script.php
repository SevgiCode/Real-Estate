<?php
$start = 0;

$rows_per_page = 4;

$records = $con->query("SELECT * FROM property");
$nr_of_rows = $records->num_rows;

$pages = ceil($nr_of_rows / $rows_per_page);

if(isset($_GET['page-nr'])){
    $page = $_GET['page-nr']-1;
    $start = $page * $rows_per_page;
}

$result = $con->query("SELECT * FROM property LIMIT $start, $rows_per_page");
?>