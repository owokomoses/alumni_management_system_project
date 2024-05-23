<?php
class Job {
    private $conn;
    private $table_name = "jobs";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function createJob($jobData) {
        // Implementation for creating a job post
            // Check if required fields are set
            if (!isset($jobData['job_title'], $jobData['location'], $jobData['job_description'])) {
                throw new Exception("All fields are required.");
            }
    
            // Sanitize input data
            $jobTitle = htmlspecialchars(strip_tags($jobData['job_title']));
            $location = htmlspecialchars(strip_tags($jobData['location']));
            $jobDescription = htmlspecialchars(strip_tags($jobData['job_description']));
    
            // Insert into database
            $query = "INSERT INTO " . $this->table_name . " (job_title, location, job_description) VALUES (:job_title, :location, :job_description)";
            $stmt = $this->conn->prepare($query);
    
            // Bind values
            $stmt->bindParam(":job_title", $jobTitle);
            $stmt->bindParam(":location", $location);
            $stmt->bindParam(":job_description", $jobDescription);
    
            if ($stmt->execute()) {
                return true;
            } else {
                throw new Exception("Unable to create job post.");
            }
    }

    public function getJobs() {
        // Implementation for retrieving all job posts
        $query = "SELECT job_title, location, job_description FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteJob($jobId) {
        // Implementation for deleting a job post
    }
}
?>
