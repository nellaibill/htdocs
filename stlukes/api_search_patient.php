<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include 'config.php';

// Get the search term from GET or POST
$search = isset($_REQUEST['search']) ? trim($_REQUEST['search']) : '';

// Build query to match hospital_no OR patient_name
$sql = "SELECT * FROM patient_data WHERE 1=1";
$params = [];
if ($search !== '') {
    $sql .= " AND (hospital_no LIKE ? OR patient_name LIKE ?)";

    $params[] = "%$search%";
    $params[] = "%$search%";
}
$sql .= " ORDER BY id DESC LIMIT 20";

$stmt = mysqli_prepare($con, $sql);
if ($params) {
    $types = str_repeat('s', count($params));
    mysqli_stmt_bind_param($stmt, $types, ...$params);
}
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$rows = [];
while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
}

echo json_encode([
    'success' => true,
    'count' => count($rows),
    'data' => $rows
]);
?>
