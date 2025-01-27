<?php
require "../../backend/controller/fileController.php";

$fileController = new FileController();
$imagesList = $fileController->GetAllImages();
// var_dump($imagesList);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload de Imagem</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #f7f7f7, #e8e8e8);
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            min-height: 100vh;
        }

        .upload-form {
            background: #fff;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
            margin-top: 2rem;
            width: 320px;
        }

        .upload-form h1 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
            color: #333;
        }

        .upload-form label {
            font-size: 1rem;
            font-weight: bold;
            color: #555;
            display: block;
            margin-bottom: 0.5rem;
        }

        .upload-form input[type="file"] {
            margin-bottom: 1rem;
            padding: 0.5rem;
            border: 1px solid #ccc;
            border-radius: 6px;
            width: 100%;
            cursor: pointer;
        }

        .upload-form button {
            background-color: #4caf50;
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 6px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .upload-form button:hover {
            background-color: #45a049;
        }

        .images-container {
            margin-top: 2rem;
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            justify-content: center;
        }

        .images-container img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .images-container img:hover {
            transform: scale(1.1);
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>

<body>
    <form class="upload-form" action="../../backend/router/fileRouter.php?acao=SalvarImagem" method="post" enctype="multipart/form-data">
        <h1>Upload de Imagem</h1>
        <label for="image">Selecione uma imagem:</label>
        <input type="file" name="image" id="image" required>
        <button type="submit">Fazer Upload</button>
    </form>

    <div class="images-container">
        <?php
        foreach ($imagesList as $item) {
        ?>
            <img src="../../public/uploads/<?php echo $item['fileName']; ?>" alt="Imagem carregada">
        <?php
        }
        ?>
    </div>
</body>

</html>
