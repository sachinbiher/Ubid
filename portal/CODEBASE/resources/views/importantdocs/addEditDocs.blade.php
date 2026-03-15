@extends('layouts.app')

@push('PAGE_ASSETS_CSS')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/codemirror.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.6.0/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.6.0/css/froala_style.min.css" rel="stylesheet" type="text/css" />
<style>
.row {
margin-left: -15px;
margin-right: -15px;
}
.note-btn{
    display:none!important;
}
.portlet.light {
    padding: 12px 20px 15px;
    background-color: #fff;
    margin-top:28px!important;
    border-radius: 7px!important;
    border: 0 solid #edeef7!important;
    font-style:inherit!important;
}
textarea{
    padding: 0 12px!important;
    font-size: 11px!important;
    font-weight: 400!important;
    color: #151515!important;
    background-color: #fff!important;
    background-clip: padding-box!important;
    border: 1px solid #d8d6de!important;
    border-radius: 0.357rem!important;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out!important;
}
.form-actions{
    border-top:none!important;
}
</style>
@endpush

@section('content')
<div class="">
<div class="content-overlay"></div>
<div class="header-navbar-shadow"></div>
<div class="content-wrapper">
    <div class="content-body">
        <div class="col-md-12">
            <div class="portlet light">
                <div class="portlet-body form">
                    <div class="tabbable-bordered">
                        @if(isset($condtions))
                        <form class="form-horizontal docform form-row-seperated" action="{{route('importantdocs.edit',['id'=>$id])}}" method="post" enctype="multipart/form-data">
                        @else
                        <form class="form-horizontal docform form-row-seperated" action="{{route('importantdocs.add')}}" method="post" enctype="multipart/form-data">
                        @endif
                        {!! csrf_field() !!}
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="{{($errors->first('name'))?'has-error':''}}">
                                                    <label class="control-label">Name:<span class="required"> * </span></label>
                                                    <div class="">
                                                        <input type="text" class="form-control maxlength-handler" name="name"
                                                            maxlength="100" placeholder="" value="{{old('name',(isset($condtions))?$condtions->name:'')}}">
                                                        <span class="help-block">{{$errors->first('name')}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="{{($errors->first('display_name'))?'has-error':''}}">
                                                    <label class="control-label">Display Name:<span class="required"> *
                                                        </span></label>
                                                    <div class="">
                                                        <input type="text"  class="form-control maxlength-handler"
                                                            name="display_name" maxlength="100" placeholder=""
                                                            value="{{old('display_name', (isset($condtions))?$condtions->display_name:'')}}">
                                                        <span class="help-block">{{$errors->first('display_name')}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="{{($errors->first('description'))?'has-error':''}}">
                                                    <label class="control-label">Description:<span class="required"> *
                                                        </span></label>
                                                    <div class="">
                                                        <textarea class="description" name="description" id="froala-editor">
                                                                {{old('description', (isset($condtions))?$condtions->description:'') }}</textarea>
                                                        <span class="help-block">{{$errors->first('description')}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-6">
                                                @if(isset($condtions))
                                                <div class="">
                                                    <label class="control-label">Status:<span class="required"> * </span></label>
                                                    <div class="">
                                                        <select name="status" id="status" class="form-control">
                                                            @foreach([1=>'Active',0=>'Inactive'] as $val=>$label)
                                                            <option value="{{$val}}" {{(old('status', (isset($condtions))?$condtions->status:1)==$val)?'selected="selected"':''}}>{{$label}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions text-right">
                                <button type="button" id="btn_back" class="btn btn-primary mr-1"><span aria-hidden="true"
                                class="icon-arrow-left"></span> Back</button>
                    
                                <button type="submit" class="btn btn-primary mr-1 form-submit" name="save" value="save"
                                    data-loading-text="<i class='fa fa-spinner fa-spin'></i> Processing..."><span
                                        aria-hidden="true" class="icon-cloud-download"></span> Save</button>
                                @if(isset($condtions))
                                <button type="submit" class="btn btn-primary mr-1 form-submit" name="save" value="savecont"
                                    data-loading-text="<i class='fa fa-spinner fa-spin'></i> Processing..."><span
                                        aria-hidden="true" class="icon-check"></span> Save &amp; Continue Edit</button>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@push('PAGE_ASSETS_JS')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/codemirror.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/mode/xml/xml.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.6.0//js/froala_editor.pkgd.min.js"></script>
@endpush

@push('PAGE_SCRIPTS')
<script>
    $(function() {
       $('textarea#froala-editor').froalaEditor()
    });
</script>
@endpush