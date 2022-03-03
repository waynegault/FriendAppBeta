<?php if ($ERROR['code'] == Null): ?>
    <h2>No errors have been detected</h2>
    <p>You've run the error reporting function without any error present. </p><br>
    <p>We've no errors to show!</p>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>

    <?php else: ?>
        <?php if ($ERROR['code'] == 404): ?>
            <br><br>
        <img src="<?= ($BASE) ?>/app/assets/images/404.png" alt ="Picture of exasperation!"/>
                <br><br>
                <br>
                <br>
                <br>
                <br><br>

            <?php else: ?>
                <h2>There's been an error!</h2>
                <p><b>Error code:</b> <?= ($ERROR['code']) ?></p>
                <p><b>Error status:</b> <?= ($ERROR['status']) ?></p>
                <p><b>Error text:</b> <?= ($ERROR['text']) ?><p>
                <p><b>Error level:</b> <?= ($ERROR['level']) ?><p>
                <h2>Details of what's going on</h2>
                <p>You might be able to identify reasons for the error in this data dump.</p>
                <p><?= ($DUMP) ?></p>
                <br><br>
                <br>
                <br>
                <br>
                <br><br>



            
        <?php endif; ?>
    
<?php endif; ?>
