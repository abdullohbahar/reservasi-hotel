<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <style>
        .frame {
            width: 10cm;
            height: 10cm;
            /* border: 2px solid red; */
        }

        .dashed-line {
            width: 100%;
            /* Lebar elemen */
            height: 2px;
            /* Tinggi garis */
            border-bottom: 1.5px dashed black;
            /* Garis putus-putus dengan ketebalan 2px */
        }

        .dotted-line {
            width: 100%;
            /* Lebar elemen */
            height: 2px;
            /* Tinggi garis */
            border-bottom: 2px dotted black;
            /* Garis putus-putus dengan ketebalan 2px */
        }
    </style>
</head>

<body>
    <div class="frame">
        <h2 style="text-align: center;"><b>Hotel Bale Catur Inn</b></h2>
        <div class="dashed-line"></div>
        <table>
            <tr>
                <td>Tanggal</td>
                <td>: {{ \Carbon\Carbon::now()->format('d-m-Y') }}</td>
            </tr>
            <tr>
                <td>Resepsionis</td>
                <td>: -</td>
            </tr>
        </table>
        <div class="dotted-line"></div>
        <h3 style="text-align: center;"><b>{{ $riwayat->no_booking }}</b></h3>
        <div style="text-align:right; margin-bottom: 10px">
            <span>No Kamar: {{ $riwayat->no_kamar }}</span>
        </div>
        <table style="width: 100%">
            <tr>
                <td>Nama</td>
                <td>: {{ $riwayat->nama_tamu }}</td>
            </tr>
            <tr>
                <td>Tipe Kamar</td>
                <td>: {{ $riwayat->tipe_kamar }} </td>
                <td>
            </tr>
            <tr>
                <td>Check-In</td>
                <td>: {{ $riwayat->checkin }}</td>
            </tr>
            <tr>
                <td>Check-Out</td>
                <td>: {{ $riwayat->checkout }}</td>
            </tr>
        </table>
        <div class="dotted-line"></div>
        <div style="text-align: right; margin-top: 6px;">
            <span>Total Biaya : Rp {{ number_format($riwayat->total_biaya, 0, '', '.') }} </span>
        </div>
    </div>
</body>

</html>
