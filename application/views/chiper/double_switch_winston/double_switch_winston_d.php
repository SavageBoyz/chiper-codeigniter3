<h1>Шифр двойной перестановки Уинстона</h1>
<form action="<?= base_url() ?>Double_switch_winston/decode" method="post">
	<div class="inputGroup">
		<label for="msg">Сообщение:</label>
		<input type="text" name="msg" autocomplete="off">

		<label for="keyFirst">Таблица 1:</label>

		<div class="tableOne">
			<input  class="inputCell" type="text" name="first_field_0_0" autocomplete="off" placeholder="0__0">
			<input  class="inputCell" type="text" name="first_field_0_1" autocomplete="off" placeholder="0__1">
			<input  class="inputCell" type="text" name="first_field_0_2" autocomplete="off" placeholder="0__2">
			<input  class="inputCell" type="text" name="first_field_0_3" autocomplete="off" placeholder="0__3">
			<input  class="inputCell" type="text" name="first_field_0_4" autocomplete="off" placeholder="0__4">

			<input  class="inputCell" type="text" name="first_field_1_0" autocomplete="off" placeholder="1__0">
			<input  class="inputCell" type="text" name="first_field_1_1" autocomplete="off" placeholder="1__1">
			<input  class="inputCell" type="text" name="first_field_1_2" autocomplete="off" placeholder="1__2">
			<input  class="inputCell" type="text" name="first_field_1_3" autocomplete="off" placeholder="1__3">
			<input  class="inputCell" type="text" name="first_field_1_4" autocomplete="off" placeholder="1__4">

			<input  class="inputCell" type="text" name="first_field_2_0" autocomplete="off" placeholder="2__0">
			<input  class="inputCell" type="text" name="first_field_2_1" autocomplete="off" placeholder="2__1">
			<input  class="inputCell" type="text" name="first_field_2_2" autocomplete="off" placeholder="2__2">
			<input  class="inputCell" type="text" name="first_field_2_3" autocomplete="off" placeholder="2__3">
			<input  class="inputCell" type="text" name="first_field_2_4" autocomplete="off" placeholder="2__4">

			<input  class="inputCell" type="text" name="first_field_3_0" autocomplete="off" placeholder="3__0">
			<input  class="inputCell" type="text" name="first_field_3_1" autocomplete="off" placeholder="3__1">
			<input  class="inputCell" type="text" name="first_field_3_2" autocomplete="off" placeholder="3__2">
			<input  class="inputCell" type="text" name="first_field_3_3" autocomplete="off" placeholder="3__3">
			<input  class="inputCell" type="text" name="first_field_3_4" autocomplete="off" placeholder="3__4">

			<input  class="inputCell" type="text" name="first_field_4_0" autocomplete="off" placeholder="4__0">
			<input  class="inputCell" type="text" name="first_field_4_1" autocomplete="off" placeholder="4__1">
			<input  class="inputCell" type="text" name="first_field_4_2" autocomplete="off" placeholder="4__2">
			<input  class="inputCell" type="text" name="first_field_4_3" autocomplete="off" placeholder="4__3">
			<input  class="inputCell" type="text" name="first_field_4_4" autocomplete="off" placeholder="4__4">

			<input  class="inputCell" type="text" name="first_field_5_0" autocomplete="off" placeholder="5__0">
			<input  class="inputCell" type="text" name="first_field_5_1" autocomplete="off" placeholder="5__1">
			<input  class="inputCell" type="text" name="first_field_5_2" autocomplete="off" placeholder="5__2">
			<input  class="inputCell" type="text" name="first_field_5_3" autocomplete="off" placeholder="5__3">
			<input  class="inputCell" type="text" name="first_field_5_4" autocomplete="off" placeholder="5__4">

			<input  class="inputCell" type="text" name="first_field_6_0" autocomplete="off" placeholder="6__0">
			<input  class="inputCell" type="text" name="first_field_6_1" autocomplete="off" placeholder="6__1">
			<input  class="inputCell" type="text" name="first_field_6_2" autocomplete="off" placeholder="6__2">
			<input  class="inputCell" type="text" name="first_field_6_3" autocomplete="off" placeholder="6__3">
			<input  class="inputCell" type="text" name="first_field_6_4" autocomplete="off" placeholder="6__4">
		</div>

		<label for="keySecond">Таблица 2:</label>
		<div class="tableOne">
			<input  class="inputCell" type="text" name="second_field_0_0" autocomplete="off" placeholder="0__0">
			<input  class="inputCell" type="text" name="second_field_0_1" autocomplete="off" placeholder="0__1">
			<input  class="inputCell" type="text" name="second_field_0_2" autocomplete="off" placeholder="0__2">
			<input  class="inputCell" type="text" name="second_field_0_3" autocomplete="off" placeholder="0__3">
			<input  class="inputCell" type="text" name="second_field_0_4" autocomplete="off" placeholder="0__4">

			<input  class="inputCell" type="text" name="second_field_1_0" autocomplete="off" placeholder="1__0">
			<input  class="inputCell" type="text" name="second_field_1_1" autocomplete="off" placeholder="1__1">
			<input  class="inputCell" type="text" name="second_field_1_2" autocomplete="off" placeholder="1__2">
			<input  class="inputCell" type="text" name="second_field_1_3" autocomplete="off" placeholder="1__3">
			<input  class="inputCell" type="text" name="second_field_1_4" autocomplete="off" placeholder="1__4">

			<input  class="inputCell" type="text" name="second_field_2_0" autocomplete="off" placeholder="2__0">
			<input  class="inputCell" type="text" name="second_field_2_1" autocomplete="off" placeholder="2__1">
			<input  class="inputCell" type="text" name="second_field_2_2" autocomplete="off" placeholder="2__2">
			<input  class="inputCell" type="text" name="second_field_2_3" autocomplete="off" placeholder="2__3">
			<input  class="inputCell" type="text" name="second_field_2_4" autocomplete="off" placeholder="2__4">

			<input  class="inputCell" type="text" name="second_field_3_0" autocomplete="off" placeholder="3__0">
			<input  class="inputCell" type="text" name="second_field_3_1" autocomplete="off" placeholder="3__1">
			<input  class="inputCell" type="text" name="second_field_3_2" autocomplete="off" placeholder="3__2">
			<input  class="inputCell" type="text" name="second_field_3_3" autocomplete="off" placeholder="3__3">
			<input  class="inputCell" type="text" name="second_field_3_4" autocomplete="off" placeholder="3__4">

			<input  class="inputCell" type="text" name="second_field_4_0" autocomplete="off" placeholder="4__0">
			<input  class="inputCell" type="text" name="second_field_4_1" autocomplete="off" placeholder="4__1">
			<input  class="inputCell" type="text" name="second_field_4_2" autocomplete="off" placeholder="4__2">
			<input  class="inputCell" type="text" name="second_field_4_3" autocomplete="off" placeholder="4__3">
			<input  class="inputCell" type="text" name="second_field_4_4" autocomplete="off" placeholder="4__4">

			<input  class="inputCell" type="text" name="second_field_5_0" autocomplete="off" placeholder="5__0">
			<input  class="inputCell" type="text" name="second_field_5_1" autocomplete="off" placeholder="5__1">
			<input  class="inputCell" type="text" name="second_field_5_2" autocomplete="off" placeholder="5__2">
			<input  class="inputCell" type="text" name="second_field_5_3" autocomplete="off" placeholder="5__3">
			<input  class="inputCell" type="text" name="second_field_5_4" autocomplete="off" placeholder="5__4">

			<input  class="inputCell" type="text" name="second_field_6_0" autocomplete="off" placeholder="6__0">
			<input  class="inputCell" type="text" name="second_field_6_1" autocomplete="off" placeholder="6__1">
			<input  class="inputCell" type="text" name="second_field_6_2" autocomplete="off" placeholder="6__2">
			<input  class="inputCell" type="text" name="second_field_6_3" autocomplete="off" placeholder="6__3">
			<input  class="inputCell" type="text" name="second_field_6_4" autocomplete="off" placeholder="6__4">
		</div>
		<br>
		<input class="btn btn-primary btn-submit" type="submit" value="Дешифровать">
		<textarea class="infoBox" id="infoBox" cols="40" rows="3"><?= $msg; ?><?= validation_errors(); ?></textarea>
	</div>
</form>
