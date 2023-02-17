@extends('Client.index')
@section('content')
    <style>
        .pagination {
            display: flex;
            justify-content: flex-end;
            flex-wrap: wrap;
            flex-direction: row;
            align-content: space-between;
        }
    </style>
    <div class="container" style="margin-top: 30px">
        <div class="card">
            <div class="card-header">
                <h2>Repositorio Nimbu</h2>
            </div>
            <div class="card-body">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table" id="">
                            <thead class="font-weight-bold text-center">
                                <tr>
                                    <th>Icono</th>
                                    <th>Autor</th>
                                    <th>Titulo</th>
                                    <th>descripción</th>
                                    <th>Fecha</th>
                                    <th>Ver</th>
                                    <th>Descargar</th>
                                </tr>
                            </thead>
                            <tbody class="">
                                @foreach ($repositorio as $repo)
                                    <tr>
                                        <td><img src="../../../images/pdf.png" width="25px" height="25px" alt="">
                                        </td>
                                        <td>{{ $repo->autor }}</td>
                                        <td>{{ $repo->titulo }}</td>
                                        <td>{{ $repo->descripcion }}</td>
                                        <td>{{ $repo->fecha }}</td>
                                        <td><a href="../../../documentos/repositorioDocumental/{{ $repo->documento }}"
                                                target="_blank">Ver</a></td>
                                        <td><a href="../../../documentos/repositorioDocumental/{{ $repo->documento }}"
                                                download>Descargar</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="pagination">
            {!! $repositorio->links() !!}
        </div>
    </div>

@stop
