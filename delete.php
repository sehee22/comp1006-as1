<?php
require ('header.php');
require('auth.php');

// GET selected Netflix viewing ord
$ord = $_GET['ord'];

if (empty($ord))
{
    header ('location:list.php'); // return list page
}

// connect
require('db.php');

/*
// find logo & delete it if there is on
$sql = "SELECT logo FROM restaurants WHERE id = :id";
$cmd = $db->prepare($sql);
$cmd->bindParam(':id', $id, PDO::PARAM_INT);
$cmd->execute();
$logo = $cmd->fetchColumn();
*/

// set up and execute SQL DELETE command
$sql = "DELETE FROM nf_my_view_act WHERE ord = :ord";
$cmd = $db->prepare($sql);
$cmd-> bindParam('ord', $ord, PDO::PARAM_INT);
$cmd->execute();

// disconnect
$db = null;

// now delete the og if there is one (delete from database and then delete the image)
/*
if (isset($logo))
{
    unlink("img/$logo");
}
*/
// redirect to updated list page
header ('location:list.php'); // return list page
?>
</body>
</html>