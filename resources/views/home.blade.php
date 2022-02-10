@extends('layouts.app')

@section('content')
    <div class="main py-4">
        <div class="row">
            <div class="col-12 col-xl-12">
                <div class="col-12 px-0">
                    <div class="card border-0 shadow">
                        <div class="card-body">
                            <h2 class="fs-5 fw-bold mb-1">{{ __('Dashboard') }}</h2>
                            {{-- <p>{{ __('You are logged in!') }}</p> --}}
                            <a href="{{ route('video.create') }}" class="btn btn-gray-800 d-inline-flex align-items-center me-2 dropdown-toggle mb-3">
                                <svg class="icon icon-xs me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                                New Video
                            </a>

                            <!-- Gallery -->
                            <div class="row">
                            @forelse($videos as $video)
                              <div class="col-lg-4 col-md-12 mb-4 mb-lg-0">
                                <div class="card mb-4 bordr-0">
                                    <img
                                      src="https://mdbcdn.b-cdn.net/img/Photos/Horizontal/Nature/4-col/img%20(73).webp"
                                      class="w-100 shadow-1-strong rounde "
                                      alt="Boat on Calm Water"
                                    />
                                    <div class="card-footer">
                                        <div class="row align-items-center">
                                            <div class="col-8">
                                                <span class="font-13">{{ $video->title }}</span>
                                            </div>
                                            <div class="col-4 text-right">
                                                <a href="{{ route('video.view', ['video' => $video->id]) }}" class="float-right btn btn-sm btn-default" title=""> view</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                              </div>
                            @empty
                                <div class="alert alert-info text-center">
                                    No file in this gallery, You can add new 
                                </div>

                            @endforelse

                            </div>
                            <!-- Gallery -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
