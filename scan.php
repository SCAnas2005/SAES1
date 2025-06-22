<?php 
    $root = $_SERVER["DOCUMENT_ROOT"];
    $all = array_diff(scandir($root), ['.', '..']);

    foreach ($all as $file) {
        echo $file . "<br>";
    }


?>