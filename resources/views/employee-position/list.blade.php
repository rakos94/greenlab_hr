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
                    <table class="table table-bordered">
						<form action="{{ route('employee-position.list') }}" methods="get">
							<div class="form-inline" style="margin-bottom:10px">
								<label for="">Year</label>
								<select class="form-control" name="year">
									<option value=""></option>
									<option value="2019" {{ $request->year == 2019 ? 'selected' : null }}>2019</option>
									<option value="2018" {{ $request->year == 2018 ? 'selected' : null }}>2018</option>
								</select>
								<button type="submit" class="btn btn-secondary">find</button>
							</div>
						</form>
                        <tbody>
                            <tr>
                                <th>Name</th>
                                <th>Position</th>
                                <th></th>
                            </tr>
                            @forelse($employees as $item)
                            <tr>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->employee_position ? $item->employee_position->last()->position->name : null }}</td>
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