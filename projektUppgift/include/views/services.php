<?php
require_once 'include/init.php';

$errors = array();
$i = 0;

if (Input::exists()) {
    if (Token::check(Input::get('token')))
    {
        $validate = new Validate();
        $validation = $validate->check($_POST, array(
            'service' => array(
                'required' => true,
            ),
            'price' => array(
                'required' => true,
                'min' => 2,
                'max' => 50,
            ),
        ));

        if (count($validation->errors()) == 0)
        {
            $service = new Service();
            $store = new Store();
            $salt = Hash::salt(32);
            try
            {
                $service->create(array(
                    'type' => Input::get('service'),
                    'price' => Input::get('price'),
                    'store_name' => $store->data()->storename
                ));

                Session::flash('service' , 'Tjänsten har skapats');
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






<div id="editor">
    <form name="editorForm" action="" method="POST">
        <div class="formgroup">
            <label for="service">Tjänst: </label>
            <input type ="text" id="service" class="registercontrol" name="service"><br>
        </div>
        <div class="formgroup">
            <label for="price">Pris: </label>
            <input type ="text" id="price" class="registercontrol" name="price">
        </div>
        <div class="formgroup">
            <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
            <button type="submit" id="add" class="btn">Lägg till</button><br>
        </div>
        <?php
        if (Session::exists('service')) {
            echo '<p>' . Session::flash('service') . '</p>';
        }
        ?>
</div>
