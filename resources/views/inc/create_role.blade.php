
<div class="modal" id="create_modal">
    {{-- @include('inc.errors') --}}
    <form method="post" action="{{ route('roles.store') }}">
        @csrf
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">إضافة مهمة</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="col-12 mb-2">
                        <div class="form-group">
                            <label for='name'>الإسم</label><span class="text-danger"> *</span>
                            <input type="text" name='name' class= 'form-control mt-1 mb-3 @error('name') is-invalid @enderror' placeholder = "إسم المهمة">
                        </div>
                    </div>
                    <div class="col-12 mb-2">
                        <div class="form-group">
                            <strong class="d-block my-2 ">إختر الصلاحيات :</strong>
                            <br/>
                            <input class="mb-4" type="checkbox" name="select-all" id="select-all" />
                            <h5 class="d-inline my-4 text-muted mb-4">إختيارالكل</h5>
                            <br>
                            @foreach(Spatie\Permission\Models\Permission::all() as $permission)
                                <label>
                                    <input type='checkbox' name='permissions[]' value='{{$permission->name}}' >
                                    {{ $permission->name }}
                                </label>
                            <br/>
                            @endforeach
                        </div>
                        
                    </div>

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">إغلاق</button>
                    <button type="submit" class="btn btn-primary">حفظ </button>
                </div>
            </div>

        </div>
    </form>
</div>