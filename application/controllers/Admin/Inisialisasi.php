<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Inisialisasi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        check_not_login();
        if (!$this->session->has_userdata('id_admin')) {
            show_404();
        }
        $this->load->model(['Inisialisasi/Inisialisasi_model']);
    }
    public function index()
    {
        $this->breadcrumbs->push('Home', 'Admin/Home');
        $this->breadcrumbs->push('Inisialisasi', 'Admin/Inisialisasi');
        // output
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        $data['title'] = 'Inisialisasi';
        $data['result'] = $this->Inisialisasi_model->get()->result();
        $this->template->admin('admin/inisialisasi/main', $data);
    }

    public function process()
    {
        $this->form_validation->set_rules('latih_inisialisasi', 'Latih', 'required');
        $this->form_validation->set_rules('spread_inisialisasi_latih', 'Spread Latih', 'required');
        $this->form_validation->set_rules('spread_inisialisasi_uji', 'Spread Uji', 'required');
        $this->form_validation->set_rules('populasi_inisialisasi', 'Populasi', 'required');
        $this->form_validation->set_rules('crossover_inisialisasi', 'Cross over', 'required');
        $this->form_validation->set_rules('mutasi_inisialisasi', 'Mutasi', 'required');
        $this->form_validation->set_rules('generasi_inisialisasi', 'Mutasi', 'required');
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
                $data_Inisialisasi = [
                    'latih_inisialisasi' => htmlspecialchars($this->input->post('latih_inisialisasi', true)),
                    'uji_inisialisasi' => htmlspecialchars($this->input->post('uji_inisialisasi', true)),
                    'spread_inisialisasi_latih' => htmlspecialchars($this->input->post('spread_inisialisasi_latih', true)),
                    'spread_inisialisasi_uji' => htmlspecialchars($this->input->post('spread_inisialisasi_uji', true)),
                    'crossover_inisialisasi' => htmlspecialchars($this->input->post('crossover_inisialisasi', true)),
                    'mutasi_inisialisasi' => htmlspecialchars($this->input->post('mutasi_inisialisasi', true)),
                    'populasi_inisialisasi' => htmlspecialchars($this->input->post('populasi_inisialisasi', true)),
                    'generasi_inisialisasi' => htmlspecialchars($this->input->post('generasi_inisialisasi', true)),
                ];
                $insert = $this->Inisialisasi_model->insert($data_Inisialisasi);
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
                $id = htmlspecialchars($this->input->post('id_inisialisasi', true));
                $data = [
                    'status' => 'error',
                    'output' => $this->form_validation->error_array()
                ];
                echo json_encode($data);
            } else {
                $id = htmlspecialchars($this->input->post('id_inisialisasi', true));
                $data_Inisialisasi = [
                    'latih_inisialisasi' => htmlspecialchars($this->input->post('latih_inisialisasi', true)),
                    'uji_inisialisasi' => htmlspecialchars($this->input->post('uji_inisialisasi', true)),
                    'spread_inisialisasi_latih' => htmlspecialchars($this->input->post('spread_inisialisasi_latih', true)),
                    'spread_inisialisasi_uji' => htmlspecialchars($this->input->post('spread_inisialisasi_uji', true)),
                    'crossover_inisialisasi' => htmlspecialchars($this->input->post('crossover_inisialisasi', true)),
                    'mutasi_inisialisasi' => htmlspecialchars($this->input->post('mutasi_inisialisasi', true)),
                    'populasi_inisialisasi' => htmlspecialchars($this->input->post('populasi_inisialisasi', true)),
                    'generasi_inisialisasi' => htmlspecialchars($this->input->post('generasi_inisialisasi', true)),
                ];
                $update = $this->Inisialisasi_model->update($data_Inisialisasi, $id);
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

        $get = $this->Inisialisasi_model->get($id)->row();

        $data = [
            'row' => $get,
        ];
        echo json_encode($data);
    }

    public function delete()
    {
        $id_inisialisasi = htmlspecialchars_decode($this->input->post('id_inisialisasi', true));
        $delete = $this->Inisialisasi_model->delete($id_inisialisasi);
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
        $data = $this->Inisialisasi_model->get()->result();
        $result = [];
        $no = 1;
        if ($data == null) {
            $result['data'] = [];
        }
        foreach ($data as $index => $v_data) {
            $result['data'][] = [
                $no++,
                $v_data->latih_inisialisasi,
                $v_data->uji_inisialisasi,
                $v_data->spread_inisialisasi_latih,
                $v_data->spread_inisialisasi_uji,
                $v_data->crossover_inisialisasi,
                $v_data->mutasi_inisialisasi,
                $v_data->populasi_inisialisasi,
                $v_data->generasi_inisialisasi,
                '
                <div class="text-center">
                    <a href="' . base_url('Admin/Perhitungan?inisialisasi_id=' . $v_data->id_inisialisasi) . '" class="btn btn-primary" title="Perhitungan algoritma genetika">
                        <i class="fas fa-calculator"></i>
                    </a>
                    <a href="' . base_url('Admin/Inisialisasi/edit/' . $v_data->id_inisialisasi) . '" class="btn btn-warning btn-edit" data-id_inisialisasi="' . $v_data->id_inisialisasi . '">
                        <i class="fas fa-pencil-alt"></i>
                    </a>
                    <a href="' . base_url('Admin/Inisialisasi/delete/' . $v_data->id_inisialisasi) . '" class="btn btn-danger btn-delete" data-id_inisialisasi="' . $v_data->id_inisialisasi . '">
                        <i class="fas fa-trash"></i>
                    </a>
                </div>
                '
            ];
        }
        echo json_encode($result);
    }
}
