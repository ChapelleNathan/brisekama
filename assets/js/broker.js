let options = document.querySelectorAll('option');
options.forEach(option => {
    option.addEventListener('click', log);
});

function log() {
    console.log('click');
}