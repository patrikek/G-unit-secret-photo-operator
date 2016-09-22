<?php

class Profile
{
    private $_db,
        $_store;

    public function __construct()
    {
        $this->_db = DB::getInstance();
        $this->_store = new Store();

    }

    public function create($fields = array())
    {
        if (!$this->_db->insert('storeprofiles', $fields)) {
            throw new Exception('Det uppstod ett problem när profilen skulle skapas');
        }
    }


    public function update($id, $fields = array())
    {
        if (!$this->_db->update('storeprofiles', $id, $fields))
        {
            throw new Exception('Det uppstod ett problem när profilen skulle uppdateras');
        }
    }

    public function data($id, $field)
    {
        $data = $this->_db->get('storeprofiles', array('store_id', '=', $id));
        return $data->first()->$field;
    }

    public function exists($id)
    {
        $exist = $this->_db->get('storeprofiles', array('store_id', '=', $id));
        if ($exist->count())
        {
            return true;
        }
        return false;
    }

    public function storeContact($id)
    {
        $stores = $this->_db->get('storeprofiles', array('store_id', '=', $id));
        if (!$this->_db->count())
        {
            echo '<p>Inga butiker registrerade</p>';
        }
        else
        {
            foreach($stores->results() as $store)
            {
                echo "<p>";
                echo "<b>Adress: </b>" . $store->adress . "<br>";
                echo "<b>Telefonnummer: </b>" . $store->phone . "<br>";
            }
        }
    }


    public function showStores()
    {
        $stores = $this->_db->get('storeprofiles', array('accepted', '=', '1'));
        if (!$this->_db->count())
        {
            echo '<p>Inga butiker registrerade</p>';
        }
        else
        {
            foreach($stores->results() as $store)
            {
                echo "<b>" . $store->header . "</b><br>";
                echo '<div class="store" style="background-image: url(img/' .  $store->imgurl . '.jpg); background-size: cover;">';
                echo '</div>';
            }
        }
    }
}
?>