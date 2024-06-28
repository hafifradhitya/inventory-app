@extends('layout.main')

@section('content')
<form class="form-ajax" action="{{ site_url('barang-masuk/create') }}">
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Info Transaksi</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-4">
                        <input class="form-control" value="{{ $code }}" readonly>
                    </div>
                    <div class="col-4">
                        <input class="form-control" value="{{ date('d-m-Y') }}" readonly>
                    </div>
                    <div class="col-4">
                        <select class="form-control" name="supplier">
                            @foreach ($supplier as $row)
                            <option value="{{ $row['id'] }}">{{ $row['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar Barang</h3>
                <div class="float-right">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-add"><i class="fa fa-plus"></i> Tambah Baru</button>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-local table-bordered table-hover table-ajax">
                    <thead>
                        <tr>
                            <th>Nama Barang</th>
                            <th style="text-align: right">Qty</th>
                            <th>Satuan</th>
                            <th style="text-align: right">Harga</th>
                            <th style="text-align: right">Total</th>
                            <th style="width:40px">&nbsp;</th>
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
                                <option value="{{ $row['id'] }}" data-type="{{ $row['type'] }}" data-unit="{{ $row['unit'] }}">{{ $row['name'] }}</option>
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
                            <input type="text" class="form-control" id="unit" name="unit" placeholder="Satuan Barang" readonly>
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
                    <div class="row">
                        <div class="col-md-4">
                            <label>Harga Barang</label>
                        </div>
                        <div class="col-md-8 form-group">
                            <input type="text" class="form-control autonumeric" id="price" name="price" placeholder="Harga Barang">
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
@endsection

@section('script')
<script>
    let tbody = $('.table-local').children('tbody');
    function removeRow(row){
        row.closest('tr').remove();
    }
    $(function(){
       $(document).on('change','#product',function(){
          let select=$(this);
          let option=$('option:selected',this);
          $('#type').val(option.data('type'));
          $('#unit').val(option.data('unit'));
       });
       $('.form-local').on('submit',function(e){
           e.preventDefault();
           let data = {};
           let field = $('form').serializeArray();
           for(var i = 0; i<field.length;i++){
               var record = field[i];
               data[record.name] = record.value;
           }
           console.log(data);
           tbody.append($('<tr>')
               .append($('<td>').append('<input type="hidden" name="product[]" value="'+data['product']+'">'+$('#product option:selected').text()))
               .append($('<td style="text-align: right">').append('<input type="hidden" name="qty[]" value="'+data['qty']+'">'+data['qty']))
               .append($('<td>').append(data['unit']))
               .append($('<td style="text-align: right">').append('<input type="hidden" name="price[]" value="'+data['price']+'">'+formatRupiah(data['price'])))
               .append($('<td style="text-align: right">').append(formatRupiah(data['qty']*data['price'])))
               .append($('<td>').append('<button class="btn btn-danger" onclick="removeRow($(this))"><i class="fa fa-trash"></i></button>'))
            );
            
            $('#modal-add').modal('hide');
            $('.form-local')[0].reset();
       });
    });
</script>
@endsection