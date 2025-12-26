# Blog Project - Claude Code Reference

## Language Preferences

- **Code, commits, comments**: Always use English
- **User communication**: User writes in Turkish, respond in Turkish
- **Documentation**: English

## Project Overview

A personal blog built with **Statamic 5.70** (flat-file CMS). Content is stored as YAML/Markdown files (no database). Article content is written using the **Bard editor** with a specific JSON/YAML structure.

**Tech Stack:**
- CMS: Statamic 5.70 (flat-file)
- Framework: Laravel 12.0
- Frontend: Tailwind CSS 4.0, Alpine.js 3.10
- Build: Vite 6.0
- Syntax Highlighting: Shiki 3.20 (server-side, cached)
- Node: 20.18.0

## Development Workflow

**Important:** `npm run dev` is typically running in the background during development. CSS/JS changes are automatically rebuilt and hot-reloaded. You don't need to run `npm run production` after every change - only run it before deployment or when specifically needed.

## Common Commands

```bash
# Development
npm run dev              # Vite dev server (usually already running)
php artisan serve        # Laravel server

# Build
npm run build            # Production build (only before deploy)
npm run production       # Alias

# Statamic
php artisan statamic:stache:refresh    # Refresh content cache
php artisan statamic:ssg:generate      # Generate static site (for Netlify)

# Cache Clearing
php artisan cache:clear
php artisan config:clear
php artisan view:clear

# Composer
composer update          # Update dependencies
composer show            # List packages
```

## Article File Structure

### Location
```
content/collections/articles/
├── en/                  # English articles
│   └── YYYY-MM-DD.article-slug.md
└── tr/                  # Turkish articles
    └── YYYY-MM-DD.article-slug.md
```

### Frontmatter Template
```yaml
---
id: <uuid>                     # Unique ID (auto-generated)
published: true/false          # Publication status
blueprint: articles            # Always "articles"
title: 'Article Title'
subtitle: 'Subtitle'
show_toc: true                 # Show table of contents
toc_levels:                    # Which heading levels in TOC
  - 1
  - 2
updated_by: <user-uuid>
updated_at: <timestamp>
og_generator_image: file.jpg   # For OG image generation
content:                       # Bard content (see below)
  - type: heading
    ...
---
```

## Bard Editor Syntax (CRITICAL)

When editing articles, it's crucial to maintain the **Bard syntax**. Content is stored as an array of blocks.

### Native Block Types

#### Paragraph
```yaml
- type: paragraph
  attrs:
    textAlign: left          # left, center, right, justify
  content:
    - type: text
      text: 'Plain text'
    - type: text
      marks:
        - type: bold         # or: italic, code, underline, strikethrough
      text: 'Bold text'
    - type: text
      marks:
        - type: link
          attrs:
            href: 'https://example.com'
            target: _blank
      text: 'Link text'
```

#### Heading
```yaml
- type: heading
  attrs:
    textAlign: left
    level: 1                 # 1-6
  content:
    - type: text
      text: 'Heading Text'
```

#### Bullet List
```yaml
- type: bulletList
  content:
    - type: listItem
      content:
        - type: paragraph
          content:
            - type: text
              text: 'List item'
```

#### Ordered List
```yaml
- type: orderedList
  attrs:
    start: 1
  content:
    - type: listItem
      content:
        - type: paragraph
          content:
            - type: text
              text: 'First item'
```

#### Blockquote
```yaml
- type: blockquote
  content:
    - type: paragraph
      content:
        - type: text
          text: 'Quote text'
```

#### Code Block
```yaml
- type: codeBlock
  attrs:
    language: php            # Specify language
  content:
    - type: text
      text: |
        <?php
        echo "Hello";
```

**Line Highlighting Syntax:**
```
```php{1,2-5}{8}
// Lines 1 and 2-5 are highlighted
// Line 8 gets focus highlighting
```

#### Horizontal Rule
```yaml
- type: horizontalRule
```

### Custom Set Types (Custom Components)

Custom sets start with `type: set` and the component type is in `values.type`.

#### Image
```yaml
- type: set
  attrs:
    id: <unique-id>
    values:
      type: image
      image: articles/folder/image.jpg
```

#### Sidenote (Tufte-style Margin Note)
```yaml
- type: set
  attrs:
    id: <unique-id>
    values:
      type: sidenote
      style: note            # note, info, tip, warning, danger
      position: right        # left, right
      content:
        - type: paragraph
          content:
            - type: text
              text: 'Sidenote content'
```

#### Thought (Thought Bubble)
```yaml
- type: set
  attrs:
    id: <unique-id>
    values:
      type: thought
      position: left         # left, center-left, center-right, right
      content:
        - type: paragraph
          content:
            - type: text
              text: 'Inner thought'
```

#### Heading (Numbered Section Heading)
```yaml
- type: set
  attrs:
    id: <unique-id>
    values:
      type: heading
      number: 1
      heading: 'Section Title'
```

#### ToC Auto (Automatic Table of Contents)
```yaml
- type: set
  attrs:
    id: <unique-id>
    values:
      type: toc-auto
      levels:
        - '1'
        - '2'
```

## Key File Locations

```
app/
├── Tiptap/Nodes/CodeBlockShiki.php   # Syntax highlighting (Shiki)
├── Tags/TocAuto.php                   # Auto TOC tag
├── Markdown/HighlightExtension.php    # Markdown highlight

resources/
├── blueprints/collections/articles/articles.yaml  # Article schema
├── views/
│   ├── articles/show.antlers.html    # Article template
│   └── partials/bard/                # Bard component templates
│       ├── image.antlers.html
│       ├── sidenote.antlers.html
│       ├── thought.antlers.html
│       ├── heading.antlers.html
│       ├── toc-auto.antlers.html
│       └── code.antlers.html
├── css/
│   ├── site.css                      # Main styles
│   └── syntax-highlight.css          # Syntax highlighting styles

content/collections/articles/         # Article content
storage/shiki-cache/                  # Shiki cache (git-tracked)
```

## Code Style & Conventions

- **PHP**: PSR-12, Laravel standards
- **CSS**: Tailwind utility-first
- **JavaScript**: Alpine.js components
- **Templates**: Antlers syntax (Statamic-specific)

## Important Notes

1. **Bard Syntax**: When editing articles, preserve the YAML structure. Each block must have correct `type`, `attrs`, and `content` structure.

2. **Unique IDs**: Custom set `attrs.id` values must be unique. Use random strings.

3. **Nested Content**: Content inside sidenote and thought is also in Bard format (paragraph, text, marks).

4. **Marks Array**: Styles like bold, italic, code, link are defined in the `marks` array.

5. **Nested Lists**: For lists inside lists, add a new bulletList/orderedList inside listItem.

6. **Shiki Cache**: Syntax highlighting is cached. Clear if needed:
   ```bash
   rm -rf storage/shiki-cache/*
   ```

7. **Multi-language**: English and Turkish article versions are in separate files.

## Creating a New Article

1. Filename: `YYYY-MM-DD.article-slug.md`
2. Place in correct language folder (`en/` or `tr/`)
3. Copy frontmatter from template
4. Generate unique UUID for `id` field
5. Write content in Bard format
6. Add OG image (`og_generator_image`)

## Deployment

Project deploys to Netlify. Build command:
```bash
npm run build && php artisan statamic:ssg:generate
```

## Antlers Template Syntax

Statamic's template language:
```antlers
{{ variable }}                    # Variable
{{ if condition }}...{{ /if }}    # Conditional
{{ items }}...{{ /items }}        # Loop
{{ partial:path/to/partial }}     # Partial include
{{ content | markdown }}          # Modifier
```
