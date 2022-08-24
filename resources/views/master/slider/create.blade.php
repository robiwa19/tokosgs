<form action="{{ url('/master-slider/create') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="form-group col-6">
            <label>Judul</label>
            <input type="text" name="title" class="form-control">
        </div>
        <div class="form-group col-6">
            <label>Catatan</label>
            <input type="text" name="note" class="form-control">
        </div>
        <div class="form-group col-6">
            <label>Gambar ( 825x500 )</label>
            <input type="file" name="image" class="form-control">
        </div>
        <div class="form-group col-4 offset-8">
            <button type="submit" class="btn btn-success btn-block">Kirim</button>
        </div>
    </div>
</form>