export function formatFileName(text) {
    return text.replace(/_/g, ' ')
        .toLowerCase()
        .replace(/espanol/g, 'español')
        .replace(/matematica/g, 'matemática')
        .split(' ')
        .map(palabra => palabra.charAt(0).toUpperCase() + palabra.slice(1))
        .join(' ');
}
