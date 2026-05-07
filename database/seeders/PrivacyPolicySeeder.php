<?php

namespace Database\Seeders;

use App\Models\Page;
use App\Models\PageSection;
use Illuminate\Database\Seeder;

class PrivacyPolicySeeder extends Seeder
{
    public function run(): void
    {
        $page = Page::firstOrCreate(
            ['name' => 'privacy-policy'],
            ['title' => 'Privacy Policy']
        );

        PageSection::where('page_id', $page->id)->delete();

        // Hero section (reuses the service-pages hero component)
        PageSection::create([
            'page_id'      => $page->id,
            'section_type' => 'hero',
            'section_data' => [
                'label'    => 'Legal',
                'title'    => 'Privacy Policy',
                'subtitle' => 'Learn how AOne Dev Mantra Financial Services Pvt Ltd collects, uses, and protects your personal information.',
            ],
            'sort_order'   => 0,
            'is_active'    => true,
        ]);

        $html = <<<'HTML'
<h1>Privacy Policy</h1>
<p>AOne Dev Mantra Financial Services Pvt Ltd (&ldquo;we,&rdquo; &ldquo;us,&rdquo; or &ldquo;our&rdquo;) recognizes the importance of your privacy and is committed to protecting it. This Privacy Policy describes our policies and practices regarding the collection, use, disclosure, and sharing of your personal information when you use our platforms, including websites, mobile applications, and other services (collectively, the &ldquo;Platform&rdquo;). By using the Platform, you agree to this Privacy Policy, which is incorporated into and forms part of our Terms of Use.</p>

<h2>1. Information We Collect</h2>
<p>We collect personal information to provide our services, improve your experience, and meet legal obligations. The information we collect depends on the services you use and may include the following:</p>
<h3>a. Account and Profile Information</h3>
<ul>
    <li>Name</li>
    <li>Contact information (email address and phone number)</li>
    <li>Identification details (PAN, Aadhar, Date of Birth, etc.)</li>
    <li>Address and KYC documents</li>
</ul>
<h3>b. Financial and Tax Information</h3>
<ul>
    <li>Income details</li>
    <li>Bank account details</li>
    <li>Investment goals and preferences</li>
    <li>Tax-related documents as required by law</li>
</ul>
<h3>c. Usage Data</h3>
<ul>
    <li>Information about how you interact with the Platform</li>
    <li>Device and browser information</li>
    <li>Log files, cookies, and similar technologies to monitor and improve performance</li>
</ul>

<h2>2. How We Use Your Information</h2>
<p>We use the information we collect for the following purposes:</p>
<ul>
    <li>To deliver and manage the products and services you request.</li>
    <li>To verify your identity and facilitate secure transactions.</li>
    <li>To advise you on financial products and services tailored to your goals.</li>
    <li>To provide customer support and respond to your inquiries or complaints.</li>
    <li>To improve our services through debugging, testing, and research.</li>
    <li>To send promotional materials about our services, unless you opt out.</li>
    <li>To comply with legal and regulatory requirements.</li>
    <li>For other purposes with your explicit consent.</li>
</ul>

<h2>3. How We Share Your Information</h2>
<p>We may share your information with third parties in the following scenarios:</p>
<h3>a. Service Providers</h3>
<p>We work with third-party providers to deliver our services, such as:</p>
<ul>
    <li>Cloud hosting and storage providers</li>
    <li>Payment processors and banking partners</li>
    <li>Marketing and analytics providers</li>
    <li>Security service providers</li>
</ul>
<p>These providers are bound by contracts to use your information solely for the purposes specified by us.</p>
<h3>b. Third-Party Integrations</h3>
<p>Certain services may require integration with third-party platforms, such as APIs for financial transactions. These platforms may access specific data as required for the service and are governed by their own privacy policies.</p>
<h3>c. Legal Compliance</h3>
<p>We may disclose your information to comply with legal obligations, enforce our Terms of Use, or protect our rights or users&rsquo; rights.</p>

<h2>4. Data Security</h2>
<p>We use industry-standard measures to safeguard your information, including secure servers and encryption technologies. However, no system is entirely secure, and we cannot guarantee absolute protection against unauthorized access.</p>

<h2>5. Your Rights</h2>
<p>You have the following rights regarding your personal information:</p>
<h3>a. Access and Portability</h3>
<p>You can access most of your information by logging into your account. For additional information or to request a portable copy of your data, contact our Privacy Officer.</p>
<h3>b. Correction</h3>
<p>You can update your personal information via your account settings or by contacting our customer support team.</p>
<h3>c. Opt-Out</h3>
<p>You can opt-out of receiving promotional communications by following the instructions in our communications or updating your account preferences.</p>

<h2>6. Retention of Information</h2>
<p>We retain your information only for as long as necessary to fulfil the purposes outlined in this Privacy Policy, comply with legal obligations, resolve disputes, and enforce our agreements.</p>

<h2>7. Changes to This Privacy Policy</h2>
<p>We may update this Privacy Policy from time to time to reflect changes in our practices or legal requirements. Changes will be posted on our Platform, and we encourage you to review the policy periodically.</p>

<h2>8. Cookies and Web Statistics</h2>
<p>We use cookies and similar technologies to analyse Platform usage and improve our services. These files do not identify personal information directly but help us understand user behavior.</p>

<h2>Contact Us</h2>
<p>If you have any questions, concerns, or complaints about our Privacy Policy or data practices, please contact us:</p>
<p><strong>Privacy Officer / Data Protection Officer (DPO)</strong><br>
AOne Dev Mantra Financial Services Pvt Ltd<br>
Email: <a href="mailto:support@devmantra.com">support@devmantra.com</a></p>
<p>We strive to address complaints promptly and informally. For formal complaints, please submit them in writing, and we will acknowledge receipt within 10 business days.</p>
HTML;

        PageSection::create([
            'page_id'      => $page->id,
            'section_type' => 'page-rich-content',
            'section_data' => ['content' => $html],
            'sort_order'   => 1,
            'is_active'    => true,
        ]);
    }
}
