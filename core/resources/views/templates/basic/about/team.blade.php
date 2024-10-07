@extends($activeTemplate.'layouts.frontend')
@php
    $about = getContent('about.content','true');
    $aboutel = getContent('about.element',false);
    $team = getContent('team.content',true);
@endphp

@section('content')

<!-- about section start -->
<section class="container">
<div class="section-title">
				<h1>Our Team</h1>
            </div>
            <div class="row">
                <div class="column">
                    <div class="team-1">
                        <div class="team-img">
                            <img src="https://setu.foundation/assets/images/frontend/about/66a8915ca03381722323292.png" alt="Team Image">
                        </div>
                        <div class="team-content">
                            <h2>Vibhor Chopra</h2>
                            <h3>CEO &amp; Founder</h3>
                            <p>Vibhor, the visionary founder of Setu Foundation, hails from the Nagda district of Ujjain. He holds a B.Tech degree from MIT College, Ujjain, and has a profound interest in the medical field, inspired by his father’s extensive experience in the pharmaceutical business spanning over two decades...

                            </p>
                            <!-- <h4>example@example.com</h4>
                            <div class="team-social">
                                <a class="social-tw" href=""><i class="fab fa-twitter"></i></a>
                                <a class="social-fb" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="social-li" href=""><i class="fab fa-linkedin-in"></i></a>
                                <a class="social-in" href=""><i class="fab fa-instagram"></i></a>
                                <a class="social-yt" href=""><i class="fab fa-youtube"></i></a>
                            </div> -->
                        </div>
                    </div>
                </div>
                <div class="column">
                    <div class="team-1">
                        <div class="team-img">
                            <img src="https://setu.foundation/assets/images/frontend/about/66a89097585091722323095.png" alt="Team Image">
                        </div>
                        <div class="team-content">
                            <h2>Shewata Pathak</h2>
                            <h3>Development Practitioner | Social Media Manager | Graphic Designer | Video Editor</h3>
                            <p>Shweta holds a Master's degree in Development Communication and Extension, equipping her with a deep understanding of effective communication strategies and the impact of visual storytelling. Her keen eye for aesthetics and strong communication skills... </p>
                            <!-- <h4>example@example.com</h4>
                            <div class="team-social">
                                <a class="social-tw" href=""><i class="fab fa-twitter"></i></a>
                                <a class="social-fb" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="social-li" href=""><i class="fab fa-linkedin-in"></i></a>
                                <a class="social-in" href=""><i class="fab fa-instagram"></i></a>
                                <a class="social-yt" href=""><i class="fab fa-youtube"></i></a>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
</section>
  <!-- mission vission section end -->

@endsection


@push('style')
  <style>
                
            .team-1 {
                margin-bottom: 30px;
                box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            }

            .team-1 .team-img {
                overflow: hidden;
            }

            .team-1 .team-img img {
                width: 100%;
                height: auto;
                transition: all .3s;
            }

            .team-1:hover .team-img img {
                transform: scale(1.2);
            }

            .team-1 .team-content {
                padding: 20px;
            }

            .team-1 .team-content h2 {
                font-size: 25px;
                font-weight: 400;
                letter-spacing: 2px;
            }

            .team-1 .team-content h3 {
                font-size: 16px;
                font-weight: 300;
            }

            .team-1 .team-content h4 {
                font-size: 16px;
                font-weight: 300;
                font-style: italic;
                letter-spacing: 1px;
                margin-bottom: 25px;
            }

            .team-1 .team-content p {
                font-size: 16px;
                font-weight: 400;
                line-height: 22px;
            }

            .team-1 .team-social {
                display: flex;
                align-items: center;
                justify-content: flex-start;
                font-size: 0;
            }

            .team-1 .team-social a {
                display: inline-block;
                width: 40px;
                height: 40px;
                margin-right: 5px;
                padding: 11px 0 10px 0;
                font-size: 16px;
                line-height: 16px;
                text-align: center;
                color: #ffffff;
                transition: all .3s;
            }

            .team-1 .team-social a.social-tw {
                background: #00acee;
            }

            .team-1 .team-social a.social-fb {
                background: #3b5998;
            }

            .team-1 .team-social a.social-li {
                background: #0e76a8;
            }

            .team-1 .team-social a.social-in {
                background: #3f729b;
            }

            .team-1 .team-social a.social-yt {
                background: #c4302b;
            }

            .team-1 .team-social a:last-child {
                margin-right: 0;
            }

            .team-1 .team-social a:hover {
                background: #222222;
            }

            .column {
                position: relative;
                width: 100%;
                padding-right: 15px;
                padding-left: 15px;
                -ms-flex: 0 0 100%;
                flex: 0 0 100%;
                max-width: 100%;
            }

            @media (min-width: 576px) {
                .column {
                    -ms-flex: 0 0 50%;
                    flex: 0 0 50%;
                    max-width: 50%;
                }
            }

            @media (min-width: 768px) {
                .column {
                    -ms-flex: 0 0 33.333333%;
                    flex: 0 0 33.333333%;
                    max-width: 33.333333%;
                }
            }

            @media (min-width: 992px) {
                .column {
                    -ms-flex: 0 0 25%;
                    flex: 0 0 25%;
                    max-width: 25%;
                }
            }

            .section-title {
                width: 100%;
                text-align: center;
                padding: 45px 0 30px 0;
            }

            .section-title::after {
                position: absolute;
                content: "";
                width: 50px;
                height: 5px;
                left: calc(50% - 25px);
                background: #353535;
            }

            .section-title h1 {
                color: #353535;
                font-size: 50px;
                letter-spacing: 5px;
                margin-bottom: 5px;
            }

            @media(max-width: 767.98px) {
                .section-title h1 {
                    font-size: 40px;
                    letter-spacing: 3px;
                }
            }

            @media(max-width: 567.98px) {
                .section-title h1 {
                    font-size: 30px;
                    letter-spacing: 2px;
                }
            }

  </style>    
@endpush