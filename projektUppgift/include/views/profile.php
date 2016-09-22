<?php
$store = new Store();
$review = new Review();
$profile = new Profile();
$id = $store->data()->id;
?>

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
    <div id="contact">
        <h2>Kontakt</h2>
        <?php
        $profile->storeContact($id);
        ?>
</div>