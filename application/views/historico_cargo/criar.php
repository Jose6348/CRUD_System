<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Novo Histórico de Cargo - <?php echo $pessoa['nome']; ?></h1>
    <a href="<?php echo base_url('pessoas/historico/' . $pessoa['id']); ?>" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Voltar
    </a>
</div>

<div class="card">
    <div class="card-body">
        <?php echo form_open('historico-cargos/criar/' . $pessoa['id']); ?>
            <div class="form-group">
                <label for="cargo_id">Cargo</label>
                <select class="form-control <?php echo form_error('cargo_id') ? 'is-invalid' : ''; ?>" 
                        id="cargo_id" name="cargo_id" required>
                    <option value="">Selecione um cargo</option>
                    <?php foreach ($cargos as $cargo): ?>
                        <option value="<?php echo $cargo['id']; ?>" <?php echo set_select('cargo_id', $cargo['id']); ?>>
                            <?php echo $cargo['nome']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <?php if (form_error('cargo_id')): ?>
                    <div class="invalid-feedback">
                        <?php echo form_error('cargo_id'); ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="data_inicio">Data de Início</label>
                <input type="date" class="form-control <?php echo form_error('data_inicio') ? 'is-invalid' : ''; ?>" 
                       id="data_inicio" name="data_inicio" value="<?php echo set_value('data_inicio'); ?>" required>
                <?php if (form_error('data_inicio')): ?>
                    <div class="invalid-feedback">
                        <?php echo form_error('data_inicio'); ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="data_fim">Data de Fim</label>
                <input type="date" class="form-control <?php echo form_error('data_fim') ? 'is-invalid' : ''; ?>" 
                       id="data_fim" name="data_fim" value="<?php echo set_value('data_fim'); ?>">
                <?php if (form_error('data_fim')): ?>
                    <div class="invalid-feedback">
                        <?php echo form_error('data_fim'); ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Salvar
                </button>
            </div>
        <?php echo form_close(); ?>
    </div>
</div> 