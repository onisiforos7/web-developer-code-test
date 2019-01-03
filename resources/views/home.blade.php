@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"> Action Items</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                        <table class="table table-striped">
                            <thead class="">
                            <tr>
                                <th>no</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($actionItems as $item)
                                <tr>
                                    <td class="font-weight-bold"> {{$item->id}}</td>
                                    <td class="text-left"> {{$item->descr}}</td>
                                    <td>
                                        @if($item->getAttachment->where('user_id', Auth()->id())->count())
                                            <a href="{{route('upload', ['id' => $item->id])}}">Watch Submission</a>
                                            <span style="color: green;">Done!!</span>
                                        @else
                                            <a href="{{route('upload', ['id' => $item->id])}}">
                                                Submit</a>
                                        @endif

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
