<?php

class Upload extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
	}

	function index()
	{
		$this->load->view('upload_form', array('error' => ' ' ));
	}

	function email(){
		$this->load->library('email');
		$config['protocol']    = 'smtp';
        $config['smtp_host']    = 'mail.kemlu.go.id';
        $config['smtp_port']    = '25'; 
        $config['smtp_user']    = 'user.test1@kemlu.go.id';
        $config['smtp_pass']    = 'P@ssw0rd';
        $config['charset']    = 'iso-8859-1';
        $config['newline']    = "\r\n";
        $config['mailtype'] = 'html'; // or html
        $config['validation'] = TRUE; // bool whether to validate email or not      
				
		$this->email->initialize($config);
		$this->email->from('user.test1@kemlu.go.id', 'Contoh Admin Email Edisposisi');
		$this->email->to('puspa.bangun@kemlu.go.id');
		//$this->email->cc('another@another-example.com');
		//$this->email->bcc('them@their-example.com');
		
		$this->email->subject('Email Test');
		$this->email->message('Testing the email class.');
		
		if (!$this->email->send()){
			echo "email gagal";
		}else {
			echo "email berhasil";
			
		}
	}
	function do_upload()
	{
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = '*';
		$config['max_size']	= '100';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';

		$this->load->library('upload', $config);
		$this->upload->initialize($config);

		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());

			$this->load->view('upload_form', $error);
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());

			$this->load->view('upload_success', $data);
		}
	}
}
?>