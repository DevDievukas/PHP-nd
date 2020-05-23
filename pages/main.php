<?php
require "header.php";
?>
<link rel="stylesheet" href="../styles/signup.css">

    <main>
        <div class="signup-div">
            <section>
                <form action="../includes/addWebsite.inc.php" method="post">
                    <input type="text" name="web_adress" placeholder="Website adress">
                    <button type="submit" name="website-submit">Add website</button>
                </form>
                
                <form action="../includes/login.inc.php" method="post">
                    <input type="text" name="web_adress" placeholder="Website adress">
                    <input type="text" name="keyword" placeholder="Keyword">
                    <button type="submit" name="signup-submit">Add web keyword</button>
                </form>
                
                <form action="../includes/login.inc.php" method="post">
                    <input type="text" name="web_adress" placeholder="Department name">
                    <input type="text" name="country" placeholder="Country">
                    <input type="text" name="region" placeholder="Region">
                    <input type="text" name="city" placeholder="City">
                    <input type="text" name="building" placeholder="Building Number">
                    <input type="text" name="office" placeholder="Office Number">
                    <input type="text" name="post_code" placeholder="Postal Code">
                    <button type="submit" name="signup-submit">Add department</button>
                </form>

                
                <form action="../includes/login.inc.php" method="post">
                    <input type="text" name="web_adress" placeholder="Department name">
                    <input type="text" name="dep_keyword" placeholder="Keyword">
                    <button type="submit" name="signup-submit">Add department keyword</button>
                </form>
            </section>
        </div>
    </main>

<?php
    require "footer.php";
?>