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
        {{-- Kembali --}}
        <a href="hasilperhitungan" class="no-print ps-2"><i class="bi bi-chevron-left"></i> Kembali</a>
    
        {{-- Nilai Preferensi (Ranking) --}}
        <div class="bg-white">
            <div class="pt-3">
                {{-- Header --}}
                <div class="mx-3">
                    <div class="d-flex justify-content-between">
                        <h5 class="my-0 align-self-center text-dark inliner">Hasil Perangkingan</h5>
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
                            @foreach ($hasil_perangkingan as $hp)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $hp->nama }}</td>
                                    <td>{{ $hp->nilai_preferensi }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>    
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