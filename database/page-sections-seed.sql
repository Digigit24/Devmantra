-- =============================================================================
-- DevMantra — Page Sections Seed
-- Run this in phpMyAdmin or MySQL CLI: source page-sections-seed.sql
-- =============================================================================

SET @home_id  = (SELECT id FROM pages WHERE name = 'home'  LIMIT 1);
SET @about_id = (SELECT id FROM pages WHERE name = 'about' LIMIT 1);

-- ─── Verify pages exist ───────────────────────────────────────────────────────
SELECT IF(@home_id  IS NULL, 'ERROR: home page not found',  CONCAT('Home page id = ',  @home_id))  AS home_check;
SELECT IF(@about_id IS NULL, 'ERROR: about page not found', CONCAT('About page id = ', @about_id)) AS about_check;

-- =============================================================================
-- HOMEPAGE — wipe existing sections and rebuild
-- =============================================================================
DELETE FROM page_sections WHERE page_id = @home_id;

INSERT INTO page_sections (page_id, section_type, section_data, sort_order, is_active, created_at, updated_at) VALUES

(@home_id, 'page-hero', JSON_OBJECT(
    'subtitle', 'Commitment to Your Financial Success',
    'title', 'Unleash the Power of\neXcellence Beyond Numbers',
    'description', 'At Dev Mantra, the pinnacle of global financial services, we are driven by a commitment to excellence, integrity, and innovation.',
    'cta_text', 'Book a Free Consultation',
    'cta_url', '#',
    'secondary_button_link', ''
), 0, 1, NOW(), NOW()),

(@home_id, 'page-what-we-do', JSON_OBJECT(
    'title', 'What We Do',
    'subtitle', 'Comprehensive financial and advisory services tailored for your business growth.'
), 1, 1, NOW(), NOW()),

(@home_id, 'page-clientele', JSON_OBJECT(
    'clientele_title', 'Our Clientele',
    'features_label', 'What We Do',
    'features_title', 'Services to Boost Business Growth',
    'features_description', 'We know navigating financial documentation and regulations can be challenging. Rest easy our expert guidance in financial planning and risk management is designed to enhance your performance and ensure lasting success.'
), 2, 1, NOW(), NOW()),

(@home_id, 'page-strategy-6a', JSON_OBJECT(
    'label', 'Our Framework',
    'title', 'The 6A Strategy Framework',
    'subtitle', 'A proven, structured approach that guides businesses from assessment to transformation — at every stage of growth.'
), 3, 1, NOW(), NOW()),

(@home_id, 'page-ai-platform', JSON_OBJECT(
    'subtitle', 'Technology at the Core',
    'title', 'AI-Enabled Financial Platform'
), 4, 1, NOW(), NOW()),

(@home_id, 'page-world-map', JSON_OBJECT(
    'title', 'Countries that we serve',
    'subtitle', 'We work with clients across the globe, delivering solutions without borders.'
), 5, 1, NOW(), NOW()),

(@home_id, 'page-commitment-grid', JSON_OBJECT(
    'label', 'Our Commitment',
    'title', 'Our Commitment to Your Financial Success',
    'description', 'Dev Mantra is a strategic partner in progress for businesses operating in a global and digital economy'
), 6, 1, NOW(), NOW()),

