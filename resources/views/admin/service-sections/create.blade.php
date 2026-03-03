@extends('layouts.admin')
@section('title', 'Add Section — ' . $service->title)

@section('actions')
<a href="{{ route('admin.services.sections.index', $service) }}" class="dm-btn dm-btn-outline dm-btn-sm">
    <i class="fa-solid fa-arrow-left"></i> Back to Sections
</a>
@endsection

@section('content')
<form method="POST" action="{{ route('admin.services.sections.store', $service) }}" id="section-form">
    @csrf
    <div class="row g-4">
        {{-- Left: JSON editor --}}
        <div class="col-lg-8">
            <div class="dm-table-wrap" style="padding:24px;">
                <div class="dm-form-group">
                    <label class="dm-form-label">Section Data (JSON) *</label>
                    <textarea name="section_data" id="section-data" class="dm-form-textarea @error('section_data') is-invalid @enderror"
                        style="font-family:monospace;font-size:13px;min-height:420px;white-space:pre;" required>{{ old('section_data', '{}') }}</textarea>
                    @error('section_data')<div class="invalid-feedback" style="color:#ef4444;font-size:13px;margin-top:4px;">{{ $message }}</div>@enderror
                    <div class="dm-form-hint" style="margin-top:8px;">
                        <i class="fa-solid fa-circle-info"></i>
                        Enter valid JSON. Select a section type on the right to see the expected keys.
                    </div>
                </div>

                {{-- JSON validation indicator --}}
                <div id="json-status" style="font-size:13px;margin-top:8px;display:flex;align-items:center;gap:6px;">
                    <i class="fa-solid fa-circle-check" style="color:#22c55e;"></i> Valid JSON
                </div>
            </div>
        </div>

        {{-- Right: Section type + settings + schema hint --}}
        <div class="col-lg-4">
            <div class="dm-table-wrap" style="padding:24px;margin-bottom:16px;">
                <div class="dm-form-group">
                    <label class="dm-form-label">Section Type *</label>
                    <select name="section_type" id="section-type" class="dm-form-select" required>
                        <option value="">— Choose type —</option>
                        @foreach($sectionTypes as $key => $meta)
                        <option value="{{ $key }}" {{ old('section_type') === $key ? 'selected' : '' }}>
                            {{ $meta['label'] }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="dm-form-group">
                    <label class="dm-form-label">Sort Order</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order') }}" class="dm-form-input" placeholder="Auto">
                    <div class="dm-form-hint">Leave blank to append at end</div>
                </div>
                <div class="dm-form-group" style="display:flex;align-items:center;gap:10px;">
                    <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', '1') ? 'checked' : '' }} style="width:16px;height:16px;">
                    <label for="is_active" class="dm-form-label" style="margin:0;">Active (visible on page)</label>
                </div>
                <button type="submit" class="dm-btn dm-btn-primary" style="width:100%;margin-top:8px;">
                    <i class="fa-solid fa-plus"></i> Add Section
                </button>
            </div>

            {{-- Schema hint panel --}}
            <div class="dm-table-wrap" style="padding:24px;" id="schema-panel">
                <p style="font-size:13px;font-weight:700;color:#1b3c6b;margin-bottom:14px;">
                    <i class="fa-solid fa-code"></i> JSON Schema
                </p>
                <div id="schema-content" style="font-size:12px;color:#555;font-family:monospace;background:#f8f9fa;padding:12px;border-radius:8px;line-height:1.8;">
                    Select a section type to see schema
                </div>
                <button type="button" id="load-template" style="display:none;margin-top:12px;width:100%;" class="dm-btn dm-btn-outline dm-btn-sm">
                    <i class="fa-solid fa-wand-magic-sparkles"></i> Load Template
                </button>
            </div>
        </div>
    </div>
</form>
@endsection

@push('scripts')
<script>
var schemas = @json($sectionTypes);
var templates = {
    'hero': {"label":"GCC (Global Capability Centers)","title":"Reliable, Compliant, End-to-End Corporate Financial Operations from India","subtitle":"Dev Mantra provides fully managed accounting and financial operations for startups, SMEs, and professional service firms worldwide.","cta_text":"Book a Consultation","cta_url":"#contact"},
    'overview': {"title":"Empower Your Business with Our Services","description":"Primary body paragraph goes here.","description2":"Secondary body paragraph goes here.","cta_text":"Connect with Our Experts","cta_url":"#contact"},
    'services-grid': {"title":"Services Offered","items":[{"title":"Service One","description":"Description here.","icon":"fa-solid fa-chart-line","points":["Point 1","Point 2"]},{"title":"Service Two","description":"Description here.","icon":"fa-solid fa-handshake"}]},
    'process-steps': {"title":"Our Process","description":"A structured approach.","steps":[{"number":"01","stage":"Stage Name","description":"What we do here."},{"number":"02","stage":"Stage Two","description":"Next step."}],"metrics":[{"metric":"Example metric","outcome":"Example outcome"}]},
    'why-stand-out': {"title":"Why We Stand Out","items":[{"title":"Industry Expertise","description":"Deep insights tailored to your needs.","icon":"fa-solid fa-star"},{"title":"Proven Track Record","description":"Consistent results across engagements.","icon":"fa-solid fa-trophy"}]},
    'faq': {"title":"Any Questions? We've Got You.","subtitle":"Find answers to common questions.","items":[{"question":"Question one?","answer":"Answer one."},{"question":"Question two?","answer":"Answer two."}]},
    'other-services': {"title":"Explore Our Other Services","items":[{"label":"M&A Advisory","url":"/services/ma-advisory"},{"label":"GCC Services","url":"/services/gcc"}]},
    'benefits-list': {"title":"Benefits","items":["Benefit one","Benefit two","Benefit three","Benefit four"]},
    'markets-served': {"title":"Markets Served","markets":["USA","UK","Europe","Singapore","Australia","UAE"]},
    'trust-signals': {"title":"Why Trust Us","items":[{"icon":"fa-solid fa-shield-halved","label":"Accuracy you can trust — 3-level quality checks"},{"icon":"fa-solid fa-lock","label":"Secure data handling — NDA + encrypted file exchange"}]},
    'cpa-reality': {"eyebrow":"Built Specifically for U.S. CPA Firms","title":"The Profession Is Under Structural Pressure.","opening":"Opening paragraph here.","pressure_points":["CPA talent shortage","Rising audit complexity","Margin compression"],"description":"Body copy.","old_model_title":"The Old Model","old_model_description":"Traditional offshoring critique.","shift_title":"The Shift","shift_description":"New model explanation."},
    'three-layer': {"title":"Scaling Through Automation","description":"Body paragraph 1.","description2":"Body paragraph 2.","note":"Dev Mantra is a long-term capability hub — not a vendor.","layers":[{"number":"1","title":"Automation Engine","subtitle":"(Technology)","points":["AI-based tools","Workflow orchestration"]},{"number":"2","title":"Expert Delivery Team","subtitle":"(India)","points":["Audit associates","Tax specialists"]},{"number":"3","title":"CPA Partner Oversight","subtitle":"(USA)","points":["Final review","Client advisory"]}]},
    'comparison-table': {"title":"Automation Handles Execution. Partners Handle Judgment.","column1_title":"Automated","column2_title":"Retained by Partner","rows":[["Data ingestion","Client relationship"],["Workpaper preparation","Risk judgment"]]},
    'engagement-models': {"title":"Engagement Models","standard_label":"Standard Models","cpa_label":"CPA-Specific Models","standard_models":[{"title":"Process Outsourcing","description":"Full end-to-end outsourcing.","best_for":"Complete outsourced finance function"},{"title":"Offshore Process","description":"Dedicated India team.","best_for":"Embedded India team"}],"cpa_models":[{"title":"Dedicated GCC","description":"Full India audit team.","best_for":"High-volume audit work"}]},
    'pillars': {"title":"What Makes Our Model Work","pillars":[{"title":"Automation-First","points":["AI-enabled workflows","24-hour audit cycles"]},{"title":"Talent Advantage","points":["US GAAP knowledge","English fluency"]}]},
    'governance': {"title":"Governance, Security & Audit Defensibility","columns":[{"title":"Security Framework","items":["SOC 2 compliant","Role-based access control","Encrypted document environments"]},{"title":"Regulatory Alignment","items":["PCAOB documentation standards","AICPA peer review readiness"]}],"disclaimer":"Disclaimer text here."}
};

var typeSelect = document.getElementById('section-type');
var dataTextarea = document.getElementById('section-data');
var schemaContent = document.getElementById('schema-content');
var loadBtn = document.getElementById('load-template');
var jsonStatus = document.getElementById('json-status');

typeSelect.addEventListener('change', function(){
    var type = this.value;
    if(!type || !schemas[type]) { schemaContent.textContent='Select a section type to see schema'; loadBtn.style.display='none'; return; }
    var schema = schemas[type].schema;
    var lines = Object.entries(schema).map(function(e){ return '"' + e[0] + '": ' + (typeof e[1]==='string' ? '"' + e[1] + '"' : JSON.stringify(e[1])); });
    schemaContent.textContent = '{\n  ' + lines.join(',\n  ') + '\n}';
    loadBtn.style.display = templates[type] ? 'block' : 'none';
});

loadBtn.addEventListener('click', function(){
    var type = typeSelect.value;
    if(templates[type]){ dataTextarea.value = JSON.stringify(templates[type], null, 2); validateJson(); }
});

function validateJson(){
    try { JSON.parse(dataTextarea.value); jsonStatus.innerHTML = '<i class="fa-solid fa-circle-check" style="color:#22c55e;"></i> Valid JSON'; }
    catch(e){ jsonStatus.innerHTML = '<i class="fa-solid fa-circle-xmark" style="color:#ef4444;"></i> Invalid JSON: ' + e.message; }
}
dataTextarea.addEventListener('input', validateJson);
validateJson();

// Trigger on page load if type is pre-selected
if(typeSelect.value) typeSelect.dispatchEvent(new Event('change'));
</script>
@endpush
