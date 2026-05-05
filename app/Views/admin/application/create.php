<?= $this->extend('admin/layout/default') ?>

<?= $this->section('content') ?>

<div class="card shadow-sm">
    <div class="card-header bg-white py-3">
        <h5 class="mb-0">New Rental Application</h5>
    </div>
    <div class="card-body">
        
        <!-- Step Indicator -->
        <div class="d-flex justify-content-between mb-4 border-bottom pb-3">
            <div class="step-item text-center active" id="step-cap-1">
                <div class="step-num bg-primary text-white rounded-circle d-inline-block mb-1" style="width:30px;height:30px;line-height:30px;">1</div>
                <div class="small">Applicant</div>
            </div>
            <div class="step-item text-center" id="step-cap-2">
                <div class="step-num bg-light text-muted rounded-circle d-inline-block mb-1" style="width:30px;height:30px;line-height:30px;">2</div>
                <div class="small">Employer</div>
            </div>
            <div class="step-item text-center" id="step-cap-3">
                <div class="step-num bg-light text-muted rounded-circle d-inline-block mb-1" style="width:30px;height:30px;line-height:30px;">3</div>
                <div class="small">History</div>
            </div>
            <div class="step-item text-center" id="step-cap-4">
                <div class="step-num bg-light text-muted rounded-circle d-inline-block mb-1" style="width:30px;height:30px;line-height:30px;">4</div>
                <div class="small">Questions</div>
            </div>
            <div class="step-item text-center" id="step-cap-5">
                <div class="step-num bg-light text-muted rounded-circle d-inline-block mb-1" style="width:30px;height:30px;line-height:30px;">5</div>
                <div class="small">References</div>
            </div>
        </div>

        <form action="/admin/application/create" method="POST" id="onboardingForm">
            <?= csrf_field() ?>
            
            <!-- Step 1: Applicant Info -->
            <div class="step-content" id="step-1">
                <h6 class="mb-3 text-primary border-bottom pb-2">Applicant Information</h6>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Property <span class="text-danger">*</span></label>
                        <select name="property_name" class="form-select" required>
                            <option value="">Select Property</option>
                            <?php foreach($properties as $p): ?>
                                <option value="<?= $p['property_id'] ?>"><?= esc($p['property_name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Desired Move-in Date</label>
                        <input type="date" name="movein_date" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Full Name <span class="text-danger">*</span></label>
                        <input type="text" name="full_name" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Phone Number <span class="text-danger">*</span></label>
                        <input type="text" name="phone_number" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">SSN</label>
                        <input type="text" name="ssn" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Date of Birth</label>
                        <input type="date" name="dob" class="form-control">
                    </div>
                </div>
                <div class="text-end mt-4">
                    <button type="button" class="btn btn-primary next-step">Next: Employer Info <i class="bi bi-arrow-right"></i></button>
                </div>
            </div>

            <!-- Step 2: Employer Info -->
            <div class="step-content d-none" id="step-2">
                <h6 class="mb-3 text-primary border-bottom pb-2">Employer Information</h6>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Current Employer</label>
                        <input type="text" name="emp_name" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Job Type</label>
                        <select name="job_type" class="form-select">
                            <option value="Full-Time">Full-Time</option>
                            <option value="Part-Time">Part-Time</option>
                            <option value="Contract">Contract</option>
                            <option value="Unemployed">Unemployed</option>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">Employer Address</label>
                        <textarea name="emp_address" class="form-control" rows="2"></textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Position</label>
                        <input type="text" name="position" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Monthly Income</label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="number" name="monthly_income" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="text-end mt-4">
                    <button type="button" class="btn btn-outline-secondary prev-step me-2">Back</button>
                    <button type="button" class="btn btn-primary next-step">Next: Rental History <i class="bi bi-arrow-right"></i></button>
                </div>
            </div>

            <!-- Step 3: Rental History -->
            <div class="step-content d-none" id="step-3">
                <h6 class="mb-3 text-primary border-bottom pb-2">Rental History</h6>
                <div class="row g-3">
                    <div class="col-md-12">
                        <label class="form-label">Current Address</label>
                        <textarea name="cur_address" class="form-control" rows="2"></textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Current Rent Amount</label>
                        <input type="number" name="cur_renamnt" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Current Landlord Name</label>
                        <input type="text" name="curlname" class="form-control">
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">Reason for Leaving</label>
                        <textarea name="cur_resleaving" class="form-control" rows="2"></textarea>
                    </div>
                </div>
                <div class="text-end mt-4">
                    <button type="button" class="btn btn-outline-secondary prev-step me-2">Back</button>
                    <button type="button" class="btn btn-primary next-step">Next: Questions <i class="bi bi-arrow-right"></i></button>
                </div>
            </div>

            <!-- Step 4: Questions -->
            <div class="step-content d-none" id="step-4">
                <h6 class="mb-3 text-primary border-bottom pb-2">Background Questions</h6>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Ever declared bankruptcy?</label>
                        <select name="dec_bankrupcy" class="form-select">
                            <option value="No">No</option>
                            <option value="Yes">Yes</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Ever been evicted?</label>
                        <select name="evicted_residence" class="form-select">
                            <option value="No">No</option>
                            <option value="Yes">Yes</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Ever convicted of a felony?</label>
                        <select name="con_felony" class="form-select">
                            <option value="No">No</option>
                            <option value="Yes">Yes</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Currently on probation/parole?</label>
                        <select name="parole" class="form-select">
                            <option value="No">No</option>
                            <option value="Yes">Yes</option>
                        </select>
                    </div>
                </div>
                <div class="text-end mt-4">
                    <button type="button" class="btn btn-outline-secondary prev-step me-2">Back</button>
                    <button type="button" class="btn btn-primary next-step">Next: References <i class="bi bi-arrow-right"></i></button>
                </div>
            </div>

            <!-- Step 5: References -->
            <div class="step-content d-none" id="step-5">
                <h6 class="mb-3 text-primary border-bottom pb-2">References & Emergency Contact</h6>
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Reference 1 Name</label>
                        <input type="text" name="ref1_name" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Reference 1 Phone</label>
                        <input type="text" name="ref1phone" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Reference 1 Relation</label>
                        <input type="text" name="ref1relation" class="form-control">
                    </div>
                    <div class="col-md-12"><hr></div>
                    <div class="col-md-4">
                        <label class="form-label">Emergency Contact Name</label>
                        <input type="text" name="emrcontactname" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Emergency Phone</label>
                        <input type="text" name="emr_contactnumber" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Relation</label>
                        <input type="text" name="emr_contactrel" class="form-control">
                    </div>
                </div>
                <div class="text-end mt-4">
                    <button type="button" class="btn btn-outline-secondary prev-step me-2">Back</button>
                    <button type="submit" class="btn btn-success">Submit Application <i class="bi bi-check-circle"></i></button>
                </div>
            </div>

        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let currentStep = 1;
    const totalSteps = 5;

    function showStep(step) {
        document.querySelectorAll('.step-content').forEach(el => el.classList.add('d-none'));
        document.getElementById('step-' + step).classList.remove('d-none');
        
        // Update caps
        document.querySelectorAll('.step-item').forEach((el, idx) => {
            const numEl = el.querySelector('.step-num');
            if (idx + 1 < step) {
                numEl.classList.replace('bg-primary', 'bg-success');
                numEl.classList.replace('bg-light', 'bg-success');
                numEl.classList.replace('text-muted', 'text-white');
                numEl.innerHTML = '<i class="bi bi-check"></i>';
            } else if (idx + 1 === step) {
                numEl.classList.replace('bg-success', 'bg-primary');
                numEl.classList.replace('bg-light', 'bg-primary');
                numEl.classList.replace('text-muted', 'text-white');
                numEl.innerHTML = step;
            } else {
                numEl.classList.replace('bg-primary', 'bg-light');
                numEl.classList.replace('bg-success', 'bg-light');
                numEl.classList.replace('text-white', 'text-muted');
                numEl.innerHTML = idx + 1;
            }
        });
    }

    document.querySelectorAll('.next-step').forEach(btn => {
        btn.addEventListener('click', () => {
            if (currentStep < totalSteps) {
                currentStep++;
                showStep(currentStep);
            }
        });
    });

    document.querySelectorAll('.prev-step').forEach(btn => {
        btn.addEventListener('click', () => {
            if (currentStep > 1) {
                currentStep--;
                showStep(currentStep);
            }
        });
    });
});
</script>

<?= $this->endSection() ?>
