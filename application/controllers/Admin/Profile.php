<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        check_not_login();
        if (!$this->session->has_userdata('id_admin')) {
            show_404();
        }
        $this->load->model(['Admin/Admin_model']);
    }
    public function index()
    {
        $this->breadcrumbs->push('Home', 'Admin/Home');
        $this->breadcrumbs->push('Profile', 'Admin/Profile');
        // output
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        $data['title'] = 'My Profile';
        $data['result'] = check_profile();

        $this->template->admin('admin/profile/main', $data);
    }

    public function process()
    {
        $this->form_validation->set_rules('nama_admin', 'Nama', 'required');
        $this->form_validation->set_rules('username_admin', 'Username', 'required|callback_validateUsername');
        $this->form_validation->set_rules('password_admin', 'Password', 'callback_validatePassword');
        $this->form_validation->set_rules('gambar_admin', 'Gambar', 'callback_validateGambar');
        $this->form_validation->set_rules('telepon_admin', 'Telepon', 'required');
        $this->form_validation->set_rules('alamat_admin', 'Alamat', 'required');
        $this->form_validation->set_message('required', '{field} Wajib diisi');
        $this->form_validation->set_error_delimiters('<small class="text-danger">', '</small><br>');

        if (($_POST['page']) == 'edit') {
            if ($this->form_validation->run() == false) {
                return $this->index();
            } else {
                $id = htmlspecialchars($this->input->post('id_admin', true));
                $password_admin = $this->input->post('password_admin', true);
                $password_admin_db = $this->input->post('password_admin_old', true);
                if ($password_admin != null) {
                    $password_admin_db = htmlspecialchars(md5($password_admin));
                }
                $gambarAdmin = $this->uploadGambar($id);
                $data_Admin = [
                    'nama_admin' => htmlspecialchars($this->input->post('nama_admin', true)),
                    'username_admin' => htmlspecialchars($this->input->post('username_admin', true)),
                    'password_admin' => $password_admin_db,
                    'gambar_admin' => $gambarAdmin,
                    'telepon_admin' => htmlspecialchars($this->input->post('telepon_admin', true)),
                    'alamat_admin' => htmlspecialchars($this->input->post('alamat_admin', true)),
                ];

                $update = $this->Admin_model->update($data_Admin, $id);
                if ($update > 0) {
                    $this->session->set_flashdata('success', 'Berhasil mengubah data profile');
                    return redirect(base_url('Admin/Profile'));
                } else {
                    $this->session->set_flashdata('error', 'Gagal mengubah data profile');
                    return redirect(base_url('Admin/Profile'));
                }
            }
        }
    }

    public function edit($id)
    {
        $get = $this->Admin_model->get($id)->row();
        $data = [
            'row' => $get,
        ];
        echo json_encode($data);
    }

    public function delete()
    {
        $id_admin = htmlspecialchars_decode($this->input->post('id_admin', true));
        $this->removeImage($id_admin);
        $delete = $this->Admin_model->delete($id_admin);
        if ($delete) {
            $data = [
                'status' => "success",
                'msg' => 'Success hapus data'
            ];
            echo json_encode($data);
        } else {
            $data = [
                'status' => "error",
                'msg' => 'Error hapus data'
            ];
            echo json_encode($data);
        }
    }
    
    public function validateGambar()
    {
        $check = TRUE;
        if (($_FILES['gambar_admin']) && $_FILES['gambar_admin']['size'] != 0) {
            $allowedExts = array("gif", "jpeg", "jpg", "png", "JPG", "JPEG", "GIF", "PNG");
            $extension = pathinfo($_FILES["gambar_admin"]["name"], PATHINFO_EXTENSION);

            if (filesize($_FILES['gambar_admin']['tmp_name']) > 1000000) {
                $this->form_validation->set_message('validateGambar', 'Gambar melebihi 1 MB');
                $check = FALSE;
            }
            if (!in_array($extension, $allowedExts)) {
                $this->form_validation->set_message('validateGambar', "Tidak didukung format {$extension}");
                $check = FALSE;
            }
        }
        return $check;
    }

    public function validatePassword()
    {
        $check = TRUE;
        $password = $this->input->post('password_admin', true);
        $confirm_password = $this->input->post('confirm_password_admin', true);
        if ($_POST['page'] == 'add') {
            if ($password == null) {
                $this->form_validation->set_message('validatePassword', 'Password tidak boleh kosong');
                $check = FALSE;
            }
            if ($confirm_password == null) {
                $this->form_validation->set_message('validatePassword', 'Confirm password tidak boleh kosong');
                $check = FALSE;
            }
        }
        if ($password != null && $confirm_password != null) {
            if ($password != $confirm_password) {
                $this->form_validation->set_message('validatePassword', 'Password tidak sama dengan confirm password');
                $check = FALSE;
            }
        }
        return $check;
    }

    public function validateUsername()
    {
        $check = TRUE;
        $username = $this->input->post('username_admin', true);
        if ($_POST['page'] == 'add') {
            $check_username = $this->db->get_where('admin', ['username_admin' => $username])->num_rows();
            if ($check_username > 0) {
                $this->form_validation->set_message('validateUsername', 'Username sudah digunakan');
                $check = FALSE;
            }
        } else {
            $id_admin = $this->input->post('id_admin', true);
            $check_username = $this->db->get_where('admin', ['username_admin' => $username, 'id_admin <> ' => $id_admin])->num_rows();
            if ($check_username > 0) {
                $this->form_validation->set_message('validateUsername', 'Username sudah digunakan');
                $check = FALSE;
            }
        }
        return $check;
    }

    private function uploadGambar($id_admin = '')
    {
        $gambar = $_FILES["gambar_admin"]['name'];
        if ($gambar != null) {
            $this->removeImage($id_admin);
            $config['upload_path'] = './public/image/admin';
            $config['allowed_types'] = 'gif|jpg|jpeg|png';
            $config['overwrite'] = true;
            $new_name = rand(1000, 100000) . time() . $_FILES["gambar_admin"]['name'];
            $config['file_name'] = $new_name;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('gambar_admin')) {
                echo $this->upload->display_errors();
            } else {
                $gambar = $this->upload->data();
                //Compress Image
                $config['image_library'] = 'gd2';
                $config['source_image'] = './public/image/admin/' . $gambar['file_name'];
                $config['create_thumb'] = FALSE;
                $config['maintain_ratio'] = FALSE;
                $config['quality'] = '50%';
                $config['new_image'] = './public/image/admin/' . $gambar['file_name'];
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();
                return $gambar['file_name'];
            }
        } else {
            $admin = $this->Admin_model->get($id_admin)->row();
            if ($admin->gambar_admin != 'default.png') {
                return $admin->gambar_admin;
            } else {
                return 'default.png';
            }
        }
    }

    private function removeImage($id)
    {
        if ($id != null) {
            $img = $this->Admin_model->get($id)->row();
            if ($img->gambar_admin != 'default.png') {
                $filename = explode('.', $img->gambar_admin)[0];
                return array_map('unlink', glob(FCPATH . "public/image/admin/" . $filename . '.*'));
            }
        }
    }
}
