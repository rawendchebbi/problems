<?php


class Mail
{
    private $authentication = true;
    private $host = '192.168.1.33';
    private $user = 'user';
    private $password = 'pAss12345';

    public function setAuthentication($authentication)
    {
        $this->authentication = $authentication;
    }

    public function setHost($host)
    {
        $this->host = $host;
    }

    public function setUser($user)
    {
        $this->user = $user;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    private function sendEmail($to, $subject, $body, $is_html = false, Array $para_cc = array(), Array $para_bcc = array())
    {
        //Simulation sending the email
        $success = true; 

        if ($success) {
            echo "Mail has been sent successfully\n";
        } else {
            echo "Failed to send mail\n";
            // You can throw an exception here if needed
        }
    }
}

class EmailSender
{
    private $mailer;

    public function __construct(Mail $mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendRegistrationEmail($to, $name)
    {
        $this->mailer->setHost('192.168.1.66');
        $this->mailer->setUser('registration');
        $this->mailer->setPassword('r3g1str0');
        $this->mailer->setAuthentication(true);

        
        $subject = 'Welcome to our Web App';
        $body = "<p>Welcome <strong>$name</strong>,</p>";
        $body .= "<p>Your registration has been successfully completed.</p>";
        $body .= "<p>We hope that our services will be to your liking.</p>";
        $body .= "<p>Best regards</p>";

        $this->mailer->sendEmail($to, $subject, $body, true);
    }

    
}



?>