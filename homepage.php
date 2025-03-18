<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farm Equipment Booking</title>
    <!-- Font Awesome Icons Library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!--Google Icon Library-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=north_east" />
</head>
    <style>

        body {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
            display: flex;
            height: 100vh;
            background-color: #d9d9d9;
        }


        .sidebar {
            width: 250px;
            background: #9eacb6;
            padding: 20px;
            display: flex;
            flex-direction: column;
        }

        .sidebar ul {
            list-style: none;
        }

        .sidebar ul li {
            margin: 10px 0;
        }

        .sidebar ul li a {
            text-decoration: none;
            color: black;
            display: block;
            padding: 10px;
            border-radius: 5px;
        }

        .sidebar ul li a:hover, .sidebar ul li .active {
            background: #d97706;
        }

        .logout {
            margin-top: auto;
            background: #d97706;
            padding: 10px;
            text-align: center;
            border-radius: 5px;
            cursor: pointer;
        }

        /* Main Content */
        .content {
            flex: 1;
            padding: 20px;
        }

        /* Top Navigation */
        .top-nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #fff;
            padding: 10px 20px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .search input {
            padding: 8px;
            width: 200px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: bold;
        }

        #logout-btn {
            background: #ffafcc;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
        }

        /* Dashboard Overview */
        .dashboard h1 {
            margin-bottom: 20px;
        }

        .stats {
            display: flex;
            gap: 20px;
            justify-content: space-between;
        }

        .card {
            background: white;
            padding: 15px;
            text-align: center;
            border-radius: 10px;
            width: 230px;
            height: 80px;
            display: flex;
            flex-direction: column;
            justify-content: center;

        }

        .card h2 {
            margin: 0;
            font-size: 22px;
        }

        .card p {
            margin: 0;
            font-size: 14px;
        }

        .explore {
            padding: 10px 15px;
            background: #bde0fe;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            align-self: center;
        }

        /* Equipment Table */
        .equipment-table {
            margin-top: 20px;
        }

        .equipment-table h2 {
            margin-bottom: 10px;
        }

        .equipment-table input {
            padding: 8px;
            width: 100%;
            margin-bottom: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 10px;
            overflow: hidden;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background: #a2d2ff;
        }

        .pagination {
            margin-top: 10px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .pagination select, .pagination button {
            padding: 5px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
    </style>
</head>
<body>

<!-- Sidebar Navigation -->
<aside class="sidebar">


        <ul>
            <li><a href="homepage.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
            <li><a href="bookings.php"><i class="fas fa-calendar-alt"></i> Bookings</a></li>
            <li><a href="equipments.php"><i class="fas fa-tractor"></i> Equipments</a></li>
            <li><a href="equipmentscategory.php"><i class="fas fa-tags"></i> Equipment Category</a></li>
            <li><a href="notifications.php"><i class="fa-solid fa-bell"></i> Notifications</a></li>
            <li><a href="profile.php"><i class="fas fa-user"></i> Profile</a></li>
            <li><a href="ratings.php"><i class="fas fa-star"></i> Ratings & Reviews</a></li>


        </ul>

    <div class="logout">Log Out</div>
</aside>

<!-- Main Content -->
<main class="content">
    <!-- Top Navigation -->
    <header class="top-nav">
        <div class="search">
            <input type="text" placeholder="Search">
        </div>
        <div class="user-info">
            <span id="user-initials">DU</span>
            <button id="logout-btn">Sign Out</button>
        </div>
    </header>

    <!-- Dashboard Overview -->
    <section class="dashboard">
        <h1>DASHBOARD</h1>
        <div class="stats">
            <div class="card">
                <h2 id="listed-equipments">0</h2>
                <p>LISTED EQUIPMENTS</p>
            </div>
            <div class="card">
                <h2 id="available-equipments">0</h2>
                <p>AVAILABLE EQUIPMENTS</p>
            </div>
            <div class="card">
                <h2 id="booked-equipments">0</h2>
                <p>BOOKED EQUIPMENTS</p>
            </div>
            <button class="explore">Explore Bookings<span class="material-symbols-outlined">north_east</span> </button>
        </div>
    </section>

    <!-- Equipment Table -->
    <section class="equipment-table">
        <h2>Equipments</h2>
        <input type="text" id="search" placeholder="Search">
        <table>
            <thead>
            <tr>
                <th>Image</th>
                <th>Owner</th>
                <th>Name</th>
                <th>Description</th>
                <th>Category</th>
                <th>Location</th>
                <th>Rental Price</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody id="equipment-list">
            <!-- Data will be inserted here dynamically -->
            </tbody>
        </table>
        <div class="pagination">
            <label>Per page:</label>
            <select id="per-page">
                <option>10</option>
                <option>20</option>
                <option>50</option>
                <option>100</option>
            </select>
            <button>Next</button>
        </div>
    </section>
</main>

<script>
    fetch('count.php')
        .then(response => response.json())
        .then(data => {
            document.getElementById("listed-equipments").innerText = data.listed;
            document.getElementById("available-equipments").innerText = data.available;
            document.getElementById("booked-equipments").innerText = data.booked;
        })
        .catch(error => console.error('Error fetching data:', error));

    // Set user initials dynamically
    const username = "Demo User"; // Replace with dynamic username
    document.getElementById("user-initials").innerText = username.split(" ").map(n => n[0]).join("").toUpperCase();
</script>

</body>
</html>
