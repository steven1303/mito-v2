<!-- Main content -->
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Admin</h1>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<section class="content">

    <div class="container-fluid">
        <div class="row">
            @canany(['admin.store', 'admin.update'], Auth::user())
            <div class="col-md-3">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Input Admin</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form  role="form" id="adminForm" method="POST">
                        {{ csrf_field() }} {{ method_field('POST') }}
                        <input type="hidden" id="id" name="id">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="nama">Name</label>
                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Enter Nama">
                            </div>
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" name="username" placeholder="Enter Username">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                            </div>
                            <div class="form-group">
                                <label>Select Role</label>
                                <select class="form-control"  id="role" name="role">
                                    @foreach ($roles as $role)
                                        @if($role->id != 1)
										    <option value="{{ $role->id }}">{{ $role->role_name }}</option>
                                        @else
                                            @if(Auth::user()->id_role == 1)
                                                <option value="{{ $role->id }}">{{ $role->role_name }}</option>
                                            @endif
                                        @endif
									@endforeach
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
            @canany(['admin.store', 'admin.update'], Auth::user())
            <div class="col-md-9">
            @elsecanany(['admin.view'], Auth::user())
            <div class="col-md-12">
            @endcanany
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Admin</h3>
                    </div>
                    <div class="card-body">
                        <table id="adminTable" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Username</th>
                                <th>Role</th>
                                @canany(['admin.delete', 'admin.update'], Auth::user())
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

@include('admins.javascript.admin')