@extends('layouts.admin')

@section('admin-content')
    <section class="content-header">
        <h1>
            Все детали
            <small><a href="{{ url("admin/parts/add") }}" class="btn btn-primary">Добавить деталь</a> </small>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="box box-primary">
            <div class="box-header"><h3 class="box-title">Типы</h3></div>
            <div class="box-body">

                <table id="product-table" class="table table-bordered table-hover compact">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Название на русском</th>
                        <th>Название на английском</th>
                        <th>Действия</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($parts as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->attribute_ru }}</td>
                            <td>{{ $product->attribute_en }}</td>
                            <td><a href="{{ url("admin/parts/edit/$product->id") }}"><span
                                            class="glyphicon glyphicon-edit"></span></a>
                                <a href="{{ url("admin/parts/delete/$product->id") }}"><span
                                            class="glyphicon glyphicon-remove"></span></a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    @endsection

    @push('scripts')
            <!-- dataTables -->
    <script src="{{ asset('public/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('public/js/dataTables.bootstrap.min.js') }}"></script>
    <script>
        $(document).ready(function(){
            $('#product-table').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "columns": [
                    null,
                    null,
                    null,
                    { orderable: false, width: "5%" }
                ]
            });
        });
    </script>

    @endpush