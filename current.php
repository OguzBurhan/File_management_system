

<h2>List of Current Assessments</h2>
<form action='current.php' method='get'>
    <div class="checkbox">
        <?php
        $lines = explode("\n", file_get_contents("data.txt")) ;

        // store text file data in array
        $data = [];
        foreach($lines as $line){

            $line = explode(",",$line);

            $data[$line[0]] = [
                'id' => $line[0],
                'course_code' => $line[1],
                'assgmnt_type' => $line[2],
                'due_date' => $line[3],
                'due_time' => $line[4],
                'status' => $line[5]
            ];
            if($line[5] == 'current') {
                echo "<br><label><input type='checkbox' name='id[]' value='".$line[0]."'> $line[0]  $line[1]  $line[2]  $line[3]  $line[4]  $line[5]</label>";
            }}

        ?>
        <br>
        <label><button type='submit' name='update'>update</button></label>
    </div>
</form>
<?php
//if(!isset($_POST['update'])) {
//    $var = $_POST['id'];
//    if(isset($var)){
//        print_r($lines);
//    }
//}

if(isset($_GET['update']) ) {
    $assgmntIds = isset($_GET['id']) ? $_GET['id'] : '' ;


    if(! empty($assgmntIds) && is_array($assgmntIds)){

        // get each assignment id
        foreach ($assgmntIds as $assgmntId) {
            if(isset($data[$assgmntId])){
                // update current assignment status
                $data[$assgmntId]['status'] = 'completed';
            }
        }

        // open data file
        $fp = fopen("data.txt", "w");

        // Update data file with updated data
        $results = [];
        foreach ($data as $k => $v){
            $results[] = implode(',', $v);
        }
        $results = implode("\n" , $results);
        fwrite($fp, $results);

        fclose($fp);
    }


   header("Location: index.php?option=current");
    exit;

}

?>
<?php
echo show_source(__FILE__);




