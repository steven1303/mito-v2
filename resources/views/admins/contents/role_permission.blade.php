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
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Access</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
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
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="permission"><b>Admins Access</b></label>
                                    @foreach ($permissions as $permission)
                                    @if ($permission->for == 'Admins')
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="permission[]" value="{{ $permission->id }}"
                                            @foreach ($role->permissions as $permit)
                                            @if ($permit->id == $permission->id)
                                            checked
                                            @endif
                                            {{-- @if ($role->id == 1)
                                            disabled
                                            @endif --}}
                                            @endforeach
                                            >
                                            {{ $permission->name }}
                                        </label>
                                    </div>
                                    @endif
                                    @endforeach
                                </div>
                                <div class="col-md-2">
                                    <label for="permission"><b>Roles Access</b></label>
                                    @foreach ($permissions as $permission)
                                    @if ($permission->for == 'Roles')
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="permission[]" value="{{ $permission->id }}"
                                            @foreach ($role->permissions as $permit)
                                            @if ($permit->id == $permission->id)
                                            checked
                                            @endif
                                            {{-- @if ($role->id == 1)
                                            disabled
                                            @endif --}}
                                            @endforeach
                                            >
                                            {{ $permission->name }}
                                        </label>
                                    </div>
                                    @endif
                                    @endforeach
                                </div>
                                <div class="col-md-2">
                                    <label for="permission"><b>Permissions Access</b></label>
                                    @foreach ($permissions as $permission)
                                    @if ($permission->for == 'Permissions')
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="permission[]" value="{{ $permission->id }}"
                                            @foreach ($role->permissions as $permit)
                                            @if ($permit->id == $permission->id)
                                            checked
                                            @endif
                                            {{-- @if ($role->id == 1)
                                            disabled
                                            @endif --}}
                                            @endforeach
                                            >
                                            {{ $permission->name }}
                                        </label>
                                    </div>
                                    @endif
                                    @endforeach
                                </div>
                                <div class="col-md-2">
                                    <label for="permission"><b>Branch Access</b></label>
                                    @foreach ($permissions as $permission)
                                    @if ($permission->for == 'Branch')
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="permission[]" value="{{ $permission->id }}"
                                            @foreach ($role->permissions as $permit)
                                            @if ($permit->id == $permission->id)
                                            checked
                                            @endif
                                            {{-- @if ($role->id == 1)
                                            disabled
                                            @endif --}}
                                            @endforeach
                                            >
                                            {{ $permission->name }}
                                        </label>
                                    </div>
                                    @endif
                                    @endforeach
                                </div>
                                <div class="col-md-2">
                                    <label for="permission"><b>Tax Access</b></label>
                                    @foreach ($permissions as $permission)
                                    @if ($permission->for == 'Tax')
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="permission[]" value="{{ $permission->id }}"
                                            @foreach ($role->permissions as $permit)
                                            @if ($permit->id == $permission->id)
                                            checked
                                            @endif
                                            {{-- @if ($role->id == 1)
                                            disabled
                                            @endif --}}
                                            @endforeach
                                            >
                                            {{ $permission->name }}
                                        </label>
                                    </div>
                                    @endif
                                    @endforeach
                                </div>
                                <div class="col-md-2">
                                    <label for="permission"><b>Customer</b></label>
                                    @foreach ($permissions as $permission)
                                    @if ($permission->for == 'Customer')
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="permission[]" value="{{ $permission->id }}"
                                            @foreach ($role->permissions as $permit)
                                            @if ($permit->id == $permission->id)
                                            checked
                                            @endif
                                            {{-- @if ($role->id == 1)
                                            disabled
                                            @endif --}}
                                            @endforeach
                                            >
                                            {{ $permission->name }}
                                        </label>
                                    </div>
                                    @endif
                                    @endforeach
                                </div>
                                <div class="col-md-2">
                                    <label for="permission"><b>Vendor</b></label>
                                    @foreach ($permissions as $permission)
                                    @if ($permission->for == 'Vendor')
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="permission[]" value="{{ $permission->id }}"
                                            @foreach ($role->permissions as $permit)
                                            @if ($permit->id == $permission->id)
                                            checked
                                            @endif
                                            {{-- @if ($role->id == 1)
                                            disabled
                                            @endif --}}
                                            @endforeach
                                            >
                                            {{ $permission->name }}
                                        </label>
                                    </div>
                                    @endif
                                    @endforeach
                                </div>
                                <div class="col-md-2">
                                    <label for="permission"><b>Stock Master</b></label>
                                    @foreach ($permissions as $permission)
                                    @if ($permission->for == 'StockMaster')
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="permission[]" value="{{ $permission->id }}"
                                            @foreach ($role->permissions as $permit)
                                            @if ($permit->id == $permission->id)
                                            checked
                                            @endif
                                            {{-- @if ($role->id == 1)
                                            disabled
                                            @endif --}}
                                            @endforeach
                                            >
                                            {{ $permission->name }}
                                        </label>
                                    </div>
                                    @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                      <!-- /.card-body -->      
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