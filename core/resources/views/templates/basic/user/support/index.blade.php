@extends($activeTemplate.'layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center my-4">
            <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-header bg--crowd">{{ __($page_title) }}

                        <a href="{{route('ticket.open') }}" class="btn btn-sm btn-success float-right btn--crowd">
                         <i class="fa fa-plus"></i>   @lang('New Ticket')
                        </a>
                    </div>

                    <div class="card-body">

                        <div class="table-responsive--md  table-responsive">
                        <table class="table table-bordered table--light">
                                <thead>
                                <tr class="bg-table-custom">
                                    <th scope="col">@lang('Subject')</th>
                                    <th scope="col">@lang('Status')</th>
                                    <th scope="col">@lang('Last Reply')</th>
                                    <th scope="col">@lang('Action')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($supports as $key => $support)
                                    <tr>
                                        <td data-label="@lang('Subject')"> <a href="{{ route('ticket.view', $support->ticket) }}" class="font-weight-bold"> [Ticket#{{ $support->ticket }}] {{ $support->subject }} </a></td>
                                        <td data-label="@lang('Status')">
                                            @if($support->status == 0)
                                                <span class="badge badge-success badge-success-crowd py-2 px-3">@lang('Open')</span>
                                            @elseif($support->status == 1)
                                                <span class="badge badge-primary py-2 px-3">@lang('Answered')</span>
                                            @elseif($support->status == 2)
                                                <span class="badge badge-warning py-2 px-3">@lang('Customer Reply')</span>
                                            @elseif($support->status == 3)
                                                <span class="badge badge-dark py-2 px-3">@lang('Closed')</span>
                                            @endif
                                        </td>
                                        <td data-label="@lang('Last Reply')">{{ \Carbon\Carbon::parse($support->last_reply)->diffForHumans() }} </td>

                                        <td data-label="@lang('Action')">
                                            <a href="{{ route('ticket.view', $support->ticket) }}" class="btn btn-primary btn-sm btn--crowd--action">
                                                <i class="fa fa-desktop"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>


                        {{$supports->links()}}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



@push('style')

<style>
    .bg-table-custom{
        background: #1E3C60;
        color: #ffffff;
    }
    .badge-success-crowd{
        background: #16C26B;
    }
    .table--crowd{
        background: #1E3C60;
        color: #ffffff;
    }
    .bg--crowd{
                background: #16C26B;
                color: #ffffff;
            }

.btn--crowd--action{
    background: #16C26B;
                color: #ffffff;
                border: none;

}


.btn--crowd--action:hover{
    background: #16C26B;
                color: #ffffff;
                border: none;
                
}

            .btn--crowd{
                background: #ffffff;
                color: #16C26B;
                border: none;
            }

            .btn--crowd:hover{
                background: #ffffff;
                color: #16C26B;
                border: none;
            }
</style>
    
@endpush