<form action="{{ url('/master-produk-tenant/update/' . $produk_tenant->id) }}" method="post">
    @csrf
    <div class="row">
        <div class="form-group col-6">
            <label>Tenant</label>
            <select name="id_tenant" class="form-control select2">
                @foreach ($tenants as $tenant)
                <option value="{{ $tenant->id }}" {{ $tenant->id == $produk_tenant->id_tenant ? 'selected' : '' }}>{{ $tenant->nama_pemilik }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-6">
            <label>Nama Produk</label>
            <input type="text" name="nama_produk" class="form-control" value="{{ $produk_tenant->nama_produk }}">
        </div>
        <div class="form-group col-12">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control" rows="5">{{ $produk_tenant->deskripsi }}</textarea>
        </div>
        <div class="form-group col-6">
            <label>Harga</label>
            <input type="numeric" name="harga" class="form-control" value="{{ $produk_tenant->harga }}">
        </div>
        <div class="forn-group col-6">
            <label>Gambar (Optional)</label>
            <input type="file" name="image" class="form-control">
        </div>
        <div class="form-group col-4 offset-8">
            <button type="submit" class="btn btn-success btn-block">Kirim</button>
        </div>
    </div>
</form>

<script>
    $('.select2').select2();
</script>