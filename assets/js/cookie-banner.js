const cookieBanner = document.querySelector('[data-cookie-banner]');
const cookieBannerAccept = document.querySelector('[data-cookie-banner-accept]');
const consentKey = 'wooDevStudioCookieConsent';

if (cookieBanner && cookieBannerAccept) {
    let hasConsent = false;

    try {
        hasConsent = window.localStorage.getItem(consentKey) === 'accepted';
    } catch (error) {
        // Storage can be unavailable in privacy modes; the notice remains dismissible.
    }

    if (!hasConsent) {
        cookieBanner.hidden = false;
    }

    cookieBannerAccept.addEventListener('click', () => {
        try {
            window.localStorage.setItem(consentKey, 'accepted');
        } catch (error) {
            // Dismiss the notice for the current page even when storage is unavailable.
        }

        cookieBanner.hidden = true;
    });
}
