@props(['data' => []])
@php
    $title = $data['title'] ?? 'Our Memberships';
    $subtitle = $data['subtitle'] ?? 'Proud members of leading industry bodies and chambers of commerce.';
    $memberships = $data['memberships'] ?? [
        ['name' => 'BCIC',                        'logo' => 'assets/img/memberships/1.png'],
        ['name' => 'FKCCI',                       'logo' => 'assets/img/memberships/2.png'],
        ['name' => 'CII',                         'logo' => 'assets/img/memberships/3.svg'],
        ['name' => 'Indo Italy Chamber',          'logo' => 'assets/img/memberships/4.png'],
        ['name' => 'EU Chambers',                 'logo' => 'assets/img/memberships/5.svg'],
        ['name' => 'CWE',                         'logo' => 'assets/img/memberships/6.png'],
        ['name' => 'Rotary',                      'logo' => 'assets/img/memberships/7.svg'],
        ['name' => 'MAWE',                        'logo' => 'assets/img/memberships/8.jpg'],
        ['name' => 'eMerg',                       'logo' => 'assets/img/memberships/9.png'],
    ];
@endphp

<section class="dm-memberships-section">
    <div class="container container-1230">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="dm-memberships-heading text-center mb-50">
                    <div class="tp-section-subtitle-gradient ct mb-15">Associations & Recognition</div>
                    <h3 class="tp-section-title-onest fs-48">{{ $title }}</h3>
                    <p class="dm-memberships-subtitle">{{ $subtitle }}</p>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-10 col-md-12">
                <div class="dm-memberships-grid">
                    @foreach($memberships as $member)
                    <div class="dm-membership-item">
                        <div class="dm-membership-logo-wrap">
                            <img src="{{ asset($member['logo']) }}" alt="{{ $member['name'] }}" loading="lazy">
                        </div>
                        <span class="dm-membership-name">{{ $member['name'] }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
