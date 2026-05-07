-- ============================================================
-- DevMantra Newsletters — Production Seed
-- 57 editions (1st Edition → 59th Edition)
-- Run via phpMyAdmin or mysql CLI
-- ============================================================

INSERT INTO `newsletters`
  (`title`, `slug`, `content`, `excerpt`, `edition_label`, `meta_description`, `status`, `published_at`, `created_at`, `updated_at`)
VALUES

-- Edition 1 (March 2021)
(
  'DevMantra Times: 6th March 21',
  'devmantra-times-6th-march-21',
  '<p>Regulatory Updates</p>\n<p>1. Opting-in for Composition Scheme for Financial year 2021-22 How to opt-in for Composition Scheme: The eligible registered taxpayers, who want to opt-in for composition scheme for the FY 2021-22, need to file FORM GST CMP-02 application, on or before 31st March, 2021, post login on GST portal.</p>\n<p>2. Classification of Taxpayers: Taxpayers are required to select their business activity only once, as Manufacturer, wholesaler / Distributor / Retailer, service providers &amp; others post login based on highest turnover amongst them. You can change the same later.</p>',
  'Regulatory Updates — Opting-in for Composition Scheme for Financial year 2021-22 and Classification of Taxpayers.',
  '1st Edition',
  'DevMantra Times 1st Edition — March 2021 regulatory updates on GST Composition Scheme and taxpayer classification.',
  'published',
  '2021-03-06 00:00:00',
  NOW(), NOW()
),

-- Edition 2 (April 2021)
(
  'DevMantra Times: 1st April 21',
  'devmantra-times-1st-april-21',
  '<p>Regulatory Updates</p>\n<p>1. Opting-in for Composition Scheme for Financial year 2021-22 How to opt-in for Composition Scheme: The eligible registered taxpayers, who want to opt-in for composition scheme for the FY 2021-22, need to file FORM GST CMP-02 application, on or before 31st March, 2021, post login on GST portal.</p>\n<p>2. Classification of Taxpayers: Taxpayers are required to select their business activity only once, as Manufacturer, wholesaler / Distributor / Retailer, service providers &amp; others post login based on highest turnover amongst them. You can change the same later.</p>',
  'Regulatory Updates — Composition Scheme and Classification of Taxpayers for FY 2021-22.',
  '2nd Edition',
  'DevMantra Times 2nd Edition — April 2021 regulatory updates.',
  'published',
  '2021-04-01 00:00:00',
  NOW(), NOW()
),

-- Edition 3 (May 2021)
(
  'DevMantra Times: 3rd Edition 1st May 21',
  'devmantra-times-3rd-edition-1st-may-21',
  '<p>We have started with our 3rd edition of Devmantra Times for the month of May.</p>\n<p>Financial Year 2020-21, was perceived that it won''t be a fruitful year as the Indian Economy was in a drop-down position due to coronavirus pandemic effect. However, GST collections have crossed Rs 1 lakh crore in a row for straight five months converting it to the highest sustaining collection ever since the implementation of GST in July 2017, representing a reasonable economic upturn.</p>',
  'GST collections crossed Rs 1 lakh crore for five consecutive months, the highest sustained collection since GST implementation in July 2017.',
  '3rd Edition',
  'DevMantra Times 3rd Edition — May 2021. GST collections hit record sustained highs.',
  'published',
  '2021-05-01 00:00:00',
  NOW(), NOW()
),

-- Edition 4 (June 2021)
(
  'DevMantra Times: 4th Edition 1st June 21',
  'devmantra-times-4th-edition-1st-june-21',
  '<p>Welcome you to the fourth edition of Devmantra Times for the month of June.</p>\n<p>During the month of May we have been able to reach a new milestone by publishing the weekly Tax Digest. This has happened due to your continuous support as a reader. The unprecedented second wave have caused devastation all over our country, we have lost many of our near &amp; dear ones.</p>',
  'Launch of the weekly Tax Digest and reflections on the devastating second COVID wave in India.',
  '4th Edition',
  'DevMantra Times 4th Edition — June 2021. Weekly Tax Digest launch and second wave impact.',
  'published',
  '2021-06-01 00:00:00',
  NOW(), NOW()
),

-- Edition 5 (July 2021)
(
  'DevMantra Times: 5th Edition 1st July 21',
  'devmantra-times-5th-edition-1st-july-21',
  '<p>Happy To Bring To You The Fifth Edition Of Devmantra Times For The Month Of July 2021. We Wish Our Readers A Happy Doctor''s Day, CA Day &amp; GST Day.</p>\n<p>During the month of June we have been able to reach a new milestone or break through or innovation as you may call by introducing the Online Compliance tracker available in our portal. This is a unique feature available in the market segment &amp; will surely benefit our esteemed clients. Through this feature clients can log in &amp; check their statutory compliances any time.</p>',
  'Introduction of the Online Compliance tracker — a unique portal feature for clients to check statutory compliances anytime.',
  '5th Edition',
  'DevMantra Times 5th Edition — July 2021. Launch of Online Compliance tracker.',
  'published',
  '2021-07-01 00:00:00',
  NOW(), NOW()
),

-- Edition 6 (August 2021)
(
  'DevMantra Times: 6th Edition 1st August 21',
  'devmantra-times-6th-edition-1st-august-21',
  '<p>Welcome you to the sixth edition of Devmantra Times for the month of August 2021.</p>\n<p>According to figures released by Finance Ministry on Sunday, gross GST revenue collected in July 2021 are Rs 1,16,393 crore, out of which Central GST is Rs 22,197 crore, State GST is Rs 28,541 crore and Integrated GST is Rs 57,864 crore (including Rs 27,900 crore collected on import of goods) and cess of Rs 7,790 crore (including Rs 815 crore collected on import of goods).</p>',
  'Gross GST revenue collected in July 2021 — Rs 1,16,393 crore. Breakdown of CGST, SGST, IGST and cess.',
  '6th Edition',
  'DevMantra Times 6th Edition — August 2021. GST revenue at Rs 1.16 lakh crore.',
  'published',
  '2021-08-01 00:00:00',
  NOW(), NOW()
),

-- Edition 7 (September 2021)
(
  'DevMantra Times: 7th Edition 1st September 21',
  'devmantra-times-7th-edition-1st-september-21',
  '<p>Welcome you to the seventh edition of Devmantra Times for the month of September 2021.</p>\n<p>Our unique product "Online Compliance tracker" has touched the heights of popularity among the users. Once again, we would like to reiterate that this is a unique feature available in the market segment &amp; has proven to be beneficial to our esteemed clients. Through this feature clients can log in &amp; check their statutory compliances any time. Our esteemed clients recognise the differentiated value we bring to them in terms of superior service delivery, sustainable solutions and responsiveness to their needs.</p>',
  'Online Compliance tracker gaining popularity. Clients can check statutory compliances anytime through the portal.',
  '7th Edition',
  'DevMantra Times 7th Edition — September 2021. Online Compliance tracker update.',
  'published',
  '2021-09-01 00:00:00',
  NOW(), NOW()
),

-- Edition 8 (October 2021)
(
  'DevMantra Times: 8th Edition 1st October 21',
  'devmantra-times-8th-edition-1st-october-21',
  '<p>Welcome to the eighth edition of Devmantra Times for the month of October 2021.</p>\n<p><strong>Economy &amp; Covid:</strong> Nearly three-fourths of Indian adults could receive their second vaccine shot by the end of 2021 if the average 7.9 million doses a day recorded between September 1-30 is maintained. Based on this and healthy advance estimates of kharif (summer) crop and faster government spending, ICRA has revised the estimated growth rate of Indian Economy from 8.5% to 9%.</p>\n<p>GST collection for September stood at Rs 1.17 lakh crore, the highest since April and 23% higher than Rs 95,480 crore in the year earlier period.</p>',
  'ICRA revises India GDP growth from 8.5% to 9%. GST collection hits Rs 1.17 lakh crore in September — highest since April.',
  '8th Edition',
  'DevMantra Times 8th Edition — October 2021. India GDP growth revised to 9%, GST at Rs 1.17 lakh crore.',
  'published',
  '2021-10-01 00:00:00',
  NOW(), NOW()
),

