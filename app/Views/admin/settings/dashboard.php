<?= $this->extend('admin/layout/default') ?>

<?= $this->section('content') ?>

<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="card border-0 shadow-sm overflow-hidden">
            <div class="card-header bg-white py-4 px-4 border-bottom">
                <div class="d-flex align-items-center">
                    <div class="rounded-circle bg-light p-3 me-3">
                        <i class="bi bi-layout-text-window-reverse text-primary fs-4"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-bold">Dashboard Preferences</h5>
                        <p class="text-muted small mb-0">Toggle which features and modules appear on your main overview</p>
                    </div>
                </div>
            </div>
            <div class="card-body p-4 p-md-5">
                <form action="/admin/settings/dashboard" method="POST">
                    <?= csrf_field() ?>
                    
                    <div class="row g-4">
                        <!-- Core Metrics -->
                        <div class="col-12">
                            <h6 class="fw-bold text-uppercase small text-muted mb-3">Core Performance Metrics</h6>
                            <div class="row g-3">
                                <div class="col-md-6 col-xl-4">
                                    <div class="p-3 border rounded-3 bg-light-subtle d-flex justify-content-between align-items-center">
                                        <span class="fw-medium">Total Properties</span>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" name="dash[dash_show_properties]" value="1" <?= ($settings['dash_show_properties'] ?? '1') == '1' ? 'checked' : '' ?>>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xl-4">
                                    <div class="p-3 border rounded-3 bg-light-subtle d-flex justify-content-between align-items-center">
                                        <span class="fw-medium">Active Tenants</span>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" name="dash[dash_show_tenants]" value="1" <?= ($settings['dash_show_tenants'] ?? '1') == '1' ? 'checked' : '' ?>>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xl-4">
                                    <div class="p-3 border rounded-3 bg-light-subtle d-flex justify-content-between align-items-center">
                                        <span class="fw-medium">Vacant Units</span>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" name="dash[dash_show_vacant]" value="1" <?= ($settings['dash_show_vacant'] ?? '1') == '1' ? 'checked' : '' ?>>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xl-4">
                                    <div class="p-3 border rounded-3 bg-light-subtle d-flex justify-content-between align-items-center">
                                        <span class="fw-medium">Total Revenue</span>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" name="dash[dash_show_revenue]" value="1" <?= ($settings['dash_show_revenue'] ?? '1') == '1' ? 'checked' : '' ?>>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xl-4">
                                    <div class="p-3 border rounded-3 bg-light-subtle d-flex justify-content-between align-items-center">
                                        <span class="fw-medium">Pending Apps</span>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" name="dash[dash_show_pending]" value="1" <?= ($settings['dash_show_pending'] ?? '1') == '1' ? 'checked' : '' ?>>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Charts & Logs -->
                        <div class="col-12 mt-5">
                            <h6 class="fw-bold text-uppercase small text-muted mb-3">Analytics & Activity Logs</h6>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="p-3 border rounded-3 bg-light-subtle d-flex justify-content-between align-items-center">
                                        <div>
                                            <span class="fw-medium d-block">Revenue Analytics Chart</span>
                                            <small class="text-muted">Interactive monthly revenue trends</small>
                                        </div>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" name="dash[dash_show_chart]" value="1" <?= ($settings['dash_show_chart'] ?? '1') == '1' ? 'checked' : '' ?>>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="p-3 border rounded-3 bg-light-subtle d-flex justify-content-between align-items-center">
                                        <div>
                                            <span class="fw-medium d-block">Recent Maintenance Logs</span>
                                            <small class="text-muted">Table of recent repair and upkeep tasks</small>
                                        </div>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" name="dash[dash_show_maintenance]" value="1" <?= ($settings['dash_show_maintenance'] ?? '1') == '1' ? 'checked' : '' ?>>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Functional Modules -->
                        <div class="col-12 mt-5">
                            <h6 class="fw-bold text-uppercase small text-muted mb-3">Functional Modules (Visibility)</h6>
                            <div class="row g-3">
                                <div class="col-md-6 col-xl-4">
                                    <div class="p-3 border rounded-3 bg-light-subtle d-flex justify-content-between align-items-center">
                                        <span class="fw-medium">Marketing Overview</span>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" name="dash[dash_show_marketing]" value="1" <?= ($settings['dash_show_marketing'] ?? '0') == '1' ? 'checked' : '' ?>>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xl-4">
                                    <div class="p-3 border rounded-3 bg-light-subtle d-flex justify-content-between align-items-center">
                                        <span class="fw-medium">Quick Links</span>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" name="dash[dash_show_links]" value="1" <?= ($settings['dash_show_links'] ?? '0') == '1' ? 'checked' : '' ?>>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xl-4">
                                    <div class="p-3 border rounded-3 bg-light-subtle d-flex justify-content-between align-items-center">
                                        <span class="fw-medium">Noticeboard</span>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" name="dash[dash_show_notices]" value="1" <?= ($settings['dash_show_notices'] ?? '0') == '1' ? 'checked' : '' ?>>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xl-4">
                                    <div class="p-3 border rounded-3 bg-light-subtle d-flex justify-content-between align-items-center">
                                        <span class="fw-medium">Ongoing Projects</span>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" name="dash[dash_show_projects]" value="1" <?= ($settings['dash_show_projects'] ?? '0') == '1' ? 'checked' : '' ?>>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xl-4">
                                    <div class="p-3 border rounded-3 bg-light-subtle d-flex justify-content-between align-items-center">
                                        <span class="fw-medium">Landlord Overview</span>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" name="dash[dash_show_landlords]" value="1" <?= ($settings['dash_show_landlords'] ?? '0') == '1' ? 'checked' : '' ?>>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="my-5 text-secondary opacity-25">
                    
                    <div class="d-flex justify-content-between align-items-center">
                        <p class="text-muted small mb-0">
                            <i class="bi bi-info-circle me-1"></i> These settings customize your personal dashboard view.
                        </p>
                        <button type="submit" class="btn btn-primary px-5 py-2 fw-bold shadow-sm">
                            Save Preferences
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .form-check-input:checked {
        background-color: var(--mygate-black);
        border-color: var(--mygate-black);
    }
    .bg-light-subtle {
        background-color: #fcfcfc;
    }
    .transition-hover {
        transition: all 0.2s ease-in-out;
    }
    .transition-hover:hover {
        border-color: var(--mygate-blue) !important;
        background-color: white !important;
    }
</style>

<?= $this->endSection() ?>
