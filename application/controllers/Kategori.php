<?php
defined('BASEPATH') or exit('No direct script access allowed');
// Don't forget include/define REST_Controller path

/**
 *
 * Controller Kategori
 *
 * This controller for ...
 *
 * @package   CodeIgniter
 * @category  Controller REST
 * @author    Setiawan Jodi <jodisetiawan@fisip-untirta.ac.id>
 * @author    Raul Guerrero <r.g.c@me.com>
 * @link      https://github.com/setdjod/myci-extension/
 * @param     ...
 * @return    ...
 *
 */

use chriskacerguis\RestServer\RestController;

class Kategori extends RestController
{
    
  public function __construct()
  {
    parent::__construct();
    $this->load->model('kategori_model', 'kategori');
    $this->methods['index_get']['limit'] = 100;
  }

  public function index_get(){
    $id = $this->get('id_kategori');
    if ($id===null) {
      $list = $this->kategori->get(null);

      if ($list) {
        $data = [
          'status' => true,
          'data' => $list
        ];
      }
      else {
        $data = ['status'=>false, 'msg'=>'data tidak ditemukan'];
      }

      $this->response($data, RestController::HTTP_OK);
    }
    else {
      $data = $this->kategori->get($id);
      if ($data) {
        $this->response(['status'=>true, 'data'=>$data], RestController::HTTP_OK);
      }
      else {
        $this->response(['status'=>false, 'msg'=>$id.' tidak ditemukan'], RestController::HTTP_NOT_FOUND);
      }
    }
  }

  public function index_post() {
    $data=[
      'nama_kategori'=>$this->post('kategori', true)
    ];

    $simpan=$this->kategori->add($data, true);
    if ($simpan['status']) { //jika berhasil
      $this->response(['status'=>true, 'msg'=>$simpan['data'].' kategori telah ditambahkan'], RestController::HTTP_CREATED);
    }
    else { //jika gagal
      $this->response(['status'=>false, 'msg'=>$simpan['msg']], RestController::HTTP_INTERNAL_ERROR);
    }
  }

  public function index_put() {
    $data=[
      'nama_kategori'=>$this->put('kategori', true)
    ];

    $id=$this->put('id_kategori', true);
    if ($id==null) {
      $this->response(['status'=>false, 'msg'=>'Masukkan id_kategori yang akan diubah'], RestController::HTTP_BAD_REQUEST);
    }

    $simpan=$this->kategori->update($id, $data);
    if ($simpan['status']) { //jika berhasil
      $status = (int)$simpan['data'];
      if ($status>0) {
        $this->response(['status'=>true, 'msg'=>$simpan['data'].'kategori telah diubah'], RestController::HTTP_OK);
      }
      else {
        $this->response(['status'=>false, 'msg'=>'Tidak ada kategori yang diubah'], RestController::HTTP_BAD_REQUEST);
      }
    }
    else { //jika gagal
      $this->response(['status'=>false, 'msg'=>$simpan['msg']], RestController::HTTP_INTERNAL_ERROR);
    }
  }

}


/* End of file Kategori.php */
/* Location: ./application/controllers/Kategori.php */