<?php
include 'db_connection.php';  // No need for 'includes/' since it's in the same directory

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $company_name = $_POST['company_name'];
    $loan_amount = $_POST['loan_amount'];
    $defaulted_on = $_POST['defaulted_on'];
    $status = $_POST['status'];

    // Prepare and bind the insert query
    $stmt = $conn->prepare("INSERT INTO company (company_name, loan_amount, defaulted_on, status) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $company_name, $loan_amount, $defaulted_on, $status);

    // Execute the query
    if ($stmt->execute()) {
        echo "<script>alert('Case successfully inserted!'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Error inserting case: " . $stmt->error . "');</script>";
    }

    $stmt->close();  // Close the statement
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Loan Case</title>
    <link rel="stylesheet" href="css/style.css">  <!-- Link to the CSS -->
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .container {
            width: 100%;
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #4CAF50;
            text-align: center;
            font-size: 32px;
            margin-bottom: 30px;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        label {
            font-size: 16px;
            font-weight: bold;
            color: #555;
        }

        input, select {
            padding: 12px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 5px;
            outline: none;
            width: 100%;
            box-sizing: border-box;
        }

        input:focus, select:focus {
            border-color: #4CAF50;
        }

        button {
            padding: 14px 20px;
            font-size: 18px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #45a049;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group input, .form-group select {
            width: 100%;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Insert New Loan Case</h1>
        <form action="insert_case.php" method="POST">
            <div class="form-group">
                <label for="company_name">Company Name:</label>
                <input type="text" id="company_name" name="company_name" required>
            </div>

            <div class="form-group">
                <label for="loan_amount">Loan Amount:</label>
                <input type="number" id="loan_amount" name="loan_amount" required>
            </div>

            <div class="form-group">
                <label for="defaulted_on">Defaulted On (Date):</label>
                <input type="date" id="defaulted_on" name="defaulted_on" required>
            </div>

            <div class="form-group">
                <label for="status">Status:</label>
                <select id="status" name="status" required>
                    <option value="Pending">Pending</option>
                    <option value="Resolved">Resolved</option>
                </select>
            </div>

            <button type="submit">Submit Case</button>
        </form>
    </div>

</body>
</html>

<?php $conn->close(); ?>  <!-- Close the database connection -->
