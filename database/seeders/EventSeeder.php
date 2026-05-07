<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\EventImage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Carbon\Carbon;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        $events = [
            [
                'title' => 'Celebrating a Milestone: CA Nidhi Tatia Honoured as Best Women Achiever by FKCCI',
                'slug' => 'celebrating-a-milestone-ca-nidhi-tatia-honoured-as-best-women-achiever-by-fkcci',
                'description' => 'Today, we at AOne Dev Mantra Financial Services Pvt. Ltd. are proud to celebrate a remarkable achievement. Our Founder Director, CA Nidhi Tatia, has been recognised by the Federation of Karnataka Chambers of Commerce & Industry (FKCCI) - a 109-year-old institution - as a Best Women Achiever, for her outstanding contributions to finance, strategy, entrepreneurship, and leadership. From founding N Tatia & Associates in 2005, building it into a trusted, peer-reviewed CA firm… to co-founding DevMantra, specialising in M&A, deal structuring, and due diligence… to launching Optymoney, a technology platform for personal finance… to mentoring entrepreneurs through the Stanford India Seed Program. CA Nidhi Tatia exemplifies dedication, clarity, compassion, and courage. A mother of two, a mentor to many, and a leader who inspires those around her, this recognition is a testament not only to her achievements but to her lasting impact.',
                'featured_image' => 'https://www.devmantra.com/wp-content/uploads/2024/09/1724309737995-1.jpeg',
                'meta_description' => 'Today, we at AOne Dev Mantra Financial Services Pvt. Ltd. are proud to celebrate a remarkable achievement. Our Founder Director, CA Nidhi Tatia, has been...',
                'status' => 'published',
                'published_at' => Carbon::now()->subDays(6),
                'images' => [
                    
                    'https://www.devmantra.com/wp-content/uploads/2024/09/IMG_6738.png',
                    'https://www.devmantra.com/wp-content/uploads/2024/09/Rajashthan-Patrika-mysuru-recognition.jpeg',
                    'https://www.devmantra.com/wp-content/uploads/2024/09/Twitter-post.jpeg',
                    'https://www.devmantra.com/wp-content/uploads/2024/09/WhatsApp-Image-2024-03-12-at-15.48.57_c3c00e2f.jpg',
                    'https://www.devmantra.com/wp-content/uploads/2024/09/WhatsApp-Image-2024-09-15-at-15.30.52_0fca5e68.jpg',
                    'https://www.devmantra.com/wp-content/uploads/2024/09/WhatsApp-Image-2024-09-15-at-15.30.55_52643c62.jpg',
                    'https://www.devmantra.com/wp-content/uploads/2024/09/WhatsApp-Image-2024-09-15-at-15.30.55_daa9f3f8.jpg',
                    'https://www.devmantra.com/wp-content/uploads/2024/09/WhatsApp-Image-2024-09-15-at-15.30.56_a3f08227.jpg',
                    'https://www.devmantra.com/wp-content/uploads/2024/09/WhatsApp-Image-2024-09-15-at-15.30.58_a4edbd23.jpg',
                    'https://www.devmantra.com/wp-content/uploads/2024/09/WhatsApp-Image-2024-09-15-at-15.30.59_ea76501d.jpg',
                    'https://www.devmantra.com/wp-content/uploads/2024/09/WhatsApp-Image-2024-09-15-at-15.31.02_169e28cd.jpg',
                ],
            ],
            [
                'title' => 'A One Dev Mantra in the News',
                'slug' => 'a-one-dev-mantra-in-the-news',
                'description' => 'Dev Mantra has consistently made headlines for its contributions to the finance and consulting industry. Our innovative solutions, expert insights, and community involvement have been featured in leading publications and media outlets. Whether it\'s news on our latest achievements or interviews with our thought leaders, our presence in the news highlights our commitment to driving industry innovation.',
                'featured_image' => 'https://www.devmantra.com/wp-content/uploads/2024/09/1724309737995-1.jpeg',
                'meta_description' => 'Dev Mantra has consistently made headlines for its contributions to the finance and consulting industry. Our innovative solutions, expert insights, and...',
                'status' => 'published',
                'published_at' => Carbon::now()->subDays(5),
                'images' => [
                    
                    'https://www.devmantra.com/wp-content/uploads/2024/09/IMG_6738.png',
                    'https://www.devmantra.com/wp-content/uploads/2024/09/Rajashthan-Patrika-mysuru-recognition.jpeg',
                    'https://www.devmantra.com/wp-content/uploads/2024/09/Twitter-post.jpeg',
                    'https://www.devmantra.com/wp-content/uploads/2024/09/WhatsApp-Image-2024-03-12-at-15.48.57_c3c00e2f.jpg',
                    'https://www.devmantra.com/wp-content/uploads/2024/09/WhatsApp-Image-2024-09-15-at-15.30.52_0fca5e68.jpg',
                    'https://www.devmantra.com/wp-content/uploads/2024/09/WhatsApp-Image-2024-09-15-at-15.30.55_52643c62.jpg',
                    'https://www.devmantra.com/wp-content/uploads/2024/09/WhatsApp-Image-2024-09-15-at-15.30.55_daa9f3f8.jpg',
                    'https://www.devmantra.com/wp-content/uploads/2024/09/WhatsApp-Image-2024-09-15-at-15.30.56_a3f08227.jpg',
                    'https://www.devmantra.com/wp-content/uploads/2024/09/WhatsApp-Image-2024-09-15-at-15.30.58_a4edbd23.jpg',
                    'https://www.devmantra.com/wp-content/uploads/2024/09/WhatsApp-Image-2024-09-15-at-15.30.59_ea76501d.jpg',
                    'https://www.devmantra.com/wp-content/uploads/2024/09/WhatsApp-Image-2024-09-15-at-15.31.02_169e28cd.jpg',
                ],
            ],
            [
                'title' => 'A-One Dev Mantra Recognition at Various Events',
                'slug' => 'a-one-dev-mantra-recognition-at-various-events',
                'description' => 'At Dev Mantra, we believe in giving back to the community. Our team actively participates in local and national initiatives aimed at uplifting and supporting various causes. From educational workshops to charity drives, our community engagement efforts are designed to create a meaningful impact while fostering connections. We are committed to being a force for good, leveraging our expertise to make a positive difference.',
                'featured_image' => 'https://www.devmantra.com/wp-content/uploads/2025/03/WhatsApp-Image-2025-03-03-at-1.20.23-PM.jpeg',
                'meta_description' => 'At Dev Mantra, we believe in giving back to the community. Our team actively participates in local and national initiatives aimed at uplifting and...',
                'status' => 'published',
                'published_at' => Carbon::now()->subDays(4),
                'images' => [
                   
                    'https://www.devmantra.com/wp-content/uploads/2024/09/Advance-Tax-event-RSVP.jpg',
                    'https://www.devmantra.com/wp-content/uploads/2024/09/C-Camp-Flyer.jpg',
                    'https://www.devmantra.com/wp-content/uploads/2024/09/CA.-Nidhi-Tatia.jpg',
                    'https://www.devmantra.com/wp-content/uploads/2024/09/Decoding-economic-schemes-post.png',
                    'https://www.devmantra.com/wp-content/uploads/2024/09/Event-Invite-CWE-NT.jpg',
                    'https://www.devmantra.com/wp-content/uploads/2024/09/Flyer-event-22-17-58-55.jpg',
                    'https://www.devmantra.com/wp-content/uploads/2024/09/ICAI-MSME-event-Siliguri.jpeg',
                    'https://www.devmantra.com/wp-content/uploads/2024/09/International-MSME-Day-2020-EIRC.jpg',
                    'https://www.devmantra.com/wp-content/uploads/2024/09/WhatsApp-Image-2024-09-15-at-16.15.50_7a3b2c4c.jpg',
                    'https://www.devmantra.com/wp-content/uploads/2024/09/ISBA-Meet.jpg',
                    'https://www.devmantra.com/wp-content/uploads/2024/09/ITC-SheTrades-India-Launch-2024-1.jpg',
                    'https://www.devmantra.com/wp-content/uploads/2024/09/MSME-Conclave.jpg',
                    'https://www.devmantra.com/wp-content/uploads/2024/09/WhatsApp-Image-2022-12-08-at-6.30.39-PM.jpeg',
                    'https://www.devmantra.com/wp-content/uploads/2024/09/WhatsApp-Image-2024-09-15-at-15.59.58_5dfec64f.jpg',
                    'https://www.devmantra.com/wp-content/uploads/2024/09/PHOTO-2021-07-12-11-17-24.jpg',
                    'https://www.devmantra.com/wp-content/uploads/2024/09/StartUp-MSME-flyer-ICAI.jpg',
                    'https://www.devmantra.com/wp-content/uploads/2024/09/WhatsApp-Image-2024-09-15-at-15.30.52_832e3f3e.jpg',
                    'https://www.devmantra.com/wp-content/uploads/2024/09/Ramaiya-Institution-Budget-Presentation_page-0001.jpg',
                ],
            ],
            [
                'title' => 'Events on Finance by Dev Mantra',
                'slug' => 'events-on-finance-by-dev-mantra',
                'description' => 'Dev Mantra hosts and participates in various finance-related events, offering insights into the latest industry trends and developments. These events provide a platform for networking, knowledge sharing, and discussing innovative financial solutions. Our team of experts shares their expertise on topics such as financial consulting, investment strategies, and risk management, helping businesses stay ahead in today\'s competitive market.',
                'featured_image' => 'https://www.devmantra.com/wp-content/uploads/2024/09/PHOTO-2021-07-12-11-17-24.jpg',
                'meta_description' => 'Dev Mantra hosts and participates in various finance-related events, offering insights into the latest industry trends and developments. These events...',
                'status' => 'published',
                'published_at' => Carbon::now()->subDays(3),
                'images' => [
                    
                    'https://www.devmantra.com/wp-content/uploads/2024/09/StartUp-MSME-flyer-ICAI.jpg',
                    'https://www.devmantra.com/wp-content/uploads/2024/09/WhatsApp-Image-2024-09-15-at-15.30.52_832e3f3e.jpg',
                    'https://www.devmantra.com/wp-content/uploads/2024/09/Ramaiya-Institution-Budget-Presentation_page-0001.jpg',
                    'https://www.devmantra.com/wp-content/uploads/2024/09/2018-04-13-PHOTO-00000048.jpg',
                    'https://www.devmantra.com/wp-content/uploads/2024/09/GIZ-meeting-April_18.jpg',
                    'https://www.devmantra.com/wp-content/uploads/2024/09/IMG_1516-scaled.jpg',
                    'https://www.devmantra.com/wp-content/uploads/2024/09/11952934_858488954247500_5811743454462518289_o.jpg',
                    'https://www.devmantra.com/wp-content/uploads/2024/09/Ginserv-recognition.jpg',
                    'https://www.devmantra.com/wp-content/uploads/2024/09/abd5da3b-b704-4713-aad6-319fce736020.jpg',
                    'https://www.devmantra.com/wp-content/uploads/2024/09/ABBS-student.jpg',
                    'https://www.devmantra.com/wp-content/uploads/2024/09/IMG_3432-scaled.jpg',
                    'https://www.devmantra.com/wp-content/uploads/2024/09/IMG_5166.jpg',
                    'https://www.devmantra.com/wp-content/uploads/2024/09/IMG_5327.jpg',
                    'https://www.devmantra.com/wp-content/uploads/2024/09/IMG_7029.jpg',
                    'https://www.devmantra.com/wp-content/uploads/2024/09/JIIF-Training-StartUp.jpg',
                    'https://www.devmantra.com/wp-content/uploads/2024/09/ITC-SheTrades-India-Launch-2024-2.jpg',
                    'https://www.devmantra.com/wp-content/uploads/2024/09/Indus-Business-Academy.jpg',
                    'https://www.devmantra.com/wp-content/uploads/2024/09/IMG-20171011-WA0017.jpg',
                    'https://www.devmantra.com/wp-content/uploads/2024/09/IMG_7105.jpg',
                    'https://www.devmantra.com/wp-content/uploads/2024/09/PHOTO-2016-11-15-11-40-11.jpg',
                    'https://www.devmantra.com/wp-content/uploads/2024/09/PHOTO-2016-12-02-15-00-59.jpg',
                    'https://www.devmantra.com/wp-content/uploads/2024/09/PHOTO-2017-10-09-15-06-08.jpg',
                    'https://www.devmantra.com/wp-content/uploads/2024/09/PHOTO-2017-10-12-03-56-07.jpg',
                    'https://www.devmantra.com/wp-content/uploads/2024/09/PHOTO-2017-10-12-10-02-02.jpg',
                    'https://www.devmantra.com/wp-content/uploads/2024/09/WhatsApp-Image-2024-07-06-at-09.41.53_10d3cdbc.jpg',
                    'https://www.devmantra.com/wp-content/uploads/2024/09/WhatsApp-Image-2023-11-24-at-19.10.11_d9ce83a0.jpg',
                    'https://www.devmantra.com/wp-content/uploads/2024/09/PHOTO-2018-11-05-14-40-22.jpg',
                    'https://www.devmantra.com/wp-content/uploads/2024/09/PHOTO-2018-11-05-14-12-59.jpg',
                    'https://www.devmantra.com/wp-content/uploads/2024/09/PHOTO-2017-12-16-00-35-13.jpg',
                    'https://www.devmantra.com/wp-content/uploads/2024/09/WhatsApp-Image-2024-09-15-at-15.30.46_b347e569.jpg',
                    'https://www.devmantra.com/wp-content/uploads/2024/09/WhatsApp-Image-2024-09-15-at-15.30.47_c49f0880.jpg',
                    'https://www.devmantra.com/wp-content/uploads/2024/09/WhatsApp-Image-2024-09-15-at-15.30.52_a99869ed.jpg',
                    'https://www.devmantra.com/wp-content/uploads/2024/09/WhatsApp-Image-2024-09-15-at-15.30.54_8fd5c65d.jpg',
                    'https://www.devmantra.com/wp-content/uploads/2024/09/WhatsApp-Image-2024-09-15-at-15.30.54_520a821e.jpg',
                    'https://www.devmantra.com/wp-content/uploads/2024/09/WhatsApp-Image-2024-09-15-at-16.15.51_a813896b.jpg',
                    'https://www.devmantra.com/wp-content/uploads/2024/09/WhatsApp-Image-2024-09-15-at-16.14.53_908720f7.jpg',
                    'https://www.devmantra.com/wp-content/uploads/2024/09/WhatsApp-Image-2024-09-15-at-15.31.02_ec8e6d75.jpg',
                    'https://www.devmantra.com/wp-content/uploads/2024/09/WhatsApp-Image-2024-09-15-at-15.31.01_cf53a487.jpg',
                    'https://www.devmantra.com/wp-content/uploads/2024/09/WhatsApp-Image-2024-09-15-at-15.30.59_020914c5.jpg',
                ],
            ],
            [
                'title' => 'Team Engagement Activities',
                'slug' => 'team-engagement-activities',
                'description' => 'At Dev Mantra, we believe that a strong team is the foundation of success. Our team engagement activities are designed to foster collaboration, creativity, and camaraderie among our employees. From team-building exercises to social events, we create opportunities for our team members to connect, recharge, and strengthen their bonds, ensuring a positive and dynamic workplace culture.',
                'featured_image' => 'https://www.devmantra.com/wp-content/uploads/2024/09/Fun-Time-Mango-Mist-12Aug_23.jpg',
                'meta_description' => 'At Dev Mantra, we believe that a strong team is the foundation of success. Our team engagement activities are designed to foster collaboration, creativity,...',
                'status' => 'published',
                'published_at' => Carbon::now()->subDays(2),
                'images' => [
                    
                    'https://www.devmantra.com/wp-content/uploads/2024/09/ICE_4305-scaled.jpg',
                    'https://www.devmantra.com/wp-content/uploads/2024/09/Office-event.jpg',
                    'https://www.devmantra.com/wp-content/uploads/2024/09/Team-Meet-scaled.jpg',
                    'https://www.devmantra.com/wp-content/uploads/2024/09/Team-recognition.jpg',
                    'https://www.devmantra.com/wp-content/uploads/2024/09/WhatsApp-Image-2023-08-31-at-15.34.48_e39e3cd1.jpg',
                    'https://www.devmantra.com/wp-content/uploads/2024/09/WhatsApp-Image-2023-10-05-at-14.28.04_a8e27099.jpg',
                    'https://www.devmantra.com/wp-content/uploads/2024/09/WhatsApp-Image-2023-12-23-at-17.14.57_973e2aa1.jpg',
                    'https://www.devmantra.com/wp-content/uploads/2024/09/WhatsApp-Image-2023-12-23-at-17.17.31_ed845d26.jpg',
                    'https://www.devmantra.com/wp-content/uploads/2024/09/WhatsApp-Image-2024-02-29-at-13.45.47_740f38e5.jpg',
                    'https://www.devmantra.com/wp-content/uploads/2024/09/WhatsApp-Image-2024-02-29-at-19.25.50_8068ec18.jpg',
                    'https://www.devmantra.com/wp-content/uploads/2024/09/WhatsApp-Image-2024-02-29-at-19.31.59_db9188e7.jpg',
                    'https://www.devmantra.com/wp-content/uploads/2024/09/WhatsApp-Image-2024-03-23-at-12.05.21_5a3fa388.jpg',
                    'https://www.devmantra.com/wp-content/uploads/2024/09/WhatsApp-Image-2024-06-02-at-12.02.31_e5a266da.jpg',
                    'https://www.devmantra.com/wp-content/uploads/2024/09/WhatsApp-Image-2024-06-02-at-12.03.08_1787e780.jpg',
                    'https://www.devmantra.com/wp-content/uploads/2024/09/WhatsApp-Image-2024-07-15-at-20.42.51_18573fed.jpg',
                    'https://www.devmantra.com/wp-content/uploads/2024/09/WhatsApp-Image-2024-07-15-at-21.21.52_f71472ce.jpg',
                    'https://www.devmantra.com/wp-content/uploads/2024/09/WhatsApp-Image-2024-09-06-at-18.16.35_99dc463f.jpg',
                ],
            ],
            [
                'title' => 'Community Engagement by Dev Mantra Team',
                'slug' => 'community-engagement-by-dev-mantra-team',
                'description' => 'At Dev Mantra, we believe in giving back to the community. Our team actively participates in local and national initiatives aimed at uplifting and supporting various causes. From educational workshops to charity drives, our community engagement efforts are designed to create a meaningful impact while fostering connections. We are committed to being a force for good, leveraging our expertise to make a positive difference.',
                'featured_image' => 'https://www.devmantra.com/wp-content/uploads/2024/09/WhatsApp-Image-2023-10-01-at-13.02.52_fcf04569.jpg',
                'meta_description' => 'At Dev Mantra, we believe in giving back to the community. Our team actively participates in local and national initiatives aimed at uplifting and...',
                'status' => 'published',
                'published_at' => Carbon::now()->subDays(1),
                'images' => [
                   
                    'https://www.devmantra.com/wp-content/uploads/2024/09/WhatsApp-Image-2023-11-09-at-18.36.28_3441c0f8.jpg',
                    'https://www.devmantra.com/wp-content/uploads/2024/09/WhatsApp-Image-2023-11-09-at-18.38.33_3e0b539c.jpg',
                    'https://www.devmantra.com/wp-content/uploads/2024/09/WhatsApp-Image-2023-11-09-at-18.39.03_056b6065.jpg',
                    'https://www.devmantra.com/wp-content/uploads/2024/09/WhatsApp-Image-2023-11-09-at-18.39.38_11d212b4.jpg',
                    'https://www.devmantra.com/wp-content/uploads/2024/09/WhatsApp-Image-2024-09-15-at-15.30.49_487f2830.jpg',
                    'https://www.devmantra.com/wp-content/uploads/2024/09/WhatsApp-Image-2024-09-15-at-15.30.50_da0f10781.jpg',
                    'https://www.devmantra.com/wp-content/uploads/2024/09/WhatsApp-Image-2024-09-15-at-15.30.51_6e577d2c1.jpg',
                    'https://www.devmantra.com/wp-content/uploads/2024/09/WhatsApp-Image-2024-09-15-at-15.30.56_3808668f.jpg',
                    'https://www.devmantra.com/wp-content/uploads/2024/09/WhatsApp-Image-2024-09-15-at-15.30.57_1833428a.jpg',
                    'https://www.devmantra.com/wp-content/uploads/2024/09/WhatsApp-Image-2024-09-15-at-15.30.58_eecac3421.jpg',
                    'https://www.devmantra.com/wp-content/uploads/2024/09/WhatsApp-Image-2024-09-15-at-15.30.58_eecac342.jpg',
                    'https://www.devmantra.com/wp-content/uploads/2024/09/WhatsApp-Image-2024-09-15-at-15.59.56_fa072f261.jpg',
                    'https://www.devmantra.com/wp-content/uploads/2024/09/WhatsApp-Image-2024-09-15-at-15.59.58_47714e17.jpg',
                    'https://www.devmantra.com/wp-content/uploads/2024/09/WhatsApp-Image-2024-09-15-at-15.59.59_349830c3.jpg',
                    'https://www.devmantra.com/wp-content/uploads/2024/09/WhatsApp-Image-2024-09-15-at-15.59.59_ad1e8f3b.jpg',
                    'https://www.devmantra.com/wp-content/uploads/2024/09/WhatsApp-Image-2024-09-15-at-16.01.12_9667c259.jpg',
                    'https://www.devmantra.com/wp-content/uploads/2024/09/WhatsApp-Image-2024-09-15-at-16.04.11_d88b7cdf.jpg',
                    'https://www.devmantra.com/wp-content/uploads/2024/09/WhatsApp-Image-2024-09-15-at-16.04.11_d90ba114.jpg',
                    'https://www.devmantra.com/wp-content/uploads/2024/09/WhatsApp-Image-2024-09-15-at-16.23.29_44c8ea3b.jpg',
                ],
            ],
        ];

        foreach ($events as $eventData) {
            $images = $eventData['images'];
            unset($eventData['images']);

            $event = Event::create($eventData);

            foreach ($images as $index => $imagePath) {
                EventImage::create([
                    'event_id' => $event->id,
                    'image_path' => $imagePath,
                    'sort_order' => $index,
                ]);
            }
        }
    }
}