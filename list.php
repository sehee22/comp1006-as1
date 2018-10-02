<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Viewing Activity</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" />
</head>
<body>

<h1>Viewing Activity</h1>

<?php
// connect
$db = new PDO ('mysql:host=aws.computerstudi.es;dbname=gc200389459', 'gc200389459', '-Z69zNNigW');

// set up query
$sql = "SELECT * FROM my_nf_view_act";

// execute & store the result
$cmd = $db->prepare($sql);
$cmd->execute();
$restaurants = $cmd->fetchAll(); // fetch는 하나씩만 부르는데, fetchall은 모두 부름. 레스토랑 이름이 여러개이니가 fetchall을 사용

// start the table
echo '<table class="table table-striped table-hover"><thead><th>Title</th><th>Month</th><th>Day</th><th>Year</th><th>Genre</th><th>Rating</th><th>Comment</th></thead>';

// loop through the data & show each restaurant on a new row
// . 으로 연결을 열고 닫고 함
foreach ($restaurants as $r)
{
    echo '<tr><td>' . $r['title'] .
        '</td><td>' . $r['mm'] .
        '</td><td>' . $r['dd'] .
        '</td><td>' . $r['yy'] .
        '</td><td>' . $r['genre'] .
        '</td><td>' . $r['rating'] .
        '</td><td>' . $r['cmnt'] . '</td></tr>';
}
// close the table
echo '</table>';

// disconnect
$db = null;
?>

</body>
</html>