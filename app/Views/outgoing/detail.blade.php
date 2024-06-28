@extends('layout.main')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar Detail Barang Keluar</h3>
                <div class="float-right">
                    <a href="{{ site_url('barang-keluar') }}" class="btn btn-primary"> Kembali</a>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover table-ajax">
                    <thead>
                        <tr>
                            <th>no.</th>
                            <th>Nama Barang</th>
                            <th style="text-align: right">Qty</th>
                            <th>Satuan</th>
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
          url:'{{ site_url('barang-keluar/list-detail') }}',
          method:'post',
          data:function(d){
              d.outgoing = '{{ $outgoing }}';
          }
      },
      columns:[{data:'no'}, {data:'product'}, {data:'qty'}, {data:'unit'}],
      ordering: false,
      processing: true,
      serverSide: true
   });
});
</script>
@endsection