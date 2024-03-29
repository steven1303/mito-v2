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
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">List Adjustment</h3>
                    </div>
                    @can('adjustment.store', Auth::user())
                    <div class="card-body row">                        
                        <div class="col-md-2">
                            <form role="form" id="AdjForm" method="POST">
                            {{ csrf_field() }} {{ method_field('POST') }}
                                <button type="submit" class="btn btn-outline-primary btn-block">Create Adjustment</button>
                            </form>
                        </div>                        
                    </div>
                    @endcan
                    <div class="card-body">
                        <table id="adjustmentTable" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Document No</th>
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
@include('admins.javascript.inventory.adjustment.adjustmentList')