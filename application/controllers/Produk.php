<?php
defined('BASEPATH') or exit('No direct script access allowed');
// Don't forget include/define REST_Controller path

/**
 *
 * Controller Produk
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

class Produk extends RestController
{
    
  public function __construct()
  {
    parent::__construct();
    $this->load->model('produk_model', 'produk');
    $this->methods['index_get']['limit'] = 100;
  }

  public function index_get(){
    $id = $this->get('id_produk');
    if ($id===null) {
      $p=$this->get('page');
      $p = (empty($p) ? 1 : $p);

      $total_data = $this->produk->count();
      $total_page = ceil($total_data/10);
      $start = ($p-1) * 10;

      $list = $this->produk->get(null, 10, $start);

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
        $data = ['status'=>false, 'msg'=>'data tidak ditemukan'];
      }

      $this->response($data, RestController::HTTP_OK);
    }
    else {
      $data = $this->produk->get($id);
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
      'nama_produk'=>$this->post('nama', true),
      'id_kategori'=>$this->post('kategori', true),
      'id_brand'=>$this->post('brand', true),
      'harga'=>$this->post('harga', true),
      'stok'=>$this->post('stok', true),
      'spesifikasi'=>$this->post('spesifikasi', true)
    ];

    $simpan=$this->produk->add($data, true);
    if ($simpan['status']) { //jika berhasil
      $this->response(['status'=>true, 'msg'=>$simpan['data'].' produk telah ditambahkan'], RestController::HTTP_CREATED);
    }
    else { //jika gagal
      $this->response(['status'=>false, 'msg'=>$simpan['msg']], RestController::HTTP_INTERNAL_ERROR);
    }
  }

  public function index_put() {
    $data=[
      'nama_produk'=>$this->put('nama', true),
      'id_kategori'=>$this->put('kategori', true),
      'id_brand'=>$this->put('brand', true),
      'harga'=>$this->put('harga', true),
      'stok'=>$this->put('stok', true),
      'spesifikasi'=>$this->put('spesifikasi', true)
    ];

    $id=$this->put('id_produk', true);
    if ($id==null) {
      $this->response(['status'=>false, 'msg'=>'Masukkan id_produk yang akan diubah'], RestController::HTTP_BAD_REQUEST);
    }

    $simpan=$this->produk->update($id, $data);
    if ($simpan['status']) { //jika berhasil
      $status = (int)$simpan['data'];
      if ($status>0) {
        $this->response(['status'=>true, 'msg'=>$simpan['data'].' produk telah diubah'], RestController::HTTP_OK);
      }
      else {
        $this->response(['status'=>false, 'msg'=>'Tidak ada produk yang diubah'], RestController::HTTP_BAD_REQUEST);
      }
    }
    else { //jika gagal
      $this->response(['status'=>false, 'msg'=>$simpan['msg']], RestController::HTTP_INTERNAL_ERROR);
    }
  }

  public function index_delete() {
    $id=$this->delete('id_produk');
    if ($id==null) {
      $this->response(['status'=>false, 'msg'=>'Masukkan id_produk yang akan dihapus'], RestController::HTTP_BAD_REQUEST);
    }

    $delete=$this->produk->delete($id);
    if ($delete['status']) { //jika berhasil
      $status = (int)$delete['data'];
      if ($status>0) {
        $this->response(['status'=>true, 'msg'=>'produk dengan id='.$id.' telah dihapus'], RestController::HTTP_OK);
      }
      else {
        $this->response(['status'=>false, 'msg'=>'Tidak ada produk yang dihapus'], RestController::HTTP_BAD_REQUEST);
      }
    }
    else { //jika gagal
      $this->response(['status'=>false, 'msg'=>$delete['msg']], RestController::HTTP_INTERNAL_ERROR);
    }
  }

}


/* End of file Produk.php */
/* Location: ./application/controllers/Produk.php */