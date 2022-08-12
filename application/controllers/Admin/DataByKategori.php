<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Reader\Xlsx as Xlsximport;

class DataByKategori extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        check_not_login();
        if (!$this->session->has_userdata('id_admin')) {
            show_404();
        }
        $this->load->model(['DataByKategori/DataByKategori_model']);
    }
    public function index()
    {
        $kategori_id = $this->input->get('kategori_id');
        $this->breadcrumbs->push('Home', 'Admin/Home');
        $this->breadcrumbs->push('Kategori', 'Admin/Kategori');
        $this->breadcrumbs->push('DataByKategori', 'Admin/DataByKategori?kategori_id=' . $kategori_id);
        // output
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        $data['title'] = 'DataByKategori';
        $data['result'] = $this->DataByKategori_model->get()->result();
        $data['kategori_id'] = $this->input->get('kategori_id', true);
        $this->template->admin('admin/databykategori/main', $data);
    }

    public function process()
    {
        $this->form_validation->set_rules('tahun', 'Tahun', 'required|callback_validateTahun');
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
                $data_DataByKategori = [
                    'januari' => htmlspecialchars($this->input->post('januari', true)),
                    'februari' => htmlspecialchars($this->input->post('februari', true)),
                    'maret' => htmlspecialchars($this->input->post('maret', true)),
                    'april' => htmlspecialchars($this->input->post('april', true)),
                    'mei' => htmlspecialchars($this->input->post('mei', true)),
                    'juni' => htmlspecialchars($this->input->post('juni', true)),
                    'juli' => htmlspecialchars($this->input->post('juli', true)),
                    'agustus' => htmlspecialchars($this->input->post('agustus', true)),
                    'september' => htmlspecialchars($this->input->post('september', true)),
                    'oktober' => htmlspecialchars($this->input->post('oktober', true)),
                    'november' => htmlspecialchars($this->input->post('november', true)),
                    'desember' => htmlspecialchars($this->input->post('desember', true)),
                    'tahun' => htmlspecialchars($this->input->post('tahun', true)),
                    'kategori_id' => htmlspecialchars($this->input->post('kategori_id', true)),
                ];
                $insert = $this->DataByKategori_model->insert($data_DataByKategori);
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
                $id = htmlspecialchars($this->input->post('id_databykategori', true));
                $data = [
                    'status' => 'error',
                    'output' => $this->form_validation->error_array()
                ];
                echo json_encode($data);
            } else {
                $id = htmlspecialchars($this->input->post('id_databykategori', true));
                $data_DataByKategori = [
                    'januari' => htmlspecialchars($this->input->post('januari', true)),
                    'februari' => htmlspecialchars($this->input->post('februari', true)),
                    'maret' => htmlspecialchars($this->input->post('maret', true)),
                    'april' => htmlspecialchars($this->input->post('april', true)),
                    'mei' => htmlspecialchars($this->input->post('mei', true)),
                    'juni' => htmlspecialchars($this->input->post('juni', true)),
                    'juli' => htmlspecialchars($this->input->post('juli', true)),
                    'agustus' => htmlspecialchars($this->input->post('agustus', true)),
                    'september' => htmlspecialchars($this->input->post('september', true)),
                    'oktober' => htmlspecialchars($this->input->post('oktober', true)),
                    'november' => htmlspecialchars($this->input->post('november', true)),
                    'desember' => htmlspecialchars($this->input->post('desember', true)),
                    'tahun' => htmlspecialchars($this->input->post('tahun', true)),
                    'kategori_id' => htmlspecialchars($this->input->post('kategori_id', true)),
                ];
                $update = $this->DataByKategori_model->update($data_DataByKategori, $id);
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

        $get = $this->DataByKategori_model->get($id)->row();

        $data = [
            'row' => $get,
        ];
        echo json_encode($data);
    }

    public function delete()
    {
        $id_databykategori = htmlspecialchars_decode($this->input->post('id_databykategori', true));
        $delete = $this->DataByKategori_model->delete($id_databykategori);
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
        $kategori_id = $this->input->get('kategori_id', true);
        $data = $this->DataByKategori_model->get(null, $kategori_id)->result();
        $result = [];
        $no = 1;
        if ($data == null) {
            $result['data'] = [];
        }
        foreach ($data as $index => $v_data) {
            $result['data'][] = [
                $no++,
                $v_data->tahun,
                $v_data->januari,
                $v_data->februari,
                $v_data->maret,
                $v_data->april,
                $v_data->mei,
                $v_data->juni,
                $v_data->juli,
                $v_data->agustus,
                $v_data->september,
                $v_data->oktober,
                $v_data->november,
                $v_data->desember,
                '
                <div class="text-center">
                    <a href="' . base_url('Admin/DataByKategori/edit/' . $v_data->id_databykategori) . '" class="btn btn-warning btn-edit" data-id_databykategori="' . $v_data->id_databykategori . '">
                        <i class="fas fa-pencil-alt"></i>
                    </a>
                    <a href="' . base_url('Admin/DataByKategori/delete/' . $v_data->id_databykategori) . '" class="btn btn-danger btn-delete" data-id_databykategori="' . $v_data->id_databykategori . '">
                        <i class="fas fa-trash"></i>
                    </a>
                </div>
                '
            ];
        }
        echo json_encode($result);
    }
    public function validateTahun()
    {
        $boolean = TRUE;
        $tahun = $this->input->post('tahun', true);
        $id_databykategori = $this->input->post('id_databykategori', true);
        if ($_POST['page'] == 'add') {
            $check = $this->db->get_where('databykategori', [
                'tahun' => $tahun
            ])->num_rows();
            if ($check > 0) {
                $this->form_validation->set_message('validateTahun', "Tahun sudah diinput");
                $boolean = FALSE;
            }
        } else {
            $check = $this->db->get_where('databykategori', [
                'tahun' => $tahun,
                'id_databykategori <> ' => $id_databykategori
            ])->num_rows();
            if ($check > 0) {
                $this->form_validation->set_message('validateTahun', "Tahun sudah diinput sebelumnya");
                $boolean = FALSE;
            }
        }
        return $boolean;
    }
    public function import()
    {
        $kategori_id =  $this->input->post('kategori_id', true);
        $file_mimes = array('application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

        if (isset($_FILES['import']['name']) && in_array($_FILES['import']['type'], $file_mimes)) {
            $arr_file = explode('.', $_FILES['import']['name']);
            $extension = end($arr_file);

            if ('csv' == $extension) {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
            } else {
                $reader = new Xlsximport;
            }


            $spreadsheet = $reader->load($_FILES['import']['tmp_name']);
            $sheetData = $spreadsheet->getActiveSheet()->toArray();

            $dataByKategori = [];
            for ($i = 3; $i < count($sheetData); $i++) {
                $cek = $sheetData[$i][0];
                if ($cek != null) {
                    $count[] = $i;
                    // warga
                    $dataByKategori[] = [
                        'tahun' => $sheetData[$i]['0'],
                        'januari' => $sheetData[$i]['1'],
                        'februari' => $sheetData[$i]['2'],
                        'maret' => $sheetData[$i]['3'],
                        'april' => $sheetData[$i]['4'],
                        'mei' => $sheetData[$i]['5'],
                        'juni' => $sheetData[$i]['6'],
                        'juli' => $sheetData[$i]['7'],
                        'agustus' => $sheetData[$i]['8'],
                        'september' => $sheetData[$i]['9'],
                        'oktober' => $sheetData[$i]['10'],
                        'november' => $sheetData[$i]['11'],
                        'desember' => $sheetData[$i]['12'],
                        'kategori_id' => $kategori_id,
                    ];
                }
            }
            $rows = $this->DataByKategori_model->insertMany($dataByKategori);


            if ($rows) {
                $this->session->set_flashdata('success', 'Berhasil import ' . $rows . ' data');
            } else {
                $this->session->set_flashdata('error', 'Terjadi kesalahan import data');
            }
            return redirect(base_url('Admin/DataByKategori?kategori_id=' . $kategori_id));
        } else {
            $this->session->set_flashdata('error', 'Type file tidak sesuai format, harus excel');
            return redirect(base_url('Admin/DataByKategori?kategori_id=' . $kategori_id));
        }
    }
}
