<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class EmailSetting extends Model
{
    protected $table = 'email_settings';

    protected $fillable = [
        'smtp_host',
        'smtp_port',
        'smtp_username',
        'smtp_password',
        'smtp_encryption',
        'from_name',
        'from_email',
        'reply_to_email',
        'enable_reply_feature',
        'is_active',
        'business_email_domains',
    ];

    protected $casts = [
        'smtp_port' => 'integer',
        'enable_reply_feature' => 'boolean',
        'is_active' => 'boolean',
    ];

    /**
     * Get the singleton instance of email settings
     */
    public static function instance()
    {
        return self::firstOrCreate(
            [],
            [
                'smtp_host' => 'smtp.mailtrap.io',
                'smtp_port' => 587,
                'smtp_encryption' => 'tls',
                'from_name' => 'Devmantra',
                'from_email' => 'noreply@devmantra.com',
                'enable_reply_feature' => true,
                'is_active' => true,
            ]
        );
    }

    /**
     * Get decrypted SMTP password
     */
    public function getSmtpPasswordDecryptedAttribute()
    {
        if ($this->smtp_password) {
            try {
                return Crypt::decryptString($this->smtp_password);
            } catch (\Exception $e) {
                return null;
            }
        }
        return null;
    }

    /**
     * Set encrypted SMTP password
     */
    public function setSmtpPasswordAttribute($value)
    {
        if ($value) {
            try {
                $this->attributes['smtp_password'] = Crypt::encryptString($value);
            } catch (\Exception $e) {
                $this->attributes['smtp_password'] = null;
            }
        } else {
            $this->attributes['smtp_password'] = null;
        }
    }

    /**
     * Get array of allowed business email domains
     */
    public function getAllowedBusinessDomains()
    {
        if (!$this->business_email_domains) {
            return [];
        }

        return array_map('trim', explode(',', $this->business_email_domains));
    }
}
