<?php
include 'db_connection.php';  // No need for 'includes/' since it's in the same directory

// Query to get all cases from the 'company' table
$sql = "SELECT * FROM company";  
$result = $conn->query($sql);  // Execute the query
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loan Recovery Cases</title>
    <link rel="stylesheet" href="css/style.css">  <!-- Link to the CSS -->
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .container {
            width: 80%;
            margin: 0 auto;
            padding-top: 30px;
            text-align: center;
        }

        h1 {
            color: #4CAF50;
            font-size: 36px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th, table td {
            padding: 12px 15px;
            text-align: center;
            border: 1px solid #ddd;
        }

        table th {
            background-color: #4CAF50;
            color: white;
        }

        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        table tr:hover {
            background-color: #ddd;
        }

        .btn {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            margin-top: 20px;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
        }

        .btn:hover {
            background-color: #45a049;
        }

        .action-buttons {
            display: flex;
            justify-content: space-around;
        }

        .action-buttons button {
            padding: 10px 20px;
            background-color: #f9a825;
            border: none;
            color: white;
            font-size: 14px;
            cursor: pointer;
            border-radius: 5px;
        }

        .action-buttons button:hover {
            background-color: #f57f17;
        }

        .send-buttons {
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1><u><b>LEGAL STATUS SYSTEM</b></u></h1>
        <a href="insert_case.php" class="btn">Insert New Case</a>
        <table>
            <thead>
                <tr>
                    <th>Company Name</th>
                    <th>Loan Amount</th>
                    <th>Defaulted On</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    // Fetch and display each case
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['company_name'] . "</td>";
                        echo "<td>" . $row['loan_amount'] . "</td>";
                        echo "<td>" . $row['defaulted_on'] . "</td>";
                        echo "<td>" . $row['status'] . "</td>";
                        echo "<td>";

                        if($row['status'] == 'Pending') {
                            echo '<div class="action-buttons">
                                    <button onclick="sendToLawyer()">Send to Lawyer</button>
                                    <button onclick="sendToCourt()">Send to Court</button>
                                  </div>';
                        }
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No cases found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script>
        function sendToLawyer() {
            alert('Case has been sent to the lawyer!');
        }

        function sendToCourt() {
            alert('Case has been sent to the court!');
        }
    </script>
</body>
</html>

<?php $conn->close(); ?>  <!-- Close the database connection -->
