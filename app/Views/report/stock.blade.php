@extends('layout.main')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Stok Barang</h3>
                <div class="float-right">
                    <button class="btn btn-primary btn-print btn-sm">Cetak</button>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover table-data">
                    <thead>
                        <tr>
                            <th>no.</th>
                            <th>Nama Barang</th>
                            <th>Unit Barang</th>
                            <th>Type Barang</th>
                            <th>Jumlah Stok</th>
                        </tr>
                    </thead>
                    <tbody>
                        @set($no=1)
                        @foreach($products as $val)
                        @set($in = $entrance->selectSum('qty')->where('product_id',$val['id'])->get()->getRow())
                        @set($out = $outgoing->selectSum('qty')->where('product_id',$val['id'])->get()->getRow())
                        @set($stock = intval($in->qty)-intval($out->qty))
                        <tr>
                            <td>{{ $no }}</td>
                            <td>{{ $val['name'] }}</td>
                            <td>{{ $val['unit'] }}</td>
                            <td>{{ $val['type'] }}</td>
                            <td align="right">{{ number_format($stock, 0, ',', '.') }}</td>
                        </tr>
                        @set($no +=1)
                        @endforeach
                    </tbody>
                </table> 
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $('.supplier').on('chnage', function(){
       document.location = '{{ site_url('cetak/stok') }}?pemasok='+this.value; 
    });
    
    $('.btn-print').on('click', function(){
        let supplier = $('.supplier').val();
        window.open('{{ site_url('cetak/stok') }}?supplier='+supplier,'_blank')
    });
</script>
@endsection