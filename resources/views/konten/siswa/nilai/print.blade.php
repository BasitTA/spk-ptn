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
    <div class="col-lg-12 px-3 py-3 g-0">
        {{-- Kembali --}}
        <a href="nilaisiswa" class="no-print ps-2"><i class="bi bi-chevron-left"></i> Kembali</a>
    
        {{-- Nilai Siswa --}}
        <div class="bg-white">
            <div class="pt-3 mx-3 justify-content-between d-flex">
                <h5 class="my-0 align-self-center">Nilai Siswa</h5>
            </div>
            @if ($nilai_siswas->count())
                <div class="mt-3 mx-3 table-responsive">
                    <table class="table table-striped">
                        <thead class="smaller-font table-success">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Siswa</th>
                                <th scope="col">C1</th>
                                <th scope="col">C2</th>
                                <th scope="col">C3</th>
                                <th scope="col">C4</th>
                                <th scope="col">C5</th>
                                <th scope="col">C6</th>
                            </tr>
                        </thead>
                        <tbody class="smaller-font">
                            @foreach ($nilai_siswas as $ns)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $ns->nama }}</td>
                                    @foreach ($ns->pilihan as $pilihan)
                                        <td>{{ $pilihan }}</td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="my-5 text-danger text-center fs-3">Belum ada data yang diinput, silahkan tambah data</p>
            @endif
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
