<?php

class Emailer
{
    public function compile($variables, $template_file)
    {
        if(!file_exists($template_file))
        {
            echo $template_file."</br>";
            echo getcwd();
            trigger_error('Template File not found!',E_USER_ERROR);
            return;
        }
        $this->template = file_get_contents($template_file);
        $this->emailTo = $variables['email_to'];
        $this->emailSubject = $variables['event_name'];
        $headers[] = 'MIME-Version: 1.0';
        $headers[] = 'Content-type: text/html; charset=iso-8859-1';
        $headers[] = 'From: ' . $variables['email_from'];
        $headers[] = 'Reply-To: ' . $variables['email_from'];
        $headers[] = 'Cc: ' . $variables['cc_email'];
        $headers[] = 'X-Mailer: PHP/' . PHP_VERSION;
        $this->headers = implode("\r\n", $headers);
        $email_contents = $this->template;
        foreach($variables as $key => $value)
        {
            $email_contents = str_replace('{{ '.$key.' }}', $value, $email_contents);
        }
        $this->email_contents = $email_contents;
    }

    public function send($verbose = False)
    {
        $this->sent = mail($this->emailTo, $this->emailSubject, $this->email_contents, $this->headers);
        // display results if verbose is set to true
        if ($verbose && (! $this->sent))
        {
            $this->$last_error = error_get_last()['message'];
            echo $this->$last_error;
        } 
        elseif ($verbose && ($this->sent))
        {
            echo "Sent";
        }
        return $this->sent;
    }

}

?>