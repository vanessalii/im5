<?php
$data = $args['data'];
?>

<section data-module="about_me">

    <?php if (!empty($data['image']['src'])): ?>
        <img
            class="image"
            src="<?= esc_url($data['image']['src']) ?>"
            alt="<?= esc_attr($data['image']['alt'] ?? '') ?>"
        >
    <?php endif; ?>

    <div class="content">
        
    <?php
    $title_parts = explode(' ', trim($data['title']), 2);
    ?>

    
    <h2 class="title">
        <span class="title-accent">
            <?= esc_html($data['title_accent'] ?? '') ?>
        </span>

        <?php if (!empty($data['title_main'])): ?>
            <span class="title-main">
                <?= esc_html($data['title_main']) ?>
            </span>
        <?php endif; ?>
    </h2>



        <?php if (!empty($data['description'])): ?>
            <p class="description">
                <?= nl2br(esc_html($data['description'])) ?>
            </p>
        <?php endif; ?>
    </div>

</section>
