<h1>Шифр двойной перестановки</h1>
<form action="<?= base_url() ?>Double_switch/decode" method="post">
    <div class="inputGroup">
        <label for="msg">Сообщение:</label>
        <input type="text" name="msg" autocomplete="off">

        <label for="keyFirst">Ключ №1:</label>
        <input type="text" name="keyFirst" autocomplete="off">

        <label for="keySecond">Ключ №2:</label>
        <input type="text" name="keySecond" autocomplete="off">
        <br>
        <input class="btn btn-primary btn-submit" type="submit" value="Дешифровать">
        <textarea class="infoBox" id="infoBox" cols="40" rows="3"><?= $info; ?><?= validation_errors();?></textarea>
    </div>
</form>
