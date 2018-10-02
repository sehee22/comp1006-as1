<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Input Viewing Activity</title>
    <link rel="stylesheet" href="css/bootstrap.min.css"/>
</head>
<body>

<a href="list.php">View Viewing Activity</a>

<h1>Input a New Viewing Activity</h1>

<form action="save.php" method="post">
    <fieldset>
        <label for ="title" class="col-md-1">Title: </label>
        <input name="title" id="title" required/>
    </fieldset>
    <fieldset>
        <label for="mm" class="col-md-1">Date: </label>
        <?php
        // connect
        $db = new PDO ('mysql:host=aws.computerstudi.es;dbname=gc200389459', 'gc200389459', '-Z69zNNigW');

        // set up query
        $sql = "select mm from nf_mm order by ord";
        $cmd = $db->prepare($sql);

        // fetch the results
        $cmd->execute();
        $month = $cmd->fetchAll();

        // start the select
        echo '<select name = "mm">';

        // loop through and create a new option tag for each type
        foreach ($month as $m)
        {
            echo '<option>' . $m[mm] . '</option>';
        }

        // close the select
        echo '</select>';

        // disconnect
        $db = null;
        ?>
    </fieldset>
    <fieldset>
        <label for="dd" class="col-md-1"></label>
        <?php
        // connect
        $db = new PDO ('mysql:host=aws.computerstudi.es;dbname=gc200389459', 'gc200389459', '-Z69zNNigW');

        // set up query
        $sql = "select dd from nf_dd";
        $cmd = $db->prepare($sql);

        // fetch the results
        $cmd->execute();
        $day = $cmd->fetchAll();

        // start the select
        echo '<select name = "dd">';

        // loop through and create a new option tag for each type
        foreach ($day as $d)
        {
            echo '<option>' . $d[dd] . '</option>';
        }

        // close the select
        echo '</select>';

        // disconnect
        $db = null;
        ?>
    </fieldset>
    <fieldset>
        <label for="yy" class="col-md-1"></label>
        <?php
        // connect
        $db = new PDO ('mysql:host=aws.computerstudi.es;dbname=gc200389459', 'gc200389459', '-Z69zNNigW');

        // set up query
        $sql = "select yy from nf_yy order by ord desc";
        $cmd = $db->prepare($sql);

        // fetch the results
        $cmd->execute();
        $year = $cmd->fetchAll();

        // start the select
        echo '<select name = "yy">';

        // loop through and create a new option tag for each type
        foreach ($year as $y)
        {
            echo '<option>' . $y[yy] . '</option>';
        }

        // close the select
        echo '</select>';

        // disconnect
        $db = null;
        ?>
    </fieldset>
    <fieldset>
        <label for="genre" class="col-md-1">Genre: </label>
        <?php
        // connect
        $db = new PDO ('mysql:host=aws.computerstudi.es;dbname=gc200389459', 'gc200389459', '-Z69zNNigW');

        // set up query
        $sql = "select genre from nf_genre order by genre";
        $cmd = $db->prepare($sql);

        // fetch the results
        $cmd->execute();
        $genre = $cmd->fetchAll();

        // start the select
        echo '<select name = "genre">';

        // loop through and create a new option tag for each type
        foreach ($genre as $g)
        {
            echo '<option>' . $g[genre] . '</option>';
        }

        // close the select
        echo '</select>';

        // disconnect
        $db = null;
        ?>
    </fieldset>
    <fieldset>
        <label for="rating" class="col-md-1">Rating: </label>
        <?php
        // connect
        $db = new PDO ('mysql:host=aws.computerstudi.es;dbname=gc200389459', 'gc200389459', '-Z69zNNigW');

        // set up query
        $sql = "select rating from nf_rating order by ord";
        $cmd = $db->prepare($sql);

        // fetch the results
        $cmd->execute();
        $rating = $cmd->fetchAll();

        // start the select
        echo '<select name = "rating">';

        // loop through and create a new option tag for each type
        foreach ($rating as $r)
        {
            echo '<option>' . $r[rating] . '</option>';
        }

        // close the select
        echo '</select>';

        // disconnect
        $db = null;
        ?>
    </fieldset>
    <fieldset>
        <label for ="cmnt" class="col-md-1">Comment: </label>
        <textarea name="cmnt" id="cmnt" requiered></textarea>
    </fieldset>
    <button class="col-md-offset-1 btn btn-primary">Save</button>
</form>
</body>
</html>