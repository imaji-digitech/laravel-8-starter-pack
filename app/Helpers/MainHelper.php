<?php

if (!function_exists('array_to_object')) {

    /**
     * Convert Array into Object in deep
     *
     * @param array $array
     * @return
     */
    function array_to_object($array)
    {
        return json_decode(json_encode($array));
    }
}
if (!function_exists('eloquent_to_options')) {
    function eloquent_to_options($array, $value, $title)
    {
        $arr = array();
        foreach ($array as $index => $a) {
            $arr[$index]['value'] = $a->$value;
            $arr[$index]['title'] = $a->$title;
        }
        return $arr;
    }
}
if (!function_exists('eloquent_to_chart_time_series')) {
    function eloquent_to_chart_time_series($item)
    {
        $now = 0;
        $new = [];
        foreach ($item as $p) {
            if ($now == 0) {
                $now = $p->month;
            }
            if ($p->month != $now) {
                while ($p->month != $now) {
                    $now++;
                    if ($now != $p->month) {
                        $a['month'] = $now;
                        $a['year'] = $p->year;
                        $a['number'] = 0;
                        array_push($new, $a);
                    }
                    if ($now == $p->month) {
                        $a['month'] = $p->month;
                        $a['year'] = $p->year;
                        $a['number'] = $p->total;
                        array_push($new, $a);
                    }
                }
            } else if ($p->month == $now) {
                $a['month'] = $p->month;
                $a['year'] = $p->year;
                $a['number'] = $p->total;
                array_push($new, $a);
            }

        }
        return $new;
    }
}


if (!function_exists('eloquent_to_multi_chart_time_series')) {
    function eloquent_to_multi_chart_time_series($item,$label)
    {
        $month = date('n');
        $monthOfYear = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];

        $first = array_slice($monthOfYear, $month);
        $last = array_slice($monthOfYear, 0, $month);
        $monthOfYear = array_merge($first, $last);

        $zero = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        $new = [$label,$monthOfYear];
        for ($i = 0; $i < count($item); $i++) {
            array_push($new, $zero);
        }
        foreach ($item as $index => $i) {
            foreach ($i as $j) {
                $new[$index + 2][($j['month'] - $month  + 11) % 12] = $j['number'];
            }
        }
        for ($i = 0; count($monthOfYear)<$i ; $i++){
            for ($j = 2; count($new)<$j ; $j++){

            }
        }
        return $new;
    }
}
if (!function_exists('empty_fallback')) {

    /**
     * Empty data or null data fallback to string -
     *
     * @return string
     */
    function empty_fallback($data)
    {
        return ($data) ? $data : "-";
    }
}

if (!function_exists('create_button')) {

    function create_button($action, $model)
    {
        $action = str_replace($model, "", $action);

        return [
            'submit_text' => ($action == "update") ? "Update" : "Submit",
            'submit_response' => ($action == "update") ? "Updated." : "Submited.",
            'submit_response_notyf' => ($action == "update") ?
                "Data " . $model . " Berhasil di Update" : "Data " . $model . " Berhasil di Tambahkan"
        ];
    }
}
