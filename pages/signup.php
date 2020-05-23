<?php
require "header.php";
?>
<link rel="stylesheet" href="../styles/signup.css">

    <main>
        <div class="signup-div">
            <section>
                <h1>Sign up</h1>
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
                <form action="../includes/signup.inc.php" method="post">
                    <input type="text" name="company_name" placeholder="Company name">
                    <input type="text" name="user_name" placeholder="Username">
                    <input type="text" name="email" placeholder="E-mail">
                    <input type="password" name="pwd" placeholder="Password">
                    <input type="password" name="pwd-repeat" placeholder="Repeat password">
                    <button type="submit" name="signup-submit">Signup</button>
                </form>
            </section>
        </div>
    </main>

<?php
    require "footer.php";
?>