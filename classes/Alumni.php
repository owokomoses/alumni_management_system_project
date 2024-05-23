<?php
require_once 'User.php';

class Alumni extends User {
    protected $table_name = "alumni";

    public function createProfile($profileData) {
        // Implementation for creating profile
    }

    public function viewJobs() {
        // Implementation for viewing jobs
    }

    public function applyJob($jobId) {
        // Implementation for applying to a job
    }
}
?>
