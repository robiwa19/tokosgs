<form action="{{ url('/master-config/create') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="form-group col-6">
            <label>Tahun</label>
            <input type="text" name="tahun" class="form-control">
        </div>
        <div class="form-group col-6">
            <label>Default</label>
            <input type="numeric" name="is_default" class="form-control">
            <small class="text-muted">0 = tidak / 1 = iya</small>
        </div>
        <div class="form-group col-6">
            <label>Tanggal Awal</label>
            <input type="datetime-local" name="tgl_awal" class="form-control">
        </div>
        <div class="form-group col-6">
            <label>Tanggal Akhir</label>
            <input type="datetime-local" name="tgl_akhir" class="form-control">
        </div>
        <div class="form-group col-6">
            <label>Maksimal Hari</label>
            <input type="numeric" name="maksimal_hari" class="form-control">
        </div>
        <div class="form-group col-6">
            <label>Harga/Poin</label>
            <input type="numeric" name="harga_per_poin" class="form-control">
        </div>
        <div class="form-group col-6">
            <label>Kepolisian</label>
            <input type="text" name="kepolisian" class="form-control">
        </div>
        <div class="form-group col-6">
            <label>Dinas Sosial</label>
            <input type="text" name="dinas_sosial" class="form-control">
        </div>
        <div class="form-group col-6">
            <label>Notaris</label>
            <input type="text" name="notaris" class="form-control">
        </div>
        <div class="form-group col-6">
            <label>Ketua Panitia</label>
            <input type="text" name="ketua_panitia" class="form-control">
        </div>
        <div class="form-group col-6">
            <label>Telepon</label>
            <input type="number" name="telepon" class="form-control">
        </div>
        <div class="form-group col-6">
            <label>Email</label>
            <input type="email" name="email" class="form-control">
        </div>
        <div class="form-group col-6">
            <label>Alamat</label>
            <input type="text" name="alamat" class="form-control">
        </div>
        <div class="form-group col-6">
            <label>Gambar ( 182x47 )</label>
            <input type="file" name="logo" class="form-control">
        </div>
        <div class="form-group col-4 offset-8">
            <button type="submit" class="btn btn-success btn-block">Kirim</button>
        </div>
    </div>
</form>