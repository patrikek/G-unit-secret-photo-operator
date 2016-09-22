<?php
require_once 'include/init.php';

$store = new Store();
$review = new Review();
$profile = new Profile();
$id = $store->data()->id;
?>




<div id="stores">
    <?php
    $profile->showStores();
    ?>
</div>
<div id="storeinfo">
    <h1><?php echo escape($profile->data($id, 'header')); ?></h1>
    <div id="profilepic" class="ontop">
    </div>
    <div id="storetext">
        <?php  echo '<p>' . escape($profile->data($id, 'description')) . '</p>' ?>
    </div>
    <div id="services">
        <h2>Tjänster</h2>
        Punktering: 100kr<br>
        Full Service: 500kr
    </div>
    <div id="reviews">
        <h2>Omdömen</h2>
        <?php
        $review->showPost($id);
        ?>
    </div>
</div>