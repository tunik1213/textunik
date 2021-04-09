@if ($articles->count() == 0)
    <div class="container article-content col-md-12">
        <div>Нет публикаций</div>

        <br />

        <div class="button">
        	<a href="/" class="button">Вернуться на главную</a>
    	</div>
    </div>

@endif

@include('article.list_data')

{{ $articles->links() }}

