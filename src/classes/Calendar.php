<?php

require '../../vendor/autoload.php';

use benhall14\phpCalendar\Calendar as Calendar;
?>

<link rel="stylesheet" type="text/css" href="/enigma/vendor/benhall14/php-calendar/html/css/calendar.css">


<?php

$calendar = new Calendar();


$sql_ce = "SELECT * FROM calendar WHERE username=:username";

$stmt_ce = new DBConn;

$db_ce = $stmt_ce->connect()->prepare($sql_ce);
$db_ce->bindParam(':username', $s_username);
$db_ce->execute();

$row_ce = $db_ce->fetchAll(PDO::FETCH_ASSOC);

$events = array();

echo $classes;
foreach ($row_ce as $event) {
    $start_e = $event['start'];
    $end_e = $event['end'];
    $summary_e = $event['summary'];


    $events[] = array(
        'start' => $start_e,
        'end' => $end_e,
        'summary' => $summary_e,
        'mask' => true,
    );
}




$events[] = array(
    'start' => '2022-12-25',
    'end' => '2022-12-25',
    'summary' => 'Christmas'
);

$events[] = array(
    'start' => '2023-01-01',
    'end' => '2023-01-01',
    'summary' => 'New Year'
);


$calendar->addEvents($events);

# finally, to draw a calendar

#echo $calendar->draw(date('Y-m-d')); # draw this months calendar

# this can be repeated as many times as needed with different dates passed, such as:
$this_month = date("m");
$this_month_plus = $this_month + 1;

$this_month_minus = $this_month - 1;


if (isset($_POST['month'])) {


    $this_month = $_POST['month'];
    $this_month_plus = $this_month + 1;
    $this_month_minus = $this_month - 1;

    echo $calendar->draw(date("Y-$this_month-01"));
} else {
    echo $calendar->draw(date('Y-m-d'));
}
?>

<form action="" method="post">
    <button type="sumbit" name="month" value="<?php echo $this_month_minus; ?>">
        << </button>
            <button type="sumbit" name="month" value="<?php echo $this_month_plus; ?>">
                >> </button>

</form>


<form action="" method="post">

    <label for="summary">Event: </label>
    <input type="text" name="summary" required>
    <br>
    <label for="start">Start: </label>
    <input type="date" name="start" required>
    <br>
    <label for="end">End: </label>
    <input type="date" name="end" required>
    <br>

    <input type="submit" name="new_event" placeholder="Submit">
</form>
<?php
if (isset($_POST['new_event'])) {

    $input_start = $_POST['start'];
    $input_end = $_POST['end'];

    $start = date("Y-m-d H:i:s", strtotime($input_start));

    $end = date("Y-m-d H:i:s", strtotime($input_end));

    $username = $_SESSION['username'];
    $summary = $_POST['summary'];
    $classes = $_POST['color_code'];

    $sql_c = "INSERT INTO calendar (username, start, end, summary, classes) VALUES ( :username, :start, :end, :summary, :classes )";

    $stmt_c = new DBConn;

    $db_c = $stmt_c->connect()->prepare($sql_c);

    $db_c->bindParam(':username', $s_username);
    $db_c->bindParam(':start', $start);
    $db_c->bindParam(':end', $end);
    $db_c->bindParam(':summary', $summary);
    $db_c->bindParam(':classes', $classes);

    if ($db_c->execute()) {
        header("Refresh:0");
    }
}

?>