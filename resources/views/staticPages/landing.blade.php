@extends('layouts.app')
@section('head')

    <title>Лендинг</title>
    

@endsection

@section('content')

<script>
  function resizeIframe(obj) {
    obj.style.height = obj.contentWindow.document.documentElement.scrollHeight + 'px';
  }
</script>

<iframe src="/landing.htm" scrolling="no" frameborder="0" style="width:100%;height:100%;overflow:hidden;margin-top: -1.6rem;" height="100%" width="100%" onload="resizeIframe(this)"></iframe>
@endsection