<!-- Main content -->
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Transfer Branch</h1>
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
                        <h3 class="card-title">List Transfer Branch</h3>
                    </div>
                    <div class="card-body row">
                        <div class="col-md-2">
                            <form role="form" id="transferBranchForm" method="POST">
                            {{ csrf_field() }} {{ method_field('POST') }}
                                <button type="submit" class="btn btn-outline-primary btn-block">Create Transfer</button>
                            </form>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="transferBranchTable" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Document No</th>
                                <th>To Branch</th>
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
@include('admins.javascript.inventory.transferBranch.transferBranchList')