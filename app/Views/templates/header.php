    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #2563EB;">
        <div class="container">
            <a class="navbar-brand fw-bold" href="<?= base_url(''); ?>">
                <?php if (session()->get('isLoggedIn')): ?>
                    Welcome, <?= session()->get('name') ?>
                <?php else: ?>
                    Student Portal
                <?php endif; ?>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <?php if (session()->get('isLoggedIn')): ?>
                        <?php $role = strtolower(session('role') ?? ''); ?>
                        <?php if ($role === 'admin'): ?>
                            <li><a class="nav-link" href="<?= base_url('admin/dashboard'); ?>">Admin Dashboard</a></li>
                          
                        <?php elseif ($role === 'teacher'): ?>
                            <li><a class="nav-link" href="<?= base_url('teacher/dashboard'); ?>">Teacher Dashboard</a></li>
                            <li><a class="nav-link" href="<?= base_url('announcements'); ?>">
                                <i class="fas fa-bullhorn"></i> Announcements
                            </a></li>
                        <?php elseif ($role === 'student'): ?>
                            <li><a class="nav-link" href="<?= base_url('announcements'); ?>">
                                <i class="fas fa-bullhorn"></i> Announcements
                            </a></li>
                            <li><a class="nav-link" href="<?= base_url('dashboard'); ?>">Student Dashboard</a></li>
                        <?php else: ?>
                            <li><a class="nav-link" href="<?= base_url('dashboard'); ?>">Dashboard</a></li>
                        <?php endif; ?>
                        <li>
                            <a class="nav-link" href="<?= base_url('logout'); ?>">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                        </li>
                    <?php else: ?>
                        <li> <a class="nav-link" href="<?= base_url('login'); ?>">Login</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>


