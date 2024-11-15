<?php
session_start();


$mysqli = require __DIR__ . "/database.php";


if (isset($_SESSION["user_id"])) {
    
    $sql = "SELECT * FROM user WHERE id = {$_SESSION["user_id"]}";
    $result = $mysqli->query($sql);

    if ($result) {
        $user = $result->fetch_assoc();
        $authenticated = true;
    } else {
        
        $authenticated = false;
        
        header("Location: contact.php?error=true");
        exit();
    }
} else {
    
    $authenticated = false;
}


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    if (isset($_POST["name"], $_POST["email"], $_POST["phone"], $_POST["message"])) {
        
        $name = mysqli_real_escape_string($mysqli, $_POST["name"]);
        $email = mysqli_real_escape_string($mysqli, $_POST["email"]);
        $phone = mysqli_real_escape_string($mysqli, $_POST["phone"]);
        $message = mysqli_real_escape_string($mysqli, $_POST["message"]);

        
        $sql = "INSERT INTO contact (name, email, phone, message) VALUES ('$name', '$email', '$phone', '$message')";
        $result = $mysqli->query($sql);

        if ($result) {
            
            header("Location: contact.php?success=true");
            exit();
        } else {
            
            header("Location: contact.php?error=true");
            exit();
        }
    } else {
        
        header("Location: contact.php?error=true");
        exit();
    }
}


$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fashion</title>
    <link rel="shortcut icon" type="image" href="./image/logo2.png">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <!-- bootstrap links -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- bootstrap links -->
    <!-- fonts links -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
    <!-- fonts links -->
</head>
<body>

<?php include 'header.php'?>

        <!-- navbar -->
        <nav class="navbar navbar-expand-lg" id="navbar">
            <div class="container-fluid">
              <a class="navbar-brand" href="#"><img src="./image/logo.png" alt="" width="180px"></a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span><i class="fa-solid fa-bars" style="color: white;"></i></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="clothes.php">Clothes</a>
                  </li>
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      Category
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown" style="background-color: #1c1c50;">
                      <li><a class="dropdown-item" href="#">T-Shirt</a></li>
                      <li><a class="dropdown-item" href="#">Hoodies</a></li>
                      <li><a class="dropdown-item" href="#">Pants</a></li>
                      <li><a class="dropdown-item" href="#">Sports Shoes</a></li>
                      <li><a class="dropdown-item" href="#">Smart Watch</a></li>
                      <li><a class="dropdown-item" href="#">Glasses</a></li>
                    </ul>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="about.php">About Us</a>
                  </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.php">Contact Us</a>
                  </li>
                </ul>
               
                <form class="d-flex">
                  <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                  <button class="btn btn-outline-success" type="submit" id="search-btn">Search</button>
                </form>
              </div>
            </div>
          </nav>
        <!-- navbar -->

        <!-- contact -->
        <div class="container" id="contact">
            <h1 class="text-center">CONTACT US</h1>
            <div class="row" style="margin-top: 50px;">
                <div class="col-md-4 py-3 py-md-0">
                    <div class="card">
                        <i class="fas fa-phone"> Phone</i>
                        <h6>+919898989898</h6>
                    </div>
                </div>
                <div class="col-md-4 py-3 py-md-0">
                    <div class="card">
                        <i class="fa-solid fa-envelope"> Email</i>
                        <h6>ftd10622445@dseu.ac.in</h6>
                    </div>
                </div>
                <div class="col-md-4 py-3 py-md-0">
                    <div class="card">
                        <i class="fa-solid fa-location-dot"> Address</i>
                        <h6>Block C, Lajpat Nagar, New Delhi 110024</h6>
                    </div>
                </div>
            </div>

            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <div class="row" style="margin-top: 30px;">
                <div class="col-md-4 py-3 py-md-0">
                    <input type="text" class="form-control" name="name" placeholder="Name">
                    </div>
                    <div class="col-md-4 py-3 py-md-0">
                        <input type="text" class="form-control" name="email" placeholder="Email">
                        </div>
                        <div class="col-md-4 py-3 py-md-0">
                            <input type="number" class="form-control" name="phone" placeholder="Phone">
                        </div>
                        <div class="form-group" style="margin-top: 30px;">
                        <textarea class="form-control" id=""rows="5" name="message" placeholder="Message"></textarea>
                    </div>
                <div id="messagebtn" class="text-center">
                    <button type="submit" name="submit">Submit</button>
                </div>
            </div>

            </form>
            
            </div>
        
            <?php

            include 'footer.php'
            
            ?>            

<a href="#" class="arrow"><i><img src="./image/up-arrow.png" alt="" width="50px"></i></a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>