<?php

$store = new Store();
?>
<footer>
    &copy;Cykelreparationer
    <div id="botnav">
        <ul>
            <?php
            if (!$store->isLoggedIn())
            {
                ?>
                <li><a href="login.php">Logga in</a></li>
                <li><a href="register.php">Registrera butik</a></li>
            <?php
            }
            ?>
            <?php
            if ($store->isLoggedIn()) {
                ?>
                <li><a href="profile.php">Min profil</a></li>
                <li><a  href="editprofile.php">Redigera profil</a> </li>
                <li><a href="logout_process.php">Logga ut</a></li>
            <?php
            }
            ?>
        </ul>
    </div>
</footer>