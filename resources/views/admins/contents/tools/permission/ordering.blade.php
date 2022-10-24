<div class="row">
    <div class="col-md-12">
        <button type="button" class="btn btn-primary" onclick="selectAll('ordering')">Select All</button>
        <button type="button" class="btn btn-warning" onclick="deselectAll('ordering')">Deselect All</button>
    </div>
    <div class="col-md-2">
        <label for="permission"><b>SPBD</b></label>
        @foreach ($permissions as $permission)
        @if ($permission->for == 'SPBD')
        <div class="checkbox">
            <label>
                <input type="checkbox" class="ordering" name="permission[]" value="{{ $permission->id }}"
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
    <div class="col-md-3">
        <label for="permission"><b>PoStock</b></label>
        @foreach ($permissions as $permission)
        @if ($permission->for == 'PoStock')
        <div class="checkbox">
            <label>
                <input type="checkbox" class="ordering" name="permission[]" value="{{ $permission->id }}"
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
    <div class="col-md-3">
        <label for="permission"><b>Receipt</b></label>
        @foreach ($permissions as $permission)
        @if ($permission->for == 'Receipt')
        <div class="checkbox">
            <label>
                <input type="checkbox" class="ordering" name="permission[]" value="{{ $permission->id }}"
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