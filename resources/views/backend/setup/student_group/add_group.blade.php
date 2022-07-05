@extends('admin.admin_master')

@section('content')

<div class="content-wrapper">
	  <div class="container-full">
		<!-- Content Header (Page header) -->
		
        <section class="content">

		 <!-- Basic Forms -->
		  <div class="box">
			<div class="box-header with-border">
			  <h4 class="box-title">Add Student Group</h4>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
			  <div class="row">
				<div class="col">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

					<form method="post" action="{{ route('store.student.group') }}">
                        @csrf
					  <div class="row">
						<div class="col-12">
                            
                            <!-- <div class="row"> -->
                                <!-- <div class="col-md-6"> -->
                                    <div class="form-group">
                                        <h5>Student Group Name <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="name" class="form-control" required="">                                             
                                        </div>                                    
                                    </div>
                                <!-- </div> -->
                                <!-- End col-md-6 -->

                            <!-- </div> -->
                            <!-- End row -->	
							

						<div class="text-xs-right">
							<input type="submit" class="btn btn-rounded btn-info" value="Submit" />
						</div>
					</form>

				</div>
				<!-- /.col -->
			  </div>
			  <!-- /.row -->
			</div>
			<!-- /.box-body -->
		  </div>
		  <!-- /.box -->

		</section>
	
	  
	  </div>
  </div>


@endsection