<?php
include 'connection.php';

header('Content-Type: application/json');

// Query to get unique records
$sql = "SELECT DISTINCT * FROM mdl_user";
$result = $conn->query($sql);

$data = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

// Query to get the count of unique records
$countSql = "SELECT COUNT(DISTINCT id) AS total_count FROM mdl_user";
$countResult = $conn->query($countSql);
$totalCount = 0;

if ($countResult->num_rows > 0) {
    $countRow = $countResult->fetch_assoc();
    $totalCount = $countRow['total_count'];
}

// Add the total count to the response
$response = array(
    'total_count' => $totalCount,
    'data' => $data
);

echo json_encode($response);
?>
