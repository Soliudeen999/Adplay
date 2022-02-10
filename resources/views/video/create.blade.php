@extends('layouts.app')


@section('css')



@endsection
@section('content')
    <div class="main py-4">
        <div class="row">
            <div class="col-12 col-xl-12">
                <div class="col-12 px-0">
                    <div class="card border-0 shadow justify-content-center">
                        <div class="card-body justify-content-centr">
                            <h2 class="fs-5 fw-bold mb-1">{{ __('New Video') }}</h2>
                                <div class="row justify-content-center">
                                    <div id="wizard2" class="swMain">
                                        <ul>
                                            <li>
                                                <a href="#step-1">
                                                    <label class="stepNumber">1 </label>
                                                    <span class="stepDesc">
                                                        Video<br />
                                                        <small> Set Video details</small>
                                                    </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#step-2">
                                                <label class="stepNumber">2</label>
                                                <span class="stepDesc">
                                                    Pop up<br />
                                                    <small>Set Pop-up props</small>
                                                </span>
                                                </a>
                                            </li>
                                        </ul>
                                        <div class="row" style="min-height: 450px;">
                                        <form class=" formMain" method="POST" action="{{ route('video.create.new') }}" id="formMain" enctype="multipart/form-data">
                                        <div id="step-1" style="min-height: 450px;">   
                                            <div class="row " style="min-height: 450px;">
                                                <div class="col-xl-10 my-4 mx-4">
                                                    <div class="alert alert-danger" id="msgbox" style="display: none;">
                                                        
                                                    </div>
                                                    <h2 class="StepTitle my-2">Create the new video info</h2>
                                                    <div class="row">
                                                        <div class="col-xl-12 col-xs-5 col-md-12">
                                                                @csrf
                                                                @method('POST')
                                                                <div class="form-group mt-1">
                                                                    <label>Title</label>
                                                                    <input type="text" name="title" class="form-control" id="title">
                                                                </div>
                                                                <div class="form-group mt-1">
                                                                    <label>Short Description</label>
                                                                    <textarea class="form-control" id="description" name="description"></textarea>
                                                                </div>
                                                                <div class="form-group mt-2">
                                                                    <label>Video Source:</label>
                                                                    <select class="form-control" name="type" onchange="addBody()" id="type">
                                                                        <option>Choose..</option>
                                                                        <option value="local">Local Computer</option>
                                                                        <option value="url">Url</option>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group mt-1" id="url" style="display: none;">
                                                                    <label>Youtube Video Url</label>
                                                                    <input type="url" name="url" class="form-control">
                                                                </div>
                                                                <div class="form-group mt-1" id="local" style="display: none;">
                                                                    <label>Choose Video File</label>
                                                                    <input type="file" name="local" class="form-control">
                                                                </div>

                                                        </div>
                                                    </div>               
                                                </div>
                                            </div>
                                        </div>
                                        <div id="step-2" style="min-height: 500px;">
                                            <div class="row " >
                                                <div class="col-xl-10 my-4 mx-4">
                                                    <div class="alert alert-danger" id="msgbox2" style="display: none;">
                                                        
                                                    </div>
                                                    <h2 class="StepTitle my-2">Set Pop-up Properties</h2>
                                                    <div class="row">
                                                        <div class="col-xl-12 col-xs-5 col-md-12">
                                                                <div class="form-group mt-1">
                                                                    <label>Font Color <small>(Please spell correctly)</small></label>
                                                                    <input type="text" name="font_color" class="form-control" id="font_color">
                                                                </div>
                                                                <div class="form-group mt-1">
                                                                    <label>Ad Background Color <small>(Please spell correctly)</small></label>
                                                                    <input type="text" name="background_color" class="form-control" id="background_color">
                                                                </div>
                                                                <div class="form-group mt-2">
                                                                    <label>Font Family</label>
                                                                    <select class="form-control" name="font_family" id="font_family" required>
                                                                        <option>Choose..</option>
                                                                        <option value="Arial">Arial</option>
                                                                        <option value="Helvetica">Helvetica</option>
                                                                        <option value="sans-serif">Sans-Serif</option>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group mt-1">
                                                                    <label>Pop-up Time <small>(In seconds)</small></label>
                                                                    <input type="text" name="pop_time" class="form-control" id="pop_time">
                                                                </div>
                                                                <div class="form-group mt-2">
                                                                    <label>Pop-up Position</label>
                                                                    <select class="form-control" name="position" onchange="positoning()" id="positioning">
                                                                        <option>Choose..</option>
                                                                        <option value="overlay-center">Overlay Center</option>
                                                                        <option value="overlay-left-bottom-corner">Overlay Left-Bottom-Corner</option>
                                                                        <option value="overlay-left-top-corner">Overlay Left-Top-Corner</option>
                                                                        <option value="overlay-right-bottom-corner">Overlay Right-Bottom-Corner</option>
                                                                        <option value="overlay-right-top-corner">Overlay Right-Top-Corner</option>
                                                                        <option value="custom">Customize</option>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group mt-1" id="custom" style="display: none;">
                                                                    <label>Set Position <small>(top,left)</small></label>
                                                                    <input type="text" name="custom" class="form-control" placeholder="10,30">
                                                                </div>
                                                                
                                                        </div>
                                                    </div>               
                                                </div>
                                            </div>

                                        </div>
                                        </form>
                                        </div>
                                    </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

    <script type="">

        function addBody() {
            if ($('#type').val() == 'url') {
                document.getElementById('url').style.display = 'block'
                document.getElementById('local').style.display = 'none'
            }else{
                document.getElementById('local').style.display = 'block'
                document.getElementById('url').style.display = 'none'
            }
        }

        function positoning() {
            if ($('#positioning').val() == 'custom') {
                document.getElementById('custom').style.display = 'block'
            }else{
                document.getElementById('custom').style.display = 'none'
            }
        } 

        $(document).ready(function(){
            //  Wizard 2
            $('#wizard2').smartWizard({
                transitionEffect:'slide',
                onFinish:onFinishCallback,
                onLeaveStep:leaveAStepCallback
            });

            function onFinishCallback(){
                if(validateAllSteps()){
                    $('#formMain').submit();
                }
            }     

            function leaveAStepCallback(obj){
                var step_num= obj.attr('rel');
                return validateSteps(step_num);
            }

            function validateSteps(step){
                var isStepValid = true;
                // validate step 1
                if(step == 1){
                    if(validateStep1() == false ){
                        isStepValid = false; 
                        $('#wizard').smartWizard('showMessage','Please correct the errors in step'+step+ ' and click next.');
                        $('#wizard').smartWizard('setError',{stepnum:step,iserror:true});         
                    }else{
                        $('#wizard').smartWizard('hideMessage');
                        $('#wizard').smartWizard('setError',{stepnum:step,iserror:false});
                    }
                }

                // validate step3
                if(step == 2){
                    if(validateStep2() == false ){
                        isStepValid = false; 
                        $('#wizard').smartWizard('showMessage','Please correct the errors in step'+step+ ' and click next.');
                        $('#wizard').smartWizard('setError',{stepnum:step,iserror:true});         
                    }else{
                        $('#wizard').smartWizard('hideMessage');
                        $('#wizard').smartWizard('setError',{stepnum:step,iserror:false});
                    }
                }

                return isStepValid;
            }


            function validateStep1(){
                var isValid = true; 
                // Validate Username
                var title = $('#title').val();
                var description = $('#description').val();
                var type = $('#type').val();
                if(!title || title.length <= 0 || !description || description.length <= 0 || !type || type.length <= 0 ){
                    isValid = false;
                    $('#msgbox').html('Please fill all Fields').show();
                    $('#wizard').smartWizard('setError',{stepnum:1,iserror:true});         

                }else{
                    $('#msgbox').html('').hide();
                }

                return isValid;
            }

            function validateStep2(){
                var isValid = true;    
                //validate email  email
                var positioning = $('#positioning').val();
                var font_color = $('#font_color').val();
                var font_family = $('#font_family').val();
                var pop_time = $('#pop_time').val();
                var background_color = $('#background_color').val();
                if(!positioning || positioning.length <= 0 || !font_color || font_color.length <= 0 || !pop_time || pop_time.length <= 0 || !background_color || background_color.length <= 0 ){
                    isValid = false;
                    $('#msgbox2').html('Please fill all Fields').show();
                    $('#wizard').smartWizard('setError',{stepnum:1,iserror:true});         

                }else{
                    $('#msgbox2').html('').hide();
                }

                return isValid;
            }

            function validateAllSteps(){
                var isStepValid = true;

                if(validateStep1() == false){
                    isStepValid = false;
                    $('#wizard').smartWizard('setError',{stepnum:1,iserror:true});         
                }else{
                    $('#wizard').smartWizard('setError',{stepnum:1,iserror:false});
                }

                if(validateStep2() == false){
                    isStepValid = false;
                    $('#wizard').smartWizard('setError',{stepnum:3,iserror:true});         
                }else{
                    $('#wizard').smartWizard('setError',{stepnum:3,iserror:false});
                }

                if(!isStepValid){
                    alert('Please correct the errors in the steps and continue');
                }

                return isStepValid;
            }

        });
            
    </script>
@endsection
