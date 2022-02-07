<?php
include 'dbconnect.php';

if(isset($_POST['submit']))
{
    $from = $_GET['id'];
    $to = $_POST['to'];
    $amount = $_POST['amount'];

    $sql = "SELECT * from users where id=$from";
    $query = mysqli_query($conn,$sql);
    $sql1 = mysqli_fetch_array($query); 

    $sql = "SELECT * from users where id=$to";
    $query = mysqli_query($conn,$sql);
    $sql2 = mysqli_fetch_array($query);

    if (($amount)<0)
   {
        echo '<script type="text/javascript">';
        echo ' alert("Oops! Negative values cannot be transferred")';
        echo '</script>';
    }

    else if($amount > $sql1['Balance']) 
    {
        
        echo '<script type="text/javascript">';
        echo ' alert("Ohh! Insufficient Balance")'; 
        echo '</script>';
    }
    
    else if($amount == 0){

         echo "<script type='text/javascript'>";
         echo "alert('Oops! Zero value cannot be transferred')";
         echo "</script>";
     }


    else {
        $newbalance = $sql1['Balance'] - $amount;
        $sql = "UPDATE `users` SET `Balance`=$newbalance where id=$from";
        mysqli_query($conn,$sql);
     

        
        $newbalance = $sql2['Balance'] + $amount;
        $sql = "UPDATE `users` SET `Balance`=$newbalance where id=$to";
        mysqli_query($conn,$sql);
        
        $sender = $sql1['Name'];
        $receiver = $sql2['Name'];
        $sql = "INSERT INTO `transaction` (`Sender`, `Receiver`, `amount`) VALUES ('$sender','$receiver','$amount')";
        $query=mysqli_query($conn,$sql);

        if($query){
             echo "<script> alert('Transaction Successful');
                             window.location='customers.php';
                   </script>";
            
        }

        $newbalance= 0;
        $amount =0;
    
}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Customers</title>
   
    <style media="screen" type="text/css">
        body{
            background-color:gray;
        }

        nav{
                font-weight: bold;
            }

            nav {
                background-color: rgba(46, 43, 43, 0.979);
                display: flex;
                justify-content: space-evenly;
                padding: 5px;
                border-radius: 3px;
                }

                nav a {
                text-decoration: none;
                color: azure;
                padding: 2px 6px 2px 6px;
                border-radius: 2px;
                }

                nav a:hover{
                    background-color:grey;
                        }

        div.transfer{/*get border to main block*/ 
            margin:auto;
            position:relative;
            background-color: lightyellow;
            padding:20px;
            font-family: Arial, sans-serif;
            border-radius:10px;
            box-shadow:0 2px 8px black;
        }
        table { /*element inside rectangle*/
            font-family: arial, sans-serif;
            display: table;
            margin: auto;
            background-color: rgb(250, 252, 251);
            color: whitesmoke;
            border-collapse: collapse;
        }
        h2{
            font-size:30px;
        }

        table th {   /*sno,name*/
            background-color: black;
            color: whitesmoke;
        }

       tr {/*values inside sno,name*/
            color: black;
            font-weight: bold;
        }

       td,
        th {  /*row, and column to sno,*/
            border: 1px solid #b8a6a6;
            text-align: left;
            padding: 8px;
         }
      #receiver{ /*choose border*/
            text-align:center;
            height:22px;
            padding:1px 2px;
            border:2px;
        }
        #amount{  /* border after selecting prize*/
            border:2px;
        }
       button{  /* transfer button*/
            position:relative;
            left:50px;
            bottom:10px;
            border:none;
            padding:10px;
            color:black;
            font-weight: bold;
            border-radius:5px;
            background-color:skyblue;
            font-family:Arial, Helvetica, sans-serif;
            transition: 0.25s;
        }
        button:hover{
            color:whitesmoke;
            background-color: blue;
            transform: translate(0, -3px);
            box-shadow: 0 2px 6px black;
        }
       footer{
            padding:100px;
        }

        div.container{
            text-align:center;
        }
        

    </style>
</head>

<body>
    <header>
        <h1 style="color:whitesmoke;font-size: 60px; text-align:center">
            Sparks  Bank</a>
        </h1>
        <nav style="font-family: Arial, Helvetica, sans-serif">
            <a  href="index.php">Home</a>
            <a  href="About.html">About</a>
            <a  href="view_customers.php">View Customers</a>
            <a  href="transactionhistory.php">Transaction History</a>
        </nav>
    </header>
	<div class="transfer">
        <h2 style="text-align:center">Transfer Money</h2>
            <?php
                include 'dbconnect.php';
                $sid=$_GET['id'];
                $sql = "SELECT * FROM  users where id=$sid";
                $result=mysqli_query($conn,$sql);
                if(!$result)
                {
                    echo "Error : ".$sql."<br>".mysqli_error($conn);
                }
                $rows=mysqli_fetch_assoc($result);
            ?>
            <form method="post" name="tcredit"><br>
        <div>
            <table>
                <tr>
                    <th>S.no</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Current Balance</th>
                </tr>
                <tr>
                    <td><?php echo $rows['id'] ?></td>
                    <td><?php echo $rows['Name'] ?></td>
                    <td><?php echo $rows['Email'] ?></td>
                    <td><?php echo $rows['Balance'] ?></td>
                </tr>
            </table>
        </div>
        <br><br><br>

        <div class="container">
        <label for="receiver" style="font-weight:bold">Transfer To:</label>
        <select id="receiver" name="to" required>
        </div>

            <option value="" disabled selected>Choose</option>
            <?php
                include 'dbconnect.php';
                $sid=$_GET['id'];
                $sql = "SELECT * FROM users where id!=$sid";
                $result=mysqli_query($conn,$sql);
                if(!$result)
                {
                    echo "Error ".$sql."<br>".mysqli_error($conn);
                }
                while($rows = mysqli_fetch_assoc($result)) {
            ?>
                <option value="<?php echo $rows['id'];?>" >
                
                    <?php echo $rows['Name'] ;?> 
                    (Balance: <?php echo $rows['Balance'] ;?> ) 
                    
               
                </option>
            <?php 
            } 
            ?>
        </select>
        <br>
        <br>
        <div class="container">
            <label style="font-weight:bold" for="amount">Amount in &#x20B9;:</label>
            <input id="amount" type="number" name="amount" required><br><br><br>
        </div>
        <button name="submit" type="submit">Transfer</button>
        </form>
            </div>
    <div class="footer">
            <p style="color:black"><i>&#169; copyright 2022. Made by Yogita Kulkarni</i></p>
            <p style="color:black"><i>All rights reserved. Powered by<a href="https://www.thesparksfoundationsingapore.org/">The Sparks Foundation</a></i></p>
            </div>
</body>