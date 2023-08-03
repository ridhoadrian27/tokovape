<style>
table {
  font-family: arial, sans-serif;
  width: 100%;
}

td, th {
  text-align: left;
}

</style>
<?php
  $profiltoko = DB::table('profiltoko')->where('id_profiltoko', '1')->first();
?>
<table style="width:100%;">
    <tr>
      <td style="width:50%; padding: 10px;">
        <table>
          <tr>
            <td style="font-size: 13px;"><b>{{ $profiltoko->nama }}</b></td>
          </tr>
        </table>
      </td>
      <td style="width:50%; vertical-align: text-bottom; padding: 10px;">
        <table>
          <tr>
            <td style="font-size: 13px; text-align: right;">

            </td>
          </tr>
        </table>
      </td>
    </tr>
</table>
<table style="width:100%;">
    <tr>
      <td style="width:50%; padding: 10px;">
        <table>
          <tr>
            <td style="font-size: 13px;">{{ $profiltoko->alamat }}</td>
          </tr>
          <tr><td style="font-size: 13px;">Telp: {{ $profiltoko->telepon }}</td></tr>
          <tr><td style="font-size: 13px;">Email: {{ $profiltoko->email }}</td></tr>
        </table>
      </td>
      <td style="width:50%; vertical-align: text-bottom; padding: 10px;">
        <?php $datainvoice = DB::table('invoice')->where('no_invoice', $no_invoice)->first(); ?>
        <table>
          <tr>
            <td style="font-size: 13px;">INVOICE#</td><td style="font-size: 12px;">: {{ $datainvoice->no_invoice }}</td>
          </tr>
          <tr>
            <?php $tanggal = $datainvoice->tanggal;?>
            <td style="font-size: 13px;">TANGGAL</td><td style="font-size: 12px;">: <?php echo date('d', strtotime($tanggal)); ?> <?php echo date('M', strtotime($tanggal)); ?> <?php echo date('Y', strtotime($tanggal)); ?></td>
          </tr>
          <tr>
            <td style="font-size: 13px;">PEMBAYARAN</td><td style="font-size: 12px;">: {{ $datainvoice->metode_pembayaran=='1' ? "manual" : "otomatis" }}</td>
          </tr>
          <tr>
            <td style="font-size: 13px;">STATUS</td><td style="font-size: 12px;">: {{ $datainvoice->status=='0' ? "belum lunas" : "lunas" }}</td>
          </tr>
        </table>
      </td>
    </tr>
</table>
<table style="width:100%; margin-top: 20px; margin-bottom: 20px;">
  <tr>
    <td style="width: 45%;"><hr></td>
    <td style="text-align: center;"><b>INVOICE</b></td>
    <td style="width: 45%;"><hr></td>
  </tr>
</table>
<?php
  $datapemesanan = DB::table('pemesanan')->where('no_pemesanan', $no_pemesanan)->first();
  $kode_member = $datapemesanan->pelanggan;
  $kurir = $datapemesanan->provider_ongkir;
  $paket = $datapemesanan->service_ongkir;
  $biaya = $datapemesanan->cost_ongkir;
  $total = $datapemesanan->grandtotal;

  $datamember = DB::table('member')->where('kode_member', $kode_member)->first();
  $namapen = $datamember->name;
  $emailpen = $datamember->email;
  $teleponpen = $datamember->telepon;

  $dataalamat = DB::table('alamat')->where('kode_member', $kode_member)->first();
  $detailalamat = $dataalamat->detail;
?>
<table style="width:100%;">
    <tr>
      <td style="width:50%; border: solid black 1px; padding: 10px; margin: 10px;">
        <table>
          <tr>
            <td style="font-size: 13px;">NAMA</td><td>: {{ $namapen }}</td>
          </tr>
          <tr>
            <td style="font-size: 13px;">ALAMAT</td>
            <td>: {{ $detailalamat }}</td>
          </tr>
          <tr>
            <td style="font-size: 13px;">TELEPON</td>
            <td>: {{ $teleponpen }}</td>
          </tr>
        </table>
      </td>
      <td style="width:50%; border: solid black 1px; vertical-align: text-bottom; padding: 10px; margin: 10px;">
        <table>
          <tr>
            <td style="font-size: 13px;">JATUH TEMPO</td><td style="font-size: 12px;">: {{ $datainvoice->jatuh_tempo }}</td>
          </tr>
        </table>
      </td>
    </tr>
