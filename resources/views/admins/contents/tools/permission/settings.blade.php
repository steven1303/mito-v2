<div class="row">
    <div class="col-md-12">
        <button type="button" class="btn btn-primary" onclick="selectAll('settings')">Select All</button>
        <button type="button" class="btn btn-warning" onclick="deselectAll('settings')">Deselect All</button>
    </div>
    <div class="col-md-2">
        <label for="permission"><b>Customer</b></label>
        @foreach ($permissions as $permission)
        @if ($permission->for == 'Customer')
        <div class="checkbox">
            <label>
                <input type="checkbox" class="settings" name="permission[]" value="{{ $permission->id }}"
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
                <input type="checkbox" class="settings" name="permission[]" value="{{ $permission->id }}"
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