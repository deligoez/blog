---
date: 2026-01-01T01:34:04+03:00
session_name: general
researcher: claude
git_commit: ac2d034
branch: master
repository: blog
topic: "Flaky Test Chronicles Part IV Review and Code Validation"
tags: [blog, article, flaky-tests, laravel, testing, code-review]
status: in_progress
last_updated: 2026-01-01
last_updated_by: claude
type: implementation_strategy
root_span_id: ""
turn_span_id: ""
---

# Handoff: Flaky Test Chronicles Part IV - Article Review & Code Validation

## Task(s)

### Completed
1. **Title/Subtitle Update** - Changed "The Cleanup" → "The Teardown Tango" (alliteration, matches Part II style)
2. **Intro Paragraph** - Added Part III reference and section overview
3. **Common Pitfalls** - Renamed to "Quick Reference", added links to Part II & III
4. **What's Next** - Changed to "See you there." for consistency with other parts
5. **Production-specific Names** - Replaced all domain-specific code with generic examples:
   - `RetailerFastPayableOrder` → `CachedProduct`
   - `FarmerEligibility` → `OrderValidator`
   - `PreventionException` → `ValidationException`
   - `accounting.farmers.index` → `api.users.index`
   - Full list in Learnings section
6. **Centralize vs Trait Section** - Completely rewritten to recommend opt-in traits, not centralization

### Critical - Not Yet Fixed
7. **Observable Events Code Invalid** - `ignoreObservableEvents()` is NOT a Laravel native method! See Learnings.

## Critical References
- Article file: `content/collections/articles/en/2025-12-18.the-flaky-test-chronicles-iv-the-cleanup.md`
- Real backend trait for reference: `/Users/deligoez/Developer/github/tarfin-labs/backend/tests/Traits/RefreshesSushiModels.php`

## Recent changes
- `content/collections/articles/en/2025-12-18.the-flaky-test-chronicles-iv-the-cleanup.md` - Multiple edits throughout

## Learnings

### Critical Bug: `ignoreObservableEvents()` Does Not Exist in Laravel

The Observable Events section uses:
```php
User::ignoreObservableEvents(['saved', 'created', 'updated']);
User::unignoreObservableEvents(['created']);
```

**This is NOT Laravel native!** It's from the third-party package [zachflower/ignorable-observers](https://github.com/zachflower/ignorable-observers).

Laravel native alternatives:
- `Model::withoutEvents(fn() => ...)` - closure-based, different pattern
- `saveQuietly()`, `updateQuietly()`, `deleteQuietly()` - single operations
- Unset event dispatcher: `Model::unsetEventDispatcher()`

**Options to fix:**
1. Add package dependency note and keep current code
2. Rewrite to use `withoutEvents()` closure pattern
3. Remove the Observable Events section entirely

### Production Names Replaced

| Old (Production) | New (Generic) |
|------------------|---------------|
| `RetailerFastPayableOrder` | `CachedProduct` |
| `mobile_delivery_confirmation` | `feature.notifications_enabled` |
| `Application`, `Farmer` | `User`, `Payment` |
| `accounting.farmers.index` | `api.users.index` |
| `['accounting']` | `['api-access']` |
| `$application->is_assignable` | `$user->is_active` |
| `FarmerEligibility::check($dto)` | `OrderValidator::validate($order)` |
| `PreventionException` | `ValidationException` |
| `RomaniaEnvironmentTrait` | `LocaleTestTrait` |

### Opt-in Trait Pattern is Correct

Backend uses `RefreshesSushiModels` trait in only 2 test files out of thousands. The makaledeki "centralize in TestCase" advice was WRONG. Updated to show:
- Universal cleanup (base TestCase): config/locale resets, framework cleanup
- Targeted cleanup (opt-in traits): Sushi refresh, file cleanup, external services

## Post-Mortem

### What Worked
- Checking real backend code (`TarfinSmsTest.php`) revealed the trait pattern was correct
- Grep for trait usage showed only 2 files use it - proving centralization would be wasteful
- Web search quickly identified `ignoreObservableEvents` as third-party

### What Failed
- Tried: Initial article had "centralize everything" advice → Wrong for Sushi case
- The Observable Events code example was never validated against Laravel docs

### Key Decisions
- Decision: Recommend opt-in traits over centralization for targeted cleanup
  - Alternatives: Keep centralization advice, make it conditional
  - Reason: Real-world usage shows only 2/thousands tests need Sushi refresh

- Decision: Keep Observable Events section but mark as needing fix
  - Alternatives: Remove section, silently fix
  - Reason: User should decide approach (package vs native vs remove)

## Artifacts
- `content/collections/articles/en/2025-12-18.the-flaky-test-chronicles-iv-the-cleanup.md` - Main article (needs Observable Events fix)

## Action Items & Next Steps

### Must Do
1. **Fix Observable Events section** - Choose one:
   - Option A: Add note that `ignorable-observers` package is required
   - Option B: Rewrite using `Model::withoutEvents(fn() => ...)`
   - Option C: Remove section entirely

2. **Validate remaining code examples** - Check these against Laravel docs:
   - `Http::fake()` ordering
   - `Event::fakeFor()`
   - `Bus::fake([SpecificJob::class])`
   - `Passport::actingAsClient()` ✅ (already validated)

### Should Do
3. **Add `display_date` field** - Part II has it, Part IV doesn't
4. **Update `og_generator_image`** - Still says `the-cleanup.jpg`, should be `the-teardown-tango.jpg`

### Consider
5. **Cross-check Part I, II, III** - May have similar code validation issues

## Other Notes

### File Locations
- Part I: `content/collections/articles/en/2025-12-18.the-flaky-test-chronicles-i-the-reckoning.md`
- Part II: `content/collections/articles/en/2025-12-18.the-flaky-test-chronicles-ii-mock-madness.md`
- Part III: `content/collections/articles/en/2025-12-26.the-flaky-test-chronicles-iii-the-determinism-principle.md`
- Part IV: `content/collections/articles/en/2025-12-18.the-flaky-test-chronicles-iv-the-cleanup.md`

### Laravel Docs References
- [Laravel Events withoutEvents](https://laravel.com/docs/12.x/events)
- [Laravel Passport actingAsClient](https://laravel.com/docs/12.x/passport)
- [ignorable-observers package](https://github.com/zachflower/ignorable-observers)
