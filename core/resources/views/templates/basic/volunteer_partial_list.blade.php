@forelse ($volunteers as $item)
    <div class="col-xl-3 col-sm-6 mb-30 ">
        <div class="volunteer-card hover--effect-1">
            <div class="volunteer-card__thumb">
                <img src="{{ getImage(imagePath()['volunteer']['path'] . '/' . $item->image) }}" alt="image"
                    class="w-100">
            </div>
            <div class="volunteer-card__content">
                <img src="{{ asset($activeTemplateTrue . 'images/top-shape.png') }}" alt="image">
                <h4 class="name">{{ $item->fullname }}</h4>
                <span class="designation">@lang("Participate {$item->participated}
                    Campaigns")</span>
            </div>
        </div><!-- volunteer-card end -->
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="py-4">
                {{ $volunteers->links($activeTemplate . 'partials.paginate') }}
            </div>
        </div>
    </div><!-- row end -->
@empty

    <div class="col-md-6 mx-auto">
        <div class="card shadow">

            <div class="card-header text-center bg-success">
                <h4 class="text-white"><i class="text-white far fa-sad-cry"></i> @lang('Upps No Volunteer Found ') <i
                        class="text-white far fa-sad-cry"></i></h4>
            </div>

            <div class="card-body text-center py-5">
                <a href="{{ url()->previous() }}" class="text-white btn btn-success">@lang('back To Previous')</a>
            </div>

        </div>
    </div>
@endforelse
