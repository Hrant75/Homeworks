<?php

require_once 'db.php';

$data = [];
$sql = "SELECT * FROM cron";
$result = mysqli_query($dbConnection, $sql);

if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        if(mail('hhropp@mail.ru', 'cron message', $row['message'])){
            echo 'message sent';
            $delSql = "DELETE FROM cron WHERE id =".$row['id'];
            $delResult = mysqli_query($dbConnection, $delSql);
        } else {
            echo 'message not sent';
        }
    }
}






//// multiple recipients
//$to  = 'hhro@yahoo.com' . ', '; // note the comma
//$to .= 'hhropp@mail.ru';
//
//// subject
//$subject = 'Birthday Reminders for August';
//
//// message
//$message = '
//<html>
//<head>
//  <title>Birthday Reminders for August</title>
//</head>
//<body>
//  <p>Here are the birthdays upcoming in August!</p>
//  <table>
//    <tr>
//      <th>Person</th><th>Day</th><th>Month</th><th>Year</th>
//    </tr>
//    <tr>
//      <td>Joe</td><td>3rd</td><td>August</td><td>1970</td>
//    </tr>
//    <tr>
//      <td>Sally</td><td>17th</td><td>August</td><td>1973</td>
//    </tr>
//  </table>
//</body>
//</html>
//';
//
//// To send HTML mail, the Content-type header must be set
//$headers  = 'MIME-Version: 1.0' . "\r\n";
//$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
//
//// Additional headers
//$headers .= 'To: yah <hhro@yahoo.com>, pp <hhropp@mail.ru>' . "\r\n";
//$headers .= 'From: Birthday Reminder <birthday@example.com>' . "\r\n";
//$headers .= 'Cc: hhro@yahoo.com' . "\r\n";
//$headers .= 'Bcc: hhropp@mail.ru' . "\r\n";
//
//// Mail it
//;
//
//
//if( mail($to, $subject, $message, $headers) ){