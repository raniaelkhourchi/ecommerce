@extends('layouts.master')

@section('title')
ADD or DELETE a Product
@stop

@section('css')
<!-- Internal Data table css -->
<link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
@endsection

@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">Products</h4>
            <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Add product</span>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection

@section('content')
<!-- row -->


@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(session()->has('Add'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>{{ session()->get('Add') }}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

@if(session()->has('Error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>{{ session()->get('Error') }}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
@if(session()->has('edit'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>{{ session()->get('edit') }}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

 
<div class="row">

    <div class="col-xl-12">
        <div class="card mg-b-20">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
                    <a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-slide-in-right" data-toggle="modal" href="#scrollingmodal">ADD NEW TYPE</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example1" class="table key-buttons text-md-nowrap" data-page-length='50'
                        style="text-align: center">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">ID</th>
                                <th class="border-bottom-0">Product Name</th>
                                <th class="border-bottom-0">Description</th>
                                <th class="border-bottom-0">Section Id</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php    $i=0       ?>
                           @foreach ($A as $t)
                           <?php    $i++       ?>
                             <tr>
                                <td>{{$i}}</td> 
                               <td>{{$t->Product_name}}</td> 
                               <td>{{$t->description}}</td> 
                               <td>{{$t->section_id}}</td> 
                               <td> 
                                <a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale"
                                    data-id="{{ $t->id }}" data-Product_name="{{ $t->Product_name }}"
                                    data-description="{{ $t->description }}" data-toggle="modal"
                                    href="#exampleModal2" title="Modify"><i class="las la-pen"></i></a>
                            

                            
                                <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                    data-id="{{ $t->id }}" data-Product_name="{{ $t->Product_name }}"
                                    data-toggle="modal" href="#modaldemo9" title="DELETE">
                                    <i class="las la-trash"></i></a>
                      </td> 


                            </tr>  
                           @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <!-- Scroll modal -->
		<div class="modal" id="scrollingmodal">
			<div class="modal-dialog" role="document">
				<div class="modal-content modal-content-demo">
					<div class="modal-header">
						<h6 class="modal-title">Add the new Product</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
					</div>
					<div class="modal-body">
               <form action="{{route('product.store')}}" method="POST">
                {{ csrf_field() }}

                        <div class="form-group">
                            <label for="Product_name">Product name </label>
                            <input type="text" class="form-control" id="Product_name" name="Product_name">
                        </div>

                        <div class="form-group">
                            <label for="text_description">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>
						</div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger">Save</button>
                        </div>
					</div>
               </form>
				</div>
			</div>
		</div>
		<!--End Scroll modal -->

    </div>
</div>

 <!-- edit -->
 <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
 aria-hidden="true">
 <div class="modal-dialog" role="document">
     <div class="modal-content">
         <div class="modal-header">
             <h5 class="modal-title" id="exampleModalLabel"> Modify Product</h5>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
             </button>
         </div>
         <div class="modal-body">

             <form action="product/update" method="post" autocomplete="off">
                 {{ method_field('patch') }}
                 {{ csrf_field() }}
                 <div class="form-group">
                     <input type="hidden" name="id" id="id" value="">
                     <label for="recipient-name" class="col-form-label"> Product Name</label>
                     <input class="form-control" name="Product_name" id="Product_name" type="text">
                 </div>
                 <div class="form-group">
                     <label for="message-text" class="col-form-label">Description</label>
                     <textarea class="form-control" id="description" name="description"></textarea>
                 </div>
         </div>
         <div class="modal-footer">
             <button type="submit" class="btn btn-primary">Submit</button>
             <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
         </div>
         </form>
     </div>
 </div>
</div>

<!-- delete -->
<div class="modal" id="modaldemo9">
 <div class="modal-dialog modal-dialog-centered" role="document">
     <div class="modal-content modal-content-demo">
         <div class="modal-header">
             <h6 class="modal-title">Delete the product</h6><button aria-label="Close" class="close" data-dismiss="modal"
                 type="button"><span aria-hidden="true">&times;</span></button>
         </div>
         <form action="product/destroy" method="post">
             {{ method_field('delete') }}
             {{ csrf_field() }}
             <div class="modal-body">
                 <p>?Are you sure you want to delete this item</p><br>
                 <input type="hidden" name="id" id="id" value="">
                 <input class="form-control" name="Product_name" id="Product_name" type="text" readonly>
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                 <button type="submit" class="btn btn-danger">Submit</button>
             </div>
     </div>
     </form>
 </div>
</div>


<!-- row closed -->
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection

@section('js')
<!-- Internal Data tables -->
<script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
<!--Internal  Datatable js -->
<script src="{{ asset('assets/js/table-data.js') }}"></script>
<!--Internal  Datepicker js -->
<script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
<!-- Internal Select2 js-->
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<!-- Internal Modal js-->
<script src="{{URL::asset('assets/js/modal.js')}}"></script>

<script>
    $('#exampleModal2').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var Product_name = button.data('Product_name')
        var description = button.data('description')
        var modal = $(this)
        modal.find('.modal-body #id').val(id);
        modal.find('.modal-body #Product_name').val(Product_name);
        modal.find('.modal-body #description').val(description);
    })

</script>

<script>
    $('#modaldemo9').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var Product_name = button.data('Product_name')
        var modal = $(this)
        modal.find('.modal-body #id').val(id);
        modal.find('.modal-body #Product_name').val(Product_name);
    })

</script>



@endsection