(@home_id, 'page-team', JSON_OBJECT(
    'title', 'Meet Our Team',
    'subtitle', 'The people behind Devmantra who drive excellence every day.',
    'founders', JSON_ARRAY(
        JSON_OBJECT('name','Vikash Tatia','role','Founder & MD','photo','assets/img/team/6.png'),
        JSON_OBJECT('name','Nidhi Tatia','role','Founder & Director','photo','assets/img/team/7.png')
    ),
    'partners', JSON_ARRAY(
        JSON_OBJECT('name','Sankaranarayanan','role','Director & Associate Partner','photo','assets/img/team/8.png'),
        JSON_OBJECT('name','Kamal Parakh','role','Associate Director & Senior Partner','photo','assets/img/team/9.png'),
        JSON_OBJECT('name','Darshit Bombaywala','role','Associate Partner','photo','assets/img/team/10.png'),
        JSON_OBJECT('name','Pawan Bhotika','role','Advisor - Agri Business','photo','assets/img/team/11.png'),
        JSON_OBJECT('name','BC Datta','role','Associate Director - Corporate Affairs','photo','assets/img/team/12.png')
    ),
    'team_members', JSON_ARRAY(
        JSON_OBJECT('name','Abhinaya U','role','Associate - Investment Banking','photo','assets/img/team/1.png'),
        JSON_OBJECT('name','Sandeep Dhupar','role','Associate Director','photo','assets/img/team/2.png'),
        JSON_OBJECT('name','Jalandhar Behera','role','Associate VP - FAO Services','photo','assets/img/team/3.png'),
        JSON_OBJECT('name','Rajani M','role','Talent Acquisition Lead','photo','assets/img/team/4.png'),
        JSON_OBJECT('name','Namrata Parakh','role','Associate - Intl Relations','photo','assets/img/team/5.png')
    )
), 7, 1, NOW(), NOW()),
 
(@home_id, 'page-approach-lifecycle', JSON_OBJECT(
    'label', 'How We Work',
    'title', 'Our Approach & Business Lifecycle',
    'subtitle', 'Building long-term relationships based on transparency, technical excellence, and measurable value creation.'
), 8, 1, NOW(), NOW()),

(@home_id, 'page-testimonials', JSON_OBJECT(
    'rating', '4.8',
    'label', 'Client Success Stories',
    'title', 'Join the ranks of our satisfied clients and experience the Dev Mantra difference.'
), 9, 1, NOW(), NOW()),

(@home_id, 'page-blogs', JSON_OBJECT(
    'subtitle', 'Insights',
    'title', 'Explore our\nlatest insights & updates',
    'count', '3',
    'explore_link_text', 'Explore more insights from Dev Mantra',
    'explore_link_url', '/blog'
), 10, 1, NOW(), NOW()),

(@home_id, 'page-cta', JSON_OBJECT(
    'title', 'Ready to Elevate Your\nBusiness with Dev Mantra?',
    'subtitle', 'Dev Mantra is here to help you scale with confidence through future-ready financial, governance, and advisory solutions.'
), 11, 1, NOW(), NOW());

-- =============================================================================
-- ABOUT US — wipe existing sections and rebuild (with team + shared CTA)
-- =============================================================================
DELETE FROM page_sections WHERE page_id = @about_id;

INSERT INTO page_sections (page_id, section_type, section_data, sort_order, is_active, created_at, updated_at) VALUES

(@about_id, 'about-hero', JSON_OBJECT(
    'subtitle', 'About Dev Mantra',
    'title', 'Strategic Partner in Progress for Global Businesses',
    'description', 'Founded in 2008, Dev Mantra is a Bengaluru-based financial services company empowering businesses across the globe with excellence, integrity, and innovation.'
), 0, 1, NOW(), NOW()),

(@about_id, 'about-intro', JSON_OBJECT(
    'label', 'Who We Are',
    'title', 'Unleash the Power of eXcellence Beyond Numbers',
    'paragraphs', JSON_ARRAY(
        'At Dev Mantra, the pinnacle of global financial services, we are driven by a commitment to excellence, integrity, and innovation. We specialize in outsourced accounting, bookkeeping, financial reporting, virtual CFO services, audit support, compliance solutions, and M&A Services.',
        'With a structured delivery model and trained finance professionals, Dev Mantra supports clients across industries with accuracy, efficiency, and data security at its core. With over ₹5,000 crore (~USD 558 million) in transactions and 150+ years of combined leadership experience, we bring deep expertise to every engagement.',
        'N. Tatia & Associates, our professionally managed, peer-reviewed firm offers assurance, taxation, and advisory services. Known for its partner-driven approach, compliance expertise, and strong governance framework — ensuring every client engagement adheres to the highest professional standards.'
    )
), 1, 1, NOW(), NOW()),

