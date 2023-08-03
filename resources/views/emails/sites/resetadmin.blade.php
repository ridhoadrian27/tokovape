@slot('header')
    @component('mail::header', ['url' => config('app.url')])
        {{ config('app.name') }}
    @endcomponent
@endslot

@component('mail::message')
# Reset Password

<!-- konten -->
<?php
  $get_member = DB::table('users')->where('email', $email)->first();
  $value = $get_member->value;
?>
Anda telah berhasil melakukan reset password, berikut informasi mengenai akun Anda setelah kami reset : <br><br>
<table style="font-family:arial;">
<tr style="padding:3px;"><td>Email</td><td>:</td><td><?php echo $email;?></td></tr>
<tr style="padding:3px;"><td>Password</td><td>:</td><td><?php echo $value;?></td></tr>
</table><br>

<!-- konten -->

{{-- @component('mail::button', ['url' => ''])
Button Text
@endcomponent --}}

Thanks,<br>
@endcomponent
