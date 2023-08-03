<?php
  $detail_alamat = DB::table('alamat')->where('id_alamat', $id_alamat)->first();
  //$detail_alamat = $this->db->query("select * from tb_alamat where id_alamat='$alamatalternatif'");
  $detail = $detail_alamat->detail;
  $propinsi = $detail_alamat->propinsi;
  $kota = $detail_alamat->kota;
?>
{{-- <textarea name="alamatalter" id="alamatalter" cols="60" rows="2" class="form-control" disabled placeholder="Alamat Alternatif">{{ $detail }}</textarea><br> --}}
<p>{{ $detail }}</p>
<input type="text" name="data_propinsi" id="data_propinsi" value="{{ $propinsi }}" style="display:none;" hidden/>
<input type="text" name="data_kota" id="data_kota" value="{{ $kota }}" style="display:none;" hidden/>
