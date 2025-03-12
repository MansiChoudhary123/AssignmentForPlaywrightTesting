<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Webkul</title>
    <link rel="stylesheet" href="./css/Home.css">
</head>
<body>
    <header>
        <div class="Header-Container">
            <h3><span class="Profile-Logo">Profile</span> Hub</h3>
            <div>
                <a href="./Profile.html">Profile</a>
                <a href="./Home.html">Sign Up</a>
            </div>
        </div>
    </header>

    <div class="profile-Container">
        <h2>List of all Profiles</h2>
        <div class="profile-list-container">
            <table class="table-container">
                <thead>
                    <tr class="table-header">
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Password</th>
                        <th>DOB</th>
                        <th>City</th>
                        <th>State</th>
                    </tr>
                </thead>
                <tbody id="userTableBody">
                    <?php
                    require "config.php"; // Include database connection

                    // Fetch all users
                    $sql = "SELECT id, firstName, lastName, email, phoneNumber, DOB, city, state FROM users ORDER BY id DESC";
                    $result = $conn->query($sql);

                    // Check if query execution was successful
                    if ($result === false) {
                        echo "<tr><td colspan='9'>Query failed: " . $conn->error . "</td></tr>";
                        exit; // Stop further execution
                    }

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                <td>{$row['id']}</td>
                                <td>{$row['firstName']}</td>
                                <td>{$row['lastName']}</td>
                                <td>{$row['email']}</td>
                                <td>{$row['phoneNumber']}</td>
                                <td>********</td> <!-- Masked password -->
                                <td>{$row['DOB']}</td>
                                <td>{$row['city']}</td>
                                <td>{$row['state']}</td>
                            </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='9'>No records found</td></tr>";
                    }

                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="Script.js"></script>
</body>
</html>
