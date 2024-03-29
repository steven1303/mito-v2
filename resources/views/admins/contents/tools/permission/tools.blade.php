<div class="row">
    <div class="col-md-12">
        <button type="button" class="btn btn-primary" onclick="selectAll('tools')">Select All</button>
        <button type="button" class="btn btn-warning" onclick="deselectAll('tools')">Deselect All</button>
    </div>
    <div class="col-md-2">
        <label for="permission"><b>Admins Access</b></label>
        @foreach ($permissions as $permission)
        @if ($permission->for == 'Admins')
        <div class="checkbox">
            <label>
                <input type="checkbox" class="tools" name="permission[]" value="{{ $permission->id }}"
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
                <input type="checkbox" class="tools" name="permission[]" value="{{ $permission->id }}"
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
                <input type="checkbox" class="tools" name="permission[]" value="{{ $permission->id }}"
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
                <input type="checkbox" class="tools" name="permission[]" value="{{ $permission->id }}"
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