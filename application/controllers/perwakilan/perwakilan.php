<?php

class Perwakilan extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
    }

    function index() {
        $this->load->model('perwakilan/perwakilanmodel', 'perwakilan', TRUE);
        $config['full_tag_open'] = '<ul class="pagination tcenter">';

        $config['first_tag_open'] = '<li class="page radius2">';
        $config['first_link'] = '<<';
        $config['first_tag_close'] = '</li>';

        $config['last_tag_open'] = '<li class="page radius2">';
        $config['last_link'] = '>>';
        $config['last_tag_close'] = '</li>';

        $config['next_tag_open'] = '<li class="page radius2">';
        $config['next_link'] = '>';
        $config['next_tag_close'] = '</li>';

        $config['prev_tag_open'] = '<li class="page radius2">';
        $config['prev_link'] = '<';
        $config['prev_tag_close'] = '</li>';

        $config['cur_tag_open'] = '<li class="page radius2">';
        $config['cur_tag_close'] = '</li>';

        $config['num_tag_open'] = '<li class="page radius2">';
        $config['num_tag_close'] = '</li>';
        $config['full_tag_close'] = '</ul>';

        $this->load->library('pagination');
        if (empty($_POST['CARI'])) {
            if (!empty($_POST['LAKUKAN'])) {
                if ($_POST['aksi'] == 'Hapus') {
                    foreach ($_POST['check'] as $item) {
                        $this->perwakilan->delete_perwakilan($item);
                    }
                    $this->session->set_flashdata('notifikasi', '<p>Pesan Berhasil</p><ul><li><b>Perwakilan yang dipilih Berhasil Dihapus.</b> </li> </ul></p>');
                    $this->session->set_flashdata('statusMany', 'form-message correct');
                } else {
                    $this->session->set_flashdata('notifikasi', '<p>Pesan Kesalahan</p><ul><li><b>Anda belum memilih aksi.</b> </li> </ul></p>');
                    $this->session->set_flashdata('statusMany', 'form-message error');
                }
                redirect('perwakilan/perwakilan');
            } elseif (!empty($_POST['TAMBAH'])) {
                $note = "";

                //zzzzzzzzzzzzzzzzzzzzzzzzzzzzzzz
                if ($_POST['perwakilan_nama'] == "" || $_POST['perwakilan_nama'] == "0") {

                    $this->session->set_flashdata('notifikasi', "<p>Terjadi Kesalahan: </p><ul><li><b>Nama Perwakilan</b> Harus diisi</li> </p>");
                    $this->session->set_flashdata('status', 'form-message error');

                    redirect('perwakilan/perwakilan');
                } else {

                    //tambah perwakilan 
                    $this->perwakilan->tambah_perwakilan();
                    $this->session->set_flashdata('notifikasi', '<p>Pesan Berhasil</p><ul><li><b>Perwakilan Baru Telah berhasil didaftarkan.</b> </li> </ul></p>');
                    $this->session->set_flashdata('status', 'form-message correct');

                    redirect('perwakilan/perwakilan');
                }
            }
            $config['uri_segment'] = 4;
            $config['base_url'] = base_url() . 'index.php/perwakilan/perwakilan/index';

            $this->db->order_by("perwakilan_nama", "desc");
            $this->db->select('*');
            $this->db->from('tbl_perwakilan');
            $query = $this->db->count_all_results();

            $config['total_rows'] = $query;
            $config['per_page'] = '10';
            $this->pagination->initialize($config);

            $offset = $this->uri->segment(4);

            if (empty($offset))
                $offset = 0;
            $data['opset'] = $offset;
            $data['perwakilan'] = $this->perwakilan->get_data_perwakilan($config['per_page'], $offset);
        } else {
            $data['opset'] = 0;
            $data['perwakilan'] = $this->perwakilan->search_data_perwakilan($_POST['key']);
        }

        //skins chooser
        $skin_val = $this->config->item('skin');
        $data['skin_val'] = $skin_val;
        if ($skin_val != "") {
            $this->load->view('skins/' . $skin_val . '/perwakilan/perwakilan', $data);
        } else {
            $this->load->view('perwakilan/perwakilan', $data);
        }
    }

}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */