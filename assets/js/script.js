$(document).ready(function() {
    // Ativa os tooltips do Bootstrap
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    });

    // Toggle do sidebar em dispositivos móveis
    $('#sidebarToggle').on('click', function() {
        $('#sidebar, #main-content').toggleClass('active');
    });

    // Fecha o sidebar ao clicar fora em dispositivos móveis
    $(document).on('click', function(e) {
        if ($(window).width() <= 768) {
            var sidebar = $('#sidebar');
            var sidebarToggle = $('#sidebarToggle');
            
            if (!sidebar.is(e.target) && 
                sidebar.has(e.target).length === 0 && 
                !sidebarToggle.is(e.target) && 
                sidebarToggle.has(e.target).length === 0) {
                sidebar.removeClass('active');
                $('#main-content').removeClass('active');
            }
        }
    });

    // Máscara para campos de data
    $('.date-input').on('input', function() {
        let value = this.value.replace(/\D/g, '').substring(0, 8);
        if (value.length >= 4) {
            value = value.replace(/(\d{2})(\d{2})(\d{0,4})/, '$1/$2/$3');
        } else if (value.length >= 2) {
            value = value.replace(/(\d{2})(\d{0,2})/, '$1/$2');
        }
        this.value = value;
    });

    // Máscara para campos de telefone
    $('.phone-input').on('input', function() {
        let value = this.value.replace(/\D/g, '').substring(0, 11);
        if (value.length >= 7) {
            value = value.replace(/(\d{2})(\d{5})(\d{0,4})/, '($1) $2-$3');
        } else if (value.length >= 2) {
            value = value.replace(/(\d{2})(\d{0,5})/, '($1) $2');
        }
        this.value = value;
    });

    // Confirmação de exclusão
    $('.delete-confirm').on('click', function(e) {
        e.preventDefault();
        var url = $(this).attr('href');
        
        if (confirm('Tem certeza que deseja excluir este registro?')) {
            window.location.href = url;
        }
    });

    // Animação suave para mensagens de alerta
    $('.alert').hide().slideDown();
    
    // Efeito de transição nos cards
    $('.card').css('opacity', '0').animate({
        opacity: 1,
        transform: 'translateY(0)'
    }, 300);

    // Efeito hover nas linhas da tabela
    $('.table-hover tbody tr').hover(
        function() {
            $(this).addClass('shadow-sm').css('transform', 'translateY(-1px)');
        },
        function() {
            $(this).removeClass('shadow-sm').css('transform', 'none');
        }
    );

    // Validação de formulários
    $('form').on('submit', function() {
        var valid = true;
        
        // Remove mensagens de erro anteriores
        $('.is-invalid').removeClass('is-invalid');
        $('.invalid-feedback').remove();
        
        // Valida campos obrigatórios
        $(this).find('[required]').each(function() {
            if (!$(this).val()) {
                $(this).addClass('is-invalid');
                $(this).after('<div class="invalid-feedback">Este campo é obrigatório.</div>');
                valid = false;
            }
        });
        
        // Valida formato de email
        $(this).find('[type="email"]').each(function() {
            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if ($(this).val() && !emailRegex.test($(this).val())) {
                $(this).addClass('is-invalid');
                $(this).after('<div class="invalid-feedback">Por favor, insira um email válido.</div>');
                valid = false;
            }
        });
        
        // Valida formato de data
        $('.date-input').each(function() {
            var dateRegex = /^(\d{2})\/(\d{2})\/(\d{4})$/;
            if ($(this).val() && !dateRegex.test($(this).val())) {
                $(this).addClass('is-invalid');
                $(this).after('<div class="invalid-feedback">Por favor, insira uma data válida (dd/mm/aaaa).</div>');
                valid = false;
            }
        });
        
        return valid;
    });
}); 