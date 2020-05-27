@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card text-white bg-primary mb-3">
                <div class="card-header"><h3>Dashboard</h3></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <form>
                        <input type="text" name="search" class="form-control" placeholder="Search videos and channels">
                    </form>
                </div>
            </div>

            @if($channels->count() !== 0)
                <div class="card text-white bg-secondary  mt-5">
                    <div class="card-header">
                        <h4>Channels</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-dark">
                            <thead>
                                <th>Name</th>
                                <th></th>
                            </thead>
                            <tbody>
                                @foreach($channels as $channel)
                                <tr>
                                    <td>{{ $channel->name }}</td>
                                    <td><a href="{{ route('channels.show', $channel->id) }}" class="btn btn-sm btn-info">View Channel</a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="row justify-content-center">
                            {{ $channels->appends(request()->query())->links() }}
                        </div>
                    </div>
                </div>
            @endif            

            @if($videos->count() !== 0)
                <div class="card text-white bg-secondary mt-5">
                    <div class="card-header">
                        <h4>Videos</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-dark">
                            <thead>
                                <th>Name</th>
                                <th></th>
                            </thead>
                            <tbody>
                                @foreach($videos as $video)
                                <tr>
                                    <td>{{ $video->title }}</td>
                                    <td><a href="{{ route('videos.show', $video->id) }}" class="btn btn-sm btn-info">View Video</a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="row justify-content-center">
                            {{ $videos->appends(request()->query())->links() }}
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </div>
</div>
@endsection
