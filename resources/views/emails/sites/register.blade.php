@component('mail::message')
# Detail Register

<!-- konten -->
<?php
  $get_member = DB::table('member')->where('email', $email)->first();
  $name = $get_member->name;
  $telepon = $get_member->telepon;
  $email = $get_member->email;
  $value = $get_member->value;
?>
Anda telah berhasil melakukan pendaftaran di parfumnaelcole, berikut informasi mengenai akun Anda : <br><br>
<table style="font-family:arial;">
  <tr style="padding:3px;"><td>Nama</td><td>:</td><td><?php echo $name;?></td></tr>
  <tr style="padding:3px;"><td>Telepon</td><td>:</td><td><?php echo $telepon;?></td></tr>
<tr style="padding:3px;"><td>Email</td><td>:</td><td><?php echo $email;?></td></tr>
<tr style="padding:3px;"><td>Password</td><td>:</td><td><?php echo $value;?></td></tr>
</table><br>
<!-- konten -->

{{-- @component('mail::button', ['url' => ''])
Button Text
@endcomponent --}}

Thanks,<br>
{{-- {{ config('app.name') }} --}}
@endcomponent
