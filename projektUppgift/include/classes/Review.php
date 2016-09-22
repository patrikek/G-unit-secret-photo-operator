<?php

class Review {

    private $_db;

    public function __construct()
    {
        $this->_db = DB::getInstance();
    }

    public function create($fields = array())
    {
        if(!$this->_db->insert('reviews', $fields))
        {
            throw new Exception('Det uppstod ett problem när kommentaren skulle postas.');
        }
    }

    public function showPost($id)
    {
        $reviews = $this->_db->get('reviews', array('store_id', '=', $id));
        if (!$this->_db->count())
        {
            echo '<p>Inga omdömen om den här butiken har skrivits än</p>';
        }
        else
        {
            foreach($reviews->results() as $review)
            {
                echo "<p>\n";
                echo "<b>Användare: </b>" . $review->username . "<br>";
                echo "<b>Kommentar: </b>" . $review->message . "<br>";
                echo "<b>Betyg: </b>" . $review->rating . "<br>";
                echo "</p>\n";
            }
        }
    }

}