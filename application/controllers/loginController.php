<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class loginController extends CI_Controller {

    public function __construct()
	{
		parent::__construct();
		$this->load->model('clienteModel');
		$this->load->model('loginModel');
		$this->load->helper(array('form','url'));
		$this->load->library('form_validation');
		$this->output->set_header("Access-Control-Allow-Origin:*");
		
	}
    

	public function index()
	{
		$this->load->view('inicio/inicio1.php');
    }
    
    public function login(){
        $this->session->sess_destroy();
        $this->load->view('login/login.php');
    }

    public function volver(){
        $this->load->view('inicio/inicio1.php');
    }

    public function ingresar(){
        $this->loginModel->crearSesion();

            $this->load->view('layout/menu');
            $this->load->view('layout/header');
            $this->load->view('contador/inicio.php');
            $this->load->view('layout/footer');
            
    }

    public function ingresar1(){

             $usuario = $this->input->post('usuario');
            $password = $this->input->post('password');

            if($usuario == "admin" || $password == "admin"){
                $this->loginModel->crearSesion();

                $this->load->view('layout/menu');
                $this->load->view('layout/header');
                $this->load->view('contador/inicio.php');
                $this->load->view('layout/footer');
            }else{
                 if(isset( $this->loginModel->validar($usuario ,$password)['0']->nombre )) {
                    $dato['usuario'] = $this->loginModel->obtenerCliente($this->session->userdata('idCliente'));
                    $this->load->view('layout/menu1');
                    $this->load->view('layout/header1');
                    $this->load->view('cliente/inicio.php',$dato);
                    $this->load->view('layout/footer');
                }else{
                    $dato['mensaje'] = "USUARIO O CLAVE INCORRECTA" ;
                    $this->load->view('login/login.php', $dato);
                }
            }
           
           

       /* 
       
       */
}

    




}