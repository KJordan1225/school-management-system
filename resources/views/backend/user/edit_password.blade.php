@extends('admin.admin_master')

@section('content')

<div class="content-wrapper">
	  <div class="container-full">
		<!-- Content Header (Page header) -->
		
        <section class="content">

		 <!-- Basic Forms -->
		  <div class="box">
			<div class="box-header with-border">
			  <h4 class="box-title">Change Password</h4>
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

                @if(session()->has('error'))
                    <div class="alert alert-danger">
                        {{ session()->get('error') }}
                    </div>
                @endif

					<form method="post" action="{{ route('password.update') }}">
                        @csrf
					  <div class="row">
						<div class="col-12">
                           
                            <!-- <div class="row"> -->
                                <!-- <div class="col-md-6"> -->
                                    <div class="form-group">
                                        <h5>Current Password <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="password" name="oldpassword" id="current_password"  class="form-control" required="">                                             
                                        </div>                                    
                                    </div>	
                                <!-- </div>  -->
                                <!-- End col-md-6 -->

                                <!-- <div class="col-md-6"> -->
                                    <div class="form-group">
                                        <h5>New Password <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="password" name="password" id="password" class="form-control" required="">                                             
                                        </div>                                    
                                    </div>
                                <!-- </div> -->
                                <!-- End col-md-6 -->
                                    <div class="form-group">
                                        <h5>Confirm Password <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="password"  id="password_confirmation" name="password_confirmation" class="form-control" required="">                                             
                                        </div>                                    
                                    </div>

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