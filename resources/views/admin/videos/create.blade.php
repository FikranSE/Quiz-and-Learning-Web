@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <div class="d-sm-flex align-items-center justify-content-between">
                <h1 class="h3 mb-0">{{ __('Create Video') }}</h1>
                <a href="{{ route('videos.index') }}" class="btn btn-light btn-sm">
                    <i class="fas fa-arrow-left mr-2"></i>{{ __('Go Back') }}
                </a>
            </div>
        </div>
        <div class="card-body">
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('videos.store') }}" method="POST" enctype="multipart/form-data" id="videoUploadForm">
                @csrf

                <div class="form-group">
                    <label for="title">{{ __('Title') }}</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" required>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="video_file">{{ __('Video File') }} (MP4, MOV, AVI, max 100MB)</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input @error('video_file') is-invalid @enderror" id="video_file" name="video_file" accept="video/mp4,video/quicktime,video/x-msvideo" required>
                        <label class="custom-file-label" for="video_file">Choose file</label>
                    </div>
                    @error('video_file')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                    <div id="fileSize" class="mt-2"></div>
                </div>

                <div class="form-group">
                    <label for="description">{{ __('Description') }}</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary btn-block" id="submitBtn">
                    <i class="fas fa-save mr-2"></i>{{ __('Save Video') }}
                </button>
            </form>
        </div>
    </div>
</div>

<script>
document.getElementById('video_file').addEventListener('change', function(e) {
    const file = e.target.files[0];
    const fileSizeElement = document.getElementById('fileSize');
    const submitBtn = document.getElementById('submitBtn');
    
    if (file) {
        const fileSizeMB = file.size / (1024 * 1024);
        fileSizeElement.textContent = `File size: ${fileSizeMB.toFixed(2)} MB`;
        
        if (fileSizeMB > 100) {
            fileSizeElement.style.color = 'red';
            submitBtn.disabled = true;
            alert('File size exceeds 100MB limit. Please choose a smaller file.');
        } else {
            fileSizeElement.style.color = 'green';
            submitBtn.disabled = false;
        }
    } else {
        fileSizeElement.textContent = '';
        submitBtn.disabled = false;
    }
});

document.getElementById('videoUploadForm').addEventListener('submit', function(e) {
    const submitBtn = document.getElementById('submitBtn');
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Uploading...';
});
</script>

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
