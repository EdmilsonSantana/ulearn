@extends('layouts.backend.index')
@section('content')
<div class="page-header">
  <h1 class="page-title">Dashboard</h1>
</div>
<div class="page-content container-fluid">
    <div class="row">
    <div class="col-md-4">
          <!-- Card -->
          <div class="card card-block p-30 bg-red-600">
            <div class="card-watermark darker font-size-80 m-15"><i class="fa fa-chalkboard" aria-hidden="true"></i></div>
            <div class="counter counter-md counter-inverse text-left">
              <div class="counter-number-group">
                <span class="counter-number">{{ $metrics['students'] }}</span>
                <span class="counter-number-related text-capitalize">{{ str_plural('aluno', $metrics['students'])}}</span>
              </div>
            </div>
          </div>
          <!-- End Card -->
        </div>

        <div class="col-md-4">
          <!-- Card -->
          <div class="card card-block p-30 bg-blue-600">
            <div class="card-watermark darker font-size-80 m-15"><i class="fas fa-bullhorn" aria-hidden="true"></i></div>
            <div class="counter counter-md counter-inverse text-left">
              <div class="counter-number-group">
                <span class="counter-number">{{ $metrics['instructors'] }}</span>
                <span class="counter-number-related text-capitalize">{{ str_plural('instrutor', $metrics['instructors']) }}</span>
              </div>
            </div>
          </div>
          <!-- End Card -->
        </div>

        <div class="col-md-4">
          <!-- Card -->
          <div class="card card-block p-30 bg-green-600">
            <div class="card-watermark darker font-size-60 m-15"><i class="far fa-play-circle" aria-hidden="true"></i></div>
            <div class="counter counter-md counter-inverse text-left">
              <div class="counter-number-group">
                <span class="counter-number">{{ $metrics['courses'] }}</span>
                <span class="counter-number-related text-capitalize">{{str_plural('curso', $metrics['courses'])}}</span>
              </div>
            </div>
          </div>
          <!-- End Card -->
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
                    <th>Instrutor</th>
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
                    <td>{{ $course->instructor_name }}</td>
                    <td>{{ $course->price ? $course->price : 'Grátis' }}</td>
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