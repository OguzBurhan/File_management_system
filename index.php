<!--this is the controller.php file. I thought I could change the directory and file names after -->
<!--completing the code but when i tried it gave me so many errors.-->
<!--So I decided to keep it as it is.-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Assignment 2</title>
</head>

<header>
</header>
<body>
<a href="index.php?option=current">Current | </a>
<a href="index.php?option=completed">Completed | </a>
<a href="index.php?option=upload">Upload</a>

<hr>

<?php

//switch statement here to determine which page to display
    if (isset($_GET['option'])) {
        $option = $_GET['option'];
        switch ($option) {
            case 'current':
                require 'current.php';
                break;
            case 'completed':
                require 'completed.php';
                break;
            case 'upload':
                require 'upload.php';
                break;

        }}
    ?>
</body>
<?php include "footer.php" ?>
</html>

<?php
echo show_source(__FILE__);