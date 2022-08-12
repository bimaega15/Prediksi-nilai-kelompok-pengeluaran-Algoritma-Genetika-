<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kategori extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        check_not_login();
        if (!$this->session->has_userdata('id_admin')) {
            show_404();
        }
        $this->load->model(['Kategori/Kategori_model']);
    }
    public function index()
    {
        $this->breadcrumbs->push('Home', 'Admin/Home');
        $this->breadcrumbs->push('Kategori', 'Admin/Kategori');
        // output
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        $data['title'] = 'Kategori';
        $data['result'] = $this->Kategori_model->get()->result();
        $this->template->admin('admin/kategori/main', $data);
    }

    public function process()
    {
        $this->form_validation->set_rules('nama_kategori', 'Kategori', 'required');
        $this->form_validation->set_message('required', '{field} Wajib diisi');
        $this->form_validation->set_error_delimiters('<small class="text-danger">', '</small><br>');

        if (($_POST['page']) == 'add') {
            if ($this->form_validation->run() == false) {
                $data = [
                    'status' => 'error',
                    'output' => $this->form_validation->error_array()
                ];
                echo json_encode($data);
            } else {
                $data_Kategori = [
                    'nama_kategori' => htmlspecialchars($this->input->post('nama_kategori', true)),
                ];
                $insert = $this->Kategori_model->insert($data_Kategori);
                if ($insert > 0) {
                    $data = [
                        'status_db' => 'success',
                        'output' => 'Berhasil menambah data'
                    ];
                    echo json_encode($data);
                } else {
                    $data = [
                        'status_db' => 'error',
                        'output' => 'Gagal mengubah data'
                    ];
                    echo json_encode($data);
                }
            }
        } else if (($_POST['page']) == 'edit') {
            if ($this->form_validation->run() == false) {
                $id = htmlspecialchars($this->input->post('id_kategori', true));
                $data = [
                    'status' => 'error',
                    'output' => $this->form_validation->error_array()
                ];
                echo json_encode($data);
            } else {
                $id = htmlspecialchars($this->input->post('id_kategori', true));

                $data_Kategori = [
                    'nama_kategori' => htmlspecialchars($this->input->post('nama_kategori', true)),
                ];
                $update = $this->Kategori_model->update($data_Kategori, $id);
                if ($update > 0) {
                    $data = [
                        'status_db' => 'success',
                        'output' => 'Berhasil mengubah data'
                    ];
                    echo json_encode($data);
                } else {
                    $data = [
                        'status_db' => 'error',
                        'output' => 'Gagal mengubah data'
                    ];
                    echo json_encode($data);
                }
            }
        }
    }
    public function edit($id)
    {

        $get = $this->Kategori_model->get($id)->row();

        $data = [
            'row' => $get,
        ];
        echo json_encode($data);
    }

    public function delete()
    {
        $id_kategori = htmlspecialchars_decode($this->input->post('id_kategori', true));
        $delete = $this->Kategori_model->delete($id_kategori);
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

    public function loadData()
    {
        $data = $this->Kategori_model->get()->result();
        $result = [];
        $no = 1;
        if ($data == null) {
            $result['data'] = [];
        }
        foreach ($data as $index => $v_data) {
            $result['data'][] = [
                $no++,
                $v_data->nama_kategori,
                '
                <div class="text-center">
                    <a href="' . base_url('Admin/DataByKategori?kategori_id=' . $v_data->id_kategori) . '" class="btn btn-primary" title="data by kategori">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a href="' . base_url('Admin/Kategori/edit/' . $v_data->id_kategori) . '" class="btn btn-warning btn-edit" data-id_kategori="' . $v_data->id_kategori . '">
                        <i class="fas fa-pencil-alt"></i>
                    </a>
                    <a href="' . base_url('Admin/Kategori/delete/' . $v_data->id_kategori) . '" class="btn btn-danger btn-delete" data-id_kategori="' . $v_data->id_kategori . '">
                        <i class="fas fa-trash"></i>
                    </a>
                </div>
                '
            ];
        }
        echo json_encode($result);
    }
}
