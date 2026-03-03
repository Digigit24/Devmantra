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
                'schema' => [
                    'title' => 'Section title',
                    'items' => '[{title, description, icon?, points:[]}]',
                ],
            ],
            'process-steps' => [
                'label'  => 'Process Steps — Numbered Timeline',
                'schema' => [
                    'title'       => 'Section title',
                    'description' => 'Intro paragraph',
                    'steps'       => '[{number, stage, description}]',
                    'metrics'     => '[{metric, outcome}] — optional table at end',
                ],
            ],
            'why-stand-out' => [
                'label'  => 'Why Stand Out — USP Card Grid',
                'schema' => [
                    'title' => 'Section title',
                    'items' => '[{title, description, icon?}]',
                ],
            ],
            'faq' => [
                'label'  => 'FAQ — Accordion',
                'schema' => [
                    'title'    => 'Section title',
                    'subtitle' => 'Intro paragraph',
                    'items'    => '[{question, answer}]',
                ],
            ],
            'other-services' => [
                'label'  => 'Other Services — Link Strip',
                'schema' => [
                    'title' => 'Section title',
                    'items' => '[{label, url}]',
                ],
            ],
            'benefits-list' => [
                'label'  => 'Benefits List — Two-Column Checklist',
                'schema' => [
                    'title' => 'Section title',
                    'items' => '[string] — list of benefit statements',
                ],
            ],
            'markets-served' => [
                'label'  => 'Markets Served — Badge Grid',
                'schema' => [
                    'title'   => 'Section title',
                    'markets' => '[string] — e.g. USA, UK, Europe',
                ],
            ],
            'trust-signals' => [
                'label'  => 'Trust Signals — Icon Strip',
                'schema' => [
                    'title' => 'Section title',
                    'items' => '[{icon, label}]',
                ],
            ],
            'cpa-reality' => [
                'label'  => 'CPA Reality — Dark Problem Statement',
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
                'schema' => [
                    'title'          => 'Section title',
                    'column1_title'  => 'Left column header',
                    'column2_title'  => 'Right column header',
                    'rows'           => '[[left_item, right_item], ...]',
                ],
            ],
            'engagement-models' => [
                'label'  => 'Engagement Models — Card Groups',
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
                'schema' => [
                    'title'   => 'Section title',
                    'pillars' => '[{title, points:[]}]',
                ],
            ],
            'governance' => [
                'label'  => 'Governance & Security — Two-Column Block',
                'schema' => [
                    'title'      => 'Section title',
                    'columns'    => '[{title, items:[]}]',
                    'disclaimer' => 'Bottom disclaimer text',
                ],
            ],
        ];
    }
}
