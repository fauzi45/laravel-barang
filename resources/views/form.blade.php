<!-- resources/views/form.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Input</title>
</head>

<body>
    <form action="{{ route('process.form') }}" method="post">
        @csrf
        <br>
        Contoh Format: "Fauzi 22 Depok"
        <br>
        <label for="inputText">Input Text:</label>

        <input type="text" name="inputText" id="inputText" required>
        <button type="submit">Submit</button>
        @error('inputText')
        <div style="color: red;">{{ $message }}</div>
        @enderror
    </form>
</body>

</html>