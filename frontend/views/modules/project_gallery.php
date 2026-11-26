
<?php
$data = $args['data'] ?? [];

if (empty($data['images'])) {
    return;
}
?>

<section data-module="project_gallery">
    <div class="gallery-grid">
        
    <?php foreach ($data['images'] as $image): ?>
        <a class="gallery-item" href="<?= esc_url($image['src']) ?>">
            <img
                src="<?= esc_url($image['src']) ?>"
                alt="<?= esc_attr($image['alt'] ?? '') ?>"
                loading="lazy"
            >

            <?php if (!empty($image['title']) || !empty($image['year'])): ?>
                <span class="gallery-caption">
                    <span class="gallery-title">
                        <?= esc_html($image['title'] ?? '') ?>
                    </span>

                    <span class="gallery-year">
                        <?= esc_html($image['year'] ?? '') ?>
                    </span>
                </span>
            <?php endif; ?>
        </a>
    <?php endforeach; ?>

    </div>

    
    <dialog class="gallery-lightbox" aria-label="Bildergalerie">
        <button class="lightbox-prev" type="button" aria-label="Vorheriges Bild">←</button>

        <div class="lightbox-image-wrap">
            <img class="lightbox-image" src="" alt="">

            <div class="lightbox-caption">
                <span class="lightbox-title"></span>
                <span class="lightbox-year"></span>
            </div>

            <button class="lightbox-close" type="button" aria-label="Schliessen">×</button>
        </div>

        <button class="lightbox-next" type="button" aria-label="Nächstes Bild">→</button>
    </dialog>

</section>

<script>
(() => {
    const gallery = document.currentScript.previousElementSibling;
    const links = [...gallery.querySelectorAll('.gallery-item')];
    const dialog = gallery.querySelector('.gallery-lightbox');
    const image = gallery.querySelector('.lightbox-image');
    let currentIndex = 0;

    function showImage(index) {
        currentIndex = (index + links.length) % links.length;

        const link = links[currentIndex];
        image.src = link.href;
        image.alt = link.querySelector('img').alt;

        const title = link.querySelector('.gallery-title');
        const year = link.querySelector('.gallery-year');

        dialog.querySelector('.lightbox-title').textContent =
            title ? title.textContent.trim() : '';

        dialog.querySelector('.lightbox-year').textContent =
            year ? year.textContent.trim() : '';

    }

    links.forEach((link, index) => {
        link.addEventListener('click', (event) => {
            event.preventDefault();
            showImage(index);
            dialog.showModal();
        });
    });

    dialog.querySelector('.lightbox-close').addEventListener('click', () => {
        dialog.close();
    });

    dialog.querySelector('.lightbox-prev').addEventListener('click', () => {
        showImage(currentIndex - 1);
    });


/* Wischgesten für die Lightbox */
const swipeArea = dialog.querySelector('.lightbox-image-wrap');

let touchStartX = 0;
let touchStartY = 0;

swipeArea.addEventListener('touchstart', (event) => {
    if (event.touches.length !== 1) return;

    touchStartX = event.touches[0].clientX;
    touchStartY = event.touches[0].clientY;
}, { passive: true });

swipeArea.addEventListener('touchend', (event) => {
    const touch = event.changedTouches[0];
    if (!touch) return;

    const deltaX = touch.clientX - touchStartX;
    const deltaY = touch.clientY - touchStartY;

    // Nur horizontale Wischbewegungen erkennen
    if (Math.abs(deltaX) < 50 || Math.abs(deltaX) <= Math.abs(deltaY)) {
        return;
    }

    // Nach links: nächstes Bild
    if (deltaX < 0) {
        showImage(currentIndex + 1);
    }

    // Nach rechts: vorheriges Bild
    else {
        showImage(currentIndex - 1);
    }
}, { passive: true });


    dialog.querySelector('.lightbox-next').addEventListener('click', () => {
        showImage(currentIndex + 1);
    });

    dialog.addEventListener('keydown', (event) => {
        if (event.key === 'ArrowLeft') showImage(currentIndex - 1);
        if (event.key === 'ArrowRight') showImage(currentIndex + 1);
    });

    dialog.addEventListener('click', (event) => {
        if (event.target === dialog) dialog.close();
    });
})();
</script>
