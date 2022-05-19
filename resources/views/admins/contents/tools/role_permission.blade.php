<!-- Main content -->
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Access Permission</h1>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<section class="content">

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#inventory" data-toggle="tab">Inventory</a></li>
                            <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li>
                            <li class="nav-item"><a class="nav-link" href="#tools" data-toggle="tab">Tools</a></li>
                            <li class="nav-item"><a class="nav-link" href="#website" data-toggle="tab">Website</a></li>
                        </ul>
                    </div>
                    <form  role="form" id="formPermission_role" method="POST">
                        {{ csrf_field() }} {{ method_field('POST') }}
                        <input type="hidden" id="id" name="id" value="{{ $role->id }}">
                        <div class="card-body">
                            <div class="col-md-12">
                                <div class="form-group col-md-2">
                                    <label>Role Name</label>
                                    <input type="text" value="{{ $role->role_name }}" class="form-control form-control-sm" readonly="true">
                                </div>
                            </div>
                            <div class="tab-content">
                                <div class="tab-pane active" id="inventory">
                                    @include('admins.contents.tools.permission.inventory', ['permissions' => $permissions ])
                                </div>
                                <div class="tab-pane" id="settings">
                                    @include('admins.contents.tools.permission.settings', ['permissions' => $permissions ])
                                </div>
                                <div class="tab-pane" id="tools">
                                    @include('admins.contents.tools.permission.tools', ['permissions' => $permissions ])
                                </div>
                                <div class="tab-pane" id="website"></div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button id="btnSave" type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</section>
<!-- /.content -->

@include('admins.javascript.role_permission')