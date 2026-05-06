<?= $this->extend('admin/layout/default') ?>

<?= $this->section('content') ?>

<div class="card shadow-sm">
    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
        <h5 class="mb-0">Password Storer (UPS)</h5>
        <a href="/admin/settings/create_pass" class="btn btn-primary btn-sm">Add New Entry</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>URL</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($entries)): ?>
                        <?php foreach ($entries as $row): ?>
                            <tr>
                                <td><strong><?= esc($row['title']) ?></strong></td>
                                <td><a href="<?= esc($row['url']) ?>" target="_blank"><?= esc($row['url']) ?></a></td>
                                <td><?= esc($row['username']) ?></td>
                                <td><code><?= esc($row['password']) ?></code></td>
                                <td class="text-end">
                                    <a href="/admin/settings/delete_pass/<?= $row['pass_storer_id'] ?>" class="btn btn-sm btn-light text-danger" title="Delete" onclick="return confirm('Delete this entry?')">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center text-muted">No entries found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
