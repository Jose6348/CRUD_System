<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row g-4 mt-5">
    <!-- Card Total de Pessoas -->
    <div class="col-md-6 col-lg-4">
        <div class="card shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                    <div class="flex-shrink-0">
                        <div class="bg-primary bg-opacity-10 p-3 rounded">
                            <i class="fas fa-users fa-2x text-primary"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="text-muted mb-1">Total de Pessoas</h6>
                        <h3 class="mb-0"><?php echo $total_pessoas; ?></h3>
                    </div>
                </div>
                <a href="<?php echo base_url('pessoas'); ?>" class="btn btn-light btn-sm w-100">
                    Ver Detalhes
                    <i class="fas fa-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Card Total de Cargos -->
    <div class="col-md-6 col-lg-4">
        <div class="card shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                    <div class="flex-shrink-0">
                        <div class="bg-success bg-opacity-10 p-3 rounded">
                            <i class="fas fa-briefcase fa-2x text-success"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="text-muted mb-1">Total de Cargos</h6>
                        <h3 class="mb-0"><?php echo $total_cargos; ?></h3>
                    </div>
                </div>
                <a href="<?php echo base_url('cargos'); ?>" class="btn btn-light btn-sm w-100">
                    Ver Detalhes
                    <i class="fas fa-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Card Média de Pessoas por Cargo -->
    <div class="col-md-6 col-lg-4">
        <div class="card shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                    <div class="flex-shrink-0">
                        <div class="bg-info bg-opacity-10 p-3 rounded">
                            <i class="fas fa-chart-pie fa-2x text-info"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="text-muted mb-1">Média de Pessoas por Cargo</h6>
                        <h3 class="mb-0"><?php echo number_format($media_pessoas_por_cargo, 1); ?></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Últimas Pessoas Cadastradas -->
    <div class="col-md-6">
        <div class="card shadow-sm h-100">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-user-plus me-2"></i>
                    Últimas Pessoas Cadastradas
                </h5>
            </div>
            <div class="card-body">
                <?php if (empty($ultimas_pessoas)): ?>
                    <div class="text-center py-4">
                        <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                        <p class="text-muted mb-0">Nenhuma pessoa cadastrada ainda.</p>
                    </div>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Cargo Atual</th>
                                    <th>ID do cadastro</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($ultimas_pessoas as $pessoa): ?>
                                    <tr>
                                        <td>
                                            <a href="<?php echo base_url('pessoas/edit/' . $pessoa->id); ?>" 
                                               class="text-decoration-none">
                                                <?php echo $pessoa->nome; ?>
                                            </a>
                                        </td>
                                        <td>
                                            <?php if ($pessoa->cargo_atual): ?>
                                                <span class="badge bg-info">
                                                    <?php echo $pessoa->cargo_atual; ?>
                                                </span>
                                            <?php else: ?>
                                                <span class="badge bg-secondary">
                                                    Sem cargo
                                                </span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <small class="text-muted">
                                                #<?php echo $pessoa->id; ?>
                                            </small>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Últimas Alterações de Cargo -->
    <div class="col-md-6">
        <div class="card shadow-sm h-100">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-exchange-alt me-2"></i>
                    Últimas Alterações de Cargo
                </h5>
            </div>
            <div class="card-body">
                <?php if (empty($ultimas_alteracoes)): ?>
                    <div class="text-center py-4">
                        <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                        <p class="text-muted mb-0">Nenhuma alteração de cargo registrada.</p>
                    </div>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead>
                                <tr>
                                    <th>Pessoa</th>
                                    <th>Cargo</th>
                                    <th>Data Início</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($ultimas_alteracoes as $alteracao): ?>
                                    <tr>
                                        <td>
                                            <a href="<?php echo base_url('pessoas/edit/' . $alteracao->pessoa_id); ?>" 
                                               class="text-decoration-none">
                                                <?php echo $alteracao->nome_pessoa; ?>
                                            </a>
                                        </td>
                                        <td>
                                            <span class="badge bg-success">
                                                <?php echo $alteracao->nome_cargo; ?>
                                            </span>
                                        </td>
                                        <td>
                                            <small class="text-muted">
                                                <?php echo date('d/m/Y', strtotime($alteracao->data_inicio)); ?>
                                            </small>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div> 