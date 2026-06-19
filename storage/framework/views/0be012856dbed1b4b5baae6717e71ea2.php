
<style>
    .dm-modal-overlay {
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,0.6);
        backdrop-filter: blur(4px);
        z-index: 9999;
        display: none;
        align-items: center;
        justify-content: center;
        padding: 20px;
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    .dm-modal-overlay.active {
        display: flex;
        opacity: 1;
    }
    .dm-modal {
        background: #fff;
        border-radius: 20px;
        width: 100%;
        max-width: 580px;
        max-height: 90vh;
        overflow-y: auto;
        padding: 48px;
        position: relative;
        transform: translateY(20px);
        transition: transform 0.3s ease;
    }
    .dm-modal-overlay.active .dm-modal { transform: translateY(0); }
    @media (max-width: 767px) { .dm-modal { padding: 28px; } }
    .dm-modal::-webkit-scrollbar { width: 4px; }
    .dm-modal::-webkit-scrollbar-thumb { background: rgba(0,0,0,0.15); border-radius: 4px; }
    .dm-modal-close {
        position: absolute;
        top: 20px;
        right: 20px;
        width: 36px;
        height: 36px;
        border-radius: 50%;
        border: 1px solid rgba(0,0,0,0.1);
        background: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        font-size: 18px;
        color: #111;
        transition: all 0.3s ease;
        z-index: 1;
    }
    .dm-modal-close:hover {
        background: #111;
        color: #fff;
        border-color: #111;
    }
    .dm-modal-title {
        font-size: 28px;
        font-weight: 600;
        color: #111;
        margin-bottom: 8px;
        font-family: var(--tp-ff-onest);
    }
    .dm-modal-desc {
        font-size: 15px;
        color: rgba(0,0,0,0.5);
        margin-bottom: 32px;
        font-family: var(--tp-ff-onest);
    }
    .dm-modal .dm-cf-group { margin-bottom: 20px; }
    .dm-modal .dm-cf-label {
        display: block;
        font-size: 14px;
        font-weight: 600;
        color: #111;
        margin-bottom: 8px;
        font-family: var(--tp-ff-onest);
    }
    .dm-modal .dm-cf-input,
    .dm-modal .dm-cf-select,
    .dm-modal .dm-cf-textarea {
        width: 100%;
        padding: 14px 18px;
        border: 1px solid rgba(0,0,0,0.1);
        border-radius: 10px;
        font-size: 15px;
        color: #111;
        background: #fafafa;
        font-family: var(--tp-ff-onest);
        transition: border-color 0.3s ease;
        outline: none;
    }
    .dm-modal .dm-cf-input:focus,
    .dm-modal .dm-cf-select:focus,
    .dm-modal .dm-cf-textarea:focus {
        border-color: #111;
        background: #fff;
    }
    .dm-modal .dm-cf-input::placeholder,
    .dm-modal .dm-cf-textarea::placeholder {
        color: rgba(0,0,0,0.3);
    }
    .dm-modal .dm-cf-textarea { min-height: 120px; resize: vertical; }
    .dm-modal .dm-cf-submit {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 16px 40px;
        background: #001d30;
        color: #fff;
        border: none;
        border-radius: 10px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        font-family: var(--tp-ff-onest);
        width: 100%;
        justify-content: center;
    }
    .dm-modal .dm-cf-submit:hover {
        background: #003050;
        transform: translateY(-2px);
    }
    .dm-modal .dm-cf-error {
        font-size: 13px;
        color: #dc2626;
        margin-top: 6px;
        font-family: var(--tp-ff-onest);
    }
    .dm-modal .dm-cf-success {
        background: rgba(34,197,94,0.1);
        border: 1px solid rgba(34,197,94,0.2);
        color: #1d6aa9;
        padding: 16px 24px;
        border-radius: 10px;
        font-size: 15px;
        font-weight: 500;
        margin-bottom: 24px;
        font-family: var(--tp-ff-onest);
        display: flex;
        align-items: center;
        gap: 10px;
    }
</style>

