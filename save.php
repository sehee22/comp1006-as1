<?php
$b_title = "Save Netflix Viewing Activity";
require('header.php');
require('auth.php');

// introduce variables to store the form input variables
$title = $_POST ['title'];
$mm = $_POST ['mm'];
$dd = $_POST ['dd'];
$yy = $_POST ['yy'];
$genre = $_POST ['genre'];
$rating = $_POST ['rating'];
$cmnt = $_POST ['cmnt'];
$ord = $_POST['ord'];

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

// compare the date vs. now
if ($today < date('Ymd', strtotime($dt)))
{
    echo "<h2>Save Failed</h2>";
    echo "The date cannot be future than now (Input date: " . $mm . " " . $dd . ", " . $yy . ").";
    $ok = false; // do not save the data
}

// date validation
if (!(checkdate($mm_num,$dd,$yy)))
{
    echo "<h2>Save Failed</h2>";
    echo "Check the date (Input date: " . $mm . " " . $dd . ", " . $yy . ").";
    $ok = false; // do not save the data
}

// connect to the database with server, username, password, dbname
// only save if no validation errors
if ($ok)
{
    // db connect
    require('db.php');

    if (empty($ord))
    {
        $sql = "INSERT INTO nf_my_view_act (title, mm, dd, yy, genre, rating, cmnt) VALUES (:title, :mm, :dd, :yy, :genre, :rating, :cmnt)";
    }
    else
    {
        $sql = "UPDATE nf_my_view_act SET title = :title, mm = :mm, dd = :dd, yy = :yy, genre = :genre, rating = :rating, cmnt = :cmnt WHERE ord = :ord";
    }

    $cmd = $db->prepare($sql);
    $cmd->bindParam(':title', $title, PDO::PARAM_STR, 100);
    $cmd->bindParam(':mm', $mm, PDO::PARAM_STR, 9);
    $cmd->bindParam(':dd', $dd, PDO::PARAM_STR, 2);
    $cmd->bindParam(':yy', $yy, PDO::PARAM_STR, 4);
    $cmd->bindParam(':genre', $genre, PDO::PARAM_STR, 20);
    $cmd->bindParam(':rating', $rating, PDO::PARAM_STR, 5);
    $cmd->bindParam(':cmnt', $cmnt, PDO::PARAM_STR, 500);

    if (!empty($ord))
    {
        $cmd->bindParam('ord', $ord, PDO::PARAM_INT);
    }
    $cmd->execute();

    // disconnect!!! after inserting, disconnect from the database
    $db = null;

    // redirect
    header('location:list.php');
}
?>

</body>
</html>