</table>
<table style="width:100%; border: solid black 1px; margin-top: 20px; border-collapse: collapse;">
    <tr>
      <th style="width: 2%; border: solid black 1px; padding: 5px;">NO</td>
      <th style="width: 30%; border: solid black 1px; padding: 5px;">PRODUK</td>
      <th style="width: 10%; border: solid black 1px; padding: 5px;">HARGA SATUAN (Rp.)</td>
      <th style="width: 20%; border: solid black 1px; padding: 5px;">QTY</td>
      <th style="width: 18%; border: solid black 1px; padding: 5px;">JUMLAH (Rp.)</td>
    </tr>

    <?php
    $no = 1;
    $getdetail = DB::table('detailpemesanan')->where('no_pemesanan', $no_pemesanan)->get();
    ?>
    @foreach ($getdetail as $result)
      <?php
        $kode_produk = $result->kode_produk;
        $product = DB::table('produk')->where('kode_produk', $kode_produk)->first();
        $kode_produk = $product->kode_produk;
        $nama_produk = $product->nama;
        $harga = $product->harga;
        $berat = $product->berat;
        $gambar1 = $product->gambar1;
       ?>
    <tr>
      <td style="border: solid black 1px; padding: 5px;">{{ $no }}</td>
      <td style="border: solid black 1px; padding: 5px;">
        <?php echo $nama_produk;?>
        </td>
      <td style="border: solid black 1px; padding: 5px;">Rp<?php echo number_format($harga); ?></td>
      <td style="border: solid black 1px; padding: 5px;"><?php echo number_format($result->jumlah);?></td>
      <td style="border: solid black 1px; padding: 5px;">Rp<?php echo number_format($result->total); ?></td>
    </tr>
   <?php $no++;?>
   @endforeach
    <tr>
      <td style="border: solid black 1px; padding: 5px; border-left-color: white; border-bottom-color: white;" colspan="3"></td>
      <td style="border: solid black 1px; padding: 5px;">ONGKIR (<?php echo $kurir." ".$paket;?>)</td>
      <td style="border: solid black 1px; padding: 5px;">Rp<?php echo number_format($biaya); ?></td>
    </tr>
    <tr>
      <td style="border: solid black 1px; padding: 5px; border-left-color: white; border-bottom-color: white;" colspan="3"></td>
      <td style="border: solid black 1px; padding: 5px;">TOTAL</td>
      <td style="border: solid black 1px; padding: 5px;">Rp {{ number_format($total) }}</td>
    </tr>
</table>
<table style="width:100%; margin-top: 20px; margin-bottom: 20px;">
  <tr>
    <td style="width: 40%;"><hr></td>
    <td style="text-align: center;"><b>REKENING KAMI</b></td>
    <td style="width: 40%;"><hr></td>
  </tr>
</table>
<table style="width:100%; border: solid black 1px; margin-top: 20px; border-collapse: collapse;">
    <tr>
      <th style="width: 2%; border: solid black 1px; padding: 5px;">NO</td>
      <th style="width: 30%; border: solid black 1px; padding: 5px;">BANK</td>
      <th style="width: 10%; border: solid black 1px; padding: 5px;">REKENING</td>
      <th style="width: 20%; border: solid black 1px; padding: 5px;">ATAS NAMA</td>
    </tr>

    <?php
    $no = 1;
    $getrekening = DB::table('rekening')->get();
    ?>
    @foreach ($getrekening as $result)
      <?php
        $bank = $result->bank;
        $databank = DB::table('bank')->where('id_bank', $bank)->first();
        $nama_bank = $databank->nama_bank;
       ?>
    <tr>
      <td style="border: solid black 1px; padding: 5px;">{{ $no }}</td>
      <td style="border: solid black 1px; padding: 5px;"><?php echo $nama_bank;?></td>
      <td style="border: solid black 1px; padding: 5px;"><?php echo $result->rekening; ?></td>
      <td style="border: solid black 1px; padding: 5px;"><?php echo $result->atasnama;?></td>
    </tr>
   <?php $no++;?>
   @endforeach
</table>
