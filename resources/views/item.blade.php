@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"> Action Item: {{$actionItem->id}}</div>

                    <div class="card-body">
                        <p>{{$actionItem->descr}}</p>

                        @if(!($actionItem->getAttachment->where('user_id', Auth()->id())->count()))
                            <form action="{{route('store')}}" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="col-md-12 pt-4">
                                    <input type="hidden" name="action_id" value="{{$actionItem->id}}">
                                    <input type="file" name="attachment">
                                    @if ($errors->has('attachment'))
                                        <div class="error text-danger">{{ $errors->first('attachment') }}</div>
                                    @endif
                                    <input class="d-block mt-3" type="submit">
                                </div>
                            </form>
                        @else
                            <img width="100%" src="{{asset('/storage/attachments/'.$actionItem->getAttachment->where('user_id', Auth()->id())->first()->attachment_path)}}">
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
