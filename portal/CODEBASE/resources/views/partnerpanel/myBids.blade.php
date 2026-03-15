@extends('partnerpanel.layout')

@section('content')
<div class="content-overlay"></div>
<div class="header-navbar-shadow"></div>
<div class="content-wrapper">
    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <button class="nav-link active bg-light" id="nav-home-tab" data-toggle="tab" data-target="#nav-home"
                type="button" role="tab" aria-controls="nav-home" aria-selected="true">
            <a><span data-feather="cast"></span> All Bids</a>
            </button>
            <button class="nav-link bg-light" id="nav-profile-tab" data-toggle="tab" data-target="#nav-profile"
                type="button" role="tab" aria-controls="nav-profile" aria-selected="false">
            <a><span data-feather="check"></span> Accepted Bids</a>
            </button>
            <button class="nav-link bg-light" id="nav-contact-tab" data-toggle="tab" data-target="#nav-contact"
                type="button" role="tab" aria-controls="nav-contact" aria-selected="false">
            <a><span data-feather="x"></span> Rejected Bids</a>
            </button>
        </div>
    </nav>
    
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
            <ul style="list-style-type: none;padding: 0;">
                <li>
                    <div class="border bg-white">
                        <div class="row justify-content-between mx-2 py-1 align-items-center border-bottom">
                            <h3 class="mb-0">All Bids</h3>
                            <div class="d-flex">
                                <!-- <div class="form-group position-relative mr-1 mb-0">
                                    <input type="search" class="form-control" id="basicInput"
                                        placeholder="Search" />
                                    <span class="search-icon" ><i data-feather="search"></i></span>
                                </div> -->
                                <!-- <button type="button" class="btn btn-success mr-1" id="dt-feature-filter-form-search"><i class="fal fa-search"></i></button> -->
                                <div class="btn-group dropdown-sort">
                                    <div class="btn-group dropdown-sort">
                                        <button type="button" class="btn btn-outline-primary dropdown-toggle waves-effect"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="active-sorting">Sort By</span>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="javascript:sort(1);">Price:Low to High</a>
                                            <a class="dropdown-item" href="javascript:sort(0);">Price:High to Low</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive px-2 mt-2">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Listing</th>
                                        <th scope="col">Max Budget</th>
                                        <th scope="col">Your Bid</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($allbids)>0)
                                    @foreach($allbids as $allbids)
                                    <tr>
                                        <th scope="row">
                                            <a class="text-primary h6" href="{{route('ppanel.biddetails',['id'=>$allbids->requirement_id])}}">
                                            <!-- {{$allbids->name}} -->
                                            @php $categoryval = App\Models\Category::where('id',$allbids->category_id)->first();
												 $subcategoryval = App\Models\ChildCategory::where('id',$allbids->sub_category_id)->first();
											@endphp
											@if(@$allbids->category_id !='')CATEGORY : {{@$categoryval->name}} @endif
											@if(@$allbids->sub_category_id !='') SUB CATEGORY NAME : {{$subcategoryval->name}} @endif 				 
                                            </a>
                                            @php $customer_info = App\Models\Customer::where(['status'=>1,'id'=>$allbids->customer_id])->whereNull('deleted_at')->first(); @endphp
                                            <p class="mb-0 text-dark"><span class="text-secondary">Client Name :
                                                </span>{{$customer_info->name}}
                                            </p>
                                        </th>
                                        <td>
                                            <p class="mb-0">₹ {{$allbids->max_budget}}</p>
                                        </td>
                                        <td>
                                            <p class="mb-0">₹ {{$allbids->cost}}</p>
                                            <span class="text-muted">{{date('d M Y H:i A', strtotime($allbids->created_at))}}</span>
                                            
                                        </td>
                                        <td width="300">
                                            @if($allbids->status==0)
                                            <small class="mb-0">Bid not accepted yet.</small>
                                            @elseif($allbids->status==1)
                                            <small class="mb-0">Bid accepted!</small>
                                            @else
                                            <small class="mb-0">Bid Rejected!</small>
                                            @endif
                                            <button  onclick="getdetails(this)" id='{{$allbids->requirement_id}}' data-toggle="modal" data-target="#ViewModal"  class="btn btn-success w-100">Contact</button>
                                        </td>
                                    </tr>
                                    @endforeach  
                                    @else
                                    <tr><td colspan='4'>No Bids Avaliable</td></tr>
                                    @endif
                                    <!-- until Wed 30th Jun 2021  -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
            <ul style="list-style-type: none;padding: 0;">
                <li>
                    <div class="border bg-white">
                        <div class="row justify-content-between mx-2 py-1 align-items-center border-bottom">
                            <h3 class="mb-0">Accepted Bids</h3>
                            <div class="d-flex">
                                <!-- <div class="form-group position-relative mr-1 mb-0">
                                    <input type="search" class="form-control" id="basicInput"
                                        placeholder="Search" />
                                    <span class="search-icon"><i data-feather="search"></i></span>
                                </div> -->
                                <div class="btn-group dropdown-sort">
                                    <div class="btn-group dropdown-sort">
                                        <button type="button" class="btn btn-outline-primary dropdown-toggle"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="active-sorting">Sort By</span>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="javascript:sort(1);">Price:Low to High</a>
                                            <a class="dropdown-item" href="javascript:sort(0);">Price:High to Low</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive px-2 mt-2">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Listing</th>
                                        <th scope="col">Max Budget</th>
                                        <th scope="col">Your Bid</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($acceptedbids)>0)
                                    @foreach($acceptedbids as $acceptedbids)
                                    <tr>
                                        <th scope="row">
                                            <a class="text-dark h6" href="{{route('ppanel.biddetails',['id'=>$acceptedbids->requirement_id])}}">{{$acceptedbids->name}}</a>
                                            @php $customer_info = App\Models\Customer::where(['status'=>1,'id'=>$acceptedbids->customer_id])->whereNull('deleted_at')->first(); @endphp
                                            <p class="mb-0 text-dark"><span class="text-secondary">Client Name :
                                                </span>{{$customer_info->name}}
                                            </p>
                                        </th>
                                        <td>
                                            <p class="mb-0">₹ {{$acceptedbids->max_budget}}</p>
                                        </td>
                                        <td>
                                            <p class="mb-0">₹ {{$acceptedbids->cost}}</p>
                                            <span class="text-muted">{{date('d M Y H:i:s', strtotime($acceptedbids->updated_at))}}</span>
                                        </td>
                                        <td width="300">
                                            <button type="button"  onclick="getdetails(this)" id='{{$acceptedbids->requirement_id}}' data-toggle="modal" data-target="#ViewModal"  class="btn btn-success">Contact
                                            details</button>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr><td colspan='4'>No Bids Avaliable</td></tr>
                                    @endif
        
                                </tbody>
                            </table>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
            <ul style="list-style-type: none;padding: 0;">
                <li>
                    <div class="border bg-white">
                        <div class="row justify-content-between mx-2 py-1 align-items-center border-bottom">
                            <h3 class="mb-0">Rejected Bids</h3>
                            <div class="d-flex">
                                <!-- <div class="form-group position-relative mr-1 mb-0">
                                    <input type="search" class="form-control" id="basicInput" placeholder="Search" />
                                    <span class="search-icon"><i data-feather="search"></i></span>
                                </div> -->
                                <div class="btn-group dropdown-sort">
                                    <div class="btn-group dropdown-sort">
                                        <button type="button" class="btn btn-outline-primary dropdown-toggle"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="active-sorting">Sort By</span>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="javascript:sort(1);">Price:Low to High</a>
                                            <a class="dropdown-item" href="javascript:sort(0);">Price:High to Low</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive px-2 mt-2">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Listing</th>
                                        <th scope="col">Max Budget</th>
                                        <th scope="col">Your Bid</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($rejectedbids)>0)
                                    @foreach($rejectedbids as $rejectedbids)
                                    <tr>
                                        <th scope="row">
                                            <a class="text-dark h6" href="{{route('ppanel.biddetails',['id'=>$rejectedbids->requirement_id])}}">{{$rejectedbids->name}}</a>
                                            @php $customer_info = App\Models\Customer::where(['status'=>1,'id'=>$rejectedbids->customer_id])->whereNull('deleted_at')->first(); @endphp
                                            <p class="mb-0 text-dark"><span class="text-secondary">Client Name :
                                                </span>{{$customer_info->name}}
                                            </p>
                                        </th>
                                        <td>
                                            <p class="mb-0">₹ {{$rejectedbids->max_budget}}</p>
                                        </td>
                                        <td>
                                            <p class="mb-0">₹ {{$rejectedbids->cost}}</p>
                                            <span class="text-muted">{{date('d M Y H:i:s', strtotime($rejectedbids->updated_at))}}</span>
                                        </td>
                                        <td width="300">
                                            <a class="text-primary h6" href="{{route('ppanel.biddetails',['id'=>$rejectedbids->requirement_id])}}">
                                            <button type="button" class="btn btn-info">Bid Again</button>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr><td colspan='4'>No Bids Avaliable</td></tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>


