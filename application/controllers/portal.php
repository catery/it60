<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Portal extends CI_Controller {

	public function index() {

		if($this->session->userdata('isLogged') == true) {

			redirect(BASE_URL.'portal/chude_danhmuc');

		} else {

			redirect(BASE_URL.'portal/dangnhap');
		}

	}

	public function dangnhap() {

		$data['title_admin'] = 'Đăng nhập hệ thống';

		$this->load->view('partials_admin/login', isset($data) ? $data : NULL);

	}

	public function xacnhan() {

		$u = $this->input->post('userAccount');
		$p = $this->input->post('passWord');

		$q = $this->truycap_model->ktra_Nguoidung($u, $p);
		
		if($q) {
			foreach($q as $row) {
				$data = array(
					'tenNDung' => $row->tenTruyCap,
					'maTruyCap' => $row->taiKhoan,
					'isLogged' => true
				);
				$this->session->set_userdata($data);
				$this->nativesession->set('isLogged', $this->session->userdata('isLogged'));
			}
			if($this->session->userdata('isLogged') == true) {
				redirect(BASE_URL.'portal');
			} else {
				redirect(BASE_URL.'portal/dangnhap');
			}
		} else {
			$this->session->set_flashdata('flashError', 'Lỗi truy cập');
			redirect(BASE_URL.'portal/dangnhap');
		}

	}
	
	public function doimatkhau() {

		$u = $this->session->userdata('maTruyCap');
		$p = $this->input->post('mkc');

		$q = $this->truycap_model->ktra_Nguoidung($u, $p);
		
		if($q) {

			$np = $this->input->post('xnmk');

			$change = $this->truycap_model->thaydoi_matkhau($u, $np);

			if($change) {
				$this->session->set_flashdata('SuccessPass', 'Đổi mật khẩu thành công');
				redirect(BASE_URL.'portal/chude_danhmuc');
			} else {
				$this->session->set_flashdata('ErrorPass', 'Đổi mật khẩu thất bại');
				redirect(BASE_URL.'portal/chude_danhmuc');
			}

		} else {
			$this->session->set_flashdata('flashErrorPass', 'Tài khoản không tồn tại');
			redirect(BASE_URL.'portal/danhsach');
		}

	}

	public function logout() {

		if($this->session->userdata('isLogged') == true) {
			$this->session->unset_userdata('isLogged');
			$this->session->sess_destroy();
			redirect(BASE_URL.'portal/dangnhap');
		}

	}

	/* Danh mục */

	public function chude_danhmuc() {

		$config['base_url'] = 'portal/chude_danhmuc';
        $config['per_page'] = 15;
        $config['num_links'] = 3;
        $config['total_rows'] = $this->menu_model->dem_danhsach();
        $config['full_tag_open'] = '<div class="pagination">';
        $config['full_tag_close'] = '</div>';
        $this->pagination->initialize($config);

		$data['template_admin'] = 'partials_admin/menu';
		$data['title_admin'] = 'Chủ đề danh mục';
		$data['record'] = $this->menu_model->hienthi_danhsach($config['per_page'], $this->uri->segment(3));

		$this->load->view('templates_admin/layouts', isset($data) ? $data : NULL);

	}

	public function taomoi_danhmuc() {

		if($this->input->post('btn_smt') == 'save') {

			$ten = $this->input->post('danhMuc');
			$menuCha = $this->input->post('danhMucCha');
			$menuCon = $this->input->post('danhMucCon');
			$viTri = $this->input->post('viTriDanhMuc');

			$ktra= $this->menu_model->kiemtra_tontai($ten);

			if($ktra) {
				$this->session->set_flashdata('ErrorExist', 'Tên danh mục đã tồn tại');
				redirect(BASE_URL.'portal/taomoi_danhmuc');
			} else {
				$q = $this->menu_model->create($ten, $menuCon, $menuCha, $viTri);
				if($q) {
					$this->session->set_flashdata('Success', 'Thêm mới thành công');
					redirect(BASE_URL.'portal/taomoi_danhmuc');
				} else {
					$this->session->set_flashdata('Error', 'Thêm mới thất bại');
					redirect(BASE_URL.'portal/taomoi_danhmuc');
				}
			}

		} else {

			$data['template_admin'] = 'partials_admin/themmoi_menu';
			$data['title_admin'] = 'Thêm mới danh mục';

			$this->load->view('templates_admin/layouts', isset($data) ? $data : NULL);

		}

	}

	public function capnhat_danhmuc($id) {

		if($this->input->post('btn_smt') == 'save') {

			$ten = $this->input->post('danhMuc');
			$menuCha = $this->input->post('danhMucCha');
			$menuCon = $this->input->post('danhMucCon');
			$viTri = $this->input->post('viTriDanhMuc');

			if($menuCha == "") {

				$ktra_mcha = $this->menu_model->kiemtra_tontai_menuCha($menuCha);
				if($ktra_mcha) {
					$q = $this->menu_model->update($id, $ten, $menuCon, $menuCha, $viTri);
					if($q) {
						$this->session->set_flashdata('Success', 'Cập nhật thành công');
						redirect(BASE_URL.'portal/capnhat_danhmuc/'.convert_link($ten));
					} else {
						$this->session->set_flashdata('Error', 'Cập nhật thất bại');
						redirect(BASE_URL.'portal/capnhat_danhmuc/'.$id);
					}
				} else {
					$q = $this->menu_model->update($id, $ten, $menuCon, $menuCha, $viTri);
					$q_cha = $this->menu_model->update_menucha($id, $ten);
					if($q && $q_cha) {
						$this->session->set_flashdata('Success', 'Cập nhật thành công');
						redirect(BASE_URL.'portal/capnhat_danhmuc/'.convert_link($ten));
					} else {
						$this->session->set_flashdata('Error', 'Cập nhật thất bại');
						redirect(BASE_URL.'portal/capnhat_danhmuc/'.$id);
					}
				}

			} else {

				$q = $this->menu_model->update($id, $ten, $menuCon, $menuCha, $viTri);
				if($q) {
					$this->session->set_flashdata('Success', 'Cập nhật thành công');
					redirect(BASE_URL.'portal/capnhat_danhmuc/'.convert_link($ten));
				} else {
					$this->session->set_flashdata('Error', 'Cập nhật thất bại');
					redirect(BASE_URL.'portal/capnhat_danhmuc/'.$id);
				}

			}

		} else {

			$data['template_admin'] = 'partials_admin/capnhat_menu';
			$data['title_admin'] = 'Cập nhật danh mục';
			$data['record'] = $this->menu_model->lay_theoma($id);

			$this->load->view('templates_admin/layouts', isset($data) ? $data : NULL);

		}

	}

	public function xoatoan_danhmuc($id) {

		$lay_menuCha = $this->menu_model->lay_theoma($id);

		if($lay_menuCha['menuCha'] == "") {

			$q = $this->menu_model->delete($id);
			$q_all = $this->menu_model->deleteall_menucon($id);
			if($q && $q_all) {
				$this->session->set_flashdata('Success', 'Xóa thành công');
				redirect(BASE_URL.'portal/chude_danhmuc');
			} else {
				$this->session->set_flashdata('Error', 'Xóa thất bại');
				redirect(BASE_URL.'portal/chude_danhmuc');
			}

		}

	}

	public function xoa_danhmuc($id) {

		$q = $this->menu_model->delete($id);
		if($q) {
			$this->session->set_flashdata('Success', 'Xóa thành công');
			redirect(BASE_URL.'portal/chude_danhmuc');
		} else {
			$this->session->set_flashdata('Error', 'Xóa thất bại');
			redirect(BASE_URL.'portal/chude_danhmuc');
		}

	}

	/* Kết thúc danh mục */

	/* Bài viết */


	public function quanly_baiviet() {

		if($this->input->get('Key')) {

			$config['base_url'] = BASE_URL.'portal/quanly_baiviet';
	        $config['first_url'] = BASE_URL.'/portal/quanly_baiviet/?Key='.$this->input->get('Key');
	        $config['suffix'] = '?'.http_build_query($this->input->get(), '', "&");
	        $config['per_page'] = 15;
	        $config['num_links'] = 3;
	        $config['uri_segment'] = 3;
	        $config['total_rows'] = $this->baiviet_model->dem_danhsach($this->input->get('Key'));
	        $config['full_tag_open'] = '<div class="pagination">';
	        $config['full_tag_close'] = '</div>';
	        $this->pagination->initialize($config);

			$data['template_admin'] = 'partials_admin/baiviet';
			$data['title_admin'] = 'Bài viết';
			$data['record'] = $this->baiviet_model->hienthi_danhsach($this->input->get('Key'), $config['per_page'], $this->uri->segment(3));

		} else {

			$config['base_url'] = BASE_URL.'portal/quanly_baiviet';
	        $config['per_page'] = 15;
	        $config['num_links'] = 3;
	        $config['total_rows'] = $this->baiviet_model->dem_danhsach($this->input->get('Key'));
	        $config['full_tag_open'] = '<div class="pagination">';
	        $config['full_tag_close'] = '</div>';
	        $this->pagination->initialize($config);

			$data['template_admin'] = 'partials_admin/baiviet';
			$data['title_admin'] = 'Bài viết';
			$data['record'] = $this->baiviet_model->hienthi_danhsach($this->input->get('Key'), $config['per_page'], $this->uri->segment(3));

		}

		$this->load->view('templates_admin/layouts', isset($data) ? $data : NULL);

	}

	public function taomoi_baiviet() {

		if($this->input->post('btn_smt') == 'save') {

			$avatar = $this->input->post('avatar_image');
			if($avatar == "" || $avatar == NULL) {
				$av = 'file_manager/source/tintuc/daidien/news_icon.png';
			} else {
				$av = $this->input->post('avatar_image');
			}
			$chude = $this->input->post('baiViet');
			$file = $this->input->post('tapTin');
			if($file == '' || $file == NULL) {
				$file_x = '';
			} else {
				$file_x = convert_implode($file);
			}
			$id_danhMuc = $this->input->post('danhMuc');
			$noiDung = $this->input->post('noiDung');

			$ktra= $this->baiviet_model->kiemtra_tontai($chude);

			if($ktra) {
				$this->session->set_flashdata('ErrorExist', 'Chủ đề đã tồn tại');
				redirect(BASE_URL.'portal/taomoi_baiviet');
			} else {
				$q = $this->baiviet_model->create($av, $id_danhMuc, $chude, $file_x, $noiDung);
				if($q) {
					$this->session->set_flashdata('Success', 'Thêm mới thành công');
					redirect(BASE_URL.'portal/taomoi_baiviet');
				} else {
					$this->session->set_flashdata('Error', 'Thêm mới thất bại');
					redirect(BASE_URL.'portal/taomoi_baiviet');
				}
			}

		} else {

			$data['template_admin'] = 'partials_admin/themmoi_baiviet';
			$data['title_admin'] = 'Thêm mới bài viết';

			$this->load->view('templates_admin/layouts', isset($data) ? $data : NULL);

		}

	}

	public function capnhat_baiviet($id) {

		if($this->input->post('btn_smt') == 'save') {

			$avatar = $this->input->post('avatar_image');
			$chude = $this->input->post('baiViet');
			$id_danhMuc = $this->input->post('danhMuc');
			$noiDung = $this->input->post('noiDung');
			$file = $this->input->post('tapTin');
			if($file == '' || $file == NULL) {
				$file_x = '';
			} else {
				$file_x = convert_implode($file);
			}
			
			$q = $this->baiviet_model->update($avatar, $id_danhMuc, $chude, $file_x, $noiDung, $id);
			if($q) {
				$this->session->set_flashdata('Success', 'Cập nhật mới thành công');
				redirect(BASE_URL.'portal/capnhat_baiviet/'.convert_link($chude));
			} else {
				$this->session->set_flashdata('Error', 'Cập nhật mới thất bại');
				redirect(BASE_URL.'portal/capnhat_baiviet/'.convert_link($chude));
			}

		} else {

			$data['template_admin'] = 'partials_admin/capnhat_baiviet';
			$data['title_admin'] = 'Cập nhật bài viết';
			$data['record'] = $this->baiviet_model->lay_theoma($id);

			$this->load->view('templates_admin/layouts', isset($data) ? $data : NULL);

		}

	}

	public function xoa_baiviet($id) {

		$q = $this->baiviet_model->delete($id);
		if($q) {
			$this->session->set_flashdata('Success', 'Xóa thành công');
			redirect(BASE_URL.'portal/quanly_baiviet');
		} else {
			$this->session->set_flashdata('Error', 'Xóa thất bại');
			redirect(BASE_URL.'portal/quanly_baiviet');
		}

	}

	/* Kết thúc bài viết */

}