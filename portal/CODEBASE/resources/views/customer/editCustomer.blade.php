<form class="customer-update" method="post" action="{{route('customer.update')}}" enctype="multipart/form-data">
{!! csrf_field() !!}
<input type="hidden" name="id" value="{{$customer->id}}">
    <div class="modal-content file-manager-application">
        <div class="modal-header">
            <h4 class="modal-title text-primary" id="myModalLabel1">Edit Customer</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body p-2">
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control dt-input dt-Name" value="{{old('name', isset($customer->name)?$customer->name:'')}}" data-column="5" placeholder="Name" name="name" id="name"/> 
                        <span id="name-error" class="error"></span>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label>Email ID</label>
                        <input type="text" class="form-control dt-input dt-email" value="{{old('email', isset($customer->email)?$customer->email:'')}}" data-column="5" placeholder="Email ID" name="email" id="email"/>
                        <span id="email-error" class="error"></span>
                     </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label>Contact No.</label>
                        <input type="text" class="form-control dt-input dt-contact-no" value="{{old('mobile', isset($customer->mobile)?$customer->mobile:'')}}" data-column="5" placeholder="Contact No." name="mobile" id="mobile" />
                        <span id="mobile-error" class="error"></span>
                     </div>
                </div>
                <div class="col-6">
                <div class="form-group">
                    <label>Status</label>
                    <div class="w-100">
                        <div class="floating-label">
                            <select class="floating-select select2 form-control form-control dt-input dt-full-name" data-column="1" placeholder="Primary Category" placeholder="Alaric Beslier" data-column-index="0" value="" name="status" id="status">
                            @foreach(['1'=>'Active','0'=>'Inactive'] as $val=>$label)
                            <option value="{{$val}}" @if(old('status', isset($customer->status)?$customer->status:1)==$val) selected @endif>
                            {{$label}}</option>
                            @endforeach
                            </select>
                            <span id="status-error" class="error"></span>
                        </div>
                    </div>
                </div>
                </div>
            </div>
            <hr>
            <div class="action-buttons text-right">
                <button type="submit" name="save" id="save" class="btn btn-success" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Processing...">Update</button>
            </div>
        </div>
    </div>
</form>
