@extends('layout.index')

@section('title', 'Equipamentos')

@section('selector', 'Equipamentos')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">@yield('title')</h4>
                    <h6 class="card-subtitle">Todos os equipamentos cadastrados</h6>
                    <div class="table-responsive m-t-40">
                        <table id="dataTable" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Tipo</th>
                                <th>Fabricante</th>
                                @if(Auth::user()->type_id == 1)
                                    <th>Proprietário</th>
                                @endif
                                <th class="text-right">Opções</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($equipment as $e)
                                <tr>
                                    <td>{{ $e->name }}</td>
                                    <td>{{ $e->getTypeEquipmentFormatted()  }}</td>
                                    <td>{{ $e->getManufacturerFormatted() }}</td>
                                    @if(Auth::user()->type_id == 1)
                                        <td>{{ $e->getUser->name  }}</td>
                                    @endif
                                    <td class="text-right">                                        
                                        <a href="{{ route('equipmentEdit', $e->id) }}" title="Editar equipamento">
                                            <button type="button" class="btn btn-info btn-sm"><i
                                                        class="fa fa-edit"></i>
                                            </button>
                                        </a>
                                        <button type="button" class="btn btn-danger btn-sm delete-confirm"
                                                value="{{ route('equipmentDelete', $e->id) }}" title="Excluir equipamento">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection