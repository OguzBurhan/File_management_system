<?php

// restore previously uploaded files

if(isset($_GET['file']) && ! empty($_GET['file']) ) {

    $file = $_GET['file'];

    @file_put_contents("data.txt", file_get_contents("uploads/{$file}"));
    header("Location: index.php?option=upload");
    exit;
}

echo show_source(__FILE__);