
{{--  Modal Edit  --}}
<div class="modal fade" id="editJurusan{{ $item->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('jurusan.update', ['fakultas' => $fakultas->slug, 'jurusan' => $item->slug]) }}"
                method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Form {{ $title }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('jurusan.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="nama_jurusan" class="col-form-label">Nama Jurusan:</label>
                            <input type="text" class="form-control" Value="{{ $item->nama_jurusan }}"
                                name="nama_jurusan" id="nama_jurusan" required>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{--  Modal Hapus  --}}
<div class="modal fade" id="hapusJurusan{{ $item->id }}" tabindex="-1"
    aria-labelledby="hapusjurusanLabel{{ $item->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="hapusjurusanLabel{{ $item->id }}">Konfirmasi Hapus jurusan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus
                <strong>{{ $item->nama_jurusan }}</strong>
                pada {{ $fakultas->nama_fakultas }}?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <a href="{{ route('jurusan.destroy', ['fakultas' => $fakultas->slug, 'jurusan' => $item->slug]) }}"
                    class="btn btn-danger">Ya, Hapus</a>
            </div>
        </div>
    </div>
</div>
