@extends('layouts.backend.index')
@section('content')
<div class="page-header">
  <h1 class="page-title">Dashboard</h1>
</div>
<div class="page-content container-fluid">
    <div class="row">
    <div class="col-md-4">
          @include('admin/components/card', ['bg_color' => 'red', 
                                             'icon' => 'fa fa-chalkboard',
                                             'metric' => $metrics['courses'],
                                             'label' => 'courses'])
        </div>

        <div class="col-md-4">
          
          @include('admin/components/card', ['bg_color' => 'blue', 
                                             'icon' => 'fas fa-bullhorn',
                                             'metric' => $metrics['lectures'],
                                             'label' => 'lectures'])
        </div>

        <div class="col-md-4">

          @include('admin/components/card', ['bg_color' => 'green', 
                                             'icon' => 'far fa-play-circle',
                                             'metric' => $metrics['videos'],
                                             'label' => 'videos'])
        </div>
    </div>

    <div class="panel">
        <div class="panel-heading">
                <div class="panel-title">
                <h4>Cursos adicionados recentemente</h4>
                </div>
        </div>
        <div class="panel-body">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                    <th>N.º</th>
                    <th>Título</th>
                    <th>Slug</th>
                    <th>Categoria</th>
                    <th>Preço</th>
                    <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($courses as $course)
                    <tr>
                    <td>{{ $loop->iteration }}</td>
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
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection