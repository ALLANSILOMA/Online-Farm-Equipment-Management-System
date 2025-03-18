<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "password";
$dbname = "online_farm_equipment_management_system";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Count all listed equipments
$listed_query = "SELECT COUNT(*) AS total FROM equipments";
$listed_result = $conn->query($listed_query);
$listed_count = $listed_result->fetch_assoc()['total'];

// Count available equipments
$available_query = "SELECT COUNT(*) AS available FROM equipments WHERE status = 'available'";
$available_result = $conn->query($available_query);
$available_count = $available_result->fetch_assoc()['available'];

// Count booked equipments
$booked_query = "SELECT COUNT(*) AS booked FROM equipments WHERE status = 'booked'";
$booked_result = $conn->query($booked_query);
$booked_count = $booked_result->fetch_assoc()['booked'];

// Return data as JSON
echo json_encode([
    "listed" => $listed_count,
    "available" => $available_count,
    "booked" => $booked_count
]);

$conn->close();


