@extends('layouts.admin')

@section('content')
  <div class="container-fluid px-5 py-2">
    @if (session('message'))
      <div class="alert alert-success" role="alert">
        <span>{{session('message')}}</span>
      </div>
    @endif

    <h2 class="fs-4 text-secondary my-4">
      Gestione Tipi
    </h2>

    <div class="pgtable-wrapper">
      <form action="{{route('admin.types.store')}}" method="POST">
        @csrf
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="name" placeholder="Nuovo Tipo">
          <button class="btn btn-outline-secondary" type="submit" id="button-addon2"><i class="fa-solid fa-plus"></i> Add</button>
        </div>
      </form>

      <table class="table">
        <thead>
          <tr>
            <th scope="col">Nome</th>
            <th scope="col">Numero di Progetti</th>
            <th scope="col" class="text-center">Azioni</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($types as $type)
          <tr>
            <th scope="row">
              <form action="{{route('admin.types.update', $type)}}" method="POST" id="edit_form">
                @csrf
                @method('PUT')
                <input type="text" class="form-control border-0" name="name" value="{{$type->name}}">
              </form>
            </th>
            <td>{{count($type->projects)}}</td>
            <td class="text-center">
              <button onclick="submitEditForm()" class="btn btn-primary"><i class="fa-solid fa-floppy-disk" title="Edit"></i></button>
              @include('admin.partials.modal', [
                'name' => $type->name,
                'id' => $type->id,
                'route' => route('admin.types.destroy', $type),
                'type' => 'tipo'
              ])
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

  <script>
    function submitEditForm(){
      const form = document.getElementById('edit_form');
      form.submit();
    }
  </script>
@endsection
