
<?php
$menu_items = get_menu_by_slug('main');
$logo = get_globals_logo();
?>

<header data-layout="header">
    <img class="logo" src="<?= $logo['src'] ?>" alt="<?= $logo['alt'] ?>" />

    <!-- Mobile Navigation -->
    <button
        class="menu-toggle"
        type="button"
        aria-label="Menü öffnen"
        aria-controls="main-navigation"
        aria-expanded="false"
    >
        <span></span>
        <span></span>
        <span></span>
    </button>

    <!-- Navigation -->
    <nav class="nav-container" id="main-navigation">
        <ul class="nav">
            <?php foreach ($menu_items as $item) : ?>
                <li class="nav-item">
                    <a target="<?= $item['target'] ?>" href="<?= $item['url'] ?>">
                        <?= $item['title'] ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </nav>
</header>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const header = document.querySelector('[data-layout="header"]');
    const toggle = header.querySelector('.menu-toggle');
    const nav = header.querySelector('.nav-container');

    // Menü öffnen oder schliessen
    function setMenuOpen(open) {
        toggle.setAttribute('aria-expanded', String(open));
        toggle.setAttribute(
            'aria-label',
            open ? 'Menü schliessen' : 'Menü öffnen'
        );
    }

    toggle.addEventListener('click', () => {
        const isOpen = toggle.getAttribute('aria-expanded') === 'true';
        setMenuOpen(!isOpen);
    });

    // Menü nach einem Klick auf einen Link schliessen
    nav.querySelectorAll('a').forEach(link => {
        link.addEventListener('click', () => setMenuOpen(false));
    });

    // Menü mit der Escape-Taste schliessen
    document.addEventListener('keydown', event => {
        if (event.key === 'Escape') {
            setMenuOpen(false);
        }
    });
});
</script>
