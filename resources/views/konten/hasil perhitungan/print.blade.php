<html>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    {{-- bootrap icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link href="css/style.css" rel="stylesheet">
    <title>SPK - {{ $title }}</title>
</head>

<body>
    <div class="col-lg-12 g-0 px-2 pt-3">
        <div class="d-flex justify-content-between mx-2">
            {{-- Kembali --}}
            @if (auth()->user()->level=="admin" || auth()->user()->level=="kepsek")
                <a href="hasilperhitungan" class="no-print ps-2"><i class="bi bi-chevron-left"></i> Kembali</a>
            @endif
        </div>
        
        @if (auth()->user()->level=="user")
            <div class="d-flex justify-content-end">
                <a onClick="window.print()" type="button" class="no-print btn btn-sm btn-primary"><i class="bi bi-printer"></i> Cetak</a>    
                <form class="my-0 ms-1 me-3 no-print" action="/logout" method="post">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-box-arrow-right"></i> Logout</button>
                </form>
            </div>
        @endif
    
        @if(count($kuota)>0)
            {{-- Nilai Preferensi (Ranking) --}}
            <div class="bg-white">
                <div class="pt-3">
                    {{-- Header --}}
                    <div class="mx-3">
                        <div class="d-flex justify-content-between">
                            <h5 class="my-0 align-self-center text-dark inliner">Data Siswa Diterima</h5>
                        </div>
                    </div>
                    {{-- Table --}}
                    <div class="mt-3 mx-3 bg-light table-responsive">
                        <table class="table table-striped">
                            <thead class="table-success">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Siswa</th>
                                    <th scope="col">Nilai</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($hasil_perangkingan->slice(0, $kuota[0]->kuota) as $hp)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $hp->nama }}</td>
                                        <td>{{ $hp->nilai_preferensi }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-3 mx-3">*Data di atas merupakan data siswa yang dinyatakan lulus, jika ingin melihat hasil penilaian lebih lanjut dapat menghubungi admin</div>
                </div>
            </div>    
        @else
            <h5 class="d-flex my-5 justify-content-center">Mohon menunggu, data belum selesai diproses.. </h5>
        @endif
    </div>

    <script type="text/javascript">
        window.print();
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="js/script.js"></script>
</body>

</html>