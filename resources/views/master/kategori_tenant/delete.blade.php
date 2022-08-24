<form action="{{ url('/master-kategori-tenant/delete/' . $kategori_tenant->id) }}" method="post">
    @csrf
    <div class="row">
        <div class="form-group col-12">
            <label>Apakah Anda yakin ingin menghapus data Master Kategori Tenant dengan ID #{{ $kategori_tenant->id }}</label>
        </div>
        <div class="col-4 offset-8">
            <button type="submit" class="btn btn-danger btn-block">Hapus</button>
        </div>
    </div>
</form>