@props(['data' => []])
@php
    $subtitle = $data['subtitle'] ?? 'Technology at the Core';
    $title    = $data['title']    ?? 'AI-Enabled Financial Platform';
@endphp

<!-- SECTION — AI-Enabled Platform -->
<section class="dm-ai-section">
    <div class="dm-ai-bg">
        <div class="dm-ai-grid-plane"></div>
        <div class="dm-ai-orb dm-ai-orb--1"></div>
        <div class="dm-ai-orb dm-ai-orb--2"></div>
        <div class="dm-ai-orb dm-ai-orb--3"></div>
        <canvas class="dm-ai-particles" id="dmAiParticles"></canvas>
    </div>
    <div class="container container-1230">
        <div class="dm-ai-inner">
            <div class="dm-ai-header text-center">
                <span class="tp-section-subtitle-gradient ct">{{ $subtitle }}</span>
                <h2 class="dm-ai-title">{!! nl2br(e($title)) !!}</h2>
                <p class="dm-ai-subtitle">Dev Mantra integrates automation and AI-assisted tools across its delivery model — ensuring faster turnarounds, fewer errors, and deeper financial insights for every client engagement.</p>
            </div>
            <div class="dm-ai-platform">
                <div class="dm-ai-webgl-wrap">
                    <canvas class="dm-ai-webgl-canvas" id="dmAiWebGL"></canvas>
                    <div class="dm-ai-fallback">
                        <div class="dm-ai-fb-ring dm-ai-fb-ring--1"></div>
                        <div class="dm-ai-fb-ring dm-ai-fb-ring--2"></div>
                        <div class="dm-ai-fb-ring dm-ai-fb-ring--3"></div>
                        <div class="dm-ai-fb-core">
                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#1d6aa9" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 2L2 7l10 5 10-5-10-5z"/>
                                <path d="M2 17l10 5 10-5"/>
                                <path d="M2 12l10 5 10-5"/>
                            </svg>
                        </div>
                    </div>
                    <span class="dm-ai-webgl-label">AI Engine</span>
                </div>
            </div>
            <div class="dm-ai-capabilities">
                <div class="dm-ai-card" data-ai-index="0">
                    <div class="dm-ai-card-glow"></div>
                    <div class="dm-ai-card-inner">
                        <div class="dm-ai-card-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/>
                                <polyline points="3.27 6.96 12 12.01 20.73 6.96"/>
                                <line x1="12" y1="22.08" x2="12" y2="12"/>
                            </svg>
                        </div>
                        <h4 class="dm-ai-card-title">Cloud Accounting & Real-Time Dashboards</h4>
                        <p class="dm-ai-card-desc">Cloud-based accounting implementation with live reporting dashboards that give you instant visibility into your financial health.</p>
                        <div class="dm-ai-card-line"></div>
                    </div>
                </div>
                <div class="dm-ai-card" data-ai-index="1">
                    <div class="dm-ai-card-glow"></div>
                    <div class="dm-ai-card-inner">
                        <div class="dm-ai-card-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/>
                            </svg>
                        </div>
                        <h4 class="dm-ai-card-title">Automated Reconciliation & Variance Detection</h4>
                        <p class="dm-ai-card-desc">Intelligent automation that reconciles transactions and flags anomalies in real-time — eliminating manual errors at scale.</p>
                        <div class="dm-ai-card-line"></div>
                    </div>
                </div>
                <div class="dm-ai-card" data-ai-index="2">
                    <div class="dm-ai-card-glow"></div>
                    <div class="dm-ai-card-inner">
                        <div class="dm-ai-card-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                                <polyline points="14 2 14 8 20 8"/>
                                <line x1="16" y1="13" x2="8" y2="13"/>
                                <line x1="16" y1="17" x2="8" y2="17"/>
                                <polyline points="10 9 9 9 8 9"/>
                            </svg>
                        </div>
                        <h4 class="dm-ai-card-title">AI-Assisted Tax Workpaper Preparation</h4>
                        <p class="dm-ai-card-desc">Machine learning models that accelerate tax workpaper preparation and review — reducing turnaround time dramatically.</p>
                        <div class="dm-ai-card-line"></div>
                    </div>
                </div>
                <div class="dm-ai-card" data-ai-index="3">
                    <div class="dm-ai-card-glow"></div>
                    <div class="dm-ai-card-inner">
                        <div class="dm-ai-card-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                            </svg>
                        </div>
                        <h4 class="dm-ai-card-title">Smart Audit & Compliance Workflows</h4>
                        <p class="dm-ai-card-desc">Automated workflows that maintain audit-readiness and track compliance requirements — so nothing slips through the cracks.</p>
                        <div class="dm-ai-card-line"></div>
                    </div>
                </div>
                <div class="dm-ai-card" data-ai-index="4">
                    <div class="dm-ai-card-glow"></div>
                    <div class="dm-ai-card-inner">
                        <div class="dm-ai-card-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                                <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                            </svg>
                        </div>
                        <h4 class="dm-ai-card-title">Secure Data Rooms & Encrypted Portals</h4>
                        <p class="dm-ai-card-desc">Enterprise-grade encrypted data rooms and client portals with role-based access — ensuring your sensitive data stays protected.</p>
                        <div class="dm-ai-card-line"></div>
                    </div>
                </div>
                <div class="dm-ai-card" data-ai-index="5">
                    <div class="dm-ai-card-glow"></div>
                    <div class="dm-ai-card-inner">
                        <div class="dm-ai-card-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="3"/>
                                <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06A1.65 1.65 0 0 0 4.68 15a1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06A1.65 1.65 0 0 0 9 4.68a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06A1.65 1.65 0 0 0 19.4 9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"/>
                            </svg>
                        </div>
                        <h4 class="dm-ai-card-title">ERP & Accounting Platform Integration</h4>
                        <p class="dm-ai-card-desc">Seamless integration with leading ERP and accounting platforms — connecting your existing tech stack without disruption.</p>
                        <div class="dm-ai-card-line"></div>
                    </div>
                </div>
            </div>
            <div class="dm-ai-footer text-center">
                <p class="dm-ai-tagline">Powered by modern tools. Governed by experienced professionals.<br>Built to scale with your business.</p>
            </div>
        </div>
    </div>
