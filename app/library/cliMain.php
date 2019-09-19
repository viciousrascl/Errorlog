<?php
use Phalcon\Mvc\Model\Criteria;
class cliMain
{
  public function CheckLog()
    {
        
        $date = Date('d-m-Y',strtotime('-1 days')); 
        $errorlog = $this->search($date);   
        if (count($errorlog) == 0) 
        { 
            
            $errors = "NO new errors were generated on ". $date;
            
        }else
        {    
            $errors = "Following new errors were generated on ". $date.": \n\n";
            foreach($errorlog as $error)
            {
                
            $errors .= $error->id."\t".$error->ApplicationName."\t".$error->Source."\t".$error->InstanceId."\t".$error->Message."\t".$error->StackTrace."\t".$error->CreatedOn ."\n\n";
            }
        } 
        
        $this->sendEmail("viciousrascl@gmail.com",("Error Logs Generated On ". $date),$errors);
            
    }

    public function sendEmail($toAddress, $subject, $body)
    {
        $transport = new Swift_SmtpTransport('smtp.gmail.com',587,'tls');
        $transport->setUsername('lifelogclub@gmail.com');
        $transport->setPassword('Snk7c7s12!');
        $transport->setStreamOptions(array('ssl' => array('allow_self_signed' => true, 'verify_peer' => false)));
        $mailer = new Swift_Mailer($transport);
        $message = new Swift_Message($subject);
        $message->setFrom(['lifelogclub@gmail.com' => 'Admin @ lifelog']);
        $message->setTo([$toAddress, $toAddress => $toAddress]);
        $message->setBody($body);
        $result = $mailer->send($message);
        if ($result>0) {
            echo "Email sent successfully ";
        }
        else {
            echo"Unable to complete request, Please try again... ";
        }
    }
    public function search($date)
    {
            $argDate = array([ 
                "id" => "",
                "ApplicationName"=> "",
                "Source" => "",
                "InstanceId" => "",
                "Message" =>  "",
                "StackTrace" => "", 
                "CreatedOn" =>  $date ]);
            $DpLog= new DpLogController;
            $query = Criteria::fromInput($DpLog->di, 'DpLog', $argDate);
            $parameters = $query->getParams();

        if (!is_array($parameters)) {
            $parameters = [];
        }
        $dp_log = DpLog::find($parameters);
            return $dp_log;

    }
}