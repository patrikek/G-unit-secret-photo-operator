<?php

class Search {

    private $_db;

    public function __construct()
    {
        $this->_db = DB::getInstance();
    }

    public function search($table, $input) {

        $results = $this->_db->get($table, array('type', '=', $input));

        if (!$results->count())
        {
            echo "<p>Inga resultat hittades.</p>";
        }

        else
            {
                foreach($results->results() as $result)
                {
                    echo "<p>\n";
                    echo "<b>Butik: </b>" . $result->store_name . "<br>";
                    echo "<b>Tjänst: </b>" . $result->type . "<br>";
                    echo "<b>Pris: </b>" . $result->price . "<br>";
                    echo "</p>\n";
                }
            }
        }
}