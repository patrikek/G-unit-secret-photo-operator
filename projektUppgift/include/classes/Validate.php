<?php
// Part 11 i tutorial.

class Validate {
    private $_passed = false,
        $_errors = array(),
        $_db = null;

    public function __construct()
    {
        $this->_db = DB::getInstance();
    }

    public function check($source, $items = array())
    {
        foreach($items as $item => $rules)
        {
            foreach ($rules as $rule => $rule_value)
            {

                $value = $source[$item];

                if($rule === 'required' && (empty($value) || strlen(trim($value)) == 0))
                {
                    $this->addError("{$item} måste vara ifyllt");
                }
                else if (!empty($value))
                {
                    switch($rule)
                    {
                        case 'min':
                            if(strlen($value) < $rule_value)
                            {
                                $this->addError("{$item} måste vara minst {$rule_value} tecken.");
                            }
                            break;
                        case 'max':
                            if(strlen($value) > $rule_value)
                            {
                                $this->addError("{$item} får max vara {$rule_value} tecken.");
                            }
                            break;
                        case 'matches':
                            if($value != $source[$rule_value])
                            {
                                $this->addError("{$rule_value} måste matcha{$item}.");
                            }
                            break;
                        case 'unique':
                            $check = $this->_db->get($rule_value, array($item, '=', $value));
                            if ($check->count())
                            {
                                $this->addError("{$item} finns redan.");
                            }
                            break;
                    }

                }
            }
        }
        if (empty($this->_errors))
        {
            $this->_passed = true;
        }

        return $this;
    }

    private function addError($error)
    {
        $this->_errors[] = $error;
    }

    public function errors()
    {
        return $this->_errors;
    }

    public function passed()
    {
        $this->_passed;
    }

}