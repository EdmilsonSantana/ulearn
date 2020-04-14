@extends('layouts.backend.index')
@section('content')
<div class="page-header">

  <h1 class="page-title">Usuários</h1>
</div>

<div class="page-content">

  <div class="panel">
    <div class="panel-heading">
      <div class="panel-title">
        @include('admin/components/link',
        ['link' => route('admin.getForm'), 'text' => 'Novo', 'icon' => 'wb-plus'])
      </div>

      <div class="panel-actions">
        @include('admin/components/search', ['action' => route('admin.users')])
      </div>
    </div>

    <div class="panel-body">
      <table class="table table-hover table-striped w-full">
        <thead>
          <tr>
            <th>N.º</th>
            <th>Nome</th>
            <th>Sobrenome</th>
            <th>E-mail</th>
            <th>Papéis</th>
            <th>Status</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
          @foreach($users as $user)
          <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->first_name }}</td>
            <td>{{ $user->last_name }}</td>
            <td>{{ $user->email }}</td>
            <td>
              @foreach($user->roles as $role)
              @if($role->name == 'student')
              <span class="badge badge-primary">{{ ucfirst($role->name) }}</span>
              @elseif($role->name == 'instructor')
              <span class="badge badge-warning">{{ ucfirst($role->name) }}</span>
              @endif
              @if(!$loop->last)
              <br>
              @endif
              @endforeach
            </td>
            <td>
              @if($user->is_active)
              <span class="badge badge-success">Ativo</span>
              @else
              <span class="badge badge-danger">Inativo</span>
              @endif
            </td>
            <td>
              <a href="{{ url('admin/user-form/'.$user->id) }}" class="btn btn-xs btn-icon btn-inverse btn-round" data-toggle="tooltip" data-original-title="Editar">
                <i class="icon wb-pencil" aria-hidden="true"></i>
              </a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>

      <div class="float-right">
        {{ $users->appends(['search' => Request::input('search')])->links() }}
      </div>


    </div>
  </div>
  <!-- End Panel Basic -->
</div>

@endsection

@section('javascript')
<script type="text/javascript">
  $(document).ready(function() {

  });
</script>
@endsection