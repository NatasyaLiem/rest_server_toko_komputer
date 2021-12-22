<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 * Model Brand_model
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

class Brand_model extends CI_Model {

  // ------------------------------------------------------------------------

  public function __construct()
  {
    parent::__construct();
  }

  // ------------------------------------------------------------------------


  // ------------------------------------------------------------------------
  public function get($id=null) {
    if ($id==null) {
      return $this->db->get('brand')->result();
    }
    else {
      return $this->db->get_where('brand', ['id_brand'=>$id])->result_array();
    }
  }

  public function add($data) {
    try {
      $this->db->insert('brand', $data);
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
      $this->db->update('brand', $data, ['id_brand'=>$id]);
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

/* End of file Brand_model.php */
/* Location: ./application/models/Brand_model.php */