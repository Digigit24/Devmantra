@props(['data' => []])
@php
    $title    = $data['title']    ?? 'Meet Our Team';
    $subtitle = $data['subtitle'] ?? 'The people behind Devmantra who drive excellence every day.';
@endphp

<!-- team section start -->
<section class="dm-team-section">
    <div class="container">
        <div class="dm-team-header text-center">
            <h2 class="dm-team-main-title">{{ $title }}</h2>
            <p class="dm-team-main-subtitle">{{ $subtitle }}</p>
        </div>

        <!-- Founders -->
        <h3 class="dm-team-group-title">Founders</h3>
        <div class="row dm-team-row justify-content-center">
            <div class="dm-team-col">
                <div class="dm-team-member">
                    <div class="dm-team-photo">
                        <img src="{{ asset('assets/img/team/6.jpg') }}" alt="Vikash Tatia">
                    </div>
                    <span class="dm-team-role">Founder & MD</span>
                    <h4 class="dm-team-name">Vikash Tatia</h4>
                </div>
            </div>
            <div class="dm-team-col">
                <div class="dm-team-member">
                    <div class="dm-team-photo">
                        <img src="{{ asset('assets/img/team/7.jpg') }}" alt="Nidhi Tatia">
                    </div>
                    <span class="dm-team-role">Founder & Director</span>
                    <h4 class="dm-team-name">Nidhi Tatia</h4>
                </div>
            </div>
        </div>

        <!-- Partners -->
        <h3 class="dm-team-group-title">Partners & Advisory Board</h3>
        <div class="row dm-team-row justify-content-center">
            <div class="col-lg-2 col-md-4 col-sm-6 col-6">
                <div class="dm-team-member">
                    <div class="dm-team-photo"><img src="{{ asset('assets/img/team/8.jpg') }}" alt=""></div>
                    <span class="dm-team-role">Director & Associate Partner</span>
                    <h4 class="dm-team-name">Sankaranarayanan</h4>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6 col-6">
                <div class="dm-team-member">
                    <div class="dm-team-photo"><img src="{{ asset('assets/img/team/9.jpeg') }}" alt="Kamal Parakh"></div>
                    <span class="dm-team-role">Associate Director & Senior Partner</span>
                    <h4 class="dm-team-name">Kamal Parakh</h4>
                </div>
            </div>
            <div style="border-right: 2px solid #1b3c6b;" class="col-lg-2 col-md-4 col-sm-6 col-6">
                <div class="dm-team-member">
                    <div class="dm-team-photo"><img src="{{ asset('assets/img/team/10.png') }}" alt="Darshit Bombaywala"></div>
                    <span class="dm-team-role">Associate Partner</span>
                    <h4 class="dm-team-name">Darshit Bombaywala</h4>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6 col-6">
                <div class="dm-team-member">
                    <div class="dm-team-photo"><img src="{{ asset('assets/img/team/11.jpg') }}" alt=""></div>
                    <span class="dm-team-role">Advisor - Agri Business</span>
                    <h4 class="dm-team-name">Pawan Bhotika</h4>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6 col-6">
                <div class="dm-team-member">
                    <div class="dm-team-photo"><img src="{{ asset('assets/img/team/12.jpg') }}" alt="BC Datta"></div>
                    <span class="dm-team-role">Associate Director - Corporate Affairs</span>
                    <h4 class="dm-team-name">BC Datta</h4>
                </div>
            </div>
        </div>

        <!-- Team -->
        <h3 class="dm-team-group-title">Team</h3>
        <div class="row dm-team-row justify-content-center">
            <div class="col-lg-2 col-md-4 col-sm-6 col-6">
                <div class="dm-team-member">
                    <div class="dm-team-photo"><img src="{{ asset('assets/img/team/1.jpg') }}" alt="Abhinaya Udayakumar"></div>
                    <span class="dm-team-role">Associate - Investment Banking</span>
                    <h4 class="dm-team-name">Abhinaya U</h4>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6 col-6">
                <div class="dm-team-member">
                    <div class="dm-team-photo"><img src="{{ asset('assets/img/team/2.jpg') }}" alt="Sandeep Dhupar"></div>
                    <span class="dm-team-role">Associate Director</span>
                    <h4 class="dm-team-name">Sandeep Dhupar</h4>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6 col-6">
                <div class="dm-team-member">
                    <div class="dm-team-photo"><img src="{{ asset('assets/img/team/3.jpg') }}" alt="Jalandhar Behera"></div>
                    <span class="dm-team-role">Associate VP - FAO Services</span>
                    <h4 class="dm-team-name">Jalandhar Behera</h4>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6 col-6">
                <div class="dm-team-member">
                    <div class="dm-team-photo"><img src="{{ asset('assets/img/team/4.jpg') }}" alt="Rajani M"></div>
                    <span class="dm-team-role">Talent Acquisition Lead</span>
                    <h4 class="dm-team-name">Rajani M</h4>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6 col-6">
                <div class="dm-team-member">
                    <div class="dm-team-photo"><img src="{{ asset('assets/img/team/5.jpg') }}" alt="Namrata Parakh Marothi"></div>
                    <span class="dm-team-role">Associate - Intl Relations</span>
                    <h4 class="dm-team-name">Namrata Parakh</h4>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- team section end -->
