@extends($activeTemplate.'layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="table-responsive--md  table-responsive">
            <table class="table table-bordered table--light">
                <thead>
                    <tr class="bg-table-custom">
                    <th scope="col">@lang('Serial')</th>
                    <th scope="col">@lang('Title')</th>
                    <th scope="col">@lang('Goal')</th>
                    <th scope="col">@lang('Fund Raised')</th>
                    <th scope="col">@lang('Deadline')</th>
                    <th scope="col">@lang('Status')</th>
                    <th scope="col">@lang('Action')</th>
                </tr>
                </thead>
                
                <tbody>
                    @forelse ($campaign as $key => $item)
                    <tr>
                        <td data-label="@lang('Serial')">{{++$key}}</td>
                        <td data-label="@lang('Title')">{{shortDescription($item->title,20)}}</td>
                        <td data-label="@lang('Goal')">{{$general->cur_sym}} {{$item->goal}} </td>
                        <td data-label="@lang('Fund Raised')">{{$general->cur_sym}} {{$item->donation->sum('donation')}}</td>
                        <td data-label="@lang('Deadline')">{{$item->deadline}}</td>
                        <td data-label="@lang('Status')">
                            @if($item->approval == 1)
                             <i class="fa fa-check"></i> @lang('Approved')
                             @endif
                        </td>
                        <td data-label="@lang('Action')" class="text-center">
                            <a href="{{route('user.campaign.view',['slug'=>$item->slug,'id'=>$item->id])}}" class=""><i class="bg-success text-white p-2 rounded fa fa-eye"></i></a>

                            <a href="{{route('user.donation.log',['log'=>$item->id])}}"><i title="Donors List" class="fa fa-user bg-info text-white p-2 rounded"></i></a>


                            @if($item->complete_status == 0)
                                <a data-href="{{route('user.fundrise.makeComplete',['id'=>$item->id])}}" class="complete"><i title="Mark As Complete" class="fas fa-check bg-warning text-white p-2 rounded"></i></a>
                            @endif
                            
                            @if($item->stop_status == 0)
                                <a data-href="{{route('user.fundrise.stop',['id'=>$item->id])}}" class="stopped"><i title="Pause" class="far fa-stop-circle bg-danger text-white p-2 rounded"></i></a>
                            @else
                                <a data-href="{{route('user.fundrise.stop',['id'=>$item->id])}}" class="stopped"><i title="@lang('Run')" class="fas fa-pause-circle bg-danger text-white p-2 rounded"></i></i></a>
                            @endif
                        </td>
                        
                    </tr>
                @empty
                <tr>
                    <td colspan="100%">
                        <p class="text-center font--size">
                            <i class="fas fa-laugh"></i> @lang('No approved Campaign') 
                            <i class="fas fa-laugh"></i>
                            </p>
                    </td>
                </tr>
                    
                @endforelse
                </tbody>
                
            </table>
        </div>
    </div>
    <div class="py-4">
        {{ $campaign->links($activeTemplate.'partials.paginate') }}
    </div>
</div>


<div class="modal fade" tabindex="-1" role="dialog" id="confirmModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">@lang('Campaign Stop/Start')</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p class="text-center alarm text-danger"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('Close')</button>
        <a type="button" class="btn btn-success text-white redirect">@lang('Save changes')</a>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" tabindex="-1" role="dialog" id="completeModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">@lang('Campaign Complete')</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p class="text-danger text-center alarm"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('Close')</button>
        <a type="button" class="btn btn-danger completeUrl">@lang('Mark As Complete')</a>
      </div>
    </div>
  </div>
</div>
@endsection

@push('style')
    <style>
        .font--size{
            font-size: 25px;
        }
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


@push('script')
        <script>
            'use strict';

            $(function(){
                $('.stopped').on('click',function(e){
                    e.preventDefault();
                    
                    var url = $(this).data('href');

                    var  modal = $('#confirmModal');

                    modal.find('.modal-body .alarm').text('Are you sure For this Action ?')
                    modal.find('.redirect').attr('href',url);
                    modal.modal('show');
                });


                 $('.complete').on('click',function(e){
                    e.preventDefault();
                    
                    var url = $(this).data('href');

                    var  modal = $('#completeModal');

                    modal.find('.modal-body .alarm').text('Are you sure For this Action. This Action Can not be backed?');

                    modal.find('.completeUrl').attr('href',url);
                    modal.modal('show');
                });
            })
        </script>
@endpush