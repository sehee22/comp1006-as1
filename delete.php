<?php
$b_title = "Delete Activity";
require ('header.php');
require('auth.php');

try {
    // GET selected Netflix viewing ord
    $ord = $_GET['ord'];

    if (empty($ord)) {
        header('location:list.php'); // return list page
    }

    // connect
    require('db.php');

    // find poster & delete it if there is on
    $sql = "SELECT poster FROM nf_my_view_act WHERE ord = :ord";
    $cmd = $db->prepare($sql);
    $cmd->bindParam(':ord', $ord, PDO::PARAM_INT);
    $cmd->execute();
    $poster = $cmd->fetchColumn();


    // set up and execute SQL DELETE command
    $sql = "DELETE FROM nf_my_view_act WHERE ord = :ord";
    $cmd = $db->prepare($sql);
    $cmd->bindParam(':ord', $ord, PDO::PARAM_INT);
    $cmd->execute();

    // disconnect
    $db = null;

    // now delete the poster if there is one (delete from database and then delete the image)

    if (!empty($poster)) {
        unlink("img/$poster");
    }

    // redirect to updated list page
    header('location:list.php'); // return list page
}
catch (Exception $e)
{
    // send
    mail('@', 'Netflix page Error: ' . $b_title , $e);
    // show generic error page
    header('location:error.php');
}
?>
</body>
</html>
