<?php
if (preg_match('/^\/preview.php/', $_SERVER['REQUEST_URI'])) {
    include('preview.php');
}
else {
    include('search.php');
}
?>