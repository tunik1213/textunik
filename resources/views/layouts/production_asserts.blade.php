@php
    $accept_encoding = $_SERVER['HTTP_ACCEPT_ENCODING'] ?? '';
    $gz = (substr_count($accept_encoding, 'gzip')) ? 'gz' : '';
@endphp

<link href="{{ asset('build/20200518095931.css') }}{{$gz}}" rel="stylesheet">
<script src="{{ asset('build/20200518095931.js') }}{{$gz}}"></script>