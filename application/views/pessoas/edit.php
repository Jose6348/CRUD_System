<div class="container-fluid px-4">
    <div class="row">
        <!-- Formulário de Edição -->
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-header">
                    <h2 class="mb-0">
                        <i class="fas fa-user-edit me-2"></i>
                        Editar Pessoa
                    </h2>
                </div>
                <div class="card-body">
                    <?php if ($this->session->flashdata('error')): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?php echo $this->session->flashdata('error'); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <?php if ($this->session->flashdata('success')): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?php echo $this->session->flashdata('success'); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <form action="<?php echo base_url('pessoas/update/' . $pessoa->id); ?>" method="post">
                        <div class="mb-3">
                            <label for="nome" class="form-label">Nome</label>
                            <input type="text" 
                                   class="form-control" 
                                   id="nome" 
                                   name="nome" 
                                   value="<?php echo set_value('nome', $pessoa->nome); ?>" 
                                   required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" 
                                   class="form-control" 
                                   id="email" 
                                   name="email" 
                                   value="<?php echo set_value('email', $pessoa->email); ?>">
                        </div>

                        <div class="mb-3">
                            <label for="telefone" class="form-label">Telefone</label>
                            <input type="text" 
                                   class="form-control" 
                                   id="telefone" 
                                   name="telefone" 
                                   value="<?php echo set_value('telefone', $pessoa->telefone); ?>" 
                                   required>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="<?php echo base_url('pessoas'); ?>" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-2"></i>
                                Voltar
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>
                                Salvar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Histórico de Cargos -->
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h2 class="mb-0">
                        <i class="fas fa-history me-2"></i>
                        Histórico de Cargos
                    </h2>
                    <button type="button" 
                            class="btn btn-primary btn-sm" 
                            data-bs-toggle="modal" 
                            data-bs-target="#addCargoModal">
                        <i class="fas fa-plus me-2"></i>
                        Adicionar Cargo
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 35%">Cargo</th>
                                    <th style="width: 25%">Data Início</th>
                                    <th style="width: 25%">Data Fim</th>
                                    <th style="width: 15%">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($historico)): ?>
                                    <tr>
                                        <td colspan="4" class="text-center">Nenhum cargo registrado</td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach ($historico as $cargo): ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($cargo->cargo_nome); ?></td>
                                            <td><?php echo date('d/m/Y', strtotime($cargo->data_inicio)); ?></td>
                                            <td>
                                                <?php echo $cargo->data_fim ? date('d/m/Y', strtotime($cargo->data_fim)) : '-'; ?>
                                            </td>
                                            <td>
                                                <div class="btn-group btn-group-sm">
                                                    <button type="button" 
                                                            class="btn btn-info"
                                                            onclick="editarHistorico(<?php echo $cargo->id; ?>, '<?php echo $cargo->data_inicio; ?>', '<?php echo $cargo->data_fim; ?>')">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button type="button" 
                                                            class="btn btn-danger"
                                                            onclick="confirmarExclusao(<?php echo $cargo->id; ?>)">
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
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Adicionar Cargo -->
<div class="modal fade" id="addCargoModal" tabindex="-1" aria-labelledby="addCargoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCargoModalLabel">Adicionar Novo Cargo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?php echo base_url('pessoas/add_cargo/' . $pessoa->id); ?>" method="post">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="cargo_id" class="form-label">Cargo</label>
                        <select class="form-select" id="cargo_id" name="cargo_id" required>
                            <option value="">Selecione um cargo</option>
                            <?php foreach ($cargos as $cargo): ?>
                                <option value="<?php echo $cargo->id; ?>">
                                    <?php echo htmlspecialchars($cargo->nome); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="data_inicio" class="form-label">Data de Início</label>
                        <input type="date" 
                               class="form-control" 
                               id="data_inicio" 
                               name="data_inicio" 
                               value="<?php echo date('Y-m-d'); ?>" 
                               required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Editar Histórico -->
<div class="modal fade" id="editHistoricoModal" tabindex="-1" aria-labelledby="editHistoricoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editHistoricoModalLabel">Editar Histórico</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formEditHistorico" action="" method="post">
                <div class="modal-body">
                    <input type="hidden" name="pessoa_id" value="<?php echo $pessoa->id; ?>">
                    <div class="mb-3">
                        <label for="edit_data_inicio" class="form-label">Data de Início</label>
                        <input type="date" 
                               class="form-control" 
                               id="edit_data_inicio" 
                               name="data_inicio" 
                               required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_data_fim" class="form-label">Data de Fim</label>
                        <input type="date" 
                               class="form-control" 
                               id="edit_data_fim" 
                               name="data_fim">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Confirmar Exclusão -->
<div class="modal fade" id="deleteCargoModal" tabindex="-1" aria-labelledby="deleteCargoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteCargoModalLabel">Confirmar Exclusão</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Tem certeza que deseja excluir este cargo do histórico?</p>
                <p class="text-danger"><small>Esta ação não poderá ser desfeita.</small></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <form id="formDeleteCargo" action="" method="post" style="display: inline;">
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash me-2"></i>
                        Excluir
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function editarHistorico(id, dataInicio, dataFim) {
    document.getElementById('formEditHistorico').action = '<?php echo base_url('pessoas/update_historico/'); ?>' + id;
    document.getElementById('edit_data_inicio').value = dataInicio.split(' ')[0];
    if (dataFim) {
        document.getElementById('edit_data_fim').value = dataFim.split(' ')[0];
    } else {
        document.getElementById('edit_data_fim').value = '';
    }
    new bootstrap.Modal(document.getElementById('editHistoricoModal')).show();
}

function confirmarExclusao(id) {
    document.getElementById('formDeleteCargo').action = '<?php echo base_url('pessoas/delete_historico/'); ?>' + id;
    new bootstrap.Modal(document.getElementById('deleteCargoModal')).show();
}
</script> 