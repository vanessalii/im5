<?php
$menu_items = get_menu_by_slug('legals');

?>



<footer data-layout="footer">
    <nav class='nav-conatiner'>
        <ul class='nav'> 
            <?php foreach ($menu_items as $item) : ?>
                <li class='nav-item'>
                    <a  target="<?= $item['target'] ?>" href="<?= $item['url'] ?>">
                        <?= $item['title'] ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </nav>
</footer>
