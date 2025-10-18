<?= $this->extend('template') ?>

<?= $this->section('content') ?>
<div class="container mt-4">
    <?php if(session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>
    
    <?php if(session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <?php 
    // Get user data from session if not passed directly
    $user = $user ?? [
        'id' => session()->get('user_id'),
        'name' => session()->get('name'),
        'email' => session()->get('email'),
        'role' => session()->get('role')
    ];
    
    // Ensure we have a valid role
    $role = $user['role'] ?? 'guest';
    
    try {
        // Load the appropriate view based on user role
        switch (strtolower($role)) {
            case 'admin':
                echo view('admin', ['user' => $user]);
                break;
            case 'teacher':
                echo view('teacher', ['user' => $user]);
                break;
            case 'student':
                echo view('student', ['user' => $user]);
                break;
            default:
                echo view('errors/html/error_403', ['message' => 'Unauthorized access. Please login with valid credentials.']);
                break;
        }
    } catch (\Exception $e) {
        log_message('error', 'Error loading dashboard view: ' . $e->getMessage());
        echo '<div class="alert alert-danger">Error loading dashboard. Please try again later.</div>';
    }
    ?>
</div>
<?= $this->endSection() ?>