<h2>List of Completed Assessments</h2>

<form action='completed.php' method='get'>
    <div class="checkbox">
<?php
//$lines = file ('uploads/test.txt');
$lines = explode("\n", file_get_contents("data.txt")) ;
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
if($line[5] == 'completed') {
//    echo $line[0] . $line[1] . $line[2] . $line[3] . $line[4] . $line[5];

    echo "<br><input type='checkbox' name='id[]' value='". $line[0] ."'> $line[0] \n $line[1] \n $line[2] \n $line[3] \n $line[4] \n $line[5]";

}}

?>



        <br>
        <label><button type='submit' name='update'>update</button></label>
    </div>
</form>

        <?php


        if(isset($_GET['update']) ) {
            $assgmntIds = isset($_GET['id']) ? $_GET['id'] : '' ;


            if(! empty($assgmntIds) && is_array($assgmntIds)){

                // get each assignment id
                foreach ($assgmntIds as $assgmntId) {
                    if(isset($data[$assgmntId])){
                        // update current assignment status
                        $data[$assgmntId]['status'] = 'current';
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


            header("Location: index.php?option=completed");
            exit;

        }

        echo show_source(__FILE__);


