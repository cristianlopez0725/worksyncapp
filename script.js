document.getElementById('exportar-form').addEventListener('submit', async function(e) {
  e.preventDefault();

  const archivoInput = document.getElementById('archivo');
  const archivo = archivoInput.files[0];

  if (!archivo) {
    alert('Por favor, selecciona un archivo.');
    return;
  }

  const formData = new FormData();
  formData.append('archivo', archivo);

  const mensajeDiv = document.getElementById('mensaje');
  mensajeDiv.textContent = 'Convirtiendo...';

  try {
    const response = await fetch('backend/exportar_pdf.php', {
      method: 'POST',
      body: formData
    });

    if (!response.ok) {
      throw new Error('Error en la conversión.');
    }

    // Recibir el PDF como blob
    const blob = await response.blob();

    // Crear URL para descargar el PDF
    const url = window.URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = 'archivo_convertido.pdf';
    document.body.appendChild(a);
    a.click();

    a.remove();
    window.URL.revokeObjectURL(url);
    mensajeDiv.textContent = 'Archivo convertido con éxito. Descargando...';
  } catch (error) {
    mensajeDiv.textContent = 'Error: ' + error.message;
  }
});
