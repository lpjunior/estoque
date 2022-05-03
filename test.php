<html>

<body>
    <h1>File Upload Form</h1>

    <form action="#" method="post" enctype="multipart/form-data">
        <input type="file" name="Upload" accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*">
        <input type="submit">
    </form>
</body>

</html>

<?php
if (isset($_FILES['Upload'])) {
    $dir = "./resources/imagens/"; # caminho onde será salvo o arquivo

    $originalFilename = basename($_FILES['Upload']['name']);
    $filename = $dir 
        . sha1(uniqid(mt_rand() + time(), true)) 
        . substr(
            $originalFilename, 
            strpos($originalFilename, '.'), 
            strlen($originalFilename)
        );

    $filenameArray = pathinfo($filename);

    $ext = array("jpeg", "jpg", "gif");
    $isGood = 0;

    if (file_exists($filename)) {
        echo "The file already exists<br>";
        $isGood = 1;
    }

    if ($_FILES['Upload']['size'] > 10000000) { # tamanho em bytes
        echo "File is over 10MB in size<br>";
        $isGood = 1;
    }

    if (!in_array($filenameArray['extension'], $ext)) {
        echo "File Type is not Allowed (Upload jpeg, jpg, gif)<br>";
        $isGood = 1;
    }

    if ($isGood != 1) {
        if (move_uploaded_file($_FILES['Upload']['tmp_name'], $filename)) {
            echo "<p>File was uploaded --> " . $filenameArray["basename"];
        } else {
            echo "Upload failed" . $_FILES['Upload']['name'];
        }
    }
}

?>