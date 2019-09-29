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
                <div class="col-md-8">
                    <!-- Default box -->
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Employee Detail</h3>
                        </div>
                        <div class="box-body">
                            <form action="{{ route('employee.update',$employee->id) }}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="">Nama</label>
                                    <input type="text" class="form-control" name="nama" value="{{ $employee->nama }}">
                                </div>
                                <div class="form-group">
                                    <label for="">NIP</label>
                                    <input type="text" class="form-control" name="nip" value="{{ $employee->nip }}">
                                </div>
                                <div class="form-group">
                                    <label for="">Tanggal Masuk</label>
                                    <input type="date" class="form-control" name="tanggal_masuk" value="{{ $employee->tanggal_masuk }}">
                                </div>
                                <div class="form-group">
                                    <label for="">Type</label>
                                    <div class="radio" style="margin-top:0">
                                        <label>
                                            <input type="radio" name="type" value="Kontrak" {{ $employee->type == 'Kontrak' ? 'checked' : null }}>
                                                Kontrak
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="type" value="Tetap" {{ $employee->type == 'Tetap' ? 'checked' : null }}>
                                                Tetap
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Status Menikah</label>
                                    <div class="radio" style="margin-top:0">
                                        <label>
                                            <input type="radio" name="status_menikah" value="Kawin" {{ $employee->status_menikah == 'Kawin' ? 'checked' : null }}>
                                            Kawin 
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="status_menikah" value="Tidak Kawin" {{ $employee->status_menikah == 'Tidak Kawin' ? 'checked' : null }}>
                                            Tidak Kawin 
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="status_menikah" value="Divorced" {{ $employee->status_menikah == 'Divorced' ? 'checked' : null }}>
                                            Divorced
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Pay Grade</label>
                                    <select name="pay_grade" class="form-control">
                                        <option value=""></option>
                                        <option value="A" {{ $employee->pay_grade == 'A' ? 'selected' : null }}>A</option>
                                        <option value="B" {{ $employee->pay_grade == 'B' ? 'selected' : null }}>B</option>
                                        <option value="C" {{ $employee->pay_grade == 'C' ? 'selected' : null }}>C</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Gaji</label>
                                    <input type="number" name="gaji" class="form-control" value="{{ $employee->gaji }}">
                                </div>
                                <div class="form-group">
                                    <label for="">Status</label>
                                    <select name="status" class="form-control">
                                        <option value="Active" {{ $employee->status == 'Active' ? 'selected' : null }}>Active</option>
                                        <option value="Terminate" {{ $employee->status == 'Terminate' ? 'selected' : null }}>Terminate</option>
                                    </select>
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
                <div class="col-md-4">
                    <div class="form-group">
                        <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#addPositionModal"> New Postion</button>
                    </div>
                    <form action="{{ route('employee.delete',$employee->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <div class="form-group">
                            <button type="submit" class="btn btn-danger btn-block"><i class="fa fa-trash"></i> Delete</button>
                        </div>
                    </form>
                </div>
            </div>

            
			<!-- modal create -->
			<div class="modal fade" id="addPositionModal"  tabindex="-1" role="dialog">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<form action="{{ route('employee.new-position',$employee->id) }}" method="post">
							@csrf
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title">New Position</h4>
							</div>
							<div class="modal-body">
								<div class="form-group">
                                    <label for="">Position</label>
                                    <select name="position_id" class="form-control">
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