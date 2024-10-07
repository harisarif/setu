@if(\App\Plugin::where('act', 'tawk-chat')->where('status', 1)->first())
    @php echo  tawkto() @endphp
@endif
