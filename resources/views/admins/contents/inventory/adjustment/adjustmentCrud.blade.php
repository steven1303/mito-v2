<!-- Main content -->
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Adjustment</h1>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<section class="content">

    <div class="container-fluid">
        <div class="row">
            @canany(['adjustment.store', 'adjustment.update'], Auth::user())
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title" id="formTitle">Add New Adjustment</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form  role="form" id="stockMasterForm" method="POST">
                        {{ csrf_field() }} {{ method_field('POST') }}
                        <input type="hidden" id="id" name="id">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="nama">Adjustment Number</label>
                                        <input type="text" class="form-control" id="stock_no" name="stock_no" placeholder="Input Stock Number"> 
                                        <span class="text-danger error-text stock_no_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="city">Stock Name</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Input Stock Name">
                                        <span class="text-danger error-text name_error"></span>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="phone">Maximal SOH</label>
                                        <input type="text" class="form-control" id="max_soh" name="max_soh" placeholder="Input Max SOH" value="0">
                                        <span class="text-danger error-text max_soh_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="phone">Minimal SOH</label>
                                        <input type="text" class="form-control" id="min_soh" name="min_soh" placeholder="Input Min SOH" value="0">
                                        <span class="text-danger error-text min_soh_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="phone">Bin</label>
                                        <input type="text" class="form-control" id="bin" name="bin" placeholder="Input Bin">
                                        <span class="text-danger error-text bin_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="phone">Satuan</label>
                                        <input type="text" class="form-control" id="satuan" name="satuan" placeholder="Input Unit">
                                        <span class="text-danger error-text satuan_error"></span>
                                    </div>
                                </div>
                            </div> 
                        </div>
                      <!-- /.card-body -->
      
                        <div class="card-footer">
                            <button id="btnSave" type="submit" class="btn btn-primary">Create New</button>
                            <button type="button" class="btn btn-default" onclick="cancel()">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
            @endcanany
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">List Stock Master</h3>
                    </div>
                    <div class="card-body">
                        <table id="stockMasterTable" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Stock No</th>
                                <th>Name</th>
                                <th>Bin</th>
                                <th>SOH</th>
                                <th>Satuan</th>
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
@include('admins.javascript.inventory.stock_master')