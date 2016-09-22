<?php
require_once 'include/init.php';
$errors = array();
$i = 0;

if (Input::exists())
{
    if(Token::check(Input::get('token')))
    {

        $validate = new Validate();
        $validation = $validate->check($_POST, array (
            'email' => array(
                'required' => true,
                'email' => true),

            'password' => array(
                'required' => true)
        ));

        if(count($validation->errors()) == 0)
        {
            $store = new Store();

            $login = $store->login(Input::get('email'), Input::get('password'));

            if ($login)
            {
                Redirect::to('welcome.php');
            }
            else
            {
                echo 'Inloggningen misslyckades';
            }
        }
        else
        {
            foreach($validation->errors() as $error)
            {
                $errors[$i] = $error;
                $i++;
            }
        }
    }
}
?>

<div id="login">
    <form name="loginForm" action="" method="POST">
        <div class="formgroup">
            <label for="email">E-mail: </label>
            <input type ="text" placeholder="Skriv e-post här..." id="email" class="logincontrol" name="email"><br>
            <span class="error"><?php foreach($errors as $error) {if (strpos($error, 'email') !== false) { echo $error, '<br>'; }}?> </span>
        </div>
        <div class="formgroup">
            <label for="password">Lösenord: </label>
            <input type ="password" placeholder="Skriv önskat lösenord här..." id="password" class="logincontrol" name="password" autocomplete="off"><br>
        </div>
        <span class="error"><?php foreach($errors as $error) {if (strpos($error, 'password') !== false) { echo $error, '<br>'; }}?></span>
        <div class="formgroup">
            <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
            <button type="submit" id="loginbtn" class="btn">Logga in</button><br>
        </div>
        <br>Inte medlem ?<br>
        <a href="register.php">Registera dig</a>
    </form>
</div>