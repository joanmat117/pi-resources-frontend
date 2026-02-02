import {createFileBrowser} from "./fileBrowser.js"

document.addEventListener('DOMContentLoaded', function() {
    console.log('Inicializando navegador de archivos...');

    console.log(window.filesData)
    // Verificar que tenemos datos
    if (!window.filesData) {
        console.error('No se encontraron datos de archivos');
        document.getElementById('files-container').innerHTML = `
            <div class="col-span-full text-center text-red-600 p-8">
                <i class="bi bi-exclamation-triangle text-4xl mb-4"></i>
                <p class="text-xl font-semibold">Error al cargar los archivos</p>
            </div>
        `;
        return;
    }
    
    // Inicializar el navegador
    const fileBrowser = createFileBrowser(
        window.filesData, 
        'files-container'
    );
    
    if (window.initialPath) {
        fileBrowser.navigateToPath(window.initialPath);
    }

    const goBackBtn = document.getElementById('files-go-back')
  if(goBackBtn) goBackBtn.addEventListener('click',()=>{
    console.log('goback')
    fileBrowser.goBack()
  })
    
    // Configurar eventos globales
    setupEventListeners(fileBrowser);
    
    // Log para desarrollo
    console.log('Navegador de archivos inicializado');
    console.log('Archivos totales:', window.filesData.length);
    console.log('API disponible en: window.fileBrowser');
});

   
/**
 * Configura event listeners globales
 */
function setupEventListeners(fileBrowser) {
    // Evento para teclado
    document.addEventListener('keydown', function(e) {
        // Escape para limpiar búsqueda
        if (e.key === 'Escape') {
            const searchInput = document.getElementById('file-search');
            if (searchInput && searchInput.value) {
                searchInput.value = '';
                fileBrowser.reset();
            }
        }
        
        // Backspace para retroceder (si no estamos en un input)
        if (e.key === 'Backspace' && !e.target.matches('input, textarea')) {
            e.preventDefault();
            fileBrowser.goBack();
        }
    });
    
    // Escuchar actualizaciones del navegador
    window.addEventListener('fileBrowser:updated', function(e) {
        console.log('Navegador actualizado:', e.detail);
        updateWindowTitle(e.detail.currentPath);
    });
    
    // Escuchar selección de archivos
    window.addEventListener('fileBrowser:fileSelected', function(e) {
        console.log('Archivo seleccionado:', e.detail);
        // Aquí puedes manejar la selección de archivos
    });
}

/**
 * Actualiza el título de la ventana con la ruta actual
 */
function updateWindowTitle(currentPath) {
    const baseTitle = 'Navegador de Archivos';
    if (!currentPath) {
        document.title = baseTitle;
    } else {
        const folderName = currentPath.split('/').filter(p => p).pop() || '';
        document.title = `${folderName} | ${baseTitle}`;
    }
}
