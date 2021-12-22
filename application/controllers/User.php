<?php
defined('BASEPATH') or exit('No direct script access allowed');
// Don't forget include/define REST_Controller path

/**
 *
 * Controller User
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

class User extends RestController
{
    
  public function __construct()
  {
    parent::__construct();
    $this->load->model('user_model', 'user');
    $this->methods['index_get']['limit'] = 100;
  }

  public function index_get(){
    $id = $this->get('id_user');
    if ($id===null) {
      $p=$this->get('page');
      $p = (empty($p) ? 1 : $p);

      $total_data = $this->user->count();
      $total_page = ceil($total_data/10);
      $start = ($p-1) * 10;

      $list = $this->user->get(null, 10, $start);

      if ($list) {
        $data = [
          'status' => true,
          'page' => $p,
          'total_data' => $total_data,
          'total_page' => $total_page,
          'data' => $list
        ];
      }
      else {
        $data = ['status'=>false, 'msg'=>'user tidak ditemukan'];
      }

      $this->response($data, RestController::HTTP_OK);
    }
    else {
      $data = $this->user->get($id);
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
      'nama_user'=>$this->post('nama', true),
      'alamat_user'=>$this->post('alamat', true),
      'nomor_user'=>$this->post('nomor', true)
    ];

    $simpan=$this->user->add($data, true);
    if ($simpan['status']) { //jika berhasil
      $this->response(['status'=>true, 'msg'=>$simpan['data'].' user telah ditambahkan'], RestController::HTTP_CREATED);
    }
    else { //jika gagal
      $this->response(['status'=>false, 'msg'=>$simpan['msg']], RestController::HTTP_INTERNAL_ERROR);
    }
  }

  public function index_put() {
    $data=[
      'nama_user'=>$this->put('nama', true),
      'alamat_user'=>$this->put('alamat', true),
      'nomor_user'=>$this->put('nomor', true)
    ];

    $id=$this->put('id_user', true);
    if ($id==null) {
      $this->response(['status'=>false, 'msg'=>'Masukkan id_user yang akan diubah'], RestController::HTTP_BAD_REQUEST);
    }

    $simpan=$this->user->update($id, $data);
    if ($simpan['status']) { //jika berhasil
      $status = (int)$simpan['data'];
      if ($status>0) {
        $this->response(['status'=>true, 'msg'=>$simpan['data'].' user telah diubah'], RestController::HTTP_OK);
      }
      else {
        $this->response(['status'=>false, 'msg'=>'Tidak ada user yang diubah'], RestController::HTTP_BAD_REQUEST);
      }
    }
    else { //jika gagal
      $this->response(['status'=>false, 'msg'=>$simpan['msg']], RestController::HTTP_INTERNAL_ERROR);
    }
  }

  public function index_delete() {
    $id=$this->delete('id_user');
    if ($id==null) {
      $this->response(['status'=>false, 'msg'=>'Masukkan id_user yang akan dihapus'], RestController::HTTP_BAD_REQUEST);
    }

    $delete=$this->user->delete($id);
    if ($delete['status']) { //jika berhasil
      $status = (int)$delete['data'];
      if ($status>0) {
        $this->response(['status'=>true, 'msg'=>'user dengan id='.$id.' telah dihapus'], RestController::HTTP_OK);
      }
      else {
        $this->response(['status'=>false, 'msg'=>'Tidak ada user yang dihapus'], RestController::HTTP_BAD_REQUEST);
      }
    }
    else { //jika gagal
      $this->response(['status'=>false, 'msg'=>$delete['msg']], RestController::HTTP_INTERNAL_ERROR);
    }
  }

  public function index()
  {
    // 
  }

}


/* End of file User.php */
/* Location: ./application/controllers/User.php */