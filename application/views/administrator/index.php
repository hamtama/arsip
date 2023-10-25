<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <!-- <h3>Multilevel Menu <small> Page to demonstrate multilevel menu</small></h3> -->
                <!-- <?= $this->session->userdata('id_role') ?> -->
                <!-- <?= $this->session->userdata('username') ?> -->
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="">
                    <div class="x_content">
                        <div class="card mb-3">
                            <div class="card-header">
                                <h2><b>Filter Data</b></h2>
                            </div>
                            <div class="card-body">
                                <div class="col-md-12">
                                    <div class="col-md-6 col-sm-6">
                                        <div class="form-group mb-3">
                                            <label class="col-form-label label-align  pl-0">Bulan</label>
                                            <div class="col-sm-12 p-0">
                                                <input type="month" class="form-control" placeholder="Bulan" id="bulan"
                                                    name="bulan">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <div class="form-group mb-3">
                                            <label class=" col-form-label label-align pl-0">Tahun</label>
                                            <div class="col-sm-12 p-0">
                                                <?php
                                        $tanggal = date('Y');
                                        $mulai_tanggal = 2000;
                                        $hinggal_tanggal = date('Y');
                                        print '<select class="form-control" id="tahun" name="tahun_cetak">';
                                        print '<option value ="">-- Pilih Tahun --</option>';
                                        foreach (range($hinggal_tanggal, $mulai_tanggal) as $cetak_tahun) {
                                            print '<option value="' . $cetak_tahun . '"' . ($cetak_tahun === $tanggal ? ' selected="selected"' : '') . '>' . $cetak_tahun . '</option>';
                                        }
                                        print '</select>';
                                        ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="x_content">
                                <!-- <canvas id=canvas height=200 width=500></canvas> -->
                                <canvas id="kejahatan"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->