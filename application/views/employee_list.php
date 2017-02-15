<table border="1" width="200">
<tbody>
<tr>
<td>Employee Name</td>
<td>Employee Phone</td>
<td>Employee Address</td>
</tr>
<?php
foreach($all_employees as $row)
{ ?>
<tr>
<td>echo $row->name</td>
<td>echo $row->phone</td>
<td>echo $row->address</td>
</tr>
<?php } ?>
</tbody>
</table>