<form action="{{ url('/master-slider/delete/' . $slider->id) }}" method="post">
    @csrf
    <div class="row">
        <div class="form-group col-12">
            <label>Apakah Anda yakin ingin menghapus data Master Slider dengan ID #{{ $slider->id }}</label>
        </div>
        <div class="col-4 offset-8">
            <button type="submit" class="btn btn-danger btn-block">Hapus</button>
        </div>
    </div>
</form>