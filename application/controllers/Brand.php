<?php
defined('BASEPATH') or exit('No direct script access allowed');
// Don't forget include/define REST_Controller path

/**
 *
 * Controller Brand
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

class Brand extends RestController
{
    
  public function __construct()
  {
    parent::__construct();
    $this->load->model('brand_model', 'brand');
    $this->methods['index_get']['limit'] = 100;
  }

  public function index_get(){
    $id = $this->get('id_brand');
    if ($id===null) {
      $list = $this->brand->get(null);

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
      $data = $this->brand->get($id);
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
      'nama_brand'=>$this->post('brand', true)
    ];

    $simpan=$this->brand->add($data, true);
    if ($simpan['status']) { //jika berhasil
      $this->response(['status'=>true, 'msg'=>$simpan['data'].' brand telah ditambahkan'], RestController::HTTP_CREATED);
    }
    else { //jika gagal
      $this->response(['status'=>false, 'msg'=>$simpan['msg']], RestController::HTTP_INTERNAL_ERROR);
    }
  }

  public function index_put() {
    $data=[
      'nama_brand'=>$this->put('brand', true)
    ];

    $id=$this->put('id_brand', true);
    if ($id==null) {
      $this->response(['status'=>false, 'msg'=>'Masukkan id_brand yang akan diubah'], RestController::HTTP_BAD_REQUEST);
    }

    $simpan=$this->brand->update($id, $data);
    if ($simpan['status']) { //jika berhasil
      $status = (int)$simpan['data'];
      if ($status>0) {
        $this->response(['status'=>true, 'msg'=>$simpan['data'].'brand telah diubah'], RestController::HTTP_OK);
      }
      else {
        $this->response(['status'=>false, 'msg'=>'Tidak ada brand yang diubah'], RestController::HTTP_BAD_REQUEST);
      }
    }
    else { //jika gagal
      $this->response(['status'=>false, 'msg'=>$simpan['msg']], RestController::HTTP_INTERNAL_ERROR);
    }
  }

}


/* End of file Brand.php */
/* Location: ./application/controllers/Brand.php */