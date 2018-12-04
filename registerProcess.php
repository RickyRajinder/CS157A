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
        * {
            box-sizing: border-box;
        }

        /* Add padding to containers */
        .container {
            padding: 16px;
            background-color: white;
        }

        /* Full-width input fields */
        input[type=text], input[type=password] {
            width: 100%;
            padding: 15px;
            margin: 5px 0 22px 0;
            display: inline-block;
            border: none;
            background: #f1f1f1;
        }

        input[type=text]:focus, input[type=password]:focus {
            background-color: #ddd;
            outline: none;
        }

        hr {
            border: 1px solid #f1f1f1;
            margin-bottom: 25px;
        }

        .registerbtn {
            background-color: #ce1023;
            color: white;
            padding: 16px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
            opacity: 0.9;
        }

        .registerbtn:hover {
            opacity: 1;
        }

        a {
            color: dodgerblue;
        }

        .signin {
            background-color: #f1f1f1;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="header">
    <h1>Discount Designer DB</h1>
</div>

<title>Discount Designer</title>


<div class="topnav">

    <a href="index.php" class="active">Home</a>
    <a href="store.php">Stores</a>
    <a href="customer.php">Customers</a>
    <a href="product.php">Products</a>
    <a href="top.php">Tops</a>
    <a href="bottom.php">Bottoms</a>
    <a href="shoe.php">Shoes</a>
    <a href="cart.php">Transactions</a>


</div>

</div>


    <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "clothingdatabase";


        $first = $_POST['first'];
        $last = $_POST['last'];
        $email = $_POST['email'];
        $psw = $_POST['psw'];
        $cardNum = $_POST['cardNum'];
        $addr = $_POST['addr'];

        try {
            $conn = new PDO("mysql:host=$servername;port=3306;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $newCustID = mt_rand(100000, 999999); //randomly generate 6-digit
            $stmt = $conn->prepare("INSERT INTO Customer VALUES ($newCustID, '$psw', '$first', '$last', '$addr', '$email', '$cardNum')");
            $stmt->execute();
        }
        catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        echo "<h2>Thank you for registering, $first!</h2>";   
        echo "<br></br>";
        echo '<a href="index.php" class="registerbtn">Back to Home</a>';
    
    ?>
</body>
</html>
