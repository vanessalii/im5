 <?php 
 $id = $args['id'];
$project = get_project_by_id($id); 

$category_slugs = wp_get_post_terms(
    $id,
    'project_category',
    ['fields' => 'slugs']
);

if (is_wp_error($category_slugs)) {
    $category_slugs = [];
}

?>




<a
    href="<?= $project['link'] ?>"
    target="_self"
    data-categories="<?= esc_attr(implode(' ', $category_slugs)) ?>"
>

    
    <?php if (!empty($project['project_categories'])): ?>
        <span class="project-category">
            <?= esc_html($project['project_categories'][0]) ?>
        </span>
    <?php endif; ?>

    <div class="project-image">
        <img src="<?= $project['image']['src'] ?>" alt="<?= $project['image']['alt'] ?>">
    </div>


    <h3><?= $project['title'] ?></h3>
    <p><?= $project['description'] ?></p>
</a>