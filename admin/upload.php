<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $uploadedFile = $_FILES['upload'];
    $uploadDirectory = '../upload_ck/'; // Specify the directory for CKEditor uploads

    // Ensure the directory exists
    if (!file_exists($uploadDirectory)) {
        mkdir($uploadDirectory, 0777, true);
    }

    $targetFile = $uploadDirectory . basename($uploadedFile['name']);
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if the file is an image
    $validExtensions = array('jpeg', 'jpg', 'png', 'gif');
    if (in_array($imageFileType, $validExtensions)) {
        if (move_uploaded_file($uploadedFile['tmp_name'], $targetFile)) {
            $url = 'http://localhost/sharma/upload_ck/' . basename($uploadedFile['name']); // URL for the uploaded image
            $response = [
                'url' => $url,
            ];
            echo json_encode($response);
        } else {
            $response = [
                'error' => [
                    'message' => 'Failed to upload image.',
                ],
            ];
            echo json_encode($response);
        }
    } else {
        $response = [
            'error' => [
                'message' => 'Invalid file format. Allowed formats: jpeg, jpg, png, gif.',
            ],
        ];
        echo json_encode($response);
    }
}
?>
