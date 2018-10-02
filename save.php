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

// to compare [the input date] to [current date]
// if [the input date] > [current date] => echo message, does not save the data

// to make easy to compare, replace from the full name of the month to a number (string type)
switch ($mm)
{
    case "January":
        $mm_num = "01";
        break;
    case "February":
        $mm_num = "02";
        break;
    case "March":
        $mm_num = "03";
        break;
    case "April":
        $mm_num = "04";
        break;
    case "May":
        $mm_num = "05";
        break;
    case "June":
        $mm_num = "06";
        break;
    case "July":
        $mm_num = "07";
        break;
    case "August":
        $mm_num = "08";
        break;
    case "September":
        $mm_num = "09";
        break;
    case "October":
        $mm_num = "10";
        break;
    case "November":
        $mm_num = "11";
        break;
    case "December":
        $mm_num = "12";
        break;
}

$today = date("Ymd");
$dt = $yy . "" . $mm_num . "" . $dd;

// compare
if ($today < date('Ymd', strtotime($dt)))
{
    echo "The date cannot be future than now.";
    echo "<br />";
    echo "Please go back to the previous page by clicking [<-] button on a web browser";
    $ok = false; // dose not save the data
}

// connect to the database with server, username, password, dbname
// only save if no validation errors
if ($ok == true)
{
    // PDO : PHP Database Object (regardless the database, we can use any type database system
    $db = new PDO ('mysql:host=aws.computerstudi.es;dbname=gc200389459', 'gc200389459', '-Z69zNNigW');

// fetch the data from the db
    $sql = "SELECT * FROM my_nf_view_act";
    $cmd = $db->prepare($sql);
    $cmd->execute();
    $restaurants = $cmd->fetchAll();
    // set up and execute an INSERT command
    $sql = "INSERT INTO my_nf_view_act (title, mm, dd, yy, genre, rating, cmnt) VALUES (:title, :mm, :dd, :yy, :genre, :rating, :cmnt)";
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

    // echo only when the $ok value is true
    echo "Viewing Activity Saved";
}


?>
</body>
</html>