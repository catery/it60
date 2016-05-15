<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Menu_model extends CI_Model {

	function lay_theoma($id) {

		$q = $this->db->get_where('danhmuc', array('id'=>convert_ktrang($id)))->row_array();
		return $q;

	}

	function laymenu_trangchu($id) {
		$q = $this->db->get_where('danhmuc', array('id'=>convert_ktrang($id)));
		if($q->num_rows() > 0) {
			foreach($q->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
	}

	function menu_khongcon() {

		$q = $this->db->order_by('tenMenu', 'asc')->get_where('danhmuc', array('menuCon'=>'N', 'menuCha'=>'', 'viTri'=>'T'));
		if($q->num_rows() > 0) {
			foreach($q->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}

	}

	function menu_cocon() {

		$q = $this->db->order_by('tenMenu', 'asc')->get_where('danhmuc', array('menuCon'=>'Y', 'menuCha'=>'', 'viTri'=>'T'));
		if($q->num_rows() > 0) {
			foreach($q->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}

	}

	function lay_menucon($id) {

		$q = $this->db->order_by('tenMenu', 'asc')->get_where('danhmuc', array('menuCha'=>$id));
		if($q->num_rows() > 0) {
			foreach($q->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}

	}

	function menu_right() {

		$q = $this->db->order_by('tenMenu', 'asc')->get_where('danhmuc', array('viTri'=>'R'));
		if($q->num_rows() > 0) {
			foreach($q->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}

	}

	/* Admin */

	function dem_danhsach(){

        $q = $this->db->order_by('menuCha', 'asc')->get_where('danhmuc', array('menuCha'=>''))->num_rows();
        return $q;

    }

    function hienthi_danhsach($limit, $display){

        $q = $this->db->order_by('menuCha', 'asc')->limit($limit, $display)->get_where('danhmuc', array('menuCha'=>''));
        if($q->num_rows()>0){
            foreach($q->result() as $row){
                $data[] = $row;
            }
            return $data;
        }

    }

	function hienthi_danhmuc_cha() {

		$q = $this->db->get_where('danhmuc', array('menuCon'=>'Y'));
		if($q->num_rows() > 0) {
			foreach($q->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}

	}

	function hienthi_danhmuc_con() {

		$q = $this->db->get_where('danhmuc', array('menuCon'=>'N'));
		if($q->num_rows() > 0) {
			foreach($q->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}

	}

	function kiemtra_tontai($ten) {
			
		$q = $this->db->get_where('danhmuc', array('tenMenu'=>convert_ktrang($ten)))->num_rows();
		if($q == 1) {
			return $q;
		} else {
			return false;
		}

	}

	function kiemtra_tontai_menuCha($id) {
			
		$q = $this->db->get_where('danhmuc', array('menuCha'=>convert_ktrang($id)))->num_rows();
		if($q == 1) {
			return $q;
		} else {
			return false;
		}

	}

	function kiemtra_tontai_theoma($id) {
			
		$q = $this->db->get_where('danhmuc', array('id'=>convert_ktrang($id)))->num_rows();
		if($q == 1) {
			return $q;
		} else {
			return false;
		}

	}

	function kiemtra_tontai_menuCha_menu($idcha, $id) {
			
		$q = $this->db->get_where('danhmuc', array('menuCha'=>convert_ktrang($idcha), 'id'=>convert_ktrang($id)))->num_rows();
		if($q == 1) {
			return $q;
		} else {
			return false;
		}

	}

	function create($ten, $dmcon, $menuCha, $vitri) {

		$data = array(
			'id' => convert_link($ten),
			'tenMenu' => convert_ktrang($ten),
			'menuCon' => $dmcon,
			'menuCha' => $menuCha,
			'viTri' => $vitri
		);

		$q = $this->db->insert('danhmuc', $data);

		return $q;
	}

	function update($id, $ten, $dmcon, $menuCha, $vitri) {

		$data = array(
			'id' => convert_link($ten),
			'tenMenu' => convert_ktrang($ten),
			'menuCon' => $dmcon,
			'menuCha' => $menuCha,
			'viTri' => $vitri
		);

		$q = $this->db->where('id', convert_ktrang($id))->update('danhmuc', $data);

		return $q;
	}

	function update_menucha($menuCha_old, $menuCha_new) {

		$data = array(
			'menuCha' => convert_link($menuCha_new)
		);

		$q = $this->db->where('menuCha', convert_ktrang($menuCha_old))->update('danhmuc', $data);

		return $q;
	}

	public function delete($id) {

		$q = $this->db->where('id', convert_ktrang($id))->delete('danhmuc');
		return $q;

	}

	public function deleteall_menucon($id) {

		$q = $this->db->where_in('menuCha', convert_ktrang($id))->delete('danhmuc');
		return $q;

	}

}