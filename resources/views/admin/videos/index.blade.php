@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <!-- Content Row -->
        <div class="card">
            <div class="card-header py-3 d-flex">
                <h6 class="m-0 font-weight-bold text-primary">
                    {{ __('Videos') }}
                </h6>
                <div class="ml-auto">
                    <a href="{{ route('videos.create') }}" class="btn btn-primary">
                        <span class="icon text-white-50">
                            <i class="fa fa-plus"></i>
                        </span>
                        <span class="text">{{ __('New Video') }}</span>
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover datatable datatable-Video" cellspacing="0"
                        width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Title</th>
                                <th>Original Name</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($videos as $video)
                                <tr data-entry-id="{{ $video->id }}">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $video->title }}</td>
                                    <td>{{ $video->original_name }}</td>

                                    <td>{{ Str::limit($video->description, 50) }}</td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <a href="{{ route('videos.show') }}"
                                                class="btn btn-primary d-flex justify-content-center align-items-center">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <a href="{{ route('videos.edit', $video->id) }}"
                                                class="btn btn-info d-flex justify-content-center align-items-center">
                                                <i class="fa fa-pencil-alt"></i>
                                            </a>

                                            <form action="{{ route('videos.delete', $video->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"
                                                    style="border-top-left-radius: 0;border-bottom-left-radius: 0;"
                                                    onclick="return confirm('Are you sure you want to delete this video?')">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">{{ __('No Videos Found') }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Content Row -->

        <!-- Content Row -->
        <div class="card mt-3">
            <div class="card-header py-3 d-flex">
                <h6 class="m-0 font-weight-bold text-primary">
                    {{ __('Illustrasi & Tujuan pembelajaran') }}
                </h6>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <div class="table-responsive">
                    <form action="{{ route('ilustrasi.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="illustration">{{ __('Background Illustration') }} (PNG only)</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input @error('ilustrasi') is-invalid @enderror"
                                    id="illustration" name="ilustrasi" accept="image/png">
                                <label class="custom-file-label" for="illustration">Choose file</label>
                            </div>
                            @error('ilustrasi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            <!-- Display the existing illustration if available -->
                            @if ($ilustrasi->ilustrasi)
                                <small class="form-text text-muted">Current Illustration:
                                    {{ $ilustrasi->ilustrasi }}</small>
                                <img src="{{ asset('storage/illustrations/' . $ilustrasi->ilustrasi) }}"
                                    class="img-thumbnail mt-2" width="150" />
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="tujuan_pbl">{{ __('Tujuan Pembelajaran') }}</label>
                            <textarea class="form-control @error('tujuan_pbl') is-invalid @enderror" id="tujuan_pbl" name="tujuan_pbl"
                                rows="4">{{ old('tujuan_pbl', $ilustrasi->tujuan_pbl) }}</textarea>
                            @error('tujuan_pbl')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary btn-block" id="submitBtn">
                            <i class="fas fa-save mr-2"></i>{{ __('Save Changes') }}
                        </button>
                    </form>

                </div>
            </div>
        </div>
        <!-- Content Row -->
    </div>
@endsection
