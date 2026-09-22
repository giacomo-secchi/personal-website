# Résumé — WordPress block theme

Source code for my online CV/résumé, [cv.giacomosecchi.com](https://cv.giacomosecchi.com).
It is a full-site-editing (block) theme: content is modelled with Advanced Custom
Fields, rendered by a handful of custom dynamic blocks, and marked up with
schema.org structured data.

The theme lives in the [`giacomo-secchi/personal-website`](https://github.com/giacomo-secchi/personal-website)
monorepo under `themes/resume`, alongside `themes/personal-theme` and `mu-plugins/`.
It is built and deployed by the monorepo's CI — see [Deployment](#deployment).

## Features

- Full-site-editing theme (`theme.json` v3, block templates and template parts)
- One-page résumé assembled from ACF custom post types plus a profile options page
- **CV / Resume toggle** built on the WordPress Interactivity API — each entry
  declares which views it belongs to; the active view is driven by the `?view=`
  query parameter (`?view=resume` for the condensed view, no parameter for the
  default `cv` view) and kept in sync with `history.pushState()` — no reload,
  back / forward aware, canonical URL stays parameter-free
- "Download printable version" button, rendered as a real PDF via DocRaptor
  (`?format=pdf`, cached per view/language) — see `inc/pdf.php`
- Dark-mode support via the Tabor *Dark Mode Toggle* block and `build/css/dark-mode.css`
- Bootstrap Icons available to the core Icon block, and an optional section icon per résumé section
- Self-hosted fonts (Open Sans, Noto Serif) declared as `@font-face` in `theme.json`
- Structured data: JSON-LD `Person` graph (extends Yoast SEO) + semantic HTML markup
- Optional multilingual UI via a custom inline TranslatePress language switcher

## Requirements

| | |
|---|---|
| WordPress | 7.0+ (the Bootstrap Icons integration needs 7.1+ / the Icons API) |
| PHP | 7.4+ |
| Node.js | 22 (build tooling only) |
| Plugins | Advanced Custom Fields (content model). Yoast SEO, TranslatePress and the *Dark Mode Toggle* block are optional — each integration is feature-guarded in `functions.php`. |
| PDF export | Optional — needs a `DOCRAPTOR_API_KEY` and public reachability (DocRaptor fetches the page itself). |

## Getting started (local development)

The site is developed against [`wp-env`](https://developer.wordpress.org/block-editor/reference-guides/packages/packages-env/)
(see the monorepo's `.wp-env.json`), which mounts the theme straight from the repo —
no manual linking into `wp-content/` needed:

```sh
git clone https://github.com/giacomo-secchi/personal-website.git
cd personal-website
npx @wordpress/env start
```

Then work on the theme itself:

```sh
cd personal-website/themes/resume
npm ci
npm run start   # wp-scripts watch build → build/
```

Activate **Résumé** under *Appearance → Themes* and add some entries — the ACF
field groups load automatically, see [Content model](#content-model-acf).

## Build

```sh
npm run build   # production bundle in build/
```

`npm run build` / `npm run start` wrap `@wordpress/scripts`. `webpack.config.js`
adds a copy step: Bootstrap Icons SVGs from `node_modules/bootstrap-icons` go into
`build/bootstrap-icons/` (registered with the Icons API by `inc/icons.php`), and
`src/fonts` / `src/css` are copied as-is into `build/fonts` / `build/css`.

`build/` is git-ignored — see [Deployment](#deployment) for how it reaches production.

## Project structure

```
resume/
├── acf-json/             ACF local JSON, auto-loaded — see Content model
├── build/                compiled blocks, fonts/css, Bootstrap Icons (generated)
├── inc/                  PHP modules, required from functions.php
│   ├── config.php               résumé views + ACF shortcode settings
│   ├── icons.php                Bootstrap Icons collection + editor icon picker
│   ├── load-assets.php          favicon, block registration, dark-mode CSS, block styles
│   ├── language-switcher.php    inline TranslatePress language switcher shortcode
│   ├── schema-jsonld.php        extends Yoast's Person schema — see Structured data
│   └── pdf.php                  PDF export via DocRaptor — see Features
├── src/                  everything built to build/ — see Custom blocks
│   ├── resume-section/ · list-section/ · tab-switch/
│   ├── css/dark-mode.css
│   └── fonts/            self-hosted woff2 (Open Sans, Noto Serif)
├── patterns/hidden-home.php     the home layout, composed of the blocks above
├── templates/ · parts/          FSE template + footer / utilities parts
├── theme.json                   palette, fonts, layout, dark tokens
├── favicon.png · screenshot.png
├── style.css · readme.txt       theme header / WordPress.org-style readme (license)
└── functions.php
```

## Custom blocks

All three are server-rendered (`render.php`), block API v3, and namespaced `resume/`.

| Block | Purpose |
|---|---|
| `resume/resume-section` | Renders one résumé section (`<dl>` → entries) from a post type. Entries are ordered by menu order, then by their real-world date. Each entry declares its Resume/CV visibility and hides itself via an Interactivity binding. |
| `resume/list-section` | Renders a repeater field from the *Resume Settings* options page, turning email / phone / URL rows into the right link. |
| `resume/tab-switch` | The CV / Resume tablist. Writes the active view into the `resume/tabs` Interactivity store (and the `?view=` URL parameter); `resume/resume-section` entries read it. |

Views are defined once in `inc/config.php` and consumed by both `tab-switch`
and the per-entry "Resume Visibility" field. **Order matters** — the first view is
the default one, shown when the URL carries no `?view=` parameter. Add one from anywhere:

```php
add_filter( 'resume_views', fn( $v ) => $v + array( 'portfolio' => __( 'Portfolio', 'resume' ) ) );
```

## Content model (ACF)

Field groups and post types are stored as local JSON in `acf-json/` and load
automatically. Post types: **Professional Experiences** (`experience`),
**Internships** (`internship`), **Education** (`education`), **Personal Projects**
(`project`), **Event Presentations** (`event_presentation`), **Publications**
(`publication`). A **Resume Settings / Profile Informations** options page holds
the profile description, contact details and the skills / soft-skills / languages
repeaters.

## Structured data

Two complementary layers:

- **JSON-LD** — `inc/schema-jsonld.php` hooks Yoast SEO's schema graph and extends
  its `Person` node with data Yoast doesn't collect: `jobTitle`, `telephone`,
  `email`, `address`, `hasOccupation` (from experience / internships), `alumniOf`
  (education), `performerIn` (talks), `skills` / `knowsLanguage` (the repeaters),
  and a GitHub `sameAs`. Publications are added as standalone `Article` nodes
  linked back to the person via `author`.
- **Semantic HTML** — each résumé section renders as a definition list
  (`<dl><dt>section</dt><dd>entries…</dd></dl>`), one block per entry with a
  consistent title / organisation / dates / address / link structure, adapted
  from the HTML5 microdata résumé pattern (see [References](#references)).

## Customization

- **Colours, fonts, spacing, layout** — `theme.json` (`settings.color.palette`,
  `settings.typography.fontFamilies`, `settings.layout`). Dark-mode overrides live
  in `settings.custom.color.*-dark` and are mapped in `build/css/dark-mode.css`.
- **Per-block styles** — `src/<block>/style.scss` (front end) and
  `src/<block>/editor.scss` (editor). Rebuild after editing.
- **Home layout** — `patterns/hidden-home.php` decides which sections appear and
  in which column, and picks each section's Bootstrap icon.
- **Fonts** — drop a `.woff2` in `src/fonts/` and add a `fontFace` entry in `theme.json`.

## Deployment

Pushing to `main` on the monorepo triggers
[`.github/workflows/main.yml`](https://github.com/giacomo-secchi/personal-website/blob/main/.github/workflows/main.yml):

1. **build** — Node 22, `npm ci && npm run build` for `themes/personal-theme` and
   `themes/resume`, then uploads a `deploy-payload` artifact (themes + `mu-plugins`,
   minus `node_modules/`, `src/`, source maps and VCS files).
2. **deploy** — `WritePoetry/reusable-workflows/.github/workflows/deploy.yml@v3`
   ships the artifact to Cloudways over SFTP.

## Built with

- [WordPress block themes / FSE](https://developer.wordpress.org/block-editor/how-to-guides/themes/)
- [`@wordpress/scripts`](https://developer.wordpress.org/block-editor/reference-guides/packages/packages-scripts/) + webpack
- [WordPress Interactivity API](https://developer.wordpress.org/block-editor/reference-guides/packages/packages-interactivity/)
- [Advanced Custom Fields](https://www.advancedcustomfields.com/)
- [Bootstrap Icons](https://icons.getbootstrap.com/) (MIT)
- [Yoast SEO](https://yoast.com/wordpress/plugins/seo/) schema API, [TranslatePress](https://translatepress.com/)

## References

I took inspiration for the microdata structure from this guide:
<https://webdesign.tutsplus.com/how-to-create-an-html5-microdata-powered-resume--net-22046t>

## Author

Giacomo Secchi — [GitHub](https://github.com/giacomo-secchi)

## License

GNU General Public License v2 or later — see `readme.txt`.
