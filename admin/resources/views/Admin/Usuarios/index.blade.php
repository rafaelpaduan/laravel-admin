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

    $form="search-users";
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
        @if (count($users) > 0)
          <div class="card">
            <div class="card-body table-responsive p-0">
              <table class="table table-hover text-nowrap">
                <thead>
                  <tr>
                    @foreach ($users[0] as $key => $value)
                    <th>{{ $key }}</th>
                    @endforeach
                  </tr>
                </thead>
                <tbody>
                @foreach ($users as $user)
                    <tr>
                        @foreach ($user as $item)
                            <td>{{ $item }}</td>
                        @endforeach
                    </tr>
                @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
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
