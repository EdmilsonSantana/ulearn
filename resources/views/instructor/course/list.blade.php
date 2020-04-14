@extends('layouts.backend.index')
@section('content')
<div class="page-header">
  <h1 class="page-title">Cursos</h1>
</div>

<div class="page-content">

<div class="panel">
        <div class="panel-heading">
            <div class="panel-title">
              @include('admin/components/link', 
                      ['link' => route('instructor.course.info'), 'text' => 'Novo', 'icon' => 'wb-plus'])
            </div>
          
          <div class="panel-actions">
        
            @include('admin/components/search', ['action' => route('instructor.course.list')])

          </div>
        </div>
        
        <div class="panel-body">
          <table class="table table-hover table-striped w-full">
            <thead>
              <tr>
                <th>N.º</th>
                <th>Título</th>
                <th>Slug</th>
                <th>Categoria</th>
                <th>Preço</th>
                <th>Status</th>
                <th>Ações</th>
              </tr>
            </thead>
            <tbody>
              @foreach($courses as $course)
              <tr>
                <td>{{ $course->id }}</td>
                <td>{{ $course->course_title }}</td>
                <td>{{ $course->course_slug }}</td>
                <td>{{ $course->category_name }}</td>
                <td>{{ $course->price ? $course->price : 'Gratuito' }}</td>
                <td>
                  @if($course->is_active)
                  <span class="badge badge-success">Ativo</span>
                  @else
                  <span class="badge badge-danger">Inativo</span>
                  @endif
                </td>
                <td>
                  <a href="{{ route('instructor.course.info.edit', $course->id) }}" class="btn btn-xs btn-icon btn-inverse btn-round" data-toggle="tooltip" data-original-title="Editar" >
                    <i class="icon wb-pencil" aria-hidden="true"></i>
                  </a>

                  <a href="{{ url('instructor-course-delete/'.$course->id) }}" class="delete-record btn btn-xs btn-icon btn-inverse btn-round" data-toggle="tooltip" data-original-title="Remover" >
                    <i class="icon wb-trash" aria-hidden="true"></i>
                  </a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          
          <div class="float-right">
            {{ $courses->appends(['search' => Request::input('search')])->links() }}
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