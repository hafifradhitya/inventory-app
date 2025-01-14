@extends('layout.main')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar Pemasok</h3>
                <div class="float-right">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#modal-add"><i class="fa fa-plus"></i> Tambah Baru</button>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover table-ajax">
                    <thead>
                        <tr>
                            <th>no.</th>
                            <th>Nama Perusahaan</th>
                            <th>Nama Sales</th>
                            <th>Nomor Telepon</th>
                            <th>Alamat Perusahaan</th>
                            <th style="width: 74px;">&nbsp;</th>
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
                <h4 class="modal-title">Tambah Pemasok Baru</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-ajax form-horizontal" action="{{ site_url('master/pemasok/create') }}" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Nama Perusahan</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="text" class="form-control" name="name" placeholder="Nama Perusahaan">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Nomor Telepon</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="text" class="form-control" name="phone" placeholder="Nomor Telepon">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Nama Sales</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="text" class="form-control" name="sales" placeholder="Nama Sales">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Alamat Perusahaan</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <textarea class="form-control" name="address" placeholder="Alamat Perusahaan"></textarea>
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
                <h4 class="modal-title">Edit Pemasok</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-ajax form-horizontal" action="{{ site_url('master/pemasok/update') }}" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Nama Perusahan</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Nama Perusahaan">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Nomor Telepon</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="Nomor Telepon">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Nama Sales</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="text" class="form-control" id="sales" name="sales" placeholder="Nama Sales">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Alamat Perusahaan</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <textarea class="form-control" id="address" name="address" placeholder="Alamat Perusahaan"></textarea>
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
          url:'{{ site_url('master/pemasok/list') }}',
          method:'post'
      },
      columns:[{data:'no'},{data:'name'},{data:'sales'},{data:'phone'}, {data:'address'}, {data:'action'}],
      ordering: false,
      processing: true,
      serverSide: true
    });
    $(document).on('click', '.btn-edit', function(){
        let btn = $(this);
        $('input[name=id]').val(btn.data('id'));
        $('#name').val(btn.data('name'));
        $('input[phone=id]').val(btn.data('phone'));
        $('#phone').val(btn.data('phone'));
        $('input[sales=id]').val(btn.data('sales'));
        $('#sales').val(btn.data('sales'));
        $('textarea[address=id]').val(btn.data('address'));
        $('#address').val(btn.data('address'));
        $('#modal-edit').modal();
    });
});
</script>
@endsection