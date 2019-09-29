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
                    <h3 class="box-title">Position List</h3>
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
					<button class="btn btn-primary" style="margin-bottom:10px" data-toggle="modal" data-target="#myModal">+ New</button>
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th>Number</th>
                                <th>Name</th>
                                <th></th>
                            </tr>
                            @forelse($positions as $item)
                            <tr>
                                <td>{{ $item->number }}</td>
                                <td>{{ $item->name }}</td>
                                <th>
									<a href="{{ route('position.show',$item->id) }}"><i class="fa fa-eye"></i></a>
								</th>
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
			
			<!-- modal create -->
			<div class="modal fade" id="myModal"  tabindex="-1" role="dialog">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<form action="{{ route('position.create') }}" method="post">
							@csrf
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title">Create Position</h4>
							</div>
							<div class="modal-body">
								<div class="form-group">
									<label for="">Number</label>
									<input type="text" class="form-control" name="number">
								</div>
								<div class="form-group">
									<label for="">Nama</label>
									<input type="text" class="form-control" name="name">
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								<button type="submit" class="btn btn-primary">Save</button>
							</div>
						</form>
					</div><!-- /.modal-content -->
				</div><!-- /.modal-dialog -->
			</div><!-- /.modal -->

            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
	</div>
</body>
@endsection
@section('script')
@endsection