<div id="results">
    <?php
    $search = new Search();
    $input = Session::get('input');
    $search->search('services', $input);
    ?>
</div>

