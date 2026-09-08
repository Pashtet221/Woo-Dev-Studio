# Woo Dev Studio

Custom WordPress and WooCommerce development studio website for the international / European market.

## Project status

Greenfield rebuild. The site is intentionally being developed from scratch instead of migrating legacy code or WooCommerce data from the previous website.

## Core stack

- WordPress
- Custom WordPress theme
- PHP
- JavaScript
- CSS / SCSS
- ACF Pro
- Rank Math
- Custom WordPress Bridge
- Playwright QA
- Figma as the design source of truth
- Codex for implementation and repository workflows

## Repository layout

This repository is the WordPress theme itself. Theme files live at the repository root, following the same model as the Reboot project. Infrastructure for Codex, Bridge, docs and QA lives alongside the theme code.

```text
Woo-Dev-Studio/
├── style.css
├── functions.php
├── index.php
├── assets/
├── inc/
├── template-parts/
├── docs/
├── config/
├── scripts/
├── tests/
└── README.md
```

Do not create an additional `wordpress/wp-content/themes/...` wrapper inside this repository.

See `AGENTS.md`, `docs/PROJECT_PROFILE.md` and `docs/CODEX_WORKFLOW.md` before making implementation changes.