<div class="dm-modal-overlay" id="consultationModal">
    <div class="dm-modal">
        <button class="dm-modal-close" id="closeConsultationModal" aria-label="Close">
            <i class="fa-solid fa-xmark"></i>
        </button>
        <h3 class="dm-modal-title">Book a Consultation</h3>
        <p class="dm-modal-desc">Fill in the details below and our team will get back to you within 24 hours.</p>

        <div class="dm-cf-success" id="consultationSuccess" style="display:none;">
            <i class="fa-solid fa-check-circle"></i> <span>Thank you! We'll get back to you soon.</span>
        </div>

        <form id="consultationForm" method="POST" action="<?php echo e(route('contact.submit')); ?>">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="subject" value="Consultation Request">
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="dm-cf-group">
                        <label class="dm-cf-label">Full Name *</label>
                        <input type="text" name="name" class="dm-cf-input" placeholder="Your full name" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="dm-cf-group">
                        <label class="dm-cf-label">Email Address *</label>
                        <input type="email" name="email" class="dm-cf-input" placeholder="your@email.com" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="dm-cf-group">
                        <label class="dm-cf-label">Phone Number</label>
                        <input type="text" name="phone" class="dm-cf-input" placeholder="+91 XXXXX XXXXX">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="dm-cf-group">
                        <label class="dm-cf-label">Company Name</label>
                        <input type="text" name="company" class="dm-cf-input" placeholder="Your company">
                    </div>
                </div>
                <div class="col-12">
                    <div class="dm-cf-group">
                        <label class="dm-cf-label">Requirements *</label>
                        <textarea name="message" class="dm-cf-textarea" placeholder="Tell us about your requirements, goals, and how we can help..." required></textarea>
                    </div>
                </div>
                <div class="col-12">
                    <button type="submit" class="dm-cf-submit" id="consultationSubmitBtn">
                        Submit Request
                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="12" viewBox="0 0 15 12" fill="none">
                            <path d="M14.5303 6.53033C14.8232 6.23744 14.8232 5.76256 14.5303 5.46967L9.75736 0.696699C9.46447 0.403806 8.98959 0.403806 8.6967 0.696699C8.40381 0.989592 8.40381 1.46447 8.6967 1.75736L12.9393 6L8.6967 10.2426C8.40381 10.5355 8.40381 11.0104 8.6967 11.3033C8.98959 11.5962 9.46447 11.5962 9.75736 11.3033L14.5303 6.53033ZM0 6.75H14V5.25H0V6.75Z" fill="currentColor"/>
                        </svg>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
(function() {
    var overlay = document.getElementById('consultationModal');
    var form = document.getElementById('consultationForm');
    var successMsg = document.getElementById('consultationSuccess');
    var submitBtn = document.getElementById('consultationSubmitBtn');

    function openModal() {
        overlay.classList.add('active');
        document.body.style.overflow = 'hidden';
    }
    window.openConsultationModal = openModal;

    var openBtn = document.getElementById('openConsultationModal');
    if (openBtn) {
        openBtn.addEventListener('click', function(e) {
            e.preventDefault();
            openModal();
        });
    }

    // Also open on any link with href="#contact"
    document.addEventListener('click', function(e) {
        var link = e.target.closest('a[href="#contact"]');
        if (link) {
            e.preventDefault();
            openModal();
        }
    });

    function closeModal() {
        overlay.classList.remove('active');
        document.body.style.overflow = '';
    }

    document.getElementById('closeConsultationModal').addEventListener('click', closeModal);
    overlay.addEventListener('click', function(e) {
        if (e.target === overlay) closeModal();
    });
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && overlay.classList.contains('active')) closeModal();
    });

    // AJAX form submit
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        submitBtn.disabled = true;
        submitBtn.innerHTML = 'Submitting...';

        form.querySelectorAll('.dm-cf-error').forEach(function(el) { el.remove(); });

        var formData = new FormData(form);

        fetch(form.action, {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': formData.get('_token'),
                'Accept': 'application/json'
            },
            body: formData
        })
        .then(function(response) { return response.json().then(function(data) { return { status: response.status, data: data }; }); })
        .then(function(result) {
            if (result.status === 422 && result.data.errors) {
                Object.keys(result.data.errors).forEach(function(field) {
                    var input = form.querySelector('[name="' + field + '"]');
                    if (input) {
                        var errDiv = document.createElement('div');
                        errDiv.className = 'dm-cf-error';
                        errDiv.textContent = result.data.errors[field][0];
                        input.parentNode.appendChild(errDiv);
                    }
                });
            } else {
                form.reset();
                successMsg.style.display = 'flex';
                setTimeout(function() {
                    successMsg.style.display = 'none';
                    closeModal();
                }, 3000);
            }
        })
        .catch(function() {
            form.reset();
            successMsg.style.display = 'flex';
            setTimeout(function() {
                successMsg.style.display = 'none';
                closeModal();
            }, 3000);
        })
        .finally(function() {
            submitBtn.disabled = false;
            submitBtn.innerHTML = 'Submit Request <svg xmlns="http://www.w3.org/2000/svg" width="15" height="12" viewBox="0 0 15 12" fill="none"><path d="M14.5303 6.53033C14.8232 6.23744 14.8232 5.76256 14.5303 5.46967L9.75736 0.696699C9.46447 0.403806 8.98959 0.403806 8.6967 0.696699C8.40381 0.989592 8.40381 1.46447 8.6967 1.75736L12.9393 6L8.6967 10.2426C8.40381 10.5355 8.40381 11.0104 8.6967 11.3033C8.98959 11.5962 9.46447 11.5962 9.75736 11.3033L14.5303 6.53033ZM0 6.75H14V5.25H0V6.75Z" fill="currentColor"/></svg>';
        });
    });
})();
</script>
<?php /**PATH C:\xampp\htdocs\Devmantranew\resources\views\frontend\partials\consultation-modal.blade.php ENDPATH**/ ?>