<?php
require_once 'include/init.php';

if (Input::exists())
{
    Session::put('input', Input::get('search'));
    Redirect::to('searchresults.php');
}

?>



<div id="search">
    <form method="POST">
        <input class="searchcontrol" type="text" placeholder="Sök tjänst" id="searchfield" name="search">
        <button id="searchbtn">Sök</button>
    </form>
</div>