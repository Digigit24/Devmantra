@props(['data' => []])
@php
    $title    = $data['title']    ?? 'Meet Our Team';
    $subtitle = $data['subtitle'] ?? 'The people behind Devmantra who drive excellence every day.';

    $founders = $data['founders'] ?? [
        ['name' => 'Vikash Tatia',  'role' => 'Founder & MD',        'photo' => 'assets/img/team/6.png'],
        ['name' => 'Nidhi Tatia',   'role' => 'Founder & Director',  'photo' => 'assets/img/team/7.png'],
    ];
    $partners = $data['partners'] ?? [
        ['name' => 'Sankaranarayanan',   'role' => 'Director & Associate Partner',         'photo' => 'assets/img/team/8.png'],
        ['name' => 'Kamal Parakh',       'role' => 'Associate Director & Senior Partner',  'photo' => 'assets/img/team/9.png'],
        ['name' => 'Darshit Bombaywala','role' => 'Associate Partner',                     'photo' => 'assets/img/team/10.png'],
        ['name' => 'Pawan Bhotika',     'role' => 'Advisor - Agri Business',              'photo' => 'assets/img/team/11.png'],
        ['name' => 'BC Datta',          'role' => 'Associate Director - Corporate Affairs','photo' => 'assets/img/team/12.png'],
    ];
    $teamMembers = $data['team_members'] ?? [
        ['name' => 'Abhinaya U',       'role' => 'Associate - Investment Banking', 'photo' => 'assets/img/team/1.png'],
        ['name' => 'Sandeep Dhupar',   'role' => 'Associate Director',             'photo' => 'assets/img/team/2.png'],
        ['name' => 'Jalandhar Behera', 'role' => 'Associate VP - FAO Services',    'photo' => 'assets/img/team/3.png'],
        ['name' => 'Rajani M',         'role' => 'Talent Acquisition Lead',        'photo' => 'assets/img/team/4.png'],
        ['name' => 'Namrata Parakh',   'role' => 'Associate - Intl Relations',     'photo' => 'assets/img/team/5.png'],
    ];
@endphp

<!-- team section start -->
<section class="dm-team-section">
    <div class="container">
        <div class="dm-team-header text-center">
            <h2 class="dm-team-main-title">{{ $title }}</h2>
            <p class="dm-team-main-subtitle">{{ $subtitle }}</p>
        </div>

        @if(!empty($founders))
        <!-- Founders -->
        <h3 class="dm-team-group-title">Founders</h3>
        <div class="row dm-team-row justify-content-center">
            @foreach($founders as $member)
            <div class="col-lg-2 col-md-4 col-sm-6 col-6">
                <div class="dm-team-member">
                    <div class="dm-team-photo">
                        <img src="{{ asset($member['photo'] ?? 'assets/img/team/6.jpg') }}" alt="{{ $member['name'] ?? '' }}" loading="lazy">
                    </div>
                    <span class="dm-team-role">{{ $member['role'] ?? '' }}</span>
                    <h4 class="dm-team-name">{{ $member['name'] ?? '' }}</h4>
                    @if(!empty($member['linkedin']))
                    <a href="{{ $member['linkedin'] }}" target="_blank" rel="noopener noreferrer" class="dm-team-linkedin" aria-label="LinkedIn">
                        <i class="fab fa-linkedin"></i>
                    </a>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        @endif

        @if(!empty($partners))
        <!-- Partners & Advisory Board -->
        <h3 class="dm-team-group-title">Partners & Advisory Board</h3>
        <div class="row dm-team-row justify-content-center">
            @foreach($partners as $member)
            <div class="col-lg-2 col-md-4 col-sm-6 col-6">
                <div class="dm-team-member">
                    <div class="dm-team-photo">
                        <img src="{{ asset($member['photo'] ?? 'assets/img/team/8.jpg') }}" alt="{{ $member['name'] ?? '' }}">
                    </div>
                    <span class="dm-team-role">{{ $member['role'] ?? '' }}</span>
                    <h4 class="dm-team-name">{{ $member['name'] ?? '' }}</h4>
                    @if(!empty($member['linkedin']))
                    <a href="{{ $member['linkedin'] }}" target="_blank" rel="noopener noreferrer" class="dm-team-linkedin" aria-label="LinkedIn">
                        <i class="fab fa-linkedin"></i>
                    </a>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        @endif

        @if(!empty($teamMembers))
        <!-- Team -->
        <h3 class="dm-team-group-title">Team</h3>
        <div class="row dm-team-row justify-content-center">
            @foreach($teamMembers as $member)
            <div class="col-lg-2 col-md-4 col-sm-6 col-6">
                <div class="dm-team-member">
                    <div class="dm-team-photo">
                        <img src="{{ asset($member['photo'] ?? 'assets/img/team/1.png') }}" alt="{{ $member['name'] ?? '' }}">
                    </div>
                    <span class="dm-team-role">{{ $member['role'] ?? '' }}</span>
                    <h4 class="dm-team-name">{{ $member['name'] ?? '' }}</h4>
                    @if(!empty($member['linkedin']))
                    <a href="{{ $member['linkedin'] }}" target="_blank" rel="noopener noreferrer" class="dm-team-linkedin" aria-label="LinkedIn">
                        <i class="fab fa-linkedin"></i>
                    </a>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</section>
<!-- team section end -->
