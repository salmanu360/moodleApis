<?php
include 'connection.php';

header('Content-Type: application/json');
header("Access-Control-Allow-Origin: http://localhost:3000");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// Query to get unique records
$sql = "SELECT d.userid, u.firstname,u.lastname,u.username,u.email,u.city,u.country, d.data, d.fieldid
FROM mdl_user_info_data d
JOIN mdl_user u ON d.userid = u.id
WHERE d.fieldid = 9 AND (d.data IS NULL OR d.data = '')";
$result = $conn->query($sql);

$data = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

// Query to get the count of unique records
$countSql = "SELECT COUNT(DISTINCT id) AS total_count FROM mdl_user_info_data WHERE data ='' and fieldid=9";
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
