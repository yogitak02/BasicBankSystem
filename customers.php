<?php
include "dbconnect.php";
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>View Customers</title>
        <link rel="stylesheet" href="css/customers.css">
        <style media="screen" type="text/css">
            
            nav{
                font-weight: bold;
            }
            
            table{
                position: relative;
                bottom:20px;
            }
            table a button {
                border: none;
                font-weight: bold;
                border-radius: 5px;
                font-size: 15px;
                padding: 5px;
                color: black;
                background-color: lightgreen;
                transition: 0.25s;
            }
            
            table a button:hover {
                color: whitesmoke;
                background-color: rgb(0, 175, 0);
                transform: translate(0, -2px);
                box-shadow: 0 1px 2px black;
            }
           
        </style>
    </head>

    <body>
        <header>
            <h1 style="color:whitesmoke;font-size: 60px">
                Sparks  Bank
            </h1>
            <nav style="font-family: Arial, Helvetica, sans-serif">
            <a href="index.php">Home</a>
            <a href="about.php">About</a>
            <a href="customers.php">View Customers</a>
            <a href="transactionhistory.php">Transaction History</a>
            </nav>
        </header>
        <table class="customers">
            <tr>
                <th>S.no</th>
                <th>Name</th>
                <th>E-Mail</th>
                <th>Current Balance</th>
                <th>&nbsp;</th>
            </tr>
            <?php
         $sql="SELECT * FROM users";
         $res=mysqli_query($conn,$sql);
         while($row=mysqli_fetch_array($res))
        {
             echo "<tr>";
             echo "<td>"; echo $row["id"]; echo "</td>";
             echo "<td>"; echo $row["Name"]; echo "</td>";
             echo "<td>"; echo $row["Email"]; echo "</td>";
             echo "<td>"; echo $row["Balance"]; echo "</td>";
             echo "<td>"; ?><a href="transfer.php? id=<?php echo $row["id"];?>"><button>Transfer</button></a><?php echo "</td>";
             echo "</tr>";
        }
         $conn->close();
        ?>
        </table>
        <footer>
            <p style="color:white"><i>&#169; copyright 2022. Made by Yogita Kulkarni</i></p>
            <p style="color:white"><i>All rights reserved. Powered by<a href="https://www.thesparksfoundationsingapore.org/">The Sparks Foundation</a></i></p>
        </footer>

    </body>