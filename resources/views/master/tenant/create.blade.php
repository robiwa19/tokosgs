<form action="{{ url('/master-tenant/create') }}" method="post">
    @csrf
    <div class="row">
        <div class="form-group col-6">
            <label>Nama Pemilik</label>
            <input type="text" name="nama_pemilik" class="form-control">
        </div>
        <div class="form-group col-6">
            <label>No Telpon Perusahaan</label>
            <input type="numeric" name="no_telp_perusahaan" class="form-control">
        </div>
        <div class="form-group col-6">
            <label>Email Perusahaan</label>
            <input type="email" name="email_perusahaan" class="form-control">
        </div>
        <div class="form-group col-6">
            <label>NIK</label>
            <input type="numeric" name="nik" class="form-control">
        </div>
        <div class="form-group col-6">
            <label>Nama Toko</label>
            <input type="text" name="nama_toko" class="form-control">
        </div>
        <div class="form-group col-6">
            <label>Alamat</label>
            <input type="text" name="alamat" class="form-control">
        </div>
        <div class="form-group col-6">
            <label>ID Provinsi</label>
            <input type="numeric" name="id_prov" class="form-control">
        </div>
        <div class="form-group col-6">
            <label>ID Kabupaten</label>
            <input type="numeric" name="id_kab" class="form-control">
        </div>
        <div class="form-group col-6">
            <label>ID Kecamatan</label>
            <input type="numeric" name="id_kec" class="form-control">
        </div>
        <div class="form-group col-6">
            <label>ID Kelurahan</label>
            <input type="numeric" name="id_kel" class="form-control">
        </div>
        <div class="form-group col-6">
            <label>Level</label>
            <input type="numeric" name="level" class="form-control">
        </div>
        <div class="form-group col-6">
            <label>Jenis Usaha</label>
            <input type="text" name="jenis_usaha" class="form-control">
        </div>
        <div class="form-group col-6">
            <label>Tenant Unggulan</label>
            <input type="numeric" name="tenant_unggulan" class="form-control">
            <small class="text-muted">0 = tidak / 1 = iya</small>
        </div>
        <div class="form-group col-6">
            <label>QRIS</label>
            <input type="numeric" name="is_has_qris" class="form-control">
            <small class="text-muted">0 = tidak / 1 = iya</small>
        </div>
        <div class="form-group col-6">
            <label>Generated</label>
            <input type="numeric" name="is_generated" class="form-control">
            <small class="text-muted">0 = tidak / 1 = iya</small>
        </div>
        <div class="form-group col-6">
            <label>Instgram (Optional)</label>
            <input type="text" name="instagram" class="form-control">
        </div>
        <div class="form-group col-6">
            <label>Whatsapp (Optional)</label>
            <input type="text" name="whatsapp" class="form-control">
        </div>
        <div class="form-group col-6">
            <label>Facebook (Optional)</label>
            <input type="text" name="facebook" class="form-control">
        </div>
        <div class="form-group col-6">
            <label>Path Logo</label>
            <input type="text" name="path_logo" class="form-control">
        </div>
        <div class="form-group col-4 offset-8">
            <button type="submit" class="btn btn-success btn-block">Kirim</button>
        </div>
    </div>
</form>