
</script>

<?php
$date=date("Y-m-d");
$durasi=6;
$next=mktime(0,0,0,date("m")+$durasi,date("d"),date("Y"));
echo $date."<br>";
echo "next date ".date("Y-m-d",$next);
?>