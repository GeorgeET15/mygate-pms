<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Mygate PMS') ?></title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        :root {
            --mygate-black: #1D1E1E;
            --mygate-blue: #AEDFFB;
            --mygate-yellow: #FEDF2B;
            --blue-gradient: linear-gradient(135deg, #D2EFFA, #AEDFFB);
            --yellow-gradient: linear-gradient(135deg, #F3ED9D, #FEDF2B);
            --sidebar-width: 260px;
            --sidebar-collapsed-width: 70px;
        }
        body { font-family: 'Inter', sans-serif; background-color: #f0f2f5; color: var(--mygate-black); }
        .sidebar { 
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            width: var(--sidebar-width);
            z-index: 1000;
            padding: 20px 0;
            box-shadow: 4px 0 10px rgba(0,0,0,0.1);
            background-color: var(--mygate-black);
            color: white;
            transition: all 0.3s ease;
            overflow-x: hidden;
        }
        .sidebar.collapsed {
            width: var(--sidebar-collapsed-width);
        }
        .sidebar.collapsed .sidebar-text, 
        .sidebar.collapsed .bi-chevron-down,
        .sidebar.collapsed .collapse {
            display: none !important;
        }
        .sidebar.collapsed .nav-link {
            text-align: center;
            padding: 1rem 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .sidebar.collapsed .nav-link i {
            margin-right: 0 !important;
            font-size: 1.4rem;
        }
        .sidebar.collapsed .nav-link i.me-2 {
            margin-right: 0 !important;
        }
        .sidebar.collapsed .sidebar-text, 
        .sidebar.collapsed .bi-chevron-down {
            display: none !important;
        }
        .sidebar.collapsed .px-3 img {
            max-height: 30px;
        }
        .sidebar.collapsed button.nav-link {
            justify-content: center !important;
        }
        .sidebar .nav-link { color: rgba(255,255,255,0.7); font-weight: 500; transition: all 0.2s; padding: 0.8rem 1.5rem; white-space: nowrap; }
        .sidebar .nav-link:hover { color: var(--mygate-yellow); background: rgba(255,255,255,0.05); }
        .sidebar .nav-link.active { color: var(--mygate-black); background: var(--yellow-gradient); border-radius: 8px; margin: 0 10px; }
        
        .main-content { 
            margin-left: var(--sidebar-width); 
            width: calc(100% - var(--sidebar-width));
            padding: 2rem; 
            min-height: 100vh;
            transition: all 0.3s ease;
        }
        .main-content.expanded {
            margin-left: var(--sidebar-collapsed-width);
            width: calc(100% - var(--sidebar-collapsed-width));
        }
        #sidebarToggle {
            cursor: pointer;
            font-size: 0.85rem;
            color: rgba(255,255,255,0.4);
            transition: all 0.3s;
            background: rgba(255,255,255,0.05);
            width: 28px;
            height: 28px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 6px;
            border: 1px solid rgba(255,255,255,0.1);
        }
        #sidebarToggle:hover { color: var(--mygate-yellow); border-color: var(--mygate-yellow); background: rgba(255,255,255,0.1); }
        .sidebar.collapsed #sidebarToggle {
            transform: rotate(180deg);
            margin: 0 auto;
        }
        .sidebar.collapsed .px-3.mb-4 {
            justify-content: center !important;
        }
        .sidebar-logo {
            max-height: 45px;
            transition: all 0.3s;
        }
        .horizontal-scroll-section {
            overflow-x: auto;
            white-space: nowrap;
            padding-bottom: 1rem;
            display: flex;
            gap: 1rem;
        }
        .horizontal-scroll-section .card {
            flex: 0 0 300px; /* Fixed width for cards in horizontal scroll */
            white-space: normal;
        }

        /* Professional Table Styling */
        .table-container {
            background: white;
            border-radius: 12px;
            padding: 0;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.03);
            border: 1px solid #eee;
        }
        .table { 
            margin-bottom: 0 !important;
            width: 100% !important;
        }
        .table thead th {
            background-color: #fcfcfc;
            border-bottom: 1px solid #eee;
            color: #444;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            padding: 18px 20px;
            font-weight: 700;
            vertical-align: middle;
        }
        .table tbody tr {
            transition: background-color 0.2s;
        }
        .table tbody tr:hover {
            background-color: #f9fbfd;
        }
        .table tbody td {
            padding: 18px 20px;
            border-bottom: 1px solid #f1f1f1;
            vertical-align: middle;
            color: #555;
            font-size: 0.9rem;
        }
        .table tbody tr:last-child td {
            border-bottom: none;
        }

        /* DataTables Custom Styling Wrapper */
        .dataTables_wrapper {
            padding: 10px 0;
        }
        .dataTables_wrapper .row:first-child {
            padding: 15px 20px 20px 20px;
            margin-bottom: 0;
        }
        .dataTables_info {
            padding-left: 20px;
            padding-top: 20px;
            font-size: 0.85rem;
            color: #6c757d;
        }
        .dataTables_paginate {
            padding-right: 20px;
            padding-top: 15px;
        }

        /* DataTables Custom Styling */
        .dataTables_wrapper .dataTables_filter {
            text-align: right;
        }
        .dataTables_wrapper .dataTables_filter input {
            border-radius: 12px;
            padding: 10px 20px;
            border: 1px solid #eee;
            background-color: #f9f9f9;
            transition: all 0.3s;
            width: 300px;
            height: 42px;
            font-size: 0.9rem;
            margin-left: 0 !important;
        }
        .dataTables_wrapper .dataTables_filter input:focus {
            background-color: white;
            box-shadow: 0 0 0 4px rgba(174, 223, 251, 0.2);
            border-color: var(--mygate-blue);
            outline: none;
        }
        .dataTables_wrapper .dataTables_length select {
            border-radius: 10px;
            padding: 0 35px 0 15px !important;
            border: 1px solid #eee;
            appearance: none;
            height: 42px;
            background: #fff url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23343a40' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3e%3c/svg%3e") no-repeat right 0.75rem center/16px 12px;
        }
        .page-item.active .page-link {
            background: var(--yellow-gradient);
            border: none;
            color: var(--mygate-black);
            font-weight: bold;
            box-shadow: 0 4px 10px rgba(254, 223, 43, 0.3);
        }
        .page-link {
            color: var(--mygate-black);
            border: none;
            background: transparent;
            margin: 0 3px;
            border-radius: 8px !important;
            padding: 8px 16px;
        }
        /* Premium Status Badges */
        .badge {
            padding: 6px 12px;
            font-weight: 600;
            border-radius: 6px;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .status-pending { background-color: #fff8e1; color: #f57f17; border: 1px solid #ffecb3; }
        .status-approved { background-color: #e3f2fd; color: #0d47a1; border: 1px solid #bbdefb; }
        .status-completed { background-color: #e8f5e9; color: #1b5e20; border: 1px solid #c8e6c9; }
        .status-rejected { background-color: #ffeeb2; color: #b71c1c; border: 1px solid #ffcdd2; }
        .status-occupied { background-color: #e8f5e9; color: #1b5e20; border: 1px solid #c8e6c9; }
        .status-vacant { background-color: #fff8e1; color: #f57f17; border: 1px solid #ffecb3; }
        .status-active { background-color: #e8f5e9; color: #1b5e20; border: 1px solid #c8e6c9; }
        .status-inactive { background-color: #fff5f2; color: #b71c1c; border: 1px solid #ffcdd2; }
        /* Alternative mapping for standard BS classes */
        .badge.bg-warning-subtle { background-color: #fff8e1 !important; color: #f57f17 !important; border: 1px solid #ffecb3 !important; }
        .badge.bg-primary-subtle { background-color: #e3f2fd !important; color: #0d47a1 !important; border: 1px solid #bbdefb !important; }
        .badge.bg-success-subtle { background-color: #e8f5e9 !important; color: #1b5e20 !important; border: 1px solid #c8e6c9 !important; }
        .badge.bg-danger-subtle { background-color: #ffede5 !important; color: #b71c1c !important; border: 1px solid #ffcdd2 !important; }

        .btn-primary { background: var(--blue-gradient); border: none; color: var(--mygate-black); font-weight: 600; padding: 10px 24px; border-radius: 10px; transition: all 0.3s; }
        .btn-primary:hover { background: #9cd4f5; color: var(--mygate-black); transform: translateY(-2px); box-shadow: 0 5px 15px rgba(174, 223, 251, 0.4); }
        .card { border-radius: 16px; border: none; transition: transform 0.2s; box-shadow: 0 4px 20px rgba(0,0,0,0.05); }
        .card:hover { transform: translateY(-2px); }
        .card-header { border-bottom: 1px solid #f0f0f0; background-color: transparent; padding: 1.25rem 1.5rem; }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb {
            background: var(--mygate-black);
            border-radius: 10px;
            border: 2px solid #f1f1f1;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: var(--mygate-blue);
        }

        /* For Horizontal Scroll Sections */
        .horizontal-scroll-section::-webkit-scrollbar {
            height: 6px;
        }
        .horizontal-scroll-section::-webkit-scrollbar-thumb {
            background: var(--mygate-blue);
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="sidebar" id="sidebar">
                <div class="position-sticky h-100 d-flex flex-column">
                    <div class="px-3 mb-4 mt-3 d-flex justify-content-between align-items-center">
                        <img src="/assets/img/mygate-nobg-logo.webp" alt="Mygate PMS" class="img-fluid rounded sidebar-text sidebar-logo">
                        <i class="bi bi-chevron-left" id="sidebarToggle"></i>
                    </div>
                    
                    <div class="nav flex-column px-2 flex-grow-1" id="sidebarMenu">
                        
                        <a class="nav-link mb-1" href="/admin/dashboard">
                            <i class="bi bi-speedometer2 me-2"></i> <span class="sidebar-text">Dashboard</span>
                        </a>

                        <!-- Properties Group -->
                        <div class="mb-1">
                            <button class="nav-link w-100 text-start d-flex justify-content-between align-items-center" type="button" data-bs-toggle="collapse" data-bs-target="#propCollapse">
                                <span><i class="bi bi-building me-2"></i> <span class="sidebar-text">Properties</span></span>
                                <i class="bi bi-chevron-down small"></i>
                            </button>
                            <div class="collapse ps-3" id="propCollapse" data-bs-parent="#sidebarMenu">
                                <a class="nav-link py-1 small" href="/admin/landlord">Manage Landlords</a>
                                <a class="nav-link py-1 small" href="/admin/property">Manage Properties</a>
                                <a class="nav-link py-1 small" href="/admin/unit">Manage Units</a>
                            </div>
                        </div>

                        <!-- Applicants Group -->
                        <div class="mb-1">
                            <button class="nav-link w-100 text-start d-flex justify-content-between align-items-center" type="button" data-bs-toggle="collapse" data-bs-target="#appCollapse">
                                <span><i class="bi bi-people me-2"></i> <span class="sidebar-text">Applicants</span></span>
                                <i class="bi bi-chevron-down small"></i>
                            </button>
                            <div class="collapse ps-3" id="appCollapse" data-bs-parent="#sidebarMenu">
                                <a class="nav-link py-1 small" href="/admin/application">Rental Application</a>
                                <a class="nav-link py-1 small" href="/admin/application/list">Applicant List</a>
                            </div>
                        </div>

                        <!-- Lease Group -->
                        <div class="mb-1">
                            <button class="nav-link w-100 text-start d-flex justify-content-between align-items-center" type="button" data-bs-toggle="collapse" data-bs-target="#leaseCollapse">
                                <span><i class="bi bi-file-earmark-text me-2"></i> <span class="sidebar-text">Lease Mgmt</span></span>
                                <i class="bi bi-chevron-down small"></i>
                            </button>
                            <div class="collapse ps-3" id="leaseCollapse" data-bs-parent="#sidebarMenu">
                                <a class="nav-link py-1 small" href="/admin/tenant">Tenant List</a>
                                <a class="nav-link py-1 small" href="/admin/lease">Lease List</a>
                                <a class="nav-link py-1 small" href="/admin/lease/weekly">Weekly Agreements</a>
                            </div>
                        </div>

                        <!-- Accounting Group -->
                        <div class="mb-1">
                            <button class="nav-link w-100 text-start d-flex justify-content-between align-items-center" type="button" data-bs-toggle="collapse" data-bs-target="#accCollapse">
                                <span><i class="bi bi-cash-stack me-2"></i> <span class="sidebar-text">Accounting</span></span>
                                <i class="bi bi-chevron-down small"></i>
                            </button>
                            <div class="collapse ps-3" id="accCollapse" data-bs-parent="#sidebarMenu">
                                <a class="nav-link py-1 small" href="/admin/accounting/journal">Journal Entries</a>
                                <a class="nav-link py-1 small" href="/admin/accounting/receipts">Receipts</a>
                                <a class="nav-link py-1 small" href="/admin/accounting/vouchers">Debit Vouchers</a>
                                <a class="nav-link py-1 small" href="/admin/payment">Payment View</a>
                            </div>
                        </div>

                        <!-- Operations Group -->
                        <div class="mb-1">
                            <button class="nav-link w-100 text-start d-flex justify-content-between align-items-center" type="button" data-bs-toggle="collapse" data-bs-target="#opCollapse">
                                <span><i class="bi bi-gear me-2"></i> <span class="sidebar-text">Operations</span></span>
                                <i class="bi bi-chevron-down small"></i>
                            </button>
                            <div class="collapse ps-3" id="opCollapse" data-bs-parent="#sidebarMenu">
                                <a class="nav-link py-1 small" href="/admin/workorder">Work Orders</a>
                                <a class="nav-link py-1 small" href="/admin/maintenance">Maintenance Log</a>
                                <a class="nav-link py-1 small" href="/admin/project">Projects</a>
                            </div>
                        </div>

                        <!-- Misc Group -->
                        <div class="mb-1">
                            <button class="nav-link w-100 text-start d-flex justify-content-between align-items-center" type="button" data-bs-toggle="collapse" data-bs-target="#miscCollapse">
                                <span><i class="bi bi-collection me-2"></i> <span class="sidebar-text">Utilities</span></span>
                                <i class="bi bi-chevron-down small"></i>
                            </button>
                            <div class="collapse ps-3" id="miscCollapse" data-bs-parent="#sidebarMenu">
                                <a class="nav-link py-1 small" href="/admin/marketing">Marketing</a>
                                <a class="nav-link py-1 small" href="/admin/settings/pass_storer">Pass Storer</a>
                                <a class="nav-link py-1 small" href="/admin/quicklink">Quick Links</a>
                            </div>
                        </div>

                        <!-- Settings Group -->
                        <div class="mb-1">
                            <button class="nav-link w-100 text-start d-flex justify-content-between align-items-center" type="button" data-bs-toggle="collapse" data-bs-target="#setCollapse">
                                <span><i class="bi bi-wrench me-2"></i> <span class="sidebar-text">Settings</span></span>
                                <i class="bi bi-chevron-down small"></i>
                            </button>
                            <div class="collapse ps-3" id="setCollapse" data-bs-parent="#sidebarMenu">
                                <a class="nav-link py-1 small" href="/admin/settings/system">System Settings</a>
                                <a class="nav-link py-1 small" href="/admin/settings/late_fee">Late Fee Settings</a>
                                <a class="nav-link py-1 small" href="/admin/notice">Noticeboard</a>
                            </div>
                        </div>

                        <hr class="text-secondary">
                        <a class="nav-link text-danger mb-4" href="/login/logout">
                            <i class="bi bi-box-arrow-right me-2"></i> <span class="sidebar-text">Logout</span>
                        </a>
                    </div>
                </div>
            </nav>

            <!-- Main Content -->
            <main class="main-content" id="mainContent">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <div class="d-flex align-items-center">
                        <h1 class="h2 mb-0"><?= esc($title ?? 'Dashboard') ?></h1>
                    </div>
                </div>

                <!-- Flash Messages -->
                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                <?php endif; ?>

                <!-- Dynamic Content -->
                <?= $this->renderSection('content') ?>

            </main>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    
    <script>
        $(document).ready(function() {
            // Sidebar Toggle
            $('#sidebarToggle').on('click', function() {
                $('#sidebar').toggleClass('collapsed');
                $('#mainContent').toggleClass('expanded');
            });

            // Auto-expand sidebar if a group is clicked while collapsed
            $('.sidebar .nav-link[data-bs-toggle="collapse"]').on('click', function() {
                if ($('#sidebar').hasClass('collapsed')) {
                    $('#sidebar').removeClass('collapsed');
                    $('#mainContent').removeClass('expanded');
                }
            });

            // Auto-initialize all tables with class 'table' if they have matching col counts
            $('.table').each(function() {
                const $table = $(this);
                const headerCols = $table.find('thead th').length;
                const bodyCols = $table.find('tbody tr:first td').length;

                // Only initialize if we have headers and matching body columns
                if (headerCols > 0 && headerCols === bodyCols && !$.fn.DataTable.isDataTable(this)) {
                    $table.addClass('datatable').DataTable({
                        pageLength: 10,
                        responsive: true,
                        dom: '<"row align-items-center mb-3"<"col-md-6"l><"col-md-6"f>>rt<"row align-items-center mt-3"<"col-md-6"i><"col-md-6"p>>',
                        language: {
                            search: "_INPUT_",
                            searchPlaceholder: "Search records..."
                        }
                    });
                }
            });
        });

        // Global Delete Confirmation with SweetAlert2
        $(document).on('click', '.confirm-delete', function(e) {
            e.preventDefault();
            const url = $(this).attr('href');
            const message = $(this).data('message') || 'Are you sure you want to delete this record?';

            Swal.fire({
                title: 'Are you sure?',
                text: message,
                icon: 'warning',
                iconColor: '#FEDF2B',
                showCancelButton: true,
                confirmButtonColor: '#1D1E1E',
                cancelButtonColor: '#f8f9fa',
                confirmButtonText: 'Yes, Delete',
                cancelButtonText: 'Cancel',
                background: '#fff',
                customClass: {
                    popup: 'premium-swal-popup',
                    confirmButton: 'premium-swal-confirm',
                    cancelButton: 'premium-swal-cancel'
                },
                buttonsStyling: false
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url;
                }
            });
        });

        // Flash Message Success/Error with SweetAlert2
        <?php if (session()->getFlashdata('success')): ?>
            Swal.fire({
                icon: 'success',
                iconColor: '#AEDFFB',
                title: 'Success',
                text: '<?= session()->getFlashdata('success') ?>',
                timer: 3000,
                showConfirmButton: false,
                background: '#fff',
                customClass: {
                    popup: 'premium-swal-popup'
                }
            });
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            Swal.fire({
                icon: 'error',
                iconColor: '#e74c3c',
                title: 'Error',
                text: '<?= session()->getFlashdata('error') ?>',
                confirmButtonColor: '#1D1E1E',
                background: '#fff',
                customClass: {
                    popup: 'premium-swal-popup',
                    confirmButton: 'premium-swal-confirm'
                },
                buttonsStyling: false
            });
        <?php endif; ?>
    </script>
    <style>
        .premium-swal-popup {
            border-radius: 20px !important;
            padding: 2rem !important;
            font-family: 'Inter', sans-serif !important;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1) !important;
        }
        .premium-swal-confirm {
            background-color: var(--mygate-black) !important;
            color: white !important;
            padding: 12px 30px !important;
            border-radius: 12px !important;
            font-weight: 600 !important;
            border: none !important;
            margin: 0 5px !important;
            transition: all 0.3s !important;
        }
        .premium-swal-confirm:hover {
            transform: translateY(-2px) !important;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2) !important;
        }
        .premium-swal-cancel {
            background-color: #f8f9fa !important;
            color: #666 !important;
            padding: 12px 30px !important;
            border-radius: 12px !important;
            font-weight: 600 !important;
            border: 1px solid #eee !important;
            margin: 0 5px !important;
            transition: all 0.3s !important;
        }
        .premium-swal-cancel:hover {
            background-color: #eee !important;
        }
    </style>
    <?php if (session()->get('admin_id')): ?>
        <?= $this->include('admin/layout/ai_widget') ?>
    <?php endif; ?>
</body>
</html>
