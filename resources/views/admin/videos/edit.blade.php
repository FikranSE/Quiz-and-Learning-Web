@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <div class="d-sm-flex align-items-center justify-content-between">
                    <h1 class="h3 mb-0">{{ __('Edit Video') }}</h1>
                    <a href="{{ route('videos.index') }}" class="btn btn-light btn-sm">
                        <i class="fas fa-arrow-left mr-2"></i>{{ __('Go Back') }}
                    </a>
                </div>
            </div>
            <div class="card-body">
                  @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('videos.update', $video->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="title">{{ __('Title') }}</label>
                        <input type="text" class="form-control" id="title" name="title"
                            value="{{ old('title', $video->title) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="video_file">{{ __('Video File') }}</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="video_file" name="video_file"
                                accept="video/*">
                            <label class="custom-file-label"
                                for="video_file">{{ $video->original_name ?: 'Choose file' }}</label>
                        </div>
                        <small class="form-text text-muted">Current file: {{ $video->original_name }}</small>
                    </div>

                    <div class="form-group">
                        <label for="description">{{ __('Description') }}</label>
                        <textarea class="form-control" id="description" name="description" rows="4">{{ old('description', $video->description) }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">
                        <i class="fas fa-save mr-2"></i>{{ __('Update Video') }}
                    </button>
                </form>
            </div>
        </div>
    </div>

    @push('styles')
        <style>
            .card {
                border: none;
                box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
            }

            .card-header {
                padding: 1.5rem;
            }

            .form-group label {
                font-weight: 600;
            }

            .custom-file-label::after {
                content: "Browse";
            }
        </style>
    @endpush

    @push('scripts')
        <script>
            // Update custom file input labels with selected file name
            $('.custom-file-input').on('change', function() {
                let fileName = $(this).val().split('\\').pop();
                $(this).next('.custom-file-label').addClass("selected").html(fileName);
            });
        </script>
    @endpush

@endsection
