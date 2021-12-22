<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 * Model User_model
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

class User_model extends CI_Model {

  // ------------------------------------------------------------------------

  public function __construct()
  {
    parent::__construct();
  }

  public function count() {
    return $this->db->get('user')->num_rows();
  }

  public function get($id=null, $limit=10, $offset=0) {
    if ($id==null) {
      return $this->db->get('user', $limit, $offset)->result();
    }
    else {
      return $this->db->get_where('user', ['id_user'=>$id])->result_array();
    }
  }

  public function add($data) {
    try {
      $this->db->insert('user', $data);
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
      $this->db->update('user', $data, ['id_user'=>$id]);
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
      $this->db->delete('user', ['id_user'=>$id]);
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


  // ------------------------------------------------------------------------
  public function index()
  {
    // 
  }

  // ------------------------------------------------------------------------

}

/* End of file User_model.php */
/* Location: ./application/models/User_model.php */