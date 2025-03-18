<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farm Equipment Booking</title>
    <!-- Font Awesome Icons Library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
    }

    .user-info span {
        font-weight: bold;
    }

    #logout-btn {
        background: #ffafcc;
        border: none;
        padding: 8px 15px;
        border-radius: 5px;
        cursor: pointer;
    }

    .new-booking {
        padding: 10px 15px;
        background: #d97706;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        margin-left: 10px;
    }


    .booking-table {
        margin-top: 20px;
    }

    .booking-table h2 {
        margin-bottom: 10px;
    }

    .booking-table input {
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


    <!-- Bookings Table -->
    <section class="booking-table">
        <h2>Bookings</h2>
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
        <input type="text" id="search" placeholder="Search"><button class="new-booking">ADD BOOKING</button>
        </div>
        <table>
            <thead>
            <tr>
                <th>Equipment Owner</th>
                <th>Farmer</th>
                <th>Equipment</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody id="booking-list">
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

    // Set user initials dynamically
    const username = "Demo User"; // Replace with dynamic username
    document.getElementById("user-initials").innerText = username.split(" ").map(n => n[0]).join("").toUpperCase();
</script>

</body>
</html>

