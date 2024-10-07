@foreach ($campaigns as $campaign)
    <div class="col-md-6 col-lg-4 mb-30">
        <div class="event-card hover--effect-1 has-link">
            <div class="{{ isset($type) ? strtolower($type) : 'feature' }}">
                {{ isset($type) ? $type : $campaign->category->name }}</div>
            <a href="{{ route('user.campaign.details', ['slug' => $campaign->slug, 'id' => $campaign->id]) }}"
                class="item-link"></a>
            <div class="event-card__thumb">
                <img src="{{ asset(imagePath()['campaign']['path'] . '/' . $campaign->image) }}" alt="image"
                    class="w-100">
            </div>

            <div class="event-card__content">
                <h4 class="title">{{ Str::limit($campaign->title, 50) }}</h4>
                <span class="days-left mb-3 font-italic" data-deadline={{ $campaign->deadline }}>
                    <span class="day"></span>
                    <span class="hour"></span>
                    <span class="minute"></span>
                    <span class="sec"></span>

                </span>
                <p>{{ Str::limit($campaign->description, 120) }}</p>
                <div class="event-bar-item">
                    <div class="skill-bar">
                        @php
                            $percent = ($campaign->donation->where('payment_status', 1)->sum('donation') * 100) / $campaign->goal;
                        @endphp
                        <div class="progressbar" data-perc="{{ $percent > 100 ? '100' : $percent }}%">
                            <div class="bar"></div>
                            <span class="label">{{ number_format($percent > 100 ? '100' : $percent, 2) }}%</span>
                        </div>
                    </div>
                </div><!-- event-bar-item end -->
                <div class="amount-status">
                    <div class="left">@lang('Raised') - <b>{{ $general->cur_sym }}
                            {{ $campaign->donation->where('payment_status', 1)->sum('donation') }}</b></div>
                    <div class="right">@lang('Goal') - <b>{{ $general->cur_sym }} {{ $campaign->goal }}</b>
                    </div>
                </div>
            </div>
        </div><!-- event-card end -->
    </div>
@endforeach


@push('style')
    <style>
        #overlay {
            position: fixed;
            top: 0;
            z-index: 100;
            width: 100%;
            height: 100%;
            display: none;
            background: rgba(0, 0, 0, 0.6);
        }

        .cv-spinner {
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .spinner {
            width: 40px;
            height: 40px;
            border: 4px #ddd solid;
            border-top: 4px #2e93e6 solid;
            border-radius: 50%;
            animation: sp-anime 0.8s infinite linear;
        }

        @keyframes sp-anime {
            100% {
                transform: rotate(360deg);
            }
        }

        .is-hide {
            display: none;
        }

    </style>
@endpush