-- Edition 9 (November 2021)
(
  'DevMantra Times: 9th Edition 1st November 21',
  'devmantra-times-9th-edition-1st-november-21',
  '<p>Welcome you to the ninth edition of Devmantra Times for the month of November 2021.</p>\n<p><strong>Unicorns boom in India in the year 2021:</strong> A 2020 NASSCOM - Zinnov Report predicted that with investments in start-ups expected to recover in 2021, India would add at least 9-11 unicorns in calendar year 2021. Nine months into 2021, India has already added 28 unicorns this year, taking the total number of unicorns in India to over 65. Of the 28 unicorns added this year, Fintech has contributed the highest number of unicorns by industry, closely followed by the e-Commerce, SaaS and marketplace segments.</p>',
  'India adds 28 unicorns in 2021, taking total to over 65. Fintech leads, followed by e-Commerce and SaaS.',
  '9th Edition',
  'DevMantra Times 9th Edition — November 2021. India unicorn boom with 28 new unicorns.',
  'published',
  '2021-11-01 00:00:00',
  NOW(), NOW()
),

-- Edition 10 (December 2021)
(
  'DevMantra Times: 10th Edition 1st December 21',
  'devmantra-times-10th-edition-1st-december-21',
  '<p>Welcome you to the tenth edition of Devmantra Times for the month of December 2021.</p>\n<p><strong>Unicorns boom in India in the year 2021 — The story continues.</strong> The Indian Startup Ecosystem is the world''s third largest, with more than 75 startups having reached the desired USD 1 billion valuation mark. Continuing with the spirit of startup booms we were able to host Mr. Ajay Thakur Head BSE (SME) to give our start up clients an opportunity.</p>',
  'India''s startup ecosystem is the world''s third largest with 75+ unicorns. DevMantra hosted BSE SME Head Mr. Ajay Thakur.',
  '10th Edition',
  'DevMantra Times 10th Edition — December 2021. India startup ecosystem and BSE SME event.',
  'published',
  '2021-12-01 00:00:00',
  NOW(), NOW()
),

-- Edition 11 (January 2022)
(
  'DevMantra Times: 11th Edition 1st January 22',
  'devmantra-times-11th-edition-1st-january-22',
  '<p>Welcome you to the Eleventh edition of Devmantra Times for the month of January 2022. Wishing all our readers a happy &amp; prosperous New Year and hoping 2022 brings new opportunities for all. Work Hard, Dream Big - this is our mantra for success.</p>\n<p><strong>Economic Updates:</strong> After navigating the turbulent pandemic waves, the recovering Indian economy is now sailing through unchartered waters of rising coronavirus cases, spiraling commodity prices and spiking inflation though the lighthouse of sustainable growth remains visible. India is projected to grow more than 9 per cent in the current fiscal ending March 2022.</p>',
  'India projected to grow 9%+ in FY22 amid rising cases, commodity prices and inflation.',
  '11th Edition',
  'DevMantra Times 11th Edition — January 2022. India GDP growth outlook and economic updates.',
  'published',
  '2022-01-01 00:00:00',
  NOW(), NOW()
),

-- Edition 12 / Budget Edition (February 2022)
(
  'DevMantra Times: Budget Edition 1st February 22',
  'devmantra-times-budget-edition-1st-february-22',
  '<p>Welcome you to the Budget edition of Devmantra Times for the month of February 2022.</p>\n<p><strong>Economic Updates — Results of Economic Survey 2021-22:</strong> The Economic Survey 2021-22 was presented in the Parliament by Finance Minister Nirmala Sitharaman. India''s GDP as per the survey is expected to grow at 8.0-8.5% in 2022-23, supported by gains from supply side boost, robust export, widespread vaccination etc.</p>',
  'Economic Survey 2021-22: India GDP expected to grow at 8.0-8.5% in 2022-23.',
  'Budget Edition',
  'DevMantra Times Budget Edition — February 2022. Economic Survey 2021-22 highlights.',
  'published',
  '2022-02-01 00:00:00',
  NOW(), NOW()
),

-- Edition 13 (March 2022)
(
  'DevMantra Times: 13th Edition 1st March 22',
  'devmantra-times-13th-edition-1st-march-22',
  '<p>Welcome you to the Budget (Thirteenth) edition of Devmantra Times for the month of March 2022.</p>\n<p><strong>Economic Growth:</strong> Indian economy grew by 5.4 per cent in the October - December quarter of 2021-22, according to the data released by the National Statistical Office (NSO). The gross domestic product (GDP) had expanded by 0.7 per cent in the corresponding period of 2020-21. In its second advance estimates of national accounts, the NSO has projected 8.9 per cent growth in 2021-22.</p>',
  'Indian economy grew 5.4% in Q3 FY22. NSO projects 8.9% annual growth for 2021-22.',
  '13th Edition',
  'DevMantra Times 13th Edition — March 2022. India Q3 GDP growth and NSO projections.',
  'published',
  '2022-03-01 00:00:00',
  NOW(), NOW()
),

-- Edition 14 (April 2022)
(
  'DevMantra Times: 14th Edition 1st April 22',
  'devmantra-times-14th-edition-1st-april-22',
  '<p>Welcome you to the Fourteenth edition of Devmantra Times for the month of April 2022. Wish our readers a very happy New Financial Year, may your business flourish with Zero tolerance compliance deviation!</p>\n<p><strong>Economic Updates:</strong> Asia''s third-largest economy is projected to grow 8.9 per cent in 2021-22, according to recent government data. The Reserve Bank of India (RBI) has pegged the economic growth rate for 2022-23 at 7.8 per cent.</p>',
  'India projected to grow 8.9% in FY22. RBI pegs FY23 growth at 7.8%.',
  '14th Edition',
  'DevMantra Times 14th Edition — April 2022. India GDP projections for FY22 and FY23.',
  'published',
  '2022-04-01 00:00:00',
  NOW(), NOW()
),

-- Edition 15 (May 2022)
(
  'DevMantra Times: 15th Edition 1st May 22',
  'devmantra-times-15th-edition-1st-may-22',
  '<p>Welcome you to the Fifteenth edition of Devmantra Times for the month of May 2022.</p>\n<p><strong>Recovery of Economic Losses due to Covid 19 — Long way to go:</strong> As per the report authored by officials in the RBI''s Department of Economic and Policy Research, the Indian economy may take more than a decade to overcome the losses emanating from the covid-19 pandemic. The report has estimated the output losses during the pandemic period at around Rs 52 lakh crore. With the ongoing Russia-Ukraine conflict, the downward risks to global and domestic growth are getting accentuated through surge in commodity prices and global supply chain disruptions.</p>',
  'RBI estimates India''s pandemic output losses at Rs 52 lakh crore. Recovery may take over a decade.',
  '15th Edition',
  'DevMantra Times 15th Edition — May 2022. COVID economic losses and recovery outlook.',
  'published',
  '2022-05-01 00:00:00',
  NOW(), NOW()
),

