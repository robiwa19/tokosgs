<form action="{{ url('/master-tenant/delete/' . $tenant->id) }}" method="post">
    @csrf
    <div class="row">
        <div class="form-group col-12">
            <label>Apakah Anda yakin ingin menghapus data Master Tenant dengan ID #{{ $tenant->id }}</label>
        </div>
        <div class="col-4 offset-8">
            <button type="submit" class="btn btn-danger btn-block">Hapus</button>
        </div>
    </div>
</form>