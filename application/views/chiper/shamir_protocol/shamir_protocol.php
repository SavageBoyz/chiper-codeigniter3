<h1>Протокол Шамира</h1>
<form action="<?= base_url() ?>Shamir_protocol/encrypt" method="post">
	<div class="inputGroup">
		<input class="btn btn-primary btn-submit" type="submit" value="Запустить">
		<textarea class="infoBox" id="infoBox" cols="40" rows="3"><?= $info; ?></textarea>
	</div>
</form>
