<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>simplex</title>
    <style>
        p, input {
            font-size: larger;
            display: inline-block;
        }
        form{
            text-align: center;
        }
    </style>
</head>
<body>
<h2>Enter all values in order, separated by "," and without space.</h2>

<form action="./getter.php" method="post">
    <p for="type">question type: </p>
    <select name="type" id="type">
        <option value="min">min</option>
        <option value="max">max</option>
    </select>
    <br>
    <p for="z">Z: </p>
    <input type="text" id="z" name="z">
    <br>
    <p for="a">A: </p>
    <input style="width: 80%;" type="text" id="a" name="a">
    <p>lines with ; separate</p>
    <br>
    <p for="b">b: </p>
    <input type="text" id="b" name="b">
    <br>
    <p for="limitType">limitType: </p>
    <input type="text" id="limitType" name="limitType">
    <p>enter: e, s, b</p>
    <br>
    <button type="submit">Submit</button>
</form>
</body>
</html>