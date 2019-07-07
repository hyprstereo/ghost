<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<style type="text/css">
.table-head {
    color: #FFFFFF;
    background-color: #4A4A4A;
}
</style>
</head>

<body>
<h1><strong>CUSTOMS TARGETING &amp; ANTI CRIME CENTRE
</strong></h1>
<p>&nbsp;</p>
<table width="100%" border="0">
  <tbody>
    <tr>
      <td><p><strong>Negeri/Stesen</strong>: {{ $myCase->station}}</p>
        <p><strong>Nombor Buku Kes / Muka Surat</strong>: {{ $myCase->case_no }} / {{ $myCase->reference }}</p>
        <p><strong>Tarikh Kertas Siasatan</strong>:<br>
          <strong>Dibuka</strong>: {{ $myCase->date }}</p>
      <p></p></td>
    </tr>
    <tr>
      <td><table width="100%" border="0">
        <tbody>
          <tr class="table-head">
            <td><strong>Orang Kena Tuduh</strong></td>
            <td><strong>Keturunan</strong></td>
            <td><strong>Umur</strong></td>
            <td><strong>No KP/Paspot</strong></td>
            <td><strong>Warganegara</strong></td>
            </tr>
@foreach ($myCase->profiles as $profile)
          <tr>
          <td>{{ $profile->name }}</td>
            <td>{{ $profile->race }}</td>
            <td>{{ $profile->age }}</td>
            <td>{{ $profile->identification }}</td>
            <td>{{ $profile->nationality }}</td>
            </tr>
@endforeach
        </tbody>
      </table></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><table width="100%" border="0">
        <tbody>
          <tr>
            <td width="49%">Ketua Pasukan Serbuan: {{ $myCase->raid_leader_id }}</td>
            <td width="51%">Tempat Kesalahan: {{ $myCase->complainer_place_of_offence }}<br>
              Tarikh &amp; Masa: {{ $myCase->complainer_date_time }}<br>
              Pengadu: {{ $myCase->complainer_name }}<br>
              No. Report: {{ $myCase->complainer_report_no }}<br>
              Balai: {{ $myCase->police_station }}<br>
              <!--Tarikh &amp; Masa: xxxx</td>-->
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </tbody>
      </table></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><strong>Kesalahan</strong></td>
    </tr>
    <tr>
      <td>Seksyen/Akta: xxxx<br>
        Perihal Kesalahan: {{ $myCase->offence }}</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><strong>Keputusan Kes:<br>
      </strong>-</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
  </tbody>
</table>
<p>&nbsp;</p>
</body>
</html>
