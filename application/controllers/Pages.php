<?php defined('BASEPATH') OR exit('No direct script access allowed');
	class Pages extends CI_Controller{

		public function view($page = 'welcome_message'){
			if(!file_exists(APPPATH.'views/pages/'.$page.'.php')){
				show_404();
			}
			$data['title'] = ucfirst($page);
			$data['titulo_de_pagina'] = 'Sistema de administración de protocolos';

			$this->load->helper('url');
			$this->load->view('templates/header',$data);
			$this->load->view('pages/'.$page, $data);
			$this->load->view('templates/footer');
		}
	}