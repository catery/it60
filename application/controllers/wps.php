<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Wps extends CI_Controller {

	public function index() {

		$data['template'] = 'partials/index';
		$data['title_header'] = TITLE_URL;
		$data['breadcrums_cha'] = '';
		$data['breadcrums_con'] = '';

		$this->load->view('templates/layouts', isset($data) ? $data : NULL);

	}

	public function page($page=10) {

		$srch = $this->input->get('s');

		$config['base_url'] = BASE_URL.'tim-kiem/'.$page;
        $config['per_page'] = $page;
        $config['num_links'] = 3;
        $config['uri_segment'] = 3;
        $config['first_url'] = BASE_URL.'tim-kiem/?s='.$srch;
        $config['suffix'] = '?'.http_build_query($this->input->get(), '', "&");
        $config['total_rows'] = $this->baiviet_model->dem_danhsach($srch);
        $config['full_tag_open'] = '<div class="pagination">';
        $config['full_tag_close'] = '</div>';
        $this->pagination->initialize($config);

        $data['template'] = 'partials/index';
		$data['title_header'] = TITLE_URL.' - Tìm kiếm';
		$data['breadcrums_cha'] = 'Kết quả tìm kiếm';
		$data['breadcrums_con'] = '';
		$data['key_cha'] = 'tim-kiem/?s='.$srch;
		$data['record'] = $this->baiviet_model->hienthi_danhsach($srch, $config['per_page'], $this->uri->segment(3));
	
		$this->load->view('templates/layouts', isset($data) ? $data : NULL);

	}

	public function gioithieu() {

		$data['template'] = 'partials/gioithieu_page';
		$data['title_header'] = TITLE_URL.' - Giới thiệu';
		$data['breadcrums_cha'] = 'Giới thiệu';
		$data['breadcrums_con'] = '';
		$data['key_cha'] = 'gioi-thieu';
		$data['key_con'] = '';

		$this->load->view('templates/layouts', isset($data) ? $data : NULL);

	}

	public function lienhe() {

		$data['template'] = 'partials/lienhe_page';
		$data['title_header'] = TITLE_URL.' - Liên hệ';
		$data['breadcrums_cha'] = 'Liên hệ';
		$data['breadcrums_con'] = '';
		$data['key_cha'] = 'lien-he';
		$data['key_con'] = '';

		$this->load->view('templates/layouts', isset($data) ? $data : NULL);

	}

	public function baiviet($id, $page=10) {

		$config['base_url'] = 'bai-viet/'.$id.'/'.$page;
		$config['first_url'] = 'bai-viet/'.$id;
        $config['per_page'] = $page;
        $config['num_links'] = 4;
        $config['uri_segment'] = 4;
        $config['total_rows'] = $this->baiviet_model->dem_danhsach_theoma($id);
        $config['full_tag_open'] = '<div class="pagination">';
        $config['full_tag_close'] = '</div>';
        $this->pagination->initialize($config);

        $menu = $this->menu_model->lay_theoma($id);
		$data['title_header'] = TITLE_URL.' - '.$menu['tenMenu'];
		$data['breadcrums_cha'] = '';
		$data['breadcrums_con'] = $menu['tenMenu'];
		$data['key_cha'] = 'bai-viet/'.$menu['id'];
		$data['key_con'] = 'bai-viet/'.$id;
		$data['record'] = $this->baiviet_model->danhsach_theoma($id, $config['per_page'], $this->uri->segment(4));

		$data['template'] = 'partials/general';
		$this->load->view('templates/layouts', isset($data) ? $data : NULL);

	}

	public function danhmuc_benphai($id, $page=10) {

		$config['base_url'] = 'thong-tin/'.$id.'/'.$page;
		$config['first_url'] = 'thong-tin/'.$id;
        $config['per_page'] = $page;
        $config['num_links'] = 3;
        $config['total_rows'] = $this->baiviet_model->dem_danhsach_theoma($id);
        $config['full_tag_open'] = '<div class="pagination">';
        $config['full_tag_close'] = '</div>';
        $this->pagination->initialize($config);

        $menu = $this->menu_model->lay_theoma($id);
		$data['title_header'] = TITLE_URL.' - '.$menu['tenMenu'];
		$data['breadcrums_cha'] = $menu['tenMenu'];
		$data['breadcrums_con'] = '';
		$data['key_cha'] = 'thong-tin/'.$menu['id'];
		$data['key_con'] = '';
		$data['record'] = $this->baiviet_model->danhsach_theoma($id, $config['per_page'], $this->uri->segment(3));

		$data['template'] = 'partials/general';
		$this->load->view('templates/layouts', isset($data) ? $data : NULL);

	}

	public function chitiet($id_dmuc, $id) {

		$baiviet = $this->baiviet_model->lay_theoma($id);
		$menu = $this->menu_model->lay_theoma($baiviet['id_danhMuc']);

		$data['template'] = 'partials/chitiet_general';
		$data['title_header'] = TITLE_URL.' - '.$baiviet['chuDe'];
		$data['breadcrums_cha'] = $menu['tenMenu'];
		$data['breadcrums_con'] = $baiviet['chuDe'];
		if($menu['viTri'] == 'T') {
			$data['key_cha'] = 'bai-viet/'.$menu['id'];
		} else {
			$data['key_cha'] = 'thong-tin/'.$menu['id'];
		}
		$data['key_con'] = 'chi-tiet/'.$id_dmuc.'/'.$id;
		$data['record'] = $this->baiviet_model->lay_theoma($id);

		$this->load->view('templates/layouts', isset($data) ? $data : NULL);

	}

}