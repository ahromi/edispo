<?php

class Instruksi extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
    }

    function index() {
        $this->load->model('instruksi/instruksimodel', 'instruksi', TRUE);
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
                        $this->instruksi->delete_instruksi($item);
                    }
                    $this->session->set_flashdata('notifikasi', '<p>Pesan Berhasil</p><ul><li><b>Instruksi yang dipilih Berhasil Dihapus.</b> </li> </ul></p>');
                    $this->session->set_flashdata('statusMany', 'form-message correct');
                } else {
                    $this->session->set_flashdata('notifikasi', '<p>Pesan Kesalahan</p><ul><li><b>Anda belum memilih aksi.</b> </li> </ul></p>');
                    $this->session->set_flashdata('statusMany', 'form-message error');
                }
                redirect('instruksi/instruksi');
            } elseif (!empty($_POST['TAMBAH'])) {
                $note = "";
                if ($_POST['instruksi_nama'] == "") {
                    $this->session->set_flashdata('notifikasi', "<p>Terjadi Kesalahan: </p><ul><li><b>Instruksi</b> Harus diisi</li> </p>");
                    $this->session->set_flashdata('status', 'form-message error');

                    redirect('instruksi/instruksi');
                } else {

                    //tambah instruksi 
                    $this->instruksi->tambah_instruksi();
                    $this->session->set_flashdata('notifikasi', '<p>Pesan Berhasil</p><ul><li><b>Instruksi Baru Telah berhasil didaftarkan.</b> </li> </ul></p>');
                    $this->session->set_flashdata('status', 'form-message correct');

                    redirect('instruksi/instruksi');
                }
            }
            $config['uri_segment'] = 4;
            $config['base_url'] = base_url() . 'index.php/instruksi/instruksi/index';

            $this->db->order_by("instruksi_nama", "asc");
            $this->db->select('*');
            $this->db->from('tbl_instruksi');
            $query = $this->db->count_all_results();

            $config['total_rows'] = $query;
            $config['per_page'] = '10';
            $this->pagination->initialize($config);

            $offset = $this->uri->segment(4);

            if (empty($offset))
                $offset = 0;
            $data['opset'] = $offset;
            $data['instruksi'] = $this->instruksi->get_data_instruksi($config['per_page'], $offset);

//            $this->load->view('instruksi/instruksi', $data);
        } else {
            $data['opset'] = 0;
            $data['instruksi'] = $this->instruksi->search_data_instruksi($_POST['key']);
            
        }
        
        //skins chooser
        $skin_val = $this->config->item('skin');
        $data['skin_val'] = $skin_val;
        if ($skin_val != "") {
            $this->load->view('skins/' . $skin_val . '/instruksi/instruksi', $data);
        } else {
            $this->load->view('instruksi/instruksi', $data);
        }
    }

}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */