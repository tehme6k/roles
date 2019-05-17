@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Show Topic #1</div>

                <div class="card-body">

                    @can('edit post')
                        <a href="">Edit Post</a>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
