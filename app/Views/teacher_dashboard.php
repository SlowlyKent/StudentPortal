<?= $this->extend('template') ?>

<?= $this->section('content') ?>
<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Teacher Dashboard</h2>
                <span class="text-muted">Welcome, <?= $user['name'] ?> (<?= ucfirst($user['role']) ?>)</span>
            </div>

            <?php if(session()->getFlashdata('success')): ?>
                <div class="alert alert-success">
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>
            
            <?php if(session()->getFlashdata('error')): ?>
                <div class="alert alert-danger">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <div class="card">
                <div class="card-body text-center py-5">
                    <h1 class="display-4 text-primary">Welcome, Teacher!</h1>
                    <p class="lead">You have successfully accessed the Teacher Dashboard.</p>
                    <p class="text-muted">This is your dedicated workspace for managing classes, students, and educational content.</p>
                </div>
            </div>

            <div class="mt-4">
                <a href="<?= base_url('announcements') ?>" class="btn btn-primary">
                    <i class="fas fa-bullhorn"></i> View Announcements
                </a>
                <a href="<?= base_url('logout') ?>" class="btn btn-secondary">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </div>
        </div>
    </div>
</div>

<style>
.card {
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    border: none;
}

.display-4 {
    font-weight: 300;
}
</style>
<?= $this->endSection() ?>

