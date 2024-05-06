<?php
include_once 'classes/class.user.php';
$user = new User();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["donate"])) {
    $amount = $_POST["amount"];

    // Make a donation using the User class method
    $donationId = $user->make_donation($amount);

    if ($donationId !== false) {
        // Insert a record into the donation history table
        $status = 'Success';
        $message = 'Thank you for your donation!';
        $user->insert_donation_history($donationId, $status, $message);
        
        echo '<div style="color: green;">' . $message . '</div>';
    } else {
        $status = 'Failed';
        $message = 'Failed to process donation. Please try again.';
        $user->insert_donation_history(null, $status, $message);
        
        echo '<div style="color: red;">' . $message . '</div>';
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donation Program</title>
    <link rel="stylesheet" href="css/donations.css?<?php echo time(); ?>">
    <style>
        .body.donation-page {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        
.body.donation-page h2 {
    color: #333;
    text-align: center;
}

.body.donation-page form {
    text-align: center;
}

/* Other styles for form elements */

.body.donation-page p {
    text-align: center;
    margin-top: 20px;
    font-size: 18px;
    color: #333;
}

.body.donation-page table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

/* Other styles for table */

.body.donation-page th, .body.donation-page td {
    border: 1px solid #ddd;
    padding: 12px;
    text-align: left;
}

.body.donation-page th {
    background-color: #4CAF50;
    color: #fff;
}

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #4CAF50;
            color: #fff;
        }
    </style>
</head>
<body class="donation-page">
    <div id="donations-page">
        <h2>Donation Program</h2>
        <form method="post">
            <label for="amount">Enter donation amount:</label>
            <input type="text" name="amount" required>
            <button type="submit" name="donate">Donate</button>
        </form>

        <?php
            // Display total donated amount
            $totalAmount = $user->get_total_donated_amount();
            if ($totalAmount !== false) {
                echo '<p>Total Donated Amount: $' . number_format($totalAmount, 2) . '</p>';
            }

            // Display donation history table
            $history = $user->get_donation_history();
            if ($history) {
                echo '<table>';
                echo '<tr><th>Donation Date</th><th>Status</th><th>Message</th></tr>';
                foreach ($history as $record) {
                    echo '<tr>';
                    echo '<td>' . $record['donation_date'] . '</td>';
                    echo '<td>' . $record['status'] . '</td>';
                    echo '<td>' . $record['message'] . '</td>';
                    echo '</tr>';
                }
                echo '</table>';
            } else {
                echo '<p>No donation history available.</p>';
            }
        ?>
    </div>
</body>
</html>

