
        <select title="kota" class="form-control" name="kota" id="data_kota">
        <option value="">-- Pilih Kota --</option>
        <?php

        $datakota = json_decode($datakota);
        foreach($datakota->{'rajaongkir'}->{'results'} as $key0 => $value0) {
            $city_id = $value0->{'city_id'};
            $city_name = $value0->{'city_name'};
            $type = $value0->{'type'};
        ?>
        <option value="<?php echo  $city_id; ?>">
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
