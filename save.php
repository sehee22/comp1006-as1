<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Save Viewing Activity</title>
</head>
<body>

<?php
// introduce variables to store the form input variables
$title = $_POST ['title'];
$mm = $_POST ['mm'];
$dd = $_POST ['dd'];
$yy = $_POST ['yy'];
$genre = $_POST ['genre'];
$rating = $_POST ['rating'];
$cmnt = $_POST ['cmnt'];

// validate each input
$ok = true;

if (empty($title))
{
    echo "Title is Required. <br />";
    $ok = false;
}

// connect to the database with server, username, password, dbname
// only save if no validation errors
if ($ok)
{
    // PDO : PHP Database Object (regardless the database, we can use any type database system
    $db = new PDO ('mysql:host=aws.computerstudi.es;dbname=gc200389459', 'gc200389459', '-Z69zNNigW');


// fetch the data from the db
    $sql = "SELECT * FROM my_nf_view_act";
    $cmd = $db->prepare($sql);
    $cmd->execute();
    $restaurants = $cmd->fetchAll();
    // set up and execute an INSERT command
    $sql = "INSERT INTO my_nf_view_act (title, dd, mm, yy, genre, rating, cmnt) VALUES (:title, :dd, :mm, :yy, :genre, :rating, :cmnt)";
    $cmd = $db->prepare($sql);
    $cmd->bindParam(':title', $title, PDO::PARAM_STR, 100);
    $cmd->bindParam(':mm', $mm, PDO::PARAM_STR, 9);
    $cmd->bindParam(':dd', $dd, PDO::PARAM_STR, 2);
    $cmd->bindParam(':yy', $yy, PDO::PARAM_STR, 4);
    $cmd->bindParam(':genre', $genre, PDO::PARAM_STR, 20);
    $cmd->bindParam(':rating', $rating, PDO::PARAM_STR, 5);
    $cmd->bindParam(':cmnt', $cmnt, PDO::PARAM_STR, 500);
    $cmd->execute();

    // disconnect!!! after inserting, disconnect from the database
    $db = null;
}
echo "Viewing Activity Saved";
?>
</body>
</html>