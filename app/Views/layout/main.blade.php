<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>RadhitDesU</title>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <link rel="stylesheet" href="{{ css_url('fontawesome.min') }}">
        <link rel="stylesheet" href="{{ css_url('overlayscrollbars.min') }}">
        <link rel="stylesheet" href="{{ css_url('dataTables.bootstrap4.min') }}">
        <link rel="stylesheet" href="{{ css_url('animate.min') }}">
        <link rel="stylesheet" href="{{ css_url('sweetalert2.min') }}">
        <link rel="stylesheet" href="{{ css_url('adminlte.min') }}">
        
    </head>
    <body class="hold-transition accent-primary sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
        <div class="wrapper">
            <div class="preloader flex-column justify-content-center align-items-center">
                <img class="animation__wobble" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
            </div>
            <nav class="main-header navbar navbar-expand navbar-light bg-primary">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown user-menu">
                        <a href="javascript:void(0);" class="nav-link dropdown-toggle" data-toggle="dropdown">
                            <img src="{{ img_url('avatar.jpg') }}" class="user-image img-circle elevation-2" alt="user">
                            <span class="d-none d-md-inline">Radhit</span>
                        </a>
                        <ul class="animate__animated animate__flipInY dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <li class="user-header bg-primary">
                                <img src="{{ img_url('avatar.jpg') }}" class="img-circle elevation-2" alt="user">
                                <p class="hidden-xs">Radhitya</p>
                            </li>
                            <li class="user-footer">
                                <a href="{{ site_url('profile') }}" class="btn btn-default">Profile</a>
                                <a href="{{ site_url('logout') }}" class="btn btn-default float-right">Logout</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
            <aside class="main-sidebar sidebar-light-info elevation-4">
                <a href="index3.html" class="brand-link bg-primary">
                    <img src="{{ img_url('logo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                    <span class="brand-text font-weight-light">Inventory Barang</span>
                </a>
                <div class="sidebar">
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                            <li class="nav-item">
                                <a href="{{ site_url('dashboard') }}" class="nav-link">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>
                                        Dashboard
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="javascript:void(0);" class="nav-link">
                                    <i class="nav-icon fas fa-database"></i>
                                    <p>
                                        Master Data
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ site_url('master/pemasok') }}" class="nav-link">
                                            <i class="fas fa-ellipsis-h nav-icon"></i>
                                            <p>Data Pemasok</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ site_url('master/jenis-barang') }}" class="nav-link">
                                            <i class="fas fa-ellipsis-h nav-icon"></i>
                                            <p>Jenis Barang</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ site_url('master/satuan-barang') }}" class="nav-link">
                                            <i class="fas fa-ellipsis-h nav-icon"></i>
                                            <p>Satuan Barang</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ site_url('master/barang') }}" class="nav-link">
                                            <i class="fas fa-ellipsis-h nav-icon"></i>
                                            <p>Data Barang</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ site_url('master/pengguna') }}" class="nav-link">
                                            <i class="fas fa-ellipsis-h nav-icon"></i>
                                            <p>Data Pengguna</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="{{ site_url('barang-masuk') }}" class="nav-link">
                                    <i class="nav-icon fas fa-th"></i>
                                    <p>
                                        Barang Masuk
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ site_url('barang-keluar') }}" class="nav-link">
                                    <i class="nav-icon fas fa-th"></i>
                                    <p>
                                        Barang Keluar
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="javascript:void(0);" class="nav-link">
                                    <i class="nav-icon fas fa-file"></i>
                                    <p>
                                        Laporan
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ site_url('laporan/barang-masuk') }}" class="nav-link">
                                            <i class="fas fa-ellipsis-h nav-icon"></i>
                                            <p>Barang Masuk</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ site_url('laporan/barang-keluar') }}" class="nav-link">
                                            <i class="fas fa-ellipsis-h nav-icon"></i>
                                            <p>Barang Keluar</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ site_url('laporan/stok') }}" class="nav-link">
                                            <i class="fas fa-ellipsis-h nav-icon"></i>
                                            <p>Stok Barang</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
            </aside>
            <div class="content-wrapper">
                <div class="content-header">
                    
                </div>
                
                <section class="content">
                    <div class="container-fluid">
                        @yield('content')
                    </div>
                </section>
            </div>
            
            <aside class="control-sidebar control-sidebar-dark">
            </aside>
            
            <footer class="main-footer">
                <strong>Copyright &copy; 2022-2023 <a href="https://radhitdesu.my.id">radhitdesu.my.id</a>.</strong>
                All rights reserved.
                <div class="float-right d-none d-sm-inline-block">
                    <b>Version</b> Inventory
                </div>
            </footer>
        </div>
        @yield('modal')
        
        <script src="{{ js_url('jquery.min') }}"></script>
        <script src="{{ js_url('bootstrap.bundle.min') }}"></script>
        <script src="{{ js_url('jquery.overlayscrollbars.min') }}"></script>
        <script src="{{ js_url('jquery.dataTables.min') }}"></script>
        <script src="{{ js_url('dataTables.bootstrap4.min') }}"></script>
        <script src="{{ js_url('sweetalert2.min') }}"></script>
        <script src="{{ js_url('autonumeric') }}"></script>
        <script src="{{ js_url('adminlte.min') }}"></script>
        <script src="{{ js_url('javascript.min') }}"></script>
        @yield('script')
        
    </body>
</html>