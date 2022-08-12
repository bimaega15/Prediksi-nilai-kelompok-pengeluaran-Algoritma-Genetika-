<?php
$profile = check_profile();
$uri = $this->uri->segment(1);
$sub_uri = $this->uri->segment(2);
$konfigurasi = konfigurasi();
?><div class="vertical-menu">

    <div class="h-100">

        <div class="user-wid text-center py-4">
            <div class="user-img">
                <img src="<?= base_url('public/image/konfigurasi/' . $konfigurasi->gambar_konfigurasi) ?>" alt="" class="avatar-md mx-auto rounded-circle">
            </div>

            <div class="mt-3">
                <a href="#" class="text-dark font-weight-medium font-size-16"><?= $profile->nama_admin ?></a>
                <p class="text-body mt-1 mb-0 font-size-13">Admin</p>

            </div>
        </div>

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>
                <li>
                    <a href="<?= base_url('Admin/Home') ?>" class="waves-effect">
                        <i class="mdi mdi-airplay"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('Admin/Profile') ?>" class="waves-effect">
                        <i class="mdi mdi-face-profile"></i>
                        <span>My Profile</span>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('Admin/DataAdmin') ?>" class="waves-effect">
                        <i class="mdi mdi-shield-account-outline"></i>
                        <span>Admin</span>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('Admin/Kategori') ?>" class="waves-effect">
                        <i class="mdi mdi-book-open-variant"></i>
                        <span>Kategori</span>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('Admin/Inisialisasi') ?>" class="waves-effect">
                        <i class="mdi mdi-post"></i>
                        <span>Inisialisasi</span>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('Admin/Pengujian') ?>" class="waves-effect">
                        <i class="mdi mdi-notebook-outline"></i>
                        <span>Pengujian</span>
                    </a>
                </li>
                <!-- <li class="menu-title">Dataset Perhitungan</li>
                <li class="">
                    <a href="javascript: void(0);" class="has-arrow waves-effect" aria-expanded="false">
                        <i class="mdi mdi-database"></i>
                        <span>Data Perhitungan</span>
                    </a>
                    <ul class="sub-menu mm-collapse" aria-expanded="false" style="height: 0px;">
                        <li><a href="<?= base_url('Admin/Dataset') ?>">Dataset</a></li>
                        <li><a href="<?= base_url('Admin/SubDataSet') ?>">Sub Data Set</a></li>
                        <li><a href="<?= base_url('Admin/SetData') ?>">Set Data</a></li>
                    </ul>
                </li>
                <li>
                    <a href="<?= base_url('Admin/Perhitungan') ?>" class="waves-effect">
                        <i class="mdi mdi-calculator"></i>
                        <span>Perhitungan</span>
                    </a>
                </li> -->

                <li class="menu-title">Konfigurasi</li>
                <li>
                    <a href="<?= base_url('Admin/Konfigurasi') ?>" class="waves-effect">
                        <i class="fas fa-cog"></i>
                        <span>Konfigurasi</span>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('Logout') ?>" class="waves-effect">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </a>
                </li>
                <li>
                    <a>
                        &emsp;
                    </a>
                </li>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>