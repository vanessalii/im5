<?php
$project = get_project_by_id(get_the_ID());

js_log($project);

?>

<main data-page="project">
    <section class="hero">
        <div class="container" data-utility="wrap-page">
            <p class="preline">
                <?php foreach ($project['project_categories'] as $category): ?>
                    <span class="category-item"><?= $category?></span>
                <?php endforeach; ?>
            </p>
            
            <h1 class="title"><?= $project['title'] ?></h1>

            <?php if (!empty($project['context'])): ?>
                <p class="type">
                    <?= esc_html($project['context']) ?>
                </p>
            <?php endif; ?>

            

            <?php if (!empty($project['lead'])): ?>
                <p class="lead">
                    <?= esc_html($project['lead']) ?>
                </p>
            <?php endif; ?>

            </div>
    </section>

    <section class="content">
        <div class="container" data-utility="wrap-page">
            
        <?php if (empty($project['hide_detail_image']) && !empty($project['image']['src'])): ?>
            <img
                class="image"
                src="<?= esc_url($project['image']['src']) ?>"
                alt="<?= esc_attr($project['image']['alt'] ?? '') ?>"
            >
        <?php endif; ?>


        <?php render_project_modules(); ?>


            <div class="project-info">
            
        <?php if (!empty($project['text'])): ?>
            <div class="project-description">
                <h2 class="section-title">
                    <span class="title-accent">über das</span>
                    <span class="title-main">PROJEKT.</span>
                </h2>

                <div data-utility="wysiwyg" class="text">
                    <?= wpautop($project['text']) ?>
                </div>
            </div>
        <?php endif; ?>


        <?php if (!empty($project['role'])): ?>
            <div class="project-role">
                
            <h2 class="role-title">Meine Rolle.</h2>
                
            <ul class="role-list">
                <?php foreach (preg_split('/\R/u', trim($project['role'])) as $task): ?>
                    <?php if (trim($task) !== ''): ?>
                        <li><?= esc_html(trim($task)) ?></li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>

            </div>
        <?php endif; ?>

            </div>

        <?php if (!empty($project['special'])): ?>
            <div class="project-special">
                <h2 class="special-title">Besonderes.</h2>

                <div class="special-text">
                    <?= wpautop(esc_html($project['special'])) ?>
                </div>
            </div>
        <?php endif; ?>

        </div>

    </section>


<?php $next_project = get_next_post(); ?>

<nav class="project-navigation" aria-label="Projektnavigation">
    <a class="nav-back" href="<?= esc_url(home_url('/#projekte')) ?>">
        ← zurück zu Projekten
    </a>

    <?php if ($next_project): ?>
        <a class="nav-next" href="<?= esc_url(get_permalink($next_project->ID)) ?>">
            nächstes Projekt →
        </a>
    <?php endif; ?>
</nav>


</main>
