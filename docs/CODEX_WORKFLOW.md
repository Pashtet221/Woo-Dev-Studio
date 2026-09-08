# Codex Workflow

## General rule

Before changing code, read:

1. `docs/PROJECT_PROFILE.md`
2. `docs/SEO_STRUCTURE.md`
3. `docs/CONTENT_MODEL.md`
4. `docs/DESIGN_SYSTEM.md` when visual work is involved

## Implementation workflow

For every implementation task:

1. Inspect existing repository structure.
2. Reuse existing components before creating new ones.
3. When a Figma design is supplied, treat Figma as the visual source of truth.
4. Keep WordPress templates thin and component-oriented.
5. Make editable content configurable through native WordPress / ACF only where it improves content management.
6. Avoid adding plugins without a clear requirement.
7. Validate PHP syntax and front-end behavior.
8. Run relevant automated checks.
9. Check responsive behavior at desktop, tablet and mobile widths.
10. Check browser console for new errors.
11. Commit only related changes.
12. In the PR description, state what changed and what was tested.

## WordPress Bridge

The bridge is an infrastructure layer, not part of the public theme UI.

Expected responsibilities may include:

- health checks
- authenticated access for Codex automation
- reading supported content types
- creating/updating approved WordPress content
- ACF-related operations where supported
- SEO metadata operations where supported

Never expose credentials in the repository.

Environment-specific values must come from environment variables or local configuration excluded by `.gitignore`.

## Figma workflow

Do not implement an entire page as a single monolithic template when its sections can become reusable components.

Preferred flow:

Figma design system -> reusable UI components -> page composition -> WordPress fields -> QA.

## Definition of done

A feature is not complete until:

- implementation matches approved design requirements
- no obvious responsive overflow exists
- no new console errors are introduced
- relevant links and interactions work
- editable content behaves correctly
- code is committed with a focused message
