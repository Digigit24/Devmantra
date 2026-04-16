@extends('layouts.admin')
@section('title', 'Email Settings')

@section('content')
<div class="row g-4">
    <div class="col-lg-8">
        <form method="POST" action="{{ route('admin.email-settings.update') }}">
            @csrf @method('PUT')
            <div class="dm-table-wrap" style="padding:24px;">
                <h6 style="font-size:16px;font-weight:700;margin-bottom:20px;">SMTP Configuration</h6>

                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="dm-form-group">
                            <label class="dm-form-label">SMTP Host</label>
                            <input type="text" name="smtp_host" value="{{ old('smtp_host', $emailSetting->smtp_host) }}" class="dm-form-input" placeholder="smtp.gmail.com" required>
                            @error('smtp_host') <div class="dm-form-error">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="dm-form-group">
                            <label class="dm-form-label">SMTP Port</label>
                            <input type="number" name="smtp_port" value="{{ old('smtp_port', $emailSetting->smtp_port) }}" class="dm-form-input" placeholder="587" required>
                            @error('smtp_port') <div class="dm-form-error">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="dm-form-group">
                            <label class="dm-form-label">SMTP Username</label>
                            <input type="text" name="smtp_username" value="{{ old('smtp_username', $emailSetting->smtp_username) }}" class="dm-form-input" placeholder="your-email@gmail.com">
                            @error('smtp_username') <div class="dm-form-error">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="dm-form-group">
                            <label class="dm-form-label">SMTP Password</label>
                            <input type="password" name="smtp_password" class="dm-form-input" placeholder="Leave empty to keep existing password">
                            <div class="dm-form-hint">Note: Password is encrypted. Leave blank to keep current password</div>
                            @error('smtp_password') <div class="dm-form-error">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>

                <div class="dm-form-group">
                    <label class="dm-form-label">SMTP Encryption</label>
                    <select name="smtp_encryption" class="dm-form-input" required>
                        <option value="tls" {{ old('smtp_encryption', $emailSetting->smtp_encryption) === 'tls' ? 'selected' : '' }}>TLS (Port 587)</option>
                        <option value="ssl" {{ old('smtp_encryption', $emailSetting->smtp_encryption) === 'ssl' ? 'selected' : '' }}>SSL (Port 465)</option>
                    </select>
                    @error('smtp_encryption') <div class="dm-form-error">{{ $message }}</div> @enderror
                </div>

                <hr style="margin:24px 0;border:1px solid #e0e0e0;">

                <h6 style="font-size:16px;font-weight:700;margin-bottom:20px;">Email Configuration</h6>

                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="dm-form-group">
                            <label class="dm-form-label">From Name</label>
                            <input type="text" name="from_name" value="{{ old('from_name', $emailSetting->from_name) }}" class="dm-form-input" placeholder="Devmantra" required>
                            @error('from_name') <div class="dm-form-error">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="dm-form-group">
                            <label class="dm-form-label">From Email</label>
                            <input type="email" name="from_email" value="{{ old('from_email', $emailSetting->from_email) }}" class="dm-form-input" placeholder="noreply@devmantra.com" required>
                            @error('from_email') <div class="dm-form-error">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>

                <div class="dm-form-group">
                    <label class="dm-form-label">Reply-To Email (Optional)</label>
                    <input type="email" name="reply_to_email" value="{{ old('reply_to_email', $emailSetting->reply_to_email) }}" class="dm-form-input" placeholder="support@devmantra.com">
                    <div class="dm-form-hint">Leave empty to use the From Email as reply-to</div>
                    @error('reply_to_email') <div class="dm-form-error">{{ $message }}</div> @enderror
                </div>

                <hr style="margin:24px 0;border:1px solid #e0e0e0;">

                <h6 style="font-size:16px;font-weight:700;margin-bottom:20px;">Features & Options</h6>

                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="dm-form-group">
                            <label class="dm-form-label">
                                <input type="hidden" name="enable_reply_feature" value="0">
                                <input type="checkbox" name="enable_reply_feature" value="1" {{ old('enable_reply_feature', $emailSetting->enable_reply_feature) ? 'checked' : '' }} class="dm-form-checkbox">
                                Enable Reply Feature
                            </label>
                            <div class="dm-form-hint">Allow users to reply to emails by responding to the reply-to address</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="dm-form-group">
                            <label class="dm-form-label">
                                <input type="hidden" name="is_active" value="0">
                                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $emailSetting->is_active) ? 'checked' : '' }} class="dm-form-checkbox">
                                Active
                            </label>
                            <div class="dm-form-hint">Disable this to temporarily stop sending emails</div>
                        </div>
                    </div>
                </div>

                <div class="dm-form-group">
                    <label class="dm-form-label">Business Email Domains (Optional)</label>
                    <textarea name="business_email_domains" class="dm-form-textarea" style="min-height:80px;" placeholder="example.com&#10;partner.com&#10;subdomain.company.com">{{ old('business_email_domains', $emailSetting->business_email_domains) }}</textarea>
                    <div class="dm-form-hint">Comma or newline separated list of allowed business domains for form submissions</div>
                    @error('business_email_domains') <div class="dm-form-error">{{ $message }}</div> @enderror
                </div>

                <button type="submit" class="dm-btn dm-btn-primary w-100 mt-4">
                    <i class="fa-solid fa-check"></i> Save Email Settings
                </button>
            </div>
        </form>
    </div>

    <div class="col-lg-4">
        <div class="dm-table-wrap" style="padding:24px;">
            <h6 style="font-size:16px;font-weight:700;margin-bottom:20px;">Test SMTP Connection</h6>
            <p style="font-size:14px;color:#666;margin-bottom:16px;">Click the button below to send a test email to your registered email address to verify your SMTP settings are working correctly.</p>

            <button type="button" class="dm-btn dm-btn-info w-100" id="testSmtpBtn">
                <i class="fa-solid fa-paper-plane"></i> Send Test Email
            </button>

            <div id="testResult" style="margin-top:16px;display:none;"></div>

            <hr style="margin:24px 0;border:1px solid #e0e0e0;">

            <h6 style="font-size:14px;font-weight:700;margin-bottom:12px;">Configuration Tips</h6>
            <ul style="font-size:13px;color:#666;padding-left:16px;">
                <li style="margin-bottom:8px;"><strong>Gmail:</strong> Use smtp.gmail.com:587 with App Password</li>
                <li style="margin-bottom:8px;"><strong>Outlook:</strong> Use smtp-mail.outlook.com:587</li>
                <li style="margin-bottom:8px;"><strong>SendGrid:</strong> Use smtp.sendgrid.net:587</li>
                <li style="margin-bottom:8px;"><strong>Mailgun:</strong> Use smtp.mailgun.org:587</li>
                <li style="margin-bottom:8px;"><strong>Always test</strong> your settings before making them live</li>
            </ul>
        </div>
    </div>
