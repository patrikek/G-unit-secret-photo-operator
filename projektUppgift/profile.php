<?php
include 'include/overall/header.php';?>
    <br>
    <div id="mystore">
<?php
$store = new Store();
$review = new Review();
$profile = new Profile();
$id = $store->data()->id;
if (!$profile->exists($id))
{
    echo "Du har inte skapat någon profil än!";
}
else {
    include 'include/views/profile.php';
}
?>
    </div>
<?php
include 'include/overall/footer.php';
?>