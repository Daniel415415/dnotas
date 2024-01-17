<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Inicio extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		// $this->load->helper('form');
		$this->load->model('notas_model');
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->library('encryption');
		$usid = $this->session->userdata('id');
		// $this->load->library('table');
	}
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		//$this->load->view('welcome_message');
		//$this->load->view('header');
		if($this->session->has_userdata('id')){
			$nom_us = $this->session->userdata('nombre');
			// var_dump($nom_us);
			// die();
			$this->load->view('notas', ['nom_us' => $nom_us]);
		}else{
			$this->load->view('login');
		}

	
		//$this->load->view('footer');
	}
	public function login()
	{

		$correo = $this->input->post('email');
		$contraseña = $this->input->post('password');

		$res = $this->notas_model->consultar_usuario($correo, $contraseña);
		if (count($res)) {
			$this->session->set_userdata('nombre', $res[0]->nombre_us);
			$this->session->set_userdata('id', $res[0]->id_us);
			echo 'true';
		} else {
			echo 'false';
		}
	}
	public function notas()
	{
		if ($this->session->userdata('nombre')) {
			$nom_us = $this->session->userdata('nombre');
			// var_dump($nom_us);
			// die();
			$this->load->view('notas', ['nom_us' => $nom_us]);
		} else {
			redirect(site_url('inicio'));
		}
	}
	public function cerrarSesion()
	{
		$this->session->sess_destroy();

		redirect(site_url('inicio'));
	}
	public function tabla()
	{
		$this->load->view('tabla');
	}
	public function mis_notas()
	{
		$id_cat = '';
		if ($this->input->post('id_cat')) {
			$id_cat = $this->input->post('id_cat');
		}

		$data = $this->notas_model->obtenerNotas($this->session->userdata('id'), $id_cat);

		echo json_encode($data);
	}
	public function mis_notas_borradas()
	{
		$data = $this->notas_model->obtenerNotasBorradas($this->session->userdata('id'));

		echo json_encode($data);
	}
	public function agregar_nota()
	{
		if ($this->input->post('id_usuario') != 1) {
			$data = array(
				'titulo_nota' => $this->input->post('titulo_nota'),
				'descripcion_nota' => $this->input->post('descripcion_nota'),
				'id_usuario' => $this->session->userdata('id')
			);
		} else {
			$data = array(
				'titulo_nota' => $this->input->post('titulo_nota'),
				'descripcion_nota' => $this->input->post('descripcion_nota'),
				'id_usuario' => $this->input->post('id_usuario')
			);
		}



		$this->notas_model->insertarNota($data);
		$res = $this->notas_model->seleccionarUltimaNota($this->session->userdata('id'));
		
		$this->output->set_content_type('application/json')->set_output(json_encode($res));
	}
	public function actualizar_nota()
	{

		$id_nota = $this->input->post('id_nota');
		$data = array(
			'titulo_nota' => $this->input->post('titulo_nota'),
			'descripcion_nota' => $this->input->post('descripcion_nota'),
		);

		$res = $this->notas_model->updateNota($id_nota, $data);

		//echo $res;

	}
	public function actualizar_nota_borrado()
	{

		$id_nota = $this->input->post('id_nota');
		$data = array(
			'eliminada' => 'si'
		);

		$res = $this->notas_model->updateNota($id_nota, $data);

		//echo $res;

	}
	public function borrar_nota()
	{

		$id_nota = $this->input->post('id_nota');




		$this->notas_model->eliminarNota($id_nota);

		//echo $res;
	}
	public function pruebas()
	{
		$this->load->view('welcome_message');
	}
	public function materi()
	{

		$this->load->view('material');
	}
	public function upload()
	{
		var_dump($_FILES);
		if (!empty($_FILES['filepond']['name'])) {

			// Set preference
			$config['upload_path'] = 'upload/';
			$config['allowed_types'] = 'jpg|jpeg|png|gif';
			$config['max_size'] = '1024'; // max_size in kb
			$config['file_name'] = $_FILES['filepond']['name'];

			//Load upload library
			$this->load->library('upload', $config);

			// File upload
			if ($this->upload->do_upload('filepond')) {
				// Get data about the file
				$uploadData = $this->upload->data();
			}
		}
	}
	public function registro()
	{

		
		$data = array(
			'nombre_us' => $this->input->post('nombre'),
			'correo' => $this->input->post('correo'),
			'contraseña' => $this->input->post('passw2'),
			'telefono' => $this->input->post('telefono')
		);

		$exis = $this->notas_model->consultar_usuario($data["correo"], $data["contraseña"]);
		if(count($exis)){
			return false;
		}
		else{
			$res = $this->notas_model->insertarUsuario($data);

			return 'ok';
		}

		//var_dump($data);
		
	}

	public function obtener_categorias()
	{
		$id_usuario = $this->session->userdata('id');
		$data = $this->notas_model->obtenerCategorias($id_usuario);

		$this->output->set_content_type("application/json")->set_output(json_encode($data));
	}

	public function asignar_categoria()
	{
		$data = array(
			'id_categoria' => $this->input->post('id_categoria'),
			'id_usuario' => $this->session->userdata('id'),
			'id_nota' => $this->input->post('id_nota')
		);

		$res = $this->notas_model->asignarCategoria($data);
	}


	public function obtener_todas()
	{

		$response = [
			'rows' => [],
			'total' => 0,
		];

		$get = $this->input->get();

		$filtros = $get;

		$filtros['offset'] = isset($filtros['offset']) ? $filtros['offset'] : 0;
		$filtros['limit'] = isset($filtros['limit']) ? $filtros['limit'] : 5;

		//var_dump($filtros);die();
		$datos = $this->notas_model->obtener_todas_notas($filtros);

		//return $this->output->set_content_type("application/json")->set_output(json_encode($candidatos['resultArray']));

		foreach ($datos['resultArray'] as $dato) {

			$element = [
				'titulo' => $dato['titulo_nota'],
				'descripcion' => $dato['descripcion_nota'],
				'id' => $dato['id_nota'],

			];

			array_push($response['rows'], $element);
		}

		$response['total'] = $datos['total'];

		$this->output->set_content_type("application/json")->set_output(json_encode($response));
	}

	public function agregar_categoria()
	{
		$data = array(
			'nombre_cat' => $this->input->post('nombre_cat'),
			'id_usuario' => $this->session->userdata('id'),
			'color_cat' => $this->input->post('color_cat')
		);

		$res = $this->notas_model->insertarCategoria($data);

		echo $res;
	}

	public function eliminar_categoria()
	{
		$eliminar_notas_cat = $this->input->post('eliminar_notas_cat');
		$id_categoria = $this->input->post('id_categoria');
		$id_usuario = $this->session->userdata('id');

		if ($eliminar_notas_cat == 'true') {
			$this->notas_model->eliminarNotasCategoria($id_categoria, $id_usuario);
		}
		$res = $this->notas_model->eliminarCat($id_categoria, $id_usuario);

		echo $res;
	}
	public function crear_txt()
	{
		$titulo = $this->input->post('titulo');
		$descripcion = $this->input->post('descripcion');
		$fecha = $this->input->post('fecha');


		$file = fopen("upload/archivo.txt", "a");

		fwrite($file, $fecha . PHP_EOL);

		fwrite($file, $titulo . PHP_EOL);

		fwrite($file, $descripcion . PHP_EOL);

		fclose($file);
	}

	public function crearpdf()
	{
		$titulo=$this->input->post('titulo');
		$descripcion=$this->input->post('descripcion');
		$fecha=$this->input->post('fecha');

		$titulo?$titulo:$titulo="Sin titulo";
		$descripcion?$descripcion:$descripcion="Sin descripcion";
		$fecha?$fecha:$fecha="Sin fecha";
		$mpdf = new \Mpdf\Mpdf();
		$mpdf->WriteHTML('<body style="background-color:#faeb76;">');
		$mpdf->WriteHTML('<h4 align="left">'.$fecha.'</h4>');
		$mpdf->WriteHTML('<h1 align="center">'.$titulo.'</h1>');
		
		$mpdf->WriteHTML('<hr></hr>');
		$mpdf->WriteHTML('<p align="justify">'.$descripcion.'</p>');
		$mpdf->WriteHTML('</body>');
		$mpdf->Output();
	}
}
