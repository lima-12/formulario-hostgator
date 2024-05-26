<div id="message-container" class="container mt-5 text-center" style="height: 60px;">
    <div class="row">
        <div class="col-8 col-md-6 col-lg-4 mx-auto">

            <?php if (isset($_SESSION['message'])): ?>
                <div id="message" class="alert alert-danger" role="alert" style="display: none;">
                    <?= $_SESSION['message'] ?>
                    <div id="progress-bar" style="height: 5px; background-color: red; width: 100%; margin-top: 5px;"></div>
                </div>
            <?php endif; ?>

        </div>
    </div>
</div>

<?php unset($_SESSION['message']); // Limpa a mensagem após exibir ?>


<script>
    $(document).ready(function() {
        // Mostrar a mensagem com efeito de aparição
        $('#message').fadeIn('slow');

        // Iniciar a barra de progresso
        var progressBar = $('#progress-bar');
        progressBar.css('width', '100%');
        progressBar.animate({ width: '0%' }, 5000, 'linear');

        // Script para remover a mensagem após 5 segundos
        setTimeout(function() {
            $('#message').fadeOut('slow', function() {
                $(this).css('display', 'none');
            });
        }, 5000); // 5000 milissegundos = 5 segundos
    });
</script>
