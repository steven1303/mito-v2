<!-- Main content -->
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Receipt Stock</h1>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<section class="content">

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">List Receipt Stock</h3>
                    </div>
                    <form role="form" id="poStockForm" class="form-horizontal" method="POST">
                        {{ csrf_field() }} {{ method_field('POST') }}
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-sm-1 col-form-label">PoStock Doc No.</label>
                                <div class="col-sm-2">                            
                                    <select class="form-control select2" id="poStock" name="poStock" style="width: 100%;">
                                        <option></option>
                                    </select>                            
                                    <span class="text-danger error-text poStock_error"></span>
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-outline-primary btn-block">Create Receipt</button>        
                                </div>
                            </div>                            
                        </div>
                    </form>
                    <div class="card-body">
                        <table id="poStockTable" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>PoStock No</th>
                                <th>SPBD No</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
<!-- /.content -->
@include('admins.javascript.ordering.poStock.poStockList')