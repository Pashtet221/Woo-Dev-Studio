# Content Model

## Pages

Use standard WordPress pages for commercial and corporate landing pages.

Core page content should use a controlled section model rather than a generic page builder.

Recommended approach:

- fixed template structure for key commercial pages where consistency matters
- reusable section components
- ACF fields for editable content
- Flexible Content only where genuine editorial flexibility is needed

## Projects / Case Studies

CPT: `project`

The connected WordPress installation also exposes the legacy `wpds-case` post
type. The theme maps its single entries to the same project composition so
existing projects remain compatible while content is migrated to `project`.

Suggested fields:

- project title
- short summary
- client / industry
- hero image
- challenge
- solution
- implementation details
- technologies
- measurable outcomes
- gallery
- related services
- CTA

Archive slug: `/projects/`

## Blog

Use standard WordPress posts.

Primary role:

- informational SEO
- expertise demonstration
- internal linking support for commercial pages

## Reusable sections

Initial section library may include:

- hero
- intro / rich text
- services grid
- feature grid
- project / case study cards
- stats
- process
- testimonials
- FAQ
- logo cloud
- CTA
- related services
- related case studies
- related articles

## Admin UX principle

Do not recreate Elementor inside ACF.

The admin interface should expose only meaningful content controls. Layout, spacing, typography and responsive behavior should remain controlled by the theme and design system.
