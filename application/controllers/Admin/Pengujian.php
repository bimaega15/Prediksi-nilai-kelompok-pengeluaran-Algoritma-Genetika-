<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengujian extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        check_not_login();
        if (!$this->session->has_userdata('id_admin')) {
            show_404();
        }
        $this->load->model('Pengujian/Pengujian_model');
    }
    public function index()
    {
        $this->breadcrumbs->push('Home', 'Admin/Home');
        $this->breadcrumbs->push('Pengujian', 'Admin/Pengujian');
        // output
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        $data['title'] = 'Pengujian';
        $data['result'] = $this->Pengujian_model->getJoin()->result();
        $this->template->admin('admin/pengujian/main', $data);
    }

    public function process()
    {
        $getAlgoritma = $this->session->userdata('algoritma_genetika');
        $checkPrediksi = $getAlgoritma['checkPrediksi'];
        $row_inisialisasi = $getAlgoritma['row_inisialisasi'];
        $pengujianmapePrediksi = $getAlgoritma['algoritma_genetika']['pengujianmapePrediksi'];
        $pengujianprediksi = $getAlgoritma['algoritma_genetika']['pengujianprediksi'];
        $data = [];
        foreach ($pengujianprediksi as $kategori_id => $value) {
            $bulan = $checkPrediksi[$kategori_id];
            $string = '';
            foreach ($bulan as $tahun => $v_bulan) {
                foreach ($v_bulan as $bulan => $value) {
                    $string = $bulan . '-' . $tahun;
                }
            }
            // explode bulan dan tahun
            $exp = explode('-', $string);
            $bulan = $exp[0];
            $tahun = $exp[1];
            $keterangan = 'Bulan ' . convertToBulan($bulan) . ' Tahun ' . $tahun;


            $data[] = [
                'kategori_id' => $kategori_id,
                'inisialisasi_id' => $row_inisialisasi->id_inisialisasi,
                'bulan_prediksi_pengujian' => $bulan,
                'tahun_prediksi_pengujian' => $tahun,
                'keterangan_prediksi_pengujian' => $keterangan,
                'mape_prediksi_pengujian' => $pengujianmapePrediksi[$kategori_id],
                'data_prediksi_pengujian' => $pengujianprediksi[$kategori_id],
            ];
        }

        // insert
        $insertAffected = $this->Pengujian_model->insertMany($data);
        if ($insertAffected) {
            $this->session->set_flashdata('success', 'Berhasil menambahkan pengujian');
            return redirect(base_url('Admin/Pengujian'));
        } else {
            $this->session->set_flashdata('error', 'Gagal menambahkan pengujian');
            return redirect(base_url('Admin/Pengujian'));
        }
    }

    public function delete()
    {
        $id_pengujian = htmlspecialchars($this->input->post('id_pengujian', true));
        $delete = $this->Pengujian_model->delete($id_pengujian);
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
        $data = $this->Pengujian_model->getJoin()->result();
        $result = [];
        $no = 1;
        if ($data == null) {
            $result['data'] = [];
        }
        foreach ($data as $index => $v_data) {
            $result['data'][] = [
                $no++,
                $v_data->nama_kategori,
                convertToBulan($v_data->bulan_prediksi_pengujian),
                $v_data->tahun_prediksi_pengujian,
                $v_data->keterangan_prediksi_pengujian,
                round($v_data->mape_prediksi_pengujian, 3),
                round($v_data->data_prediksi_pengujian, 3),
                '
                <div class="text-center">
                    <a href="' . base_url('Admin/Pengujian/delete/' . $v_data->id_pengujian) . '" class="btn btn-danger btn-delete" data-id_pengujian="' . $v_data->id_pengujian . '">
                        <i class="fas fa-trash"></i>
                    </a>
                </div>
                '
            ];
        }
        echo json_encode($result);
    }
}
