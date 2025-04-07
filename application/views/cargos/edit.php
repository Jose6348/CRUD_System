<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h2 class="mb-0">Editar Cargo</h2>
                </div>
                <div class="card-body">
                    <?php if (validation_errors()): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?php echo validation_errors(); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <form action="<?php echo base_url('cargos/update/' . $cargo->id); ?>" method="post">
                        <div class="mb-3">
                            <label for="nome" class="form-label">Nome do Cargo</label>
                            <input type="text" 
                                   class="form-control <?php echo form_error('nome') ? 'is-invalid' : ''; ?>" 
                                   id="nome" 
                                   name="nome" 
                                   value="<?php echo set_value('nome', $cargo->nome); ?>" 
                                   required>
                            <div class="invalid-feedback">
                                <?php echo form_error('nome'); ?>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="descricao" class="form-label">Descrição</label>
                            <textarea class="form-control <?php echo form_error('descricao') ? 'is-invalid' : ''; ?>" 
                                      id="descricao" 
                                      name="descricao" 
                                      rows="3" 
                                      required><?php echo set_value('descricao', $cargo->descricao); ?></textarea>
                            <div class="invalid-feedback">
                                <?php echo form_error('descricao'); ?>
                            </div>
                        </div>

                        <?php if (!empty($pessoas)): ?>
                        <div class="mb-4 ">
                            <h5>Pessoas neste Cargo</h5>
                            <div class="table-responsive">
                                <table class="table table-sm table-hover">
                                    <thead>
                                        <tr>
                                            <th>Nome</th>
                                            <th>Data de Início</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($pessoas as $pessoa): ?>
                                            <tr>
                                                <td><?php echo htmlspecialchars($pessoa->nome); ?></td>
                                                <td><?php echo date('d/m/Y', strtotime($pessoa->data_inicio)); ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <?php endif; ?>

                        <div class="d-flex justify-content-between">
                            <a href="<?php echo base_url('cargos'); ?>" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Voltar
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Salvar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> 