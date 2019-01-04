<?php

class Delegate extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
    }

    function index() {
        $this->load->model('delegate/delegatemodel', 'delegate', TRUE);
        $id = $this->uri->segment(4);
        if (!empty($_POST['Delegasi'])) {
            if ($_POST['fungsi_kd'] == "0") {
                $this->session->set_flashdata('notifikasi2', 'Pesan Gagal: \n \n Pilih Fungsi yang akan menerima pendelegasian disposisis!');
                redirect('delegate/delegate');
            } else {
                $this->delegate->update_delegation($_POST['fungsi_kd']);
                $this->session->set_flashdata('notifikasi2', 'Pesan Berhasil: \n \n Proses Delegasi Berhasil dilakukan!');
                redirect('delegate/delegate');
            }
        }
        $data['delegate'] = $this->delegate->get_combo_delegate_fungsi();
        $data['delegated_fungsi'] = $this->delegate->get_fungsi_delegated();
        
        //skins chooser
        $skin_val = $this->config->item('skin');
        $data['skin_val'] = $skin_val;
        if ($skin_val != "") {
            $this->load->view('skins/' . $skin_val . '/delegate', $data);
        } else {
            $this->load->view('delegate', $data);
        }
    }

    function redelegate() {
        $this->load->model('delegate/delegatemodel', 'delegate', TRUE);
        $id = $this->uri->segment(4);
        if (empty($id)) {
            $this->session->set_flashdata('notifikasi2', 'Pesan Gagal: \n \n Pengakhiran delegasi Gagal!!');
            redirect('delegate/delegate');
        } else {
            $this->delegate->update_redelegation($id);
            $this->session->set_flashdata('notifikasi2', 'Pesan Berhasil: \n \n Proses Pengakhiran Delegasi Berhasil dilakukan! \n \n Seluruh Berita menunggu Disposisi \n diarahkan kembali kepada Kepala Perwakilan');
            redirect('delegate/delegate');
        }
    }

}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */