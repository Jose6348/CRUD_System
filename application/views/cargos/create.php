<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container-fluid px-4">
    <div class="row">
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-header">
                    <h2 class="mb-0">
                        <i class="fas fa-plus-circle me-2"></i>
                        Novo Cargo
                    </h2>
                </div>
                <div class="card-body">
                    <?php if ($this->session->flashdata('error')): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?php echo $this->session->flashdata('error'); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <?php echo form_open('cargos/store', ['class' => 'needs-validation', 'novalidate' => '']); ?>
                        <div class="mb-3">
                            <label for="nome" class="form-label">Nome do Cargo</label>
                            <input type="text" 
                                   class="form-control <?php echo form_error('nome') ? 'is-invalid' : ''; ?>" 
                                   id="nome" 
                                   name="nome" 
                                   value="<?php echo set_value('nome'); ?>" 
                                   required 
                                   minlength="3">
                            <div class="invalid-feedback">
                                <?php echo form_error('nome') ? form_error('nome') : 'Por favor, informe o nome do cargo (mínimo 3 caracteres).'; ?>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="descricao" class="form-label">Descrição</label>
                            <textarea class="form-control <?php echo form_error('descricao') ? 'is-invalid' : ''; ?>" 
                                      id="descricao" 
                                      name="descricao" 
                                      rows="3" 
                                      required 
                                      minlength="10"><?php echo set_value('descricao'); ?></textarea>
                            <div class="invalid-feedback">
                                <?php echo form_error('descricao') ? form_error('descricao') : 'Por favor, informe a descrição do cargo (mínimo 10 caracteres).'; ?>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="<?php echo base_url('cargos'); ?>" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-2"></i>
                                Voltar
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>
                                Salvar
                            </button>
                        </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Validação do lado do cliente
(function () {
    'use strict'
    var forms = document.querySelectorAll('.needs-validation')
    Array.prototype.slice.call(forms).forEach(function (form) {
        form.addEventListener('submit', function (event) {
            if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
            }
            form.classList.add('was-validated')
        }, false)
    })
})()
</script> 