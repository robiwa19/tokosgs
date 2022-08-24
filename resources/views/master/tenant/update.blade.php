<form action="{{ url('/master-tenant/update/' . $tenant->id) }}" method="post">
    @csrf
    <div class="row">
        <div class="form-group col-6">
            <label>Nama Pemilik</label>
            <input type="text" name="nama_pemilik" class="form-control" value="{{ $tenant->nama_pemilik }}">
        </div>
        <div class="form-group col-6">
            <label>No Telpon Perusahaan</label>
            <input type="numeric" name="no_telp_perusahaan" class="form-control" value="{{ $tenant->no_telp_perusahaan }}">
        </div>
        <div class="form-group col-6">
            <label>Email Perusahaan</label>
            <input type="email" name="email_perusahaan" class="form-control" value="{{ $tenant->email_perusahaan }}">
        </div>
        <div class="form-group col-6">
            <label>NIK</label>
            <input type="numeric" name="nik" class="form-control" value="{{ $tenant->nik }}">
        </div>
        <div class="form-group col-6">
            <label>Nama Toko</label>
            <input type="text" name="nama_toko" class="form-control" value="{{ $tenant->nama_toko }}">
        </div>
        <div class="form-group col-6">
            <label>Alamat</label>
            <input type="text" name="alamat" class="form-control" value="{{ $tenant->alamat }}">
        </div>
        <div class="form-group col-6">
            <label>ID Provinsi</label>
            <input type="numeric" name="id_prov" class="form-control" value="{{ $tenant->id_prov }}">
        </div>
        <div class="form-group col-6">
            <label>ID Kabupaten</label>
            <input type="numeric" name="id_kab" class="form-control" value="{{ $tenant->id_kab }}">
        </div>
        <div class="form-group col-6">
            <label>ID Kecamatan</label>
            <input type="numeric" name="id_kec" class="form-control" value="{{ $tenant->id_kec }}">
        </div>
        <div class="form-group col-6">
            <label>ID Kelurahan</label>
            <input type="numeric" name="id_kel" class="form-control" value="{{ $tenant->id_kel }}">
        </div>
        <div class="form-group col-6">
            <label>Level</label>
            <input type="numeric" name="level" class="form-control" value="{{ $tenant->level }}">
        </div>
        <div class="form-group col-6">
            <label>Jenis Usaha</label>
            <input type="text" name="jenis_usaha" class="form-control" value="{{ $tenant->jenis_usaha }}">
        </div>
        <div class="form-group col-6">
            <label>Tenant Unggulan</label>
            <input type="numeric" name="tenant_unggulan" class="form-control" value="{{ $tenant->tenant_unggulan }}">
            <small class="text-muted">0 = tidak / 1 = iya</small>
        </div>
        <div class="form-group col-6">
            <label>QRIS</label>
            <input type="numeric" name="is_has_qris" class="form-control" value="{{ $tenant->is_has_qris }}">
            <small class="text-muted">0 = tidak / 1 = iya</small>
        </div>
        <div class="form-group col-6">
            <label>Generated</label>
            <input type="numeric" name="is_generated" class="form-control" value="{{ $tenant->is_generated }}">
            <small class="text-muted">0 = tidak / 1 = iya</small>
        </div>
        <div class="form-group col-6">
            <label>Instgram (Optional)</label>
            <input type="text" name="instagram" class="form-control" value="{{ $tenant->instagram ?? '' }}">
        </div>
        <div class="form-group col-6">
            <label>Whatsapp (Optional)</label>
            <input type="text" name="whatsapp" class="form-control" value="{{ $tenant->whatsapp ?? '' }}">
        </div>
        <div class="form-group col-6">
            <label>Facebook (Optional)</label>
            <input type="text" name="facebook" class="form-control"  value="{{ $tenant->facebook ?? '' }}">
        </div>
        <div class="form-group col-6">
            <label>Path Logo</label>
            <input type="text" name="path_logo" class="form-control" value="{{ $tenant->path_logo }}">
        </div>
        <div class="form-group col-4 offset-8">
            <button type="submit" class="btn btn-success btn-block">Kirim</button>
        </div>
    </div>
</form>