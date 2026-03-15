@extends('layouts.auth') @push('PAGE_ASSETS_CSS') <style>
    .form-body.without-side .form-content .form-items {
        padding: 35px 30px;
    }

    .form-body.without-side .form-content .form-items {
        padding: 14px 30px;
        border-radius: 10px;
        background-color: #fff;
        box-shadow: 0 5px 15px 5px rgb(80 102 224 / 8%);
    }
.form-body
{    padding: 34px;}

    .form-content .form-items {
        text-align: left;
    }

    .website-logo {
        margin: 0 auto;
        justify-content: center;
        align-items: center;
        display: flex;
    }

    .website-logo img {
        width: 138px;
    }
    .form-items h3
{
    text-align: center;
    margin: 10px 2px 23px;
    font-weight: 600;
    text-transform: uppercase;
}
    .form-content .form-items {
        display: inline-block;
        text-align: left;
        -webkit-transition: all 0.4s ease;
        transition: all 0.4s ease;
    }
    .btn-primary {
    border-color: #9d6945 !important;
    background-color: #9d6945 !important;
    color: #fff !important;
}
    .v-row
    {
        display: flex;
    justify-content: center;
    align-items: center;
    vertical-align: middle;
    height: 100vh;
    }
</style> @endpush @section('content') <section>
    <div class="container">
        <div class="row v-row">
        <div class="col-lg-4 offset-lg-1 form-body without-side">
                <div class="row ">
                    <div class="form-holder">
                        <div class="form-content">
                            <div class="form-items">
                                <div class="website-logo">
                                    <a class="navbar-brand" href="{{route('login')}}">
                                        <img src="{{url('app-assets/images/UBID-logo.png')}}">
                                    </a>
                                </div>
                                <h3>Client Feedback</h3>
                                <form class="form form-vertical" name="feedback-form" id="feedback-form" action="{{route('submitfeedback')}}" method="post" enctype="multipart/form-data" onsubmit="save.disabled=true; return true;">
			                        {!! csrf_field() !!}
                                   
                                    <input type='hidden' id='ref_id' name='ref_id' value={{$ref_id}}>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Name</label>
                                                <input value="{{ old('username') }}" class="form-control" autocomplete="off" type="text" id="username" name="username" placeholder="Enter Name" >
                                                <span class="highlight">{{$errors->first('username')}}</span>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Rating</label>
                                                <select id='rating'name='rating' class="form-control" style="color: gold;">
                                                <option value='' style="color: #151515!important;">Select Rating</option>
                                                
                                                  <!-- <option value='1'>Rating 1</option>
                                                  <option value='2'>Rating 2</option>
                                                  <option value='3'>Rating 3</option>
                                                  <option value='4'>Rating 4</option>
                                                  <option value='5'>Rating 5</option> -->
                                                  <option value='1' style="color: gold;">★</option>
                                                  <option value='2' style="color: gold;">★★</option>
                                                  <option value='3' style="color: gold;">★★★</option>
                                                  <option value='4' style="color: gold;">★★★★</option>
                                                  <option value='5' style="color: gold;">★★★★★</option>
                                                </select>
                                                <span class="highlight">{{$errors->first('rating')}}</span>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Comments</label>
                                                <textarea   rows="4" maxlength='1024' id="comments" name="comments" class="form-control">{{ old('comments') }} </textarea>
                                                <span class="highlight">{{$errors->first('comments')}}</span>
                                            </div>
                                        </div>
                                        
                                    </div>
                                     <div class="form-button">
                                        <button id="submit" type="submit" value='submitfeedback' class="btn btn-primary btn-block">Submit</button> 
                                    </div>
                                </form>
                              
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
            <img src="{{url('app-assets/images/client_review.png')}}">
</div>
           
        </div>
    </div>
    </div>
</section> @stop @push('PAGE_ASSETS_JS') @endpush @push('PAGE_SCRIPTS')
<!-- Bootstrap JS--> @endpush