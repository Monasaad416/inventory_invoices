<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title">قائمة  المستخدمين</h4>
                    @can('إضافة مستخدم')
                    <button type="button" class="btn bg-gradient-primary" data-toggle="modal" data-target="#create_modal" style="border-radius: 50%" title="إضافة مستخدم">
                        <span style="font-weight: bolder; font-size:">+</span>
                    </button>
                    @endcan
                </div>

            </div>

            <div class="card-body">
     
                @if($users->count() > 0)

                    <div class="my-3">
                        <input type="text" class="form-control w-25" placeholder="بحث بالإسم او البريد الإلكتروني او المهمة" wire:model.live="searchItem">
                    </div>
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
                            <th>البريد الإلكتروني</th>
                            <th>المهمة</th>
                            <th>العمليات</th>
                            </tr>
                        </thead>
                        <tbody>
                     @foreach ($users as $user)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->roles_name }}</td>
                            <td>
                                @can('تعديل مستخدم')
                                <button type="button" class="btn btn-outline-info btn-sm mx-1" title="تعديل"
                                    data-toggle="modal"
                                    wire:click="$dispatch('editUser',{id:{{$user->id}}})">
                                    <i class="far fa-edit"></i>
                                </button>
                                @endcan
                                @can('حذف مستخدم')
                                <button type="button" class="btn btn-outline-danger btn-sm mx-1"  title="حذف"
                                    data-toggle="modal"
                                    wire:click="$dispatch('deleteUser',{id:{{$user->id}}})">
                                    <i class="fas fa-trash"></i>
                                </button>
                                @endcan
                            </td>
                        </tr>
                    @endforeach

                        </tbody>
                    </table>
                @else
                    <p class="h4 text-muted text-center">لا يوجد مستخدمين للعرض</p>
                @endif


                <div class="d-flex justify-content-center my-4">
                    {{$users->links()}}
                </div>

            </div>
        </div>
    </div>
</div>
