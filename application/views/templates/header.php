<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?? 'Sistema de Cargos'; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --sidebar-width: 250px;
            --content-padding: 1rem;
        }
        
        body {
            min-height: 100vh;
            display: flex;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        .wrapper {
            display: flex;
            width: 25%;
        }

        .sidebar {
            width: var(--sidebar-width);
            background-color: #343a40;
            color: white;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            transition: all 0.3s ease;
            top: 0;
            left: 0;
            z-index: 1000;
            padding: 1rem;
        }

        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.8);
            padding: 0.8rem 1rem;
            margin: 0.2rem 0;
            border-radius: 0.375rem;
            transition: all 0.3s ease;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            color: white;
            background-color: rgba(255, 255, 255, 0.1);
        }

        .main-content {
            flex: 1;
            margin-left: var(--sidebar-width);
            padding: var(--content-padding);
            min-height: 100vh;
            width: calc(100% - var(--sidebar-width));
        }

        .content-wrapper {
            height: 100%;
        }

        .card {
            border: none;
            border-radius: 0.5rem;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            background-color: white;
            height: calc(100vh - 2 * var(--content-padding));
            display: flex;
            flex-direction: column;
        }

        .card-header {
            background-color: white;
            border-bottom: 1px solid rgba(0, 0, 0, 0.125);
            padding: 1rem;
        }

        .card-body {
            flex: 1;
            overflow-y: auto;
            padding: 1rem;
        }

        .table-responsive {
            height: 100%;
            width: 100%;
        }

        .table {
            width: 100%;
            margin: 0;
        }

        .table thead th {
            background-color: #f8f9fa;
            position: sticky;
            top: 0;
            z-index: 1;
            padding: 1rem;
        }

        .table tbody td {
            padding: 1rem;
            vertical-align: middle;
        }

        .mobile-toggle {
            display: none;
            position: fixed;
            top: 1rem;
            right: 1rem;
            z-index: 1001;
            background-color: #343a40;
            color: white;
            border: none;
            padding: 0.5rem;
            border-radius: 0.375rem;
        }

        /* Estilos Mobile - Não afetam o Desktop */
        @media (max-width: 768px) {
            body {
                overflow-x: hidden;
            }

            .mobile-toggle {
                display: block;
            }

            .sidebar {
                transform: translateX(-100%);
                width: 100%;
                max-width: 300px;
            }
            
            .sidebar.show {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
                width: 100%;
                padding: 0.5rem;
            }

            .card {
                height: auto;
                margin-bottom: 1rem;
            }

            .card-body {
                padding: 0.5rem;
            }

            .table td, .table th {
                padding: 0.5rem;
                font-size: 0.9rem;
            }

            .btn {
                padding: 0.375rem 0.75rem;
                font-size: 0.9rem;
            }

            .form-control {
                font-size: 0.9rem;
            }

            .alert {
                margin: 0.5rem;
                padding: 0.5rem;
                font-size: 0.9rem;
            }

            .table-responsive {
                height: auto;
            }
        }

        @media (max-width: 576px) {
            .table-responsive {
                margin: 0 -0.5rem;
            }

            .card-header {
                padding: 0.75rem;
            }

            .btn-group {
                flex-wrap: wrap;
                gap: 0.25rem;
            }

            .pagination {
                flex-wrap: wrap;
                justify-content: center;
                gap: 0.25rem;
            }
        }
    </style>
</head>
<body>
    <button class="mobile-toggle" onclick="toggleSidebar()">
        <i class="fas fa-bars"></i>
    </button>

    <div class="wrapper">
        <nav class="sidebar">
            <div class="p-3">
                <h5 class="text-white mb-4">Menu</h5>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($this->uri->segment(1) == 'dashboard') ? 'active' : ''; ?>" href="<?php echo base_url('dashboard'); ?>">
                            <i class="fas fa-home me-2"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($this->uri->segment(1) == 'pessoas') ? 'active' : ''; ?>" href="<?php echo base_url('pessoas'); ?>">
                            <i class="fas fa-users me-2"></i> Pessoas
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($this->uri->segment(1) == 'cargos') ? 'active' : ''; ?>" href="<?php echo base_url('cargos'); ?>">
                            <i class="fas fa-briefcase me-2"></i> Cargos
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="main-content">
            <div class="content-wrapper">
                <?php if ($this->session->flashdata('success')): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>
                        <?php echo $this->session->flashdata('success'); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <?php if ($this->session->flashdata('error')): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        <?php echo $this->session->flashdata('error'); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleSidebar() {
            document.querySelector('.sidebar').classList.toggle('show');
        }

        // Fechar sidebar ao clicar em um link (mobile)
        document.querySelectorAll('.sidebar .nav-link').forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth <= 768) {
                    document.querySelector('.sidebar').classList.remove('show');
                }
            });
        });

        // Fechar sidebar ao clicar fora (mobile)
        document.addEventListener('click', (e) => {
            if (window.innerWidth <= 768 && 
                !e.target.closest('.sidebar') && 
                !e.target.closest('.mobile-toggle') &&
                document.querySelector('.sidebar').classList.contains('show')) {
                document.querySelector('.sidebar').classList.remove('show');
            }
        });
    </script>
</body>
</html> 