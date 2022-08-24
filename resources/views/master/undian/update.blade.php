<form action="{{ url('/master-undian/update/' . $undian->id) }}" method="post">
    @csrf
    <div class="row">
        <div class="form-group col-6">
            <label>Tahun</label>
            <input type="text" name="tahun" class="form-control" value="{{ $undian->tahun }}">
        </div>
        <div class="form-group col-6">
            <label>ID Peringkat</label>
            <input type="numeric" name="id_peringkat" class="form-control" value="{{ $undian->id_peringkat }}">
        </div>
        <div class="form-group col-6">
            <label>Keterangan Hadiah</label>
            <input type="text" name="keterangan_hadiah" class="form-control" value="{{ $undian->keterangan_hadiah }}">
        </div>
        <div class="form-group col-6">
            <label>Jumlah</label>
            <input type="numeric" name="jumlah" class="form-control" value="{{ $undian->jumlah }}">
        </div>
        <div class="form-group col-6">
            <label>Generated</label>
            <input type="numeric" name="is_generated" class="form-control" value="{{ $undian->is_generated }}">
            <small class="text-muted">0 = tidak / 1 = iya</small>
        </div>
        <div class="form-group col-6">
            <label>Generated View</label>
            <input type="numeric" name="is_generated_view" class="form-control" value="{{ $undian->is_generated_view }}">
            <small class="text-muted">0 = tidak / 1 = iya</small>
        </div>
        <div class="form-group col-4 offset-8">
            <button type="submit" class="btn btn-success btn-block">Kirim</button>
        </div>
    </div>
</form>