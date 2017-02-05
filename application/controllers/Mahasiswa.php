<?php defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH . '/libraries/REST_Controller.php';

// use namespace
use Restserver\Libraries\REST_Controller;

/**
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array
 *
 * @package         CodeIgniter
 * @subpackage      Rest Server
 * @category        Controller
 * @author          Phil Sturgeon, Chris Kacerguis
 * @license         MIT
 * @link            https://github.com/chriskacerguis/codeigniter-restserver
 */
class Mahasiswa extends REST_Controller
{

	public function __construct($config = 'rest')
	{
		parent::__construct($config);
	}

	// show data mahasiswa
	public function index_get()
	{
		$mahasiswa = $this->db->get('mahasiswa')->result();
		$this->response($mahasiswa, REST_Controller::HTTP_OK);
	}

	// insert new data to mahasiswa
	public function index_post()
	{
		$nim     = $this->post('nim');
		$nama    = $this->post('nama');
		$jurusan = $this->post('jurusan');
		$alamat  = $this->post('alamat');

		$data = array(
			'nim'        => $nim,
			'nama'       => $nama,
			'id_jurusan' => $jurusan,
			'alamat'     => $alamat
		);

		// masukkan ke database
		$insert = $this->db->insert('mahasiswa', $data);

		if ($insert) {
			$this->response($data, REST_Controller::HTTP_CREATED);
		} else {
			$this->response(array('status'=>'fail', REST_Controller::HTTP_BAD_GATEWAY));
		}
	}

	// update data mahasiswa
	public function index_put()
	{
		$nim = $this->put('nim');
		$data = array(
			'nama'       => $this->put('nama'),
			'id_jurusan' => $this->put('jurusan'),
			'alamat'     => $this->put('alamat')
		);

		$this->db->where('nim', $nim);

		$update = $this->db->update('mahasiswa', $data);

		if ($update) {
			$this->response($data, REST_Controller::HTTP_OK);
		} else {
			$this->response(array('status'=>'fail', REST_Controller::HTTP_BAD_GATEWAY));
		}
	}

	// delete mahasiswa
	public function index_delete()
	{
		$nim = $this->delete('nim');
		
		$this->db->where('nim', $nim);

		$delete = $this->db->delete('mahasiswa');

		if ($delete) {
			$this->response(array('status'=>'success', REST_Controller::HTTP_OK));
		} else {
			$this->response(array('status'=>'fail', REST_Controller::HTTP_BAD_GATEWAY));
		}
	}

}

/* End of file Mahasiswa.php */
/* Location: ./application/controllers/Mahasiswa.php */