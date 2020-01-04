<?php
//require('readyqueue.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	
</head>
<body>
	<?php
 
if(isset($_POST['submit'])){
	$quant = $_POST['time'];
	$quantum = (int)$quant;
	$ganttchart = [];
	$readyqueue = [];
	$processes= $_POST['p'];
	$bursttimes= $_POST['b'];
	$bursttimes1= $_POST['b'];
	$colours = $_POST['c'];
	$arrivaltimes= $_POST['a'];
	$arrivaltimes1= $_POST['a'];
	$len = sizeof($processes);
	$time = 0;
	$newtime = 0;
	$timearray=[];
	?>
	Time: <input type="number" name="time" value="<?php echo $quant ?>">
		<table>
			<th>Process Name</th>
			<th>Process Colour</th>
			<th>Burst Time</th>
			<th>Arrival Time</th>
			</tr>
			<tr>
					<td><input type="text" name="p[]" value="P1" ></td>
					<td><input style="background-color: red;" type="text" name="c[]" value="Red" ></td>
					<td><input type="number" name="b[]" id="" value="<?php echo $bursttimes[0] ?>"></td>
					<td><input type="number" name="a[]" id="" value="<?php echo $arrivaltimes[0] ?>"></td>
					
			</tr>
			<tr>
				<td><input type="text" name="p[]" value="P2"></td>
				<td><input style="background-color: yellow;" type="text" name="c[]" value="Yellow" ></td>
				<td><input type="number" name="b[]" id="" value="<?php echo $bursttimes[1] ?>"></td>
				<td><input type="number" name="a[]" id="" value="<?php echo $arrivaltimes[1] ?>"></td>
			</tr>
			<tr>
				<td><input type="text" name="p[]" value="P3"></td>
				<td><input style="background-color: blue;" type="text" name="c[]" value="Blue" ></td>
				<td><input type="number" name="b[]" id="" value="<?php echo $bursttimes[2] ?>"></td>
				<td><input type="number" name="a[]" id="" value="<?php echo $arrivaltimes[2] ?>"></td>
			</tr>
			<tr>
				<td><input type="text" name="p[]" value="P4"></td>
				<td><input style="background-color: green;" type="text" name="c[]" value="Green" ></td>
				<td><input type="number" name="b[]" id="" value="<?php echo $bursttimes[3] ?>"></td>
				<td><input type="number" name="a[]" id="" value="<?php echo $arrivaltimes[3] ?>"></td>
			</tr>
			<tr>
				<td><input type="text" name="p[]" value="P5"></td>
				<td><input style="background-color: orange;" type="text" name="c[]" value="Orange" ></td>
				<td><input type="number" name="b[]" id="" value="<?php echo $bursttimes[4] ?>"></td>
				<td><input type="number" name="a[]" id="" value="<?php echo $arrivaltimes[4] ?>"></td>
			</tr>
		</table>
		<?php
		//print_r($processes);
		if(!empty($arrivaltimes)){
			foreach ($arrivaltimes as $artime) {
				$intartime = (int)$artime;
				if($intartime==0 && !($artime == null)){
					$arkey = array_search($artime, $arrivaltimes);
					$process = $processes[$arkey];
					$readyqueue[] =$process;
					$arrivaltimes[$arkey] = null;

				} 
				
			}
		}
		if (empty($readyqueue)) {
			$ttime=1;
			while (empty($readyqueue)) {
				if(!empty($arrivaltimes)){
					foreach ($arrivaltimes as $artime) {
						$intartime = (int)$artime;
						if($ttime>=$intartime && !($artime == null)){
							$arkey = array_search($artime, $arrivaltimes);
							$process = $processes[$arkey];
							$readyqueue[] =$process;
							$newtime = $ttime;
							$arrivaltimes[$arkey] = null;

						} 
				
					}
				}
				$ttime=$ttime+1;
			}
		}
		//print_r($readyqueue);
		while(true) {
			$p =$readyqueue[0];
			$key = array_search($p, $processes);

			$burst = (int)$bursttimes[$key];
			//var_dump($burst);
			if($burst>0){
				$newburst= $burst-$quantum;	
				if ($newburst<=0) {
					$timearray[] =$newtime;
					$ganttchart[] = $p;
					array_shift($readyqueue);
					$bursttimes[$key]= $newburst;
					$time +=$burst;
					$newtime +=$burst;
					if(!empty($arrivaltimes)){
						foreach ($arrivaltimes as $artime) {
							$intartime = (int)$artime;
							if($time>=$intartime && !($artime == null)){
								$arkey = array_search($artime, $arrivaltimes);
								$process = $processes[$arkey];
								$readyqueue[] =$process;
								$arrivaltimes[$arkey] = null;

							} 
				
						}
					}
					//$samplequeue2 = $readyqueue->get_readyqueue();
					//var_dump($samplequeue2);
				}
				elseif ($newburst>0) {
					$timearray[] =$newtime;
					$ganttchart[] = $p;
					array_shift($readyqueue);
					$bursttimes[$key]= $newburst;
					$time +=$quantum;
					$newtime +=$quantum;
					if(!empty($arrivaltimes)){
						foreach ($arrivaltimes as $artime) {
							$intartime = (int)$artime;
							if($time>=$intartime && !($artime == null)){
								$arkey = array_search($artime, $arrivaltimes);
								$process = $processes[$arkey];
								$readyqueue[] =$process;
								//var_dump($queue);
								//$samplequeue = $readyqueue->get_readyqueue();
								$arrivaltimes[$arkey] = null;
								//var_dump($samplequeue);
					

							} 
				
						}
					}
					$readyqueue[] =$p;
					//$samplequeue1 = $readyqueue->get_readyqueue();
					//var_dump($samplequeue1);
				}

		}
		if(empty($readyqueue)){
			$timearray[] =$newtime;
			break;
		}
	}
	$len = sizeof($timearray);
	$len1 = sizeof($ganttchart);
	$num = $timearray[$len-1];
	$slot = 1;
	$intnum = (int)$timearray[$len-1];
	$i = 1;
	?>

	<table>
		<tr>
			<?php
				$k=0;

				while ( $k< $len1) {
					$y=$k+1;
					$ts= (int)$timearray[$y];
					$pts = (int)$timearray[$k];
					$pro = $ganttchart[$k];
					$index = array_search($pro, $processes);
					$col = $colours[$index];
					$w = 50*($ts-$pts);
					$l = 50*($ts-$pts);
					$wq ="{$w}px";
					$lq ="{$l}px";
					?>

					<td style="border: none; column-width:<?php echo $wq?>"><input style="width: <?php echo $lq?>; border: none; background-color:<?php echo $col ?>;" type="text" name="" value="<?php echo $pro ?>" ></td>

					<?php
					$k=$k+1;
				}
			?>
		</tr>
		<tr>

			<?php
				$k=0;
				$y=1;
				while ( $y<= $len) {
					if ($y==$len) {
						$ts = $quantum;
						
					}
					else{
						$ts= (int)$timearray[$y];
					}					
					$pts = (int)$timearray[$k];
					$w = 50*($ts-$pts);
					$l = 50*($ts-$pts);
					$wq ="{$w}px";
					$lq ="{$l}px";
					?>

					<td style="border: none; column-width:<?php echo $wq?>"><input style="width: <?php echo $lq?>; border: none;" type="text" name="" value="<?php echo $pts ?>" ></td>

					<?php
					$y=$y+1;
					$k=$k+1;

				}
				
			?>
		</tr>
	</table>
	
	<?php
		$len = sizeof($timearray);
		$len1 = sizeof($ganttchart);
		$g = $len1-1;
		$c1 =[];
		$c2 =[];
		$c3 =[];
		$c4 =[];
		$c5 =[];

		while ($g>=0) {
			if ($ganttchart[$g]=="P1") {
				$c1[] = (int)$timearray[$g+1];

			}
			elseif ($ganttchart[$g]=="P2") {
				$c2[] = (int)$timearray[$g+1];

			}
			elseif ($ganttchart[$g]=="P3") {
				$c3[] = (int)$timearray[$g+1];

			}
			elseif ($ganttchart[$g]=="P4") {
				$c4[] = (int)$timearray[$g+1];

			}
			elseif ($ganttchart[$g]=="P5") {
				$c5[] = (int)$timearray[$g+1];

			}
			$g=$g-1;
		}
		$atat=[];
		$awt=[];
		if (!empty($c1)) {
			$ct1 = (int)$c1[0];
			$tat1 = $ct1-(int)$arrivaltimes1[0];
			$atat[] = $tat1;
			$wt1 = $tat1 -(int)$bursttimes1[0];
			$awt[] =$wt1;
			echo "P1<br>  Completion time: {$ct1} <br>  Turnaround time: {$tat1} <br>  Waiting time: {$wt1}";
			?>
			<br>
			<br>
			<?php
		}
		if (!empty($c2)) {
			$ct2 = (int)$c2[0];
			$tat2 = $ct2-(int)$arrivaltimes1[1];
			$atat[] = $tat2;
			$wt2 = $tat2 -(int)$bursttimes1[1];
			$awt[] =$wt2;
			echo "P2<br>  Completion time: {$ct2} <br>  Turnaround time: {$tat2} <br>  Waiting time: {$wt2}";
			?>
			<br>
			<br>
			<?php
		}
		if (!empty($c3)) {
			$ct3 = (int)$c3[0];
			$tat3 = $ct3-(int)$arrivaltimes1[2];
			$atat[] = $tat3;
			$wt3 = $tat3 -(int)$bursttimes1[2];
			$awt[] =$wt3;
			echo "P3<br>  Completion time: {$ct3} <br>  Turnaround time: {$tat3} <br>  Waiting time: {$wt3}";
			?>
			<br>
			<br>
			<?php
		}
		if (!empty($c4)) {
			$ct4 = (int)$c4[0];
			$tat4 = $ct4-(int)$arrivaltimes1[3];
			$atat[] = $tat4;
			$wt4 = $tat4 -(int)$bursttimes1[3];
			$awt[] =$wt4;
			echo "P4<br>  Completion time: {$ct4} <br>  Turnaround time: {$tat4} <br>  Waiting time: {$wt4}";
			?>
			<br>
			<br>
			<?php
		}
		if (!empty($c5)) {
			$ct5 = (int)$c5[0];
			$tat5 = $ct5-(int)$arrivaltimes1[4];
			$atat[] = $tat5;
			$wt5 = $tat5 -(int)$bursttimes1[4];
			$awt[] =$wt5;
			echo "P5<br>  Completion time: {$ct5} <br>  Turnaround time: {$tat5} <br>  Waiting time: {$wt5}";
			?>
			<br>
			<br>
			<?php
		}
		$lenatat = sizeof($atat);
		$lenawt = sizeof($awt);
		$sum0 =0;
		$sum1 =0;
		foreach ($atat as $att) {
				$intatt = (int)$att;
				$sum0 = $sum0+$intatt;
		}
		foreach ($awt as $aww) {
				$intaww = (int)$aww;
				$sum1 = $sum1+$intaww;
		}
		$fatat = $sum0/$lenatat;
		$fawt =  $sum1/$lenawt;
		echo "Average Turnaround Time: {$fatat}<br><br>";
		echo "Average Waiting Time: {$fawt}<br><br>";



}
	
?>
</body>
</html>