@extends('admin.layouts.app')

@section('panel')
    <div class="row">

        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table table--light style--two custom-data-table">
                            <thead>
                            <tr>
                                <th scope="col">@lang('Name')</th>
                                <th scope="col">@lang('Subject')</th>
                                <th scope="col">@lang('Status')</th>
                                <th scope="col">@lang('Action')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($email_templates as $template)
                                <tr>
                                    <td data-label="Name">{{ $template->name }}</td>
                                    <td data-label="Subject">{{ $template->subj }}</td>
                                    <td data-label="Status">
                                        @if($template->email_status == 1)
                                            <span
                                                class="text--small badge font-weight-normal badge--success">@lang('Active')</span>
                                        @else
                                            <span
                                                class="text--small badge font-weight-normal badge--warning">@lang('Disabled')</span>
                                        @endif
                                    </td>


                                    <td data-label="Action">
                                        <a href="{{ route('admin.email-template.edit', $template->id) }}"
                                           class="icon-btn  ml-1 editGatewayBtn" data-toggle="tooltip" title=""
                                           data-original-title="Edit">
                                            <i class="la la-pencil"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-muted text-center" colspan="100%">{{ $empty_message }}</td>
                                </tr>
                            @endforelse

                            </tbody>
                        </table><!-- table end -->
                    </div>
                </div>
            </div><!-- card end -->
        </div>


    </div>



@endsection

