<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container-fluid px-4">
    <div class="row">
        <div class="col-12 mt-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="mb-0">
                    <i class="fas fa-users me-2"></i>
                    Gerenciamento de Pessoas
                </h2>
                <a href="<?php echo base_url('pessoas/create'); ?>" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Nova Pessoa
                </a>
            </div>

            <?php if ($this->session->flashdata('success')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?php echo $this->session->flashdata('success'); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <?php if ($this->session->flashdata('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?php echo $this->session->flashdata('error'); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th class="d-md-table-cell d-none">Email</th>
                                    <th class="d-md-table-cell d-none">Telefone</th>
                                    <th>Cargo Atual</th>
                                    <th class="text-center">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($pessoas)): ?>
                                    <tr>
                                        <td colspan="5" class="text-center">Nenhuma pessoa cadastrada</td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach ($pessoas as $pessoa): ?>
                                        <tr>
                                            <td>
                                                <?php echo htmlspecialchars($pessoa->nome); ?>
                                                <!-- Informações extras apenas no mobile -->
                                                <div class="d-md-none small text-muted">
                                                    <?php if ($pessoa->email): ?>
                                                        <a href="mailto:<?php echo htmlspecialchars($pessoa->email); ?>" class="text-decoration-none">
                                                            <?php echo htmlspecialchars($pessoa->email); ?>
                                                        </a>
                                                    <?php endif; ?>
                                                    <?php if ($pessoa->telefone): ?>
                                                        <br><?php echo htmlspecialchars($pessoa->telefone); ?>
                                                    <?php endif; ?>
                                                </div>
                                            </td>
                                            <td class="d-md-table-cell d-none">
                                                <?php if ($pessoa->email): ?>
                                                    <a href="mailto:<?php echo htmlspecialchars($pessoa->email); ?>" class="text-decoration-none">
                                                        <?php echo htmlspecialchars($pessoa->email); ?>
                                                    </a>
                                                <?php endif; ?>
                                            </td>
                                            <td class="d-md-table-cell d-none"><?php echo htmlspecialchars($pessoa->telefone); ?></td>
                                            <td>
                                                <?php if (!empty($pessoa->cargo_atual)): ?>
                                                    <span class="badge bg-info">
                                                        <?php echo htmlspecialchars($pessoa->cargo_atual); ?>
                                                    </span>
                                                <?php else: ?>
                                                    <span class="badge bg-secondary">Sem cargo</span>
                                                <?php endif; ?>
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <a href="<?php echo base_url('pessoas/edit/' . $pessoa->id); ?>" 
                                                       class="btn btn-sm btn-primary" 
                                                       title="Editar">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <button type="button" 
                                                            class="btn btn-sm btn-danger" 
                                                            onclick="confirmDelete(<?php echo $pessoa->id; ?>)"
                                                            title="Excluir">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                    <?php if (isset($pagination)): ?>
                        <div class="mt-4">
                            <?php echo $pagination; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function confirmDelete(id) {
    if (confirm('Tem certeza que deseja excluir esta pessoa?')) {
        window.location.href = '<?php echo base_url('pessoas/delete/'); ?>' + id;
    }
}
</script> 