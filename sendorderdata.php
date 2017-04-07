<?php 
require_once('resources/db/db_connect.php');
//Send e-mail to customer
$mail_error_msg = "null";

if (isset($_POST['summ']) && isset($_POST['data']) && isset($_POST['email'])){
    
    $summary = $_POST['summ'];
    $data = $_POST['data'];
    $email = $_POST['email'];
    $header = "MIME-Version:1.0" . "\r\n";
    $header .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    
    ini_set('SMTP', "relay-hosting.secureserver.net");
    ini_set('sendmail_from', "contact@sonofiroko.com");
    
    try{
        $to = $email;
        $message = '<html><head><title>We received your order!</title></head><body>' .
            $summary . '<br/><br/>' . 
            '<p><em>Regards,</em><br/><em>Segun</em></p><br/><br/>' .
            '<div style="width:100%;text-align:center;display:block;">' .
            '&copy; 2017 <a style="color:black;font-size:small;display:inline-block;" href="http://www.sonofiroko.com">SonOfIroko</a> Inc. | US-NG</div>' .
            '</body></html>';
        
        $message = wordwrap($message, 70);
        mail($to, 'SonOfIroko Store: We received your order!', $message, $header);
        echo "mail OK";
    }catch (Exception $e){
        $mail_error_msg = $e->getMessage();
        echo $mail_error_msg;
    }
    
    
    //Write transaction data to database
    try{
        $date = getdate();
        $date = $date['year'] . '-' . $date['mon'] . '-' . $date['mday'];

        $insert_query = 'INSERT INTO Sale (email, date, data)'.
            ' VALUES (?,?,?)';

        $stmt = $conn->prepare($insert_query);
        $stmt->bind_param('sss',$email, $date, $data);
        $stmt->execute();
        echo "db OK";
    }catch (Exception $e){
        echo $e->getMessage();
    }finally{
        $stmt->close();
        $conn->close();
    }
}
?>

