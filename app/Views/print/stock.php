<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>LAPORAN STOK BARANG</title>
        <style>
            .table{
                font-family: Arial,Helvetica,sans-serif;
                border-collapse: collapse;
                width: 100%;
            }
            .table td, .table th{
                border: 1px solid #DDD;
                padding: 5px;
            }
            
            .table tr:nth-child(even){
                background-color: #F2F2F2;
            }
            
            .table tr:hover{
                background-color: #DDD;
            }
            
            .table th{
                padding-top: 8px;
                padding-bottom: 8px;
                text-align: left;
                background-color: #3F84E5;
                color: white;
            }
        </style>
    </head>
    <body>
        <div style="text-align: center">Laporan Stok Barang</div>
        <table class="table">
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
                   <?= $table;?>
            </tbody>
        </table>
    </body>
</html>
