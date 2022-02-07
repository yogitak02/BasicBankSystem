<?php
include 'dbconnect.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sparks Foundation Bank</title>
    <link rel="stylesheet" href="css/transactionhistory.css">
    <style media="screen" type="text/css">
        body{
            background: linear-gradient(to bottom left, red, blue);
        }
        footer{
            padding:10px;
        }
        th {
            text-align: center;
        }
        td,th{
            text-align: center;
        }
        nav{
            font-weight: bold;
        }
    </style>
</head>

<body>
    <header>
        <h1 style="color:whitesmoke;font-size: 60px">
            Sparks  Bank</a>
        </h1>
        <nav style="font-family: Arial, Helvetica, sans-serif">
            <a  href="index.php">Home</a>
            <a  href="About.html">About</a>
            <a  href="customers.php">View Customers</a>
            <a  href="transactionhistory.php">Transaction History</a>
        </nav>
    </header>
    <table class="transaction">
        <tr>
            <th>Sender</th>
            <th>Receiver</th>
            <th>Amount Transfered</th>
            <th>Date and Time (yy/mm/dd and hr/min/sec)</th>
        </tr>
        <?php
         $res=mysqli_query($conn,"select * from transaction");
         while($row=mysqli_fetch_array($res))
        {
            echo "<tr>";
            echo "<td>"; echo $row['Sender']; echo "</td>";
            echo "<td>"; echo $row['Receiver']; echo "</td>";
            echo "<td>"; echo $row['Amount']; echo "</td>";
            echo "<td>"; echo $row['datetime']; echo "</td>";
            
            echo "</tr>";
        }
        ?>
     </table>
     <footer class="footer">
            <p style="color:white"><i>&#169; copyright 2022. Made by Yogita Kulkarni</i></p>
            <p style="color:white"><i>All rights reserved. Powered by<a href="https://www.thesparksfoundationsingapore.org/">The Sparks Foundation</a></i></p>
    </footer>
</body>