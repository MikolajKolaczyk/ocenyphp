<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "university";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Błąd połączenia z bazą danych: " . $conn->connect_error);
}


$sql_courses = "SELECT * FROM Kursy";
$result_courses = $conn->query($sql_courses);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Oceny Studentów</title>
</head>
<body>
    <h2>Oceny Studentów</h2>
    <form action="view_grades.php" method="post">
        Wybierz Kurs:
        <select name="course_id">
            <?php
            while ($row = $result_courses->fetch_assoc()) {
                echo "<option value='" . $row['kurs_id'] . "'>" . $row['nazwa_kursu'] . "</option>";
            }
            ?>
        </select>
        <input type="submit" value="Wyświetl Oceny">
    </form>

    <?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $selected_course_id = $_POST['course_id'];

        $sql_grades = "SELECT Studenci.imię, Studenci.nazwisko, Oceny.ocena
                       FROM Oceny
                       INNER JOIN Studenci ON Oceny.student_id = Studenci.student_id
                       WHERE Oceny.kurs_id = '$selected_course_id'";

        $result_grades = $conn->query($sql_grades);

        if ($result_grades->num_rows > 0) {
            echo "<h3>Oceny dla wybranego kursu:</h3>";
            echo "<table border='1'>
                    <tr>
                        <th>Imię</th>
                        <th>Nazwisko</th>
                        <th>Ocena</th>
                    </tr>";

            while ($row = $result_grades->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row['imię'] . "</td>
                        <td>" . $row['nazwisko'] . "</td>
                        <td>" . $row['ocena'] . "</td>
                      </tr>";
            }

            echo "</table>";
        } else {
            echo "Brak ocen dla wybranego kursu.";
        }
    }

    $conn->close();
    ?>
</body>
</html>
