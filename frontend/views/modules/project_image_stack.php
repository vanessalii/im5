
<?php
$data = $args['data'] ?? [];
$images = $data['images'] ?? [];

if (empty($images)) {
    return;
}
?>

<section data-module="project_image_stack">
    <?php foreach ($images as $image): ?>
        <div class="storyboard-page">
            <img
                src="<?php echo esc_url($image['src']); ?>"
                alt="<?php echo esc_attr($image['alt'] ?? 'Storyboard-Illustration'); ?>"
                loading="lazy"
            >
        </div>
    <?php endforeach; ?>
</section>
