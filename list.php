<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Viewing Activity</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" />
</head>
<body>

<a href="input.php">Click to Add a New View Viewing Activity</a>

<h1>Netflix Viewing Activity</h1>

<?php
// connect
$db = new PDO ('mysql:host=aws.computerstudi.es;dbname=gc200389459', 'gc200389459', '-Z69zNNigW');

// set up query
$sql = "SELECT * FROM nf_my_view_act";

// execute & store the result
$cmd = $db->prepare($sql);
$cmd->execute();
$my_nf = $cmd->fetchAll();

// start the table
echo '<table class="table table-striped table-hover"><thead><th>Title</th><th>Date</th><th>Genre</th><th>Rating</th><th>Comment</th></thead>';

// loop through the data & show each restaurant on a new row
foreach ($my_nf as $m)
{
    echo '<tr><td>' . $m['title'] .
        '</td><td>' . $m['mm'] . " " . $m['dd'] . ", " . $m['yy'] .
        '</td><td>' . $m['genre'] .
        '</td><td>' . $m['rating'] .
        '</td><td>' . $m['cmnt'] . '</td></tr>';
}
// close the table
echo '</table>';

// disconnect
$db = null;
?>

</body>
</html>