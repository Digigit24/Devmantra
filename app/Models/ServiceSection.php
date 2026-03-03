<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServiceSection extends Model
{
    protected $fillable = [
        'service_id',
        'section_type',
        'section_data',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'section_data' => 'array',
        'is_active'    => 'boolean',
        'sort_order'   => 'integer',
    ];

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    /**
     * All available section types with human-readable labels and a JSON schema hint.
     * Used by the admin panel dropdown + schema preview.
     */
    public static function sectionTypes(): array
    {
        return [
            'hero' => [
                'label'  => 'Hero — Page Banner',
                'icon'   => 'fa-solid fa-flag',
                'schema' => [
                    'label'       => 'Page label (e.g. GCC Services)',
                    'title'       => 'Main headline',
                    'subtitle'    => 'Sub-headline / descriptor',
                    'description' => 'Optional supporting line',
                    'cta_text'    => 'CTA button text',
                    'cta_url'     => 'CTA button URL (#contact for modal)',
                ],
            ],
            'overview' => [
                'label'  => 'Overview — Editorial Two-Column',
                'icon'   => 'fa-solid fa-columns',
                'schema' => [
                    'title'        => 'Section title',
                    'description'  => 'Primary body paragraph',
                    'description2' => 'Second body paragraph',
                    'cta_text'     => 'CTA text (optional)',
                    'cta_url'      => 'CTA URL (optional)',
                    'stats'        => '[{value, label}] — optional stat boxes',
                ],
            ],
            'services-grid' => [
                'label'  => 'Services Grid — Card Grid',
                'icon'   => 'fa-solid fa-grip',
                'schema' => [
                    'title' => 'Section title',
                    'items' => '[{title, description, icon?, points:[]}]',
                ],
            ],
            'process-steps' => [
                'label'  => 'Process Steps — Numbered Timeline',
                'icon'   => 'fa-solid fa-list-ol',
                'schema' => [
                    'title'       => 'Section title',
                    'description' => 'Intro paragraph',
                    'steps'       => '[{number, stage, description}]',
                    'metrics'     => '[{metric, outcome}] — optional table at end',
                ],
            ],
            'why-stand-out' => [
                'label'  => 'Why Stand Out — USP Card Grid',
                'icon'   => 'fa-solid fa-star',
                'schema' => [
                    'title' => 'Section title',
                    'items' => '[{title, description, icon?}]',
                ],
            ],
            'faq' => [
                'label'  => 'FAQ — Accordion',
                'icon'   => 'fa-solid fa-circle-question',
                'schema' => [
                    'title'    => 'Section title',
                    'subtitle' => 'Intro paragraph',
                    'items'    => '[{question, answer}]',
                ],
            ],
            'other-services' => [
                'label'  => 'Other Services — Link Strip',
                'icon'   => 'fa-solid fa-link',
                'schema' => [
                    'title' => 'Section title',
                    'items' => '[{label, url}]',
                ],
            ],
            'benefits-list' => [
                'label'  => 'Benefits List — Two-Column Checklist',
                'icon'   => 'fa-solid fa-check-double',
                'schema' => [
                    'title' => 'Section title',
                    'items' => '[string] — list of benefit statements',
                ],
            ],
            'markets-served' => [
                'label'  => 'Markets Served — Badge Grid',
                'icon'   => 'fa-solid fa-earth-asia',
                'schema' => [
                    'title'   => 'Section title',
                    'markets' => '[string] — e.g. USA, UK, Europe',
                ],
            ],
            'trust-signals' => [
                'label'  => 'Trust Signals — Icon Strip',
                'icon'   => 'fa-solid fa-shield-halved',
                'schema' => [
                    'title' => 'Section title',
                    'items' => '[{icon, label}]',
                ],
            ],
            'cpa-reality' => [
                'label'  => 'CPA Reality — Dark Problem Statement',
                'icon'   => 'fa-solid fa-triangle-exclamation',
                'schema' => [
                    'eyebrow'          => 'Small eyebrow label',
                    'title'            => 'Section headline',
                    'opening'          => 'Opening paragraph',
                    'pressure_points'  => '[string] — bullet list of pressures',
                    'description'      => 'Body copy after pressure points',
                    'old_model_title'  => 'Old model label',
                    'old_model_description' => 'Old model critique paragraph',
                    'shift_title'      => 'Shift label',
                    'shift_description'=> 'Shift explanation',
                ],
            ],
            'three-layer' => [
                'label'  => 'Three-Layer Structure — GCC Model',
                'icon'   => 'fa-solid fa-layer-group',
                'schema' => [
                    'title'        => 'Section title',
                    'description'  => 'Body paragraph 1',
                    'description2' => 'Body paragraph 2',
                    'description3' => 'Body paragraph 3',
                    'note'         => 'Bottom note',
                    'layers'       => '[{number, title, subtitle, points:[]}]',
                ],
            ],
            'comparison-table' => [
                'label'  => 'Comparison Table — Two-Column Split',
                'icon'   => 'fa-solid fa-table-columns',
                'schema' => [
                    'title'          => 'Section title',
                    'column1_title'  => 'Left column header',
                    'column2_title'  => 'Right column header',
                    'rows'           => '[[left_item, right_item], ...]',
                ],
            ],
            'engagement-models' => [
                'label'  => 'Engagement Models — Card Groups',
                'icon'   => 'fa-solid fa-handshake',
                'schema' => [
                    'title'           => 'Section title',
                    'standard_label'  => 'Standard tab label',
                    'cpa_label'       => 'CPA-specific tab label (optional)',
                    'standard_models' => '[{title, description, best_for}]',
                    'cpa_models'      => '[{title, description, best_for}] — optional',
                ],
            ],
            'pillars' => [
                'label'  => 'Key Pillars — Feature Pillar Cards',
                'icon'   => 'fa-solid fa-columns',
                'schema' => [
                    'title'   => 'Section title',
                    'pillars' => '[{title, points:[]}]',
                ],
            ],
            'governance' => [
                'label'  => 'Governance & Security — Two-Column Block',
                'icon'   => 'fa-solid fa-lock',
                'schema' => [
                    'title'      => 'Section title',
                    'columns'    => '[{title, items:[]}]',
                    'disclaimer' => 'Bottom disclaimer text',
                ],
            ],

            // ── Homepage section types ─────────────────────────────────────
            'page-hero' => [
                'label'  => 'Home Hero — Full-Width Banner',
                'icon'   => 'fa-solid fa-house',
                'schema' => [
                    'subtitle'    => 'Eyebrow label',
                    'title'       => 'Main headline',
                    'description' => 'Supporting paragraph',
                    'cta_text'    => 'CTA button text',
                    'cta_url'     => 'CTA button URL',
                ],
            ],
            'page-what-we-do' => [
                'label'  => 'Home What We Do — Services Overview',
                'icon'   => 'fa-solid fa-briefcase',
                'schema' => [
                    'title'    => 'Section title',
                    'subtitle' => 'Section sub-title / intro line',
                ],
            ],
            'page-clientele' => [
                'label'  => 'Home Clientele — Logo Strip + Features',
                'icon'   => 'fa-solid fa-users',
                'schema' => [
                    'clientele_title'      => 'Clientele strip heading',
                    'features_label'       => 'Features eyebrow',
                    'features_title'       => 'Features heading',
                    'features_description' => 'Features body paragraph',
                ],
            ],
            'page-strategy-6a' => [
                'label'  => 'Home 6A Strategy — Framework Section',
                'icon'   => 'fa-solid fa-hexagon-nodes',
                'schema' => [
                    'label'    => 'Eyebrow label',
                    'title'    => 'Section heading',
                    'subtitle' => 'Intro paragraph',
                ],
            ],
            'page-ai-platform' => [
                'label'  => 'Home AI Platform — Technology Block',
                'icon'   => 'fa-solid fa-microchip',
                'schema' => [
                    'subtitle' => 'Eyebrow label',
                    'title'    => 'Section heading',
                ],
            ],
            'page-world-map' => [
                'label'  => 'Home World Map — Global Reach',
                'icon'   => 'fa-solid fa-earth-asia',
                'schema' => [
                    'title'    => 'Section heading',
                    'subtitle' => 'Sub-heading / caption',
                ],
            ],
            'page-commitment-grid' => [
                'label'  => 'Home Commitment Grid — Values Block',
                'icon'   => 'fa-solid fa-hand-holding-heart',
                'schema' => [
                    'label'       => 'Eyebrow label',
                    'title'       => 'Section heading',
                    'description' => 'Body paragraph',
                ],
            ],
            'page-team' => [
                'label'  => 'Home Team — Team Members Grid',
                'icon'   => 'fa-solid fa-people-group',
                'schema' => [
                    'title'    => 'Section heading',
                    'subtitle' => 'Sub-heading',
                ],
            ],
            'page-approach-lifecycle' => [
                'label'  => 'Home Approach & Lifecycle — How We Work',
                'icon'   => 'fa-solid fa-rotate',
                'schema' => [
                    'label'    => 'Eyebrow label',
                    'title'    => 'Section heading',
                    'subtitle' => 'Intro paragraph',
                ],
            ],
            'page-testimonials' => [
                'label'  => 'Home Testimonials — Client Reviews',
                'icon'   => 'fa-solid fa-quote-left',
                'schema' => [
                    'rating' => 'Star rating (e.g. 4.8)',
                    'label'  => 'Eyebrow label',
                    'title'  => 'Section heading',
                ],
            ],

            // ── About Us section types ─────────────────────────────────────
            'about-hero' => [
                'label'  => 'About Hero — Page Banner',
                'icon'   => 'fa-solid fa-address-card',
                'schema' => [
                    'subtitle'    => 'Eyebrow label',
                    'title'       => 'Main headline',
                    'description' => 'Supporting paragraph',
                ],
            ],
            'about-intro' => [
                'label'  => 'About Intro — Who We Are',
                'icon'   => 'fa-solid fa-circle-info',
                'schema' => [
                    'label'      => 'Eyebrow label',
                    'title'      => 'Section heading',
                    'paragraphs' => '[string] — array of body paragraphs',
                ],
            ],
            'about-mission-vision' => [
                'label'  => 'About Mission & Vision — Two-Column',
                'icon'   => 'fa-solid fa-bullseye',
                'schema' => [
                    'mission_title' => 'Mission card heading',
                    'mission_text'  => 'Mission card body',
                    'vision_title'  => 'Vision card heading',
                    'vision_text'   => 'Vision card body',
                ],
            ],
            'about-values' => [
                'label'  => 'About Values — Icon Card Grid',
                'icon'   => 'fa-solid fa-gem',
                'schema' => [
                    'label' => 'Eyebrow label',
                    'title' => 'Section heading',
                    'items' => '[{icon, title, description}]',
                ],
            ],
            'about-services-overview' => [
                'label'  => 'About Services Overview — Expertise Grid',
                'icon'   => 'fa-solid fa-list-check',
                'schema' => [
                    'label' => 'Eyebrow label',
                    'title' => 'Section heading',
                ],
            ],
            'about-cta' => [
                'label'  => 'About CTA — Call to Action Banner',
                'icon'   => 'fa-solid fa-bullhorn',
                'schema' => [
                    'title'    => 'CTA heading',
                    'subtitle' => 'CTA sub-line',
                    'cta_text' => 'Button text',
                    'cta_url'  => 'Button URL',
                ],
            ],
            'cfo-services' => [
                'label'  => 'CFO Services — Two-Column Checklist + Type Cards',
                'icon'   => 'fa-solid fa-briefcase',
                'schema' => [
                    'title'       => 'Section heading',
                    'description' => 'Intro paragraph',
                    'scope_title' => 'Checklist column heading',
                    'scope_items' => '[string] — CFO scope bullet list',
                    'types_title' => 'Types column heading',
                    'types'       => '[string] — CFO engagement type names',
                ],
            ],
        ];
    }
}
