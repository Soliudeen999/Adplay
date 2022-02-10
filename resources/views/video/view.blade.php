@extends('layouts.app')


@section('css')

    @php
        if ($video->property->position == 'custom') {
            $all = explode(',', $video->property->custom);
            $top = $all[0];
            $left = $all[1];
        }
    @endphp
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" integrity="sha512-c42qTSw/wPZ3/5LBzD+Bw5f7bSF2oxou6wEb+I/lqeaKV5FDIfMvvRp772y4jcJLKuGUOpbJMdg/BTl50fJYAw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.min.css" integrity="sha512-cyIcYOviYhF0bHIhzXWJQ/7xnaBuIIOecYoPZBgJHQKFPo+TOBA+BY1EnTpmM8yKDU4ZdI3UGccNGCEUdfbBqw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {font-family: Arial, Helvetica, sans-serif;}
        * {box-sizing: border-box;}

        /* Button used to open the contact form - fixed at the bottom of the page */
        .open-button {
          background-color: #555;
          color: white;
          padding: 16px 20px;
          border: none;
          cursor: pointer;
          opacity: 0.8;
          position: fixed;
          bottom: 23px;
          right: 28px;
          width: 80px;
        }

        /* The popup form - hidden by default */
        .form-popup {
          display: none;
          position: absolute;
          bottom: 0px;
          right: 0px;
          border: 3px solid #f1f1f1;
          z-index: 9;
        }

        /* Add styles to the form container */
        .form-container {
          /*max-width: 40%;*/
          max-height: 25%;
          padding: 10px;
          background-color: white;
        }

        /* Full-width input fields */
        .form-container input[type=text], .form-container input[type=password] {
          width: 100%;
          padding: 15px;
          margin: 5px 0 22px 0;
          border: none;
          background: #f1f1f1;
        }

        /* When the inputs get focus, do something */
        /*.form-container input[type=text]:focus, .form-container input[type=password]:focus {
          background-color: #ddd;
          outline: none;
        }*/

        /* Set a style for the submit/login button */
        .form-container .btna {
          background-color: #04AA6D;
          color: white;
          padding: 16px 20px;
          border: none;
          cursor: pointer;
          width: 100%;
          margin-bottom:10px;
          opacity: 0.8;
        }

        /* Add a red background color to the cancel button */
        .form-container .cancel {
          background-color: red;
        }

        /* Add some hover effects to buttons */
        .form-container .btn:hover, .open-button:hover {
          opacity: 1;
        }

        /* Player parent DIV  */
        .play-parent {
            width:100%;  /* width depends on your layout and needs  */
            position:relative;
            overflow:hidden;
        }

        /* Semi-transparent DIV element to cover entire player */
        .div-over {
            background:rgba(0,0,0,0.5);
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            left: 0;
            z-index:99;
            display:none;
            overflow:hidden;
        }

        /* Centered DIV element for our banner ad */

        .overlay-center {
            position:absolute;
            top:50%;
            left:50%;
            transform: translate(-50%, -50%);
            display:inline-block;
        }

        .overlay-left-bottom-corner {
            position:absolute;
            bottom:10px;
            left: 10px;
            display:inline-block;
        }

        .overlay-left-top-corner{
            position:absolute;
            /*bottom:0;*/
            /*left: 0;*/
            display:inline-block;
        }

        .overlay-right-bottom-corner{
            position:absolute;
            bottom:10px;
            right: 10px;
            display:inline-block;
        }
        .overlay-right-top-corner{
            position:absolute;
            top:10px;
            right: 10px;
            display:inline-block;
        }

        .overlay{
            position:absolute;
            top:{{ $top ?? 0 }}%;
            left: {{ $left ?? 0}}%;
            transform: translate({{ ($top ?? 0) - 100 }}%, {{ ($left ?? 0) - 100 }}%);
            display:inline-block;
        }
        /* Close button */
        .over-close {
            width: 28px;
            height: 28px;
            position: absolute;
            top:10px;
            right:10px;
            background:#fff;
            cursor:pointer;
            border-radius:50%;
            -webkit-border-radius:50%;
            -moz-border-radius:50%;
        }
        .over-close:after {
            content: '';
            height: 16px;
            border-left: 2px solid #222;
            position: absolute;
            transform: rotate(45deg);
            left: 13px;
            top:6px;
        }

        .over-close:before {
            content: '';
            height: 16px;
            border-left: 2px solid #222;
            position: absolute;
            transform: rotate(-45deg);
            left: 13px;
            top:6px;
        }
    </style>