-- Edition 16 (June 2022)
(
  'DevMantra Times: 16th Edition 1st June 22',
  'devmantra-times-16th-edition-1st-june-22',
  '<p>Welcome you to the Sixteenth edition of Devmantra Times for the month of June 2022.</p>\n<p>India''s economy grew by 4.1 per cent in the fourth quarter of 2021-22, pushing up the annual growth rate to 8.7 per cent, official data showed. However, growth in the January-March period was slower than the 5.4 per cent expansion in the previous October-December quarter of 2021-22. The gross domestic product (GDP) had expanded by 2.5 per cent in the corresponding January-March period of 2020-21.</p>',
  'India Q4 FY22 GDP growth at 4.1%, annual growth at 8.7%.',
  '16th Edition',
  'DevMantra Times 16th Edition — June 2022. India GDP annual growth at 8.7%.',
  'published',
  '2022-06-01 00:00:00',
  NOW(), NOW()
),

-- Edition 17 (July 2022)
(
  'DevMantra Times: 17th Edition 1st July 22',
  'devmantra-times-17th-edition-1st-july-22',
  '<p>We welcome you to the Seventeenth edition of Devmantra Times for the month of July 2022.</p>\n<p><strong>Express growth in the services sector:</strong> For India''s Services firms, new business and output rose at the fastest pace in June since early-2011, as per the survey-based S&amp;P Global India Services Purchasing Managers Index (PMI), which accelerated from 58.9 in May to 59.2 in June. A reading of over 50 on the index indicates growth over the previous month.</p>',
  'India Services PMI accelerates to 59.2 in June — fastest pace since early 2011.',
  '17th Edition',
  'DevMantra Times 17th Edition — July 2022. India services sector growth at record pace.',
  'published',
  '2022-07-01 00:00:00',
  NOW(), NOW()
),

-- Edition 18 (August 2022)
(
  'DevMantra Times: 18th Edition 1st August 22',
  'devmantra-times-18th-edition-1st-august-22',
  '<p>Welcome you to the Eighteenth edition of Devmantra Times for the month of August 2022.</p>\n<p><strong>Impact of Global rate rise on the economy:</strong> Domestic economy while presently showing good signs of resilience but its downside risks continue to be cause of concern. The uptick in inflation, surge in input costs, rising interest rates, liquidity management continue to pose challenges. The present US steep rate hike could accelerate further capital outflows impinging upon the exchange rate stability and casting its spell on financial markets.</p>',
  'Impact of global rate hikes on India — inflation, input costs, rising interest rates and capital outflow risks.',
  '18th Edition',
  'DevMantra Times 18th Edition — August 2022. Global rate rises and impact on Indian economy.',
  'published',
  '2022-08-01 00:00:00',
  NOW(), NOW()
),

-- Edition 19 (September 2022)
(
  'DevMantra Times: 19th Edition 1st September 22',
  'devmantra-times-19th-edition-1st-september-22',
  '<p>Welcome to the Nineteenth Edition of Devmantra Times for the month of September 2022.</p>\n<p><strong>Moderate Indian Growth:</strong> In ICRA''s assessment, there has been a shift in demand towards contact-intensive services from discretionary consumer goods for the mid-to-higher income groups. This, in conjunction with the emerging cautiousness in export demand, and the impact of high commodity prices on volumes as well as margins for the industrial sector, are likely to result in a relatively moderate industrial growth.</p>',
  'ICRA sees demand shift towards contact-intensive services. Moderate industrial growth expected.',
  '19th Edition',
  'DevMantra Times 19th Edition — September 2022. Moderate industrial growth outlook.',
  'published',
  '2022-09-01 00:00:00',
  NOW(), NOW()
),

-- Edition 20 (October 2022)
(
  'DevMantra Times: 20th Edition 1st October 22',
  'devmantra-times-20th-edition-1st-october-22',
  '<p>Welcome you to the Twentieth edition of Devmantra Times for the month of October 2022. Wish our readers Happy Durga Puja &amp; Dussehra.</p>\n<p><strong>Economic Growth:</strong> The Indian economy expanded 13.5% year-on-year in the second quarter of 2022, the most in a year but less than market forecasts of 15.2%. Gross value added increased faster for agriculture, forestry &amp; fishing (4.5% vs 2.2% in Q2 2021); electricity, gas, water supply &amp; other utility services (14.7% vs 13.8%); financial, real estate &amp; professional services (9.2% vs 2.3%) and public administration, defence &amp; other services (26.3% vs 6.2%).</p>',
  'India Q2 2022 GDP expands 13.5% YoY. Household consumption accelerates at 25.9%.',
  '20th Edition',
  'DevMantra Times 20th Edition — October 2022. India Q2 GDP growth at 13.5%.',
  'published',
  '2022-10-01 00:00:00',
  NOW(), NOW()
),

-- Edition 21 (November 2022)
(
  'DevMantra Times: 21st Edition 1st November 22',
  'devmantra-times-21st-edition-1st-november-22',
  '<p>Happy to share the Twenty first edition of Devmantra Times for the month of November 2022. Wish our readers Happy Diwali!</p>\n<p><strong>Economic Updates:</strong> India''s factory growth picks up speed in Oct, hiring at 33-month high. Core sector growth back on track, up to 7.9% in September after 2-month drop. Centre on firm fiscal footing, H1 deficit at 37.3% of FY23 BE.</p>',
  'India factory growth picks up, hiring at 33-month high. Core sector growth at 7.9%. Fiscal deficit at 37.3% of FY23 BE.',
  '21st Edition',
  'DevMantra Times 21st Edition — November 2022. Factory growth and fiscal updates.',
  'published',
  '2022-11-01 00:00:00',
  NOW(), NOW()
),

-- Edition 22 (December 2022)
(
  'DevMantra Times: 22nd Edition 1st December 22',
  'devmantra-times-22nd-edition-1st-december-22',
  '<p>Welcome you to the Twenty second edition of Devmantra Times for the month of December 2022.</p>\n<p><strong>Economic Updates:</strong> Global monthly wages contracted to 0.9% in first half of 2022 owing to rising inflation. Among advanced G20 countries, real wages in the first half of 2022 are estimated to have declined to -2.2%, whereas real wages in emerging G20 countries grew by 0.8%, which is 2.6% less than the pre-pandemic year of 2019.</p>',
  'Global wages contract amid rising inflation. Advanced G20 real wages decline 2.2%, emerging G20 grow 0.8%.',
  '22nd Edition',
  'DevMantra Times 22nd Edition — December 2022. Global wage contraction and inflation impact.',
  'published',
  '2022-12-01 00:00:00',
  NOW(), NOW()
),

-- Edition 23 (January 2023)
(
  'DevMantra Times: 23rd Edition 1st January 23',
  'devmantra-times-23rd-edition-1st-january-23',
  '<p>Welcome to the Twenty Third edition of Devmantra Times for the month of January 2023.</p>\n<p><strong>Devmantra Vision Statement 2023:</strong> Will develop employees into leaders through teamwork and subject matter training. We will promote team success as well as individual achievements in a consistently positive atmosphere. We will work with our clients to build the capabilities that enable organizations to achieve sustainable advantage. Work hard &amp; Dream big, and focus on success.</p>',
  'DevMantra Vision 2023 — developing employees into leaders, promoting team success, and building client capabilities.',
  '23rd Edition',
  'DevMantra Times 23rd Edition — January 2023. Vision Statement 2023.',
  'published',
  '2023-01-01 00:00:00',
  NOW(), NOW()
),

