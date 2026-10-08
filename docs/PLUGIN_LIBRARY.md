# Studio Plugins

The `plugin` content type describes the studio's products. The administration
menu is **Studio Plugins**, separate from WordPress's installed **Plugins** menu.
Publishing a product never installs, activates or runs its plugin code.

The public catalogue is `/studio-plugins/`, individual products use
`/studio-plugins/{slug}/`, and the REST collection is `/wp-json/wp/v2/studio-plugins`.
The existing Codex Bridge already allowlists the `plugin` type.
An existing registration from another component is preserved rather than replaced.

## Adding a product

1. Open Studio Plugins → Add studio plugin.
2. Write an English title, excerpt and description adapted to the intended market.
3. Complete the starter sections: features, how it works, installation, screenshots,
   video and FAQ. Remove unused sections; add more blocks when needed.
4. Upload screenshots into Gallery blocks and provide meaningful alt text.
   Use Video for an uploaded file or replace it with Embed for a supported provider.
5. Set a featured image for the catalogue and product cover.
6. Fill Studio plugin details: version, verified compatibility, PHP requirements,
   licence/pricing, languages, download/purchase, documentation and support URLs.
   Do not claim compatibility or legal compliance that has not been verified.
7. Add Rank Math SEO title, description and focus keyword in its normal interface.
8. Link relevant services, articles or projects from the description where helpful.
9. Preview at desktop and mobile widths, then publish when reviewed.

These product-detail fields use basic ACF fields when ACF is available, with a
native metabox fallback otherwise. They do not require ACF Pro. Descriptions,
screenshots and videos remain in the WordPress block editor, avoiding duplicated
content or a second gallery-management interface.

## Deployment

Deploy `functions.php`, `inc/plugin-library.php`, `single-plugin.php`,
`archive-plugin.php` and the updated stylesheet together as theme files. Registration
and one-time rewrite refresh happen on the next WordPress request. If another
component already registers `plugin`, inspect its routing before deployment.
Verify the Studio Plugins menu, create a draft, save details, add gallery/video
blocks and preview. Verify `/studio-plugins/` and one published product URL.
Do not assume live deployment from a local code change. The content Bridge does
not provide a theme-file deployment operation.
