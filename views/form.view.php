<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Neproebirabotu</title>
        <meta name='yandex-verification' content='413e83c573c121cd'/>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    </head>
    <style>
        * {
            font-family: "Helvetica", "Arial", sans-serif;
        }

        div, p, td {
            font-size: 12pt;
        }

        li {
            margin-bottom: 8px;
        }
    </style>
    <body>
        <h1>Непроебиработу
            <span style="font-size: 14px; color:#666">rev 1 (03/18/2015)</span>
        </h1>
        <table style="width: 100%">
            <tr>
                <td style="width: 50%; vertical-align: top">
                    <form action="" method="post" enctype="multipart/form-data">
                        <h3>Загрузить данные</h3>
                        О каком месяце идёт речь?
                        <p>
                        <?php
                        $currentMonth = date("n", time());
                        echo NPR_Main::ShowSelectbox("Month",
                            array(
                                1 => "Январь",
                                2 => "Февраль",
                                3 => "Март",
                                4 => "Апрель",
                                5 => "Май",
                                6 => "Июнь",
                                7 => "Июль",
                                8 => "Август",
                                9 => "Сентябрь",
                               10 => "Октябрь",
                               11 => "Ноябрь",
                               12 => "Декабрь"
                            ),
                            $currentMonth,
                            " style='width: 150px'>"
                            )."&nbsp;";
                        echo NPR_Main::ShowSelectbox("Year",
                            array(
                                2015 => 2015,
                                2016 => 2016,
                                2017 => 2017
                            ),
                            2015);
                        ?>
                        </p>
                        Ок, теперь нужно вписать через запятую числа смен в соответствующие поля:
                        <p>
                            <span style="display: inline-block; width: 75px">12 ч. — </span><input type="text" name="HalfDay" style="width: 300px" value="<?=$_POST["HalfDay"];?>" placeholder="например: 1, 5, 14, 22" />
                        </p>
                        <p>
                            <span style="display: inline-block; width: 75px">Сутки — </span><input type="text" name="FullDay" style="width: 300px" value="<?=$_POST["FullDay"];?>" placeholder="и тут также" />
                        </p>
                        <hr>
                        <input type="submit" value="Я всё правильно сделал, стартуем!" name="submit">
                    </form>
                </td>
                <td style="width: 50%; vertical-align: top">
                    <h3>Как этим пользоваться?</h3>
                        Всё почти очевидно, надо только не затупить:
                        <ul>
                            <li>
                                В форме слева надо выбрать правильный месяц (не текущий, а который в графике), а затем ввести в соответствующие поля даты смен, через запятую. Наличие пробелов не критично, главное — это должно быть цифры, разделенные запятыми.
                            </li>
                            <li>Чудо-система секунды 2-3 будет думать что со всем этим делать и тут ХУЯК — и всё. Готово. Обновления появятся на всех устройствах, подписанных на календарь, в течение 15 минут.</li>
                        </ul>
                    </small>
                    <center>
                        <a href="http://www.youtube.com/watch?v=mVTY_8YntgI" target="_blank">
                            <img src="static/clever-cat-400x300.jpg" />
                        </a>
                    </center>
                    <h3>In case of emergency</h3>
                    <small>
                        Всякие мелкие хуйнюшки, на которые не стоит нажимать без повода:
                        <ul>
                            <li>
                                <a href="index.php?do=cleanup">Очистить календарь полностью</a> —
                                на эту ссылку нужно нажать, если что-то пошло не так и события в календаре размножились или повторяются. Ну или если ты перепутал месяц и всё добавилось не туда. Ну, короче, эта ссылка очищает календарь смен в твоём айфоне к хуям.
                            </li>
                            <li>
                                <a href="mailto:spetrenko@me.com?subject=Это просто пиздец">Жилетка</a> — в неё можно выплакаться, если всё пошло ну совсем не так.
                            </li>
                        </ul>
                    </small>
                </td>
            </tr>
        </table>
    </body>
</html>