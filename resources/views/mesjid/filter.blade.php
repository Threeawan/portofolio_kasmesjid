<div class="tile">
    <h6>Filter Data Pengeluaran</h6>
    <br>
    <div class="tile-body">
      <form action="{{ route('mesjid.laporan') }}" method="GET" class="row">
        
        <div class="mb-3 col-md-3">
          <label class="form-label">Kategori</label>
          <select name="kategori" class="form-control" id="kategori">
            <option value="-Pilih-">-Pilih-</option>
            <option value="Infaq">Infaq</option>
            <option value="Sedekah">Sedekah</option>
            <option value="Zakat">Zakat</option>
            <option value="Pembayaran Air">Pembayaran Air</option>
            <option value="Pembayaran Listrik">Pembayaran Listrik</option>
            <option value="Pembelian Barang">Pembelian Barang</option>
            <option value="Lainnya">Lainnya</option>
          </select>
        </div>
        <div class="mb-3 col-md-3">
          <label class="form-label">Tanggal Awal</label>
          <input class="form-control" type="date" name="tanggal_awal" id="tanggal_awal" value="{{ old('tanggal_awal') }}" required>
        </div>
        <div class="mb-3 col-md-3">
          <label class="form-label">Tanggal Akhir</label>
          <input class="form-control" type="date" name="tanggal_akhir" id="tanggal_akhir" value="{{ old('tanggal_akhir') }}" required>
        </div>
        <div class="mb-3 col-md-4 align-self-end">
          <button class="btn btn-primary" type="submit">
            <i class="bi bi-receipt me-2"></i>Tampilkan
          </button>
        </div>
      </form>
      
    </div>
  </div>