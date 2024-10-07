@if(\App\Extension::where('act', 'google-analytics')->where('status', 1)->first())
    @php echo  analytics() @endphp
@endif
