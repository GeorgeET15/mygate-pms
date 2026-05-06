<?= $this->extend('admin/layout/default') ?>

<?= $this->section('content') ?>

<div class="row g-4 mb-4">
    <!-- Stat Cards -->
    <?php if (($dash_settings['dash_show_properties'] ?? '1') == '1'): ?>
    <div class="col-xl-3 col-md-6">
        <div class="card border-0 shadow-sm h-100 overflow-hidden" style="background: var(--blue-gradient);">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="rounded-circle bg-white p-3 shadow-sm d-inline-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                        <i class="bi bi-building text-primary fs-4"></i>
                    </div>
                    <span class="badge bg-white text-primary rounded-pill">+5%</span>
                </div>
                <h3 class="fw-bold mb-1"><?= $total_properties ?></h3>
                <p class="text-muted small mb-0 fw-medium">Total Properties</p>
            </div>
        </div>
    </div>
    <?php endif; ?>
    
    <?php if (($dash_settings['dash_show_tenants'] ?? '1') == '1'): ?>
    <div class="col-xl-3 col-md-6">
        <div class="card border-0 shadow-sm h-100 overflow-hidden" style="background: var(--yellow-gradient);">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="rounded-circle bg-white p-3 shadow-sm d-inline-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                        <i class="bi bi-people text-warning fs-4"></i>
                    </div>
                    <span class="badge bg-white text-warning rounded-pill">+12%</span>
                </div>
                <h3 class="fw-bold mb-1"><?= $total_tenants ?></h3>
                <p class="text-muted small mb-0 fw-medium">Active Tenants</p>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <?php if (($dash_settings['dash_show_vacant'] ?? '1') == '1'): ?>
    <div class="col-xl-3 col-md-6">
        <div class="card border-0 shadow-sm h-100 bg-white">
            <div class="card-body p-4 border-start border-primary border-4 rounded-3">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="rounded-circle bg-light p-3 d-inline-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                        <i class="bi bi-house-door text-primary fs-4"></i>
                    </div>
                    <span class="badge bg-light text-primary rounded-pill"><?= round(($total_units > 0) ? ($vacant_units / $total_units) * 100 : 0) ?>%</span>
                </div>
                <h3 class="fw-bold mb-1"><?= $vacant_units ?> / <?= $total_units ?></h3>
                <p class="text-muted small mb-0 fw-medium">Vacant Units</p>
                <div class="progress mt-2" style="height: 4px;">
                    <div class="progress-bar bg-primary" role="progressbar" style="width: <?= ($total_units > 0) ? ($vacant_units / $total_units) * 100 : 0 ?>%"></div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <?php if (($dash_settings['dash_show_revenue'] ?? '1') == '1'): ?>
    <div class="col-xl-3 col-md-6">
        <div class="card border-0 shadow-sm h-100 bg-dark text-white">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="rounded-circle bg-secondary p-3 d-inline-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                        <i class="bi bi-cash text-white fs-4"></i>
                    </div>
                    <span class="badge bg-secondary text-white rounded-pill">Monthly</span>
                </div>
                <h3 class="fw-bold mb-1">$<?= number_format($total_revenue, 0) ?></h3>
                <p class="text-white-50 small mb-0 fw-medium">Total Revenue</p>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>

<div class="row g-4">
    <!-- Chart Section -->
    <?php if (($dash_settings['dash_show_chart'] ?? '1') == '1'): ?>
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white py-3">
                <h6 class="mb-0 fw-bold">Revenue & Collections</h6>
            </div>
            <div class="card-body">
                <canvas id="revenueChart" style="min-height: 300px;"></canvas>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- Quick Actions & Pending -->
    <div class="<?= (($dash_settings['dash_show_chart'] ?? '1') == '1') ? 'col-lg-4' : 'col-lg-12' ?>">
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white py-3">
                <h6 class="mb-0 fw-bold">Quick Actions</h6>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="/admin/application/create" class="btn btn-primary text-start p-3">
                        <i class="bi bi-person-plus me-2"></i> New Application
                    </a>
                    <a href="/admin/workorder" class="btn btn-outline-dark text-start p-3">
                        <i class="bi bi-tools me-2"></i> Create Work Order
                    </a>
                    <a href="/admin/accounting/add_receipt" class="btn btn-outline-dark text-start p-3">
                        <i class="bi bi-receipt me-2"></i> Record Payment
                    </a>
                </div>
            </div>
        </div>

        <?php if (($dash_settings['dash_show_pending'] ?? '1') == '1'): ?>
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h6 class="mb-0 fw-bold">Pending Applications</h6>
                <span class="badge bg-danger rounded-pill"><?= $pending_apps ?></span>
            </div>
            <div class="card-body p-0">
                <ul class="list-group list-group-flush">
                    <?php foreach(array_slice($recent_invoices, 0, 4) as $inv): ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                        <div>
                            <div class="fw-bold small"><?= esc($inv['tenant_name']) ?></div>
                            <div class="text-muted smaller">Inv #<?= $inv['InvId'] ?> - <?= $inv['invStatus'] ?></div>
                        </div>
                        <div class="fw-bold text-primary">$<?= number_format($inv['TotalPrice'], 0) ?></div>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="card-footer bg-white text-center py-3">
                <a href="/admin/application" class="small text-decoration-none fw-bold">View All Applications</a>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>

