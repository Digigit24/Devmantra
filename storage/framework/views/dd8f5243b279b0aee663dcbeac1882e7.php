<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>New Enquiry on Website</title>
</head>
<body style="margin:0;padding:0;background-color:#f4f6f9;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Arial,sans-serif;">

<table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:#f4f6f9;padding:40px 20px;">
  <tr>
    <td align="center">
      <table width="600" cellpadding="0" cellspacing="0" border="0" style="max-width:600px;width:100%;">

        
        <tr>
          <td style="background:linear-gradient(135deg,#1b3c6b,#4a73c4);border-radius:16px 16px 0 0;padding:36px 40px;text-align:center;">
            <img src="<?php echo e(asset('favicon.png')); ?>" alt="DevMantra" width="56" height="56" style="border-radius:50%;display:block;margin:0 auto 16px;border:3px solid rgba(255,255,255,0.25);">
            <p style="margin:0;font-size:13px;font-weight:600;letter-spacing:2px;text-transform:uppercase;color:rgba(255,255,255,0.65);">DevMantra</p>
            <h1 style="margin:8px 0 0;font-size:24px;font-weight:600;color:#ffffff;letter-spacing:-0.3px;">New Website Enquiry</h1>
          </td>
        </tr>

        
        <tr>
          <td style="background:#ffffff;padding:40px;">

            <p style="margin:0 0 28px;font-size:15px;color:#555;line-height:1.6;">
              You have received a new enquiry from your website. Details are below.
            </p>

            
            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="border:1px solid #e8ecf0;border-radius:10px;overflow:hidden;">
              <tr>
                <td style="background:#f8fafc;padding:14px 20px;border-bottom:1px solid #e8ecf0;width:35%;">
                  <span style="font-size:12px;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:#8a9bb0;">Name</span>
                </td>
                <td style="background:#ffffff;padding:14px 20px;border-bottom:1px solid #e8ecf0;">
                  <span style="font-size:15px;color:#1a1a2e;font-weight:500;"><?php echo e($name); ?></span>
                </td>
              </tr>
              <tr>
                <td style="background:#f8fafc;padding:14px 20px;border-bottom:1px solid #e8ecf0;">
                  <span style="font-size:12px;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:#8a9bb0;">Email</span>
                </td>
                <td style="background:#ffffff;padding:14px 20px;border-bottom:1px solid #e8ecf0;">
                  <a href="mailto:<?php echo e($email); ?>" style="font-size:15px;color:#4a73c4;text-decoration:none;font-weight:500;"><?php echo e($email); ?></a>
                </td>
              </tr>
              <?php if($phone): ?>
              <tr>
                <td style="background:#f8fafc;padding:14px 20px;border-bottom:1px solid #e8ecf0;">
                  <span style="font-size:12px;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:#8a9bb0;">Phone</span>
                </td>
                <td style="background:#ffffff;padding:14px 20px;border-bottom:1px solid #e8ecf0;">
                  <span style="font-size:15px;color:#1a1a2e;font-weight:500;"><?php echo e($phone); ?></span>
                </td>
              </tr>
              <?php endif; ?>
              <tr>
                <td style="background:#f8fafc;padding:14px 20px;border-bottom:1px solid #e8ecf0;">
                  <span style="font-size:12px;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:#8a9bb0;">Subject</span>
                </td>
                <td style="background:#ffffff;padding:14px 20px;border-bottom:1px solid #e8ecf0;">
                  <span style="font-size:15px;color:#1a1a2e;font-weight:500;"><?php echo e($enquirySubject); ?></span>
                </td>
              </tr>
              <tr>
                <td style="background:#f8fafc;padding:14px 20px;vertical-align:top;">
                  <span style="font-size:12px;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:#8a9bb0;">Message</span>
                </td>
                <td style="background:#ffffff;padding:14px 20px;">
                  <span style="font-size:15px;color:#333;line-height:1.7;white-space:pre-line;"><?php echo e($userMessage); ?></span>
                </td>
              </tr>
            </table>

            
            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-top:32px;">
              <tr>
                <td align="center">
                  <a href="mailto:<?php echo e($email); ?>?subject=Re: <?php echo e($enquirySubject); ?>" style="display:inline-block;padding:14px 32px;background:linear-gradient(135deg,#1b3c6b,#4a73c4);color:#ffffff;text-decoration:none;border-radius:8px;font-size:15px;font-weight:600;letter-spacing:0.2px;">
                    Reply to <?php echo e($name); ?>

                  </a>
                </td>
              </tr>
            </table>

          </td>
        </tr>

        
        <tr>
          <td style="background:#f8fafc;border-top:1px solid #e8ecf0;border-radius:0 0 16px 16px;padding:24px 40px;text-align:center;">
            <p style="margin:0;font-size:13px;color:#aab4be;line-height:1.6;">
              This email was sent from the contact form on <a href="https://devmantra.com" style="color:#4a73c4;text-decoration:none;">devmantra.com</a>
            </p>
          </td>
        </tr>

      </table>
    </td>
  </tr>
</table>

</body>
</html>
<?php /**PATH C:\xampp\htdocs\Devmantranew\resources\views\emails\contact-admin.blade.php ENDPATH**/ ?>