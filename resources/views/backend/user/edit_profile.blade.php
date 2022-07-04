@extends('admin.admin_master')

@section('content')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div class="content-wrapper">
	  <div class="container-full">
		<!-- Content Header (Page header) -->
		
        <section class="content">

		 <!-- Basic Forms -->
		  <div class="box">
			<div class="box-header with-border">
			  <h4 class="box-title">Manage Profile</h4>
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

					<form method="post" action="{{ route('profile.store') }}" enctype="multipart/form-data">
                        @csrf
					  <div class="row">
						<div class="col-12">
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <!-- <div class="form-group">
                                        <h5>User Role <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <select name="usertype" id="select" required="" class="form-control">
                                                <option value="" selected="" disabled="">Select Role</option>
                                                <option value="Admin" {{ ($editData->usertype == 'Admin' ? 'selected' : '') }} >Admin</option>
                                                <option value="User"  {{ ($editData->usertype == 'User' ? 'selected' : '') }} >User</option>
                                            </select>
                                        </div>
                                    </div>	 -->
                                </div> 
                                <!-- End col-md-6 -->

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h5>User Name <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="name" class="form-control" value="{{$editData->name}}" required="">                                             
                                        </div>                                    
                                    </div>
                                </div>
                                <!-- End col-md-6 -->

                            </div>
                            <!-- End row -->
                            
                            <div class="row">
                                <div class="col-md-6">
                                <div class="form-group">
                                        <h5>User Email <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="email" name="email" class="form-control" value="{{$editData->email}}" required="">                                             
                                        </div>                                    
                                    </div>	
                                </div> 
                                <!-- End col-md-6 -->

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h5>User Mobile No.</h5>
                                        <div class="controls">
                                            <input type="text" name="mobile" class="form-control"  value="{{$editData->mobile}}">                                             
                                        </div>                                    
                                    </div>
                                </div>
                                <!-- End col-md-6 -->
                            </div>
                            <!-- End row -->

                            <div class="row">
                                <div class="col-md-6">
                                <div class="form-group">
                                        <h5>User Address</h5>
                                        <div class="controls">
                                            <input type="text" name="address" class="form-control" value="{{$editData->address}}">                                             
                                        </div>                                    
                                    </div>	
                                </div> 
                                <!-- End col-md-6 -->

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h5>User Gender</h5>
                                        <div class="controls">
                                            <select name="gender" id="select" class="form-control">
                                                <option value="" selected="" disabled="">Select Role</option>
                                                <option value="Male" {{ ($editData->usertype == 'Male' ? 'selected' : '') }} >Male</option>
                                                <option value="Female"  {{ ($editData->usertype == 'Female' ? 'selected' : '') }} >Female</option>
                                                <option value="Non-binary"  {{ ($editData->usertype == 'Non-binary' ? 'selected' : '') }} >Non-binary</option>
                                            </select>
                                        </div>
                                    </div>	
                                </div> 
                                <!-- End col-md-6 -->
                            </div>
                            <!-- End row -->


                            <div class="row">
                                <div class="col-md-6">
                                <div class="form-group">
                                        <h5>Profile Image</h5>
                                        <div class="controls">
                                            <input type="file" id="image" name="image" class="form-control" value="{{$editData->address}}">                                             
                                        </div>                                    
                                    </div>	
                                </div> 
                                <!-- End col-md-6 -->

                                <!-- <div class="col-md-6"> -->
                                <div class="form-group">
                                        <div class="controls">
                                            <img id="showImage" src="{{ (!empty($user->image)) ? url('upload/user_images/'.$user->image) : url('upload/no_image.jpg') }}" 
                                                alt="" style="width: 100px; height:100px; border: 1px solid #000000;" />
                                        </div>                                    
                                    </div>	
                                <!-- </div>  -->
                                <!-- End col-md-6 -->
                            </div>
                            <!-- End row -->


							
														
							

						<div class="text-xs-right">
							<input type="submit" class="btn btn-rounded btn-info" value="Update" />
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


<script type="text/javascript">

    $(document).ready(function(){
        $('#image').change(function(e){
            var reader = new FileReader();
            reader.onLoad = function(e){
                $('#showImage').attr('src',e.target.result)
            }
            reader.readAsDataURL(e.target.files[0]);
        });

    });


</script>


@endsection