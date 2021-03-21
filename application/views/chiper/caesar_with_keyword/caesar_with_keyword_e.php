<h1>Шифр Цезаря с ключевым словом</h1>
<form action="<?= base_url() ?>Caesar_with_keyword/encrypt" method="post">
    <div class="inputGroup">
        <label for="msg">Сообщение:</label>
        <input type="text" name="msg" autocomplete="off">

        <label for="keyFirst">Число:</label>
        <input type="text" name="num" autocomplete="off">

        <label for="keySecond">Ключ №1:</label>
        <input type="text" name="keyFirst" autocomplete="off">
        <br>
        <input class="btn btn-success btn-submit" type="submit" value="Закодировать">
        <textarea class="infoBox" id="infoBox" cols="40" rows="3"><?= $info; ?><?= validation_errors();?></textarea>
    </div>
</form>
