<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "university";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Błąd połączenia z bazą danych: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id = $_POST['student_id'];
    $course_id = $_POST['course_id'];
    $grade = $_POST['grade'];

    $sql = "INSERT INTO Oceny (student_id, kurs_id, ocena) VALUES ('$student_id', '$course_id', '$grade')";

    if ($conn->query($sql) === TRUE) {
        echo "Ocena dodana pomyślnie.";
    } else {
        echo "Błąd podczas dodawania oceny: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dodaj Oceny</title>
</head>
<body>
    <h2>Dodaj Oceny</h2>
    <form action="add_grade.php" method="post">
        Student ID: <input type="text" name="student_id" required><br>
        Kurs ID: <input type="text" name="course_id" required><br>
        Ocena: <input type="text" name="grade" required><br>
        <input type="submit" value="Dodaj Oceny">
    </form>
</body>
</html>
