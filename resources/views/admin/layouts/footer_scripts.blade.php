<!-- jQuery -->
<script type="text/javascript" src="//code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('dashboard/assets/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('dashboard/assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>


<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('dashboard/assets/dist/js/pages/dashboard.js')}}"></script>

<script src="{{ asset('dashboard/assets/plugins/select2/js/select2.full.min.js')}}"></script>

<script src="{{ asset('dashboard/assets/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js')}}"></script>

<script src="{{ asset('dashboard/assets/dist/js/adminlte.min.js?v=3.2.0')}}"></script>


<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

  })
</script>



<!-- Dropify -->
<script src="{{ asset('dashboard/assets/dist/dropify-master/dist/js/dropify.min.js') }}"></script>
<script>
  $('.dropify').dropify();
</script>

<!-- Chart js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.0/chart.min.js" integrity="sha512-7U4rRB8aGAHGVad3u2jiC7GA5/1YhQcQjxKeaVms/bT66i3LVBMRcBI9KwABNWnxOSwulkuSXxZLGuyfvo7V1A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

@livewireScripts


<!-- Swet alert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>

    window.addEventListener('createModalToggle', event => {
        $("#create_modal").modal('toggle');
    })

    window.addEventListener('editModalToggle', event => {
        $("#edit_modal").modal('toggle');
    })

    window.addEventListener('deleteModalToggle', event => {
        $("#delete_modal").modal('toggle');
    })

    window.addEventListener('showModalToggle', event => {
        $("#show_modal").modal('toggle');
    })

    window.addEventListener('importModalToggle', event => {
        $("#import_modal").modal('toggle');
    })

    window.addEventListener('archiveModalToggle', event => {
        $("#archive_modal").modal('toggle');
    })

    window.addEventListener('printModalToggle', event => {
        $("#print_modal").modal('toggle');
    })



    window.addEventListener('alert', event => {
    let data = event.detail;
    console.log(data);
    Swal.fire({
            text: data.text,
            icon: data.icon,
            confirmButtonText: data.confirmButtonText
        })
    })




        document.addEventListener('livewire:load', function () {
            Livewire.on('show-alert', function (data) {
                Swal.fire(data).then(function () {
                    window.location.href = "{{ route('invoices') }}";
                });
            });
        });


</script>

{{-- @vite('resources/js/app.js') --}}


    {{-- mark notifications as unread --}}
    {{-- <script>
        $(document).on('click','#notification',function(){
            // var notification = document.getElementById('notification');
            var id = $(this).attr('data-id')
            alert(id);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ URL::to("/notification/unread") }}/"  + id,

                method:'get',
                success: function(data){
                     $("#counter").load(" #counter > *");
                     $("#notification").load(" #notification > *");
                },
                error: function(){
                    alert('عفوا حدث خطاء يرجي إعادة المحاولة');
                },
            });


        });
    </script> --}}



@stack('script')





