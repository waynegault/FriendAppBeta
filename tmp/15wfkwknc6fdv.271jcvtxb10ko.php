
    <h1 class="page-header">Messages UI from template</h1>

        <?php foreach (($messages?:[]) as $message): ?>
            <p><?= ($message['id']) ?>. <?= ($message['key']) ?>. <?= ($message['message']) ?></p>
        <?php endforeach; ?>
