@extends('layout.main')

@section('content')<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar Barang Masuk</h3>
                <div class="float-right">
                    <a href="{{ site_url('barang-masuk/baru') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Transaksi</a>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover table-ajax">
                    <thead>
                        <tr>
                            <th>no.</th>
                            <th>No Transaksi</th>
                            <th>Tanggal Transaksi</th>
                            <th>Pemasok</th>
                            <th>Total Harga</th>
                            <th style="width: 74px;">&nbsp;</th>
                        </tr>
                    </thead>
                </table> 
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
$(document).ready(function(){
   $('.table-ajax').DataTable({
      ajax:{
          url:'{{ site_url('barang-masuk/list') }}',
          method:'post'
      },
      columns:[{data:'no'}, {data:'code'}, {data:'date'}, {data:'supplier'}, {data:'total'}, {data:'action'}],
      ordering: false,
      processing: true,
      serverSide: true
   });
});
</script>
@endsection