<h1>Шифр Цезаря с Афинной перестановкой</h1>
<form action="<?= base_url() ?>Caesar_affine/encrypt" method="post">
	<div class="inputGroup">
		<label for="msg">Сообщение:</label>
		<input type="text" name="msg" autocomplete="off">

		<label for="keyFirst">Число №1:</label>
		<input type="text" name="numFirst" autocomplete="off">

		<label for="keySecond">Число №2:</label>
		<input type="text" name="numSecond" autocomplete="off">
		<br>
		<input class="btn btn-success btn-submit" type="submit" value="Закодировать">
		<textarea class="infoBox" id="infoBox" cols="40" rows="3"><?= $info; ?><?= validation_errors();?></textarea>
	</div>
</form>
