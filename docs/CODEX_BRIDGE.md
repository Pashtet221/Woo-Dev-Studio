# Codex ↔ WordPress Bridge

This project uses `scripts/wp` as the client for the WordPress Codex Bridge REST API.

## Required environment variables

```text
WORDPRESS_URL=https://your-wordpress-site.example
WORDPRESS_USERNAME=codex-agent
WORDPRESS_APP_PASSWORD=your-wordpress-application-password
```

Never commit a real Application Password.

For local work, copy `config/.env.example` to `config/.env` and fill it locally. `config/.env` must stay ignored by Git.

For Codex Cloud, configure the same values as environment variables/secrets in the Codex environment.

## Required WordPress-side component

The target WordPress installation must have the main Codex Bridge plugin installed and exposing:

```text
/wp-json/codex-bridge/v1/health
```

The Bridge server plugin is not vendored into this repository. This repository contains the client and project-specific workflow only.

## First checks

```bash
bash scripts/wp health
bash scripts/wp pages
bash scripts/wp posts
```

When the `case_study` CPT is registered and exposed by the Bridge:

```bash
bash scripts/wp case-studies
```

## Write workflow

Before updating WordPress data:

1. Read the current object.
2. Prepare a JSON payload.
3. Perform the write through `scripts/wp`.
4. Read the object again and verify the result.

Do not use Bridge writes as a substitute for theme development. Theme PHP/CSS/JS belongs in Git; WordPress content and editable fields belong in WordPress.
