@push('style')
    <link rel="stylesheet" href="{{ asset('knowledge/css/style.css') }}">
@endpush

<div class="col-lg-3">
    <div class="sidebar">
        <div class="pt-50">
            <div class="widget fix widget_categories">                            
                <h4>Menu</h4>
                <ul>
                    <li><a href="{{ route('articleCreate') }}"> Adicionar artigo</a></li>
                    <li><a href="{{ route('articleIndex') }}"> Todos os artigos</a></li>
                    <li><a href="{{ route('articleCategoryCreate') }}"> Adicionar categoria</a></li>
                    <li><a href="{{ route('articleCategoryIndex') }}"> Todas as categorias</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>