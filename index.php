<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Php_Learning</title>
</head>
<body>
    <?php
    // Подключаем файл с классом Calculate
    require_once 'class_calculate.php';

    // Получаем значения переменных из формы или из cookies
    $var1 = isset($_POST['var1']) ? floatval($_POST['var1']) : (isset($_COOKIE['var1']) ? floatval($_COOKIE['var1']) : '');
    $var2 = isset($_POST['var2']) ? floatval($_POST['var2']) : (isset($_COOKIE['var2']) ? floatval($_COOKIE['var2']) : '');

    // Если данные пришли из формы, сохраняем их в cookies
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        setcookie("var1", $var1, time() + 3600); // Срок действия: 1 час
        setcookie("var2", $var2, time() + 3600);
    }
    ?>

    <!-- Форма для ввода значений -->
    <form method="POST">
        <label for="var1">Variable 1:</label>
        <input type="text" name="var1" value="<?= htmlspecialchars($var1) ?>">
        <br>
        <label for="var2">Variable 2:</label>
        <input type="text" name="var2" value="<?= htmlspecialchars($var2) ?>">
        <br>
        <input type="submit" value="Calculate">
    </form>

    <?php
    // Если данные пришли из формы, выполняем вычисления
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $calc = new Calculate();

        // Выводим результаты вычислений
        echo "Sum: " . $calc->sum($var1, $var2) . "<br>";
        echo "Difference: " . $calc->sub($var1, $var2) . "<br>";
        echo "Multiplication: " . $calc->mul($var1, $var2) . "<br>";
        echo "Division: " . ($var2 != 0 ? $calc->div($var1, $var2) : "Cannot divide by zero") . "<br>";

        // Вызываем метод __invoke
        $calc($var1, $var2);
    }
    //Вывод куки
    if (!empty($_COOKIE)) {
      echo "<h3>Cookies:</h3>";
      foreach ($_COOKIE as $name => $value) {
          echo htmlspecialchars($name) . ": ";
          
          // Если значение массива, выведем его содержимое
          if (is_array($value)) {
              echo "<pre>" . htmlspecialchars(print_r($value, true)) . "</pre>";
          } else {
              echo htmlspecialchars($value);
          }
  
          echo "<br>";
      }
  }
  
    ?>
</body>
</html>