</section>

@once
@push('scripts')
<script>
(function () {
    var canvas = document.getElementById('dmAiParticles');
    if (canvas) {
        var ctx = canvas.getContext('2d');
        var particles = [];
        var PARTICLE_COUNT = 55;
        var mouse = { x: -1000, y: -1000 };

        function resize() {
            var rect = canvas.parentElement.getBoundingClientRect();
            canvas.width = rect.width;
            canvas.height = rect.height;
        }
        resize();
        window.addEventListener('resize', resize);

        canvas.parentElement.addEventListener('mousemove', function (e) {
            var rect = canvas.getBoundingClientRect();
            mouse.x = e.clientX - rect.left;
            mouse.y = e.clientY - rect.top;
        });

        for (var i = 0; i < PARTICLE_COUNT; i++) {
            particles.push({ x: Math.random() * canvas.width, y: Math.random() * canvas.height, vx: (Math.random() - 0.5) * 0.35, vy: (Math.random() - 0.5) * 0.35, r: Math.random() * 2 + 0.5, alpha: Math.random() * 0.35 + 0.1 });
        }

        function drawParticles() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            for (var i = 0; i < particles.length; i++) {
                var p = particles[i];
                p.x += p.vx; p.y += p.vy;
                if (p.x < 0) p.x = canvas.width;
                if (p.x > canvas.width) p.x = 0;
                if (p.y < 0) p.y = canvas.height;
                if (p.y > canvas.height) p.y = 0;
                var dx = mouse.x - p.x, dy = mouse.y - p.y, dist = Math.sqrt(dx * dx + dy * dy);
                if (dist < 180) { p.vx += dx * 0.00012; p.vy += dy * 0.00012; }
                ctx.beginPath();
                ctx.arc(p.x, p.y, p.r, 0, Math.PI * 2);
                ctx.fillStyle = 'rgba(99, 102, 241, ' + p.alpha + ')';
                ctx.fill();
                for (var j = i + 1; j < particles.length; j++) {
                    var p2 = particles[j];
                    var d = Math.sqrt(Math.pow(p.x - p2.x, 2) + Math.pow(p.y - p2.y, 2));
                    if (d < 110) {
                        ctx.beginPath(); ctx.moveTo(p.x, p.y); ctx.lineTo(p2.x, p2.y);
                        ctx.strokeStyle = 'rgba(99, 102, 241, ' + (0.055 * (1 - d / 110)) + ')';
                        ctx.lineWidth = 0.5; ctx.stroke();
                    }
                }
            }
            requestAnimationFrame(drawParticles);
        }
        drawParticles();
    }

    try {
        var webglCanvas = document.getElementById('dmAiWebGL');
        if (webglCanvas && typeof THREE !== 'undefined') {
            var wrap = webglCanvas.parentElement;
            var W = wrap.clientWidth || 420, H = wrap.clientHeight || 420;
            var mouseNorm = { x: 0, y: 0 };
            var renderer = new THREE.WebGLRenderer({ canvas: webglCanvas, alpha: true, antialias: true });
            renderer.setPixelRatio(Math.min(window.devicePixelRatio || 1, 2));
            renderer.setSize(W, H);
            renderer.setClearColor(0x000000, 0);
            var scene = new THREE.Scene();
            var camera = new THREE.PerspectiveCamera(45, W / H, 0.1, 100);
            camera.position.z = 5;
            var CoreGeo = THREE.IcosahedronBufferGeometry || THREE.IcosahedronGeometry;
            var coreGeo = new CoreGeo(1.0, 2);
            var coreMat = new THREE.MeshBasicMaterial({ color: 0x4338ca, wireframe: true, transparent: true, opacity: 0.5 });
            var coreMesh = new THREE.Mesh(coreGeo, coreMat);
            scene.add(coreMesh);
            var SphGeo = THREE.SphereBufferGeometry || THREE.SphereGeometry;
            var innerGeo = new SphGeo(0.45, 32, 32);
            var innerMat = new THREE.MeshBasicMaterial({ color: 0x6366f1, transparent: true, opacity: 0.35 });
            var innerMesh = new THREE.Mesh(innerGeo, innerMat);
            scene.add(innerMesh);
            var NODE_COUNT = 200, nodePositions = new Float32Array(NODE_COUNT * 3), nodeOrbits = [];
            for (var i = 0; i < NODE_COUNT; i++) {
                var phi = Math.acos(2 * Math.random() - 1), theta = Math.random() * Math.PI * 2, r = 1.0 + Math.random() * 0.8;
                nodePositions[i * 3] = r * Math.sin(phi) * Math.cos(theta);
                nodePositions[i * 3 + 1] = r * Math.sin(phi) * Math.sin(theta);
                nodePositions[i * 3 + 2] = r * Math.cos(phi);
                nodeOrbits.push({ radius: r, phi: phi, theta: theta, phiSpeed: (Math.random() - 0.5) * 0.004, thetaSpeed: (Math.random() - 0.5) * 0.008 });
            }
            var nodeGeo = new THREE.BufferGeometry();
            nodeGeo.setAttribute('position', new THREE.BufferAttribute(nodePositions, 3));
            var nodeMat = new THREE.PointsMaterial({ size: 0.055, color: 0x6366f1, transparent: true, opacity: 0.8, sizeAttenuation: true });
            var nodePoints = new THREE.Points(nodeGeo, nodeMat);
            scene.add(nodePoints);
            var CONN_MAX = 300, connPositions = new Float32Array(CONN_MAX * 6);
            var connGeo = new THREE.BufferGeometry();
            connGeo.setAttribute('position', new THREE.BufferAttribute(connPositions, 3));
            var connMat = new THREE.LineBasicMaterial({ color: 0x6366f1, transparent: true, opacity: 0.15 });
            var connLines = new THREE.LineSegments(connGeo, connMat);
            scene.add(connLines);
            var TorGeo = THREE.TorusBufferGeometry || THREE.TorusGeometry;
            var ringColors = [0x4338ca, 0x7c3aed, 0x3b82f6], ringScales = [1.8, 2.1, 2.4];
            var ringRotations = [{ x: Math.PI / 2.5, y: 0, z: 0 }, { x: Math.PI / 3.5, y: Math.PI / 4, z: 0 }, { x: Math.PI / 5, y: -Math.PI / 3, z: Math.PI / 6 }];
            var rings = [];
            for (var ri = 0; ri < 3; ri++) {
                var rGeo = new TorGeo(ringScales[ri], 0.018, 8, 100);
                var rMat = new THREE.MeshBasicMaterial({ color: ringColors[ri], transparent: true, opacity: 0.3 + ri * 0.05 });
                var rMesh = new THREE.Mesh(rGeo, rMat);
                rMesh.rotation.set(ringRotations[ri].x, ringRotations[ri].y, ringRotations[ri].z);
                scene.add(rMesh); rings.push(rMesh);
            }
            wrap.classList.add('dm-ai-webgl-active');
            var clock = new THREE.Clock();
            function updateConnections() {
                var posArr = nodeGeo.attributes.position.array, connIdx = 0, threshold = 0.9;
                for (var ci = 0; ci < NODE_COUNT && connIdx < CONN_MAX; ci++) {
                    var ax = posArr[ci*3], ay = posArr[ci*3+1], az = posArr[ci*3+2];
                    for (var cj = ci+1; cj < NODE_COUNT && connIdx < CONN_MAX; cj++) {
                        var bx = posArr[cj*3], by = posArr[cj*3+1], bz = posArr[cj*3+2];
                        var dx = ax-bx, dy = ay-by, dz = az-bz;
                        if (dx*dx+dy*dy+dz*dz < threshold) {
                            connPositions[connIdx*6]=ax; connPositions[connIdx*6+1]=ay; connPositions[connIdx*6+2]=az;
                            connPositions[connIdx*6+3]=bx; connPositions[connIdx*6+4]=by; connPositions[connIdx*6+5]=bz;
                            connIdx++;
                        }
                    }
                }
                for (var ck=connIdx*6; ck<CONN_MAX*6; ck++) connPositions[ck]=0;
                connGeo.attributes.position.needsUpdate=true;
                connGeo.setDrawRange(0, connIdx*2);
            }
            function animate() {
                requestAnimationFrame(animate);
                var t = clock.getElapsedTime(), posArr = nodeGeo.attributes.position.array;
                for (var ai=0; ai<NODE_COUNT; ai++) {
                    var orb=nodeOrbits[ai]; orb.phi+=orb.phiSpeed; orb.theta+=orb.thetaSpeed;
                    posArr[ai*3]=orb.radius*Math.sin(orb.phi)*Math.cos(orb.theta);
                    posArr[ai*3+1]=orb.radius*Math.sin(orb.phi)*Math.sin(orb.theta);
                    posArr[ai*3+2]=orb.radius*Math.cos(orb.phi);
                }
                nodeGeo.attributes.position.needsUpdate=true;
                if (Math.round(t*60)%3===0) updateConnections();
                coreMesh.rotation.x=t*0.15+mouseNorm.y*0.3; coreMesh.rotation.y=t*0.2+mouseNorm.x*0.3;
                var pulse=0.45+Math.sin(t*2)*0.05; innerMesh.scale.setScalar(pulse/0.45); innerMat.opacity=0.3+Math.sin(t*1.5)*0.1;
                rings[0].rotation.z+=0.003; rings[1].rotation.z-=0.0025; rings[2].rotation.z+=0.002;
                scene.rotation.x=mouseNorm.y*0.15; scene.rotation.y=mouseNorm.x*0.15;
                renderer.render(scene, camera);
            }
            animate();
            wrap.addEventListener('mousemove', function(e) { var rect=wrap.getBoundingClientRect(); mouseNorm.x=((e.clientX-rect.left)/rect.width-0.5)*2; mouseNorm.y=((e.clientY-rect.top)/rect.height-0.5)*2; });
            wrap.addEventListener('mouseleave', function() { mouseNorm.x=0; mouseNorm.y=0; });
            window.addEventListener('resize', function() { W=wrap.clientWidth; H=wrap.clientHeight; camera.aspect=W/H; camera.updateProjectionMatrix(); renderer.setSize(W,H); });
        }
    } catch(e) {}

    document.querySelectorAll('.dm-ai-card').forEach(function(card) {
        card.addEventListener('mousemove', function(e) {
            var rect=card.getBoundingClientRect(), glow=card.querySelector('.dm-ai-card-glow');
            if (glow) { glow.style.left=(e.clientX-rect.left)+'px'; glow.style.top=(e.clientY-rect.top)+'px'; }
        });
    });

    try {
        var aiElems = document.querySelectorAll('.dm-ai-header, .dm-ai-platform, .dm-ai-card, .dm-ai-footer');
        if (aiElems.length && typeof gsap !== 'undefined' && typeof ScrollTrigger !== 'undefined') {
            aiElems.forEach(function(el) {
                gsap.from(el, { y: 40, opacity: 0, duration: 0.7, ease: 'power3.out', scrollTrigger: { trigger: el, start: 'top 92%', once: true } });
            });
        }
    } catch(e) {}
})();
</script>
@endpush
@endonce
