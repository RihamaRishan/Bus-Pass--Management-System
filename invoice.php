<?php
// Establish database connection
$conn = new mysqli('localhost', 'root', '', 'buspasssystem');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = isset($_GET['id']) ? $_GET['id'] : '';
if ($id === '') {
    die("Error: ID parameter is missing in the URL.");
}

// Prepare the statement to retrieve the user data
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
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pass</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        @media print{
            .btn{
                display: none;
            }
        }
    </style>
    <script>
        function GetPrint() {
            window.print();
        }

        function DownloadPass() {
            window.location.href = 'downloadpass.php?id=<?php echo $id; ?>';
        }
    </script>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header text-center">
                <h4>VIEW PASS</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-8">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Customer</span>
                            <input type="text" class="form-control" placeholder="Customer" aria-label="Customer" aria-describedby="basic-addon1" name="Customer" value="<?php echo $user['fullname']; ?>" readonly>
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Address</span>
                            <input type="text" class="form-control" placeholder="Address" aria-label="Address" aria-describedby="basic-addon1" name="Address" value="<?php echo $user['address']; ?>" readonly>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">City</span>
                            <input type="text" class="form-control" placeholder="City" aria-label="City" aria-describedby="basic-addon1" name="City" value="<?php echo $user['district']; ?>" readonly>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Pass.No</span>
                            <input type="text" class="form-control" placeholder="Invo.No" aria-label="Invoice No" aria-describedby="basic-addon1" name="Invo.No" value="<?php echo $user['id']; ?>" readonly>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Pass.date</span>
                            <input type="date" class="form-control" placeholder="Invoice Date" aria-label="Invoice Date" aria-describedby="Invoice Date" name="Invo.date" value="<?php echo date('Y-m-d'); ?>" readonly>
                        </div>
                    </div>
                </div>

                <table class="table table-border">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Full Name</th>
                            <th scope="col">ID Number</th>
                            <th scope="col">Issued Date</th>
                            <th scope="col">Expiry Date</th>
                            <th scope="col">From Location</th>
                            <th scope="col">To Location</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td><input type="text" class="form-control" value="<?php echo $user['fullname']; ?>" readonly></td>
                            <td><input type="number" class="form-control text-end" value="<?php echo $user['idnumber']; ?>" readonly></td>
                            <td><input type="date" class="form-control text-end" value="<?php echo $user['issueddate']; ?>" readonly></td>
                            <td><input type="date" class="form-control text-end" value="<?php echo $user['expirydate']; ?>" readonly></td>
                            <td><input type="text" class="form-control" value="<?php echo $user['from_location']; ?>" readonly></td>
                            <td><input type="text" class="form-control" value="<?php echo $user['to_location']; ?>" readonly></td>
                        </tr>
                    </tbody>
                </table>
                <div class="text-center">
                    <button type="button" class="btn btn-primary" onclick="GetPrint()">Print</button>
                    <button type="button" class="btn btn-success" onclick="DownloadPass()">Download Pass</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