</div>

<style>
    .dm-form-error {
        color: #d32f2f;
        font-size: 13px;
        margin-top: 4px;
    }
    .dm-form-hint {
        color: #999;
        font-size: 12px;
        margin-top: 4px;
    }
    .dm-form-checkbox {
        margin-right: 8px;
        cursor: pointer;
    }
</style>

<script>
    document.getElementById('testSmtpBtn').addEventListener('click', function(e) {
        e.preventDefault();
        const btn = this;
        const resultDiv = document.getElementById('testResult');

        btn.disabled = true;
        btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Testing...';
        resultDiv.style.display = 'none';

        fetch('{{ route("admin.email-settings.test") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({})
        })
        .then(response => response.json())
        .then(data => {
            btn.disabled = false;
            btn.innerHTML = '<i class="fa-solid fa-paper-plane"></i> Send Test Email';

            const statusClass = data.success ? 'alert-success' : 'alert-danger';
            resultDiv.innerHTML = `<div class="alert ${statusClass}" role="alert">${data.message}</div>`;
            resultDiv.style.display = 'block';
        })
        .catch(error => {
            btn.disabled = false;
            btn.innerHTML = '<i class="fa-solid fa-paper-plane"></i> Send Test Email';
            resultDiv.innerHTML = `<div class="alert alert-danger" role="alert">Error testing SMTP: ${error.message}</div>`;
            resultDiv.style.display = 'block';
        });
    });
</script>
@endsection
