# Local SEO Audit — QLONY POS Web Repository

Audit date: 2026-09-26  
Scope: local repository, local HTTP server, and tracked content only. No production website, DNS, TLS, CDN, search engine, or webmaster tools were accessed.

## 1. Architecture Summary

This checkout is a small static HTML content subtree, not a Next.js application. It contains two standalone HTML documents and a hand-authored XML sitemap under `pos/`. There is no `package.json`, Next.js configuration, TypeScript source, application build command, middleware, route handler, server component, client component, CMS, or hosting/deployment configuration in the tracked repository. The HTML includes inline CSS; the account-deletion page includes inline client JavaScript. Both pages are ordinary server-delivered HTML when served locally. No build was run because no build system exists in this repository.

This inventory covers only the two POS pages represented by this repository. It cannot establish the public routes or architecture of the broader QLONY website.

## 2. Public Route Inventory

| Route | Rendering | Indexable | Metadata | Canonical | Notes |
|---|---|---|---|---|---|
| `/pos/privacy` | Static HTML | Yes; no `noindex` or robots restriction in source | Unique title, description, OG and Twitter title/description | `https://qlony.com/pos/privacy` | One H1, semantic article/main, links to account-deletion page |
| `/pos/delete-account` | Static HTML with progressive content plus inline form JavaScript | Yes; no `noindex` or robots restriction in source | Unique title, description, OG and Twitter title/description | `https://qlony.com/pos/delete-account` | One H1, semantic main, privacy cross-link; request backend endpoint is empty |
| `/pos/sitemap.xml` | Static XML file | N/A | N/A | Contains the two canonical URLs above | Locally returned 200 and parsed as XML by the local static server |

No dynamic, catch-all, authenticated, API, or application-generated routes are present in this checkout. The `/` links point outside this repository’s route inventory.

## 3. Source Code SEO Score — Before

Score is based on the repository contents at the start of this audit. The same score applies after because no source changes were justified without deployment/business inputs.

| Area | Score | Max | Explanation |
|---|---:|---:|---|
| Technical SEO | 11 | 15 | Absolute HTTPS canonicals and a sitemap are present; no robots implementation or deployment routing configuration is included. |
| Metadata | 13 | 15 | Both pages have distinct titles, descriptions, canonicals, OG and Twitter metadata. No social preview image is specified. |
| Crawlability | 10 | 15 | Static public HTML and two sitemap entries; robots.txt, response rules, and full-site route coverage are outside this checkout. |
| Rendering / JS SEO | 10 | 10 | Main content and metadata are in initial HTML; no content depends on client rendering. |
| Structured Data | 5 | 10 | No JSON-LD or microdata. There is no clearly necessary schema for these policy/request pages, so this category is not required and is excluded from the normalized score. |
| CWV Readiness | 7 | 10 | Lightweight inline CSS/HTML and no image payloads; no measured performance data or real-user data. |
| HTML Structure | 5 | 5 | Language, viewport, main content, headings, article, and labels are present. |
| Internal Linking / URL Architecture | 4 | 5 | The two pages cross-link; links to the root page depend on the containing site. |
| Images | 5 | 5 | No images are required by the page content; no image optimization issue identified. |
| Mobile / Accessibility | 4 | 5 | Responsive viewport, scalable headings, labels, and live status region; focus styling and checkbox labeling could be improved. |
| Maintainability | 3 | 5 | Simple static files are easy to serve, but shared metadata/styles and automated validation are absent. |

**TOTAL: 72/90 applicable points = 80/100 normalized.** Structured data is excluded as not required for these pages.

## 4. Local Runtime SEO Verification

Production URL: NOT VERIFIED — production access was intentionally excluded.  
Canonical origin in source: `https://qlony.com` (authored canonicals and sitemap locations). This is a repository value, not proof of the live canonical origin.  
robots.txt: NOT VERIFIED — no robots file is tracked in this repository.  
sitemap.xml: PASS locally at `/pos/sitemap.xml`; includes both POS pages and no query URLs.  
HTTPS: NOT VERIFIED — local HTTP only.  
www/non-www behavior: NOT VERIFIED — requires production/deployment verification.  
404 behavior: local Python static server returned 404 for `/missing`; this does not prove hosting behavior.  
Local route HTML: PASS for both pages; page metadata and content were present in the locally served response.  
Build: NOT APPLICABLE — this repository has no application build configuration or build script.  
Measured lab/field Core Web Vitals: NOT VERIFIED — no Lighthouse, CrUX, or real-user measurements were taken.

**LOCAL RUNTIME SEO VERIFICATION: PARTIAL** — representative local HTML, metadata, sitemap, and a missing path were checked using Python's local static server. This does not reproduce an identified deployment host. Extensionless directory paths were served at trailing-slash URLs by Python's server, but deployment canonical/redirect behavior remains unknown.

## 5. Critical Issues

None identified in the local source that demonstrably blocks indexing of these two pages.

## 6. High Priority Issues

Severity: HIGH (functional readiness; deployment-dependent)  
Affected route/files: `/pos/delete-account`, `pos/delete-account/index.html`  
Problem: `DELETE_REQUEST_ENDPOINT` is an empty string, so the form always displays a message that submission is not configured.  
Why it matters: The page describes starting an account-deletion request, but the primary action cannot submit a request in the current source. This is not an indexing defect.  
Recommended fix: Supply and verify the approved HTTPS endpoint and its request/response contract, or clearly direct users to a verified support contact.  
Implemented: No — endpoint/contact details require owner input.

