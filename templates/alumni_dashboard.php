<?php
require_once 'config.php';
require_once 'classes/Alumni.php';

$database = new Database();
$db = $database->getConnection();

$alumni = new Alumni($db);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['apply_job'])) {
    $alumni->applyJob($_POST['job_id']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Alumni Dashboard</title>
</head>
<body>
    <h1>Alumni Dashboard</h1>
    <h2>Available Jobs</h2>
    <ul>
        <?php
        $jobs = $alumni->viewJobs();
        foreach ($jobs as $job) {
            echo "<li>{$job['title']} - <form method='post'><button type='submit' name='apply_job' value='{$job['id']}'>Apply</button></form></li>";
        }
        ?>
    </ul>
</body>
</html>
