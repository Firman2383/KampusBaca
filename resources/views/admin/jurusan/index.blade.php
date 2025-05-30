@extends('layouts.template-admin')

@section('breadcrumb')
    <ol class="breadcrumb pull-right">
        <li class="breadcrumb-item">
            <a href="{{ route('dashboard') }}">
                <i class="fa fa-home"></i>
            </a>
        </li>
        {{--  <li class="breadcrumb-item">Dashboard</li>  --}}
        <li class="breadcrumb-item active">{{ $title }} {{ $fakultas->nama_fakultas }}</li>
    </ol>
@endsection

@section('content')
    <div class="col-sm-12">
        @if ($errors->any())
            <div class="alert alert-danger dark alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>
                            <strong>Ups !</strong>
                            {{ $error }}
                        </li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true"></span>
                </button>
            </div>
        @endif
        @if (session('success'))
            <div class="alert alert-success dark alert-dismissible fade show" role="alert">
                <strong>Yeay !</strong>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true"></span>
                </button>
            </div>
        @endif
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <h5>Data {{ $title }} {{ $fakultas->nama_fakultas }}</h5>
                    <small>Berikut adalah data {{ $title }} {{ $fakultas->nama_fakultas }} yang ada di
                        KampusBaca</small>
                </div>
                <button class="btn btn-primary" type="button" data-bs-toggle="modal"
                    data-bs-target="#tambahJurusan{{ $fakultas->id }}">
                    Tambah {{ $title }} {{ $fakultas->nama_fakultas }}
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="basic-1" class="display">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama jurusan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($jurusan as $item)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $item->nama_jurusan }}</td>
                                    <td>
                                        <button class="btn btn-primary" type="button" data-bs-toggle="modal"
                                            data-bs-target="#editJurusan{{ $item->id }}">
                                            Edit
                                        </button>
                                        <button class="btn btn-danger" type="button" data-bs-toggle="modal"
                                            data-bs-target="#hapusJurusan{{ $item->id }}">
                                            Hapus
                                        </button>
                                    </td>
                                </tr>
                                @include('admin.jurusan.modal')
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{--  Modal Tambah  --}}
    <div class="modal fade" id="tambahJurusan{{ $fakultas->id }}" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('jurusan.store', ['fakultas' => $fakultas->slug]) }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Form {{ $title }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama_jurusan" class="col-form-label">Nama Jurusan:</label>
                            <input type="text" class="form-control" Value="{{ old('nama_jurusan') }}"
                                name="nama_jurusan" id="nama_jurusan" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
