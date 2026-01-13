<?php
//  database connection
$conn = new mysqli('localhost', 'root', '', 'buspasssystem');

// Check 
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = isset($_GET['id']) ? $_GET['id'] : '';
if ($id === '') {
    die("Error: ID parameter is missing in the URL.");
}

//  retrieve the user data
$stmt = $conn->prepare("SELECT * FROM register WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    die("Error: User with ID $id not found.");
}

$stmt->close();
$conn->close();

//  HTML format
$html = "
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Bus Pass</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: -webkit-linear-gradient(top, #8bc0df 39%, #e9e9e9 70%);
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        .pass-details {
            border: 1px solid #ccc;
            padding: 20px;
            margin-bottom: 20px;
            background-color: #fff;
        }
        .pass-details table {
            width: 100%;
            border-collapse: collapse;
        }
        .pass-details th,
        .pass-details td {
            padding: 10px;
            border-bottom: 1px solid #ccc;
        }
        .pass-details th {
            text-align: left;
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class='container'>
        <h1>Bus Pass</h1>
        <div class='pass-details'>
            <table>
                <tr>
                    <th style='background-color: #f2f2f2;'>Customer</th>
                    <td>{$user['fullname']}</td>
                </tr>
                <tr>
                    <th style='background-color: #f2f2f2;'>Address</th>
                    <td>{$user['address']}</td>
                </tr>
                <tr>
                    <th style='background-color: #f2f2f2;'>City</th>
                    <td>{$user['district']}</td>
                </tr>
                <tr>
                    <th style='background-color: #f2f2f2;'>Pass Number</th>
                    <td>{$user['id']}</td>
                </tr>
                <tr>
                    <th style='background-color: #f2f2f2;'>Pass Date</th>
                    <td>".date('Y-m-d')."</td>
                </tr>
                <tr>
                    <th style='background-color: #f2f2f2;'>Full Name</th>
                    <td>{$user['fullname']}</td>
                </tr>
                <tr>
                    <th style='background-color: #f2f2f2;'>ID Number</th>
                    <td>{$user['idnumber']}</td>
                </tr>
                <tr>
                    <th style='background-color: #f2f2f2;'>Issued Date</th>
                    <td>{$user['issueddate']}</td>
                </tr>
                <tr>
                    <th style='background-color: #f2f2f2;'>Expiry Date</th>
                    <td>{$user['expirydate']}</td>
                </tr>
                <tr>
                    <th style='background-color: #f2f2f2;'>From Location</th>
                    <td>{$user['from_location']}</td>
                </tr>
                <tr>
                    <th style='background-color: #f2f2f2;'>To Location</th>
                    <td>{$user['to_location']}</td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>
";

header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=bus_pass.html");


echo $html;
?>
