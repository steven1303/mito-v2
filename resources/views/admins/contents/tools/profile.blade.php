<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Branch</h1>
            </div>
        </div>
    </div>
</section>

<section class="content">

    <div class="container-fluid">
        <div class="row">
            @canany(['branch.store', 'branch.update'], Auth::user())
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title" id="formTitle">Your Profile</h3>
                    </div>
                    <form  role="form" id="profileForm" method="POST">
                        {{ csrf_field() }} {{ method_field('POST') }}
                        <input type="hidden" id="id" name="id">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input type="text" class="form-control" id="username" name="username" placeholder="Input Username" value="{{Auth::user()->username}}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Nama</label>
                                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Input nama" value="{{Auth::user()->name}}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Input email" value="{{Auth::user()->email}}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Role</label>
                                        <select name="role" class="form-control" id="role" disabled>
                                            <option value="0">Empty</option>
                                            @foreach ($roles as $role)
                                            <option value="{{ $role->id }}" @if ( Auth::user()->id_role == $role->id ) selected @endif >{{ $role->role_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Branch</label>
                                        <select name="branch" class="form-control" id="branch" @cannot('admin.branch', Auth::user()) disabled @endcannot>
                                            <option value="0">Empty</option>
                                            @foreach ($branches as $branch)
                                            <option value="{{ $branch->id }}" @if (Auth::user()->id_branch == $branch->id ) selected @endif >{{ $branch->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div> 
                        </div>    
                        <div class="card-footer">
                            <button id="btnSave" type="submit" class="btn btn-primary">Update</button>
                            <button type="button" class="btn btn-default" onclick="cancel()">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
            @endcanany
        </div>
    </div>

</section>
@include('admins.javascript.tools.profile')