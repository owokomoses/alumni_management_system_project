<?php
require_once '../config.php';
require_once '../classes/Admin.php';

$database = new Database();
$db = $database->getConnection();

$admin = new Admin($db);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add_alumni'])) {
        try {
            $admin->addAlumni($_POST);
            echo "Alumni added successfully.";
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    } elseif (isset($_POST['post_job'])) {
        $admin->postJob($_POST);
        echo "Job posted successfully.";
    }
}

// Fetch alumni list
$alumniList = $admin->viewAlumni();

// Fetch job posts
$jobList = $admin->getJobs();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
</head>

<body>
    <h1>Admin Dashboard</h1>
    <form method="post">
        <h2>Add Alumni</h2>
        <input type="text" name="username" placeholder="Username" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" name="add_alumni">Add Alumni</button>
    </form>
    <form method="post">
        <h2>Post Job</h2>
        <input type="text" name="job_title" placeholder="Job Title" required>
        <input type="text" name="location" placeholder="location" required>
        <input type="text" name="job_description" placeholder="Job Description" required>
        <button type="submit" name="post_job">Post Job</button>
    </form>

    <!-- Display alumni list -->
    <h2>List of Alumni</h2>
    <table border="1">
        <thead>
            <tr>
                <th>Username</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            foreach ($alumniList as $alumni) {
                echo "<tr>";
                echo "<td>{$alumni['username']}</td>";
                echo "<td>{$alumni['email']}</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
    
        <!-- Display job list -->
        <h2>List of jobs</h2>
    <table border="1">
        <thead>
            <tr>
                <th>Job Title</th>
                <th>Location</th>
                <th>Job Description</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            foreach ($jobList as $job) {
                echo "<tr>";
                echo "<td>{$job['job_title']}</td>";
                echo "<td>{$job['location']}</td>";
                echo "<td>{$job['job_description']}</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</body>

</html>