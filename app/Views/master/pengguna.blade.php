@extends('layout.main')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar Pengguna</h3>
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
                            <th>Status</th>
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
                <h4 class="modal-title">Tambah Pengguna</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-ajax form-horizontal" action="{{ site_url('master/pengguna/create') }}" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Nama Lengkap</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="text" class="form-control" name="nama" placeholder="Nama Lengkap">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Alamat Email</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="email" class="form-control" name="email" placeholder="Alamat Email">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Status</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <select name="status" class="form-control">
                                <option value="1">Aktif</option>
                                <option value="0">Tidak Aktif</option>
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
                <h4 class="modal-title">Edit Pengguna</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-ajax form-horizontal" action="{{ site_url('master/pengguna/update') }}" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Nama Lengkap</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="text" class="form-control" name="nama" placeholder="Nama Lengkap">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Alamat Email</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="email" class="form-control" name="email" placeholder="Alamat Email">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Status</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <select id="inputStatus" name="status" class="form-control">
                                <option value="1">Aktif</option>
                                <option value="0">Tidak Aktif</option>
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
          url:'{{ site_url('master/pengguna/list') }}',
          method:'post'
      },
      columns:[{data:'no'},{data:'nama'},{data:'email'},{data:'status'},{data:'action'}],
      ordering: false,
      processing: true,
      serverSide: true
    });
    $(document).on('click', '.btn-edit', function(){
       let btn = $(this);
       $('input[name=id').val(btn.data('id'));
       $('input[name=nama').val(btn.data('nama'));
       $('input[name=email').val(btn.data('email'));
       $('input[name=status').val(btn.data('status'));
       $('#modal-edit').modal();
    });
});
</script>
@endsection