<?php
require_once 'include/init.php';

$errors = array();
$i = 0;
$store = new Store();
$profile = new Profile();
$id = $store->data()->id;

if (Input::exists()) {
    if (Token::check(Input::get('token')))
    {
        $validate = new Validate();
        $validation = $validate->check($_POST, array(
            'header' => array('required' => true)));

        if (count($validation->errors()) == 0)
        {
                try {
                    $profile->update($id, array(
                        'header' => Input::get('header'),
                        'description' => Input::get('description'),
                        'store_id' => $store->data()->id,
                    ));
                    Session::flash('registered', 'Profilen har uppdaterats!');
                    Redirect::to('welcome.php');
                } catch (Exception $e) {
                    die($e->getMessage());
                }
        }
    }
    else
    {
        foreach ($validation->errors() as $error)
        {
            $errors[$i] = $error;
            $i++;
        }
    }
}
?>

<div id="editor">
    <form name="editorForm" action="" method="POST">
        <div class="formgroup">
            <label for="header">Rubrik: </label>
            <input type ="text" id="header" class="editorcontrol" name="header" value="<?php echo escape($profile->data($id, 'header')); ?>"><br>
            <span class="error"><?php foreach($errors as $error) {if (strpos($error, 'header') !== false) { echo $error, '<br>'; }}?> </span>
        </div>
        <div class="formgroup">
            <label for="profilepic">Ladda upp profilbild: </label><br>
            <button type ="button" class="btn" id="picbtn" name="profilepic">Välj bild</button><br>
            <button type ="button" class="btn" id="picbtn" name="profilepic">Ladda upp</button><br>
        </div>
        <div class="formgroup">
            <label for="description">Ändra beskrivning: </label>
            <textarea id="description" class="editorcontrol" name="description"><?php echo escape($profile->data($id, 'description')); ?></textarea><br>
        </div>
        <div class="formgroup">
            <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
            <button type="submit" id="savebtn" class="btn">Spara</button><br>
        </div>
    </form>
    <a href="services.php">
        <button id="servicebtn" class="btn">Lägg till/Hantera tjänster</button>
    </a>
</div>