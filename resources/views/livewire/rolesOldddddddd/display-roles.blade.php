<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title">قائمة المهام </h4>

                    <button type="button" class="btn btn-lg bg-gradient-primary" data-toggle="modal" data-target="#create_modal" style="border-radius: 50%" title="إضافة مهمة">
                        <span style="font-weight: bolder; font-size:">+</span>
                    </button>
                </div>

            </div>

            <div class="card-body">
                @if($roles->count() > 0)
                    <style>
                        tr , .table thead th  {
                            text-align: center;
                        }
                    </style>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                            <th style="width: 10px">#</th>
                            <th>الإسم</th>
                            <th>العمليات</th>
                            </tr>
                        </thead>
                        <tbody>
                     @foreach ($roles as $role)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{ $role->name }}</td>
                            <td>
                                <button type="button" class="btn btn-outline-secondary btn-sm mx-1"  title="التفاصيل"
                                    data-toggle="modal"
                                    wire:click="$dispatch('showRole',{id:{{$role->id}}})">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button type="button" class="btn btn-outline-info btn-sm mx-1" title="تعديل"
                                    data-toggle="modal"
                                    wire:click="$dispatch('editRole',{id:{{$role->id}}})">
                                    <i class="far fa-edit"></i>
                                </button>
                                <button type="button" class="btn btn-outline-danger btn-sm mx-1"  title="حذف"
                                    data-toggle="modal"
                                    wire:click="$dispatch('deleteRole',{id:{{$role->id}}})">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>


                    
                    @endforeach

                        </tbody>
                    </table>
                @else
                    <p class="h4 text-muted text-center">لا يوجد مهمات للعرض</p>
                @endif


                <div class="d-flex justify-content-center my-4">
                    {{$roles->links()}}
                </div>

            </div>
        </div>
    </div>
    
</div>
