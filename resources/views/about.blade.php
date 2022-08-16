@extends('layouts.master')

@section('title', 'Auth-wiki | About')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/about.css') }}">
@endpush

@section('content')
    <main class="be_container">
        <section class="about_intro" style="margin-top: -45px;">
            <div>
                <h3>About us</h3>
                <p>
                    We are a team of designers and developers who have 
                    built an authentication library for developers
                </p>
            </div>
        </section>
    
        <section class="mission_section" >
            <div class="mission_statement">
                <h3>Our mission</h3>
                <p>
                    Our mission is to provide an authentication library for developers to search and download
                    authentication codes of their choice. Authentication can be stressful when building from 
                    scratch but with an auth library, all you need to do is download and you're good to go.
                </p>
            </div>
    
            <div class="section_images">
                <div id="sec1">
                    <img src="{{ asset('images/team/ms1.png') }}" alt="">
                    <img src="{{ asset('images/team/ms2.png') }}" alt="">
                </div>
                <div id="sec2"><img src="{{ asset('images/team/ms3.png') }}" alt=""></div>
            </div>
        </section>

        <section class="team_section" id="be_team">
            <div class="team_section_header">
                <h3>Meet The Team</h3>
                <p>A team of 24 members, consisting of 9 designers and 15 developers</p>
            </div>

            <div class="team_members">
                <div class="team_member">
                    <img src="{{ asset('images/team/member1.svg') }}" alt="Yewande">
                    <h6>Yewande</h6>
                    <p>Designer</p>
                </div>

                <div class="team_member">
                    <img src="{{ asset('images/team/member2.svg') }}" alt="Chidera">
                    <h6>Chidera</h6>
                    <p>Designer</p>
                </div>

                <div class="team_member">
                    <img src="{{ asset('images/team/member3.png') }}" alt="Victory">
                    <h6>Victory</h6>
                    <p>Developer</p>
                </div>

                <div class="team_member">
                    <img src="{{ asset('images/team/member4.png') }}" alt="Beckley">
                    <h6>Beckley</h6>
                    <p>Designer</p>
                </div>

                <div class="team_member">
                    <img src="{{ asset('images/team/member5.svg') }}" alt="Dahud">
                    <h6>Dahud</h6>
                    <p>Developer</p>
                </div>

                <div class="team_member">
                    <img src="{{ asset('images/team/member6.svg') }}" alt="Daniel">
                    <h6>Daniel</h6>
                    <p>Devloper</p>
                </div>

                <div class="team_member">
                    <img src="{{ asset('images/team/member7.png') }}" alt="Chijoke">
                    <h6>Chijoke</h6>
                    <p>Designer</p>
                </div>

                <div class="team_member">
                    <img src="{{ asset('images/team/member8.png') }}" alt="Michael">
                    <h6>Micheal</h6>
                    <p>Designer</p>
                </div>

                <div class="team_member">
                    <img src="{{ asset('images/team/member9.svg') }}" alt="Inyene">
                    <h6>Inyene</h6>
                    <p>Developer</p>
                </div>

                <div class="team_member">
                    <img src="{{ asset('images/team/member10.svg') }}" alt="Mirabel">
                    <h6>Mirabel</h6>
                    <p>Designer</p>
                </div>

                <div class="team_member">
                    <img src="{{ asset('images/team/member11.png') }}" alt="Favour">
                    <h6>Favour</h6>
                    <p>Developer</p>
                </div>

                <div class="team_member">
                    <img src="{{ asset('images/team/member12.svg') }}" alt="Aminat">
                    <h6>Aminat</h6>
                    <p>Designer</p>
                </div>

                <div class="team_member">
                    <img src="{{ asset('images/team/member13.png') }}" alt="Oluwadamilare">
                    <h6>Oluwadamilare</h6>
                    <p>Designer</p>
                </div>

                <div class="team_member">
                    <img src="{{ asset('images/team/member14.svg') }}" alt="Oluwapelumi">
                    <h6>Oluwapelumi</h6>
                    <p>Devloper</p>
                </div>

                <div class="team_member">
                    <img src="{{ asset('images/team/member15.png') }}" alt="Kachi">
                    <h6>Kachi</h6>
                    <p>Developer</p>
                </div>

                <div class="team_member">
                    <img src="{{ asset('images/team/member16.svg') }}" alt="Chigozie">
                    <h6>Chigozie</h6>
                    <p>Devloper</p>
                </div>

                <div class="team_member">
                    <img src="{{ asset('images/team/member17.svg') }}" alt="Segun">
                    <h6>Segun</h6>
                    <p>Developer</p>
                </div>

                <div class="team_member">
                    <img src="{{ asset('images/team/member18.png') }}" alt="Ishola">
                    <h6>Ishola</h6>
                    <p>Developer</p>
                </div>

                <div class="team_member">
                    <img src="{{ asset('images/team/member19.png') }}" alt="Emmy">
                    <h6>Isaac</h6>
                    <p>Developer</p>
                </div>

                <div class="team_member">
                    <img src="{{ asset('images/team/member20.svg') }}" alt="Siji">
                    <h6>Siji</h6>
                    <p>Designer</p>
                </div>

                <div class="team_member">
                    <img src="{{ asset('images/team/member21.png') }}" alt="Prisca">
                    <h6>Prisca</h6>
                    <p>Developer</p>
                </div>

                <div class="team_member">
                    <img src="{{ asset('images/team/member22.png') }}" alt="Saheed">
                    <h6>Saheed</h6>
                    <p>Developer</p>
                </div>

            </div>
        </section>

        <section class="team_lead_section">
            <h3>Meet The Team Leads</h3>
            <div class="team_leads">
                <div class="team_lead">
                    <img src="{{ asset('images/team/teamlead1.png') }}" alt="Samuel">
                    <h6>Samuel</h6>
                    <p>Developer</p>
                </div>
                <div class="team_lead">
                    <img src="{{ asset('images/team/teamlead2.svg') }}" alt="Peter">
                    <h6>Peter</h6>
                    <p>Designer</p>
                </div>
            </div>
        </section>
    </main>
@endsection