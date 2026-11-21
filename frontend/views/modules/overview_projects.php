<?php
$data = $args['data'];

?>

<section data-module="overview_projects">
    
    <h2 class="title">
        <?php if (!empty($data['title_main'])): ?>
            <span class="title-main">
                <?= esc_html($data['title_main']) ?>
            </span>
        <?php endif; ?>

        <?php if (!empty($data['title_accent'])): ?>
            <span class="title-accent">
                <?= esc_html($data['title_accent']) ?>
            </span>
        <?php endif; ?>
    </h2>


    <?php
    $categories = [];

    if (!empty($data['selection'])) {
        $categories = wp_get_object_terms(
            $data['selection'],
            'project_category',
            ['orderby' => 'name', 'order' => 'ASC']
        );
    }
    ?>

    <?php if (!is_wp_error($categories) && !empty($categories)): ?>
        <div class="project-filters">
            <button type="button" class="project-filter is-active" data-category="all">
                alle.
            </button>

            <?php foreach ($categories as $category): ?>
                <button
                    type="button"
                    class="project-filter"
                    data-category="<?= esc_attr($category->slug) ?>"
                >
                    <?= esc_html($category->name) ?>
                </button>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>


    <div class="projects">
        <?php foreach ($data['selection'] as $project_id): ?>
           <?php
           get_template_part(
            'frontend/views/teaser/project',
            null,
            [
                'id' => $project_id
            ]
           );
           ?>           
        <?php endforeach; ?>
    </div>
</section>


<script>
document.querySelectorAll('[data-module="overview_projects"]').forEach((module) => {
    const buttons = module.querySelectorAll('.project-filter');
    const projects = module.querySelectorAll('.projects > a');

    buttons.forEach((button) => {
        button.addEventListener('click', () => {
            const selectedCategory = button.dataset.category;

            // Aktiven Button hervorheben
            buttons.forEach((item) => {
                item.classList.toggle(
                    'is-active',
                    item === button
                );
            });

            // Projekte filtern
            projects.forEach((project) => {
                const categories = project.dataset.categories.split(' ');

                const isVisible =
                    selectedCategory === 'all' ||
                    categories.includes(selectedCategory);

                project.style.display = isVisible ? '' : 'none';
            });
        });
    });
});
</script>
