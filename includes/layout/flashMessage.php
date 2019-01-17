<?php

if (isset($_SESSION['flash'])) { ?>
    <div class="<?= 'flash-container flash-'.$_SESSION['flash']['class'] ?>">
        <p><?= $_SESSION['flash']['message']?></p>
    </div>
<?php } unset($_SESSION['flash']); ?>