<div class="modal fade text-left" id="ViewModal" tabindex="-1" role="dialog" aria-labelledby="ViewModalid" aria-hidden="true">
	<div class="modal-dialog modal-md modal-dialog-centered"  role="dialog">
		<div class="modal-content file-manager-application">
			<div class="modal-header">
				<h4 class="modal-title text-success" id="ViewModalid">Contact Details</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			
			<div class="modal-body p-2">
				<div class="row">
					<div class="form-group col-md-12" id='textchangemsg'>
                        
					</div>
				</div>
		
				</div>
			</div>
		</div>
	</div>
</div>

    <!-- E-commerce Content Section Starts -->
    <!-- E-commerce Content Section Starts -->
    <!-- background Overlay when sidebar is shown  starts-->
    <div class="body-content-overlay"></div>
    <!-- background Overlay when sidebar is shown  ends-->
</div>
<script>
function getdetails(n)
{
    
	$.ajax({
            method: 'get',
            url: '{{route("ppanel.getbidstatus")}}',
            data: {
                'projectid': n.id,
				_token: '{{csrf_token()}}'
            },
            success: function(data) {
				if(data.bidstatus.length == '0' )
				 	$("#textchangemsg").html('Place the Bid to view details!');	
				else
				{	
					if(data.bidstatus[0].status == '0')
						{
							if(data.subscription.subscriptiontype.viewaccepted_pro=='no')
								$("#textchangemsg").html('<h5>Basic Subscription</h5><p>Contact details would be shown once the bid gets accepted by the client. </p><p>Upgrade to <a href="{{route('subscriptionDetails')}}" >Go Pro membership</a>, to see the contact details without waiting for bids to be accepted.');	
							else
                                getcustomerdetails(n.id);
						}	
					else
                        getcustomerdetails(n.id);
					
				}
					 

            }
        });

}



function getcustomerdetails(x)
{
    
	$.ajax({
            method: 'get',
            url: '{{route("ppanel.customerinfo")}}',
            data: {
                'projectid': x,
				_token: '{{csrf_token()}}'
            },
            success: function(data) {
                console.log(data)
				if(data.length == '0' )
				 	$("#textchangemsg").html('No Contact Details');	
                else
				{	
					$("#textchangemsg").html('<p class="details"><b>Name : </b>'+data.name+'</p><p class="details"><b>Email : </b>'+data.email+' </p><p class="details"><b>Mobile Number : </b>+91 '+data.mobile+'</p>');	
					
				}
            }
        });

}
function sort(type)
{
    // alert(1)
	window.location.href ='{{route("ppanel.mybids")}}?sort='+type;
}
</script>
@stop