<?php 
defined('C5_EXECUTE') or die(_("Access Denied."));
?>

<style>
#contact_form form {
border: 0px;
padding: 0px;
}

#contact_form form div {
clear: both;
margin-bottom: 1px;
padding-bottom: 5px;
}

#contact_form form label {
display: block;
float: left;
width: 80px;
padding-left: 22px;
font-weight: bold;
}

#contact_form form img {
margin-left: 102px;
}

#contact_form form input, textarea {
border: 1px solid #771100;
}

#contact_form form input:focus, textarea:focus {
border: 1px solid red;
}

#submitdiv {
margin-left: 102px;
margin-bottom: 1px;
padding-bottom: 5px;
}

#contact_form form label.required {
background-repeat: no-repeat;
background-position: 3px 0px;
padding-bottom: 1px;
color: #771100;
}

#contact_form form label.problem {
background-repeat: no-repeat;
background-position: 3px 0px;
padding-bottom: 1px;
color: red;
}

#contact_form form label.completed {
background-repeat: no-repeat;
background-position: 3px 0px;
padding-bottom: 1px;
color: #000000;
}

#error {
color: red;
font-weight: bold;
font-size: 8pt;
}

#noerror {
color: #771100;
font-weight: bold;
font-size: 8pt;
}
</style>

<script language="javascript">
function getLabelForId(id) {
    var label, labels = document.getElementsByTagName('label');
    for (var i = 0; (label = labels[i]); i++) {
        if (label.htmlFor == id) {
            return label;
        }
    }
    return false;
}
function check(id) {
    var formfield = document.getElementById(id);
    var label = getLabelForId(id);
    if (formfield.value.length == 0) {
        label.className = 'problem';
				formfield.style.background = "#CCCCFF";
    } 
		else {
        label.className = 'completed';
				formfield.style.background = "#FFFFFF";
    }
}
addEvent(window, 'load', function() {
    var input;
    var inputs = document.getElementsByTagName('input');
    for (var i = 0; (input = inputs[i]); i++) {
        addEvent(input, 'focus', oninputfocus);
        addEvent(input, 'blur', oninputblur);
    }
    var textareas = document.getElementsByTagName('textarea');
    for (var i = 0; (textarea = textareas[i]); i++) {
        addEvent(textarea, 'focus', oninputfocus);
        addEvent(textarea, 'blur', oninputblur);
    }
});
function oninputfocus(e) {
    if (typeof e == 'undefined') {
        var e = window.event;
    }
    var source;
    if (typeof e.target != 'undefined') {
        source = e.target;
    } 
		else if (typeof e.srcElement != 'undefined') {
        source = e.srcElement;
    } 
		else {
        return;
    }
    source.style.border='1px solid red';
}
function oninputblur(e) {
    if (typeof e == 'undefined') {
        var e = window.event;
    }
    var source;
    if (typeof e.target != 'undefined') {
        source = e.target;
    }
		else if (typeof e.srcElement != 'undefined') {
        source = e.srcElement;
    }
		else {
        return;
    }
    source.style.border='1px solid #771100';
}
function addEvent(obj, evType, fn) {
    if (obj.addEventListener) {
        obj.addEventListener(evType, fn, true);
        return true;
    } 
		else if (obj.attachEvent) {
        var r = obj.attachEvent("on"+evType, fn);
        return r;
    } 
		else {
        return false;
    }
}
function checkField(field, msg, max) {
   min = 2;
   if (!field.value || field.value.length < min || field.value.length > max) {
	    alert(msg);
			field.focus();
			field.select();
			field.style.background = "#CCCCFF";
			return false;
	 }
   return true;
}
function checkEmail(field, msg, max) {
   min = 8;
   var re_mail = /^([_a-zA-Z0-9-]+)(\.[_a-zA-Z0-9-]+)*@([a-zA-Z0-9-]+)(\.[a-zA-Z0-9-]+)*(\.[a-zA-Z]{2,6})$/;
   if (!re_mail.test(field.value) || field.value.length < min || field.value.length > max) {
	   alert(msg);
		 field.focus();
		 field.select();
		 field.style.background = "#CCCCFF";
		 return false;
	 }
   return true;
}
</script>

<?php
$form = Loader::helper('form');

// Analise entered data after Submit button has been clicked
if(isset($no_error_msg)) { ?>
	<div id="noerror">
	<?php echo $no_error_msg; ?>
	</div>
<?php 
}

elseif(isset($errors)) { ?> 
	<div id="error">
	<ul class="errors"> 
	<?php foreach($errors as $error){ ?> 
		<li><?php echo $error; ?></li> 
	<?php } ?>  
	</ul>
	</div>
<?php 
	if(isset($error_msg)) {
		echo $error_msg;
	}
} ?>

<div id="contact_form">
<form action="<?php echo $this->action('submit_form')?>" 
	method="post" 
	onsubmit="return (checkField(this.name, 'Please enter your name\n(2-100 characters)', 70) && 
	checkEmail(this.email, 'Please enter your valid email address\n(8-100 characters)', 100) && 
	checkField(this.ccmCaptchaCode, 'Please enter image validation code\n(5 characters)', 5) && 
	checkField(this.message, 'Please enter your message\n(2-3000 characters)', 3000));" >
<div>	
<?php
//print $form->label('name', t('Name: '));
//print $form->text('name', $name, array('maxlength' => 70, 'size' => 40, 'onblur' => "check('name');"));
?>
<label for="name" class="required">Name:</label> 
<input type="text" id="name" name="name" value="" maxlength="70" size="40" onblur="check('name');" />
</div>
<div>	
<?php
//print $form->label('email', t('Email: '));
//print $form->text('email', "", array('maxlength' => 100, 'size' => 40, 'onblur' => "check('email');"));
?>
<label for="email" class="required">Email:</label> 
<input type="text" id="email" name="email" value="" maxlength="100" size="40" onblur="check('email');" />
</div>
<div>	
<?php
//print $form->label('message', t('Message: '));
//print $form->textarea('message', "", array('cols' => 60, 'rows' => 10, 'onblur' => "check('message');"));
?>
<label for="message" class="required">Message:</label> 
<textarea id="message" name="message" value="" cols="60" rows="10" onblur="check('message');"></textarea>
</div>
<div>	
<?php
$captcha = Loader::helper('validation/captcha');
$captcha->display();
?>
</div>
<div>	
<?php
//print $form->label('ccmCaptchaCode', t('Verify: '));
//$captcha->showInput();
?>
<label for="ccmCaptchaCode" class="required">Verify:</label>
<input type="text" id="ccmCaptchaCode" name="ccmCaptchaCode" value="" maxlength="5" size="10" onblur="check('ccmCaptchaCode');" />
</div>
<div id="submitdiv">
<input class="btn" type="submit" name="submit" value="Send" /> 
<input type="hidden" value="<?php echo $_SESSION['stamp'];?>" name="stamp" />
</div>
</form>
</div>