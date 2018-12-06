<?php
// Start the session
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
        }

        .header {
            padding: 2px;
            text-align: center;
            background: #ce1023;
            color: white;
            font-size: 15px;
        }


        .topnav {
            position: relative;
            overflow: hidden;
            background-color: #333;
        }

        .topnav a {
            float: left;
            color: #f2f2f2;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            font-size: 17px;
        }

        .topnav a:hover {
            background-color: #ddd;
            color: black;
        }

        .topnav a.active {
            background-color: #ce1023;
            color: white;
        }

        .topnav-centered a {
            float: none;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .topnav-right {
            float: right;
        }

        @media screen and (max-width: 600px) {
            .topnav a, .topnav-right {
                float: none;
                display: block;
            }

            .topnav-centered a {
                position: relative;
                top: 0;
                left: 0;
                transform: none;
            }
        }

        .registerbtn {
            background-color: #ce1023;
            color: white;
            padding: 16px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 15%;
            opacity: 0.9;
        }

        .registerbtn:hover {
            opacity: 1;
        }

        .loginbtn {
            background-color: #ce1023;
            color: white;
            padding: 16px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 15%;
            opacity: 0.9;
        }

        .loginbtn:hover {
            opacity: 1;
        }

    </style>
</head>
<body>

<div class="header">
    <h1>Clothing Designer DB</h1>
</div>

<title>Clothing Designer</title>


<!-- Top navigation -->
<div class="topnav">

    <!-- Left-aligned links (default) -->
    <a href="index.php" class="active">Home</a>
    <a href="store.php">Stores</a>
    <a href="customer.php">Customers</a>
    <a href="product.php">Products</a>
    <a href="top.php">Tops</a>
    <a href="bottom.php">Bottoms</a>
    <a href="shoe.php">Shoes</a>
    <a href="transactions.php">Transactions</a>
    <a href="cart.php">Cart</a>

</div>

</div>

<div style="padding-left:16px">
    <?php 
        if (isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] == 1) {
            $id = $_SESSION["customerID"];
            echo "<h2>Logged in as Customer $id</h2>";
            echo '<br></br>';
            echo '<a href="logout.php" class="registerbtn">Logout</a>';   
        } 

        else{
            echo "<div style='padding-left:16px; padding-right: 16px; padding-bottom: 16px'><h2>Login or register to proceed</h2></div>";
            echo '<a href="login.php" class="loginbtn">Login</a>';
            echo '<a>  </a>';
            echo '<a href="register.php" class="registerbtn">Register</a>';
        } 
    ?>
    
</div>

</body>
</html>
