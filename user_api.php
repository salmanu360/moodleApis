<?php
include 'connection.php';

header('Content-Type: application/json');
header("Access-Control-Allow-Origin: http://localhost:3000");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
// Query to get unique records
$sql = "SELECT 
DISTINCT rn.name AS role_name,
u.firstname,
u.lastname,
u.email,
u.country,
u.city,
u.password,
u.description,
CASE 
    WHEN rn.name = 'certification officer' THEN 4
    WHEN rn.name = 'bcva examiner' THEN 3
    ELSE NULL
END AS role_value,
CASE 
    WHEN rn.name = 'certification officer' THEN 'internal'
    WHEN rn.name = 'bcva examiner' THEN 'external'
    ELSE NULL
END AS type,
CASE 
    WHEN rn.name = 'certification officer' THEN ''
    WHEN rn.name = 'bcva examiner' THEN 'examiner'
    ELSE NULL
END AS site_user_type
FROM 
mdl_role_assignments ra
JOIN 
(SELECT DISTINCT roleid, name FROM mdl_role_names) rn ON ra.roleid = rn.roleid
JOIN 
mdl_user u ON ra.userid = u.id;";
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
