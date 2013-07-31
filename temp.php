<?

$ContactEmail = "ravibthakkar@gmail.com";



 $format = "text/html";
        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: " . $format . "; charset=iso-8859-1\r\n";
        $from = "steveamillion@gmail.com";
        $to = $ContactEmail;
        $subject = "We could not recover " . $_REQUEST['activityType'] . " - " . $_REQUEST['activityId'];
        
        
        $content.="Hello Admin,<br/><br/>We could not recover ";
        $content.=$_REQUEST['activityType'] . " - " . $_REQUEST['activityId'];
        $content.="<br/><br/>For more details click <a href='http://k7radiothon.com/dev/recover-activity.php?id=" . $_REQUEST['activityId'] . "&activity=" . $_REQUEST['activityType']."'>here</a>";

        
        $headers .= "From: $from\r\n";
        $state = @mail($to, $subject, $content, $headers);
?>