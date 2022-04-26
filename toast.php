<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<?php 
    if(isset($_SESSION['status']) && $_SESSION['status'] != NULL) : 
        $notificacao = unserialize($_SESSION['status']);
?>
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11;">
    <div role="alert" aria-live="assertive" aria-atomic="true" class="toast bg-<?= $notificacao->status ?>">
        <div class="toast-header">
            <strong class="me-auto"><?= $notificacao->acao ?></strong>
            <small><?= $notificacao->pagina ?></small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            <?= $notificacao->msg ?>
        </div>
    </div>
</div>

<!-- arrow function -->
<script>
    var toastElList = [].slice.call(document.querySelectorAll('.toast'));
    var toastList = toastElList.map(function(toastEl) {
        return new bootstrap.Toast(toastEl)
    });

    toastList.forEach(toast => toast.show());
</script>

<?php
    $_SESSION['status'] = null;
    unset($_SESSION['status']);
    endif; 
?>