# Woo Dev Studio — Codex rules

This repository contains the Woo Dev Studio custom WordPress theme and the Codex client used to work with the live/staging WordPress installation through `scripts/wp`.

## Before starting work

- Run `bash scripts/wp health` when the task requires access to WordPress.
- Read `docs/PROJECT_PROFILE.md`.
- Read `docs/CODEX_WORKFLOW.md`.
- If a task concerns an existing WordPress page, post, case study, SEO field, ACF field, media item or other WordPress object, read its current state through `scripts/wp` before modifying it.

## Sources of truth

- Visual design: Figma.
- PHP/CSS/JS/templates and frontend component structure: this repository.
- Published content, WordPress objects, ACF and SEO data: the connected WordPress installation through `scripts/wp`.
- Project constraints and architecture: files in `docs/`.

If assumptions in the repository conflict with current WordPress data or Figma, record the mismatch before making changes.

## Development rules

- Build a custom theme; do not introduce a page builder.
- Reuse existing components before creating new ones.
- Keep page-specific duplicated markup to a minimum.
- Keep content editable through WordPress/ACF when specified by the content model.
- Do not modify WordPress Core or third-party plugins unless explicitly requested.
- Do not add WooCommerce unless the task explicitly requires ecommerce functionality.

## WordPress changes

- Read the current object before updating it.
- Perform content changes through `scripts/wp` where supported.
- Verify the result after a write by reading it again.
- For frontend changes, perform responsive/visual QA after implementation.

## Security

- Never commit usernames, WordPress Application Passwords, API keys, access tokens or other secrets.
- WordPress connection values must come from environment variables: `WORDPRESS_URL`, `WORDPRESS_USERNAME`, `WORDPRESS_APP_PASSWORD`.
- Local `.env` files must remain outside Git.
