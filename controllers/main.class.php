<?php


class NPR_Main {
    public function __construct() {
        $this->Config = array(
            "RootPath" => $_SERVER["DOCUMENT_ROOT"]."/repos/neproebirabotu"
        );
    }

    public function ShowForm() {
        require_once( $this->Config{RootPath} . "/views/form.view.php");
    }

    public function ShowSelectbox($Name, $Values, $CurrentValue = "", $Props = "") {
        $html = "<select name='{$Name}' {$Props}>";
            foreach($Values as $Val => $Label) {
                if($CurrentValue == $Val) $x=" selected";
                else $x="";
                $html.= "<option value='{$Val}'{$x}>{$Label}</option>";
            }
        $html.= "</select>";
        return $html;
    }

    public function CreateCalendar() {
        //$tz = "Europe/Moscow";

        $wdays = array(
            0 => "в воскресенье",
            1 => "в понедельник",
            2 => "во вторник",
            3 => "в среду",
            4 => "в четверг",
            5 => "в пятницу",
            6 => "в субботу",
        );

        $monthId = intval($_POST["Month"]);
        $yearNum = intval($_POST["Year"]);
        $config = array( "unique_id" => "neproebirabotu_calendar",
           // "TZID"      => $tz,
            "directory" => "import",
            "filename" => "cal.ics",
            "NewlineChar" => "\r\n",
        );
        $v = new vcalendar( $config );
        $tz = "Europe/Moscow";
        $v->setProperty( "method", "PUBLISH" );
        $v->setProperty( "x-wr-calname", "Непроебиработу" );
        $v->setProperty( "X-WR-CALDESC", "ICS графика смен" );

        $halfDays = explode(",", $_POST["HalfDay"]);
        $fullDays = explode(",", $_POST["FullDay"]);

        foreach($halfDays as $day) {
            $day = trim(intval($day));

            $tsStart = strtotime("{$day}-{$monthId}-{$yearNum} 9:00:00");
            $tsEnd = $tsStart + 43200;

            $tsFirstAlarm = $tsStart - 129600;
            $tsSecondAlarm = $tsStart - 43200;
            echo date("d.m.Y H:i:s", $tsStart)."<br>";
            if($day > 0 && $day <= 31) {
                $vevent = &$v->newComponent("vevent");

                $vevent->setProperty("dtstart", array("year" => $yearNum
                , "month" => $monthId
                , "day" => $day
                , "hour" => 9
                , "min" => 0
                , "sec" => 0));
                $vevent->setProperty("dtend", array("year" => date("Y", $tsEnd)
                , "month" => date("n", $tsEnd)
                , "day" => date("d", $tsEnd)
                , "hour" => 21
                , "min" => 00
                , "sec" => 0));
                $vevent->setProperty( "summary", "12 часов ".$wdays[date("w",$tsStart)] );
                $vevent->setProperty( "description", "12 часов ".$wdays[date("w",$tsStart)] );

                $valarm = & $vevent->newComponent( "valarm" );
                $valarm->setProperty("action", "DISPLAY" );
                $valarm->setProperty("description", $vevent->getProperty( "description" ));

                $d = sprintf( '%04d%02d%02d %02d%02d%02d',
                    date("Y", $tsFirstAlarm),
                    date("m", $tsFirstAlarm),
                    date("d", $tsFirstAlarm),
                    date("H", $tsFirstAlarm),
                    date("i", $tsFirstAlarm),
                    0 );
                iCalUtilityFunctions::transformDateTime( $d, $tz, "UTC", "Ymd\THis\Z");
                $valarm->setProperty( "trigger", $d );

                $valarm = & $vevent->newComponent( "valarm" );
                $valarm->setProperty("action", "DISPLAY" );
                $valarm->setProperty("description", $vevent->getProperty( "description" ));

                $d = sprintf( '%04d%02d%02d %02d%02d%02d',
                    date("Y", $tsSecondAlarm),
                    date("m", $tsSecondAlarm),
                    date("d", $tsSecondAlarm),
                    date("H", $tsSecondAlarm),
                    date("i", $tsSecondAlarm),
                    0 );
                iCalUtilityFunctions::transformDateTime( $d, $tz, "UTC", "Ymd\THis\Z");
                $valarm->setProperty( "trigger", $d );
            }
        }

        foreach($fullDays as $day) {
            $day = trim(intval($day));

            $tsStart = strtotime("{$day}-{$monthId}-{$yearNum} 9:00:00");
            $tsEnd = $tsStart + 86400;

            $tsFirstAlarm = $tsStart - 129600;
            $tsSecondAlarm = $tsStart - 43200;
            echo date("d.m.Y H:i:s", $tsStart)."<br>";
            if($day > 0 && $day <= 31) {
                $vevent = &$v->newComponent("vevent");

                $vevent->setProperty("dtstart", array("year" => $yearNum
                , "month" => $monthId
                , "day" => $day
                , "hour" => 9
                , "min" => 0
                , "sec" => 0));
                $vevent->setProperty("dtend", array("year" => date("Y", $tsEnd)
                , "month" => date("n", $tsEnd)
                , "day" => date("d", $tsEnd)
                , "hour" => 9
                , "min" => 00
                , "sec" => 0));
                $vevent->setProperty( "summary", "Сутки ".$wdays[date("w",$tsStart)] );
                $vevent->setProperty( "description", "Сутки ".$wdays[date("w",$tsStart)] );

                $valarm = & $vevent->newComponent( "valarm" );
                $valarm->setProperty("action", "DISPLAY" );
                $valarm->setProperty("description", $vevent->getProperty( "description" ));

                $d = sprintf( '%04d%02d%02d %02d%02d%02d',
                    date("Y", $tsFirstAlarm),
                    date("m", $tsFirstAlarm),
                    date("d", $tsFirstAlarm),
                    date("H", $tsFirstAlarm),
                    date("i", $tsFirstAlarm),
                    0 );
                iCalUtilityFunctions::transformDateTime( $d, $tz, "UTC", "Ymd\THis\Z");
                $valarm->setProperty( "trigger", $d );

                $valarm = & $vevent->newComponent( "valarm" );
                $valarm->setProperty("action", "DISPLAY" );
                $valarm->setProperty("description", $vevent->getProperty( "description" ));

                $d = sprintf( '%04d%02d%02d %02d%02d%02d',
                    date("Y", $tsSecondAlarm),
                    date("m", $tsSecondAlarm),
                    date("d", $tsSecondAlarm),
                    date("H", $tsSecondAlarm),
                    date("i", $tsSecondAlarm),
                    0 );
                iCalUtilityFunctions::transformDateTime( $d, $tz, "UTC", "Ymd\THis\Z");
                $valarm->setProperty( "trigger", $d );
            }
        }

        $v->saveCalendar();

        echo "<strong>Всё готово!</strong><p>В течение 15 мин. айфон проверит наличие обновлений в календаре и сам все сделает. Это окно можно смело закрывать.</p>";
    }
}