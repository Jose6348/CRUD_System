<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0">Nova Pessoa</h5>
            </div>
            <div class="card-body">
                <form action="<?php echo base_url('pessoas/store'); ?>" method="post">
                    <div class="row g-3">
                        <div class="col-md-12 mb-3">
                            <label for="nome" class="form-label">Nome <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                                <input type="text" class="form-control" id="nome" name="nome" required>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                <input type="email" class="form-control" id="email" name="email">
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="telefone" class="form-label">Telefone</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                <input type="tel" class="form-control" id="telefone" name="telefone">
                            </div>
                        </div>

                        <div class="col-md-8 mb-3">
                            <label for="cargo_id" class="form-label">Cargo Inicial</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-briefcase"></i></span>
                                <select class="form-select" id="cargo_id" name="cargo_id">
                                    <option value="">Selecione um cargo...</option>
                                    <?php foreach ($cargos as $cargo): ?>
                                    <option value="<?php echo $cargo->id; ?>"><?php echo $cargo->nome; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="data_inicio" class="form-label">Data de Início</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                <input type="text" class="form-control date-input" id="data_inicio" name="data_inicio" placeholder="dd/mm/aaaa">
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="d-flex justify-content-end gap-2">
                        <a href="<?php echo base_url('pessoas'); ?>" class="btn btn-outline-secondary">
                            <i class="fas fa-times"></i> Cancelar
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