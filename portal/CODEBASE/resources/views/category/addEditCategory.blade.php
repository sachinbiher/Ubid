<form class="category-save file-manager-application modal-content pt-0" id="category-save" method="post" action="{{isset($category)?route('category.update'):route('category.create')}}" enctype="multipart/form-data">
{!! csrf_field() !!}
@if(isset($category))
<input type="hidden" name="id" value="{{$category->id}}">
@endif
<div class="modal-content file-manager-application">
   <div class="modal-header">
      <h4 class="modal-title text-primary" id="myModalLabel1">{{isset($category)?'Update':'Add'}}  Category</h4>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
         <span aria-hidden="true">&times;</span>
      </button>
   </div>
    <div class="modal-body p-2">
            <div class="row">
               <div class="col-4">
               <div class="form-group">
                  <label>Category</label>
                  <input type="text" class="form-control dt-input dt-Name" name="name" id="name" value="{{isset($category)?$category->name:''}}"  data-column="5" placeholder="Name" /> </div>
                  <span id="name-error" class="error">{{$errors->first('name')}}</span>
               </div>
               <div class="col-4">
                  <div class="form-group">
                     <label>Status</label>
                     <div class="w-100">
                        <div class="floating-label">
                        <select class="floating-select select2 form-control form-control dt-input dt-full-name" name="status" data-column="1" placeholder="Primary Category" placeholder="Alaric Beslier" data-column-index="0" value="">
                           <option value="">Select</option>
                           @foreach(['1'=>'Active','0'=>'Inactive'] as $val=>$label)
                           <option value="{{$val}}">
                              {{$label}}</option>
                           @endforeach
                        </select>
                        </div>
                     </div>
                  </div>
                  <span id="status-error" class="error">{{$errors->first('status')}}</span>
               </div>
               <div class="col-4">
               <div class="form-group">
                  <label>Image</label>
                  <div class="custom-file">
                        <input {{isset($category)?'':'required'}}  accept="application/pdf,image/jpeg,image/png" type="file" class="custom-file-input" name="customFile" id="customFile" />
                        <label class="custom-file-label" for="customFile">Choose file</label>
                        <span id="customFile-error" class="error"></span>
                  </div>
               </div>
            </div>
            </div>
            <hr>
            <div class="action-buttons text-right">
            @if(isset($category))
            <button type="submit" class="btn btn-success" name="save" id="save" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Processing...">Update</button>
            @else
            <button type="submit" class="btn btn-success" name="save" id="save" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Processing...">Save</button>
            @endif
            </div>
    </div>
</div>
</form>
