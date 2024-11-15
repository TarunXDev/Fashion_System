<div class="top-navbar">
        <div class="top-icons">
            <i class="fa-brands fa-twitter"></i>
            <i class="fa-brands fa-facebook-f"></i>
            <i class="fa-brands fa-instagram"></i>
        </div>
        
        <?php if ($authenticated): ?>
                <!-- If authenticated, show user-related links -->
                <div>
                        
                <img src="<?php echo $profile['profile_pic']; ?>" class = "user-pic" onclick="toggleMenu()">

                <div class="sub-menu-wrap" id="subMenu">
                    <div class="sub-menu">
                        <div class="user-info">
                        <img src="<?php echo $profile['profile_pic']; ?>">
                        <h4><?php echo $user['name']; ?></h4>
                        </div>
                        <hr>

                        <a href="profile.php" class="sub-menu-link">
                            <img src="image/profile.png" >
                            <p>Edit Profile</p>
                            <span>></span>
                        </a>

                        <a href="#" class="sub-menu-link">
                            <img src="image/help.png" >
                            <p>Help & support</p>
                            <span>></span>
                        </a>

                        <a href="logout.php" class="sub-menu-link">
                            <img src="image/logout.png" >
                            <p>Logout</p>
                            <span>></span>
                        </a>

                    </div>
                </div>
                <i class="fa-solid fa-cart-shopping"></i>

        </div>
                
                
            <?php else: ?>
                <!-- If not authenticated, show login and sign up buttons -->
                <div class="other-links">
                
                <button id="btn-login"><a href="login.php">Login</a></button>
                <button id="btn-signup"><a href="signup.php">Sign up</a></button>
                <i class="fa-solid fa-user"><a href=""></a></i>
                <i class="fa-solid fa-cart-shopping"></i>
                </div>
            <?php endif; ?>
    </div>

<script>
    let subMenu = document.getElementById("subMenu");

    function toggleMenu(){
        subMenu.classList.toggle("open-menu");
    }
</script>


