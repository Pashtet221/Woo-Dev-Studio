(() => {
    const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)');

    if (reducedMotion.matches || typeof IntersectionObserver === 'undefined') {
        return;
    }

    const revealSelectors = [
        '.site-main section > .container',
        '.site-main article > header > .container',
        '.site-main > header > .container',
        '.site-main > .container',
        '.site-footer__top',
        '.site-footer__bottom',
    ];
    const staggerSelectors = [
        '.service-card',
        '.project-card',
        '.process-step',
        '.contact-channel',
        '.service-catalog__item',
        '.service-scope__item',
        '.service-process__step',
        '.service-faq details',
        '.case-results article',
        '.about-principles article',
        '.about-capabilities__list article',
        '.article-card',
        '.legal-content section',
        '.case-gallery__blocks > *',
    ];
    const revealElements = [...document.querySelectorAll(revealSelectors.join(','))];

    document.querySelectorAll(staggerSelectors.join(',')).forEach((element) => {
        const siblings = [...element.parentElement.children].filter((sibling) =>
            staggerSelectors.some((selector) => sibling.matches(selector))
        );
        const position = siblings.indexOf(element) % 4;

        element.style.setProperty('--motion-delay', `${position * 70}ms`);
        revealElements.push(element);
    });

    const uniqueElements = [...new Set(revealElements)];

    uniqueElements.forEach((element) => element.classList.add('motion-reveal'));
    document.documentElement.classList.add('motion-ready');

    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (!entry.isIntersecting) {
                return;
            }

            entry.target.classList.add('is-revealed');
            observer.unobserve(entry.target);
        });
    }, {
        rootMargin: '0px 0px -8% 0px',
        threshold: 0.08,
    });

    uniqueElements.forEach((element) => observer.observe(element));
})();
