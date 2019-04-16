<!DOCTYPE html>
<html lang="en">
<head>
    @include('_partials/head')
</head>
<body id="page-top">

    @include('_partials/navbar')
	<div id="wrapper">

        @include('_partials/sidebar')

		<div id="content-wrapper">

			<div class="container-fluid">

				@include('_partials/flash_message') 

				
                @yield('main')

			</div>
			<!-- /.container-fluid -->

			<!-- Sticky Footer -->
			@include('_partials/footer')

		</div>
		<!-- /.content-wrapper -->

	</div>
	<!-- /#wrapper -->


    @include('_partials/scrolltop')
    @include('_partials/modal')

    @include('_partials/js')
	@yield('added-js')
</body>
</html>