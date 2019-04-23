<!-- Bootstrap core JavaScript-->
<script src="{{ asset('jquery/jquery.min.js') }}"></script>
<script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- Core plugin JavaScript-->
<script src="{{ asset('jquery-easing/jquery.easing.min.js') }}"></script>
<!-- Page level plugin JavaScript-->
<!-- <script src="{{ asset('chart.js/Chart.min.js') }}"></script> -->
<script src="{{ asset('datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('datatables/dataTables.bootstrap4.js') }}"></script>
<!-- Custom scripts for all pages-->
<script src="{{ asset('js/sb-admin.min.js') }}"></script>
<!-- Demo scripts for this page-->
<script src="{{ asset('js/demo/datatables-demo.js') }}"></script>
<!-- <script src="{{ asset('js/demo/chart-area-demo.js') }}"></script> -->


<!-- js for clockpicker-->
<script src="{{ asset('js/bootstrap-clockpicker.min.js') }}"></script>

<!-- js for select2-->
<script src="{{ asset('js/select2.min.js') }}"></script>

<!-- js for highstock -->
<script src="https://code.highcharts.com/stock/highstock.js"></script>
<script src="https://code.highcharts.com/stock/modules/exporting.js"></script>

<!-- jquery ui for datepicker-->
<script src="{{ asset('js/jquery-ui-1.10.1.custom.min.js') }}"></script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).ready(function(){
        function load_unseen_notification(view = '')
        {
            $.ajax({
            url:"{{ url('fetchnotif') }}",
            method:"POST",
            data:{view:view},
            dataType:"json",
            success:function(data)
            {
                $('.dropdown-menu-notif').html(data.notification);
                if(data.unseen_notification > 0)
                {
                    $('.count').html(data.unseen_notification);
                }
            },
            fail: function(xhr, textStatus, errorThrown){
                alert('request failed');
            }
            });
        }
    
    load_unseen_notification();

    $(document).on('click', '.dropdown-toggle-clicker', function(){
         $('.dropdown-toggle-bell').html('');
         
         load_unseen_notification('yes');
    });

    setInterval(function(){
        load_unseen_notification();
    }, 5000);

    });
</script>

{{-- <script>
$(document).ready(function(){

    function load_unseen_notification(view = '')
    {
    $.ajax({
    url:"{{ url('notif_bk/fetch') }}",
    method:"POST",
    data:{view:view},
    dataType:"json",
    success:function(data)
    {
        $('.dropdown-menu-notif').html(data.notification);
        if(data.unseen_notification > 0)
        {
        $('.count').html(data.unseen_notification);
        }
    }
    });
    }
    
    load_unseen_notification();

    $(document).on('click', '.dropdown-toggle-clicker', function(){
        $('.dropdown-toggle-bell').html('');
        load_unseen_notification('yes');
    });

    setInterval(function(){
        load_unseen_notification();; 
    }, 5000);

});
</script> --}}