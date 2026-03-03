{{--
  Shared Section Builder — CSS + JS
  Include once per page: @include('admin.service-sections.partials._builder')
  Then use: const builder = new SectionBuilder(containerEl); builder.render(type, data);
--}}
<style>
/* ─── SectionBuilder Styles (sb-*) ─────────────────────────────── */
.sb-container {
    font-family: 'Inter', -apple-system, sans-serif;
}
.sb-type-label {
    font-size: 11px; font-weight: 700; letter-spacing: 1px;
    text-transform: uppercase; color: #4a73c4;
    background: rgba(74,115,196,0.08);
    border-radius: 6px; padding: 5px 10px;
    display: inline-block; margin-bottom: 20px;
}
.sb-field {
    margin-bottom: 18px;
}
.sb-label {
    display: block; font-size: 12px; font-weight: 600;
    color: #1e293b; margin-bottom: 5px;
}
.sb-hint {
    font-size: 11px; color: #94a3b8; margin-bottom: 5px; line-height: 1.4;
}
.sb-input {
    width: 100%; padding: 9px 12px;
    border: 1px solid rgba(0,0,0,0.12);
    border-radius: 7px; font-size: 13px;
    color: #1e293b; background: #fff;
    transition: border-color .15s;
    box-sizing: border-box;
}
.sb-input:focus { outline: none; border-color: #4a73c4; }
.sb-textarea {
    width: 100%; padding: 9px 12px;
    border: 1px solid rgba(0,0,0,0.12);
    border-radius: 7px; font-size: 13px;
    color: #1e293b; background: #fff;
    min-height: 80px; resize: vertical;
    transition: border-color .15s;
    box-sizing: border-box;
}
.sb-textarea:focus { outline: none; border-color: #4a73c4; }
.sb-array-ta { min-height: 70px; }

/* Repeater (array-of-objects) */
.sb-repeater { display: flex; flex-direction: column; gap: 10px; margin-bottom: 10px; }
.sb-object-item {
    border: 1px solid rgba(0,0,0,0.10);
    border-radius: 10px; overflow: hidden;
    background: #fff;
}
.sb-object-header {
    display: flex; align-items: center; gap: 8px;
    background: #f8fafc; padding: 9px 12px;
    border-bottom: 1px solid rgba(0,0,0,0.07);
}
.sb-drag-handle { color: #cbd5e1; cursor: grab; font-size: 12px; flex-shrink: 0; }
.sb-object-label { flex: 1; font-size: 12px; font-weight: 600; color: #64748b; }
.sb-remove-btn {
    font-size: 11px; color: #ef4444;
    background: rgba(239,68,68,0.08); border: 1px solid rgba(239,68,68,0.18);
    border-radius: 5px; padding: 3px 8px; cursor: pointer;
    transition: background .15s; flex-shrink: 0;
}
.sb-remove-btn:hover { background: rgba(239,68,68,0.15); }
.sb-object-body { padding: 12px 12px 4px; display: flex; flex-direction: column; gap: 10px; }
.sb-sub-field {}
.sb-sub-label { display: block; font-size: 11px; font-weight: 600; color: #475569; margin-bottom: 4px; }

/* Pair items */
.sb-pair-item {
    display: grid; grid-template-columns: 1fr 1fr auto;
    gap: 8px; align-items: center;
    padding: 8px; background: #fff;
    border: 1px solid rgba(0,0,0,0.09); border-radius: 8px;
}
.sb-remove-pair {
    width: 28px; height: 28px; border: none; background: rgba(239,68,68,0.1);
    color: #ef4444; border-radius: 6px; cursor: pointer; font-size: 16px;
    display: flex; align-items: center; justify-content: center; flex-shrink: 0;
    transition: background .15s;
}
.sb-remove-pair:hover { background: rgba(239,68,68,0.2); }

/* Add button */
.sb-add-btn {
    display: inline-flex; align-items: center; gap: 6px;
    padding: 7px 14px; font-size: 12px; font-weight: 600;
    background: rgba(27,60,107,0.06); color: #1b3c6b;
    border: 1.5px dashed rgba(27,60,107,0.3);
    border-radius: 7px; cursor: pointer;
    transition: background .15s, border-color .15s;
    width: 100%; justify-content: center; margin-top: 4px;
}
.sb-add-btn:hover { background: rgba(27,60,107,0.1); border-color: #1b3c6b; }

/* Preview card (compact summary) */
.sb-preview-card {
    background: #f8fafc; border: 1px solid rgba(0,0,0,0.08);
    border-radius: 10px; padding: 14px 16px;
    margin-bottom: 16px;
}
.sb-preview-card-label { font-size: 10px; font-weight: 700; letter-spacing: 1px; text-transform: uppercase; color: #94a3b8; margin-bottom: 8px; }
.sb-preview-card-title { font-size: 15px; font-weight: 700; color: #0d1b2a; margin-bottom: 4px; }
.sb-preview-card-desc { font-size: 12px; color: #64748b; line-height: 1.5; }
</style>

<script>
/* ═══════════════════════════════════════════════════════════
   FIELD SCHEMAS — one entry per section type
   ═══════════════════════════════════════════════════════════ */
const FIELD_SCHEMAS = {
  'page-hero': {
    label: 'Page Hero — Homepage Banner',
    icon: 'fa-solid fa-house',
    fields: [
      { key:'subtitle', type:'text', label:'Eyebrow / Sub-headline', hint:'e.g. Commitment to Your Financial Success' },
      { key:'title', type:'textarea', label:'Main Headline *', hint:'Use a newline for line breaks' },
      { key:'description', type:'textarea', label:'Description Paragraph (optional)' },
      { key:'cta_text', type:'text', label:'Primary Button Text', hint:'e.g. Book a Free Consultation' },
      { key:'cta_url', type:'text', label:'Primary Button Link', hint:'Use # to open the consultation modal' },
      { key:'secondary_button_link', type:'text', label:'Secondary Button Link — "Get a Free Financial Review"', hint:'Enter a full URL e.g. /contact or https://... (leave blank to hide the button)' },
    ]
  },
  'hero': {
    label: 'Hero — Page Banner',
    icon: 'fa-solid fa-flag',
    fields: [
      { key:'label', type:'text', label:'Page Label', hint:'e.g. GCC Services' },
      { key:'title', type:'text', label:'Headline *' },
      { key:'subtitle', type:'textarea', label:'Sub-headline' },
      { key:'description', type:'textarea', label:'Supporting Line (optional)' },
      { key:'cta_text', type:'text', label:'CTA Button Text' },
      { key:'cta_url', type:'text', label:'CTA URL', hint:'Use #contact to open the consultation modal' },
    ]
  },
  'overview': {
    label: 'Overview — Two Column',
    icon: 'fa-solid fa-columns',
    fields: [
      { key:'title', type:'text', label:'Section Title *' },
      { key:'description', type:'textarea', label:'Body Paragraph 1' },
      { key:'description2', type:'textarea', label:'Body Paragraph 2 (optional)' },
      { key:'cta_text', type:'text', label:'CTA Text (optional)' },
      { key:'cta_url', type:'text', label:'CTA URL (optional)' },
      { key:'stats', type:'array-of-objects', label:'Stat Boxes (optional)', itemLabel:'Stat',
        subFields:[
          { key:'value', type:'text', label:'Value', hint:'e.g. 40-60%' },
          { key:'label', type:'text', label:'Label' },
        ]
      },
    ]
  },
  'services-grid': {
    label: 'Services Grid',
    icon: 'fa-solid fa-grip',
    fields: [
      { key:'title', type:'text', label:'Section Title *' },
      { key:'items', type:'array-of-objects', label:'Service Cards', itemLabel:'Card',
        subFields:[
          { key:'icon', type:'text', label:'Icon Class', hint:'e.g. fa-solid fa-chart-line' },
          { key:'title', type:'text', label:'Card Title *' },
          { key:'description', type:'textarea', label:'Description' },
          { key:'points', type:'array-of-strings', label:'Bullet Points', hint:'One per line' },
        ]
      },
    ]
  },
  'process-steps': {
    label: 'Process Steps',
    icon: 'fa-solid fa-list-ol',
    fields: [
      { key:'title', type:'text', label:'Section Title *' },
      { key:'description', type:'textarea', label:'Intro Paragraph' },
      { key:'steps', type:'array-of-objects', label:'Steps', itemLabel:'Step',
        subFields:[
          { key:'number', type:'text', label:'Number', hint:'e.g. 01' },
          { key:'stage', type:'text', label:'Stage Name' },
          { key:'description', type:'textarea', label:'Description' },
          { key:'value', type:'text', label:'Value / Outcome (optional)' },
        ]
      },
      { key:'metrics', type:'array-of-objects', label:'Metrics Table (optional)', itemLabel:'Metric',
        subFields:[
          { key:'metric', type:'text', label:'Metric Name' },
          { key:'outcome', type:'text', label:'Outcome' },
        ]
      },
    ]
  },
  'why-stand-out': {
    label: 'Why Stand Out — USP Cards',
    icon: 'fa-solid fa-star',
    fields: [
      { key:'title', type:'text', label:'Section Title *' },
      { key:'items', type:'array-of-objects', label:'USP Cards', itemLabel:'Card',
        subFields:[
          { key:'icon', type:'text', label:'Icon Class', hint:'e.g. fa-solid fa-star' },
          { key:'title', type:'text', label:'Card Title *' },
          { key:'description', type:'textarea', label:'Description' },
        ]
      },
    ]
  },
  'faq': {
    label: 'FAQ Accordion',
    icon: 'fa-solid fa-circle-question',
    fields: [
      { key:'title', type:'text', label:'Section Title' },
      { key:'subtitle', type:'textarea', label:'Intro Paragraph (optional)' },
      { key:'items', type:'array-of-objects', label:'FAQ Items', itemLabel:'Q&A',
        subFields:[
          { key:'question', type:'text', label:'Question *' },
          { key:'answer', type:'textarea', label:'Answer *' },
        ]
      },
    ]
  },
  'other-services': {
    label: 'Other Services — Links',
    icon: 'fa-solid fa-link',
    fields: [
      { key:'title', type:'text', label:'Section Title' },
      { key:'items', type:'array-of-objects', label:'Service Links', itemLabel:'Link',
        subFields:[
          { key:'label', type:'text', label:'Service Name' },
          { key:'url', type:'text', label:'URL', hint:'e.g. /services/ma-advisory' },
        ]
      },
    ]
  },
  'benefits-list': {
    label: 'Benefits List',
    icon: 'fa-solid fa-check-double',
    fields: [
      { key:'title', type:'text', label:'Section Title *' },
      { key:'items', type:'array-of-strings', label:'Benefits (one per line)' },
    ]
  },
  'markets-served': {
    label: 'Markets Served',
    icon: 'fa-solid fa-earth-asia',
    fields: [
      { key:'title', type:'text', label:'Section Title' },
      { key:'markets', type:'array-of-strings', label:'Markets', hint:'One per line e.g. USA' },
    ]
  },
  'trust-signals': {
    label: 'Trust Signals',
    icon: 'fa-solid fa-shield-halved',
    fields: [
      { key:'title', type:'text', label:'Section Title' },
      { key:'items', type:'array-of-objects', label:'Trust Items', itemLabel:'Signal',
        subFields:[
          { key:'icon', type:'text', label:'Icon Class', hint:'e.g. fa-solid fa-lock' },
          { key:'label', type:'text', label:'Label Text' },
        ]
      },
    ]
  },
  'cpa-reality': {
    label: 'CPA Reality — Dark Block',
    icon: 'fa-solid fa-triangle-exclamation',
    fields: [
      { key:'eyebrow', type:'text', label:'Eyebrow Label' },
      { key:'title', type:'text', label:'Section Title *' },
      { key:'opening', type:'textarea', label:'Opening Paragraph' },
      { key:'pressure_points', type:'array-of-strings', label:'Pressure Points', hint:'One per line' },
      { key:'description', type:'textarea', label:'Body Paragraph' },
      { key:'old_model_title', type:'text', label:'Old Model Label', hint:'e.g. The Old Model' },
      { key:'old_model_description', type:'textarea', label:'Old Model Description' },
      { key:'shift_title', type:'text', label:'Shift Label', hint:'e.g. The Shift' },
      { key:'shift_description', type:'textarea', label:'Shift Description' },
    ]
  },
  'three-layer': {
    label: 'Three-Layer Structure',
    icon: 'fa-solid fa-layer-group',
    fields: [
      { key:'title', type:'text', label:'Section Title *' },
      { key:'description', type:'textarea', label:'Body Paragraph 1' },
      { key:'description2', type:'textarea', label:'Body Paragraph 2 (optional)' },
      { key:'description3', type:'textarea', label:'Body Paragraph 3 (optional)' },
      { key:'note', type:'text', label:'Bottom Note (italic, optional)' },
      { key:'layers', type:'array-of-objects', label:'Layers', itemLabel:'Layer',
        subFields:[
          { key:'number', type:'text', label:'Layer Number', hint:'e.g. 1' },
          { key:'title', type:'text', label:'Layer Title' },
          { key:'subtitle', type:'text', label:'Layer Subtitle (location/role)' },
          { key:'points', type:'array-of-strings', label:'Points', hint:'One per line' },
        ]
      },
    ]
  },
  'comparison-table': {
    label: 'Comparison Table',
    icon: 'fa-solid fa-table-columns',
    fields: [
      { key:'title', type:'text', label:'Section Title *' },
      { key:'column1_title', type:'text', label:'Left Column Header' },
      { key:'column2_title', type:'text', label:'Right Column Header' },
      { key:'rows', type:'array-of-pairs', label:'Rows', leftLabel:'Left Cell', rightLabel:'Right Cell' },
    ]
  },
  'engagement-models': {
    label: 'Engagement Models',
    icon: 'fa-solid fa-handshake',
    fields: [
      { key:'title', type:'text', label:'Section Title *' },
      { key:'standard_label', type:'text', label:'Standard Tab Label', hint:'e.g. All Clients' },
      { key:'cpa_label', type:'text', label:'CPA Tab Label (optional)', hint:'e.g. CPA Firms' },
      { key:'standard_models', type:'array-of-objects', label:'Standard Models', itemLabel:'Model',
        subFields:[
          { key:'title', type:'text', label:'Model Title *' },
          { key:'description', type:'textarea', label:'Description' },
          { key:'best_for', type:'text', label:'Best For' },
        ]
      },
      { key:'cpa_models', type:'array-of-objects', label:'CPA-Specific Models (optional)', itemLabel:'CPA Model',
        subFields:[
          { key:'title', type:'text', label:'Model Title' },
          { key:'description', type:'textarea', label:'Description' },
          { key:'best_for', type:'text', label:'Best For' },
        ]
      },
    ]
  },
  'pillars': {
    label: 'Key Pillars',
    icon: 'fa-solid fa-columns',
    fields: [
      { key:'title', type:'text', label:'Section Title *' },
      { key:'pillars', type:'array-of-objects', label:'Pillars', itemLabel:'Pillar',
        subFields:[
          { key:'title', type:'text', label:'Pillar Title *' },
          { key:'points', type:'array-of-strings', label:'Points', hint:'One per line' },
        ]
      },
    ]
  },
  'governance': {
    label: 'Governance & Security',
    icon: 'fa-solid fa-lock',
    fields: [
      { key:'title', type:'text', label:'Section Title *' },
      { key:'columns', type:'array-of-objects', label:'Columns', itemLabel:'Column',
        subFields:[
          { key:'title', type:'text', label:'Column Title' },
          { key:'items', type:'array-of-strings', label:'Items', hint:'One per line' },
        ]
      },
      { key:'disclaimer', type:'textarea', label:'Disclaimer Text (optional)' },
    ]
  },
};

/* ═══════════════════════════════════════════════════════════
   SectionBuilder Class
   ═══════════════════════════════════════════════════════════ */
class SectionBuilder {
    constructor(container) {
        this.container = container;
        this.currentType = null;
    }

    render(type, data) {
        this.currentType = type;
        const schema = FIELD_SCHEMAS[type];
        this.container.innerHTML = '';
        if (!schema) {
            this.container.innerHTML = '<p style="color:#94a3b8;text-align:center;padding:20px;">Select a section type to see fields.</p>';
            return;
        }
        const typeLabel = document.createElement('div');
        typeLabel.className = 'sb-type-label';
        typeLabel.innerHTML = `<i class="${schema.icon || 'fa-solid fa-layer-group'}"></i> ${schema.label}`;
        this.container.appendChild(typeLabel);

        schema.fields.forEach(f => this.container.appendChild(this._renderField(f, data ? data[f.key] : undefined)));
    }

    getData() {
        const schema = FIELD_SCHEMAS[this.currentType];
        if (!schema) return {};
        const result = {};
        schema.fields.forEach(f => {
            result[f.key] = this._getValue(f, this.container, true);
        });
        return result;
    }

    _getValue(field, container, topLevel) {
        const sel = topLevel
            ? `.sb-field[data-key="${field.key}"]`
            : `.sb-field[data-key="${field.key}"]`;
        const fieldEl = container.querySelector(`:scope > .sb-field[data-key="${field.key}"]`);
        if (!fieldEl) return undefined;

        if (field.type === 'text')   return fieldEl.querySelector('.sb-input').value;
        if (field.type === 'textarea') return fieldEl.querySelector('.sb-textarea').value;
        if (field.type === 'array-of-strings') {
            const ta = fieldEl.querySelector('.sb-textarea');
            return ta ? ta.value.split('\n').map(s => s.trim()).filter(Boolean) : [];
        }
        if (field.type === 'array-of-objects') {
            return [...fieldEl.querySelectorAll('.sb-object-item')].map(item => {
                const obj = {};
                (field.subFields || []).forEach(sf => { obj[sf.key] = this._getSubVal(sf, item); });
                return obj;
            });
        }
        if (field.type === 'array-of-pairs') {
            return [...fieldEl.querySelectorAll('.sb-pair-item')].map(item => [
                item.querySelector('.sb-pair-left')?.value ?? '',
                item.querySelector('.sb-pair-right')?.value ?? ''
            ]);
        }
    }

    _getSubVal(sf, itemEl) {
        const el = itemEl.querySelector(`[data-subkey="${sf.key}"]`);
        if (!el) return sf.type === 'array-of-strings' ? [] : '';
        if (sf.type === 'array-of-strings') return el.value.split('\n').map(s => s.trim()).filter(Boolean);
        return el.value;
    }

    _renderField(field, value) {
        const wrap = this._el('div', { className:'sb-field', dataset:{ key: field.key } });
        wrap.appendChild(this._el('label', { className:'sb-label', textContent: field.label }));
        if (field.hint) wrap.appendChild(this._el('div', { className:'sb-hint', textContent: field.hint }));

        if (field.type === 'text') {
            const inp = this._el('input', { type:'text', className:'sb-input', value: value||'' });
            if (field.hint) inp.placeholder = field.hint;
            wrap.appendChild(inp);

        } else if (field.type === 'textarea') {
            const ta = this._el('textarea', { className:'sb-textarea', textContent: value||'' });
            wrap.appendChild(ta);

        } else if (field.type === 'array-of-strings') {
            const ta = this._el('textarea', { className:'sb-textarea sb-array-ta', rows:4 });
            ta.value = Array.isArray(value) ? value.join('\n') : (value||'');
            ta.placeholder = field.hint || 'One item per line';
            wrap.appendChild(ta);

        } else if (field.type === 'array-of-objects') {
            const rep = this._el('div', { className:'sb-repeater' });
            (Array.isArray(value) ? value : []).forEach((item, i) => rep.appendChild(this._renderObjectItem(field, item, i)));
            wrap.appendChild(rep);
            const btn = this._el('button', { type:'button', className:'sb-add-btn', innerHTML:`<i class="fa-solid fa-plus"></i> Add ${field.itemLabel||'Item'}` });
            btn.addEventListener('click', () => {
                const idx = rep.querySelectorAll('.sb-object-item').length;
                rep.appendChild(this._renderObjectItem(field, {}, idx));
            });
            wrap.appendChild(btn);

        } else if (field.type === 'array-of-pairs') {
            const rep = this._el('div', { className:'sb-repeater' });
            (Array.isArray(value) ? value : []).forEach((pair, i) => rep.appendChild(this._renderPairItem(field, pair, i)));
            wrap.appendChild(rep);
            const btn = this._el('button', { type:'button', className:'sb-add-btn', innerHTML:'<i class="fa-solid fa-plus"></i> Add Row' });
            btn.addEventListener('click', () => rep.appendChild(this._renderPairItem(field, ['',''], rep.children.length)));
            wrap.appendChild(btn);
        }
        return wrap;
    }

    _renderObjectItem(field, data, index) {
        const item = this._el('div', { className:'sb-object-item' });
        const hdr  = this._el('div', { className:'sb-object-header' });
        hdr.appendChild(this._el('span', { className:'sb-drag-handle', innerHTML:'<i class="fa-solid fa-grip-vertical"></i>' }));
        const lbl = this._el('span', { className:'sb-object-label', textContent:`${field.itemLabel||'Item'} ${index+1}` });
        hdr.appendChild(lbl);
        const rmv = this._el('button', { type:'button', className:'sb-remove-btn', textContent:'× Remove' });
        rmv.addEventListener('click', () => {
            item.remove();
            item.closest('.sb-repeater')?.querySelectorAll('.sb-object-label').forEach((el,i) => {
                el.textContent = `${field.itemLabel||'Item'} ${i+1}`;
            });
        });
        hdr.appendChild(rmv);
        item.appendChild(hdr);

        const body = this._el('div', { className:'sb-object-body' });
        (field.subFields||[]).forEach(sf => {
            const sfWrap = this._el('div', { className:'sb-sub-field' });
            sfWrap.appendChild(this._el('label', { className:'sb-sub-label', textContent: sf.label }));
            if (sf.hint) sfWrap.appendChild(this._el('div', { className:'sb-hint', textContent: sf.hint }));
            const val = data ? data[sf.key] : undefined;

            if (sf.type === 'text') {
                const inp = this._el('input', { type:'text', className:'sb-input', value: val||'' });
                inp.dataset.subkey = sf.key;
                if (sf.hint) inp.placeholder = sf.hint;
                sfWrap.appendChild(inp);
            } else if (sf.type === 'textarea') {
                const ta = this._el('textarea', { className:'sb-textarea', textContent: val||'' });
                ta.dataset.subkey = sf.key;
                sfWrap.appendChild(ta);
            } else if (sf.type === 'array-of-strings') {
                const ta = this._el('textarea', { className:'sb-textarea sb-array-ta', rows:3 });
                ta.dataset.subkey = sf.key;
                ta.placeholder = sf.hint || 'One per line';
                ta.value = Array.isArray(val) ? val.join('\n') : (val||'');
                sfWrap.appendChild(ta);
            }
            body.appendChild(sfWrap);
        });
        item.appendChild(body);
        return item;
    }

    _renderPairItem(field, pair, index) {
        const item = this._el('div', { className:'sb-pair-item' });
        const l = this._el('input', { type:'text', className:'sb-input sb-pair-left', value: Array.isArray(pair)?pair[0]||'':'' });
        l.placeholder = field.leftLabel||'Left';
        const r = this._el('input', { type:'text', className:'sb-input sb-pair-right', value: Array.isArray(pair)?pair[1]||'':'' });
        r.placeholder = field.rightLabel||'Right';
        const rm = this._el('button', { type:'button', className:'sb-remove-pair', innerHTML:'×' });
        rm.addEventListener('click', () => item.remove());
        item.appendChild(l); item.appendChild(r); item.appendChild(rm);
        return item;
    }

    _el(tag, props) {
        const el = document.createElement(tag);
        Object.entries(props||{}).forEach(([k,v]) => {
            if (k === 'dataset') Object.entries(v).forEach(([dk,dv]) => el.dataset[dk]=dv);
            else if (k === 'className') el.className = v;
            else el[k] = v;
        });
        return el;
    }
}
</script>
