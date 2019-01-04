<?php

class Jenisberita extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
    }

    function index() {
        $this->load->model('jenisberita/jenisberitamodel', 'jenisberita', TRUE);
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
                        $this->jenisberita->delete_jenisberita($item);
                    }
                    $this->session->set_flashdata('notifikasi', '<p>Pesan Berhasil</p><ul><li><b>Jenis Berita yang dipilih Berhasil Dihapus.</b> </li> </ul></p>');
                    $this->session->set_flashdata('statusMany', 'form-message correct');
                } else {
                    $this->session->set_flashdata('notifikasi', '<p>Pesan Kesalahan</p><ul><li><b>Anda belum memilih aksi.</b> </li> </ul></p>');
                    $this->session->set_flashdata('statusMany', 'form-message error');
                }
                redirect('jenisberita/jenisberita');
            } elseif (!empty($_POST['TAMBAH'])) {
                $note = "";

                //zzzzzzzzzzzzzzzzzzzzzzzzzzzzzzz
                if ($_POST['jenis_nama'] == "" || $_POST['jenis_nama'] == "0") {

                    $this->session->set_flashdata('notifikasi', "<p>Terjadi Kesalahan: </p><ul><li><b>Jenis Berita</b> Harus diisi</li> </p>");
                    $this->session->set_flashdata('status', 'form-message error');

                    redirect('jenisberita/jenisberita');
                } else {

                    //tambah jenisberita 
                    $this->jenisberita->tambah_jenisberita();
                    $this->session->set_flashdata('notifikasi', '<p>Pesan Berhasil</p><ul><li><b>Jenis Berita Baru Telah berhasil didaftarkan.</b> </li> </ul></p>');
                    $this->session->set_flashdata('status', 'form-message correct');

                    redirect('jenisberita/jenisberita');
                }
            }
            $config['uri_segment'] = 4;
            $config['base_url'] = base_url() . 'index.php/jenisberita/jenisberita/index';

            $this->db->order_by("jenis_nama", "asc");
            $this->db->select('*');
            $this->db->from('tbl_jenis_berita');
            $query = $this->db->count_all_results();

            $config['total_rows'] = $query;
            $config['per_page'] = '10';
            $this->pagination->initialize($config);

            $offset = $this->uri->segment(4);

            if (empty($offset))
                $offset = 0;
            $data['opset'] = $offset;
            $data['jenisberita'] = $this->jenisberita->get_data_jenisberita($config['per_page'], $offset);

            
        } else {
            $data['opset'] = 0;
            $data['jenisberita'] = $this->jenisberita->search_data_jenisberita($_POST['key']);
        }
        //skins chooser
        $skin_val = $this->config->item('skin');
        $data['skin_val'] = $skin_val;
        if ($skin_val != "") {
            $this->load->view('skins/' . $skin_val . '/jenisberita/jenisberita', $data);
        } else {
            $this->load->view('jenisberita/jenisberita', $data);
        }
    }

}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */