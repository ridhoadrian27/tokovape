
        <select title="kota" class="form-control" name="kota" id="data_kota">
        <option value="">-- Pilih Kota --</option>
        <?php

        // $detail = $this->db->query(" SELECT * FROM tb_pengaturanwebsite where id_pengaturanwebsite='1'");
        // $kota = $detail->row()->kota;
        $data_kota = DB::table('profiltoko')->where('id_profiltoko', '1')->first();
        $kota = $data_kota->kota;

        $datakota = json_decode($datakota);
        foreach($datakota->{'rajaongkir'}->{'results'} as $key0 => $value0) {
            $city_id = $value0->{'city_id'};
            $city_name = $value0->{'city_name'};
            $type = $value0->{'type'};
        ?>
        <option value="<?php echo  $city_id; ?>" <?php echo $kota==$city_id?"selected":"";?>>
        <?php
        if($type=="Kabupaten"){
            $type="Kab";
        }else{
            $type="";
        }
        echo $type." ".$city_name;
        ?>
            </option>
        <?php
        }
        ?>
        </select>
