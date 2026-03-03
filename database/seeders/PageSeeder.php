<?php

namespace Database\Seeders;

use App\Models\Page;
use App\Models\PageSection;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    public function run(): void
    {
        // ── Homepage ──────────────────────────────────────────────────────
        $home = Page::firstOrCreate(['name' => 'home'], ['title' => 'Homepage']);
        PageSection::where('page_id', $home->id)->delete();

        $homeSections = [
            ['section_type' => 'page-hero', 'sort_order' => 0, 'section_data' => [
                'subtitle'              => 'Commitment to Your Financial Success',
                'title'                 => "Unleash the Power of\neXcellence Beyond Numbers",
                'description'           => 'At Dev Mantra, the pinnacle of global financial services, we are driven by a commitment to excellence, integrity, and innovation.',
                'cta_text'              => 'Book a Free Consultation',
                'cta_url'               => '#',
                'secondary_button_link' => '',
            ]],
            ['section_type' => 'page-what-we-do', 'sort_order' => 1, 'section_data' => [
                'title'    => 'What We Do',
                'subtitle' => 'Comprehensive financial and advisory services tailored for your business growth.',
            ]],
            ['section_type' => 'page-clientele', 'sort_order' => 2, 'section_data' => [
                'clientele_title'  => 'Our Clientele',
                'features_label'   => 'What We Do',
                'features_title'   => 'Services to Boost Business Growth',
                'features_description' => 'We know navigating financial documentation and regulations can be challenging. Rest easy our expert guidance in financial planning and risk management is designed to enhance your performance and ensure lasting success.',
            ]],
            ['section_type' => 'page-strategy-6a', 'sort_order' => 3, 'section_data' => [
                'label'    => 'Our Framework',
                'title'    => 'The 6A Strategy Framework',
                'subtitle' => 'A proven, structured approach that guides businesses from assessment to transformation — at every stage of growth.',
            ]],
            ['section_type' => 'page-ai-platform', 'sort_order' => 4, 'section_data' => [
                'subtitle' => 'Technology at the Core',
                'title'    => 'AI-Enabled Financial Platform',
            ]],
            ['section_type' => 'page-world-map', 'sort_order' => 5, 'section_data' => [
                'title'    => 'Countries that we serve',
                'subtitle' => 'We work with clients across the globe, delivering solutions without borders.',
            ]],
            ['section_type' => 'page-commitment-grid', 'sort_order' => 6, 'section_data' => [
                'label'       => 'Our Commitment',
                'title'       => 'Our Commitment to Your Financial Success',
                'description' => 'Dev Mantra is a strategic partner in progress for businesses operating in a global and digital economy',
            ]],
            ['section_type' => 'page-team', 'sort_order' => 7, 'section_data' => [
                'title'    => 'Meet Our Team',
                'subtitle' => 'The people behind Devmantra who drive excellence every day.',
            ]],
            ['section_type' => 'page-approach-lifecycle', 'sort_order' => 8, 'section_data' => [
                'label'    => 'How We Work',
                'title'    => 'Our Approach & Business Lifecycle',
                'subtitle' => 'Building long-term relationships based on transparency, technical excellence, and measurable value creation.',
            ]],
            ['section_type' => 'page-testimonials', 'sort_order' => 9, 'section_data' => [
                'rating' => '4.8',
                'label'  => 'Client Success Stories',
                'title'  => 'Join the ranks of our satisfied clients and experience the Dev Mantra difference.',
            ]],
        ];

        foreach ($homeSections as $s) {
            PageSection::create(array_merge($s, ['page_id' => $home->id, 'is_active' => true]));
        }

        // ── About Us ──────────────────────────────────────────────────────
        $about = Page::firstOrCreate(['name' => 'about'], ['title' => 'About Us']);
        PageSection::where('page_id', $about->id)->delete();

        $aboutSections = [
            ['section_type' => 'about-hero', 'sort_order' => 0, 'section_data' => [
                'subtitle'    => 'About Dev Mantra',
                'title'       => 'Strategic Partner in Progress for Global Businesses',
                'description' => 'Founded in 2008, Dev Mantra is a Bengaluru-based financial services company empowering businesses across the globe with excellence, integrity, and innovation.',
            ]],
            ['section_type' => 'about-intro', 'sort_order' => 1, 'section_data' => [
                'label' => 'Who We Are',
                'title' => 'Unleash the Power of eXcellence Beyond Numbers',
                'paragraphs' => [
                    'At Dev Mantra, the pinnacle of global financial services, we are driven by a commitment to excellence, integrity, and innovation. We specialize in outsourced accounting, bookkeeping, financial reporting, virtual CFO services, audit support, compliance solutions, and M&A Services.',
                    'With a structured delivery model and trained finance professionals, Dev Mantra supports clients across industries with accuracy, efficiency, and data security at its core. With over ₹5,000 crore (~USD 558 million) in transactions and 150+ years of combined leadership experience, we bring deep expertise to every engagement.',
                    'N. Tatia & Associates, our professionally managed, peer-reviewed firm offers assurance, taxation, and advisory services. Known for its partner-driven approach, compliance expertise, and strong governance framework — ensuring every client engagement adheres to the highest professional standards.',
                ],
            ]],
            ['section_type' => 'about-mission-vision', 'sort_order' => 2, 'section_data' => [
                'mission_title' => 'Our Mission',
                'mission_text'  => 'To empower businesses across the globe by providing comprehensive financial and management consulting services that drive growth, ensure compliance, and enhance operational efficiency. We strive to build lasting relationships with our clients based on trust, transparency, and a deep understanding of their unique needs.',
                'vision_title'  => 'Our Vision',
                'vision_text'   => 'To be a trusted global financial services partner for CPA firms and businesses seeking reliability, expertise, and scalable support. Guided by core values of trust, transparency, and professionalism, our client-first approach and local insight help us deliver consistent value and long-term impact.',
            ]],
            ['section_type' => 'about-values', 'sort_order' => 3, 'section_data' => [
                'label' => 'What Drives Us',
                'title' => 'Our Values',
                'items' => [
                    ['icon' => '1', 'title' => 'Trust',              'description' => 'We build strong, lasting relationships with our clients based on mutual trust and respect. Our commitment to integrity ensures that we always act in the best interest of our clients.'],
                    ['icon' => '2', 'title' => 'Transparency',       'description' => 'We maintain open and honest communication, ensuring our clients are fully informed and confident in their financial decisions.'],
                    ['icon' => '3', 'title' => 'Integrity',          'description' => 'We uphold the highest ethical standards in all our dealings, ensuring fairness and honesty. Integrity is the foundation of our practice, guiding our actions and decisions.'],
                    ['icon' => '4', 'title' => 'Tech Integration',   'description' => 'We leverage the latest technology to provide innovative solutions that enhance efficiency, accuracy, and convenience for our clients.'],
                    ['icon' => '5', 'title' => 'Excellence',         'description' => 'We are committed to delivering the highest quality services and continuously improving our processes. Our dedication to excellence drives us to exceed client expectations.'],
                    ['icon' => '6', 'title' => 'Client-Centric Approach', 'description' => 'We prioritize the needs and goals of our clients, offering tailored solutions that align with their unique requirements.'],
                ],
            ]],
            ['section_type' => 'about-services-overview', 'sort_order' => 4, 'section_data' => [
                'label' => 'What We Do',
                'title' => 'Our Expertise',
            ]],
            ['section_type' => 'about-cta', 'sort_order' => 5, 'section_data' => [
                'title'    => 'Ready to Transform Your Business?',
                'subtitle' => "Let's discuss how Dev Mantra can help you achieve your financial goals.",
                'cta_text' => 'Book a Free Consultation',
                'cta_url'  => '/contact',
            ]],
        ];

        foreach ($aboutSections as $s) {
            PageSection::create(array_merge($s, ['page_id' => $about->id, 'is_active' => true]));
        }
    }
}
