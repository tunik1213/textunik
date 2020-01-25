@php($accept_encoding = $_SERVER['HTTP_ACCEPT_ENCODING'] ?? '')
@php($gz = (substr_count($accept_encoding, 'gzip')) ? 'gz' : '')

<link href="{{ asset('build/20200124165328.css') }}{{$gz}}" rel="stylesheet">
<script src="{{ asset('build/20200124165328.js') }}{{$gz}}"></script>