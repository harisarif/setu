@extends('admin.layouts.app')
@section('panel')

    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body p-0">

                    <div class="table-responsive--md table-responsive">
                        <table class=" table align-items-center table--light" id="myTable">
                            <thead>
                                <tr>
                                    <th scope="col">@lang('User')</th>
                                    <th scope="col">@lang('Category')</th>
                                    <th scope="col">@lang('Title')</th>
                                    <th scope="col">@lang('Goal')</th>
                                    <th scope="col">@lang('Deadline')</th>
                                    <th scope="col">@lang('Status')</th>
                                    <th scope="col">@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                @forelse($campaign as $key => $camp)
                                    <tr class="filt">

                                        <td data-label="@lang('User')">
                                            <a href="{{ route('admin.users.detail', $camp->user->id) }}">{{ @$camp->user->firstname }}
                                                {{ $camp->user->lastname }}</a>
                                        </td>
                                        <td data-label="@lang('Category')">{{ @$camp->category->name }}</td>
                                        <td data-label="@lang('Title')">{{ shortDescription($camp->title, 30) }}</td>
                                        <td data-label="@lang('Goal')">{{ $general->cur_sym }} {{ $camp->goal }}</td>
                                        <td data-label="@lang('Deadline')">{{ $camp->deadline }}</td>
                                        <td data-label="@lang('Status')">
                                            @if ($camp->rejected == 0)
                                                <span
                                                    class="text--small badge font-weight-normal {{ $camp->approval ? 'badge--success' : 'badge--danger' }}">{{ $camp->approval ? 'Approved' : 'Pending' }}</span>
                                            @else
                                                <span
                                                    class="text--small badge font-weight-normal {{ $camp->rejected ? 'badge--danger' : 'badge--danger' }}">{{ $camp->rejected ? 'Rejected' : 'Rejected' }}</span>
                                            @endif

                                        </td>
                                        <td data-label="@lang('Action')">
                                            <a href="{{ route('admin.fundrise.edit', ['slug' => $camp->slug, 'id' => $camp->id]) }}"
                                                class="icon-btn">
                                                <i class="las la-edit text--shadow"></i>
                                            </a>
                                            @if ($camp->approval != 1)
                                                <a href="javascript:void(0)" class="icon-btn btn--danger deactivateBtn  ml-1"
                                                    data-toggle="tooltip" title="" data-original-title="delete"
                                                    data-src={{ route('admin.fundrise.delete', ['slug' => $camp->slug, 'id' => $camp->id]) }}>
                                                    <i class="la la-trash"></i>
                                                </a>
                                            @endif

                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="100%" class="text-muted text-center">@lang($empty_message)</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>


                    </div>
                </div>
 @if($campaign->hasPages())
                <div class="card-footer py-4">
                    {{ $campaign->links('admin.partials.paginate') }}
                </div>
            @endif
            </div><!-- card end -->
        </div>
    </div>


    <div class="modal fade" tabindex="-1" role="dialog" id="modalDelete">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Delete Fund Request')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="font-weight-bold">@lang('Are you Sure to delete ?')</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn--dark" data-dismiss="modal">@lang('Close')</button>
                    <a class="btn btn--danger text-light">@lang('Delete')</a>
                </div>
            </div>
        </div>
    </div>


@endsection

@push('breadcrumb-plugins')
    <div class="d-flex flex-row-reverse bd-highlight ">
        <div class="p-2 bd-highlight">
            <div class="input-group has_append">
                <input type="text" name="search" class="form-control" placeholder="@lang('Search Campaign')" value=""
                    id="myInput">
                <div class="input-group-append">
                    <span class="bg--primary px-3"><i class="fa fa-search mt-2"></i></span>
                </div>
            </div>
        </div>

    </div>
@endpush


@push('script')

    <script>
        'use strict';
        
        $('.deactivateBtn').on('click', function() {
            $('#modalDelete').find('a').attr('href', $(this).data('src'));
            $('#modalDelete').modal('show');

        });


        $("#myInput").on("keyup", function() {

            var value = $(this).val().toLowerCase();

            $("#myTable .filt").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });

    </script>

@endpush
