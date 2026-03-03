@props(['data' => []])
@php
    $rating = $data['rating'] ?? '4.8';
    $label  = $data['label']  ?? 'Client Success Stories';
    $title  = $data['title']  ?? 'Join the ranks of our satisfied clients and experience the Dev Mantra difference.';
@endphp

<div class="cr-testimonial-area cr-testimonial-ptb">
    <div class="container container-1230">
        <div class="cr-testimonial-box">
            <div class="row">
                <div class="col-lg-4">
                    <div class="cr-testimonial-wrap pt-40 pl-50">
                        <div class="cr-testimonial-content">
                            <span>{{ $rating }}
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                    <path d="M9 0L11.0206 6.21885H17.5595L12.2694 10.0623L14.2901 16.2812L9 12.4377L3.70993 16.2812L5.73056 10.0623L0.440492 6.21885H6.97937L9 0Z" fill="#F9A811"/>
                                </svg>
                            </span>
                            <p>{{ $label }}</p>
                        </div>
                        <h3 class="cr-testimonial-title">{{ $title }}</h3>
                        <div class="cr-testimonial-nav">
                            <button class="cr-testimonial-prev">
                                <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M13 7H1M1 7L7 1M1 7L7 13" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>
                            <button class="cr-testimonial-next">
                                <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1 7H13M13 7L7 1M13 7L7 13" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="cr-testimonial-wrapper z-index-1">
                        <div class="cr-testimonial-item-shape">
                            <img src="{{ asset('assets/img/home-13/testimonial/testimonial-line.png') }}" alt="">
                        </div>
                        <div class="swiper-container cr-testimonial-active fix">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <div class="cr-testimonial-item z-index-1 text-center">
                                        <div class="cr-testimonial-item-top pb-40">
                                            <p class="cr-testimonial-item-subtitle">Reviewed on</p>
                                            <img width="70" src="https://png.pngtree.com/png-vector/20230817/ourmid/pngtree-google-logo-vector-png-image_9183290.png" alt="Google">
                                        </div>
                                        <h3 class="cr-testimonial-item-title">"We have been working with them since the inception of our company and we never had to look back at this relationship. Not only on regular matters, they have also given us very sound guidance, counsel and options when we have had any new developments. We truly value this relationship with Dev Mantra and look forward to working with them for a very long time to come."</h3>
                                        <div class="cr-testimonial-item-user">
                                            <span>Vaibhav Singh</span>
                                            <p>Director, Leap Group</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="cr-testimonial-item z-index-1 text-center">
                                        <div class="cr-testimonial-item-top pb-40">
                                            <p class="cr-testimonial-item-subtitle">Reviewed on</p>
                                            <img width="70" src="https://png.pngtree.com/png-vector/20230817/ourmid/pngtree-google-logo-vector-png-image_9183290.png" alt="Google">
                                        </div>
                                        <h3 class="cr-testimonial-item-title">"SecureSearch started working with Dev Mantra when starting up as a new business. Their focus and understanding of the needs of a new business were very good and were able to guide us through the maze of starting up a new business, dealing with new and large contracts and being compliant always. The team at Dev Mantra has added real value to SecureSearch by helping the Company through the various stages of growth from start-up to scaling up."</h3>
                                        <div class="cr-testimonial-item-user">
                                            <span>Chetan Desai</span>
                                            <p>Founder & CEO, SecureSearch Screening Services</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="cr-testimonial-item z-index-1 text-center">
                                        <div class="cr-testimonial-item-top pb-40">
                                            <p class="cr-testimonial-item-subtitle">Reviewed on</p>
                                            <img width="70" src="https://png.pngtree.com/png-vector/20230817/ourmid/pngtree-google-logo-vector-png-image_9183290.png" alt="Google">
                                        </div>
                                        <h3 class="cr-testimonial-item-title">"We had an urgent need to raise finance. Dev Mantra Team was able to guide us through troubled waters with skill and intelligence. Their expertise in restructuring and corporate finance, along with the wider firm's knowledge of intellectual property, gave us the advice we needed in a quick and efficient manner."</h3>
                                        <div class="cr-testimonial-item-user">
                                            <span>MBR Homes</span>
                                            <p>Real Estate Developers</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="cr-testimonial-item z-index-1 text-center">
                                        <div class="cr-testimonial-item-top pb-40">
                                            <p class="cr-testimonial-item-subtitle">Reviewed on</p>
                                            <img width="70" src="https://png.pngtree.com/png-vector/20230817/ourmid/pngtree-google-logo-vector-png-image_9183290.png" alt="Google">
                                        </div>
                                        <h3 class="cr-testimonial-item-title">"We were really pleased with all of the support from the entire team throughout the whole deal process. Great advice in the areas we didn't understand and at the same time full recognition of our requirements. Our interests were always represented very professionally which was a major contribution to a successful outcome. The investment transaction was completed successfully thanks to the diligence and remarkable contribution by the Dev Mantra team."</h3>
                                        <div class="cr-testimonial-item-user">
                                            <span>Gouthami T S</span>
                                            <p>Founder & CEO, AquaairX Autonomous Systems</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="cr-testimonial-item z-index-1 text-center">
                                        <div class="cr-testimonial-item-top pb-40">
                                            <p class="cr-testimonial-item-subtitle">Reviewed on</p>
                                            <img width="70" src="https://png.pngtree.com/png-vector/20230817/ourmid/pngtree-google-logo-vector-png-image_9183290.png" alt="Google">
                                        </div>
                                        <h3 class="cr-testimonial-item-title">"N. Tatia & Associates, Chartered Accountants have been appointed as tax advisors and representatives for litigation support. This office acknowledged the satisfactory services extended by them from time to time."</h3>
                                        <div class="cr-testimonial-item-user">
                                            <span>C. V. Sajeevan</span>
                                            <p>Official Liquidator, High Court of Karnataka</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="cr-testimonial-item z-index-1 text-center">
                                        <div class="cr-testimonial-item-top pb-40">
                                            <p class="cr-testimonial-item-subtitle">Reviewed on</p>
                                            <img width="70" src="https://png.pngtree.com/png-vector/20230817/ourmid/pngtree-google-logo-vector-png-image_9183290.png" alt="Google">
                                        </div>
                                        <h3 class="cr-testimonial-item-title">"Dev Mantra has been a huge help to our business since incorporation. They are a really friendly and professional team and always quick to respond. They really take the stress out of our finance function."</h3>
                                        <div class="cr-testimonial-item-user">
                                            <span>MVS Prasad</span>
                                            <p>Founder & CEO, Prashaste Group</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="cr-testimonial-item z-index-1 text-center">
                                        <div class="cr-testimonial-item-top pb-40">
                                            <p class="cr-testimonial-item-subtitle">Reviewed on</p>
                                            <img width="70" src="https://png.pngtree.com/png-vector/20230817/ourmid/pngtree-google-logo-vector-png-image_9183290.png" alt="Google">
                                        </div>
                                        <h3 class="cr-testimonial-item-title">"Impact Group of Institutions has greatly benefitted with tax and consulting with Dev Mantra for all our financial compliances and other tax related issues — it has been immensely beneficial. Their quality of work is highly professional with a proactive approach. We can always count on them for all our audit and taxation needs without worrying about the deadlines."</h3>
                                        <div class="cr-testimonial-item-user">
                                            <span>Dr Alice Abrahaim</span>
                                            <p>President, Impact Group of Institutions</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="cr-testimonial-item z-index-1 text-center">
                                        <div class="cr-testimonial-item-top pb-40">
                                            <p class="cr-testimonial-item-subtitle">Reviewed on</p>
                                            <img width="70" src="https://png.pngtree.com/png-vector/20230817/ourmid/pngtree-google-logo-vector-png-image_9183290.png" alt="Google">
                                        </div>
                                        <h3 class="cr-testimonial-item-title">"Dev Mantra team under the leadership of director Vikash Tatia has special capabilities to contribute across business functions. The team contributes immensely to the growth of the organisation and we are able to see turnaround results."</h3>
                                        <div class="cr-testimonial-item-user">
                                            <span>Shri Sudhir Jain</span>
                                            <p>Founder & CEO, Bionova</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="cr-testimonial-item z-index-1 text-center">
                                        <div class="cr-testimonial-item-top pb-40">
                                            <p class="cr-testimonial-item-subtitle">Reviewed on</p>
                                            <img width="70" src="https://png.pngtree.com/png-vector/20230817/ourmid/pngtree-google-logo-vector-png-image_9183290.png" alt="Google">
                                        </div>
                                        <h3 class="cr-testimonial-item-title">"We appreciate the association of Dev Mantra in all tax related matters and are always confident of meeting various deadlines."</h3>
                                        <div class="cr-testimonial-item-user">
                                            <span>Director (Admin)</span>
                                            <p>Ministry of Communications</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
