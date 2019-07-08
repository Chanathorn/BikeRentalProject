@extends('layouts.app0')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">BikeKPS</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h4 style="text-align:center;" >ยินดีตอนรับเข้าสู่ระบบ <br> คุณ <strong>{{ Auth::user()->name }} {{ Auth::user()->lastname }}</strong> <br></h4> 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
