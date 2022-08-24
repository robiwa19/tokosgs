<form action="{{ url('/master-testimoni/update/' . $testimoni->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="form-group col-6">
            <label>Nama</label>
            <input type="text" name="name" class="form-control" value="{{ $testimoni->name }}">
        </div>
        <div class="form-group col-6">
            <label>Gambar ( Optional 60x60 )</label>
            <input type="file" name="profile" class="form-control">
        </div>
        <div class="form-group col-12">
            <label>Data</label>
            <textarea name="data" class="form-control" rows="5">{{ $testimoni->data }}</textarea>
        </div>
        <div class="form-group col-4 offset-8">
            <button type="submit" class="btn btn-success btn-block">Kirim</button>
        </div>
    </div>
</form>