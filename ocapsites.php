<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'connection.php'; ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ocap Sites</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
</head>
<body>
    <div style="padding-left:16px">
        <h2>Import Ocap Sites</h2>
        <table id="ocapSitesTable" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Site Name</th>
                    <th>Site Code</th>
                    <th>Address</th>
                    <th>City</th>
                    <th>State</th>
                    <th>Country</th>
                    <!-- Add more columns as per your table structure -->
                </tr>
            </thead>
            <tbody>
                <!-- Data will be populated by DataTables -->
            </tbody>
        </table>
    </div>

    <script>
        $(document).ready(function() {
            $('#ocapSitesTable').DataTable({
                "ajax": "api_ocap_sites.php",
                "columns": [
                    { "data": "id" },
                    { "data": "site_name" },
                    { "data": "site_code" },
                    { "data": "site_address" },
                    { "data": "site_city" },
                    { "data": "site_state" },
                    { "data": "site_country" }
                ]
            });
        });
    </script>
</body>
</html>
