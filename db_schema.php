<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "online_farm_equipment_management_system";

// Connect to MySQL
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all tables in the database
$tablesQuery = $conn->query("SHOW TABLES");

echo "<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Database Schema</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid black; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Database Schema: <em>$dbname</em></h2>";

while ($tableRow = $tablesQuery->fetch_array()) {
    $tableName = $tableRow[0];

    echo "<h3>Table: <strong>$tableName</strong></h3>
          <table>
              <thead>
                  <tr>
                      <th>Column Name</th>
                      <th>Data Type</th>
                      <th>Constraints</th>
                  </tr>
              </thead>
              <tbody>";

    // Fetch columns for this table
    $columnsQuery = $conn->query("SHOW COLUMNS FROM `$tableName`");

    while ($column = $columnsQuery->fetch_assoc()) {
        $constraints = [];

        if (strpos($column['Type'], "int") !== false) {
            $dataType = "INTEGER";
        } elseif (strpos($column['Type'], "varchar") !== false) {
            $dataType = "STRING";
        } else {
            $dataType = strtoupper($column['Type']);
        }

        if ($column['Key'] == "PRI") {
            $constraints[] = "Primary Key";
        }
        if ($column['Null'] == "NO") {
            $constraints[] = "NOT NULL";
        }
        if (!empty($column['Default'])) {
            $constraints[] = "Default: " . $column['Default'];
        }
        if ($column['Extra']) {
            $constraints[] = ucfirst($column['Extra']);
        }

        echo "<tr>
                <td>{$column['Field']}</td>
                <td>$dataType</td>
                <td>" . implode(", ", $constraints) . "</td>
              </tr>";
    }

    echo "</tbody></table>";
}

echo "</body></html>";

// Close connection
$conn->close();
?>
