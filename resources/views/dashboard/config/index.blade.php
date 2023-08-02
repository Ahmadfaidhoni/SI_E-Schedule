@extends('layouts.master')
@section('style')
    <style>

    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <h4 class="mx-3">Config</h4>
            <div class="card mt-3 mx-3">
                <div class="card-body">
                    @if (session()->has('success'))
                        <div class="alert alert-success col-lg-12">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @elseif(session()->has('error'))
                        <div class="alert alert-danger col-lg-12">
                            {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Key</th>
                                <th scope="col">Value</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($config as $key => $value)
                                <tr>
                                    <th scope="row">{{ $value->key }}</th>
                                    <td>{{ $value->value }}</td>
                                    <td>
                                        <button type="button" class="btn btn-warning" data-key="{{ $value->key }}"
                                            data-value="{{ $value->value }}" data-id="{{ $value->id }}"
                                            onclick="editConfig($(this))" data-toggle="modal" data-target="#modal-edit"><i
                                                class="bi bi-pencil-square"></i>
                                            Edit
                                        </button>
                                    </td>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="form" action="/update_config" method="post">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Config</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="id">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Key</label>
                            <input type="text" class="form-control" id="key" name="key" disabled>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Value</label>
                            <input type="number" class="form-control" id="value" name="value" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('page_script')
    <script>
        function editConfig(e) {

            var id = $(e).data('id');
            var value = $(e).data('value');
            var key = $(e).data('key');

            $('#id').val(id);
            $('#key').val(key);
            $('#value').val(value);
        }
    </script>
@endsection
