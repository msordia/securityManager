<?php
require '../core/init.php';

$dateFrom         = Input::get('dateFrom');
$dateTo           = Input::get('dateTo');
$response = array();



class Log
{
    public $username;
    public $reason;
    public $duration;
    public $date;
    public $changes;
}

$access1 = new Log();
$access1->username = 'testUser';
$access1->reason = 'test reason';
$access1->duration = '0:02:30';
$access1->date = '2014/05/19';
$access1->changes = 'Deleted record 5 from database';

$response = array( $access1);


echo json_encode($response);

?>