<?php
include "db_connect.php";

if(isset($_GET['query'])) {

    $keyword = trim($_GET['query']);

    $stmt = $conn->prepare("
        SELECT id, name, price 
        FROM products 
        WHERE name LIKE CONCAT('%', ?, '%')
        OR category LIKE CONCAT('%', ?, '%')
        LIMIT 10
    ");

    $stmt->bind_param("ss", $keyword, $keyword);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo '
            <a href="product.php?id='.$row['id'].'" class="list-group-item list-group-item-action">
                '.$row['name'].' - ₹'.$row['price'].'
            </a>';
        }
    } else {
        echo '<div class="list-group-item">No results found</div>';
    }
}
?>
