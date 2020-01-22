@extends('layouts.backend.index')
@section('content')
<div class="page-header">
  <h1 class="page-title">Categorias</h1>
</div>

<div class="page-content">

<div class="panel">
        <div class="panel-heading">
            <div class="panel-title">
              @include('admin/components/link', 
                      ['link' => route('admin.categoryForm'), 'text' => 'Nova', 'icon' => true])
            </div>
          
          <div class="panel-actions">
          @include('admin/components/search', ['action' => route('admin.categories')])
          </div>
        </div>
        
        <div class="panel-body">
          <table class="table table-hover table-striped w-full">
            <thead>
              <tr>
                <th>N.º</th>
                <th>Ícone</th>
                <th>Nome</th>
                <th>Slug</th>
                <th>Status</th>
                <th>Ações</th>
              </tr>
            </thead>
            <tbody>
              @foreach($categories as $category)
              <tr>
                <td>{{ $category->id }}</td>
                <td><i class="fas {{ $category->icon_class }}"></i></td>
                <td>{{ $category->name }}</td>
                <td>{{ $category->slug }}</td>
                <td>
                  @if($category->is_active)
                  <span class="badge badge-success">Ativo</span>
                  @else
                  <span class="badge badge-danger">Inativo</span>
                  @endif
                </td>
                <td>
                  <a href="{{ url('admin/category-form/'.$category->id) }}" class="btn btn-xs btn-icon btn-inverse btn-round" data-toggle="tooltip" data-original-title="Editar" >
                    <i class="icon wb-pencil" aria-hidden="true"></i>
                  </a>

                  <a href="{{ url('admin/delete-category/'.$category->id) }}" class="delete-record btn btn-xs btn-icon btn-inverse btn-round" data-toggle="tooltip" data-original-title="Remover" >
                    <i class="icon wb-trash" aria-hidden="true"></i>
                  </a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          
          <div class="float-right">
            {{ $categories->appends(['search' => Request::input('search')])->links() }}
          </div>
          
          
        </div>
      </div>
      <!-- End Panel Basic -->
</div>

@endsection

@section('javascript')
<script type="text/javascript">
    $(document).ready(function()
    { 

    });
</script>
@endsection