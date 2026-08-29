@extends('admin.mainlayout')

@section('title', 'SIGAP | dashboard')

@section('content')
<div class="col-md-12">
    <div class="row">
       @if (Auth::user()->role_id == 1)
       <div class="col-md-3">
        <a href="{{ route('dashboard.user') }}">
            <div class="card user mb-4">
                <div class="card-body position-relative">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5>User</h5>
                            <h2>{{ $user_count}}</h2>
                        </div>
                        <div class="icon-container">
                            <i class="bi bi-person-fill"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    
    <div class="col-md-3">
        <a href="{{ route('dashboard.pasar') }}">
            <div class="card pasar mb-4">
                <div class="card-body position-relative">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5>Pasar</h5>
                            <h2>{{ $pasar_count}}</h2>
                        </div>
                        <div class="icon-container">
                            <i class="bi bi-building"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>  
    
    <div class="col-md-3">
        <a href="{{ route('dashboard.lapak') }}">
            <div class="card lapak mb-4">
                <div class="card-body position-relative">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5>Lapak</h5>
                            <h2>{{ $lapak_count}}</h2>
                        </div>
                        <div class="icon-container">
                            <i class="bi bi-shop-window"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    
    <div class="col-md-3">
        <a href="{{ route('dashboard.komoditas') }}">
            <div class="card komoditas mb-4">
                <div class="card-body position-relative">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5>Komoditas</h5>
                            <h2>{{ $komoditas_count}}</h2>
                        </div>
                        <div class="icon-container">
                            <i class="bi bi-box"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div> 
        @else
        <div class="col-md-3">
            <a href="{{ route('dashboard.pasar') }}">
                <div class="card pasar mb-4">
                    <div class="card-body position-relative">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5>Pasar</h5>
                                <h2>{{ $pasar_count}}</h2>
                            </div>
                            <div class="icon-container">
                                <i class="bi bi-building"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>  
        
        <div class="col-md-3">
            <a href="{{ route('dashboard.lapak') }}">
                <div class="card lapak mb-4">
                    <div class="card-body position-relative">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5>Lapak</h5>
                                <h2>{{ $lapak_count}}</h2>
                            </div>
                            <div class="icon-container">
                                <i class="bi bi-shop-window"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        
        <div class="col-md-3">
            <a href="{{ route('dashboard.komoditas') }}">
                <div class="card komoditas mb-4">
                    <div class="card-body position-relative">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5>komoditas</h5>
                                <h2>{{ $komoditas_count}}</h2>
                            </div>

                            <div class="icon-container">
                                <i class="bi bi-box"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
       @endif 
        
       

</div>
@endsection
