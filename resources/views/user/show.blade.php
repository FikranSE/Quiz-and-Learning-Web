@extends('layouts.app')

@section('content')
    <style>
        .video-container {
            background-color: #f8f9fa;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .video-header {
            background-color: #007bff;
            color: white;
            padding: 20px;
            border-radius: 8px 8px 0 0;
        }

        .video-header h1 {
            margin: 0;
            font-size: 24px;
        }

        .video-list {
            padding: 20px;
        }

        .video-item {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12);
            margin-bottom: 20px;
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        .video-item:hover {
            transform: translateY(-5px);
        }

        .video-content {
            display: flex;
            padding: 15px;
            height: 300px;
            /* Set a fixed height */
        }

        .video-half {
            flex: 1;
            width: 50%;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .video-thumbnail {
            width: 100%;
            height: 100%;
            border-radius: 4px;
            overflow: hidden;
        }

        .video-thumbnail video {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .video-details {
            padding-left: 20px;
            overflow-y: auto;
            /* Allow scrolling if content is too long */
        }

        .video-title {
            margin-top: 0;
        }

        .video-meta {
            margin-top: auto;
            /* Push to bottom */
        }

        .video-actions {
            display: flex;
            justify-content: flex-end;
            padding: 10px 15px;
            background-color: #f1f3f5;
        }

        .video-actions .btn {
            padding: 8px 12px;
            font-size: 14px;
            margin-left: 10px;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-info {
            background-color: #17a2b8;
            border-color: #17a2b8;
        }

        .btn-warning {
            background-color: #ffc107;
            border-color: #ffc107;
            color: #212529;
        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .empty-state {
            text-align: center;
            padding: 40px 20px;
            color: #6c757d;
        }
    </style>

    <div class="container container-fluid">
        <div class="video-container">
            <div class="video-header d-flex justify-content-between align-items-center">
                <h1>{{ __('All Videos') }}</h1>
                @if (Auth::user()->name === 'admin')
                    <a href="{{ route('videos.create') }}" class="btn btn-light">
                        <i class="fa fa-plus mr-2"></i>{{ __('New Video') }}
                    </a>
                @endif
            </div>
            <div class="video-list">
                @forelse($video as $video)
                    <div class="video-item">
                        <div class="video-content">
                            <div class="video-half">
                                <div class="video-thumbnail">
                                    <video controls>
                                        <source src="{{ asset('storage/' . $video->path) }}" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                </div>
                            </div>
                            <div class="video-half">
                                <div class="video-details">
                                    <h2 class="video-title">{{ $video->title }}</h2>
                                    <div>{{ $video->description }}</div>
                                    <div class="video-meta">
                                        <div><strong>{{ __('Publish:') }}</strong>
                                            {{ $video->created_at->format('Y-m-d H:i:s') }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="video-actions">
                            @if (Auth::user()->name === 'admin')
                                <a href="{{ route('videos.edit', $video->id) }}" class="btn btn-warning" title="Edit">
                                    <i class="fa fa-edit mr-1"></i>Edit
                                </a>
                                <form action="{{ route('videos.delete', $video->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" title="Delete"
                                        onclick="return confirm('Are you sure you want to delete this video?')">
                                        <i class="fa fa-trash mr-1"></i>Delete
                                    </button>
                                </form>
                            @endif
                        </div>

                    </div>
                @empty
                    <div class="empty-state">
                        <i class="fa fa-film fa-3x mb-3"></i>
                        <h3>{{ __('No Videos Found') }}</h3>
                        <p>Start by adding some videos to your collection.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
