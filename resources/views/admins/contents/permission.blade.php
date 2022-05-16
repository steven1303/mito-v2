<!-- Main content -->
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Permission</h1>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<section class="content">

    <div class="container-fluid">
        <div class="row">
            @canany(['permission.store', 'permission.update'], Auth::user())
            <div class="col-md-3">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Input Permission</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form  role="form" id="permissionForm" method="POST">
                        {{ csrf_field() }} {{ method_field('POST') }}
                        <input type="hidden" id="id" name="id">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="nama">Permission Name</label>
                                <input type="text" class="form-control" id="permission_name" name="permission_name" placeholder="Enter Nama">
                            </div>
                            <div class="form-group">
                                <label for="nama">Permission For</label>
                                <input type="text" class="form-control" id="permission_for" name="permission_for" placeholder="Enter Nama">
                            </div>
                            <div class="form-group">
                                <label for="nama">Permission Status</label>
                                <select class="form-control"  id="status" name="status">
                                    <option value=1>Aktif</option>
                                    <option value=0>Non Aktif</option>
                                </select>
                            </div>
                        </div>
                      <!-- /.card-body -->
      
                        <div class="card-footer">
                            <button id="btnSave" type="submit" class="btn btn-primary">Create</button>
                            <button type="button" class="btn btn-default" onclick="cancel()">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
            @endcanany
            @canany(['permission.store', 'permission.update'], Auth::user())
            <div class="col-md-9">
            @elsecanany(['permission.view'], Auth::user())
            <div class="col-md-12">
            @endcanany
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Permission</h3>
                    </div>
                    <div class="card-body">
                        <table id="permissionTable" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Permission Name</th>
                                <th> For</th>
                                <th>Status</th>
                                @canany(['permission.delete', 'permission.update'], Auth::user())
                                <th>Action</th>
                                @endcanany
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

@include('admins.javascript.permission')