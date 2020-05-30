<!DOCTYPE html>
<html lang="ru">
<head>
<style>
    #header{
        background-color: #041e42;
        padding:1rem;
    }
    .email-action-button{
        background-color: #041e42 !important;
        color: #fff;
        padding: 10px;
        cursor: pointer;
        text-decoration: none;
        border-radius: 5px;
        margin: 10px;
        display:inline-block;
    }

</style>
</head>

<body>

<div id="header">
    <img id="logo-image" src="{{asset('/images/textunik_logo.jpg')}}" height="80">
</div>

<div id="content">
    @yield('content')
</div>

<hr/>

<div id="footer">
    <p>С уважением, дружный коллектив Text-уник</p>
    <strong>Для связи с нами Вы можете просто ответить на это письмо</strong>
</div>

</body>
</html>
