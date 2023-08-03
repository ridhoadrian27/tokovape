@extends('layouts.admin.layout')
@section('header', 'Track')

@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            {{-- <h3 class="card-title">DataTable with default features</h3> --}}
          </div>
          <!-- /.card-header -->

          <div class="card-body">
            <!-- konten -->
            <?php
							    //waybill
						        $curl = curl_init();

						        curl_setopt_array($curl, array(
						        //   CURLOPT_URL => "https://pro.rajaongkir.com/api/waybill",
						          CURLOPT_URL => "https://rajaongkir.com/api/waybill",
						          CURLOPT_RETURNTRANSFER => true,
						          CURLOPT_ENCODING => "",
						          CURLOPT_MAXREDIRS => 10,
						          CURLOPT_TIMEOUT => 30,
						          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
						          CURLOPT_CUSTOMREQUEST => "POST",
						          CURLOPT_POSTFIELDS => "waybill=".$noresi."&courier=jne",
						          CURLOPT_HTTPHEADER => array(
						            "content-type: application/x-www-form-urlencoded",
						            // "key: e5822eb434b35b2cad87953978dd713c",
						            "key: fa96acfb9e2d219f5f3af16ccbd87454",
						          ),
						        ));

						        $response = curl_exec($curl);
						        $err = curl_error($curl);

						        curl_close($curl);

						        if ($err) {
						          $data_resi = $err;
						        } else {
						          $data_resi = $response;
						        }

						        //echo $data_resi;

						        $dataresi = json_decode($data_resi);
						        //waybill
							?>

							<table class="table table-bordered">
							    <tr>
							        <td style="width: 50%;">No. Resi : </td><td><?php echo $dataresi->{'rajaongkir'}->{'query'}->{'waybill'};?></td>
							    </tr>
							    <tr>
							        <td>Tanggal di Kirim :</td><td><?php echo $dataresi->{'rajaongkir'}->{'result'}->{'summary'}->{'waybill_date'};?></td>
							    </tr>
							    <tr>
							        <td>Service Code :</td><td><?php echo $dataresi->{'rajaongkir'}->{'result'}->{'summary'}->{'service_code'};?></td>
							    </tr>
							    <tr>
							        <td>Status :</td><td><?php echo $dataresi->{'rajaongkir'}->{'result'}->{'summary'}->{'status'};?></td>
							    </tr>
							</table>

							<table class="table table-bordered">
							    <tr>
							        <td style="width: 50%;">Nama Pengirim :</td><td>Nama Penerima :</td>
							    </tr>
							    <tr>
							        <td><?php echo $dataresi->{'rajaongkir'}->{'result'}->{'summary'}->{'shipper_name'};?></td><td><?php echo $dataresi->{'rajaongkir'}->{'result'}->{'summary'}->{'receiver_name'};?></td>
							    </tr>
							    <tr>
							        <td>Kota Pengirim :</td><td>Kota Penerima :</td>
							    </tr>
							    <tr>
							        <td><?php echo $dataresi->{'rajaongkir'}->{'result'}->{'summary'}->{'origin'};?></td><td><?php echo $dataresi->{'rajaongkir'}->{'result'}->{'summary'}->{'destination'};?></td>
							    </tr>
							</table>

							<table class="table table-bordered">
							    <tr>
							        <td style="width: 50%;"><b>Status</b></td>
							        <td><b>Waktu</b></td>
							    </tr>

							  <?php
							      $jumlah = count($dataresi->{'rajaongkir'}->{'result'}->{'manifest'});
							      $jumlah_data = $jumlah-1;
							      for($a=$jumlah_data;$a>=0;$a--) {
							  ?>
							  <tr>
							        <td><?php echo $dataresi->{'rajaongkir'}->{'result'}->{'manifest'}{$a}->{'manifest_description'};?></td>
							        <td><?php echo $dataresi->{'rajaongkir'}->{'result'}->{'manifest'}{$a}->{'manifest_date'}; ?> <?php echo $dataresi->{'rajaongkir'}->{'result'}->{'manifest'}{$a}->{'manifest_time'}; ?></td>
							    </tr>
							  <?php } ?>

							</table>
            <!-- konten -->
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>

@endsection
