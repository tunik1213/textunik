@php
    $accept_encoding = $_SERVER['HTTP_ACCEPT_ENCODING'] ?? '';
    $gz = (substr_count($accept_encoding, 'gzip')) ? 'gz' : '';
@endphp

<link href="{{ asset('build/20200603184355.css') }}{{$gz}}" rel="stylesheet">
<script src="{{ asset('build/20200603184355.js') }}{{$gz}}"></script>