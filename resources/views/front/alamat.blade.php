<?php
  $detail_alamat = DB::table('alamat')->where('id_alamat', $id_alamat)->first();
  //$detail_alamat = $this->db->query("select * from tb_alamat where id_alamat='$alamatalternatif'");
  $detail = $detail_alamat->detail;
  $propinsi = $detail_alamat->propinsi;
  $kota = $detail_alamat->kota;
?>
<div id="row_alamat">
<br>
<textarea name="alamatalter" id="alamatalter" cols="60" rows="2" class="form-control" disabled placeholder="Alamat Alternatif">{{ $detail }}</textarea><br>
<input type="text" name="data_propinsi" id="data_propinsi" value="{{ $propinsi }}" hidden/>
<input type="text" name="data_kota" id="data_kota" value="{{ $kota }}" hidden/>
</div>
