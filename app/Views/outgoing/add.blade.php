@extends('layout.main')

@section('content')
<form class="form-ajax" action="{{ site_url('barang-keluar/create') }}">
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Info Transaksi Barang Keluar</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <input class="form-control" value="{{ $code }}" readonly>
                    </div>
                    <div class="col-6">
                        <input class="form-control" value="{{ date('d-m-Y') }}" readonly>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar Barang Keluar</h3>
                <div class="float-right">
                    <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modal-add"><i class="fa fa-plus"></i> Tambah Baru</button>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-local table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Nama Barang</th>
                            <th>Qty</th>
                            <th style="width: 74px">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table> 
            </div>
            <div class="card-footer">
                <div class="float-right">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</div>
</form>
@endsection

@section('modal')
<div class="modal fade" id="modal-add">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Daftar Barang</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-local form-horizontal">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Nama Barang</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <select class="form-control" id="product" name="product">
                                <option>--Pilih Barang--</option>
                                @foreach ($barang as $row)
                                <option value="{{ $row['id'] }}" data-type="{{ $row['type'] }}" data-unit="{{ $row['unit'] }}" data-stok="{{ $row['stok'] }}">{{ $row['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Jenis Barang</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="text" class="form-control" id="type" placeholder="Jenis Barang" readonly> 
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Satuan Barang</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="text" class="form-control" id="unit" placeholder="Satuan Barang" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Jumlah Barang</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="text" class="form-control autonumeric" id="qty" name="qty" placeholder="Jumlah Barang">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="stok" name="stok">
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
    let tbody = $('.table-local').children('tbody');
    function removeRow(row){
        row.closest('tr').remove();
    }
    $(function(){
       $(document).on('change','#product',function(){
          let option=$('option:selected',this);
          $('#type').val(option.data('type'));
          $('#unit').val(option.data('unit'));
          $('#stok').val(option.data('stok'));
       });
       $('.form-local').on('submit',function(e){
           e.preventDefault();
           let data = {};
           let field = $('form').serializeArray();
           for(var i = 0; i<field.length;i++){
               var record = field[i];
               data[record.name] = record.value;
           }
           if(data['stok']>=data['qty']){
               tbody.append($('<tr>')
                    .append($('<td>').append('<input type="hidden" name="product[]" value="'+data['product']+'">'+$('#product option:selected').text()))
                    .append($('<td style="text-align: right">').append('<input type="hidden" name="qty[]" value="'+data['qty']+'">'+data['qty']))
                    .append($('<td>').append('<button class="btn btn-danger" onclick="removeRow($(this))"><i class="fa fa-trash"></i></button>'))
                 );

                 $('#modal-add').modal('hide');
                 $('.form-local')[0].reset();
           }else{
                Swal.fire({
                    icon:'error',
                    title:'Jumlah Yang Anda Masukkan Melebihi Stok, Stok saat ini '+data['stok'],
                    timer:1500,
                    showConfirmButton:false
                });
            }
       });
    });
</script>
@endsection