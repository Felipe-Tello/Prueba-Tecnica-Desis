const form = document.querySelector('form');
const contacto = form.elements['contacto[]'];

form.addEventListener('submit', (event) => {
    const checkedCount = Array.from(contacto).filter((checkbox) => checkbox.checked).length;
    if (checkedCount < 2) {
    event.preventDefault();
    document.getElementById('contacto-error').style.display = 'block';
    }
});