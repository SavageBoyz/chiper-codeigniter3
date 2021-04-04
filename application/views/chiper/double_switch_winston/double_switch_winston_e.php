<h1>Шифр двойной перестановки Уинстона</h1>
<form action="<?= base_url() ?>Double_switch_winston/encrypt" method="post">
	<div class="inputGroup">
		<label for="msg">Сообщение:</label>
		<input type="text" name="msg" autocomplete="off">
		<br>
		<input class="btn btn-success btn-submit" type="submit" value="Закодировать">
		<textarea class="infoBox" id="infoBox" cols="40" rows="3"><?php
				if(!empty($msg)){
					echo "Сообщение: ";
					echo $msg;
				}
				echo PHP_EOL;
				if(!empty($table_1)) {
					echo "Таблица 1:";
					echo PHP_EOL;
					for ($i = 0; $i < count($table_1[0]);$i++){
						echo "\t".$i.':';
					}
					echo PHP_EOL;
					for ($i = 0; $i < count($table_1); $i++) {
						echo $i.':'."\t";
						for ($j = 0; $j < count($table_1[0]); $j++) {
							echo $table_1[$i][$j]."\t";
						}
						echo PHP_EOL;
					}
				}

				if(!empty($table_2)) {
					echo "Таблица 2:";
					echo PHP_EOL;
					for ($i = 0; $i < count($table_2[0]);$i++){
						echo "\t".$i.':';
					}
					echo PHP_EOL;
					for ($i = 0; $i < count($table_2); $i++) {
						echo $i.':'."\t";
						for ($j = 0; $j < count($table_2[0]); $j++) {
							echo $table_2[$i][$j]."\t";
						}
						echo PHP_EOL;
					}
				}
				echo validation_errors();?></textarea>
	</div>
</form>
