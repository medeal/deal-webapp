<?php
function send_simple_message($from,$to,$subject,$body){  
  $ch = curl_init();
  //from:who sent the mail
			  //to:sent mail to who
			  //subject:mail subject
			  //hmtl:mail body
  curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
  curl_setopt($ch, CURLOPT_USERPWD, 'api:key-965d3a2fd273c7c7d038c54f728ca93a');
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
  curl_setopt($ch, CURLOPT_URL, 
              'https://api.mailgun.net/v3/sandbox4aad892302324b3d96425e04cc06a2b6.mailgun.org/messages');
  curl_setopt($ch, CURLOPT_POSTFIELDS, 
                array('from' => $from,
                      'to' => $to,
                      'subject' => $subject,
                      'html' => $body));
  $result = curl_exec($ch);
  curl_close($ch);
  return $result;
}
//example to send mail:
//echo send_simple_message("lisivo@gmail.com","lisivo@gmail.com","test2","body test");
?>