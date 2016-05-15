<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Baiviet_model extends CI_Model {

	function lay_theoma($id) {

		$q = $this->db->get_where('baiviet', array('id'=>convert_ktrang($id)))->row_array();
		return $q;

	}

    function layma_danhmuc() {
        $ma_danhmuc = $this->db->select('id')->get_where('danhmuc', array('viTri'=>'T'));
        if($ma_danhmuc->num_rows() > 0) {
            foreach($ma_danhmuc->result() as $row_ma) {
                $q = $this->db->select('id_danhMuc')->distinct()->where_in('id_danhMuc', $row_ma->id)->get('baiviet');
                if($q->num_rows()>0){
                    foreach($q->result() as $row){
                        $data[] = $row;
                    }
                    return $data;
                }
            }
        }

    }

    function danhsach_khongtheoma($id) {

        $q = $this->db->where_in('id_danhMuc', $id)->order_by('createdDate', 'desc')->limit('6')->get('baiviet');
        if($q->num_rows()>0){
            foreach($q->result() as $row){
                $data[] = $row;
            }
            return $data;
        }

    }

    function dem_danhsach_theoma($id) {

        $q = $this->db->where('id_danhMuc', $id)->order_by('createdDate', 'desc')->get('baiviet')->num_rows();
        return $q;

    }

    function danhsach_theoma($id, $limit, $display) {

        $q = $this->db->where('id_danhMuc', $id)->order_by('createdDate', 'desc')->limit($limit, $display)->get('baiviet');
        if($q->num_rows()>0){
            foreach($q->result() as $row){
                $data[] = $row;
            }
            return $data;
        }

    }

	/* Admin */

	function dem_danhsach($k){

        $q = $this->db->like('chuDe', convert_cthuong($k))->or_like('noiDung', convert_cthuong($k))->order_by('createdDate', 'desc')->get('baiviet')->num_rows();
        return $q;

    }

    function hienthi_danhsach($k, $limit, $display){

        $q = $this->db->like('chuDe', convert_cthuong($k))->or_like('noiDung', convert_cthuong($k))->order_by('createdDate', 'desc')->limit($limit, $display)->get('baiviet');
        if($q->num_rows()>0){
            foreach($q->result() as $row){
                $data[] = $row;
            }
            return $data;
        }

    }


    function kiemtra_tontai($chude) {
            
        $q = $this->db->get_where('baiviet', array('chuDe'=>convert_ktrang($chude)))->num_rows();
        if($q == 1) {
            return $q;
        } else {
            return false;
        }

    }

    function create($hinhanh, $id_danhMuc, $chude, $file, $noiDung) {

        $data = array(
            'id' => convert_link($chude),
            'hinhAnh' => convert_implode($hinhanh),
            'id_danhMuc' => $id_danhMuc,
            'chuDe' => convert_ktrang($chude),
            'tapTin' => $file,
            'noiDung' => $noiDung,
            'createdDate' => date('Y/m/d')
        );

        $q = $this->db->insert('baiviet', $data);

        return $q;
    }

    function update($hinhanh, $id_danhMuc, $chude, $file, $noiDung, $id_baiviet) {

        $data = array(
            'id' => convert_link($chude),
            'hinhAnh' => convert_implode($hinhanh),
            'id_danhMuc' => $id_danhMuc,
            'chuDe' => convert_ktrang($chude),
            'tapTin' => $file,
            'noiDung' => $noiDung,
            'modifiedDate' => date('Y/m/d')
        );

        $q = $this->db->where('id', convert_ktrang($id_baiviet))->update('baiviet', $data);

        return $q;
    }

    public function delete($id) {

        $q = $this->db->where('id', convert_ktrang($id))->delete('baiviet');
        return $q;

    }

}