@endsection
@section('content')
    @php
        if ($video->property->position == 'custom') {
            $all = explode(',', $video->property->custom);
            $top = $all[0];
            $left = $all[1];
        }
    @endphp
    <div class="main py-4">
        <div class="row">
            <div class="col-12 col-xl-12">
                <div class="col-12 px-0">
                    <div class="card border-0 shadow justify-conten-center">
                        <div class="card-body justify-content-enter">
                            <div class="row">
                                <div class="col-xl-12 col-md-12">
                                    <div class="play-parent"> 
                                    @if($video->type == 'local')
                                    <video autobuffer autoloop loop controls width="100%" height="100%" id="myvid" style="min-height: 500px;">
                                        <source src="{{ asset($video->file_url)}}" type="video/mp4">
                                        {{-- <source src="{{ $video->file_url }}" type="video/ogg"> --}}
                                        <p><a href="/media/video.oga">Download this video file.</a></p>
                                    </video>
                                    @else
                                        <iframe src="https://www.youtube.com/embed/{{ $video->file_url }}?enablejsapi=1&version=3&playerapiid=ytplayer" width="100%" height="100%" id="youtube" modestbranding="0"  controls="0" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen

                                        style="min-height: 500px;"></iframe>
                                    @endif
                                    <div class="div-over" id="div-over">
                                        <div class="{{ $video->property->position }}" id="overlay">
                                          <form action="/newsletter" class="form-container" method="POST" id="forming" style="color: {{ $video->property->font_color }}; background-color: {{ $video->property->background_color }}; font-family: {{ $video->property->font_family }};">
                                            @csrf
                                            {{-- <p>Subscribe Now</p> --}}
                                            <p class="py-1">Subscribe to Our Newsletter</p>
                                            <div class="row">
                                                <div class="form-group">
                                                    <input type="text" placeholder="Enter Name" name="name" required class="form-control input-sm" id="name">
                                                </div>
                                                <div class="form-group">
                                                    <input type="email" placeholder="Enter Email" name="email" required class="form-control input-sm" id="email">
                                                </div>
                                                <div class="form-group">
                                                    <button type="button" class="btn btn-block btn-success btn-sm my-1" id="submitNewletter">Submit</button>
                                                    <button type="button" class="btn btn-block btn-success btn-sm my-1 over-close">Close</button>
                                                </div>
                                            </div>
                                          </form>
                                        </div>
                                        <div class="over-close" id="over-close"></div>
                                    </div>
                                    
                                    </div>

                                    
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-xl-8">
                                    <p>{{ $video->title }}</p>
                                </div>
                                <div class="col-xl-4">
                                    @if($video->type == 'local')
                                    <button class="btn btn-gray-800 d-inline-flex align-items-center play-video" id="vidbutton">PLAY</button>
                                    @else
                                    <button class="btn btn-gray-800 d-inline-flex align-items-center play-video" id="{{ $video->type == 'url' ? 'play_it' : 'vidbutton' }}">PLAYit</button>
                                    <button class="btn btn-gray-800 d-inline-flex align-items-center pause-video" id="{{ $video->type == 'url' ? 'pause_it' : 'vidbutton' }}">PAUSE</button>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-12 col-md-12">
                                    <p>{{ $video->description }}</p>
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
    <script src="{{ asset('jQuery-Smart-Wizard/js/jquery-1.4.2.min.js') }}"></script>
    {{-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> --}}

   <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.all.min.js" integrity="sha512-IZ95TbsPTDl3eT5GwqTJH/14xZ2feLEGJRbII6bRKtE/HC6x3N4cHye7yyikadgAsuiddCY2+6gMntpVHL1gHw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  
    <script>
        function openForm() {
          document.getElementById("myForm").style.display = "block";
        }

        function closeForm() {
          document.getElementById("myForm").style.display = "none";
        }


        $('#submitNewletter').click(function(){
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            var forming = $('#forming');

            var name = $('#name').val();
            var email = $('#email').val();
            if (!name || name.length <= 0 || !email || email.length <= 0) {
                alert('Please fill the form fields before submitting');
                return false;
            }
            $.ajax({
               url: '/newsletter',
               type: 'POST',
               data: {_token: CSRF_TOKEN, 'name' : name, 'email': email},
               dataType: 'JSON',
               success: function (resp) { 
                    document.getElementById("div-over").style.display = "none";
                   console.log(resp)
                   Swal.fire({
                     title: 'Thank you for subscribing',
                     toast: true,
                     timer: 3000,
                     position: 'bottom',
                     icon: 'success',
                     showConfirmButton: false,
                     showClass: {
                       popup: 'animate__animated animate__fadeInDown'
                     },
                     hideClass: {
                       popup: 'animate__animated animate__fadeOutUp'
                     }
                   })
                }
            });
        })

        var ppbutton = document.getElementById("vidbutton");
        // ppbutton.addEventListener("click", playPause);

        myVideo = document.getElementById("myvid");

        var canDo = false;
        $('#vidbutton').click(function (e) { 
            if (myVideo.paused) {
                myVideo.play();
                e.preventDefault();

                if (canDo == false) {
                    setTimeout(function (){
                        document.getElementById("div-over").style.display = "block";
                    }, {{ $video->property->pop_time }} * 1000);
                    canDo = true;
                }
                ppbutton.innerHTML = "Pause";
            }
            else  {
                myVideo.pause(); 
                ppbutton.innerHTML = "Play";
            }
        })

        $('#play_it').click(function(){
          $('#youtube')[0].contentWindow.postMessage('{"event":"command","func":"' + 'playVideo' + '","args":""}', '*');

          if (canDo == false) {
              setTimeout(function (){
                  document.getElementById("div-over").style.display = "block";
              }, {{ $video->property->pop_time }} * 1000);
              canDo = true;
          }
            // document.getElementById("div-over").style.display = "block";
        });
        
        $('#pause_it').click(function(){
          $('#youtube')[0].contentWindow.postMessage('{"event":"command","func":"' + 'pauseVideo' + '","args":""}', '*');
        });

        $('.over-close').click(function(){
            document.getElementById("div-over").style.display = "none";
        })
        
    </script>



@endsection
