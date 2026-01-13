<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table{
            border-collapse:collapse;
            width: 100%;
            color:#588c7e;
            font-family:monospace;
            font-size:25px;
            text-align:left;
        }
        th{
    background-color: #d96459;
    color: white;
         }
         tr:nth-child(even){
                   background-color: #f2f2f2;
}
    </style>
</head>
<body>
    <table>
        <tr>
            <th>fullname</th>
            <th>mothername</th>
            <th>mobilenumber</th>
        </tr>
        <?php 
          $conn = new mysqli('localhost', 'root', '', 'buspasssystem');
          if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
          }
          $sql = "SELECT fullname, mothername, mobilenumber FROM register";
          $result = $conn->query($sql);
          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>".$row["fullname"]."</td><td>".$row["mothername"]."</td><td>".$row["mobilenumber"]."</td></tr>";
            }
          } else {
            echo "<tr><td colspan='3'>0 results</td></tr>";
          }
          $conn->close();
        ?> 
    </table>
</body>
</html>
