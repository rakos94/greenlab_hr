@extends('layouts.main')

@section('header')
	@include('layouts.head')
@endsection

@section('body')
<body class="hold-transition skin-blue sidebar-mini">
	<!-- Site wrapper -->
	<div class="wrapper">
		@include('components.header')
		@include('components.sidemenu')

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">

			<!-- Main content -->
			<section class="content">

			<!-- Default box -->
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">Position Approval List</h3>
				</div>
				<div class="box-body">
					@if (session('status')) 
						<div class="alert alert-success alert-dismissible">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
							<h4><i class="icon fa fa-check"></i> Alert!</h4>
							{{ session('status') }}
						</div>
					@endif
					@if ($errors->any())
						<div class="alert alert-danger">
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif
					<table class="table table-bordered">
						<tbody>
							<tr>
								<th>Position</th>
								<th>Approval</th>
							</tr>
							@forelse($positions as $item)
							<tr>
								<td>{{ $item->name }}</td>
								<td>
									<ol>
										@foreach($item->approval_list as $m)
											<li>{{ $m->name }}</li>
										@endforeach
									</ol>
								</td>
							</tr>
							@empty
							<tr>
								<td colspan="99">No Data</td>
							</tr>
							@endforelse
						</tbody>
					</table>
				</div>
				<!-- /.box-body -->
			</div>
			<!-- /.box -->

			
			
			</section>
			<!-- /.content -->
		</div>
		<!-- /.content-wrapper -->
	</div>
</body>
@endsection
@section('script')
@endsection