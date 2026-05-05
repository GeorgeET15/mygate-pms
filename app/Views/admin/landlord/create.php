<?= $this->extend('admin/layout/default') ?>

<?= $this->section('content') ?>

<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-bold">Add New Landlord</h5>
                <a href="/admin/landlord" class="btn btn-sm btn-outline-secondary">
                    <i class="bi bi-arrow-left me-1"></i> Back to List
                </a>
            </div>
            <div class="card-body p-4">
                <form action="/admin/landlord/create" method="POST">
                    <?= csrf_field() ?>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">First Name</label>
                            <input type="text" name="first_name" class="form-control" placeholder="John" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Last Name</label>
                            <input type="text" name="last_name" class="form-control" placeholder="Doe" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Email Address</label>
                            <input type="email" name="email" class="form-control" placeholder="john.doe@example.com" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Contact Number</label>
                            <input type="text" name="contact_no" class="form-control" placeholder="+1 (555) 000-0000" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label small fw-bold">Address</label>
                            <input type="text" name="address" class="form-control" placeholder="123 Main St" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-bold">City</label>
                            <input type="text" name="city" class="form-control" placeholder="New York" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-bold">State</label>
                            <input type="text" name="state" class="form-control" placeholder="NY" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-bold">Zip Code</label>
                            <input type="text" name="zip_code" class="form-control" placeholder="10001" required>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label small fw-bold">Country</label>
                            <input type="text" name="country" class="form-control" value="USA" required>
                        </div>
                        <div class="col-12 text-end mt-4">
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="bi bi-check-circle me-2"></i> Save Landlord
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
