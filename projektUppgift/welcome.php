<?php
include 'include/overall/header.php';
?>
<br>
<div id="welcome">
<?php
$store = new Store();
$profile = new Profile();
$id = $store->data()->id;
if(Session::exists('registered'))
{
    echo '<p>' . Session::flash('registered') . '</p>';

}

if ($store->isLoggedIn())
{
?>

    <p>Välkommen, <?php echo escape($store->data()->storename); ?>!</p>

    <?php
    if (!$profile->exists($id))
    {

        $profile->create(array(
            'header' => '',
            'description' => '',
            'store_id' => $store->data()->id,
        ));
        ?>

        <form name="editorForm" action="editprofile.php" method="POST">
            <div class="formgroup">
                <button type="submit" id="savebtn" class="btn">Skapa profil!</button>
                <br>
            </div>
        </form>
<?php
    }
}
?>
</div>
<?php
include 'include/overall/footer.php';
?>
