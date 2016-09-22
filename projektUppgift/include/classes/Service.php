<?php

class Service {

    private $_db;

    public function __construct()
    {
        $this->_db = DB::getInstance();
    }

    public function create($fields = array())
    {
        if(!$this->_db->insert('services', $fields))
        {
            throw new Exception('Det uppstod ett problem när tjänsten skulle skapas');
        }
    }

}