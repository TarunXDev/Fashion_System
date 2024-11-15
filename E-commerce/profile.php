<?php
session_start();

$mysqli = require __DIR__ . "/database.php";

if (isset($_SESSION["user_id"])) {
  // If logged in, fetch user data and set authenticated flag
  $sql = "SELECT * FROM user WHERE id = {$_SESSION["user_id"]}";
  $result = $mysqli->query($sql);
  $user = $result->fetch_assoc();
  $authenticated = true;
} else {
  // If not logged in, set authenticated flag to false
  $authenticated = false;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Validate and sanitize user inputs
    $username = isset($_POST["username"]) ? mysqli_real_escape_string($mysqli, $_POST["username"]) : "";
    $address = isset($_POST["address"]) ? mysqli_real_escape_string($mysqli, $_POST["address"]) : "";
    $phone = isset($_POST["phone"]) ? mysqli_real_escape_string($mysqli, $_POST["phone"]) : "";
    $profile_pic = "";

    // Handle file upload
    $file_name = $_FILES['profile_pic']['username'];
    $temp_name = $_FILES['profile_pic']['username'];
    $folder = "C:\xampp\htdocs\WEBSITE\final_fashion\upload".$file_name;

    
    
    // Insert or update profile data
    $sql = "INSERT INTO profile (user_id, username, address, phone, profile_pic) VALUES (?, ?, ?, ?, ?)
            ON DUPLICATE KEY UPDATE username = VALUES(username), address = VALUES(address), phone = VALUES(phone), profile_pic = VALUES(profile_pic)";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("issss", $_SESSION["user_id"], $username, $address, $phone, $profile_pic);

    if ($stmt->execute()) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error updating user profile information.";
    }

    $stmt->close();
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

<?php include'header.php' ?>

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
                      <li><a class="dropdown-item" href="#">Soprts Shoes</a></li>
                      <li><a class="dropdown-item" href="#">Smart Watch</a></li>
                      <li><a class="dropdown-item" href="#">Glasess</a></li>
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
        
    <h3>Welcome, <?php echo $user["name"]; ?></h3>

    
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="profile">
        <div>
        <label for="name">Name:</label>
        <input type="text" id="username" name="username" ><br>
        </div>

        <div>
        <label for="address">Address:</label>
        <input type="text" id="address" name="address" ><br>
        </div>

        
        <div>
        <label for="number">Phone Number:</label>
        <input type="text" id="phone" name="phone" ><br>
        </div>

        <div >
        <label for="profile_pic">Profile Picture:</label>
        <input type="file" id="profile_pic" name="profile_pic"><br>
        </div>
        
        <button  class = "probtn" id="submit">Update</button>

        </div>

        
        
    </form>

    <?php

include 'footer.php'

?>

<a href="#" class="arrow"><i><img src="./image/up-arrow.png" alt="" width="50px"></i></a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>
