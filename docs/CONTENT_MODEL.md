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
type for Bridge-assisted migrations. It has no public rewrite rules or separate
admin menu; canonical case studies must be created as `project` records so their
single URLs resolve under `/projects/{slug}/` without a rewrite collision.

Suggested fields:

- project title
- short summary
- client / industry
- hero image
- live project URL
- challenge
- solution
- implementation details
- technologies
- measurable outcomes
- repeatable responsive showcase blocks (desktop image, mobile image and rich text)
- related services
- CTA

Archive slug: `/projects/`

## Blog

Use standard WordPress posts.

Primary role:

- informational SEO
- expertise demonstration
- internal linking support for commercial pages

## Services

CPT: `service`

Services use a controlled landing-page structure rather than a generic flexible
page builder. The native title, excerpt, featured image and editor remain
available, while the service field group supplies these purpose-specific blocks:

- hero: eyebrow, lead, supporting copy and primary CTA
- overview: client challenge and the studio's approach
- scope: repeatable deliverables and business benefits
- process: repeatable service-specific delivery steps
- proof: selected related projects
- FAQ: repeatable questions and answers
- final CTA
- archive-card kicker and summary

Archive slug: `/services/`

Individual service URLs use `/services/{service-slug}/`. Rank Math remains the
source of editable SEO metadata rather than duplicating SEO fields in ACF.

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
