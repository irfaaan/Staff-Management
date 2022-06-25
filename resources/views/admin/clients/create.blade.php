@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.create') }} {{ trans('cruds.client.title_singular') }}
        </div>

        <div class="card-body">
            <form action="{{ route("admin.clients.store") }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group {{ $errors->has('first_name') ? 'has-error' : '' }}">
                    <label for="first_name">{{ trans('cruds.client.fields.first_name') }}*</label>
                    <input type="text" id="first_name" name="first_name" class="form-control"
                           value="{{ old('first_name', isset($client) ? $client->first_name : '') }}" required>
                    @if($errors->has('first_name'))
                        <p class="help-block">
                            {{ $errors->first('first_name') }}
                        </p>
                    @endif
                    <p class="helper-block">
                        {{ trans('cruds.client.fields.first_name_helper') }}
                    </p>
                </div>
                <div class="form-group {{ $errors->has('last_name') ? 'has-error' : '' }}">
                    <label for="last_name">{{ trans('cruds.client.fields.last_name') }}</label>
                    <input type="text" id="last_name" name="last_name" class="form-control"
                           value="{{ old('last_name', isset($client) ? $client->last_name : '') }}">
                    @if($errors->has('last_name'))
                        <p class="help-block">
                            {{ $errors->first('last_name') }}
                        </p>
                    @endif
                    <p class="helper-block">
                        {{ trans('cruds.client.fields.last_name_helper') }}
                    </p>
                </div>
                <div class="form-group {{ $errors->has('company') ? 'has-error' : '' }}">
                    <label for="company">{{ trans('cruds.client.fields.company') }}</label>
                    <input type="text" id="company" name="company" class="form-control"
                           value="{{ old('company', isset($client) ? $client->company : '') }}">
                    @if($errors->has('company'))
                        <p class="help-block">
                            {{ $errors->first('company') }}
                        </p>
                    @endif
                    <p class="helper-block">
                        {{ trans('cruds.client.fields.company_helper') }}
                    </p>
                </div>
                <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                    <label for="email">{{ trans('cruds.client.fields.email') }}</label>
                    <input type="email" id="email" name="email" class="form-control"
                           value="{{ old('email', isset($client) ? $client->email : '') }}">
                    @if($errors->has('email'))
                        <p class="help-block">
                            {{ $errors->first('email') }}
                        </p>
                    @endif
                    <p class="helper-block">
                        {{ trans('cruds.client.fields.email_helper') }}
                    </p>
                </div>
                <div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
                    <label for="phone">{{ trans('cruds.client.fields.phone') }}</label>
                    <input type="text" id="phone" name="phone" class="form-control"
                           value="{{ old('phone', isset($client) ? $client->phone : '') }}">
                    @if($errors->has('phone'))
                        <p class="help-block">
                            {{ $errors->first('phone') }}
                        </p>
                    @endif
                    <p class="helper-block">
                        {{ trans('cruds.client.fields.phone_helper') }}
                    </p>
                </div>
                <div class="form-group {{ $errors->has('website') ? 'has-error' : '' }}">
                    <label for="website">{{ trans('cruds.client.fields.website') }}</label>
                    <input type="text" id="website" name="website" class="form-control"
                           value="{{ old('website', isset($client) ? $client->website : '') }}">
                    @if($errors->has('website'))
                        <p class="help-block">
                            {{ $errors->first('website') }}
                        </p>
                    @endif
                    <p class="helper-block">
                        {{ trans('cruds.client.fields.website_helper') }}
                    </p>
                </div>
                <div class="form-group {{ $errors->has('skype') ? 'has-error' : '' }}">
                    <label for="skype">{{ trans('cruds.client.fields.skype') }}</label>
                    <input type="text" id="skype" name="skype" class="form-control"
                           value="{{ old('skype', isset($client) ? $client->skype : '') }}">
                    @if($errors->has('skype'))
                        <p class="help-block">
                            {{ $errors->first('skype') }}
                        </p>
                    @endif
                    <p class="helper-block">
                        {{ trans('cruds.client.fields.skype_helper') }}
                    </p>
                </div>
                <div class="form-group {{ $errors->has('country') ? 'has-error' : '' }}">
                    <label for="country">{{ trans('cruds.client.fields.country') }}</label>
                    <input type="text" id="country" name="country" class="form-control"
                           value="{{ old('country', isset($client) ? $client->country : '') }}">
                    @if($errors->has('country'))
                        <p class="help-block">
                            {{ $errors->first('country') }}
                        </p>
                    @endif
                    <p class="helper-block">
                        {{ trans('cruds.client.fields.country_helper') }}
                    </p>
                </div>
                <div class="form-group {{ $errors->has('status_id') ? 'has-error' : '' }}">
                    <label for="status">{{ trans('cruds.client.fields.status') }}</label>
                    <select name="status_id" id="status" class="form-control select2">
                        @foreach($statuses as $id => $status)
                            <option
                                value="{{ $id }}" {{ (isset($client) && $client->status ? $client->status->id : old('status_id')) == $id ? 'selected' : '' }}>{{ $status }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('status_id'))
                        <p class="help-block">
                            {{ $errors->first('status_id') }}
                        </p>
                    @endif
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header text-center">
                                <h5>Upload Video</h5>
                            </div>

                            <div class="card-body">
                                <div id="upload-container" class="text-center">
                                    <span id="browseFile" class="btn btn-primary">Brows File</span>
                                </div>
                                <div style="display: none" class="progress mt-3" style="height: 25px">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated"
                                         role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"
                                         style="width: 75%; height: 100%">75%
                                    </div>
                                </div>
                                <input name="video_url" id="videoUrl" type="hidden">
                            </div>

                            <div class="card-footer p-4" style="display: none">
                                <video id="videoPreview" src="" controls style="width: 100%; height: auto"></video>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header text-center">
                                <h5>Upload Audio</h5>
                            </div>

                            <div class="card-body">
                                <div id="upload-container" class="text-center">
                                    <span id="browseFileAudio" class="btn btn-primary">Brows File</span>
                                </div>
                                <div style="display: none" class="progress-audio mt-3" style="height: 25px">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated"
                                         role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"
                                         style="width: 75%; height: 100%">75%
                                    </div>
                                </div>
                                <input name="audio_url" id="audioUrl" type="hidden">
                            </div>

                            <div class="card-footer-audio p-4" style="display: none">
                                <audio
                                    controls
                                    id="audioPreview"
                                    src="">
                                    Your browser does not support the
                                    <code>audio</code> element.
                                </audio>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
                </div>
            </form>

        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/resumablejs@1.1.0/resumable.min.js"></script>
    <script type="text/javascript">
        let browseFile = $('#browseFile');
        let resumable = new Resumable({
            target: '{{ route('admin.file.upload') }}',
            query: {_token: '{{ csrf_token() }}'},// CSRF token
            fileType: ['mp4'],
            chunkSize: 10 * 1024 * 1024, // default is 1*1024*1024, this should be less than your maximum limit in php.ini
            headers: {
                'Accept': 'application/json'
            },
            testChunks: false,
            throttleProgressCallbacks: 1,
        });

        if (!resumable.support) alert("Not Supported")
        resumable.assignBrowse(browseFile[0]);

        resumable.on('fileAdded', function (file) { // trigger when file picked
            showProgress();
            resumable.upload() // to actually start uploading.
        });

        resumable.on('fileProgress', function (file) { // trigger when file progress update
            updateProgress(Math.floor(file.progress() * 100));
        });

        resumable.on('fileSuccess', function (file, response) { // trigger when file upload complete
            response = JSON.parse(response)
            $('#videoUrl').val(response.path)
            $('#videoPreview').attr('src', response.path);
            $('.card-footer').show();
            hideProgress();
        });

        resumable.on('fileError', function (file, response) { // trigger when there is any error
            alert('file uploading error.')
        });


        let progress = $('.progress');

        function showProgress() {
            progress.find('.progress-bar').css('width', '0%');
            progress.find('.progress-bar').html('0%');
            progress.find('.progress-bar').removeClass('bg-success');
            progress.show();
        }

        function updateProgress(value) {
            progress.find('.progress-bar').css('width', `${value}%`)
            progress.find('.progress-bar').html(`${value}%`)
        }

        function hideProgress() {
            progress.hide();
        }
    </script>

    <script type="text/javascript">
        let browseFileAudio = $('#browseFileAudio');
        let resumableAudio = new Resumable({
            target: '{{ route('admin.file.upload') }}',
            query: {_token: '{{ csrf_token() }}'},// CSRF token
            fileType: ['mp3'],
            chunkSize: 10 * 1024 * 1024, // default is 1*1024*1024, this should be less than your maximum limit in php.ini
            headers: {
                'Accept': 'application/json'
            },
            testChunks: false,
            throttleProgressCallbacks: 1,
        });

        if (!resumableAudio.support) alert("Not Supported")
        resumableAudio.assignBrowse(browseFileAudio[0]);

        resumableAudio.on('fileAdded', function (file) { // trigger when file picked
            showProgressAudio();
            resumableAudio.upload() // to actually start uploading.
        });

        resumableAudio.on('fileProgress', function (file) { // trigger when file progress update
            updateProgressAudio(Math.floor(file.progress() * 100));
        });

        resumableAudio.on('fileSuccess', function (file, response) { // trigger when file upload complete
            response = JSON.parse(response)
            $('#audioUrl').val(response.path)
            $('#audioPreview').attr('src', response.path);
            $('.card-footer-audio').show();
            hideProgressAudio();
        });

        resumableAudio.on('fileError', function (file, response) { // trigger when there is any error
            alert('file uploading error.')
        });


        let progressAudio = $('.progress-audio');

        function showProgressAudio() {
            progressAudio.find('.progress-bar').css('width', '0%');
            progressAudio.find('.progress-bar').html('0%');
            progressAudio.find('.progress-bar').removeClass('bg-success');
            progressAudio.show();
        }

        function updateProgressAudio(value) {
            progressAudio.find('.progress-bar').css('width', `${value}%`)
            progressAudio.find('.progress-bar').html(`${value}%`)
        }

        function hideProgressAudio() {
            progressAudio.hide();
        }
    </script>
@endsection
