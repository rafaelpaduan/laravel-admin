@extends('layouts.admin')

@section('vars')
    
    @php
    $page_header = "Usuários";
    $page_header_small = "Listagem de Usuários";

    $breadcrumb = [
        0 => [
            "nome" => "Usuários",
            "route" => ""
        ],
    ];

    $form = "search-users";

    $usersArr = [];

    if(isset($users['data'])) {

      $usersArr = $users['data'];
    }

    $paginate_default = 2;

    $paginator = "/?paginate=" . $paginate_default;

    foreach ($input as $key => $value) {
      $paginator = $paginator . "&" . $key . "=" . $value;
    }

    @endphp

@endsection

@section('content')

<div>

    <div class="row">
        <search-card
        form_name={{$form}}
        >
      
        <template slot="card-body">
          <form id="{{$form}}" action="{{Route('usuarios.index')}}" method="get">
            @csrf
            <input type="hidden" name="paginate" value="{{$paginate_default}}">

            <div class="row">
              <div class="form-group col-3">
                <label for="name">Nome</label>
                <input class="form-control form-control-sm" name="name" type="text" value="{{ isset($input['name']) ? $input['name'] : null }}" placeholder="Digite um Nome" />
              </div>

              <div class="form-group  col-3">
                <label for="email">e-Mail</label>
                <input class="form-control form-control-sm" name="email" type="email" value="{{ isset($input['email']) ? $input['email'] : null }}" placeholder="Digite um e-Mail" />
              </div>
            </div>

          </form>
        </template>

        </search-card>
    </div>

    <div class="row">
        <div class="col-12">
        @if (count($usersArr) > 0)
          <div class="card">
            <div class="card-body table-responsive p-0">
              <table class="table table-hover text-nowrap">
                <thead>
                  <tr>
                    @foreach ($usersArr[0] as $key => $value)
                    <th>{{ $key }}</th>
                    @endforeach
                  </tr>
                </thead>
                <tbody>
                @foreach ($usersArr as $user)
                    <tr>
                        @foreach ($user as $item)
                            <td>{{ $item }}</td>
                        @endforeach
                    </tr>
                @endforeach
                </tbody>
              </table>
            </div>
            <div class="card-footer">
              <div class="row">
                <div class="col-2">
                  <ul class="pagination pagination-sm">
                    <li class="page-item"><a class="page-link" href="{{ Route('usuarios.index') . $paginator . "&page=" . $users['prev_page'] }}">«</a></li>
                    <li class="page-item"><a class="page-link" href="#">{{$users['actual_page']}}</a></li>
                    <li class="page-item"><a class="page-link" href="{{ Route('usuarios.index') . $paginator . "&page=" . $users['next_page'] }}">»</a></li>
                  </ul>
                </div>
                <div class="col-6">
                  <p>Mostrando {{$users['items']}} de {{$users['count']}} itens encontrados</p>
                </div>
                <div class="col-4">
                  <div class="form-group float-right">
                    <select name="paginate" form={{$form}} class="custom-select">
                      <option value="10" selected>10</option>
                      <option value="50">50</option>
                      <option value="100">100</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

          {{-- <p>Paginação: {{ $users['first_page_url'] . $paginator }}</p> --}}

        @else
    
        <div class="error-page">
            <div class="error-content">
              <h3><i class="fas fa-exclamation-triangle text-warning"></i> Oops! Nenhum usuário encontrado.</h3>
            </div>
        </div>
    
        @endif
    
        </div>
    </div>
    

</div>
@endsection
