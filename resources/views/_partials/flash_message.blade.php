@if (Session::has('flash_message'))
<div class=" alert alert-success">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    {{ Session::get('flash_message') }}
</div>
@endif
@if (Session::has('flash_message_fail'))
<div class=" alert alert-danger">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    {{ Session::get('flash_message_fail') }}
</div>
@endif