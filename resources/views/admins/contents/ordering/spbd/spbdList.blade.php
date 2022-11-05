<!-- Main content -->
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>SPBD</h1>
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
                        <h3 class="card-title">List SPBD</h3>
                    </div>
                    @if($access['store'])
                    <div class="card-body row">
                        <div class="col-md-3">
                            <form role="form" id="spbdForm" method="POST">
                            {{ csrf_field() }} {{ method_field('POST') }}
                                <button type="submit" class="btn btn-outline-primary btn-block">Create SPBD</button>
                            </form>
                        </div>
                    </div>
                    @endif
                    <div class="card-body">
                        <table id="spbdTable" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>No</th>
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
@include('admins.javascript.ordering.spbd.spbdList')