<?php
require_once 'User.php';
require_once 'Job.php';

class Admin extends User
{
    protected $table_name = "admin";

    public function addAlumni($alumniData)
    {
        // Check if required fields are set
        if (!isset($alumniData['username'], $alumniData['email'], $alumniData['password'])) {
            throw new Exception("All fields are required.");
        }

        // Sanitize input data
        $username = htmlspecialchars(strip_tags($alumniData['username']));
        $email = htmlspecialchars(strip_tags($alumniData['email']));
        $password = htmlspecialchars(strip_tags($alumniData['password']));

        // Validate email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Invalid email format.");
        }

        // Hash the password
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);

        // Insert into database
        $query = "INSERT INTO " . $this->table_name . " (username, email, password) VALUES (:username, :email, :password)";
        $stmt = $this->conn->prepare($query);

        // Bind values
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":password", $passwordHash);

        if ($stmt->execute()) {
            return true;
        } else {
            throw new Exception("Unable to add alumni.");
        }
    }

    public function viewAlumni()
    {
        // Fetch alumni data from the database
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateAlumni($alumniId, $alumniData)
    {
        // Implementation for updating alumni
    }

    public function deleteAlumni($alumniId)
    {
        // Implementation for deleting alumni
    }

    public function postJob($jobData)
    {
        $job = new Job($this->conn);
        return $job->createJob($jobData);
    }

    public function getJobs() {
        $job = new Job($this->conn);
        return $job->getJobs();
    }
}
?>