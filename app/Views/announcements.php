<?= $this->extend('template') ?>

<?= $this->section('content') ?>
<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Announcements</h2>
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

            <?php if(empty($announcements)): ?>
                <div class="card">
                    <div class="card-body text-center py-5">
                        <i class="fas fa-bullhorn fa-3x text-muted mb-3"></i>
                        <h4 class="text-muted">No Announcements</h4>
                        <p class="text-muted">There are no announcements at the moment. Check back later!</p>
                    </div>
                </div>
            <?php else: ?>
                <div class="row">
                    <?php foreach($announcements as $announcement): ?>
                        <div class="col-12 mb-4">
                            <div class="card">
                                <div class="card-header bg-primary text-white">
                                    <h5 class="card-title mb-0"><?= esc($announcement['title']) ?></h5>
                                </div>
                                <div class="card-body">
                                    <p class="card-text"><?= nl2br(esc($announcement['content'])) ?></p>
                                </div>
                                <div class="card-footer text-muted">
                                    <small>
                                        <i class="fas fa-calendar-alt"></i>
                                        Posted on: <?= date('F j, Y \a\t g:i A', strtotime($announcement['created_at'])) ?>
                                    </small>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <div class="mt-4">
                <a href="<?= base_url('dashboard') ?>" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back to Dashboard
                </a>
            </div>
        </div>
    </div>
</div>

<style>
.card {
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    border: none;
    transition: box-shadow 0.3s ease;
}

.card:hover {
    box-shadow: 0 4px 8px rgba(0,0,0,0.15);
}

.card-header {
    border-bottom: none;
}

.card-footer {
    background-color: #f8f9fa;
    border-top: 1px solid #dee2e6;
}
</style>
<?= $this->endSection() ?>
