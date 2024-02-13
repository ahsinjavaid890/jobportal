<?php

if (!function_exists('renderYearOptions')) {
  function renderYearOptions($old = "")
  {
    $year = date('Y') + 1;
    $a = 0;
    while ($a < 9) {
      $year--;
      $selected = empty($old) ? "" : ($year == $old ? "selected" : "");
      echo '<option ' . $selected . ' value="' . $year . '">' . $year . '</option>';
      $a++;
    }
  }
}

if (!function_exists('renderExperienceOptions')) {
  function renderExperienceOptions($old = "")
  {
    $experience = [
      ["label" => "0 (Fresher)", "value" => 0],
      ["label" => "06 Months", "value" => 6],
      ["label" => "1 Year", "value" => 12],
      ["label" => "1.5 Years", "value" => 18],
      ["label" => "2 Years", "value" => 24],
      ["label" => "2.5 Years", "value" => 30],
      ["label" => "3 Years", "value" => 36],
      ["label" => "3+ Years", "value" => 50],
    ];

    foreach ($experience as $key => $experience) {
      $selected = $experience["value"] == $old ? "selected" : "";
      echo '<option ' . $selected . ' value="' . $experience["value"] . '">' . $experience["label"] . '</option>';
    }
  }
}

if (!function_exists('renderExperience')) {
  function renderExperience($exp)
  {
    $experience = [
      ["label" => "0 (Fresher)", "value" => 0],
      ["label" => "06 Months", "value" => 6],
      ["label" => "1 Year", "value" => 12],
      ["label" => "1.5 Years", "value" => 18],
      ["label" => "2 Years", "value" => 24],
      ["label" => "2.5 Years", "value" => 30],
      ["label" => "3 Years", "value" => 36],
      ["label" => "3+ Years", "value" => 50],
    ];

    $label = "";

    foreach ($experience as $k) {
      if ($k['value'] == $exp) {
        $label = $k['label'];
      }
    }

    return $label;
  }
}

if (!function_exists("is_in_array")) {
  function is_in_array($array, $key, $key_value)
  {
    $within_array = 'no';
    foreach ($array as $k => $v) {
      if (is_array($v)) {
        $within_array = is_in_array($v, $key, $key_value);
        if ($within_array == 'yes') {
          break;
        }
      } else {
        if ($v == $key_value && $k == $key) {
          $within_array = 'yes';
          break;
        }
      }
    }
    return $within_array;
  }
}

if (!function_exists("thousandsCurrencyFormat")) {
  function thousandsCurrencyFormat($num)
  {

    if ($num > 1000) {

      $x = round($num);
      $x_number_format = number_format($x);
      $x_array = explode(',', $x_number_format);
      $x_parts = array('k', 'm', 'b', 't');
      $x_count_parts = count($x_array) - 1;
      $x_display = $x;
      $x_display = $x_array[0] . ((int) $x_array[1][0] !== 0 ? '.' . $x_array[1][0] : '');
      $x_display .= $x_parts[$x_count_parts - 1];

      return $x_display;
    }

    return $num;
  }
}

if (!function_exists('renderJobType')) {
  function renderJobType($type)
  {
    switch ($type) {
      case 1:
        return "Full Time";
      case 2:
        return "Part Time";
      case 3:
        return "Contract";
      case 4:
        return "Internship";
      case 5:
        return "Office";
      default:
        break;
    }
  }
}

if (!function_exists('renderHiringFromArray')) {
  function renderHiringFromArray($array)
  {
    $array = json_decode($array);
    $new_array = [];
    $i = 0;
    while ($i < count($array)) {
      $new_array[] = renderHiring($array[$i]);
      $i++;
    }

    return join(', ', $new_array);
  }
}

if (!function_exists('renderHiring')) {
  function renderHiring($type)
  {
    switch ($type) {
      case 1:
        return 'Face to Face';
      case 2:
        return 'Written Test';
      case 3:
        return 'Telephonic';
      case 4:
        return 'Group Discussion';
      case 5:
        return 'Walk In';
      default:
        break;
    }
  }
}

if (!function_exists('renderGender')) {
  function renderGender($type)
  {
    switch ($type) {
      case 1:
        return 'Male';
      case 2:
        return 'Female';
      case 3:
        return 'Male and Female';
      default:
        break;
    }
  }
}

if (!function_exists('applicationHasUser')) {
  function applicationHasUser($applications, $user_id)
  {
    foreach ($applications as $appl) {
      if ($appl['user_id'] == $user_id) {

        return true;
      }
    }
  }
}

if (!function_exists('renderSkillNames')) {
  function renderNames($collections, $id_array, $search, $seek)
  {
    $new_arr = [];
    foreach ($collections as $collection) {
      if (in_array($collection->$search, $id_array)) {
        $new_arr[] = $collection->$seek;
      }
    }
    return $new_arr;
  }
}
