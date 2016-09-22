<?php

class Store {
    private $_db,
            $_data,
            $_sessionName,
            $_isLoggedIn;

    public function __construct($user = null)
    {
        $this->_db = DB::getInstance();
        $this->_sessionName = Config::get('session/session_name');

        if (!$user)
        {
            if(Session::exists($this->_sessionName))
            {
                $user = Session::get($this->_sessionName);

                if($this->find($user))
                {
                    $this->_isLoggedIn = true;
                }
            }
            else {
                $this->find($user);
            }
        }
    }

    public function create($fields = array())
    {
        if(!$this->_db->insert('stores', $fields))
        {
            throw new Exception('Det uppstod ett problem när ditt konto skulle skapas');
        }
    }

    public function find($user = null)
    {
        if($user)
        {
            $field = (is_numeric($user)) ? 'id' : 'email';
            $data = $this->_db->get('stores', array($field, '=', $user));

            if ($data->count()) {
                $this->_data = $data->first();
                return true;
            }
        }
        return false;
    }

    public function login($username = null, $password = null)
    {
        $user = $this->find($username);
        if ($user) {
            if ($this->data()->password === Hash::make($password, $this->data()->salt))
            {
                Session::put($this->_sessionName, $this->data()->id);
                return true;
            }
            return false;
        }
    }

    public function exists()
    {
        return (!empty($this->_data)) ? true : false;
    }

    public function logout()
    {
        Session::delete($this->_sessionName);
    }

    public function data() {
        return $this->_data;
    }

    public function isLoggedIn() {
        return $this->_isLoggedIn;
    }
}