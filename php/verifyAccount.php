<?php
    
    if (isset($_POST['submit_verification']) && !empty($_FILES['verification_document']['name'])) {
        $targetDir = "uploads/";
        $documentPath = $targetDir . basename($_FILES['verification_document']['name']);
        
        if (move_uploaded_file($_FILES['verification_document']['tmp_name'], $documentPath)) {
            // Insert the document path into verification_requests table for this user
            // Update the database with the path and set status to 'pending'
            // Redirect back to user profile after submission
            header("Location: userprofile.php?verification_submitted=true");
            exit();
        } else {
            header("Location: userprofile.php?verification_error=true");
            exit();
        }
    }
?>