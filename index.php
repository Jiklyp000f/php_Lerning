<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Php_Learning</title>
  </head>
  <body>
    <?php
    // Отправляем cookie
    setcookie("cookie[three]", "Я первый куки");
    setcookie("cookie[two]", "А я второй");
    setcookie("cookie[one]", "Буду третьим");

    // Выведем cookie после перезагрузки страницы
    if (isset($_COOKIE['cookie'])) {
        foreach ($_COOKIE['cookie'] as $name => $value) {
            $name = htmlspecialchars($name);
            $value = htmlspecialchars($value);
        
            echo "$name : $value <br />\n" . "<br>";
        }
    }
    
    ?>
    <form method="POST">
      <label for="var1">Variable 1:</label>
      <input type="text" name="var1" value="">
      <br>
      <label for="var2">Variable 2:</label>
      <input type="text" name="var2" value="">
      <br>
      <input type="submit" value="Calculate">
    </form>

    <?php
    
    // Подключаем файл с классом Calculate
    require 'class_calculate.php';

    // Проверяем, были ли отправлены данные
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Получаем значения переменных из формы и приводим их к числовому типу
        $var1 = isset($_REQUEST['var1']) ? floatval($_REQUEST['var1']) : 0;
        $var2 = isset($_REQUEST['var2']) ? floatval($_REQUEST['var2']) : 0;

        // Создаем объект класса Calculate
        $calc = new Calculate();

        // Выводим результаты вычислений
        echo "Sum: " . $calc->sum($var1, $var2) . "<br>";
        echo "Difference: " . $calc->sub($var1, $var2) . "<br>";
        echo "Multiplication: " . $calc->mul($var1, $var2) . "<br>";
        echo "Division: " . ($var2 != 0 ? $calc->div($var1, $var2) : "Cannot divide by zero") . "<br>";
    }
    ?>
  </body>
</html>
