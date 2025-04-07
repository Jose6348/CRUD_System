<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container-fluid px-4">
    <div class="row">
        <div class="col-12 mt-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="mb-0">
                    <i class="fas fa-briefcase me-2"></i>
                    Gerenciamento de Cargos
                </h2>
                <a href="<?php echo base_url('cargos/create'); ?>" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Novo Cargo
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
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Descrição</th>
                                    <th>Total de Pessoas</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($cargos)): ?>
                                    <tr>
                                        <td colspan="4" class="text-center">Nenhum cargo cadastrado</td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach ($cargos as $cargo): ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($cargo->nome); ?></td>
                                            <td><?php echo htmlspecialchars($cargo->descricao); ?></td>
                                            <td><?php echo $cargo->total_pessoas; ?></td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="<?php echo base_url('cargos/edit/' . $cargo->id); ?>" 
                                                       class="btn btn-sm btn-primary" 
                                                       title="Editar">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <button type="button" 
                                                            class="btn btn-sm btn-danger" 
                                                            title="Excluir"
                                                            onclick="confirmDelete(<?php echo $cargo->id; ?>)">
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
    if (confirm('Tem certeza que deseja excluir este cargo?')) {
        window.location.href = '<?php echo base_url('cargos/delete/'); ?>' + id;
    }
}
</script> 