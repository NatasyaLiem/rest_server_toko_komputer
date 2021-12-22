<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 * Model Produk_model
 *
 * This Model for ...
 * 
 * @package		CodeIgniter
 * @category	Model
 * @author    Setiawan Jodi <jodisetiawan@fisip-untirta.ac.id>
 * @link      https://github.com/setdjod/myci-extension/
 * @param     ...
 * @return    ...
 *
 */

class Produk_model extends CI_Model {

  // ------------------------------------------------------------------------

  public function __construct()
  {
    parent::__construct();
  }

  // ------------------------------------------------------------------------


  // ------------------------------------------------------------------------

  public function count() {
    return $this->db->get('produk')->num_rows();
  }

  public function get($id=null, $limit=10, $offset=0) {
    if ($id==null) {
      $this->db->select('*');
      $this->db->join('kategori', 'produk.id_kategori = kategori.id_kategori');
      $this->db->join('brand', 'produk.id_brand = brand.id_brand');
      return $this->db->get('produk', $limit, $offset)->result();
    }
    else {
      $this->db->select('*');
      $this->db->join('kategori', 'produk.id_kategori = kategori.id_kategori');
      $this->db->join('brand', 'produk.id_brand = brand.id_brand');
      return $this->db->get_where('produk', ['id_produk'=>$id])->result_array();
    }
  }

  public function add($data) {
    try {
      $this->db->insert('produk', $data);
      $error=$this->db->error();
      if (!empty($error['code'])) {
        throw new Exception('Terjadi kesalahan : '.$error['message']);
        return false;
      }
      return ['status'=>true, 'data'=>$this->db->affected_rows()];
    }
    catch (Exception $ex) {
      return ['status'=>false, 'msg'=>$ex->getMessage()];
    }
  }

  public function update($id, $data) {
    try {
      $this->db->update('produk', $data, ['id_produk'=>$id]);
      $error=$this->db->error();
      if (!empty($error['code'])) {
        throw new Exception('Terjadi kesalahan : '.$error['message']);
        return false;
      }
      return ['status'=>true, 'data'=>$this->db->affected_rows()];
    }
    catch (Exception $ex) {
      return ['status'=>false, 'msg'=>$ex->getMessage()];
    }
  }

  public function delete($id) {
    try {
      $this->db->delete('produk', ['id_produk'=>$id]);
      $error=$this->db->error();
      if (!empty($error['code'])) {
        throw new Exception('Terjadi kesalahan : '.$error['message']);
        return false;
      }
      return ['status'=>true, 'data'=>$this->db->affected_rows()];
    }
    catch (Exception $ex) {
      return ['status'=>false, 'msg'=>$ex->getMessage()];
    }
  }
  // ------------------------------------------------------------------------

}

/* End of file Produk_model.php */
/* Location: ./application/models/Produk_model.php */