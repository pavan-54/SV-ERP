@extends('layouts.app')
@section('content')

<style>
	.form-control[disabled]{
	  background-color: #dcdadae7 !important;
	  font-weight: bold;
	}
  </style>
  
<ol class="breadcrumb">
	<li><a href="/">Home</a></li>
	<li>Service</li>
	<li class="active">Add Service</li>
</ol>
  
  
  <h4>
	  <i class='glyphicon glyphicon-circle-arrow-right'></i>
	  Add Service
  </h4>
  
  
  
  <div class="panel panel-default">
	  <div class="panel-heading">
				Add Service
  
	  </div> <!--/panel-->	
	  @include('partials.error')
	  <div class="panel-body">
					  
  
			  <div class="success-messages"></div> <!--/success-messages-->
  
			<form class="form-horizontal" method="POST" action="/service/insert_service" id="createOrderForm">
				@csrf
  
				<div class="form-group">
				  <label for="servicedate" class="col-sm-2 control-label">Service Date</label>
				  <div class="col-sm-10">
					<input type="date" class="form-control" id="servicedate" name="servicedate" value="{{ $data['service_date'] }}" disabled/>
				  </div>
				</div> <!--/form-group-->
				<div class="form-group">
				  <label for="clientName" class="col-sm-2 control-label">Client Name</label>
				  <div class="col-sm-10">
					<input type="text" class="form-control" id="clientName" name="clientName" placeholder="Client Name" autocomplete="off" value="{{ $data['client_name'] }}" disabled/>
				  </div>
				</div> <!--/form-group-->
				<div class="form-group">
				  <label for="clientContact" class="col-sm-2 control-label">Client Contact</label>
				  <div class="col-sm-10">
					<input type="text" class="form-control" id="clientContact" name="clientContact" placeholder="Contact Number" autocomplete="off" value="{{ $data['client_contact'] }}" disabled/>
				  </div>
				</div> <!--/form-group-->			  
  
				<table class="table" id="serviceTable">
					<thead>
						<tr>			  			
							<th style="width:40%;">Service / Type</th>
							<th style="width:20%;">Rate</th>
							<th style="width:15%;">Quantity</th>			  			
							<th style="width:15%;">Total</th>			  			
							<th style="width:10%;"></th>
						</tr>
					</thead>
					<tbody>
						@php
							$arrayNumber = 0;
							$services_count=$data['services_count'];
						@endphp
						{{-- for($x = 1; $x < 3; $x++) { ?> --}}
						@for($x=1;$x<=$services_count;$x++)
							<tr id="row{{$x}}" class="{{$arrayNumber}}">			  				
								<td style="margin-left:20px;">
									<div class="form-group">
										@php
											 $services = DB::table('service_types')->get();
										@endphp
									 <select class="form-control" name="serviceName[]" id="serviceName{{$x}}"  disabled> {{-- onchange="getProductData({{$x}})" --}}
										<option value="">~~SELECT~~</option>
										
										@foreach ($services as $service)
											<option value="{{$service->service_type_id}}" @selected($data['service_types'][$x-1] == $service->service_type_id)>{{$service->service_type_name}}</option>
										@endforeach
  
									</select>
									</div>
								</td>
								<td style="padding-left:20px;">			  					
									<input type="text" name="rate[]" id="rate{{$x}}" onkeyup="getTotal({{$x}})" autocomplete="off" class="form-control" value="{{ $data['rates'][$x-1] }}" disabled/>			  					
								</td>
								<td style="padding-left:20px;">
									<div class="form-group">
									<input type="number" name="quantity[]" id="quantity{{$x}}" onkeyup="getTotal({{$x}})" autocomplete="off" class="form-control" min="1" value="{{ $data['quantites'][$x-1] }}" disabled/>
									</div>
								</td>
								<td style="padding-left:20px;">			  					
									<input type="text" name="total[]" id="total{{$x}}" autocomplete="off" class="form-control" disabled="true" value="{{ $data['amounts'][$x-1] }}"/>			  					
								</td>
								<td>
  
									<button class="btn btn-default removeProductRowBtn" type="button" id="removeServiceRowBtn" onclick="removeServiceRow({{$x}})" disabled><i class="glyphicon glyphicon-trash"></i></button>
								</td>
							</tr>
							@php
								$arrayNumber++;
							@endphp
						@endfor
					</tbody>			  	
				</table>
  
				<div class="col-md-6">
					<div class="form-group">
					  <label for="subTotal" class="col-sm-3 control-label">Sub Amount</label>
					  <div class="col-sm-9">
						<input type="text" class="form-control" id="subTotal" name="subTotal" disabled="true" value="{{ $data['sub_amount'] }}" disabled/>
						<input type="hidden" class="form-control" id="subTotalValue" name="subTotalValue" />
					  </div>
					</div> <!--/form-group-->
					<div class="form-group">
						<label for="subTotal" class="col-sm-3 control-label">Service Charge</label>
						<div class="col-sm-9">
						  <input type="text" class="form-control" id="serviceCharge" onkeyup="subAmount()" name="serviceCharge" value="{{ $data['service_charge'] }}" disabled />
						</div>
					  </div> <!--/form-group-->			  		  
					<div class="form-group">
					  <label for="totalAmount" class="col-sm-3 control-label">Total Amount</label>
					  <div class="col-sm-9">
						<input type="text" class="form-control" id="totalAmount" name="totalAmount" disabled="true" value="{{ $data['total_amount'] }}" disabled/>
						<input type="hidden" class="form-control" id="totalAmountValue" name="totalAmountValue" />
					  </div>
					</div> <!--/form-group-->			  
					<div class="form-group">
					  <label for="discount" class="col-sm-3 control-label">Discount</label>
					  <div class="col-sm-9">
						<input type="text" class="form-control" id="discount" name="discount" onkeyup="discountFunc()" autocomplete="off" value="{{ $data['discount'] }}" disabled/>
					  </div>
					</div> <!--/form-group-->	
					<div class="form-group">
					  <label for="grandTotal" class="col-sm-3 control-label">Grand Total</label>
					  <div class="col-sm-9">
						<input type="text" class="form-control" id="grandTotal" name="grandTotal" disabled="true"  value="{{ $data['grandtotal'] }}" disabled/>
						<input type="hidden" class="form-control" id="grandTotalValue" name="grandTotalValue" />
					  </div>
					</div> <!--/form-group-->			  		  
				</div> <!--/col-md-6-->
  
				<div class="col-md-6">
					<div class="form-group">
					  <label for="paid" class="col-sm-3 control-label">Paid Amount</label>
					  <div class="col-sm-9">
						<input type="text" class="form-control" id="paid" name="paid" autocomplete="off" onkeyup="paidAmount()" value="{{ $data['paid_amt'] }}" disabled/>
					  </div>
					</div> <!--/form-group-->			  
					<div class="form-group">
					  <label for="due" class="col-sm-3 control-label">Due Amount</label>
					  <div class="col-sm-9">
						<input type="text" class="form-control" id="due" name="due" disabled="true"  value="{{ $data['due_amt'] }}" disabled/>
						<input type="hidden" class="form-control" id="dueValue" name="dueValue" />
					  </div>
					</div> <!--/form-group-->		
					<div class="form-group">
					  <label for="clientContact" class="col-sm-3 control-label">Payment Type</label>
					  <div class="col-sm-9">
						<select class="form-control" name="paymentType" id="paymentType" disabled>
							<option value="">~~SELECT~~</option>
							<option @selected($data['payment_type'] == 1) value="1">UPi</option>
							<option @selected($data['payment_type'] == 2) value="2">Cash</option>
							{{-- <option value="3">Credit Card</option> --}}
						</select>
					  </div>
					</div> <!--/form-group-->							  
					<div class="form-group">
					  <label for="clientContact" class="col-sm-3 control-label">Payment Status</label>
					  <div class="col-sm-9">
						<select class="form-control" name="paymentStatus" id="paymentStatus" disabled>
							<option value="">~~SELECT~~</option>
							<option @selected($data['payment_status'] == 1) value="1">Full Payment</option>
							<option @selected($data['payment_status'] == 2) value="2">Advance Payment</option>
							<option @selected($data['payment_status'] == 3) value="3">No Payment</option>
						</select>
					  </div>
					</div> <!--/form-group-->							  
				</div> <!--/col-md-6-->
  
  
				{{-- <div class="form-group submitButtonFooter">
				  <div class="col-sm-offset-2 col-sm-10">
				  <button type="button" class="btn btn-default" onclick="addRow()" id="addRowBtn" data-loading-text="Loading..." disabled> <i class="glyphicon glyphicon-plus-sign"></i> Add Row </button>
  
					<button type="submit" id="createOrderBtn" data-loading-text="Loading..." class="btn btn-success" disabled><i class="glyphicon glyphicon-ok-sign" ></i> Save Changes</button>
  
					<button type="reset" class="btn btn-default" onclick="resetOrderForm()" disabled><i class="glyphicon glyphicon-erase"></i> Reset</button>
				  </div>
				</div> --}}
			  </form>
  
  
	  </div> <!--/panel-->	
  </div> <!--/panel-->	
  
  
  <!-- remove order -->
  <div class="modal fade" tabindex="-1" role="dialog" id="removeOrderModal">
	<div class="modal-dialog">
	  <div class="modal-content">
		<div class="modal-header">
		  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		  <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Remove Service</h4>
		</div>
		<div class="modal-body">
  
			<div class="removeOrderMessages"></div>
  
		  <p>Do you really want to remove ?</p>
		</div>
		<div class="modal-footer removeProductFooter">
		  <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign" ></i> Close</button>
		  <button type="button" class="btn btn-primary" id="removeOrderBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign" ></i> Save changes</button>
		</div>
	  </div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
  <!-- /remove order-->
  
  
  <script src="{{ asset('custom/js/service.js') }}"></script>
  
@endsection