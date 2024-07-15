<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include database connection
include 'database_connection.php';
$showModal = false;

if (isset($_POST['submit_button'])) {

    // Retrieve and sanitize inputs
    function sanitize_input($data) {
        return htmlspecialchars(stripslashes(trim($data)));
    }


    
    $firstname = sanitize_input($_POST['firstname']);
    $lastname = sanitize_input($_POST['lastname']);
    $email = sanitize_input($_POST['email']);
    $phone = sanitize_input($_POST['phone']);
    $messages = sanitize_input($_POST['messages']);

    // Validate inputs
    if (empty($firstname) || empty($lastname) || empty($email) || empty($phone)  || empty($messages)) {
        die("");
    }

    // Validation for phone number
    if (!preg_match('/^[0-9]{10}$/', $phone)) {
        die("");
    }

    // Insert data into the database
    $stmt = $conn->prepare("INSERT INTO message_tb (firstname, lastname, email, phone, messages) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $firstname, $lastname, $email, $phone, $messages);

    if ($stmt->execute()) {
        
        $showModal = true;
        echo '<button><a href="index.html">Go back to the home page</a></button>';   
            
       
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close connection
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <title>Confirmation</title>
</head>
<body>
    <!-- Modal -->
    <div class="modal fade <?php if ($showModal) echo 'show'; ?>" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="<?php if (!$showModal) echo 'true'; ?>">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmationModalLabel">Success</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Record successfully inserted. We have received your contact. We will review it and get in touch soon. Thank you!
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    
    <?php if ($showModal) : ?>
    <script>
        $(document).ready(function() {
            $('#confirmationModal').modal('show');
        });
    </script>
    <?php endif; ?>
</body>
</html>


