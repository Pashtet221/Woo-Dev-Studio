# Woo Dev Studio — Project Profile

## Purpose

Woo Dev Studio is an English-language WordPress and WooCommerce development studio website targeting international and European clients.

Primary business goal: generate qualified leads for custom WordPress and WooCommerce development.

## Positioning

Primary positioning:

**Custom WooCommerce Development Studio**

The website should communicate specialization in custom WooCommerce stores, themes, plugins, integrations and ongoing development work.

Avoid positioning the company as a generic web agency unless a page explicitly requires broader WordPress coverage.

## Technology

- WordPress
- Custom WordPress theme
- PHP
- JavaScript
- CSS / SCSS
- ACF Pro
- Rank Math
- Custom WordPress Bridge
- Playwright
- Figma
- GitHub
- Codex

## Development principles

- Build from scratch; do not migrate legacy front-end code unless explicitly approved.
- Custom theme only.
- Reusable components over duplicated page-specific markup.
- Semantic HTML.
- Mobile-first responsive implementation.
- Accessibility-conscious markup and interactions.
- Minimal third-party dependencies.
- Performance-first implementation.
- SEO-friendly markup and content architecture.
- Existing components must be reused before creating new components.
- Keep templates thin; move reusable rendering into components.
- Keep business logic out of templates where practical.

## Do not use

- Elementor
- WPBakery
- Divi
- Generic page builders
- Unnecessary WordPress plugins
- WooCommerce unless ecommerce functionality is explicitly required
- Inline CSS for production components unless there is a documented reason
- Duplicated component markup when a reusable component already exists

## Design source of truth

Figma is the source of truth for visual implementation.

Implementation must match the approved Figma design while preserving responsive behavior, accessibility and maintainability.

Codex should inspect existing components and tokens before introducing new variants.

## Content architecture

### Pages

Commercial and corporate landing pages, including:

- Home
- Services
- WooCommerce Development
- WordPress Development
- Plugin Development
- Theme Development
- Integrations
- Maintenance
- About
- Contact

Exact sitemap will be finalized in `SEO_STRUCTURE.md` before full page production.

### Custom Post Types

Planned:

- `case_study` — portfolio / case studies

Add other CPTs only when there is a concrete content-model reason.

### Posts

Use WordPress posts for the blog / insights section.

## SEO rules

- One meaningful H1 per page.
- Logical heading hierarchy.
- Semantic landmarks.
- Editable SEO title and description through Rank Math.
- Canonical URLs handled consistently.
- Breadcrumb support where appropriate.
- Structured data only where semantically justified.
- Internal linking between services, case studies and relevant articles.
- Avoid creating near-duplicate SEO landing pages.

## Development workflow

1. Define content / SEO structure.
2. Create or update Figma design system.
3. Approve page design.
4. Read Figma design context.
5. Reuse or create theme components.
6. Connect editable fields through WordPress / ACF where required.
7. Run local QA.
8. Run Playwright checks.
9. Commit focused changes.
10. Open PR with concise summary and checks performed.

## Current phase

Project bootstrap.

Do not start mass-building pages until the SEO structure, core content model and initial design system are defined.
