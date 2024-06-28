@extends('layout.main')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Barang Masuk</h3>
                <div class="float-right">
                    <select class="supplier">
                        <option value="">--Pilih Pemasok--</option>
                        @foreach ($suppliers as $row)
                        @if($pemasok == $row['id'])
                        <option value="{{ $row['id'] }}" selected>{{ $row['name'] }}</option>
                        @else
                        <option value="{{ $row['id'] }}">{{ $row['name'] }}</option>
                        @endif
                        @endforeach
                    </select>
                    <button class="btn btn-primary btn-print btn-sm">Cetak</button>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover table-ajax">
                    <thead>
                        <tr>
                            <th>no.</th>
                            <th>Nomor Transaksi</th>
                            <th>Tanggal Transaksi</th>
                            <th>Total Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        @set($no=1)
                        @foreach ($entrances as $row)
                        <tr>
                            <td>{{ $no }}</td>
                            <td>{{ $row['code'] }}</td>
                            <td>{{ date('d-m-Y', strtotime($row['date'])) }}</td>
                            <td align="right">{{ number_format($row['total'], 0, ',', '.') }}</td>
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
    $('.supplier').on('change', function(){
        document.location = '{{ site_url('laporan/barang-masuk') }}?pemasok='+this.value;
    });
    
    $('.btn-print').on('click', function(){
        let supplier = $('.supplier').val();
        window.open('{{ site_url('cetak/barang-masuk') }}?supplier='+supplier,'_blank')
    });
</script>
@endsection