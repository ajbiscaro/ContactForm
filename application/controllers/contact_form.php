<?php
/**
 * Contact Form Controller
 * Controller for sending email using gmail smtp.
 * @File name: contact_form.php
 * @Version: 1.0 (October 29, 2013)
 * @copyright Copyright (C) Ardel John Biscaro
 * @link http://ajbiscaro.net84.net
 **/
 
class Contact_form extends CI_Controller {
	
	function Contact_form()
	{
		// load controller parent
		parent::__construct();
	}

	function index() 
	{
		//initialize form fields values
		$data['name'] = '';
		$data['email'] = '';
		$data['subject'] = '';
		$data['message'] = '';
		
		//load the view
		$this->load->view('contact_form', $data);
	}
	
	function sendMail()
	{
	
		//get form post values
		$name = $this->input->post('name');	
		$fromEmail = $this->input->post('email');
		$subject = $this->input->post('subject');
		$message = $this->input->post('message');

		//load form validation library
		$this->load->library('form_validation');
		
		//set rules for form fields validation
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('message', 'Message', 'trim|required|xss_clean');
	
		if($this->form_validation->run() == FALSE) {
		
			$data['name'] = $name;
			$data['email'] = $fromEmail;
			$data['subject'] = $subject;
			$data['message'] = $message;
			
			$this->load->view('contact_form', $data);
		}else{
		
			//configuration for sending mail using gmail smtp
			$config = Array(
				'protocol' => 'smtp',
				'smtp_host' => 'ssl://smtp.googlemail.com',
				'smtp_port' => 465,
				'smtp_user' => 'youremail@gmail.com', // change it to your gmail account
				'smtp_pass' => 'yourpassword', // change it to your gmail account password
				'mailtype' => 'html',
				'charset' => 'iso-8859-1',
				'wordwrap' => TRUE
			);
			
			//load email library
			$this->load->library('email', $config);
			
			//set email values
			$this->email->set_newline("\r\n");
			$this->email->from($fromEmail); // set entered email as the sender email
			$this->email->to('youremail@gmail.com'); // change it to your receiving gmail account
			$this->email->subject($subject);
			$this->email->message( $message.' from '.$name.' ( '.$fromEmail.' ) ' );
		
		  	if($this->email->send()){
				$this->session->set_flashdata('message', 'Your email has been sent!');
				redirect('/contact_form/index');
		 	}else{
		 		show_error($this->email->print_debugger());
			}
			
		}

	}
					
}