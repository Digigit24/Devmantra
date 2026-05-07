<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Thank you for contacting DevMantra</title>
</head>
<body style="margin:0;padding:0;background-color:#f4f6f9;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Arial,sans-serif;">

<table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:#f4f6f9;padding:40px 20px;">
  <tr>
    <td align="center">
      <table width="600" cellpadding="0" cellspacing="0" border="0" style="max-width:600px;width:100%;">

        {{-- Header --}}
        <tr>
          <td style="background:linear-gradient(135deg,#1b3c6b,#4a73c4);border-radius:16px 16px 0 0;padding:36px 40px;text-align:center;">
            <img src="{{ asset('favicon.png') }}" alt="DevMantra" width="56" height="56" style="border-radius:50%;display:block;margin:0 auto 16px;border:3px solid rgba(255,255,255,0.25);">
            <p style="margin:0;font-size:13px;font-weight:600;letter-spacing:2px;text-transform:uppercase;color:rgba(255,255,255,0.65);">DevMantra</p>
            <h1 style="margin:8px 0 0;font-size:24px;font-weight:600;color:#ffffff;letter-spacing:-0.3px;">We've received your message</h1>
          </td>
        </tr>

        {{-- Body --}}
        <tr>
          <td style="background:#ffffff;padding:40px;">

            <p style="margin:0 0 20px;font-size:16px;color:#1a1a2e;font-weight:500;">Hi {{ $name }},</p>

            <p style="margin:0 0 20px;font-size:15px;color:#555;line-height:1.7;">
              Thank you for reaching out to us. We have received your enquiry and our team will review it shortly. You can expect a response from us within <strong style="color:#1a1a2e;">1–2 business days</strong>.
            </p>

            <p style="margin:0 0 32px;font-size:15px;color:#555;line-height:1.7;">
              In the meantime, feel free to explore our services or reach out to us directly at
              <a href="mailto:info@devmantra.com" style="color:#4a73c4;text-decoration:none;font-weight:500;">info@devmantra.com</a>.
            </p>

            {{-- Message Summary --}}
            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background:#f8fafc;border:1px solid #e8ecf0;border-radius:10px;margin-bottom:32px;">
              <tr>
                <td style="padding:20px 24px;border-bottom:1px solid #e8ecf0;">
                  <p style="margin:0 0 4px;font-size:12px;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:#8a9bb0;">Your Enquiry</p>
                  <p style="margin:0;font-size:15px;color:#1a1a2e;font-weight:500;">{{ $enquirySubject }}</p>
                </td>
              </tr>
              <tr>
                <td style="padding:20px 24px;">
                  <p style="margin:0 0 4px;font-size:12px;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:#8a9bb0;">Your Message</p>
                  <p style="margin:0;font-size:14px;color:#555;line-height:1.7;white-space:pre-line;">{{ $userMessage }}</p>
                </td>
              </tr>
            </table>

            {{-- Visit Website CTA --}}
            <table width="100%" cellpadding="0" cellspacing="0" border="0">
              <tr>
                <td align="center">
                  <a href="https://devmantra.com" style="display:inline-block;padding:14px 32px;background:linear-gradient(135deg,#1b3c6b,#4a73c4);color:#ffffff;text-decoration:none;border-radius:8px;font-size:15px;font-weight:600;letter-spacing:0.2px;">
                    Visit DevMantra
                  </a>
                </td>
              </tr>
            </table>

          </td>
        </tr>

        {{-- Footer --}}
        <tr>
          <td style="background:#f8fafc;border-top:1px solid #e8ecf0;border-radius:0 0 16px 16px;padding:24px 40px;text-align:center;">
            <p style="margin:0 0 8px;font-size:13px;color:#aab4be;line-height:1.6;">
              DevMantra &nbsp;|&nbsp; <a href="https://devmantra.com" style="color:#4a73c4;text-decoration:none;">devmantra.com</a>
            </p>
            <p style="margin:0;font-size:12px;color:#c5cdd6;">
              You are receiving this email because you submitted a contact form on our website.
            </p>
          </td>
        </tr>

      </table>
    </td>
  </tr>
</table>

</body>
</html>
