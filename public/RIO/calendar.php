<?php include($_SERVER["DOCUMENT_ROOT"] . "/backend/utils.php") ?>
<?php include($_SERVER["DOCUMENT_ROOT"] . "/backend/appointments.php");
//$booked = FUNCTION();
?>
<style>
    .calItem {
        width: 100%;
        padding: 0px;
        margin: 0px;
        background-color: darkgrey;

    }
    tr,td,table {
        border: 1px solid black;
        padding: 0px;
        margin: 0px;
        border-collapse: collapse;
    }
    td {
        width: 200px;
        height: 200px;
        vertical-align: top;
        background-color: lightgrey;
    }
</style>
<h2>Upcoming:</h2>
<table>
<?php //For loop to create days and another nested for loop to create appointments
    $start = strtotime('today midnight');
    //$end = $start + 14*24*60*60;
    //$times = getInRange($start,$end);
    //$elements = count($times);
    //$index = $elements;
    /*foreach($times as $appt){
        echo "{<br/>";
        foreach($appt as $key=>$value){
            echo "[".$key."]=>".$value."<br/>";
        }
        echo "}<br/>";
    }*/

    /*
    if(isset($times[$index]))
        {
            echo (date("d/m/Y",$times[]['time']));
        }
    */
    echo "<tr>";
    for($x = 0; $x < 14; $x++) 
    {
        echo "<td id='";
        echo $x;
        echo "'>";
        echo "<div style='border-bottom: 1px solid black'>";
        echo "<b>";
        echo (date("d/m/Y",$start+$x*24*60*60));
        echo "</b>";
        echo "</div>";

        //Add loop for things on that date
        //echo "running"; 
        $spots = getBookedOnDate($start + $x*24*60*60);
        foreach($spots as $appt){
            echo "{<br/>";
            foreach($appt as $key=>$value){
                echo "[".$key."]=>".$value."<br/>";
            }
            echo "}<br/>";
        }

        //need to find a way to put spots in the correct order
        //$len = sizeof($spots);
        //do{
        //$sorted = true;
        //for($i = 0; $i < $len-1;$i++)
        //{
        //    if($spots[$i][$value]>$spots[$i+1][$value])
        //    {
        //        $sorted = false;
         //       $temp = $spots[$i];
         //       $spots[$i] = $spots[$i+1];
         //       $spots[$i+1] = $temp;
        //    }
        //}
       // } while($sorted == false);
        foreach($spots as $value)
        {
            echo "<div class='calItem'>";
            //print out time of spots
            echo(date($value));
            //echo "test";
            echo "</div>";
        }
        echo "</td>";
        if($x==6)
        {
            echo "</tr>";
            echo "<tr>";
        }
    }
    echo "</tr>";
?>
</table>