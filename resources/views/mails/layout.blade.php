<!DOCTYPE html>
<html lang="ru">
<head>
<style>
    #header{
        background-color: #041e42;
    }
</style>
</head>

<body>

<div id="header">
    <img id="logo-image" src="{{asset('/images/Textunik_logo.png')}}" height="80">
</div>

<div id="content">
    @yield('content')
</div>

<div id="footer">

</div>

</body>
</html>
