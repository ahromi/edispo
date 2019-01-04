<?php
$username = $this->session->userdata('SESSION_USERNAME');
if (!empty($username)) {
    $this->load->view('tmpl/header');
    $note = $this->session->flashdata('note');
    ?>
    <script language="javascript">
    </script>
    <div id="content">
        <div id="main-content">
            <h2>Ubah Password</h2>
            <form name="form" id="form" method="post">
                <fieldset>

                    <ul class="align-list">
                        <?php if (!empty($note)) { ?>
                            <script language="javascript">window.alert('<?= $note; ?>');</script>
                        <?php } ?>
                        <li>
                            <label for="addarticle-title">Kata Sandi Lama </label>
                            <input type="password" value="" id="paswd_lama" name="paswd_lama" class="box-medium" />
                        </li>
                        <li>
                            <label for="addarticle-title">Kata Sandi Baru</label>
                            <input type="password" value="" id="paswd_baru" name="paswd_baru" class="box-medium" />
                        </li>
                        <li>
                            <label for="addarticle-title">Tulis Ulang</label>
                            <input type="password" value="" id="paswd_baru_ulang" name="paswd_baru_ulang" class="box-medium" />
                        </li>
                        <li>
                            <label></label>
                            <input type="submit" name="SUBMIT" value="Submit" class="green" />
                        </li>
                        <li>
                    </ul>
                </fieldset>
            </form>
        </div>
    </div>
    <?php $this->load->view('tmpl/footer'); ?>
    <?php
} else {
    redirect('');
}
?>