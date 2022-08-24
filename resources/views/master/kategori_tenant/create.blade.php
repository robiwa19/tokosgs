<form action="{{ url('/master-kategori-tenant/create') }}" method="post">
    @csrf
    <div class="row">
        <div class="form-group col-12">
            <label>Induk Kategori (Optional)</label>
            <select name="id_tenant" class="form-control select2">
                <option value=""></option>
                @foreach ($induk_kategori as $ikategori)
                <option value="{{ $ikategori->id }}">{{ $ikategori->nama_kategori }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-6">
            <label>Nama Kategori</label>
            <input type="text" name="nama_kategori" class="form-control">
        </div>
        <div class="form-group col-6">
            <label>Icon (Optional)</label>
            <input type="text" name="icon" class="form-control">
            <small class="text-muted">
                *<a href="https://themify.me/themify-icons">Klik Disini</a> untuk melihat daftar icon<br />
                Contoh: <b>ti-user</b>
            </small>
        </div>
        <div class="form-group col-4 offset-8">
            <button type="submit" class="btn btn-success btn-block">Kirim</button>
        </div>
    </div>
</form>

<script>
    $('.select2').select2();
</script>