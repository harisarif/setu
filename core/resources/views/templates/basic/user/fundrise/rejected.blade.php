@extends($activeTemplate.'layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="table-responsive--md  table-responsive">
            <table class="table table-bordered table--light">
                <thead>
                    <tr class="bg-table-custom">
                        <th>@lang('Serial')</th>
                        <th>@lang('Title')</th>
                        <th>@lang('Description')</th>
                        <th>@lang('Goal')</th>
                        <th>@lang('Fund Raised')</th>
                        <th>@lang('Deadline')</th>
                        <th>@lang('Status')</th>
                        <th>@lang('Action')</th>
                    </tr>
                </thead>
                
                <tbody>
                    @forelse ($campaign as $key => $item)
                    <tr>
                        <td data-label="@lang('Serial')">{{++$key}}</td>
                        <td data-label="@lang('Title')">{{$item->title}}</td>
                        <td data-label="@lang('Description')">{{Str::limit($item->description,50)}}</td>
                        <td data-label="@lang('Goal')">{{$general->cur_sym}} {{$item->goal}} </td>
                        <td data-label="@lang('Fund Raised')">{{$general->cur_sym}} {{$item->donation->sum('donation')}}</td>
                        <td data-label="@lang('Deadline')">{{$item->deadline}}</td>
                        <td data-label="@lang('Status')">
                            <p class="{{$item->rejected ? 'text-danger' :($item->approval ? 'custom-font-success':'custom-font-error')}}">{{$item->rejected ? 'Rejected':($item->approval ? 'Approved':'Pending')}}</p>
                        </td>
                        <td data-label="@lang('Action')" class="text-center">
                            <a href=""><i class="fa fa-eye"></i></a>
                        </td>
                        
                    </tr>
                @empty
                <tr>
                    <td data-label="@lang('No Data')" colspan="100%"><p class="text-center"><i class="fas fa-laugh"></i> @lang('No Rejected List Found') <i class="fas fa-laugh"></i></p></td>
                </tr>
                    
                @endforelse
                </tbody>

                
            </table>
        </div>
    </div>
    <div class=" py-4">
        {{ $campaign->links($activeTemplate.'partials.paginate') }}
    </div>
</div>
@endsection

@push('style')
    <style>
        table tr td{
            white-space:nowrap;
        }
        .bg-table-custom{
            background: #16C26B;
            color:#ffffff;
            text-align: center;
        }
        i{
            color: #16C26B;
        }

        i.fa.fa-edit{
            font-size:25px;
            font-weight: bolder
        }

        

        .custom-font-success{
            color: #16C26B;
        }

        .custom-font-error{
            color: #E2B748;
        }

        .custom-font-reject{
            color: #FF031B;
        }

        .badge-primary{
            background: #16C26B;
            color:#ffffff;
            padding: 7px;
        }
    </style>
@endpush