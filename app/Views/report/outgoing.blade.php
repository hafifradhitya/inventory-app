@extends('layout.main')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Barang Keluar</h3>
                <div class="float-right">
                    <button class="btn btn-primary btn-print btn-sm">Cetak</button>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover table-data">
                    <thead>
                        <tr>
                            <th>no.</th>
                            <th>Nomor Transaksi</th>
                            <th>Tanggal Transaksi</th>
                            <th>Barang Keluar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @set($no=1)
                        @foreach ($qty as $val)
                        <tr>
                            <td>{{ $no }}</td>
                            <td>{{ $val['code'] }}</td>
                            <td>{{ date('d-m-Y', strtotime($val['date'])) }}</td>
                            <td align="right">{{ number_format($val['total'], 0, ',', '.') }}</td>
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
       document.location = '{{ site_url('laporan/barang-keluar') }}?pemasok='+this.value; 
    });
    
    $('.btn-print').on('click', function(){
        let supplier = $('.supplier').val();
        window.open('{{ site_url('cetak/barang-keluar') }}?supplier='+supplier,'_blank')
    });
</script>
@endsection