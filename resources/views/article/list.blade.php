@if ($articles->count() == 0)
    <div class="container article-content col-md-12">
        <span>Нет публикаций</span>
    </div>
@endif

@include('article.list_data')

{{ $articles->links() }}

