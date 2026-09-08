# Design System

Status: placeholder until the initial Figma system is approved.

## Figma is the visual source of truth

The implementation should derive visual tokens and component behavior from the approved Figma file.

## Define before page production

- color tokens
- typography scale
- spacing scale
- container widths
- grid behavior
- breakpoints
- border radii
- shadows
- buttons
- form controls
- cards
- navigation
- responsive rules

## Implementation principle

Map Figma decisions to reusable CSS variables / tokens rather than hard-coding unrelated values throughout templates.

Example target structure:

```css
:root {
  --container: ...;
  --space-1: ...;
  --space-2: ...;
  --radius-sm: ...;
  --radius-md: ...;
  --font-size-body: ...;
  --font-size-h1: ...;
}
```

Exact values must come from the approved design.
