<div class="row">
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
    <div class="col-md-2">
        <label for="permission"><b>Adjustment</b></label>
        @foreach ($permissions as $permission)
        @if ($permission->for == 'Adjustment')
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
        <label for="permission"><b>Transfer Branch</b></label>
        @foreach ($permissions as $permission)
        @if ($permission->for == 'Transfer')
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
        <label for="permission"><b>Transfer Receipt</b></label>
        @foreach ($permissions as $permission)
        @if ($permission->for == 'Transfer Receipt')
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