<!-- resources/views/codes/index.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generated Codes</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap4.min.css">



</head>

<body>
    <h2>Generated Unique Codes</h2>

        <table id="codesTable" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <td>No</td>
                    <td>Tanggal</td>
                    <td>Kode</td>
                    <td>Detail</td>
                </tr>
            </thead>

            <tbody>
                @foreach($generatedCodes as $date => $code)
                <tr>
                    <td> {{ $loop->iteration }}</td>
                    <td>{{ $date }}</td>
                    <td>{{ $code }}</td>
                    <td>
                        <button class="detail-btn" data-date="{{ $date }}">Detail</button>
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#codesTable').DataTable(
                {paging: false}
            );

            $('.detail-btn').on('click', function () {
                var date = $(this).data('date');
                showDetailPopup(date);
            });
        });

        function showDetailPopup(date) {
            $.ajax({
                url: '/codes/' + date + '/detail',
                type: 'GET',
                success: function (response) {
                    if (response.code) {
                        Swal.fire({
                            title: 'Code for ' + date,
                            text: response.code,
                            icon: 'info'
                        });
                    } else {
                        Swal.fire({
                            title: 'Error',
                            text: response.error,
                            icon: 'error'
                        });
                    }
                },
                error: function () {
                    Swal.fire({
                        title: 'Error',
                        text: 'Failed to fetch code detail.',
                        icon: 'error'
                    });
                }
            });
        }
    </script>
</body>

</html>