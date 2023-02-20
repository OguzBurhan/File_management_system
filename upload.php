<h1>Upload Assessments File</h1>
<form action="upload.php" method="POST" enctype="multipart/form-data">
    <!-- MAX_FILE_SIZE must precede the file input field -->
    <input type="file" name="file" id="fileUpload"  />
    <!-- Name of button element determines name in $_FILES array -->
    <button type="submit" name="submit" >upload</button>
</form>
<?php
if(isset($_POST['submit'])) {

    // count num of txt files in upload dir
    $txtFileCount = count( glob('uploads/*.txt') ) + 1;

    $file = $_FILES['file'];
    $fileName = $_FILES['file']['name'];
    $fileTmp = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];

    $fileExt = explode('.', $fileName);
    $fileActualName = strtolower(array_shift($fileExt));
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('txt');

    if(in_array($fileActualExt, $allowed)){
        if($fileError === 0){
            if($fileSize < 1000000){
                $fileNameNew = $fileActualName . ' - ' .  $txtFileCount .".".$fileActualExt;
                $fileDestination = 'uploads/'.$fileNameNew;
                if(move_uploaded_file($fileTmp, $fileDestination)){

                    //read file
//                    $lines = explode("\n", file_get_contents($fileDestination)) ;
                    @file_put_contents("data.txt", file_get_contents($fileDestination));
                    header("Location: index.php?option=upload");
                    exit;

                }
            }else{
                echo "File is too big!";
            }
        }else{
            echo "There was en error uploading the file!";
        }
    }else{
        echo "you can't upload this file!";
    }


}

?>

<hr>

<h1>Files Previously Uploaded</h1>

<ul>
    <?php foreach(glob('uploads/*.txt') as $file): ?>

        <li>
            <a href="restore.php?file=<?= pathinfo($file, PATHINFO_BASENAME) ?>"><?= pathinfo($file, PATHINFO_BASENAME) ?></a>
        </li>

    <?php endforeach; ?>
</ul>

<?php
echo show_source(__FILE__);