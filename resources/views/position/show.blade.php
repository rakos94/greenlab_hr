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

            <div class="row">
                <div class="col-md-5">
                    <!-- Default box -->
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Position Detail</h3>
                        </div>
                        <div class="box-body">
                            <form action="{{ route('position.update',$position->id) }}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="">Number</label>
                                    <input type="text" class="form-control" name="number" value="{{ $position->number }}">
                                </div>
                                <div class="form-group">
                                    <label for="">Name</label>
                                    <input type="text" class="form-control" name="name" value="{{ $position->name }}">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>

                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <div class="col-md-3">
                    <!-- Default box -->
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Manager</h3>
                        </div>
                        <div class="box-body">
                            {{$position->approval ? $position->approval->manager->name : '-' }}
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#addManagerModal"> Add Manager</button>
                    </div>
                    <form action="{{ route('position.delete',$position->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <div class="form-group">
                            <button type="submit" class="btn btn-danger btn-block"><i class="fa fa-trash"></i> Delete</button>
                        </div>
                    </form>
                </div>
            </div>

			<!-- modal create -->
			<div class="modal fade" id="addManagerModal"  tabindex="-1" role="dialog">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<form action="{{ route('position.add-manager',$position->id) }}" method="post">
							@csrf
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title">Position Manager</h4>
							</div>
							<div class="modal-body">
								<div class="form-group">
									<label for="">Manager Position</label>
                                    <select name="manager_position_id" class="form-control">
                                        <option></option>
                                        @foreach($positions as $p)
                                        <option value="{{ $p->id }}">{{ $p->name }}</option>
                                        @endforeach
                                    </select>
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