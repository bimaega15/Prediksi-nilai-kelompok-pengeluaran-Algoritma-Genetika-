<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        check_not_login();

        if (!$this->session->has_userdata('id_admin')) {
            show_404();
        }
        $this->load->model(['Kategori/Kategori_model', 'Admin/Admin_model', 'DataByKategori/DataByKategori_model']);
    }
    public function index()
    {
        $this->breadcrumbs->push('Home', 'Admin/Home');
        // output
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        $data['title'] = 'Dashboard';
        $data['admin'] = $this->Admin_model->get()->num_rows();
        $data['kategori'] = $this->Kategori_model->get()->num_rows();
        $data['databykategori'] = $this->DataByKategori_model->get()->num_rows();
        $this->template->admin('admin/home/main', $data);
    }
}
