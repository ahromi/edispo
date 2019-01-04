<?php
$username = $this->session->userdata('SESSION_USERNAME');
if (!empty($username)) {
    $this->load->view('skins/dfajar/tmpl/header');
    $note = $this->session->flashdata('note');
    ?>
    <div class="page-content" style="font-family: Arial, Helvetica, sans-serif">
        <!-- begin PAGE TITLE ROW -->
        <div class="row">
            <div class="col-lg-12">
                <div class="portlet portlet-default">
                    <div class="portlet-heading">
                        <div class="portlet-title">
                            <h4>Ubah Password</h4>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div id="horizontalFormExample" class="panel-collapse collapse in">
                        <div class="portlet-body">
                            <?php if (!empty($note)) { ?>
                                <script language="javascript">window.alert('<?= $note; ?>');</script>
                            <?php } ?>
                                <form id="form" method="post" class="form-horizontal" role="form">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Kata Sandi Lama </label>
                                    <div class="col-sm-10">
                                        <input type="password" value="" id="paswd_lama" name="paswd_lama" class="form-control" placeholder="Kata Sandi Lama">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-2 control-label">Kata Sandi Baru</label>
                                    <div class="col-sm-10">
                                        <input type="password" value="" id="paswd_baru" name="paswd_baru" placeholder="Kata Sandi Baru" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-2 control-label">Tulis Ulang</label>
                                    <div class="col-sm-10">
                                        <input type="password" value="" id="paswd_baru_ulang" name="paswd_baru_ulang"  placeholder="Tulis Ulang Sandi Baru" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button style="display: none;" type="submit" disabled="" class="btn btn-default" id="btn_loading"><i class='fa fa-circle-o-notch fa-spin'></i> Submitting ..</button>
                                        <input type="submit" name="SUBMIT" class="btn btn-default" value="Submit">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php $this->load->view('skins/dfajar/tmpl/footer'); ?>
    <?php
} else {
    redirect('');
}
?>