<form method="GET" action="{{ $action }}">
    <div class="input-group">
        <input type="text" class="form-control" name="search" placeholder="Pesquisar..." value="{{ Request::input('search') }}">
        <span class="input-group-btn">
            <button type="submit" class="btn btn-learna btn-learna-primary" data-toggle="tooltip" data-original-title="Pesquisar"><i class="icon wb-search" aria-hidden="true"></i></button>
            <a href="{{ $action }}" class="btn btn-danger" data-toggle="tooltip" data-original-title="Limpar"><i class="icon wb-close" aria-hidden="true"></i></a>
        </span>
    </div>
</form>