-- Edition 24 (February 2023)
(
  'DevMantra Times: 24th Edition 1st February 23',
  'devmantra-times-24th-edition-1st-february-23',
  '<p>Welcome you to the Twenty Fourth edition of Devmantra Times for the month of February 2023.</p>\n<p><strong>Highlights of the Economic Survey 2023-24:</strong> India to witness GDP growth of 6.0% to 6.8% in 2023-24, depending on the trajectory of economic and political developments globally. Economic survey 2022-23 projects a baseline GDP growth of 6.5% in real terms in FY24. Economy is expected to grow at 7% (in real terms) for the year ending March 2023, this follows an 8.7% growth in the previous financial year.</p>',
  'Economic Survey: India GDP growth projected at 6.0-6.8% in FY24. Baseline at 6.5%.',
  '24th Edition',
  'DevMantra Times 24th Edition — February 2023. Economic Survey 2023-24 highlights.',
  'published',
  '2023-02-01 00:00:00',
  NOW(), NOW()
),

-- Edition 25 (March 2023)
(
  'DevMantra Times: 25th Edition 1st March 23',
  'devmantra-times-25th-edition-1st-march-23',
  '<p>Welcome you to the Twenty Fifth edition of Devmantra Times for the month of March 2023.</p>\n<p><strong>Economic Updates:</strong> India''s economic growth estimate for 2023 reached 5.5 per cent from 4.8 per cent pegged earlier, on the back of a sharp increase in capital expenditure in the Budget and a resilient economic momentum. The central government continued with its capital expenditure push in the recently announced Union Budget. In 2023-24, capex is budgeted at Rs 10 lakh crore which will constitute 3.3 per cent of GDP. The RBI in its Bulletin said that if effectively implemented, it can take India''s real GDP growth close to 7% in FY24.</p>',
  'India growth estimate raised to 5.5% from 4.8%. Capex budgeted at Rs 10 lakh crore for FY24.',
  '25th Edition',
  'DevMantra Times 25th Edition — March 2023. India growth estimate and capex push.',
  'published',
  '2023-03-01 00:00:00',
  NOW(), NOW()
),

-- Edition 26 (April 2023)
(
  'DevMantra Times: 26th Edition 1st April 23',
  'devmantra-times-26th-edition-1st-april-23',
  '<p>Welcome you to the Twenty Sixth edition of Devmantra Times for the month of April 2023.</p>\n<p>Fabulous Year ending for Devmantra as M&amp;A team has been able to close two successful deals with a Successful IPO listing for one of our client — Label Kraft Technologies Company. It is a big vision achieved in a short period of six months, all because of the combined and unified directional effort by our team of investment bankers, MBAs, chartered accountants and company secretaries. Congratulations Labelkraft and we are proud to be your Advisors!!</p>',
  'DevMantra closes two M&A deals and celebrates a successful IPO listing for Label Kraft Technologies.',
  '26th Edition',
  'DevMantra Times 26th Edition — April 2023. M&A deals and Labelkraft IPO success.',
  'published',
  '2023-04-01 00:00:00',
  NOW(), NOW()
),

-- Edition 27 (May 2023)
(
  'DevMantra Times: 27th Edition 1st May 23',
  'devmantra-times-27th-edition-1st-may-23',
  '<p>Welcome you to the Twenty Seventh edition of Devmantra Times for the month of May 2023.</p>\n<p><strong>India''s Economy Signals Resilience Even As Exports Dim Outlook:</strong> India''s economy stayed strong in March despite declining exports and rising unemployment. Bloomberg''s activity tracker, which follows eight high-frequency indicators, showed that India''s economy remained stable during the month. The Reserve Bank of India has paused rates for the first time in months in order to assess the impact of higher interest rates on economic activity.</p>',
  'India economy resilient despite declining exports. RBI pauses rates for the first time to assess impact.',
  '27th Edition',
  'DevMantra Times 27th Edition — May 2023. India economic resilience and RBI rate pause.',
  'published',
  '2023-05-01 00:00:00',
  NOW(), NOW()
),

-- Edition 28 (June 2023)
(
  'DevMantra Times: 28th Edition 1st June 23',
  'devmantra-times-28th-edition-1st-june-23',
  '<p>Welcome you to the Twenty Eighth edition of Devmantra Times for the month of June 2023.</p>\n<p><strong>The Indian Economy Is Still Resilient, And GDP Growth Will Remain Over 6% From 2023 Through 2028:</strong> In response to post-pandemic and geopolitical changes, India has consistently demonstrated resilience and has increased GDP growth above the pre-pandemic time, according to a study by the Ph.D. Chamber of Commerce and Industry. According to IMF data, India dramatically rebounded from GDP growth of -5.8% in 2020 to 9.1% in 2021, 6.8% in 2022, and a forecast growth rate of 5.9% in 2023.</p>',
  'India GDP growth to remain above 6% through 2028. IMF data shows rebound from -5.8% to 9.1%.',
  '28th Edition',
  'DevMantra Times 28th Edition — June 2023. India GDP growth resilience through 2028.',
  'published',
  '2023-06-01 00:00:00',
  NOW(), NOW()
),

-- Edition 29 (July 2023)
(
  'DevMantra Times: 29th Edition 1st July 23',
  'devmantra-times-29th-edition-1st-july-23',
  '<p>Welcome you to the Twenty Ninth edition of Devmantra Times for the month of July 2023.</p>\n<p>The much awaited NSE Social Stock Exchange Segment has been approved by SEBI. This would be a new avenue for social enterprises to finance social initiatives, provide them visibility and shall act as a catalyst for their growth.</p>\n<p><strong>India''s Economic Prospects Brighten:</strong> The Indian economy presents a picture of resilience, supported by strong macroeconomic fundamentals. Sustained growth momentum, moderating inflation and anchoring of inflation expectations, a narrowing current account deficit and rising foreign exchange reserves, ongoing fiscal consolidation and a robust financial system are setting the economy on a path of sustained growth, RBI said.</p>',
  'SEBI approves NSE Social Stock Exchange. RBI Financial Stability Report shows strong macroeconomic fundamentals.',
  '29th Edition',
  'DevMantra Times 29th Edition — July 2023. Social Stock Exchange and RBI stability report.',
  'published',
  '2023-07-01 00:00:00',
  NOW(), NOW()
),

-- Edition 30 (August 2023)
(
  'DevMantra Times: 30th Edition 1st August 23',
  'devmantra-times-30th-edition-1st-august-23',
  '<p>Welcome you to the Thirtieth edition of Devmantra Times for the month of August 2023. India will celebrate its 77th Independence Day on August 15, 2023. Proud moment for India as country assumes G20 presidency and India''s Space Mission. India''s third moon mission, Chandrayaan-3, was successfully launched onboard a Launch Vehicle Mark-3 (LVM-3) rocket from Sriharikota at 2.35 pm on July 14.</p>\n<p><strong>The Seven-year Glitch: Inside The Govt''s War To Plug The GST Leakage:</strong> In May, under a special drive to detect fake GST registrations, Central and state GST officials started door-to-door physical verification of addresses before initiating any action. In many cases, officials found forged electricity bills, property tax receipts and rent agreements were used as proof of principal place of business to obtain GST registration.</p>',
  'India celebrates G20 presidency and Chandrayaan-3. Government drives to detect fake GST registrations.',
  '30th Edition',
  'DevMantra Times 30th Edition — August 2023. Chandrayaan-3 and GST leakage crackdown.',
  'published',
  '2023-08-01 00:00:00',
  NOW(), NOW()
),

