/* ============================================================
   ESOP Allocation Calculator — shared dashboard utilities
   Used by both the inline results screen (calculator.js, rendered
   inside the typeform wizard) and the standalone shareable report
   page (frontend.esop-calculator.report). Keeping chart rendering,
   PDF export and small helpers here avoids duplicating them.
   ============================================================ */
window.EsopDashboard = (function () {
    'use strict';

    var AVATAR_PALETTE = ['#1b3c6b', '#4a73c4', '#7aa2e8', '#059669', '#d9a441', '#7c3aed', '#0891b2', '#dc2626'];

    function initials(name) {
        name = (name || '').trim();
        if (!name) return '?';
        var parts = name.split(/\s+/).filter(Boolean);
        if (parts.length === 1) return parts[0].slice(0, 2).toUpperCase();
        return (parts[0][0] + parts[parts.length - 1][0]).toUpperCase();
    }

    function avatarColor(seed) {
        seed = String(seed || '');
        var h = 0;
        for (var i = 0; i < seed.length; i++) h = (h * 31 + seed.charCodeAt(i)) >>> 0;
        return AVATAR_PALETTE[h % AVATAR_PALETTE.length];
    }

    // Score-tier color: mirrors EsopQuestionBank::scoreLabel() breakpoints.
    function scoreColor(score) {
        if (score >= 90) return '#d9a441'; // Exceptional — gold
        if (score >= 75) return '#059669'; // Strong — green
        if (score >= 60) return '#4a73c4'; // Good/Solid — blue
        if (score >= 40) return '#f59e0b'; // Developing — amber
        return '#94a3b8'; // Early-stage — grey
    }

    function fmtPct(v, decimals) {
        var n = Number(v);
        if (isNaN(n)) return '—';
        return n.toFixed(decimals == null ? 2 : decimals) + '%';
    }

    /* ---------------- Chart.js renderers ---------------- */
    function renderDonut(canvasId, segments) {
        var el = document.getElementById(canvasId);
        if (!el || !window.Chart) return null;
        var data = segments.filter(function (s) { return s.value > 0; });
        if (!data.length) data = [{ label: 'No data', value: 1, color: '#e2e8f0' }];
        return new window.Chart(el.getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: data.map(function (s) { return s.label; }),
                datasets: [{
                    data: data.map(function (s) { return s.value; }),
                    backgroundColor: data.map(function (s) { return s.color; }),
                    borderWidth: 0,
                    hoverOffset: 4
                }]
            },
            options: {
                cutout: '72%',
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false }, tooltip: { callbacks: {
                    label: function (ctx) { return ctx.label + ': ' + Number(ctx.parsed).toFixed(3) + '%'; }
                } } }
            }
        });
    }

    function renderBar(canvasId, labels, values, color) {
        var el = document.getElementById(canvasId);
        if (!el || !window.Chart) return null;
        return new window.Chart(el.getContext('2d'), {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    data: values,
                    backgroundColor: color || '#4a73c4',
                    borderRadius: 5,
                    maxBarThickness: 22
                }]
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false }, tooltip: { callbacks: {
                    label: function (ctx) { return Number(ctx.parsed.x).toFixed(3) + '% allocated'; }
                } } },
                scales: {
                    x: { grid: { color: '#f1f5f9' }, ticks: { font: { size: 10 } } },
                    y: { grid: { display: false }, ticks: { font: { size: 11 } } }
                }
            }
        });
    }

    function escapeHtml(s) {
        return (s == null ? '' : String(s)).replace(/[&<>"']/g, function (c) {
            return { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[c];
        });
    }

    /* ---------------- Distribution bars ----------------
       Renders the "Allocation by Department / Seniority" panels as plain
       HTML + CSS rather than Chart.js. Three reasons: these panels routinely
       hold a single row (a one-employee session), where a full chart axis
       reads as empty; a CSS bar always survives the html2canvas PDF export;
       and it removes any dependency on the Chart.js CDN being reachable.

       Bar WIDTH is scaled against the largest row so the panel always fills
       its space — a width proportional to, say, a 0.35% slice of a 7% pool
       would be a sliver. The true share is stated as text beneath instead.
    */
    function renderDistribution(containerId, rows, options) {
        var el = document.getElementById(containerId);
        if (!el) return;

        rows = rows || [];
        options = options || {};

        if (!rows.length) {
            el.innerHTML = '<div class="esop-dist-empty">No employees scored yet.</div>';
            return;
        }

        var accent = options.accent || '#4a73c4';
        var accentSoft = options.accentSoft || '#7aa2e8';
        var emptyLabel = options.emptyLabel || 'Nobody scored here yet';

        var total = 0, max = 0;
        rows.forEach(function (r) {
            var v = Number(r.allocated) || 0;
            total += v;
            if (v > max) max = v;
        });

        el.innerHTML = '<div class="esop-dist">' + rows.map(function (r) {
            var v = Number(r.allocated) || 0;
            var n = Number(r.employees) || 0;
            var width = max > 0 ? (v / max) * 100 : 0;
            var share = total > 0 ? (v / total) * 100 : 0;
            var meta = n === 0
                ? emptyLabel
                : n + ' employee' + (n === 1 ? '' : 's') + ' &middot; ' + share.toFixed(1) + '% of allocated';

            return '<div class="esop-dist-row' + (v > 0 ? '' : ' is-zero') + '">' +
                '<div class="esop-dist-head">' +
                    '<span class="esop-dist-label">' + escapeHtml(r.label) + '</span>' +
                    '<span class="esop-dist-val">' + v.toFixed(4) + '%</span>' +
                '</div>' +
                '<div class="esop-dist-track">' +
                    (v > 0
                        ? '<div class="esop-dist-fill" style="width:' + width.toFixed(2) + '%;background:linear-gradient(90deg,' + accent + ',' + accentSoft + ')"></div>'
                        : '') +
                '</div>' +
                '<div class="esop-dist-meta">' + meta + '</div>' +
            '</div>';
        }).join('') + '</div>' +
        (options.note ? '<div class="esop-dist-note">' + escapeHtml(options.note) + '</div>' : '');
    }

    /* ---------------- row expand/collapse (AI notes) ---------------- */
    function initRowToggles(tableSelector) {
        document.querySelectorAll(tableSelector + ' tr.emp-row').forEach(function (row) {
            row.addEventListener('click', function () {
                var detail = document.getElementById(row.getAttribute('data-detail-for'));
                if (!detail) return;
                var willOpen = !detail.classList.contains('open');
                document.querySelectorAll(tableSelector + ' tr.emp-detail-row.open').forEach(function (r) { r.classList.remove('open'); });
                if (willOpen) detail.classList.add('open');
            });
        });
    }

    /* ---------------- copy link ---------------- */
    function copyLink(url, btnEl) {
        var done = function () {
            if (!btnEl) return;
            var original = btnEl.getAttribute('data-original') || btnEl.innerHTML;
            btnEl.setAttribute('data-original', original);
            btnEl.innerHTML = '<i class="fas fa-check"></i> Link copied';
            setTimeout(function () { btnEl.innerHTML = original; }, 2200);
        };
        if (navigator.clipboard && navigator.clipboard.writeText) {
            navigator.clipboard.writeText(url).then(done).catch(function () { window.prompt('Copy this link:', url); });
        } else {
            window.prompt('Copy this link:', url);
        }
    }

    /* ---------------- PDF export (paginated, A4) ---------------- */
    function exportPdf(areaId, filename) {
        var area = document.getElementById(areaId);
        if (!area || !window.html2canvas || !window.jspdf) { window.print(); return; }

        var scrollX = window.scrollX || window.pageXOffset || 0;
        var scrollY = window.scrollY || window.pageYOffset || 0;
        window.scrollTo(0, 0);

        window.html2canvas(area, {
            scale: 2,
            backgroundColor: '#ffffff',
            useCORS: true,
            scrollX: 0,
            scrollY: 0,
            windowWidth: document.documentElement.scrollWidth,
            windowHeight: document.documentElement.scrollHeight,
            // html2canvas cannot rasterise `background-clip: text`, so the big
            // "Total Recommended Allocation" figure — which uses a gradient
            // clipped to the glyphs — came out as an empty gradient block in the
            // downloaded PDF. Swap the gradient for a solid fill in the CLONED
            // DOM only, so the on-screen dashboard keeps its gradient treatment
            // and only the exported copy is flattened.
            onclone: function (clonedDoc) {
                var nodes = clonedDoc.querySelectorAll('.esop-dash-headline-value');
                Array.prototype.forEach.call(nodes, function (el) {
                    el.style.background = 'none';
                    el.style.webkitBackgroundClip = 'border-box';
                    el.style.backgroundClip = 'border-box';
                    el.style.webkitTextFillColor = '#ffffff';
                    el.style.color = '#ffffff';
                });
            }
        }).then(function (canvas) {
            window.scrollTo(scrollX, scrollY);

            var jsPDF = window.jspdf.jsPDF;
            var pdf = new jsPDF({ orientation: 'portrait', unit: 'mm', format: 'a4' });

            var pageW = 210, pageH = 297, margin = 10;
            var contentW = pageW - margin * 2;
            var contentH = pageH - margin * 2;

            var pxPerMm = canvas.width / contentW;
            var pageHeightPx = Math.max(1, Math.floor(contentH * pxPerMm));

            var renderedPx = 0;
            var pageIndex = 0;

            while (renderedPx < canvas.height) {
                var sliceHeightPx = Math.min(pageHeightPx, canvas.height - renderedPx);

                var pageCanvas = document.createElement('canvas');
                pageCanvas.width = canvas.width;
                pageCanvas.height = sliceHeightPx;
                var ctx = pageCanvas.getContext('2d');
                ctx.fillStyle = '#ffffff';
                ctx.fillRect(0, 0, pageCanvas.width, pageCanvas.height);
                ctx.drawImage(canvas, 0, renderedPx, canvas.width, sliceHeightPx, 0, 0, canvas.width, sliceHeightPx);

                var sliceImgData = pageCanvas.toDataURL('image/jpeg', 0.95);
                var sliceHeightMm = sliceHeightPx / pxPerMm;

                if (pageIndex > 0) pdf.addPage();
                pdf.addImage(sliceImgData, 'JPEG', margin, margin, contentW, sliceHeightMm);

                renderedPx += sliceHeightPx;
                pageIndex++;
            }

            pdf.save((filename || 'ESOP-Allocation-Report') + '.pdf');
        }).catch(function () {
            window.scrollTo(scrollX, scrollY);
            window.print();
        });
    }

    return {
        initials: initials,
        avatarColor: avatarColor,
        scoreColor: scoreColor,
        fmtPct: fmtPct,
        renderDonut: renderDonut,
        renderBar: renderBar,
        renderDistribution: renderDistribution,
        escapeHtml: escapeHtml,
        initRowToggles: initRowToggles,
        copyLink: copyLink,
        exportPdf: exportPdf
    };
})();
