<form class="subcategory-save file-manager-application modal-content pt-0" id="subcategory-save" method="post" action="{{isset($subcategory)?route('childcategory.update'):route('childcategory.create')}}" enctype="multipart/form-data">
{!! csrf_field() !!}
@if(isset($subcategory))
<input type="hidden" name="id" value="{{$subcategory->id}}">
@endif
<div class="modal-header">
   <h4 class="modal-title text-primary" id="myModalLabel1">{{isset($category)?'Update':'Add'}} Sub Category</h4>
   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
</button>
</div>
   <div class="modal-body p-2">
         <div class="row">
            <div class="col-6">
               <div class="form-group">
                  <label>Sub Category</label>
                  <input type="text" class="form-control dt-input dt-Name" data-column="5" placeholder="Name" name="name" id="name" value="{{old('name', isset($subcategory)?$subcategory->name:'')}}"/> 
                  <span class="highlight">{{$errors->first('name')}}</span>
               </div>
            </div>
            <div class="col-6">
               <div class="form-group">
                  <label>Parent Category</label>
                  <div class="floating-label">
                        <select class="floating-select select2 form-control form-control dt-input dt-full-name" data-column="1" placeholder="Primary Category" placeholder="Alaric Beslier" data-column-index="0" value="" name="parent_category" id="parent_category">
                        <option value="">Select</option>
                        @foreach($categories as $category)
                        <option value="{{$category->id}}" @if(old('parent_category',
                           isset($subcategory)?$subcategory->category_id:'')==$category->id)
                           selected @endif>
                           {{$category->name}}</option>
                        @endforeach
                        </select>
                        <span class="highlight">{{$errors->first('parent_category')}}</span>
                     </div>
               </div>
            </div>
            <div class="col-6">
               <div class="form-group">
                  <label>Image</label>
                  <div class="custom-file">
                        <input type="file" class="custom-file-input" name="customFile" id="customFile" />
                        <label class="custom-file-label" for="customFile">Choose file</label>
                        <span id="customFile-error" class="error"></span>
                  </div>
               </div>
            </div>
            <div class="col-6">
               <div class="form-group">
                  <label>Status</label>
                  <div class="w-100">
                     <div class="floating-label">
                        <select class="floating-select select2 form-control form-control dt-input dt-full-name" name="status" id="status" data-column="1" placeholder="Primary Category" placeholder="Alaric Beslier" data-column-index="0" value="">
                        @foreach(['1'=>'Active','0'=>'Inactive'] as $val=>$label)
                        <option value="{{$val}}" @if(old('status', isset($subcategory)?$subcategory->status:1)==$val) selected @endif>
                           {{$label}}</option>
                        @endforeach
                        </select>
                        <span class="highlight">{{$errors->first('status')}}</span>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <hr>
         <div class="action-buttons text-right">
            @if(isset($subcategory))
            <button type="submit" class="btn btn-success" name="save" id="save" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Processing...">Update</button>
            @else
            <button type="submit" class="btn btn-success" name="save" id="save" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Processing...">Save</button>
            @endif
         </div>
   </div>
</form>