-- Edition 31 (September 2023)
(
  'DevMantra Times: 31st Edition 1st September 23',
  'devmantra-times-31st-edition-1st-september-23',
  '<p>Welcome you to the Thirty First edition of Devmantra Times for the month of September 2023. CBDT has notified Form 71 to enable TDS Credit for Previously Declared Income in ITRs which will generate free cash flows to many entities. This is a welcome move by the CBDT.</p>\n<p><strong>Reserve Bank Of India''s Liquidity Withdrawal Pushes Bank CD Issuances To 3-month High:</strong> The Reserve Bank of India''s move to withdraw liquidity from the banking system has forced lenders to scout the market for funds, pushing up the issuances of certificates of deposits (CDs) to a three-month high for the previous fortnight. Banks raised over 350 billion rupees ($4.24 billion) via CDs in the fortnight ended Aug. 25.</p>',
  'CBDT notifies Form 71 for TDS credit. RBI liquidity withdrawal pushes bank CD issuances to 3-month high.',
  '31st Edition',
  'DevMantra Times 31st Edition — September 2023. CBDT Form 71 and RBI liquidity moves.',
  'published',
  '2023-09-01 00:00:00',
  NOW(), NOW()
),

-- Edition 32 (October 2023)
(
  'DevMantra Times: 32nd Edition 1st October 23',
  'devmantra-times-32nd-edition-1st-october-23',
  '<p>Welcome you to the Thirty Second edition of Devmantra Times for the month of October 2023. While gaming emerged as the future of the Virtual World, Government''s decision to levy a uniform 28% tax on full face value for online gaming, casinos, and horse racing will undoubtedly disrupt the exponential rise of the gaming industry. Further, ITC blocked on Corporate Social Responsibility under section 17(5) of CGST Act, 2017.</p>\n<p><strong>States'' Borrowing Cost Soars To 23-week High Of 7.56%:</strong> The borrowing cost for Indian states has increased by 10 basis points to 7.56% at the first weekly debt auction of the third quarter. This is the highest rate in the past 23 weeks.</p>',
  '28% GST on online gaming, casinos and horse racing. States'' borrowing cost at 23-week high of 7.56%.',
  '32nd Edition',
  'DevMantra Times 32nd Edition — October 2023. Gaming tax and state borrowing costs.',
  'published',
  '2023-10-01 00:00:00',
  NOW(), NOW()
),

-- Edition 33 (November 2023)
(
  'DevMantra Times: 33rd Edition 1st November 23',
  'devmantra-times-33rd-edition-1st-november-23',
  '<p>Welcome you to the Thirty Third edition of Devmantra Times for the month of November 2023. The Government''s vision of promoting growth of global trade, emphasis on exports from India and to support the increasing interest of global trading community in INR is further powered by additional arrangement for invoicing, payment, and settlement of exports/imports in INR.</p>\n<p>Export of services U/s 2(96) of IGST Act, 2017 can be considered to be fulfilled when the Indian exporters, undertaking exports of services, are paid the export proceeds in INR from the balances in the designated Special Vostro Account of the correspondent bank of the partner trading country. This is a promising welcome change and reinforces India''s powerful position in global trade.</p>',
  'INR-based trade settlement via Special Vostro Accounts. India reinforces its position in global trade.',
  '33rd Edition',
  'DevMantra Times 33rd Edition — November 2023. INR trade settlement and export updates.',
  'published',
  '2023-11-01 00:00:00',
  NOW(), NOW()
),

-- Edition 34 (December 2023)
(
  'DevMantra Times: 34th Edition 1st December 23',
  'devmantra-times-34th-edition-1st-december-23',
  '<p>Welcome you to the Thirty Fourth edition of Devmantra Times for the month of December 2023. Think Big and Let''s close the year 2023 on a positive note. Wishing you a happy planning for the coming year 2024.</p>\n<p><strong>Narayan Seshadri Appointed IDRCL Chair, Incumbent Diwakar Gupta To Head NARCL:</strong> Narayan Seshadri, former KPMG managing partner, is set to become the chairman of India Debt Resolution Co Ltd (IDRCL), the government-backed bad bank''s agent, following approval from the company''s board. Seshadri, a financial sector veteran with expertise in reviving distressed companies, will take over immediately.</p>',
  'Narayan Seshadri appointed IDRCL Chair. Year-end reflections and planning for 2024.',
  '34th Edition',
  'DevMantra Times 34th Edition — December 2023. IDRCL leadership change and year-end review.',
  'published',
  '2023-12-01 00:00:00',
  NOW(), NOW()
),

-- Edition 35 (January 2024)
(
  'DevMantra Times: 35th Edition 1st January 24',
  'devmantra-times-35th-edition-1st-january-24',
  '<p>We welcome you to the Thirty Fifth edition of Devmantra Times for the month of January 2024. We welcome 2024 with best wishes for an environmentally conscious, socially responsible, financially successful, personally fulfilling, and medically uncomplicated 2024.</p>\n<p><strong>Budget 2024:</strong> Finance Ministry Seeks Expenditure Proposals For Final Supplementary Demands For Grants. The Indian finance ministry is seeking expenditure proposals for the second batch of Supplementary Demands for Grants before the Budget session in January. Eligible cases include those granted advances from the Contingency Fund, payments against court decree, and cases where the finance ministry has advised moving the supplementary demand in the winter session.</p>',
  'Finance Ministry seeks expenditure proposals for Supplementary Demands for Grants ahead of Budget 2024.',
  '35th Edition',
  'DevMantra Times 35th Edition — January 2024. Budget 2024 preparations and supplementary demands.',
  'published',
  '2024-01-01 00:00:00',
  NOW(), NOW()
),

-- Edition 36 (February 2024)
(
  'DevMantra Times: 36th Edition 1st February 24',
  'devmantra-times-36th-edition-1st-february-24',
  '<p>Welcome you to the Thirty Sixth edition of Devmantra Times for the month of February 2024. We look forward to a Viksit Bharat under the dynamic leadership of our Prime Minister Shri Narendra Modi and various bold initiatives of the Government.</p>\n<p><strong>Fiscal Deficit Target Of 4.5% Of GDP By FY26 A Challenge: Fitch:</strong> India''s government faces challenges in meeting its fiscal deficit target of 4.5% of GDP in FY26, according to global ratings agency Fitch. The agency predicts a 6.5% growth in the Indian economy in FY25, supported by 11% growth in government capex. The government has set a 5.1% fiscal deficit for FY25, down from 5.8% in FY24.</p>',
  'Fitch says India''s 4.5% fiscal deficit target by FY26 is challenging. Predicts 6.5% GDP growth in FY25.',
  '36th Edition',
  'DevMantra Times 36th Edition — February 2024. Interim Budget 2024 and Fitch outlook.',
  'published',
  '2024-02-01 00:00:00',
  NOW(), NOW()
),

-- Edition 37 (March 2024)
(
  'DevMantra Times: 37th Edition 1st March 24',
  'devmantra-times-37th-edition-1st-march-24',
  '<p>Welcome you to the Thirty Seventh edition of Devmantra Times for the month of March 2024. We are happy to continue our contribution towards women entrepreneurship and women empowerment. CWE''s catalyst and director Nidhi Tatia met with the ITC SheTrades team in Delhi as part of the peer-to-peer learning session on best practices for market access and growth for women entrepreneurs in India.</p>\n<p><strong>FM Sitharaman asks GST officers to leverage tech to plug loopholes, better taxpayer services:</strong> Finance Minister Nirmala Sitharaman urged GST officers to leverage technology, share best practices, and ensure seamless coordination across states at the National Conference of Enforcement Chiefs of the State and Central GST Formations.</p>',
  'Women entrepreneurship initiatives with ITC SheTrades. FM urges GST officers to leverage technology.',
  '37th Edition',
  'DevMantra Times 37th Edition — March 2024. Women empowerment and GST tech adoption.',
  'published',
  '2024-03-01 00:00:00',
  NOW(), NOW()
),

