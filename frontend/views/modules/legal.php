
<?php
$data = $args['data'] ?? [];
?>

<section data-module="legal">
    <div class="container" data-utility="wrap-page">

        <h1 class="legal-title">
            <?= esc_html(get_the_title()) ?>
        </h1>

        <?php if (!empty($data['legal_content'])): ?>
            <div class="legal-content">
                <?= wp_kses_post($data['legal_content']) ?>
            </div>
        <?php endif; ?>

    </div>
</section>
