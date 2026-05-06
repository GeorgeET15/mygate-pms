<?= $this->extend('admin/layout/default') ?>

<?= $this->section('content') ?>

<div class="card shadow-sm">
    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
        <h5 class="mb-0">Add New Receipt</h5>
        <a href="/admin/accounting/receipts" class="btn btn-outline-secondary btn-sm">Back to List</a>
    </div>
    <div class="card-body">
        
        <form action="/admin/accounting/add_receipt" method="POST">
            <?= csrf_field() ?>
            <div class="row g-3">
                
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Receipt Number <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" name="receipt_no" value="<?= old('receipt_no') ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Date <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" name="receipt_date" value="<?= date('Y-m-d') ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Received From</label>
                        <input type="text" class="form-control" name="received_from" value="<?= old('received_from') ?>" placeholder="Payer Name">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Account (Ledger ID) <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" name="ledger_id" value="<?= old('ledger_id') ?>" required placeholder="Enter Ledger ID">
                        <div class="form-text">Reference the accounting ledger for the correct ID.</div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Amount (Credit) <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="number" step="0.01" class="form-control" name="cr_amt" value="<?= old('cr_amt', '0.00') ?>" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Amount (Debit)</label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="number" step="0.01" class="form-control" name="dr_amt" value="<?= old('dr_amt', '0.00') ?>">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Narration / Notes</label>
                        <textarea class="form-control" name="narration" rows="4"><?= old('narration') ?></textarea>
                    </div>
                </div>

                <div class="col-12">
                    <hr>
                    <div class="bg-light p-3 rounded mb-3">
                        <h6 class="mb-3">Payment Details (Optional)</h6>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label">Cheque/Ref Number</label>
                                <input type="text" class="form-control" name="cheq_no">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Bank Name</label>
                                <input type="text" class="form-control" name="bank">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Type</label>
                                <select name="type" class="form-select">
                                    <option value="Cash">Cash</option>
                                    <option value="Bank">Bank / Transfer</option>
                                    <option value="Cheque">Cheque</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            
            <div class="text-end">
                <button type="submit" class="btn btn-primary">Save Receipt</button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>
