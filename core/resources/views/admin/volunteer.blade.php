@extends('admin.layouts.app')

@section('panel')


    <div class="row">

        <div class="col-lg-12">
            <div class="card b-radius--10 ">
                <div class="card-body p-0">
                    <div class="table-responsive--md  table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                                <tr>
                                    <th scope="col">@lang('Name')</th>
                                    <th scope="col">@lang('Email')</th>
                                    <th scope="col">@lang('Phone')</th>
                                    <th scope="col">@lang('Status')</th>
                                    <th scope="col">@lang('Joined At')</th>
                                    <th scope="col">@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($volunteers as $volunteer)
                                    <tr>
                                        <td data-label="@lang('Name')">
                                            <div class="user">
                                                <div class="thumb">
                                                    <img src="{{ getImage(imagePath()['volunteer']['path'] . '/' . $volunteer->image, '100x100') }}"
                                                        alt="image">
                                                </div>
                                                <span class="name">{{ $volunteer->fullname }}</span>
                                            </div>
                                        </td>
                                        <td data-label="@lang('Email')">
                                            {{ $volunteer->email }}
                                        </td>
                                        <td data-label="@lang('Phone')">
                                            {{ $volunteer->phone }}
                                        </td>
                                        <td data-label="@lang('status')">
                                            @if ($volunteer->status == 1)
                                                <span class="badge badge--success">@lang('Approved')</span>
                                            @elseif($volunteer->status == 2)
                                                <span class="badge badge--danger">@lang('Rejected')</span>
                                            @else
                                                <span class="badge badge--danger">@lang('pending')</span>
                                            @endif
                                        </td>

                                        <td data-label="@lang('Joined At')">
                                            {{ $volunteer->created_at->format('Y-m-d') }}
                                        </td>
                                        <td data-label="@lang('Action')">
                                            <a class="icon-btn" href="{{route('admin.volunteer.edit',$volunteer)}}"><i class="la la-pen"></i></a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="100%" class="text-center">@lang('No Volunteer Found')</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                @if ($volunteers->hasPages())
                    <div class="card-footer py-4">
                        {{ $volunteers->links('admin.partials.paginate') }}
                    </div>
                @endif
            </div>
        </div>
    </div>


@endsection


@push('breadcrumb-plugins')
    <form action="{{ route('admin.volunteer.search')}}" method="GET" class="form-inline float-sm-right bg--white">
        <div class="input-group has_append">
            <input type="text" name="search" class="form-control" placeholder="email or phone" value="{{ $search ?? '' }}">
            <div class="input-group-append">
                <button class="btn btn--primary" type="submit"><i class="fa fa-search"></i></button>
            </div>
        </div>
    </form>
@endpush
