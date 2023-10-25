<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <!-- <h3>Multilevel Menu <small> Page to demonstrate multilevel menu</small></h3> -->
                <? //$user['email']; 
                ?>
                <? //$this->session->userdata('id_role') ;
                ?>

                <div class="row">
                    <div class="col-md-12">
                        <div class="">
                            <div class="x_content">
                                <div class="row">
                                    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6  ">
                                        <div class="tile-stats">
                                            <div class="icon"><i class="fa fa-caret-square-o-right"></i>
                                            </div>
                                            <div class="count">179</div>
                                            <h3>New Sign ups</h3>
                                            <p>Lorem ipsum psdea itgum rixt.</p>
                                        </div>
                                    </div>
                                    <div class="animated flipInY col-lg-4 col-md-3 col-sm-6  ">
                                        <div class="tile-stats">
                                            <div class="icon"><i class="fa fa-comments-o"></i>
                                            </div>
                                            <div class="count">179</div>
                                            <h3>New Sign ups</h3>
                                            <p>Lorem ipsum psdea itgum rixt.</p>
                                        </div>
                                    </div>
                                    <div class="animated flipInY col-lg-4 col-md-3 col-sm-6  ">
                                        <div class="tile-stats">
                                            <div class="icon"><i class="fa fa-sort-amount-desc"></i>
                                            </div>
                                            <div class="count">179</div>
                                            <h3>New Sign ups</h3>
                                            <p>Lorem ipsum psdea itgum rixt.</p>
                                        </div>
                                    </div>
                                    <div class="animated flipInY col-lg-4 col-md-3 col-sm-6  ">
                                        <div class="tile-stats">
                                            <div class="icon"><i class="fa fa-check-square-o"></i>
                                            </div>
                                            <div class="count">179</div>
                                            <h3>New Sign ups</h3>
                                            <p>Lorem ipsum psdea itgum rixt.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="">
                    <div class="x_content">
                        <div class="row">
                            <?php
                            $query = "SELECT * FROM tb_status";
                            $count = $this->db->count_all('tb_status');
                            $s = $this->db->query($query)->result_array();
                            // echo $s['id_status'];

                            foreach ($s as $row) :
                                $id = $row['id_status'];
                                $this->db->select('*');
                                $this->db->from('tb_surat_masuk');
                                $this->db->join('tb_status', 'tb_surat_masuk.status = tb_status.id_status');
                                $this->db->where('tb_surat_masuk.status', $id);
                                $data =  $this->db->get()->row_array();
                                $count = $this->db->get_where('tb_surat_masuk', ['status' => $id])->num_rows();
                                // $status = $this->db->get('tb_status')->row_array();
                                // $count = $count->num_rows();
                                $status = $this->db->get_where('tb_status', ['id_status' => $id])->row_array();
                                switch ($status['id_status']) {
                                    case "1":
                                        $icon = "fa fa-plus";
                                        break;
                                    case "3":
                                        $icon = "fa fa-pencil-square";
                                        break;
                                    case "4":
                                        $icon = "fa fa-check-square-o";
                                        break;
                                    case "6":
                                        $icon = "fa fa-close";
                                        break;
                                }
                            ?>
                            <div class="animated flipInY col-lg-4 col-md-4 col-sm-6  ">
                                <div class="tile-stats">
                                    <div class="icon"><i class="<?= $icon ?>"></i>
                                    </div>
                                    <div class="count"><?= $count ?></div>
                                    <h3><?= $status['status'] ?></h3>
                                    <p>SURAT MASUK</p>
                                </div>
                            </div>
                            <?php
                            endforeach;
                            foreach ($s as $row) :
                                $id = $row['id_status'];
                                $this->db->select('*');
                                $this->db->from('tb_surat_keluar');
                                $this->db->join('tb_status', 'tb_surat_keluar.status = tb_status.id_status');
                                $this->db->where('tb_surat_keluar.status', $id);
                                $data =  $this->db->get()->row_array();
                                $count = $this->db->get_where('tb_surat_keluar', ['status' => $id])->num_rows();
                                // $status = $this->db->get('tb_status')->row_array();
                                // $count = $count->num_rows();
                                $status = $this->db->get_where('tb_status', ['id_status' => $id])->row_array();
                                switch ($status['id_status']) {
                                    case "1":
                                        $icon = "fa fa-plus";
                                        break;
                                    case "3":
                                        $icon = "fa fa-pencil-square";
                                        break;
                                    case "4":
                                        $icon = "fa fa-check-square-o";
                                        break;
                                    case "6":
                                        $icon = "fa fa-close";
                                        break;
                                }
                            ?>
                            <div class="animated flipInY col-lg-4 col-md-3 col-sm-6  ">
                                <div class="tile-stats">
                                    <div class="icon"><i class="<?= $icon ?>"></i>
                                    </div>
                                    <div class="count"><?= $count ?></div>
                                    <h3><?= $status['status'] ?></h3>
                                    <p>SURAT KELUAR</p>
                                </div>
                            </div>
                            <?php
                            endforeach;
                            ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- /page content -->