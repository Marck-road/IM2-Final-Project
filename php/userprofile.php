<?php

    if ($userVerificationStatus === 'unverified') {
        echo '<form action="verify_account.php" method="post" enctype="multipart/form-data">';
        echo '<input type="file" name="verification_document">';
        echo '<button type="submit" name="submit_verification">Submit for Verification</button>';
        echo '</form>';
    }
?>