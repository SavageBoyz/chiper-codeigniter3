<h1>Шифр двойной перестановки</h1>
<form action="<?= base_url() ?>Double_switch/encrypt" method="post">
    <div class="inputGroup">
        <label for="msg">Сообщение:</label>
        <input type="text" name="msg">

        <label for="keyFirst">Ключ №1:</label>
        <input type="text" name="keyFirst">

        <label for="keySecond">Ключ №2:</label>
        <input type="text" name="keySecond">
        <br>
        <input class="btn btn-success btn-submit" type="submit" value="Закодировать">
        <textarea class="infoBox" id="infoBox" cols="40" rows="3"><?= $info; ?><?= validation_errors();?></textarea>
    </div>
</form>