(@about_id, 'about-mission-vision', JSON_OBJECT(
    'mission_title', 'Our Mission',
    'mission_text', 'To empower businesses across the globe by providing comprehensive financial and management consulting services that drive growth, ensure compliance, and enhance operational efficiency.',
    'vision_title', 'Our Vision',
    'vision_text', 'To be a trusted global financial services partner for CPA firms and businesses seeking reliability, expertise, and scalable support.'
), 2, 1, NOW(), NOW()),

(@about_id, 'about-values', JSON_OBJECT(
    'label', 'What Drives Us',
    'title', 'Our Values',
    'items', JSON_ARRAY(
        JSON_OBJECT('icon','1','title','Trust','description','We build strong, lasting relationships with our clients based on mutual trust and respect.'),
        JSON_OBJECT('icon','2','title','Transparency','description','We maintain open and honest communication, ensuring our clients are fully informed and confident in their financial decisions.'),
        JSON_OBJECT('icon','3','title','Integrity','description','We uphold the highest ethical standards in all our dealings, ensuring fairness and honesty.'),
        JSON_OBJECT('icon','4','title','Tech Integration','description','We leverage the latest technology to provide innovative solutions that enhance efficiency, accuracy, and convenience.'),
        JSON_OBJECT('icon','5','title','Excellence','description','We are committed to delivering the highest quality services and continuously improving our processes.'),
        JSON_OBJECT('icon','6','title','Client-Centric Approach','description','We prioritize the needs and goals of our clients, offering tailored solutions that align with their unique requirements.')
    )
), 3, 1, NOW(), NOW()),

(@about_id, 'about-services-overview', JSON_OBJECT(
    'label', 'What We Do',
    'title', 'Our Expertise'
), 4, 1, NOW(), NOW()),

(@about_id, 'page-team', JSON_OBJECT(
    'title', 'Meet Our Team',
    'subtitle', 'The people behind Devmantra who drive excellence every day.',
    'founders', JSON_ARRAY(
        JSON_OBJECT('name','Vikash Tatia','role','Founder & MD','photo','assets/img/team/6.jpg'),
        JSON_OBJECT('name','Nidhi Tatia','role','Founder & Director','photo','assets/img/team/7.jpg')
    ),
    'partners', JSON_ARRAY(
        JSON_OBJECT('name','Sankaranarayanan','role','Director & Associate Partner','photo','assets/img/team/8.png'),
        JSON_OBJECT('name','Kamal Parakh','role','Associate Director & Senior Partner','photo','assets/img/team/9.png'),
        JSON_OBJECT('name','Darshit Bombaywala','role','Associate Partner','photo','assets/img/team/10.png'),
        JSON_OBJECT('name','Pawan Bhotika','role','Advisor - Agri Business','photo','assets/img/team/11.png'),
        JSON_OBJECT('name','BC Datta','role','Associate Director - Corporate Affairs','photo','assets/img/team/12.png')
    ),
    'team_members', JSON_ARRAY(
        JSON_OBJECT('name','Abhinaya U','role','Associate - Investment Banking','photo','assets/img/team/1.png'),
        JSON_OBJECT('name','Sandeep Dhupar','role','Associate Director','photo','assets/img/team/2.png'),
        JSON_OBJECT('name','Jalandhar Behera','role','Associate VP - FAO Services','photo','assets/img/team/3.png'),
        JSON_OBJECT('name','Rajani M','role','Talent Acquisition Lead','photo','assets/img/team/4.png'),
        JSON_OBJECT('name','Namrata Parakh','role','Associate - Intl Relations','photo','assets/img/team/5.png')
    )
), 5, 1, NOW(), NOW()),

(@about_id, 'page-cta', JSON_OBJECT(
    'title', 'Ready to Transform\nYour Business?',
    'subtitle', "Let's discuss how Dev Mantra can help you achieve your financial goals."
), 6, 1, NOW(), NOW());

-- =============================================================================
-- Done! Verify:
-- =============================================================================
SELECT p.name AS page, ps.section_type, ps.sort_order, ps.is_active
FROM page_sections ps
JOIN pages p ON p.id = ps.page_id
ORDER BY p.name, ps.sort_order;
