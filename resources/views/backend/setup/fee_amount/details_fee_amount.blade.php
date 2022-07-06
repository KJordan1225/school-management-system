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
				  <h3 class="box-title">Student Fee Amount Details</h3>
                  <a href="{{ route('fee.amount.add') }} " class="btn btn-rounded btn-success mb-5" 
                    style="float: right" >Add Fee Amount</a>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
                    <h4><strong>Fee Category : </strong>{{ $detailsData[0]
                        ['fee_category']['name'] }}</h4>
					<div class="table-responsive">
					  <table id="example1" class="table table-bordered table-striped">
						<thead class="thead-light">
							<tr>
								<th width=5%>SL</th>
								<th>Class Name</th>
								<th width=25%>Amount</th>
							</tr>
						</thead>
						<tbody>
                            @foreach($detailsData as $key => $detail)
							<tr>
								<td>{{ $key+1 }}</td>
								<td>{{ $detail['student_class']['name'] }}</td>	
                                <td>{{ $detail->amount }}</td>
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
              'The fee amount has been deleted.',
              'success'
            )
          }
        })

      });

    });


  </script>

  @endsection