-- Edition 39 (May 2024)
(
  'DevMantra Times: 39th Edition 1st May 24',
  'devmantra-times-39th-edition-1st-may-24',
  '<p>We welcome you to the Thirty Ninth edition of Devmantra Times for the month of May 2024. As we embark on this month''s journey, we delve deep into the regulatory announcements set to influence business strategies and market dynamics.</p>\n<p><strong>India, Nigeria to increase cooperation in energy, UPI, local currency settlement:</strong> India and Nigeria are ramping up cooperation in several key areas to bolster economic ties. During a recent visit by an Indian delegation to Nigeria, both countries discussed increasing collaboration in sectors such as crude oil, natural gas, pharmaceuticals, Unified Payments Interface (UPI), local currency settlement systems, and the power sector.</p>',
  'India-Nigeria cooperation on energy, UPI and local currency settlement to enhance economic ties.',
  '39th Edition',
  'DevMantra Times 39th Edition — May 2024. India-Nigeria economic cooperation.',
  'published',
  '2024-05-01 00:00:00',
  NOW(), NOW()
),

-- Edition 40 (June 2024)
(
  'DevMantra Times: 40th Edition 1st June 24',
  'devmantra-times-40th-edition-1st-june-24',
  '<p>Welcome you to the Fortieth edition of Devmantra Times for the month of June 2024. As the incoming government forms in June 2024, we are on the cusp of a new era, from significant amendments in financial regulations to groundbreaking environmental policies and the regulatory announcements of June 2024 set the stage for the incoming government''s agenda.</p>\n<p>In this edition, we dive deep into the grand finale that encapsulates the essence of a dynamic governance period, paving the way for what promises to be an equally eventful new chapter in our regulatory journey.</p>',
  'New government formation in June 2024 — regulatory announcements and financial regulation amendments.',
  '40th Edition',
  'DevMantra Times 40th Edition — June 2024. New government era and regulatory outlook.',
  'published',
  '2024-06-01 00:00:00',
  NOW(), NOW()
),

-- Edition 42 / August 2024
(
  'DevMantra Times: August 2024 Edition',
  'devmantra-times-august-2024-edition',
  '<p>Welcome to the forty-second edition of DevMantra Times! As we bid farewell to an impactful governance period, this August 2024 issue serves as a grand finale that captures the essence of our recent achievements while setting the stage for a transformative new chapter in our regulatory journey.</p>\n<p>In this edition, we dive deep into the latest regulatory announcements and present a comprehensive Impact Analysis of the Budget 2024 Amendments. These changes mark a significant evolution in our framework, promising to reshape our approach to governance and compliance in the coming months.</p>',
  'Impact Analysis of Budget 2024 Amendments and comprehensive regulatory updates.',
  '42nd Edition',
  'DevMantra Times 42nd Edition — August 2024. Budget 2024 impact analysis.',
  'published',
  '2024-08-01 00:00:00',
  NOW(), NOW()
),

-- Edition 43 (September 2024)
(
  'DevMantra Times: 43rd Edition 5th September 24',
  'devmantra-times-43rd-edition-5th-september-24',
  '<p>Welcome to the Forty-third edition of DevMantra Times for the month of September 2024. This grand finale encapsulates the essence of a dynamic governance period, paving the way for what promises to be an equally eventful new chapter in our regulatory journey.</p>\n<p><strong>Personal loan sees 14% growth; cards, gold major factors behind surge:</strong> Credit card dues have increased the fastest among bank loans, reaching nearly Rs 2.8 lakh crore by July''s end, seeing a 22% year-on-year growth. Personal loans now make up the largest share of non-food credit at 32.9%, growing by 14.4%. Loans against gold jewellery increased the most within personal loans.</p>',
  'Personal loans grow 14.4%, credit card dues at Rs 2.8 lakh crore with 22% YoY growth.',
  '43rd Edition',
  'DevMantra Times 43rd Edition — September 2024. Personal loan and credit card growth.',
  'published',
  '2024-09-05 00:00:00',
  NOW(), NOW()
),

-- Edition 44 (October 2024)
(
  'DevMantra Times: 44th Edition 5th October 2024',
  'devmantra-times-44th-edition-5th-october-2024',
  '<p>Welcome you to the Forty-Fourth edition of DevMantra Times for the month of October 2024. This grand finale encapsulates the essence of a dynamic governance period, paving the way for what promises to be an equally eventful new chapter in our regulatory journey.</p>\n<p><strong>GPay to provide gold-backed loans in collaboration with Muthoot Finance:</strong> Google collaborates with Muthoot Finance to offer gold-backed loans via GPay and plans to roll out its AI assistant, Gemini Live, in Hindi and eight other Indian languages. Additionally, Google is integrating Beckn-enabled open networks and launching clean energy projects in partnership with Adani Group and CleanMax.</p>',
  'Google-Muthoot gold-backed loans via GPay. Gemini Live in Hindi and 8 Indian languages.',
  '44th Edition',
  'DevMantra Times 44th Edition — October 2024. GPay gold loans and Google AI in India.',
  'published',
  '2024-10-05 00:00:00',
  NOW(), NOW()
),

-- Edition 45 (November 2024)
(
  'DevMantra Times: 45th Edition 4th November 2024',
  'devmantra-times-45th-edition-4th-november-2024',
  '<p>Welcome you to the Forty-Fifth edition of DevMantra Times for the month of November 2024. This Diwali may millions of lamps illuminate your life with endless joy, best of health, prosperity and wealth forever.</p>\n<p><strong>Bank lending rates dip sequentially, while deposit rates rise:</strong> Bank lending rates marginally declined in September 2024, with the average rate on new rupee loans at 9.37%. Deposit rates increased during the same period, with fresh term deposits averaging 6.54%. Public sector banks experienced a higher rise in lending and deposit rates compared to private banks.</p>',
  'Bank lending rates dip to 9.37% on new loans. Deposit rates rise to 6.54% average for fresh term deposits.',
  '45th Edition',
  'DevMantra Times 45th Edition — November 2024. Bank lending and deposit rate trends.',
  'published',
  '2024-11-04 00:00:00',
  NOW(), NOW()
),

-- Edition 46 (January 2025)
(
  'DevMantra Times: 46th Edition 4th January 2025',
  'devmantra-times-46th-edition-4th-january-2025',
  '<p>Welcome you to the Forty-Sixth edition of DevMantra Times for the month of January 2025. As we step into a brand-new year, we extend our heartfelt gratitude for your continued support and engagement. Your trust and partnership have been the cornerstone of our journey, and we are excited to carry this momentum into 2025.</p>\n<p><strong>Gross NPAs of banks decline to 12-year low of 2.6%: RBI report:</strong> The Reserve Bank''s report shows that banks'' asset quality has improved. Gross non-performing assets fell to a 12-year low of 2.6% in September 2024. The improvement is driven by falling slippages, higher write-offs, and steady credit demand. Public sector banks and private sector banks have recorded strong profit growth in the first half of 2024-25.</p>',
  'Bank gross NPAs at 12-year low of 2.6% per RBI report. Strong profit growth across banking sector.',
  '46th Edition',
  'DevMantra Times 46th Edition — January 2025. Bank NPAs at 12-year low.',
  'published',
  '2025-01-04 00:00:00',
  NOW(), NOW()
),

