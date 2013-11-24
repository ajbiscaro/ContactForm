<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/
xhtml1-transitional.dtd">

<!--
/**
 * Contact Form View
 * View for sending email using gmail smtp.
 * @File name: contact_form.php
 * @Version: 1.0 (October 29, 2013)
 * @copyright Copyright (C) Ardel John Biscaro
 * @link http://ajbiscaro.net84.net
 **/
-->
<html lang="en-US"><head>	<title>Contact Form</title>
	<meta charset="UTF-8">
	<LINK href=<?php echo base_url()."assets/css/bootstrap.css" ?> rel="stylesheet" type="text/css">
	<LINK href=<?php echo base_url()."assets/css/styles.css" ?> rel="stylesheet" type="text/css">
</head><body>

	<div id="wrap">
	
		<div id="validationMessage"><?php echo validation_errors(); ?></div>
		<div id="flashMessage"><?php echo $this->session->flashdata('message');?></div>
		
		<h2>Contact Form</h2>
		
		<?php echo form_open('contact_form/sendMail'); ?>
		
			<div id="input-name">
				<?php echo form_label('Name: *', 'name'); ?>
				<?php echo form_input('name', set_value('name', $name)); ?>
			</div>
			
			<div id="input-email">
				<?php echo form_label('Email: *', 'email'); ?>
				<?php echo form_input('email', set_value('email', $email)); ?>
			</div>
		
			<div id="input-subject">
				<?php echo form_label('Subject:', 'subject'); ?>
				<?php echo form_input('subject', set_value('subject', $subject)); ?>
			</div>
		
			<div id="input-message">
				<?php echo form_label('Message: *', 'message'); ?>
				<?php echo form_textarea('message', set_value('message', $message)); ?>
			</div>
			
			<div id="input-send">
				<?php echo form_submit('send', 'Send','class="btn"'); ?>
			</div>
			
		<?php echo form_close(); ?>
		
	</div>	

</body>
</html>