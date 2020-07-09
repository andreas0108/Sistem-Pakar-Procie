<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="en">


<head>
    <?php $this->load->view('_parts/head'); ?>
</head>

<body>
    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('flashmsg'); ?>"></div>
    <div class="flash-err" data-flasherror="<?= $this->session->flashdata('flasherr'); ?>"></div>
    <div class="wrapper sidebar_minimize">
        <!-- Header -->
        <div class="main-header">
            <!-- Logo -->
            <div class="logo-header" data-background-color="white">
                <?php $this->load->view('_parts/header'); ?>
            </div>
            <!-- ./Logo -->

            <!-- Navbar -->
            <nav class="navbar navbar-header navbar-expand-lg" data-background-color="blue2">
                <?php $this->load->view('_parts/navbar'); ?>
            </nav>
            <!-- ./Navbar -->
        </div>
        <!-- Sidebar -->
        <div class="sidebar sidebar-style-2">
            <?php $this->load->view('_parts/sidebar'); ?>
        </div>
        <!-- ./Sidebar -->

        <!-- Content -->
        <div class="main-panel">
            <!-- Main Container -->

            <div class="container">
                <!-- <div class="page-inner"> -->
                <div class="page-inner">
                    <!-- Content -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="tab-content mb-3" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="article" role="tabpanel" aria-labelledby="pills-home-tab-nobd">
                                    <a href="<?= base_url('dashboard/history') ?>" class="btn btn-sm btn-primary float-right"><i class="fas fa-arrow-alt-circle-left mr-1"></i> History</a>
                                    <div class="page-header">
                                        <h4 class="page-title"><?= $title ?></h4>
                                        <ul class="breadcrumbs">
                                            <?php $this->load->view('_parts/breadcrumb'); ?>
                                        </ul>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div id="chart-container">
                                                        <canvas id="stats-komponen" height="400px"></canvas>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="card">
                                                <div class="card-header">
                                                    Statistik Processor Intel
                                                </div>
                                                <div class="card-body">
                                                    <div class="table-responsive">
                                                        <table id="table-komponen" class="display table table-striped table-hover table-head-bg-primary" cellspacing="0" width="100%">
                                                            <thead class="thead-inverse">
                                                                <tr>
                                                                    <th scope="col" style="width:10%">No</th>
                                                                    <th scope="col" style="width:60%">Nama Komponen</th>
                                                                    <th scope="col" style="width:30%">Jumlah</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                $i = 1;
                                                                foreach ($intel['data'] as $intel) {
                                                                ?>
                                                                    <tr>
                                                                        <td scope="row"><?= $i++ ?></td>
                                                                        <td><?= $intel['name'] ?></td>
                                                                        <td><?= $intel['jumlah'] ?></td>
                                                                    </tr>
                                                                <?php } ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="card">
                                                <div class="card-header">
                                                    Statistik Processor AMD
                                                </div>
                                                <div class="card-body">
                                                    <div class="table-responsive">
                                                        <table id="table-komponen" class="display table table-striped table-hover table-head-bg-danger" cellspacing="0" width="100%">
                                                            <thead class="thead-inverse">
                                                                <tr>
                                                                    <th scope="col" style="width:10%">No</th>
                                                                    <th scope="col" style="width:60%">Nama Komponen</th>
                                                                    <th scope="col" style="width:30%">Jumlah</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                $i = 1;
                                                                foreach ($amd['data'] as $amd) {
                                                                ?>
                                                                    <tr>
                                                                        <td scope="row"><?= $i++ ?></td>
                                                                        <td><?= $amd['name'] ?></td>
                                                                        <td><?= $amd['jumlah'] ?></td>
                                                                    </tr>
                                                                <?php } ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ./Content -->
                </div>
            </div>
            <!-- ./Main Container -->

            <!-- Footer -->
            <footer class="footer">
                <?php $this->load->view('_parts/footer'); ?>
            </footer>
            <!-- ./Footer -->

            <!-- Optional -->

            <!-- ./Optional -->

        </div>
        <!-- ./Content -->
    </div>

    <!-- JS Files   -->
    <?php $this->load->view('_parts/js'); ?>
    <?php $this->load->view('js/js-statistik'); ?>
    <!-- ./JS Files -->
</body>

</html>