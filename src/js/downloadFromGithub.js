export function downloadFromGithub(urlRaw, customName = null) {
    // Extraer nombre del archivo si no se proporciona
    const name = customName || urlRaw.split('/').pop();
    
    // Crear enlace de descarga
    const link = document.createElement('a');
    link.href = urlRaw;
    link.download = name
    link.style.display = 'none';
    
    // Descargar
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
    
    console.log(`Descargando: ${name}`);
}

