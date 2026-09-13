const toggle = document.querySelector('.nav-toggle');
const navigation = document.querySelector('.primary-nav');

if (toggle && navigation) {
    toggle.addEventListener('click', () => {
        const isOpen = toggle.getAttribute('aria-expanded') === 'true';
        toggle.setAttribute('aria-expanded', String(!isOpen));
        navigation.classList.toggle('is-open', !isOpen);
        document.body.classList.toggle('has-open-menu', !isOpen);
    });

    navigation.querySelectorAll('a').forEach((link) => link.addEventListener('click', () => {
        toggle.setAttribute('aria-expanded', 'false');
        navigation.classList.remove('is-open');
        document.body.classList.remove('has-open-menu');
    }));
}
