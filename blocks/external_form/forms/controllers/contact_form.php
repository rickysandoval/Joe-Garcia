<?php 
defined('C5_EXECUTE') or die(_("Access Denied."));
class ContactFormExternalFormBlockController extends BlockController {
	
	public function action_submit_form() {
		
		$e = Loader::helper('validation/error');
		$ip = Loader::helper('validation/ip');		
		$txt = Loader::helper('text');
		$vals = Loader::helper('validation/strings');
		$captcha = Loader::helper('validation/captcha');

		$name = $_POST['name'];
		$email = $_POST['email'];
		$message = $_POST['message'];
		$to = "YOUR_EMAIL_ADDRESS";
		$subject = "YOUR_EMAIL_SUBJECT";
		$wait_time = 60; // Wait time (s) between form re-submissions
		$_SESSION['stamp'] = $_POST['stamp'];
		
		$time = date("H:i:s T O");
		$day = date("l, j F Y");
		$proxy_name = "";
		$proxy_ip = "";
		$host_ip = "";

		// Extract domain names to be banned from email address
		$domainrange = array("YOUR_DOMAIN_NAMES");
		$emailspan = strcspn($email,"@");
		$domain = substr_replace($email,"",0,$emailspan+1);
		$domainspan = strcspn($domain,".");
		$domaincore = substr($domain,0,$domainspan);
		
		// Get sender's IP address and Host Name
		if (getenv('HTTP_X_FORWARDED_FOR')) {
			$proxy_name = getenv('HTTP_VIA');
			$proxy_ip = getenv('REMOTE_ADDR');
			$host_ip = getenv('HTTP_X_FORWARDED_FOR');
		}
		else {
			$host_ip = getenv('REMOTE_ADDR');
		}
		$host = isset($REMOTE_HOST) ? $REMOTE_HOST : @gethostbyaddr($host_ip);
		if($host == $host_ip) {
			$host = getenv('REMOTE_ADDR');
		}
		
		// clean input
		$delete_bcc = array("cc:", "Cc:", "cC:", "bcc:", "Bcc:", "BCc:", "BCC:", "bCc:", "bCC:");
		$name = trim($name);
		$name = preg_replace("/ +/", " ", $name);
		$name = str_replace($delete_bcc, "", $name);
		$email = trim($email);
		$email = preg_replace("/ +/", " ", $email);
		$email = str_replace($delete_bcc, "", $email);
		$message = trim($message);
		$message = preg_replace("/ +/", " ", $message);
		$message = wordwrap($message);
		$message_html = str_replace("\r","<br />",$message);
		
		// Build text part of email
		$txt_message = "Date: $time $day\r\n";
		$txt_message .= "Host IP: $host_ip\r\n";
		$txt_message .= "Host Name: $host\r\n";
		$txt_message .= "Proxy IP: $proxy_ip\r\n";
		$txt_message .= "Proxy Name: $proxy_name\r\n\r\n";
		$txt_message .= "Name: $name\r\n";
		$txt_message .= "Email: $email\r\n";
		$txt_message .= "Subject: $subject\r\n\r\n";
		$txt_message .= "Message:\r\n\r\n";
		$txt_message .= $message;
  
		// Build html part of email
		$html_message = "<html><body>";
		$html_message .= "<font color=\"red\">";
		$html_message .= "Date: $time $day<br />";
		$html_message .= "Host IP: $host_ip<br />";
		$html_message .= "Host Name: $host<br />";
		$html_message .= "Proxy IP: $proxy_ip<br />";
		$html_message .= "Proxy Name: $proxy_name<br /><br />";
		$html_message .= "</font>";
		$html_message .= "<font color=\"blue\">";
		$html_message .= "Name: $name<br />";
		$html_message .= "Email: $email<br />";
		$html_message .= "Subject: $subject<br /><br />";
		$html_message .= "</font>";
		$html_message .= "<font color=\"navy\">";
		$html_message .= "<u>Message:</u><br /><br />";
		$html_message .= $message_html;
		$html_message .= "</font>";
		$html_message .= "</body></html>";

		$error_msg = '<div id="error_msg">If you are experiencing problems submitting the form please send an email with your query to <b>'.$to.'</b>.</div><hr />';
		$no_error_msg = '<div id="noerror">Thank you for your inquiry.</div><hr />';
		
		if (!$ip->check()) {
			$e->add($ip->getErrorMessage());
		}		
		
		if (!$captcha->check()) {
			$e->add(t('Incorrect image validation code. Please check the image and re-enter the code.'));
			$_REQUEST['ccmCaptchaCode']='';
		}
		
		if (strlen($name) < 2) {
			$e->add(t('Name must be at least %s characters long.', 2));
		}
	
		if (strlen($name) > 70) {
			$e->add(t('Name cannot be more than %s characters long.', 70));
		}
		
		if (!$vals->email($email)) {
			$e->add(t('Invalid email address provided.'));
		}
		
		if (strlen($message) < 2) {
			$e->add(t('Message must be at least %s characters long.', 2));
		}
	
		if (strlen($message) > 3000) {
			$e->add(t('Message cannot be more than %s characters long.', 3000));
		}
		
		// Prevent hijackers from using your own domain name
		if (in_array($domaincore, $domainrange)) {
			$e->add(t('To prevent form spam and injection attacks, '.$domain.' email address is not allowed.'));
		}
		
		// Prevent multiple automatic form submissions
		$submit_time = time(); // Get time stamp
		if ($submit_time < (trim($_SESSION['stamp']) + $wait_time)) {
			$e->add(t('This form has already been recently submitted.'));
		}
		// Check if given domain name exists
		if (!checkdnsrr("$domain","MX")) {
			$e->add(t($domain.' does not seem to be a valid domain.'));
		}

		if (!$e->has()) {
			Loader::library('3rdparty/Zend/Mail');
			$zm = new Zend_Mail(APP_CHARSET);
			$zm->setSubject($subject);
			$zm->setBodyText($txt_message);
			$zm->setBodyHtml($html_message);
			$zm->addTo($to);
			$zm->setFrom($email);
			$zm->send();
			$_SESSION['stamp'] = time();
			$this->set('no_error_msg', $no_error_msg);
			return true;
		} else {
			$errors = $e->getList(); 
			$this->set('errors', $errors);
			$this->set('error_msg', $error_msg);
		}
		
	}

}