-- Edition 48 / Budget Edition (February-March 2025)
(
  'DevMantra Times: Budget Edition 5th February 2025',
  'devmantra-times-budget-edition-5th-february-2025',
  '<p><strong>Preamble:</strong> The Union Budget 2025-26, presented by Finance Minister Nirmala Sitharaman, serves as a pivotal blueprint for India''s economic growth, aligning with the government''s long-term vision of achieving ''Viksit Bharat'' by 2047. With a strong emphasis on inclusive development, infrastructure expansion, innovation, and sustainability, the budget introduces transformative measures aimed at strengthening key sectors while fostering resilience in a dynamic global economic landscape.</p>\n<p>A key highlight of the budget is its focus on boosting middle-class spending power through targeted tax reforms, which are expected to enhance domestic consumption and drive economic momentum. The government maintains its commitment to fiscal prudence, setting the fiscal deficit at 4.8% for FY25, with a planned reduction to 4.4% in FY26.</p>',
  'Union Budget 2025-26 blueprint for Viksit Bharat 2047. Tax reforms to boost middle-class spending. Fiscal deficit at 4.4% for FY26.',
  'Budget Edition',
  'DevMantra Times Budget Edition — February 2025. Union Budget 2025-26 analysis.',
  'published',
  '2025-02-05 00:00:00',
  NOW(), NOW()
),

-- Edition 48 (March 2025)
(
  'DevMantra Times: 48th Edition 5th March 2025',
  'devmantra-times-48th-edition-5th-march-2025',
  '<p>We welcome you to the Forty-Eight edition of DevMantra Times for the month of March 2025. This newsletter highlights key updates, including a drop in India''s oil imports from Russia due to US sanctions, the completion of the world''s longest LPG pipeline, and India''s push to increase ethanol blending in petrol.</p>\n<p><strong>India''s oil imports from Russia plunge to lowest in two years:</strong> India''s imports of crude oil from Russia slumped this month to the lowest level since January 2023, according to data analytics company Kpler, underlining how stringent US sanctions have disrupted supply chains.</p>',
  'India oil imports from Russia at 2-year low due to US sanctions. World''s longest LPG pipeline completed.',
  '48th Edition',
  'DevMantra Times 48th Edition — March 2025. Oil imports, LPG pipeline and ethanol blending.',
  'published',
  '2025-03-06 00:00:00',
  NOW(), NOW()
),

-- Edition 49 (April 2025)
(
  'DevMantra Times: 49th Edition 1st April 2025',
  'devmantra-times-49th-edition-1st-april-2025',
  '<p>We welcome you to the Forty-Ninth edition of DevMantra Times for the month of April 2025. India''s startup ecosystem continues to witness rapid growth and significant funding inflows, with government initiatives playing a crucial role in fostering innovation. From Karnataka''s Elevate program selecting 101 startups for Rs 25 crore in seed funding to the Union government''s Rs 1,000 crore allocation for space startups, the country is actively supporting emerging businesses.</p>\n<p><strong>India builds world''s longest LPG pipeline to cut costs &amp; deadly road accidents:</strong> India''s state-run refiners will fully commission the world''s longest liquefied petroleum gas pipeline by June, a key development that will sharply cut fuel transportation costs and help prevent deadly road accidents.</p>',
  'Karnataka selects 101 startups for seed funding. India commissions world''s longest LPG pipeline.',
  '49th Edition',
  'DevMantra Times 49th Edition — April 2025. Startup ecosystem and LPG pipeline.',
  'published',
  '2025-04-01 00:00:00',
  NOW(), NOW()
),

-- Edition 50 (May 2025)
(
  'DevMantra Times: 50th Edition 4th May 2025',
  'devmantra-times-50th-edition-4th-may-2025',
  '<p>We welcome you to the Fiftieth edition of DevMantra Times for the month of May 2025. This newsletter highlights key updates. SEBI has streamlined its forensic audit panel, while ICAI will be scrutinizing financial statements of companies like Gensol Engineering and BluSmart Mobility amid governance concerns. The escalating tariff war has raised alarms over Rs 21,800 crore in loans to MSMEs and mid-corporates, signaling vulnerabilities in the market.</p>\n<p><strong>ICAI to review financial statements of crisis-hit Gensol Engg, BluSmart Mobility:</strong> ICAI will scrutinize the financial statements of Gensol Engineering and BluSmart Mobility for fiscal year 2023-24, prompted by concerns over alleged fund diversions and governance lapses at Gensol. SEBI has already barred Gensol''s promoters from the securities market.</p>',
  'SEBI streamlines forensic audit panel. ICAI to scrutinize Gensol Engineering and BluSmart Mobility financials.',
  '50th Edition',
  'DevMantra Times 50th Edition — May 2025. SEBI forensic audits and ICAI review.',
  'published',
  '2025-05-04 00:00:00',
  NOW(), NOW()
),

-- Edition 51 (June 2025)
(
  'DevMantra Times: 51st Edition 2nd June 2025',
  'devmantra-times-51st-edition-2nd-june-2025',
  '<p>We welcome you to the Fifty-first edition of DevMantra Times for the month of June 2025. The IndiaAI Mission has taken a major leap forward by selecting 10 promising homegrown AI startups for its flagship global acceleration programme, in collaboration with Paris-based Station F and HEC Paris.</p>\n<p><strong>Dispatched 5.18 lakh vehicles through Indian Railways in FY 2024-25: Maruti Suzuki:</strong> Maruti Suzuki India has set a new milestone by achieving its highest-ever vehicle dispatch through Indian Railways during FY 2024-25, with a total of 5.18 lakh units transported. Since initiating rail-based logistics in FY 2014-15, the company has dispatched approximately 24 lakh vehicles via this mode, efficiently reaching over 600 cities across India.</p>',
  'IndiaAI selects 10 startups for global acceleration. Maruti Suzuki dispatches record 5.18 lakh vehicles via railways.',
  '51st Edition',
  'DevMantra Times 51st Edition — June 2025. IndiaAI startups and Maruti railway logistics.',
  'published',
  '2025-06-02 00:00:00',
  NOW(), NOW()
),

-- Edition 52 (July 2025)
(
  'DevMantra Times: 52nd Edition 4th July 2025',
  'devmantra-times-52nd-edition-4th-july-2025',
  '<p>Welcome you to the Fifty second edition of DevMantra Times for the month of July 2025. The government has launched Sagarmala Finance Corporation Ltd. (SMFCL), India''s first maritime sector NBFC, to address financing gaps in ports, shipbuilding, and coastal logistics under the Sagarmala Programme.</p>\n<p><strong>India''s first maritime NBFC launched:</strong> India has launched Sagarmala Finance Corporation Limited (SMFCL), the country''s first Non-Banking Financial Company (NBFC) dedicated to the maritime sector, registered with the Reserve Bank of India (RBI). SMFCL is established to bridge critical financing gaps by offering tailored financial solutions to stakeholders such as ports, maritime startups, logistics providers, and allied institutions.</p>',
  'India launches first maritime NBFC — Sagarmala Finance Corporation to bridge port and shipbuilding financing gaps.',
  '52nd Edition',
  'DevMantra Times 52nd Edition — July 2025. India first maritime NBFC launched.',
  'published',
  '2025-07-04 00:00:00',
  NOW(), NOW()
),

-- Edition 53 (August 2025)
(
  'DevMantra Times: 53rd Edition 2nd August 2025',
  'devmantra-times-53rd-edition-2nd-august-2025',
  '<p>Dear Reader, DevMantra Times August 2025 Edition is out now! From record-breaking investments in semiconductors to Lenskart''s bold IPO move, and a deep dive into India''s evolving tax, fintech, and startup ecosystem - this edition is a powerful knowledge toolkit for every business leader, finance pro, and curious mind.</p>\n<p>Banking trends, regulatory shifts, startup shakeups, and tax intelligence - all in one place. Don''t just stay updated. Stay ahead. Read. Reflect. Rethink. Because excellence begins with knowledge.</p>',
  'Semiconductor investments, Lenskart IPO, tax and fintech updates. A knowledge toolkit for business leaders.',
  '53rd Edition',
  'DevMantra Times 53rd Edition — August 2025. Semiconductors, Lenskart IPO and fintech.',
  'published',
  '2025-08-02 00:00:00',
  NOW(), NOW()
),

