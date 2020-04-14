@extends('layouts.backend.index')
@section('content')
<div class="page-header">
  <h1 class="page-title">Blogs</h1>
</div>

<div class="page-content">

<div class="panel">
        <div class="panel-heading">
            <div class="panel-title">
              @include('admin/components/link', 
                      ['link' => route('admin.blogForm'), 'text' => 'Novo', 'icon' => 'wb-plus'])
            </div>
          
          <div class="panel-actions">
            @include('admin/components/search', ['action' => route('admin.blogs')])
          </div>
        </div>
        
        <div class="panel-body">
          <table class="table table-hover table-striped w-full">
            <thead>
              <tr>
                <th>N.º</th>
                <th>Título</th>
                <th>Slug</th>
                <th>Status</th>
                <th>Ações</th>
              </tr>
            </thead>
            <tbody>
              @foreach($blogs as $blog)
              <tr>
                <td>{{ $blog->id }}</td>
                <td>{{ $blog->blog_title }}</td>
                <td>{{ $blog->blog_slug }}</td>
                <td>
                  @if($blog->is_active)
                  <span class="badge badge-success">Active</span>
                  @else
                  <span class="badge badge-danger">Inactive</span>
                  @endif
                </td>
                <td>
                  <a href="{{ url('admin/blog-form/'.$blog->id) }}" class="btn btn-xs btn-icon btn-inverse btn-round" data-toggle="tooltip" data-original-title="Edit" >
                    <i class="icon wb-pencil" aria-hidden="true"></i>
                  </a>

                  <a href="{{ url('admin/delete-blog/'.$blog->id) }}" class="delete-record btn btn-xs btn-icon btn-inverse btn-round" data-toggle="tooltip" data-original-title="Delete" >
                    <i class="icon wb-trash" aria-hidden="true"></i>
                  </a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          
          <div class="float-right">
            {{ $blogs->appends(['search' => Request::input('search')])->links() }}
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