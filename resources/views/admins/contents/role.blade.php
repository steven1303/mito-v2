<!-- Main content -->
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Role</h1>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<section class="content">

    <div class="container-fluid">
        <div class="row">
            @canany(['role.store', 'role.update'], Auth::user())
            <div class="col-md-3">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Input Role</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form  role="form" id="roleForm" method="POST">
                        {{ csrf_field() }} {{ method_field('POST') }}
                        <input type="hidden" id="id" name="id">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="nama">Name</label>
                                <input type="text" class="form-control" id="role_name" name="role_name" placeholder="Enter Nama">
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
            @canany(['role.store', 'role.update'], Auth::user())
            <div class="col-md-9">
            @elsecanany(['role.view'], Auth::user())
            <div class="col-md-12">
            @endcanany
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Role</h3>
                    </div>
                    <div class="card-body">
                        <table id="roleTable" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                @canany(['role.delete', 'role.update','role.permission'], Auth::user())
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

@include('admins.javascript.role')