<div class="flash-box" <?= !empty($flash['message']) ? 'style="display:block"' : '' ?>>
    <div class="flash <?= !empty($flash['status']) ? "flash-{$flash['status']}" : '' ?>">
        <?= $flash['message'] ?? '' ?>
    </div>
</div>
