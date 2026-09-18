(() => {
    const dialog = document.querySelector('[data-image-viewer-dialog]');
    const image = dialog?.querySelector('[data-image-viewer-image]');
    const closeButton = dialog?.querySelector('[data-image-viewer-close]');

    if (!dialog || !image || !closeButton || typeof dialog.showModal !== 'function') {
        return;
    }

    document.querySelectorAll('[data-image-viewer]').forEach((link) => {
        link.addEventListener('click', (event) => {
            event.preventDefault();
            image.src = link.href;
            image.alt = link.dataset.imageAlt || '';
            dialog.showModal();
        });
    });

    closeButton.addEventListener('click', () => dialog.close());
    dialog.addEventListener('click', (event) => {
        if (event.target === dialog) {
            dialog.close();
        }
    });
    dialog.addEventListener('close', () => {
        image.src = '';
        image.alt = '';
    });
})();
