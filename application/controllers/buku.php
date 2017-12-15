<?php
//memanggil library rest
require APPPATH . '/libraries/REST_Controller.php';
//membuat controller
class Buku extends Rest_Controller{
	function __contruct($config="rest")
	{
		parent:: __contruct($config);
	}

	// show data buku
	function index_get(){
		// colection data buku
		// $buku = array
		// 	('kode_buku'=>'BK01',
		// 		'judul'=>'spiderman back to school',
		// 		'harga'=> 40000,
		// 		'penulis'=>'Irfan Prakoso');
				
		$buku = $this->db->get('buku')->result();
			// menampilkan response
				$this->response($buku,200);
	}

	//insert new data buku
	function index_post(){
		$data = array(
			'kode_buku'		=> $this->post('kode_buku'),
			'judul_buku'	=> $this->post('judul_buku'),
			'harga'			=> $this->post('harga'),
			'penulis'		=> $this->post('penulis'));
		$insert = $this->db->insert('buku',$data);
		if($insert){
			$this -> response($data,200);
		}else{
			$data = array('status'=>'Gagal Insert');
			$this->response($data,200);
		}
	}

	// update data buku-----
	function index_put(){
		$kode_buku = $this->put('kode_buku');
		$data = array(
			'kode_buku'		=> $this->put('kode_buku'),
			'judul_buku'	=> $this->put('judul_buku'),
			'harga'			=> $this->put('harga'),
			'penulis'		=> $this->put('penulis'));
		$this->db->where('kode_buku',$kode_buku);
		$update = $this->db->update('buku', $data);
		if ($update) {
			$this->response($data, 200);
		} else {
			$this->response(array('status' => 'fail', 502));
		}
	}

	// delete data buku
	function index_delete(){
		$kode_buku = $this->delete('kode_buku');
		$this->db->where('kode_buku',$kode_buku);
		$delete = $this->db->delete('buku');
		if($delete) {
			$this->response(array('status'=>'success'), 201);
		} else {
			$this->response(array('status'=> 'fail',502));
		}
	}


}
?>