@extends('admin.admin_master')

@section('content')

<div class="content-wrapper">
	  <div class="container-full">
		<!-- Content Header (Page header) -->
		

		<!-- Main content -->
		<section class="content">
		  <div class="row">
			<div class="col-12">

			 <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Student Shift List</h3>
                  <a href="{{ route('student.shift.add') }} " class="btn btn-rounded btn-success mb-5" 
                    style="float: right" >Add Student Shift</a>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th width=5%>SL</th>
								<th>Name</th>
								<th width=25%>Action</th>
							</tr>
						</thead>
						<tbody>
                            @foreach($allData as $key => $shift)
							<tr>
								<td>{{ $key+1 }}</td>
								<td>{{ $shift->name }}</td>	
                                <td>
                                    <a href="{{ route('student.shift.edit', $shift->id) }}" 
                                    class="btn btn-info">Edit</a>  
                                    <a href="{{ route('student.shift.delete', $shift->id) }}" 
                                    class="btn btn-danger" id="delete" >Delete</a>
                                </td>
							</tr>
							@endforeach
						</tbody>						
					  </table>
					</div>
				</div>
				<!-- /.box-body -->
			  </div>
			  <!-- /.box -->          
			</div>
			<!-- /.col -->
		  </div>
		  <!-- /.row -->
		</section>
		<!-- /.content -->
	  
	  </div>
  </div>


@endsection

@section('deleteAlert')

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    $(function(){
      $(document).on('click','#delete', function(e){
        e.preventDefault();
        var link = $(this).attr("href");

        Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            window.location.href = link
            Swal.fire(
              'Deleted!',
              'The student shift has been deleted.',
              'success'
            )
          }
        })

      });

    });


  </script>

  @endsection