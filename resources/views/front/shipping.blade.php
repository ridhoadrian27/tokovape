<select name="jenis_kurir" id="jenis_kurir" class="form-control">
<option value='0'>-- Pilih Pengiriman --</option>
<?php
//$datajne=$this->db->query("select * from tb_detailongkir where detailongkir='jne'");
$datajne = DB::table('detailongkir')->where('detailongkir', 'jne')->first();
$tampiljne=$datajne->tampilkan;

//$datatiki=$this->db->query("select * from tb_detailongkir where detailongkir='tiki'");
$datatiki = DB::table('detailongkir')->where('detailongkir', 'tiki')->first();
$tampiltiki=$datatiki->tampilkan;

//$datapos=$this->db->query("select * from tb_detailongkir where detailongkir='pos'");
$datapos = DB::table('detailongkir')->where('detailongkir', 'pos')->first();
$tampilpos=$datapos->tampilkan;

//$datajnt=$this->db->query("select * from tb_detailongkir where detailongkir='jnt'");
$datajnt = DB::table('detailongkir')->where('detailongkir', 'jnt')->first();
$tampiljnt=$datajnt->tampilkan;

$datacost = json_decode($datacost);
 foreach($datacost->{'rajaongkir'}->{'results'} as $key0 => $value0) {
	 $kurir=$value0->{'code'};
	 //echo $kurir." - ";
	 if($tampiljne=='1'){
		if($kurir=='jne'){
		 foreach($value0->{'costs'} as $key1 => $value1) {
				$prop=$value1->{'service'};
				//echo $prop." - ";
				foreach($value1->{'cost'} as $key2 => $value2) {
					$biaya=$value2->{'value'};
					 ?>
					 	<option value="<?php echo  $kurir."-".$prop."-".$biaya; ?>">
					 <?php
							echo strtoupper($kurir)." - ".$prop." - Rp ".number_format($biaya,0,',','.');
					 ?>
	             		</option>
	                <?php
				}
			}
		}else{}
	 }else{}

	 if($tampiltiki=='1'){
		if($kurir=='tiki'){
		 foreach($value0->{'costs'} as $key1 => $value1) {
				$prop=$value1->{'service'};
				//echo $prop." - ";
				foreach($value1->{'cost'} as $key2 => $value2) {
					$biaya=$value2->{'value'};
					 ?>
					 	<option value="<?php echo  $kurir."-".$prop."-".$biaya; ?>">
					 <?php
							echo strtoupper($kurir)." - ".$prop." - Rp ".number_format($biaya,0,',','.');
					 ?>
	             		</option>
	                <?php
				}
			}
		}else{}
	 }else{}

	  if($tampilpos=='1'){
	 	if($kurir=='pos'){
	 	 foreach($value0->{'costs'} as $key1 => $value1) {
	 			$prop=$value1->{'service'};
	 			//echo $prop." - ";
	 			foreach($value1->{'cost'} as $key2 => $value2) {
	 				$biaya=$value2->{'value'};
	 				 ?>
	 				 	<option value="<?php echo  $kurir."-".$prop."-".$biaya; ?>">
	 				 <?php
	 						echo strtoupper($kurir)." - ".$prop." - Rp ".number_format($biaya,0,',','.');
	 				 ?>
	              		</option>
	                 <?php
	 			}
	 		}
	 	}else{}
	  }else{}

	   if($tampiljnt=='1'){
	  	if($kurir=='J&T'){
	  	 foreach($value0->{'costs'} as $key1 => $value1) {
	  			$prop=$value1->{'service'};
	  			//echo $prop." - ";
	  			foreach($value1->{'cost'} as $key2 => $value2) {
	  				$biaya=$value2->{'value'};
	  				 ?>
	  				 	<option value="<?php echo  $kurir."-".$prop."-".$biaya; ?>">
	  				 <?php
	  						echo strtoupper($kurir)." - ".$prop." - Rp ".number_format($biaya,0,',','.');
	  				 ?>
	               		</option>
	                  <?php
	  			}
	  		}
	  	}else{}
	   }else{}
 }

?>
<!-- <option value="lain">Kurir Lainnya</option> -->
</select>
