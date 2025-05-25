<?php
require_once('../libs/fpdf/fpdf.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_FILES['archivo']) || $_FILES['archivo']['error'] !== UPLOAD_ERR_OK) {
        http_response_code(400);
        echo "Error al subir el archivo.";
        exit;
    }

    $archivo = $_FILES['archivo']['tmp_name'];
    $tipo = mime_content_type($archivo);

    // Por ejemplo aquí permitimos solo archivos de texto plano (.txt)
    if ($tipo !== 'text/plain') {
        http_response_code(415);
        echo "Solo se permiten archivos de texto plano (.txt).";
        exit;
    }

    $contenido = file_get_contents($archivo);

    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', '', 12);
    $pdf->MultiCell(0, 10, $contenido);

    $pdfdoc = $pdf->Output('', 'S');

    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment; filename="archivo_convertido.pdf"');
    header('Content-Length: ' . strlen($pdfdoc));

    echo $pdfdoc;
    exit;
} else {
    http_response_code(405);
    echo "Método no permitido";
}
?>