-- Edition 54 (September 2025)
(
  'DevMantra Times: 54th Edition 4th September 2025',
  'devmantra-times-54th-edition-4th-september-2025',
  '<p>Welcome you to the Fifty fourth edition of DevMantra Times for the month of September 2025. The Securities Appellate Tribunal (SAT/SAFEMA) clarified that penalties cannot be enhanced beyond 100% of the contravention amount, while in another case it raised penalties from Rs 10 lakh to Rs 1 crore each for culprits behind forex irregularities causing a Rs 23.64 crore loss and Rs 4.90 crore foreign assets acquisition.</p>\n<p><strong>SARC launches operations in US under global expansion plans:</strong> Indian professional services firm SARC has commenced operations in California, focusing on mid-market enterprises and startups. This marks the beginning of its international expansion strategy, with plans to enter other global hubs, including Japan and Germany, over the next five to seven years.</p>',
  'SAT clarifies penalty limits. SARC launches US operations in California targeting mid-market enterprises.',
  '54th Edition',
  'DevMantra Times 54th Edition — September 2025. SAT penalty ruling and SARC US expansion.',
  'published',
  '2025-09-04 00:00:00',
  NOW(), NOW()
),

-- Edition 55 (October 2025)
(
  'DevMantra Times: 55th Edition 1st October 2025',
  'devmantra-times-55th-edition-1st-october-2025',
  '<p>Welcome you to the Fifty fifth edition of DevMantra Times for the month of October 2025. Amazon has finalized its acquisition of Indian non-bank lender Axio, securing a direct lending license and enabling it to offer credit products and develop innovative financial solutions for customers and small businesses.</p>\n<p><strong>Amazon completes Axio acquisition, secures access to direct lending business in India:</strong> Amazon has finalized its acquisition of Axio, an Indian non-bank lender, securing a direct lending license in India. This acquisition marks a significant step in Amazon''s expansion into the financial services sector in India, enabling the company to offer credit products directly on its platform.</p>',
  'Amazon acquires Axio for direct lending in India. GST 2.0 and Navratri e-commerce drive record digital payments.',
  '55th Edition',
  'DevMantra Times 55th Edition — October 2025. Amazon Axio acquisition and digital payments.',
  'published',
  '2025-10-01 00:00:00',
  NOW(), NOW()
),

-- Edition 56 (November 2025)
(
  'DevMantra Times: 56th Edition 1st November 2025',
  'devmantra-times-56th-edition-1st-november-2025',
  '<p>Welcome you to the Fifty sixth edition of DevMantra Times for the month of November 2025. The government is considering amending the Chartered Accountants Act, 1949 to relax advertising restrictions for CA firms, aligning with ICAI''s ongoing review of its Code of Ethics. In the financial sector, cross-border deals worth $8 billion underscore rising foreign investor interest, while rural India now accounts for 80% of NBFCs'' microfinance portfolios, the highest since 2011.</p>\n<p><strong>CAs may soon get to advertise their firms:</strong> The Government of India is reportedly considering amendments to the Chartered Accountants Act, 1949, with the objective of relaxing advertising restrictions imposed on Chartered Accountants (CAs) and their firms. The proposed reform seeks to provide greater flexibility in professional communication and visibility.</p>',
  'Government considers relaxing CA advertising restrictions. Cross-border deals at $8 billion. Rural microfinance at 80% of NBFC portfolios.',
  '56th Edition',
  'DevMantra Times 56th Edition — November 2025. CA advertising reform and cross-border deals.',
  'published',
  '2025-11-01 00:00:00',
  NOW(), NOW()
),

-- Edition 57 (December 2025)
(
  'DevMantra Times: 57th Edition 2nd December 2025',
  'devmantra-times-57th-edition-2nd-december-2025',
  '<p>Welcome you to the Fifty seventh edition of DevMantra Times for the month of December 2025. Zomato parent Eternal expanded Hyperpure to serve all food businesses - though the shift led to a temporary 31% YoY revenue dip - while Accel partnered with Google to provide up to $2 million in co-investment, cloud access, and mentorship for Indian AI startups. MapmyIndia and Zoho announced a CRM integration to deliver advanced location intelligence, and Lenskart reported a strong post-listing quarter with PAT up 19.6% and revenue up 20.8%.</p>\n<p><strong>Celebrating a Milestone:</strong> CA Nidhi Tatia Honoured as Best Women Achiever by FKCCI. Our Founder Director, CA Nidhi Tatia, has been recognised by the Federation of Karnataka Chambers of Commerce &amp; Industry (FKCCI) as a Best Women Achiever for her outstanding contributions to finance, strategy, entrepreneurship, and leadership.</p>',
  'CA Nidhi Tatia honoured as Best Women Achiever by FKCCI. Zomato, Lenskart, and Indian AI startup updates.',
  '57th Edition',
  'DevMantra Times 57th Edition — December 2025. FKCCI award, Zomato, Lenskart and AI startups.',
  'published',
  '2025-12-05 00:00:00',
  NOW(), NOW()
),

-- Edition 58 (January 2026)
(
  'DevMantra Times: 58th Edition 2nd January 2026',
  'devmantra-times-58th-edition-2nd-january-2026',
  '<p>Welcome you to the Fifty eighth edition of DevMantra Times for the month of January 2026. India''s finance, startup, and regulatory landscape saw several notable developments this week. HDFC Bank ramped up its CSR spending to Rs 1,068 crore in FY25, while the RBI imposed a Rs 61.95 lakh penalty on Kotak Mahindra Bank for regulatory lapses and initiated a review of scale-based regulations for NBFCs amid their growing systemic role.</p>\n<p><strong>HDFC Bank spends Rs 1,068 crore in CSR during FY25:</strong> HDFC Bank has significantly scaled up its corporate social responsibility (CSR) initiatives, with total CSR expenditure rising to Rs 1,068.03 crore in FY 2024-25, reflecting an increase of about Rs 123 crore over the previous year. Over the past decade, the Bank''s flagship CSR programme, Parivartan, has emerged as a key vehicle for inclusive and sustainable development, positively impacting more than 10.5 crore lives across India.</p>',
  'HDFC Bank CSR at Rs 1,068 crore in FY25. RBI penalizes Kotak Mahindra Bank. NBFC scale-based regulation review.',
  '58th Edition',
  'DevMantra Times 58th Edition — January 2026. HDFC CSR, RBI penalty and NBFC regulation.',
  'published',
  '2026-01-02 00:00:00',
  NOW(), NOW()
),

-- Edition 59 (February 2026)
(
  'DevMantra Times: 59th Edition 2nd February 2026',
  'devmantra-times-59th-edition-2nd-february-2026',
  '<p>Welcome you to the Fifty ninth edition of DevMantra Times for the month of February 2026. As we step into a brand-new budget, we extend our heartfelt gratitude for your continued support and engagement. The Union Budget 2026-27, presented by Finance Minister Nirmala Sitharaman, serves as a strategic roadmap for India''s economic growth, with a focus on inclusive development, infrastructure expansion, innovation, and sustainability.</p>\n<p>The budget introduces transformative measures to strengthen key sectors and enhance economic resilience. Overall, the Union Budget 2026-27 strikes a balance between growth and fiscal discipline, driving innovation, infrastructure expansion, and sustainable development. By fostering entrepreneurship and prioritizing social equity, it sets a strong foundation for a self-reliant and globally competitive India.</p>',
  'Union Budget 2026-27: Strategic roadmap for inclusive growth, infrastructure, innovation and sustainability.',
  '59th Edition',
  'DevMantra Times 59th Edition — February 2026. Union Budget 2026-27 analysis.',
  'published',
  '2026-02-02 00:00:00',
  NOW(), NOW()
);
