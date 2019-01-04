<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller {

    function index() {
        $skin_val = $this->config->item('skin');

        $this->load->model('install/installmodel', 'install', TRUE);
        $val['setting'] = $this->install->getSetting();
        $val['ver'] = $this->install->getVersion();

        //echo $val['setting'][0]['nama_perwakilan'];

        $this->session->set_userdata('nama_perwakilan', $val['setting'][0]['nama_perwakilan']);
        $this->session->set_userdata('nama_singkat_perwakilan', $val['setting'][0]['nama_singkat_perwakilan']);
        $this->session->set_userdata('nama_jabatan_kepala_perwakilan', $val['setting'][0]['nama_jabatan_kepala_perwakilan']);
        $this->session->set_userdata('warna_latar', $val['setting'][0]['warna_latar']);
        $this->session->set_userdata('email_administrator', $val['setting'][0]['email_administrator']);
        $this->session->set_userdata('alamat_perwakilan', $val['setting'][0]['alamat_perwakilan']);
        $this->session->set_userdata('ver_name', $val['ver'][0]['version_name']);
        $this->session->set_userdata('ver_rel', $val['ver'][0]['version_release']);
        if (!isset($_POST['SUBMIT'])) {

            $data['notifikasi1'] = "";
            $data['notifikasi2'] = "";
            $data['notifikasi3'] = "";
            $data['username'] = "";
            if ($skin_val != "") {
                $this->load->view('skins/' . $skin_val . '/login', $data);
            } else {
                $this->load->view('login', $data);
            }
        } else {
            if (!empty($_POST['username']) && !empty($_POST['password'])) {
                $this->load->model('pengguna/penggunamodel', 'login', TRUE);
                $data['isvalid'] = $this->login->verifikasi($_POST['username'], md5($_POST['password']));
                if (!empty($data['isvalid'])) {
                    $level = $data['isvalid'][0]['nama_fungsi'];
                    $level_id = $data['isvalid'][0]['fungsi_kd'];
                    $fungsi_input = $data['isvalid'][0]['fungsi_input'];
                    $disposisi_fungsi = $data['isvalid'][0]['disposisi_fungsi'];
                    $this->session->set_userdata('SESSION_FUNGSI', $level);
                    $this->session->set_userdata('SESSION_FUNGSI_INPUT', $fungsi_input);
                    $this->session->set_userdata('SESSION_FUNGSI_KD', $level_id);
                    $this->session->set_userdata('SESSION_DISPOSISI_FUNGSI', $disposisi_fungsi);
                    $this->session->set_userdata('SESSION_USERNAME', $data['isvalid'][0]['user_nama']);
                    $this->session->set_userdata('SESSION_NAMALENGKAP', $data['isvalid'][0]['user_namalengkap']);
                    $this->session->set_userdata('SESSION_ID', $data['isvalid'][0]['user_kd']);
                    $this->session->set_userdata('SESSION_FOTO', $data['isvalid'][0]['user_foto']);
                    $this->session->set_userdata('SESSION_MENERIMA_DISPOSISI', $data['isvalid'][0]['user_menerima_disposisi']);
                    $this->session->set_userdata('SESSION_KOORDINATOR', $data['isvalid'][0]['koordinator_fungsi']);
                    $this->session->set_userdata('SESSION_HOME_STAFF', $data['isvalid'][0]['home_staff']);
                    session_start();
                    $_SESSION['SESSION_HOME_STAFF']=$data['isvalid'][0]['home_staff'];
                    $_SESSION['SESSION_FUNGSI']=$level;
                    redirect('home');
                } else {
                    //$this->session->set_flashdata('notifikasi1','<li><blink>Username atau Password  salah!!</blink></li>');
                    $data['notifikasi1'] = "<li><blink>Username atau Password  salah!!</blink></li>";
                    $data['notifikasi2'] = "";
                    $data['notifikasi3'] = "";
                    $data['username'] = "";
                    if ($skin_val != "") {
                        $this->load->view('skins/' . $skin_val . '/login', $data);
                    } else {
                        $this->load->view('login', $data);
                    }
                }
            } else {
                if (empty($_POST['username']) && empty($_POST['password'])) {
                    //	$this->session->set_flashdata('notifikasi2','<li><font color="#FF3C3C" style="margin-left:45px;"><blink>Username tidak terisi.</blink></font></li>');
                    //$this->session->set_flashdata('notifikasi3','<li><font color="#FF3C3C" style="margin-left:45px;"><blink>Password tidak terisi.</blink></font></li>');
                    $data['username'] = "";
                    $data['notifikasi1'] = "";
                    $data['notifikasi2'] = '<li><font color="#FF3C3C" style="margin-left:45px;"><blink>Username tidak terisi.</blink></font></li>';
                    $data['notifikasi3'] = '<li><font color="#FF3C3C" style="margin-left:45px;"><blink>Password tidak terisi.</blink></font></li>';
                } elseif (empty($_POST['username'])) {
                    //$this->session->set_flashdata('notifikasi2','<li><font color="#FF3C3C" style="margin-left:45px;"><blink>Username tidak terisi.</blink></font></li>');
                    //$this->session->set_flashdata('username',$_POST['username']);
                    $data['notifikasi1'] = "";
                    $data['notifikasi2'] = '<li><font color="#FF3C3C" style="margin-left:45px;"><blink>Username tidak terisi.</blink></font></li>';
                    $data['username'] = $_POST['username'];
                    $data['notifikasi3'] = "";
                } elseif (empty($_POST['password'])) {
                    //$this->session->set_flashdata('notifikasi3','<li><font color="#FF3C3C" style="margin-left:45px;"><blink>Password tidak terisi.</blink></font></li>');
                    $data['username'] = "";
                    $data['notifikasi2'] = "";
                    $data['notifikasi3'] = "";
                    $data['notifikasi1'] = '<li><font color="#FF3C3C" style="margin-left:45px;"><blink>Password tidak terisi.</blink></font></li>';
                }
                if ($skin_val != "") {
                    $this->load->view('skins/' . $skin_val . '/login', $data);
                } else {
                    $this->load->view('login', $data);
                }
            }
        }
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */