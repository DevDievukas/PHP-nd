<?php
require "header.php";
?>
<link rel="stylesheet" href="../styles/signup.css">

    <main>
        <div class="signup-div">
            <section>
                <h1>Login in</h1>
                <?php 
                    if(isset($_GET['error'])){
                        if($_GET['error'] == "emptyfields"){
                            echo '<p>Fill in all fields!</p>';
                        }
                        else if($_GET['error'] == "invalidmailuid"){
                            print_r("error");
                        }
                    }if(isset($_GET['signup'])){
                        if($_GET['signup'] == 'success'){
                            echo '<h3>Sign up success!</h3>';
                        }
                    }
                ?>
                <form action="../includes/login.inc.php" method="post">
                    <input type="text" name="user_name" placeholder="Username">
                    <input type="password" name="pwd" placeholder="Password">
                    <button type="submit" name="login-submit">Login</button>
                </form>
            </section>
        </div>
    </main>

<?php
    require "footer.php";
?>