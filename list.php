<?php
$b_title = "Viewing Activity";
require('header.php');

?>

<h1>Netflix Viewing Activity</h1>

<?php
try
{
    // connect
    require('db.php');

    // set up query
    $sql = "SELECT * FROM nf_my_view_act";

    // execute & store the result
    $cmd = $db->prepare($sql);
    $cmd->execute();
    $my_nf = $cmd->fetchAll();

    // start the table
    echo '<table class="table table-striped table-hover"><thead><th>Title</th><th>Date</th><th>Genre</th><th>Rating</th><th>Comment</th>';

    // only member can see this part
    if (isset($_SESSION['userId'])) {
        echo "<th>Action</th>";
    }

    echo '</thead>';

    // loop through the data & show each restaurant on a new row
    // date format: mm dd, yyyy
    foreach ($my_nf as $m) {
        echo '<tr><td>' . $m['title'] .
            '</td><td>' . $m['mm'] . " " . $m['dd'] . ", " . $m['yy'] .
            '</td><td>' . $m['genre'] .
            '</td><td>' . $m['rating'] .
            '</td><td>' . $m['cmnt'] . '</td>';

        // only member can see this part
        if (isset($_SESSION['userId'])) {
            echo "<td><a href=\"input.php?ord={$m['ord']}\">Edit</a> | <a href=\"delete.php?ord={$m['ord']} \" 
                             class=\"text-danger confirmation\">Delete</a> </td>";
        }

        echo '</tr>';
    }
    // close the table
    echo '</table>';

    // disconnect
    $db = null;
}
catch (Exception $e)
{
    // send
    mail('200389459@student.georgianc.on.ca', 'Netflix page Error: ' . $b_title , $e);
    // show generic error page
    header('location:error.php');
}
?>
<!-- js -->
<script src ="js/jquery-3.3.1.min.js"></script>
<script src="js/scripts.js"></script>
<!-- sorttable script from https://kryogenix.org/code/browser/sorttable/ -->
<script src="js/sorttable.js"></script>

</body>
</html>