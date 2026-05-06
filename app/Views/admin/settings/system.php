<?= $this->extend('admin/layout/default') ?>

<?= $this->section('content') ?>

<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="card border-0 shadow-sm overflow-hidden">
            <div class="card-header bg-white py-4 px-4 border-bottom">
                <div class="d-flex align-items-center">
                    <div class="rounded-circle bg-light p-3 me-3">
                        <i class="bi bi-gear-wide-connected text-primary fs-4"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-bold">System Configuration</h5>
                        <p class="text-muted small mb-0">Global application settings and brand identity</p>
                    </div>
                </div>
            </div>
            <div class="card-body p-4 p-md-5">
                <form action="/admin/settings/system" method="POST">
                    <?= csrf_field() ?>
                    
                    <div class="row g-4 mb-4">
                        <?php foreach ($settings as $s): ?>
                        <div class="col-md-6">
                            <div class="p-3 border rounded-3 bg-light-subtle h-100 transition-hover">
                                <label class="form-label fw-bold text-dark small text-uppercase mb-2">
                                    <?= ucwords(str_replace('_', ' ', $s['type'])) ?>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0">
                                        <?php 
                                            $icon = 'bi-info-circle';
                                            if (str_contains($s['type'], 'email')) $icon = 'bi-envelope';
                                            if (str_contains($s['type'], 'phone')) $icon = 'bi-telephone';
                                            if (str_contains($s['type'], 'address')) $icon = 'bi-geo-alt';
                                            if (str_contains($s['type'], 'system_name')) $icon = 'bi-building';
                                            if (str_contains($s['type'], 'currency')) $icon = 'bi-currency-dollar';
                                            if (str_contains($s['type'], 'theme')) $icon = 'bi-palette';
                                        ?>
                                        <i class="bi <?= $icon ?> text-muted"></i>
                                    </span>
                                    <input type="text" class="form-control border-start-0 ps-0" 
                                           name="<?= esc($s['type']) ?>" 
                                           value="<?= esc($s['description']) ?>"
                                           placeholder="Enter <?= strtolower(str_replace('_', ' ', $s['type'])) ?>...">
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>

                    <hr class="my-4 text-secondary opacity-25">
                    
                    <div class="d-flex justify-content-between align-items-center">
                        <p class="text-muted small mb-0">
                            <i class="bi bi-shield-check me-1"></i> These settings affect the entire platform.
                        </p>
                        <button type="submit" class="btn btn-primary px-5 py-2 fw-bold shadow-sm">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .transition-hover:focus-within {
        border-color: var(--mygate-blue) !important;
        background-color: white !important;
        box-shadow: 0 4px 15px rgba(174, 223, 251, 0.2);
    }
    .form-control:focus {
        box-shadow: none;
        border-color: #dee2e6;
    }
    .bg-light-subtle {
        background-color: #fcfcfc;
    }
</style>

<?= $this->endSection() ?>
