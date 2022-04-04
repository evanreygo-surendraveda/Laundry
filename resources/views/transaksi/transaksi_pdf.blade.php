<!DOCTYPE html>
<html>
<head>
	<title>Laporan Transaksi</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<center>
		<h5>Laporan Transaksi</h4>
	</center>

	<table class="table table-striped">
		<thead>
			<tr>
				<th>No</th>
				<th>Nama Member</th>
				<th>No. Transaksi</th>
				<th>Tanggal Transaksi</th>
				<th>Tanggal Bayar</th>
				<th>Nama Kasir</th>
			</tr>
		</thead>
		<tbody>
			<?php
				$penghasilan = 0;	
			?>
			@foreach($transaksis as $transaksi)	
			<tr>
				<td scope="row">{{ $loop->iteration }}</td>
				<td>{{ $transaksi->member->nama }}</td>
				<td>{{ $transaksi->id }}</td>
                <td>{{ $transaksi->tgl }}</td>
                <td>{{ $transaksi->tgl_bayar }}</td>
				<td>{{ $transaksi->user->nama }}</td>
			</tr>
			@endforeach
			@foreach($details as $detail)
			<?php
				$penghasilan += $detail->total;
			?>
			@endforeach
		</tbody>
		<tr>
            <th colspan="5">Penghasilan</th>
            <th>Rp. {{ $penghasilan }}</th>
        </tr>
	</table>
</body>
</html>