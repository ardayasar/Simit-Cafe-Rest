<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/form.css">
    <title>Simit Cafe & Restaurant</title>
</head>
<body>

    <form action="surveyS.php" method="post">
        <img src="./assets/img/logo.png" width="250px" style="margin-bottom: -40px;">
        <input type="text" name="na_su" placeholder="Name - Surname">
        <input type="email" name="mail" placeholder="E-mail">
        <label for="service">How was your service experience?</label>
        <select name="service">
            <option value="5">Good</option>
            <option value="3">Normal</option>
            <option value="1">Bad</option>
        </select>
        <textarea name="idea" placeholder="Do you want to tell something?"></textarea>
        <button type="submit">Send</button>
    </form>
    
</body>
</html>