Severity: HIGH (coverage limitation)  
Affected route/files: Entire repository  
Problem: This checkout contains only two POS support/legal pages and does not include the main website source, robots rules, routing, or hosting config.  
Why it matters: An audit of this repository cannot establish the SEO state or complete route inventory of the whole QLONY website.  
Recommended fix: Audit the actual main website source repository and its hosting configuration separately.  
Implemented: No — outside this repository.

## 7. Medium Priority Issues

Severity: MEDIUM (URL normalization, deployment behavior unknown)  
Affected route/files: Both HTML canonicals and `pos/sitemap.xml`  
Problem: Canonicals and sitemap entries use extensionless URLs without trailing slashes. Python's local static server redirected directory-style extensionless paths to their trailing-slash form. This is not evidence of the deployed host's behavior.  
Why it matters: If the actual deployment also redirects to slash URLs, canonical and sitemap URLs may point at redirecting variants.  
Recommended fix: Confirm the host's path normalization locally in its deployment configuration or after deployment; then make canonical/sitemap URL formatting consistent with the final 200 URL.  
Implemented: No — host configuration is absent and production verification is excluded.

Severity: MEDIUM (accessibility polish)  
Affected route/files: `pos/delete-account/index.html`  
Problem: The email input's custom focus state only changes border color, and the checkbox is nested in a label without a matching explicit `for`/`id` association on the label.  
Why it matters: A more visible keyboard focus indicator and explicit control association improve usability/accessibility.  
Recommended fix: Add a `:focus-visible` indicator and explicit checkbox label association during a scoped accessibility change.  
Implemented: No — no product source changes were made in this audit.

## 8. Low / Optional Issues

- Neither page defines `og:image`; sharing may use a generic preview. Add an official approved social image only if one exists.
- The pages do not define explicit `robots` metadata. With no blocking rule, ordinary indexing is allowed by default; no extra robots tag is required.
- No JSON-LD is present. No schema was added because these policy and account-request pages have no clearly applicable rich-result schema.
- A local Python `http.server` is only a static inspection harness. It is not a substitute for the intended deployment platform.

## 9. Things Already Done Well

- Both pages send substantive text, headings, and metadata in the initial HTML rather than waiting for JavaScript.
- Titles, descriptions, canonicals, Open Graph values, and Twitter title/description are page-specific.
- Canonicals and sitemap locations consistently use an HTTPS `qlony.com` origin in source.
- Sitemap contains only the two represented content pages and does not fabricate modification dates.
- Main content uses a single H1 per page, meaningful section headings, and semantic `main`/`article` elements.
- The deletion form has associated visible labels for its main fields, and its status region uses `aria-live`.

## 10. Changes Implemented

No website source files were changed. No safe SEO fix could be justified that did not depend on unprovided deployment routing or business-approved deletion endpoint/contact details. Local checks were read-only.

## 11. Source Code SEO Score — After

| Area | Before | After | Change |
|---|---:|---:|---:|
| Technical SEO | 11/15 | 11/15 | 0 |
| Metadata | 13/15 | 13/15 | 0 |
| Crawlability | 10/15 | 10/15 | 0 |
| Rendering / JS SEO | 10/10 | 10/10 | 0 |
| Structured Data | N/A | N/A | Excluded; not required for these pages |
| CWV Readiness | 7/10 | 7/10 | 0 |
| HTML Structure | 5/5 | 5/5 | 0 |
| Internal Linking / URL Architecture | 4/5 | 4/5 | 0 |
| Images | 5/5 | 5/5 | 0 |
| Mobile / Accessibility | 4/5 | 4/5 | 0 |
| Maintainability | 3/5 | 3/5 | 0 |

**Before: 80/100 normalized. After: 80/100 normalized. Improvement: 0.**

## 12. Production State After Changes

- Audit report committed: pending.
- Changes pushed: pending.
- Website source changes: none.
- Production deployed: NOT VERIFIED — no deployment was performed or checked.
- Live site verified: NOT VERIFIED — production access was explicitly excluded.

## 13. Remaining Business / Manual Input

- Approved deletion-request backend endpoint and expected success/error contract, or an official support contact.
- Confirmation that the deletion and privacy wording matches actual data retention and processing practices.
- Official social-sharing image, if one has been approved.

## 14. External Configuration Required

- Deployment platform's path normalization and canonical-host redirects must be checked after deployment.
- Production robots.txt, sitemap response, HTTPS, and host behavior require deployment verification.
- Search Console/Bing sitemap submission and indexing status are outside this local audit and were not checked.
- No DNS, TLS, CDN, analytics, or hosting changes were made or evaluated.

## 15. Post-Deployment Verification Checklist

- ✅ Local HTML contains page-specific titles, descriptions, canonicals, OG/Twitter metadata, H1s, and substantive main content.
- ✅ Local sitemap returns 200 and lists the two represented POS pages.
- ✅ Local missing-path response was 404 using the static inspection server.
- ⚠️ Confirm and configure the account-deletion submission endpoint or verified contact channel.
- ⚠️ Confirm canonical URL slash policy against deployed routing.
- 🔍 Verify deployed canonical, robots.txt, sitemap.xml, metadata, and JSON-LD behavior.
- 🔍 Verify deployed redirects, 404 status, HTTPS, and canonical hostname.
- 🔍 Measure lab Core Web Vitals and review field data when available; this audit makes no performance-score claim.
- 🔍 Check search indexing only through a verified search-engine source; local HTML does not prove indexing.

All items marked for deployment remain: **NOT VERIFIED — requires production/deployment verification**.
