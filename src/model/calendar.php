<?php

require '../../vendor/autoload.php';

use benhall14\phpCalendar\Calendar as Calendar;
?>

<link rel="stylesheet" type="text/css" href="/enigma/vendor/benhall14/php-calendar/html/css/calendar.css">


<?php

$calendar = new Calendar();


$sql = "SELECT * FROM calendar WHERE username=:username";

$stmt = new DBConn;

$db = $stmt->connect()->prepare($sql);
$db->bindParam(':username', $s_username);
$db->execute();

$row = $db->fetchAll(PDO::FETCH_ASSOC);

$events = array();


foreach ($row as $event) {
    $start_e = $event['start'];
    $end_e = $event['end'];
    $summary_e = $event['summary'];


    $events[] = array(
        'start' => $start_e,
        'end' => $end_e,
        'summary' => $summary_e,
        'mask' => true
    );
}


$events[] = array(
    'start' => '2022-12-25',
    'end' => '2022-12-25',
    'mask' => true,
    'summary' => 'Christmas'

);

$events[] = array(
    'start' => '2023-01-01',
    'end' => '2023-01-01',
    'mask' => true,
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


    <!-- color coding in future
    <label for="color_code">Color Code:</label>
    <select type='color' name="color_code" required></br>
        <option value="005f73">Space Teal</option>
        <option value="94d2bd">Aqua Green</option>
        <option value="e9d8a6">Dessert Yellow</option>
        <option value="ee9b00">Mexico Orange</option>
        <option value="ae2012">Blood Red</option>
        <option value="f15bb5">Candy Pink</option>
        <option value="9d4edd">Lavander Purple</option>
    </select><br>
-->
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

    $sql = "INSERT INTO calendar (username, start, end, summary) VALUES ( :username, :start, :end, :summary)";

    $stmt = new DBConn;

    $db = $stmt->connect()->prepare($sql);

    $db->bindParam(':username', $s_username);
    $db->bindParam(':start', $start);
    $db->bindParam(':end', $end);
    $db->bindParam(':summary', $summary);

    if ($db->execute()) {
    }
}
$stmt = null;
?>