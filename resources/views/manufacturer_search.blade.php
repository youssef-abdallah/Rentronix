<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ManufacturerSearch</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
    <br />
    <h3 align="center"> Manufacturer Search </h3>
    <br />
    <br />
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <div class="form-group">
                <select name="filter_gender" id="filter_gender" class="form-control" required>
                    <option value="">Select Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>
            <div class="form-group">
                <select name="filter_product" id="filter_product" class="form-control" required>
                    <option value="">Select Product</option>
                    @foreach($manufacturer_products as $productname)

                        <option value="{{ $productname->name }}">
                            {{ $productname->name }}</option>

                    @endforeach
                </select>
            </div>

            <div class="form-group" align="center">
                <button type="button" name="filter" id="filter" class="btn btn-info">Filter</button>

                <button type="button" name="reset" id="reset" class="btn btn-default">Reset</button>
            </div>
        </div>
        <div class="col-md-4"></div>
    </div>
    <br />
    <div class="table-responsive">
        <table id="manufacturer_data" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>Manufacturer Name</th>
                <th>Gender</th>
                <th>Address</th>
                <th>City</th>
                <th>Postal Code</th>
                <th>Products</th>
            </tr>
            </thead>
        </table>
    </div>
    <br />
    <br />
</div>
</body>
</html>

<script>
    $(document).ready(function(){

        fill_datatable();

        function fill_datatable( filter_product = '')
        {
            var dataTable = $('#manufacturer_data').DataTable({
                processing: true,
                serverSide: true,
                ajax:{
                    url: "{{ route('manufacturersearch.index') }}",
                    data:{filter_product:filter_product}
                },
                columns: [
                    {
                        data:'ManufacturerName',
                        name:'ManufacturerName'
                    },
                    {
                        data:'Gender',
                        name:'Gender'
                    },
                    {
                        data:'Address',
                        name:'Address'
                    },
                    {
                        data:'City',
                        name:'City'
                    },
                    {
                        data:'PostalCode',
                        name:'PostalCode'
                    },
                    {
                        data:'name',
                        name:'Products'
                    }
                ]
            });
        }

        $('#filter').click(function(){

            var filter_product = $('#filter_product').val();
            var filter_gender = $('#filter_gender').val();


            if(filter_product !== ''&& filter_gender!=='' )
            {
                $('#manufacturer_data').DataTable().destroy();
                fill_datatable(filter_gender,filter_product);
            }
            else
            {
                alert('Select  filter option');
            }
        });

        $('#reset').click(function(){
            // $('#filter_gender').val('');
            $('#filter_product').val('');
            $('#manufacturer_data').DataTable().destroy();
            fill_datatable();
        });

    });
</script>
