<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" rel="stylesheet">
<link href="https://cdn.datatables.net/responsive/2.2.2/css/responsive.dataTables.min.css" rel="stylesheet">

<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<style>
    .table-responsive {

        overflow-x: none !important;
    }

    @media (min-width: 1200px) {
        .container {
            max-width: 1271px !important;
        }
    }

    .bg-dark {
        background-color: #fff !important;;
    }

    .form-control {
        height: 32px !important;
    }

    h1 {

        line-height: 1.5 !important;
        font-size: 36px !important;
    }

    .navbar {

        padding: 0px !important;
    }

    body {

        color: gray !important;
    }

    a.w3-bar-item.w3-button {
        color: white !important;
    }
</style>
<script>
    $(document).ready(function () {
        $('#dataTables-example').dataTable();
    });
</script>