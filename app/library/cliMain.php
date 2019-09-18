<?php

class cliMain
{
  public function CheckLog()
    {
        
        $date = Date('d-m-Y',strtotime('-1 days')); 
        $errorlog = DpLog::find("'createdOn'=".$date );   
        if (count($errorlog) == 0) 
        { 
            
            $errors = "NO new errors were generated on ". $date;
            
        }else
        {    
            $errors = "Following new errors were generated on ". $date.": \n\n";
            foreach($errorlog as $error)
            {
                
            $errors .= $error->id."\t".$error->applicationName."\t".$error->source."\t".$error->instanceId."\t".$error->Message."\t".$error->stackTrace."\t".$error->createdOn ."\n\n";
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
}