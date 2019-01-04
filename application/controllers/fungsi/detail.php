<?php

class Detail extends CI_Controller {

    function id() {
        $this->load->model('fungsi/fungsimodel', 'fungsi', TRUE);
        $this->load->library('pagination');
        if (!empty($_POST['EDIT'])) {
            $note = "";
            //zzzzzzzzzzzzzzzzzzzzzzzzz
            if (empty($_POST['nama_fungsi'])) {

                $this->session->set_flashdata('notifikasi', "<p>Terjadi Kesalahan: </p><ul><li><b>Nama Fungsi</b> Harus diisi</li> </p>");
                $this->session->set_flashdata('status', 'form-message error');
                redirect('fungsi/detail/id/' . $this->uri->segment(4));
            } else {
                $this->fungsi->edit_fungsi($this->uri->segment(4));
                $this->session->set_flashdata('notifikasi', '<p>Pesan Berhasil</p><ul><li><b>Fungsi Telah berhasil diedit!</b> </li> </ul></p>');
                $this->session->set_flashdata('status', 'form-message correct');
                redirect('fungsi/detail/id/' . $this->uri->segment(4));
            }
        }

        $this->db->order_by("nama_fungsi", "asc");
        $this->db->select('*');
        $this->db->from('tbl_fungsi');
        $query = $this->db->count_all_results();
        $data['jml'] = $query;
        $data['fungsi'] = $this->fungsi->detail_fungsi($this->uri->segment(4));
        //skins chooser
        $skin_val = $this->config->item('skin');
        $data['skin_val'] = $skin_val;
        if ($skin_val != "") {
            $this->load->view('skins/' . $skin_val . '/fungsi/detail', $data);
        } else {
            $this->load->view('fungsi/detail', $data);
        }
    }

}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */