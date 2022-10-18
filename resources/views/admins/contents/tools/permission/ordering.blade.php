<div class="row">
    <div class="col-md-2">
        <label for="permission"><b>SPBD</b></label>
        @foreach ($permissions as $permission)
        @if ($permission->for == 'SPBD')
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