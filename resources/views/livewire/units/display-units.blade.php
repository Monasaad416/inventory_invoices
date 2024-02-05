<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title">قائمة وحدات القياس</h4>
                    @can('إضافة وحدة')
                    <button type="button" class="btn bg-gradient-primary" data-toggle="modal" data-target="#create_modal" style="border-radius: 50%" title="إضافة منتج">
                        <span style="font-weight: bolder; font-size:">+</span>
                    </button>
                    @endcan
                </div>

            </div>

            <div class="card-body">
  
                @if($units->count() > 0)

                    <div class="my-3">
                        <input type="text" class="form-control w-25" placeholder="بحث بالإسم " wire:model.live="searchItem">
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
                            <th>الوحدة</th>
                            <th>العمليات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($units as $unit)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{ $unit->name }}</td>
                                    <td>
                                        @can('تعديل وحدة')
                                        <button type="button" class="btn btn-outline-info btn-sm mx-1" title="تعديل"
                                            data-toggle="modal"
                                            {{-- data-target="#edit_modal"  --}}
                                            wire:click="$dispatch('editUnit',{id:{{$unit->id}}})">
                                            <i class="far fa-edit"></i>

                                        </button>
                                        @endcan
                                        @can('حذف وحدة')
                                        <button type="button" class="btn btn-outline-danger btn-sm mx-1"  title="حذف"
                                            data-toggle="modal"
                                            {{-- data-target="#delete_modal"  --}}

                                            wire:click="$dispatch('deleteUnit',{id:{{$unit->id}}})">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                @else
                    <p class="h4 text-muted text-center">لا يوجد وحدات قياس للعرض</p>
                @endif


                <div class="d-flex justify-content-center my-4">
                    {{$units->links()}}
                </div>

            </div>
        </div>
    </div>
</div>
