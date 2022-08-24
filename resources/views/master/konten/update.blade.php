<form action="{{ url('/master-konten/update/' . $konten->id) }}" method="post">
    @csrf
    <div class="row">
        <div class="form-group col-6">
            <label>Tipe</label>
            <select name="code" class="form-control" readonly>
                @foreach (App\Models\Konten::getCodes() as $key => $value)
                <option value="{{ $key }}" {{ $konten->code == $key ? 'selected' : '' }}>{!! $value !!}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-12">
            <textarea name="data" id="summernote">{!! $konten->data !!}</textarea>
        </div>
        <div class="form-group col-4 offset-8">
            <button type="submit" class="btn btn-success btn-block">Kirim</button>
        </div>
    </div>
</form>

<script>
    $('#summernote').summernote();
</script>