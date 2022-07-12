<!doctype html>
<html lang="en">
    <!--begin::Head-->
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>CarShop</title>
        @csrf
        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" rel="stylesheet" type="text/css" />
        <link href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    </head>
    <!--end::Head-->
    <!--begin::Body-->
    <body>
        <div class="container pt-3">
            <h1>CarShop</h1>
            <!--begin::Toolbar-->
            <div class="row py-3">
                <div class="d-flex col-lg-4 align-items-center mb-1">
                    <label class="m-0">Seller Type: &nbsp</label>
                    <select id="type" class="form-select px-2 py-1">
                        <option value="all">All Car Type</option>
                        @foreach($types as $type)
                        <option value="{{ $type->model }}">{{ $type->model }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="d-flex col-lg-3 align-items-center mb-1">
                    <label class="m-0">Order By: &nbsp</label>
                    <select id="order_by" class="form-select px-2 py-1">
                        <option value="make">Make</option>
                        <option value="model">Model</option>
                        <option value="seller">Seller</option>
                        <option value="year">Year</option>
                        <option value="condition">Condition</option>
                        <option value="price">Price</option>
                        <option value="status">Status</option>
                    </select>
                </div>
            </div>
            <!--end::Toolbar-->
            <!--begin::Table-->
            <table id="car_table" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Make</th>
                        <th>Model</th>
                        <th>Seller</th>
                        <th>Year</th>
                        <th>Condition</th>
                        <th>Price</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cars as $car)
                    <tr>
                        <td>{{ $car->make }}</td>
                        <td>{{ $car->model }}</td>
                        <td>{{ $car->seller }}</td>
                        <td>{{ $car->year }}</td>
                        <td>{{ $car->condition }}</td>
                        <td>{{ $car->price }}</td>
                        <td>{{ $car->status }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <!--begin::Table-->
        </div>
        <!--begin::Javascript-->
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {

                var table = $('#car_table').DataTable({order: []});
                
                //get data by option
                $('#type, #order_by').on('change', function(){
                    var type = $('#type').val();
                    var order = $('#order_by').val();
                    $.ajax({
                        method:'POST',
                        url: 'get-option',
                        data:{  
                          _token: $('input[name="_token"]').val(),
                          type: type,
                          order: order
                        },
                        success:function(res) {

                            var data = [];
                        
                            for (let i = 0; i < res.length; i++) {
                                var e = res[i];
                                var array = [e.make, e.model, e.seller, e.year, e.condition, e.price, e.status]
                                data.push(array);
                            }

                            var table = $('#car_table').DataTable({ 
                                destroy: true,
                                data: data,
                                columns: [
                                    { title: "Make" },
                                    { title: "Model" },
                                    { title: "Seller" },
                                    { title: "Year" },
                                    { title: "Condition" },
                                    { title: "Price" },
                                    { title: "Status" },
                                ],
                                order: []
                            });

                        }
                    });
                });
            });
        </script>
        <!--end::Javascript-->
    </body>
    <!--end::Body-->
</html>