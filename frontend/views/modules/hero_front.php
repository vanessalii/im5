
<?php
$data = $args['data'];
?>

<section data-module="hero_front">

    <div class="hero-content">
        <h1 class="title">
            <?= esc_html($data['title']) ?>
        </h1>

        <div class="hero-info">
            <?php if (!empty($data['name'])): ?>
                <span class="name">
                    <?= esc_html($data['name']) ?>
                </span>
            <?php endif; ?>

            <?php if (!empty($data['name']) && !empty($data['subline'])): ?>
                <span class="separator">|</span>
            <?php endif; ?>

            <?php if (!empty($data['subline'])): ?>
                <span class="subline">
                    <?= esc_html($data['subline']) ?>
                </span>
            <?php endif; ?>
        </div>
    </div>

    <img
        class="image"
        src="<?= esc_url($data['image']['src']) ?>"
        alt="<?= esc_attr($data['image']['alt']) ?>"
    >

</section>
