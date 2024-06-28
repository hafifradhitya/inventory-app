@extends('layout.main')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar Barang</h3>
                <div class="float-right">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#modal-add"><i class="fa fa-plus"></i> Tambah Baru</button>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover table-ajax">
                    <thead>
                        <tr>
                            <th>no.</th>
                            <th>Nama Barang</th>
                            <th>Unit Barang</th>
                            <th>Type Barang</th>
                            <th style="width:74px; text-align: center;">&nbsp;</th>
                        </tr>
                    </thead>
                </table> 
            </div>
        </div>
    </div>
</div>
@endsection

@section('modal')
<div class="modal fade" id="modal-add">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Barang Baru</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-ajax form-horizontal" action="{{ site_url('master/barang/create') }}" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Nama Barang</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="text" class="form-control" name="name" placeholder="Nama Barang">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Unit Barang</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <select class="form-control" name="unit_id">
                                @foreach ($units as $unit)
                                <option value="{{ $unit['id'] }}">{{ $unit['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Type Barang</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <select class="form-control" name="type_id">
                                @foreach ($types as $type)
                                <option value="{{ $type['id'] }}">{{ $type['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Barang</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-ajax form-horizontal" action="{{ site_url('master/barang/update') }}" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Nama Barang</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="text" class="form-control" name="name" placeholder="Nama Barang">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Unit Barang</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <select class="form-control" name="unit_id">
                                @foreach ($units as $unit)
                                <option value="{{ $unit['id'] }}">{{ $unit['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Type Barang</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <select class="form-control" name="type_id">
                                @foreach ($types as $type)
                                <option value="{{ $type['id'] }}">{{ $type['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('script')
<script>
$(document).ready(function(){
    $('.table-ajax').DataTable({
        ajax:{
            url:'{{ site_url('master/barang/list') }}',
            method:'post'
        },
        columns:[{data:'no'},{data:'name'},{data:'unit'},{data:'type'},{data:'action'}],
        ordering: false,
        processing: true,
        serverSide: true
    });
   
    $(document).on('click', '.btn-edit', function(){
        let btn = $(this);
        $('input[name=id]').val(btn.data('id'));
        $('input[name=name]').val(btn.data('name'));
        $('input[name=unit_id]').val(btn.data('unit_id'));
        $('input[name=type_id]').val(btn.data('type_id'));
        $('#modal-edit').modal();
    });
});
</script>
@endsection