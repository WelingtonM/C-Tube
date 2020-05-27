@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        
        <channel-uploads :channel="{{ $channel }}" inline-template>
            
            <div class="col-md-8">
                <div class="text-white bg-dark mb-3 p-3 d-flex justify-content-center align-items-center" v-if="!selected">
                    <svg onclick="document.getElementById('video-files').click()" class="bi bi-arrow-up-square" width="10%" height="10%" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd" d="M14 1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                      <path fill-rule="evenodd" d="M4.646 8.354a.5.5 0 0 0 .708 0L8 5.707l2.646 2.647a.5.5 0 0 0 .708-.708l-3-3a.5.5 0 0 0-.708 0l-3 3a.5.5 0 0 0 0 .708z"/>
                      <path fill-rule="evenodd" d="M8 11.5a.5.5 0 0 0 .5-.5V6a.5.5 0 0 0-1 0v5a.5.5 0 0 0 .5.5z"/>
                    </svg>
                    
                    <input type="file" multiple id="video-files" ref="videos" style="display: none;" @change="upload">
                </div>

                <div class="card text-white bg-dark mb-3" v-else>
                    <div class="my-4" v-for="video in videos">
                        <div class="progress mb-3">
                            <div class="progress-bar progress-bar-striped progress-bar-animated " role="progressbar" :style="{width: `${video.percentage || progress[video.name]}%`}" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                                @{{ video.percentage ? video.percentage === 100 ? 'Video Processing completed.' : 'Processing' : 'Uploading' }}
                            </div>
                        </div>
                        <div class="row">
                            
                            <div class="col-md-4">
                                <div v-if="!video.thumbnail" class="d-flex justify-content-center align-items-center" style="height: 180px; color: white; font-size: 18px; background: #808080;">
                                        Loading thumbnail ...
                                </div>
                                <img v-else="" :src="video.thumbnail" style="width: 100%;">
                            </div>
        
                            <div class="col-md-4">
                                <a v-if="video.percentage && video.percentage === 100" target="_blank" :href="`/videos/${video.id}`">
                                    @{{ video.title }}
                                </a>
                                <h4 v-else class="text-center">
                                    @{{ video.title || video.name }}
                                </h4>
                            </div>
                            
                        </div>
                    </div>
                </div>

            </div>

        </channel-uploads>

    </div>
</div>
@endsection