<div class="row g-4 mt-2">
    <!-- Maintenance -->
    <?php if (($dash_settings['dash_show_maintenance'] ?? '1') == '1'): ?>
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h6 class="mb-0 fw-bold">Recent Maintenance Logs</h6>
                <a href="/admin/maintenance" class="btn btn-sm btn-light text-primary fw-bold">View All</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th class="ps-4">Issue</th>
                                <th>Property</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th class="text-end pe-4">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($recent_maintenance as $log): ?>
                            <tr>
                                <td class="ps-4">
                                    <div class="fw-bold"><?= esc($log['MaintenanceTitle'] ?? 'General Repair') ?></div>
                                    <div class="text-muted smaller"><?= esc($log['Description'] ?? 'No notes') ?></div>
                                </td>
                                <td>Property #<?= $log['PropertyId'] ?></td>
                                <td><?= date('M d, Y', strtotime($log['when_done'] ?? 'now')) ?></td>
                                <td><span class="badge status-completed">Completed</span></td>
                                <td class="text-end pe-4">
                                    <button class="btn btn-sm btn-light"><i class="bi bi-eye"></i></button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- Landlords -->
    <?php if (($dash_settings['dash_show_landlords'] ?? '0') == '1'): ?>
    <div class="col-md-6">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h6 class="mb-0 fw-bold">Registered Landlords</h6>
                <a href="/admin/landlord" class="btn btn-sm btn-light text-primary fw-bold">View All</a>
            </div>
            <div class="card-body p-0">
                <ul class="list-group list-group-flush">
                    <?php foreach($recent_landlords as $ll): ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                        <div>
                            <div class="fw-bold small"><?= esc($ll['first_name'] . ' ' . $ll['last_name']) ?></div>
                            <div class="text-muted smaller"><?= esc($ll['email']) ?></div>
                        </div>
                        <div class="small text-muted"><?= esc($ll['city']) ?></div>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- Marketing -->
    <?php if (($dash_settings['dash_show_marketing'] ?? '0') == '1'): ?>
    <div class="col-md-6">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h6 class="mb-0 fw-bold">Marketing Activity</h6>
                <a href="/admin/marketing" class="btn btn-sm btn-light text-primary fw-bold">View All</a>
            </div>
            <div class="card-body p-0">
                <ul class="list-group list-group-flush">
                    <?php foreach($recent_marketing as $m): ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                        <div>
                            <div class="fw-bold small"><?= esc($m['propertyName']) ?></div>
                            <div class="text-muted smaller">Available: <?= esc($m['availableDate']) ?></div>
                        </div>
                        <span class="badge bg-light text-dark rounded-pill">$<?= esc($m['rentAmount']) ?></span>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- Projects -->
    <?php if (($dash_settings['dash_show_projects'] ?? '0') == '1'): ?>
    <div class="col-md-6">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h6 class="mb-0 fw-bold">Ongoing Projects</h6>
                <a href="/admin/project" class="btn btn-sm btn-light text-primary fw-bold">View All</a>
            </div>
            <div class="card-body p-0">
                <ul class="list-group list-group-flush">
                    <?php foreach($recent_projects as $p): ?>
                    <li class="list-group-item py-3">
                        <div class="fw-bold small"><?= esc($p['project_name'] ?? 'Project #' . $p['project_id']) ?></div>
                        <div class="text-muted smaller"><?= esc($p['project_description'] ?? 'Property ID: ' . ($p['property_address'] ?? 'N/A')) ?></div>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- Noticeboard -->
    <?php if (($dash_settings['dash_show_notices'] ?? '0') == '1'): ?>
    <div class="col-md-6">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h6 class="mb-0 fw-bold">Latest Notices</h6>
                <a href="/admin/notice" class="btn btn-sm btn-light text-primary fw-bold">View All</a>
            </div>
            <div class="card-body p-0">
                <ul class="list-group list-group-flush">
                    <?php foreach($recent_notices as $n): ?>
                    <li class="list-group-item py-3 border-start border-warning border-4">
                        <div class="fw-bold small"><?= esc($n['notice_title']) ?></div>
                        <div class="text-muted smaller"><?= date('M d, Y', strtotime($n['created_at'] ?? 'now')) ?></div>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- Quick Links -->
    <?php if (($dash_settings['dash_show_links'] ?? '0') == '1'): ?>
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3">
                <h6 class="mb-0 fw-bold">Resource Quick Links</h6>
            </div>
            <div class="card-body">
                <div class="d-flex flex-wrap gap-2">
                    <?php foreach($recent_links as $l): ?>
                    <a href="<?= esc($l['quick_links']) ?>" target="_blank" class="btn btn-light border btn-sm rounded-pill px-3">
                        <i class="bi bi-link-45deg me-1"></i> <?= esc($l['website_title']) ?>
                    </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    <?php if (($dash_settings['dash_show_chart'] ?? '1') == '1'): ?>
    const ctx = document.getElementById('revenueChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [{
                label: 'Monthly Revenue',
                data: [12000, 19000, 15000, 22000, 25000, <?= $total_revenue / 10 ?>],
                borderColor: '#1D1E1E',
                backgroundColor: 'rgba(174, 223, 251, 0.2)',
                fill: true,
                tension: 0.4,
                borderWidth: 3,
                pointBackgroundColor: '#FEDF2B',
                pointBorderColor: '#1D1E1E',
                pointRadius: 5
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: { beginAtZero: true, grid: { display: false } },
                x: { grid: { display: false } }
            }
        }
    });
    <?php endif; ?>
});
</script>

<style>
    .smaller { font-size: 0.75rem; }
</style>

<?= $this->endSection() ?>
