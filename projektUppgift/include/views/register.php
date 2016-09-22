<?php
require_once 'include/init.php';

$errors = array();
$i = 0;

if (Input::exists()) {
    if (Token::check(Input::get('token')))
    {
        $validate = new Validate();
        $validation = $validate->check($_POST, array(
            'orgnummer' => array(
                'required' => true,
                'min' => 10,
                'max' => 18,
            ),
            'storename' => array(
                'required' => true,
                'min' => 2,
                'max' => 50,
            ),
            'email' => array(
                'required' => true,
                'min' => 2,
                'max' => 50,
                'unique' => 'stores',
                'email' => true
            ),
            'adress' => array(
                'required' => true,
                'min' => 2,
                'max' => 50,
            ),
            'phone' => array(
                'required' => true,
                'min' => 5,
                'max' => 11,
            ),
            'password' => array(
                'required' => true,
                'min' => 6
            ),
        ));

        if (count($validation->errors()) == 0)
        {
            $store = new Store();
            $profile = new Profile();
            $salt = Hash::salt(32);
            try
            {
                $store->create(array(
                    'storename' => Input::get('storename'),
                    'email' => Input::get('email'),
                    'password' => Hash::make(Input::get('password'), $salt),
                    'salt' => $salt
                ));

                Session::flash('registered' , 'Du har blivit registrerad och kan nu logga in!');
                Redirect::to('welcome.php');
            }
            catch(Exception $e)
            {
                die($e->getMessage());
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
}
?>
<div id="register">
    <form name="register"  action="" method="POST">
        <div class="formgroup">
            <label for="orgnummer">Org-nummer:</label>
            <input type ="text" placeholder="Skriv butikens org-nr här..." id="orgnummer" class="registercontrol" name="orgnummer" value="<?php escape(Input::get('orgnummer'));?>" autocomplete="off"><br>
            <span class="error"><?php foreach($errors as $error) {if (strpos($error, 'orgnummer') !== false) { echo $error, '<br>'; }}?> </span>
        </div>
        <div class="formgroup">
            <label for="storename">Butiksnamn:</label>
            <input type ="text" placeholder="Skriv butikens namn här..." id="storename" class="registercontrol" name="storename" value="<?php escape(Input::get('storename'));?>" autocomplete="off"><br>
            <span class="error"><?php foreach($errors as $error) {if (strpos($error, 'storename') !== false) { echo $error, '<br>'; }}?> </span>
        </div>
        <div class="formgroup">
            <label for="email">E-mail:</label>
            <input type ="text" placeholder="Skriv butikens E-mail här..." id="email" class="registercontrol" name="email" value="<?php escape(Input::get('email'));?>" autocomplete="off"><br>
            <span class="error"><?php foreach($errors as $error) {if (strpos($error, 'email') !== false) { echo $error, '<br>'; }}?> </span>
        </div>
        <div class="formgroup">
            <label for="adress">Adress:</label>
            <input type ="text" placeholder="Skriv butikens adress här..." id="adress" class="registercontrol" name="adress" value="<?php escape(Input::get('adress'));?>" autocomplete="off"><br>
            <span class="error"><?php foreach($errors as $error) {if (strpos($error, 'email') !== false) { echo $error, '<br>'; }}?> </span>
        </div>
        <div class="formgroup">
            <label for="phone">Telefon:</label>
            <input type ="text" placeholder="Skriv butikens telefon här..." id="phone" class="registercontrol" name="phone" value="<?php escape(Input::get('phone'));?>" autocomplete="off"><br>
            <span class="error"><?php foreach($errors as $error) {if (strpos($error, 'email') !== false) { echo $error, '<br>'; }}?> </span>
        </div>
        <div class="formgroup">
            <label for="password">Lösenord:</label>
            <input type ="password" placeholder="Skriv önskat lösenord här..." id="password" class="registercontrol" name="password" autocomplete="off"><br>
            <span class="error"><?php foreach($errors as $error) {if (strpos($error, 'password') !== false) { echo $error, '<br>'; }}?> </span>
        </div>
        <div class="formgroup">
            <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
            <button type="submit" id="regbtn" class="btn">Registrera dig</button><br>
        </div>
    </form>
</div>