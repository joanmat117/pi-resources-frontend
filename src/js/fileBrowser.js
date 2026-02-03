import { formatFileName } from "./formatFileName.js";
import {formatBytes} from './formatBytes.js'
import { downloadFromGithub } from "./downloadFromGithub.js";
/**
 * Crea un navegador de archivos interactivo
 * @param {Array} filesData - Array de archivos desde PHP
 * @param {string} containerId - ID del contenedor HTML
 * @returns {Object} API pública del navegador
 */
export function createFileBrowser(filesData, containerId,goBackBtnId,breadCrumbId) {
    let currentPath = "";
    let processedFiles = [];
    
    const container = document.getElementById(containerId);
    const goBackBtn = document.getElementById(goBackBtnId)
    const breadcrumb = document.getElementById(breadCrumbId);
    
    function processFiles() {
      const seen = new Set();
      const cFiles = []
      
      filesData.forEach(file => {
            if (currentPath && !file.path.startsWith(currentPath)) {
                return false;
            }
            
            const relative = currentPath 
                ? file.path.replace(currentPath, "") 
                : file.path;
            const clean = relative.replace(/^\//, "");
            const name = clean.split("/")[0];
            const ext = name.split('.')[1]
            
            if (seen.has(name)) return ;
            seen.add(name);
            
            cFiles.push({
                ...file,
                display_name: name,
                is_folder: file.type === "tree",
                full_relative_path: clean,
                ext
            })
      })
      return cFiles
    }
    function navigateToFolder(folderName) {
        currentPath = currentPath 
            ? `${currentPath}${folderName}/` 
            : `${folderName}/`;
        
        updateView();
      console.log('Current Path change: ',currentPath)
    }
    
    // Volver atrás
    function goBack() {
        if (!currentPath) return;
        
        const parts = currentPath.split("/")

      if(parts[parts.length-1]) parts.pop() 
      else parts.splice(-2)

        currentPath = parts.length > 0 
            ? parts.join("/") + "/" 
            : ""
        
        updateView();
    }
    
    // Actualizar vista completa
    function updateView() {
        // Actualizar archivos procesados
        processedFiles = processFiles();
        
        // Actualizar breadcrumb
        updateBreadcrumb();
        
        // Actualizar lista de archivos
        renderFiles();
    }
    
    // Renderizar breadcrumb
  function updateBreadcrumb() {
        const Separator = '<i class="bi bi-slash-lg text-gray-400"></i>'

        const parts = currentPath.split("/").filter(p => p);
        const items = [
            `<span class="cursor-pointer hover:underline" onclick="window.fileBrowser.goHome()">
          Inicio
          </span>
          ${Separator}
          `
        ];
        
        let accumulatedPath = "";
        parts.forEach((part, index) => {
            accumulatedPath += part + "/";
            const isLast = index === parts.length - 1;
            
            if (!isLast) {
                items.push(`<span  class="cursor-pointer hover:underline" 
                    onclick="window.fileBrowser.navigateToPath('${accumulatedPath}')">
                    ${formatFileName(part)}
                </span>`);
            } else {
                items.push(`<span class="font-semibold">${formatFileName(part)}</span>`);
            }
            
            items.push(Separator);
        });
        
        breadcrumb.innerHTML = `<div class="flex items-center gap-1">${items.join('')}</div>`;
    }
    
    // Renderizar archivos
    function renderFiles() {

        goBackBtn.innerHTML = `<button id=\"files-go-back\" class=\"${!currentPath && 'hidden'} flex gap-2 items-center justify-center text-sm p-1 rounded-xl px-2 cursor-pointer\">
        <i class=\"bi bi-caret-left-fill\"></i>
        <p class=\"text-md font-semibold\">
          Regresar
        </p>
      </button>
        `

        container.innerHTML = processedFiles.map(file => `
            <div class="file-card group animate-pulse-fade-in duration-100 transition-all relative my-2 p-2 flex flex-col w-full items-center justify-start 
                border border-foreground/20 rounded-xl transition-all duration-200 
                hover:border-primary cursor-pointer"
          ${file.is_folder ? '' : 
            `download 
            href="https://raw.githubusercontent.com/joanmat117/pruebas-de-ingreso-recursos/main/${file.path}" ` }
                onclick="window.fileBrowser.handleFileClick(event, '${file.display_name}', ${file.is_folder} , '${file.path}')">
                
          ${file.is_folder 
              ? 
              `<div class="text-4xl mb-2 transition-transform">
                  <i class="bi bi-folder-fill text-primary"></i> 
              </div>` 
              : 
            `
              <div class="flex flex-col mb-auto gap-1 items-center rounded-xl justify-center p-4 bg-primary text-white w-full transition-all active:scale-80">
              <i class="bi bi-arrow-down-circle-fill text-3xl"></i>
              <h2 class="text-center text-md leading-6 font-medium">
                ${formatFileName(file.display_name)}
              </h2>
              </div>
            `
              }
                
                <div class="text-center">
                  ${file.is_folder ? `<h3 class="font-semibold text-foreground capitalize">
                        ${formatFileName(file.display_name)}
                    </h3>` : ''
                    }
                  <div class="flex gap-2 items-start pt-1 justify-center">
                    ${
                      file.size ? `<div class="mt-1 rounded-full text-sm px-2  text-primary font-semibold">
                        ${formatBytes(file.size)}
                      </div>` : ''
                    }
                    ${
                      file.ext ? `<div class="mt-1 rounded-lg text-sm px-2 border-2 text-primary font-semibold bg-primary/10 border-primary uppercase">
                        ${file.ext}
                      </div>` : ''
                    }
                  </div>
                </div>
                
                ${file.is_folder 
                    ? `<div class="absolute top-2 right-2 text-primary opacity-0 group-hover:opacity-100 transition-opacity">
                        <i class="bi bi-chevron-right"></i>
                       </div>`
                    : ''
                }
            </div>
        `).join('');
    }
    
    const api = {
        navigateToFolder,
        goBack,
        goHome: () => {
            currentPath = "";
            updateView();
        },
        navigateToPath: (path) => {
            currentPath = path;
            updateView();
        },
        handleFileClick: (event, fileName, isFolder,path) => {
            event.stopPropagation();
            if (isFolder) {
                navigateToFolder(fileName);
            } else {
                downloadFromGithub(`https://raw.githubusercontent.com/joanmat117/pruebas-de-ingreso-recursos/main/${path}`)
                console.log("Archivo seleccionado:", fileName);
                // Aquí puedes implementar acción para archivo
            }
        },
        getCurrentPath: () => currentPath,
        getFiles: () => processedFiles
    };
    
    // Inicializar
    updateView();
    
    // Exportar a window
    window.fileBrowser = api;
    
    return api;
}
