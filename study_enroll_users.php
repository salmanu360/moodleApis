<?php
include 'connection.php';

header('Content-Type: application/json');
header("Access-Control-Allow-Origin: http://localhost:3000");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");


$sql = "
    SELECT 
        c.id AS course_id, c.fullname, c.shortname, 
        e.id AS entroll_id
    FROM mdl_course c
    LEFT JOIN mdl_enrol e ON c.id = e.courseid
";
$result = $conn->query($sql);

$data = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $courseId = $row['course_id'];
     
        // If the course is not already in the data array, add it
        if (!isset($data[$courseId])) {
            $data[$courseId] = array(
                'id' => $row['course_id'],
                'fullname' => $row['fullname'],
                'shortname' => $row['shortname'],
            );
        }
        

        // If there is group data, add it to the groups array
        // if ($groupId !== null) {
        //     if (!isset($data[$courseId]['groups'][$groupId])) {
        //         $data[$courseId]['groups'][$groupId] = array(
        //             'id' => $groupId,
        //             'name' => $row['group_name'],
        //             'description' => $row['group_description'],
        //             'members' => array()
        //         );
        //     }

        // }
    }
}

// Convert the groups array from associative to indexed arrays for each course
foreach ($data as &$course) {
    $course['groups'] = array_values($course['groups']);
}

// Convert the data array to a list
$data = array_values($data);

// Query to get the count of unique records in mdl_course
$countSql = "SELECT COUNT(id) AS total_count FROM mdl_course";
$countResult = $conn->query($countSql);
$totalCount = 0;

if ($countResult->num_rows > 0) {
    $countRow = $countResult->fetch_assoc();
    $totalCount = $countRow['total_count'];
}

// Add the total count to the response
$response = array(
    'total_count' => $totalCount,
    'data' => $data,
    'day'=>"fridaty,"
);

echo json_encode($response);
?>