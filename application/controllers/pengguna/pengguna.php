<?php

class Pengguna extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
    }

    function index() {
        $this->load->model('pengguna/penggunamodel', 'pengguna', TRUE);
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
                        $this->pengguna->delete_pengguna($item);
                    }
                    $this->session->set_flashdata('notifikasi', '<p>Pesan Berhasil</p><ul><li><b>Pengguna yang dipilih Berhasil Dihapus.</b> </li> </ul></p>');
                    $this->session->set_flashdata('statusMany', 'form-message correct');
                } else {
                    $this->session->set_flashdata('notifikasi', '<p>Pesan Kesalahan</p><ul><li><b>Anda belum memilih aksi.</b> </li> </ul></p>');
                    $this->session->set_flashdata('statusMany', 'form-message error');
                }
                redirect('pengguna/pengguna');
            } elseif (!empty($_POST['TAMBAH'])) {
                $note = "";
                if (empty($_POST['user_nama']) || empty($_POST['user_password']) || empty($_POST['user_namalengkap']) || $_POST['fungsi_kd'] == "") {
                    if (empty($_POST['user_username']) && empty($_POST['user_password']) && empty($_POST['user_namalengkap']) && $_POST['fungsi_kd'] == "0") {
                        $this->session->set_flashdata('notifikasi', '<p>Terjadi Beberapa Kesalahan:</p><ul><li><b>Username </b> Harus diisi</li> <li><b>Password</b>  Harus diisi</li><li><b>Fungsi Pengguna </b> Harus diisi</li> <li><b>Nama Pengguna</b>  Harus diisi</li></p>');
                        $this->session->set_flashdata('status', 'form-message error');
                    } else {
                        if (empty($_POST['user_nama'])) {
                            $note = $note . '<li><b>Username </b>  Harus diisi</li> ';
                        }
                        if (empty($_POST['user_password'])) {
                            $note = $note . '<li><b>Password </b>  Harus diisi</li>  ';
                        }
                        if ($_POST['fungsi_kd'] == "0") {
                            $note = $note . '<li><b>Fungsi Pengguna</b>  Harus diisi</li> ';
                        }
                        if (empty($_POST['user_namalengkap'])) {
                            $note = $note . '<li><b>Nama Pengguna </b>  Harus diisi</li>  ';
                        }
                        $this->session->set_flashdata('user_nama', $_POST['user_nama']);
                        $this->session->set_flashdata('user_namalengkap', $_POST['user_namalengkap']);

                        $this->session->set_flashdata('notifikasi', '<p>Terjadi Kesalahan:</p><ul>' . $note . '</ul></p>');
                    }
                    redirect('pengguna/pengguna');
                } else {

                    if (!empty($_FILES['userfile']['name'])) {
                        $config['upload_path'] = './uploads/';
                        $config['allowed_types'] = '*';
                        $config['max_size'] = '1000';
                        $config['max_width'] = '3000';
                        $config['max_height'] = '4000';

                        $this->load->library('upload', $config);

                        if (!$this->upload->do_upload()) {
                            $this->session->set_flashdata('notifikasi', '<p>Terjadi Kesalahan:</p><ul>Upload Foto Gagal, Pastikan ukuran maximal 300x400px dan tidak lebih dari 100KB.</ul></p>');
                            $this->session->set_flashdata('status', 'form-message error');
                            redirect('pengguna/pengguna');
                        } else {
                            //tambah pengguna degan upload foto
                            $this->pengguna->tambah_pengguna_with_foto();
                            $this->session->set_flashdata('notifikasi', '<p>Pesan Berhasil</p><ul><li><b>Pengguna Baru Telah berhasil didaftarkan.</b> </li> </ul></p>');
                            $this->session->set_flashdata('status', 'form-message correct');
                        }
                    } else {
                        //tambah pengguna tanpa upload foto
                        $this->pengguna->tambah_pengguna();
                        $this->session->set_flashdata('notifikasi', '<p>Pesan Berhasil</p><ul><li><b>Pengguna Baru Telah berhasil didaftarkan.</b> </li> </ul></p>');
                        $this->session->set_flashdata('status', 'form-message correct');
                    }
                    redirect('pengguna/pengguna');
                }
            }
            $config['uri_segment'] = 4;
            $config['base_url'] = base_url() . 'index.php/pengguna/pengguna/index';

            $this->db->order_by("user_kd", "desc");
            $this->db->select('*');
            $this->db->from('tbl_user');
            $this->db->join('tbl_fungsi', 'tbl_user.fungsi_kd= tbl_fungsi.fungsi_kd');
            $query = $this->db->count_all_results();

            $config['total_rows'] = $query;
            $config['per_page'] = '10';
            $this->pagination->initialize($config);

            $offset = $this->uri->segment(4);

            if (empty($offset))
                $offset = 0;
            $data['opset'] = $offset;
            $data['pengguna'] = $this->pengguna->get_data_pengguna($config['per_page'], $offset);
            $data['fungsi'] = $this->pengguna->cmb_fungsi();
        } else {
            $data['opset'] = 0;
            $data['fungsi'] = $this->pengguna->cmb_fungsi();
            $data['pengguna'] = $this->pengguna->search_data_pengguna($_POST['key']);
        }
        //skins chooser
        $skin_val = $this->config->item('skin');
        $data['skin_val'] = $skin_val;
        if ($skin_val != "") {
            $this->load->view('skins/' . $skin_val . '/pengguna/pengguna', $data);
        } else {
            $this->load->view('pengguna/pengguna', $data);
        }
    }

}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */