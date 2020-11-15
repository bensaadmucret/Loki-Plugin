document.addEventListener('DOMContentLoaded', function (e) {
    const showAuthBtn = document.getElementById('loki-show-auth-form'),
        authContainer = document.getElementById('loki-auth-container'),
        close = document.getElementById('loki-auth-close');
    
    showAuthBtn.addEventListener('click', () => {
        authContainer.classList.add('show');        
        showAuthBtn.parentElement.classList.add('hide');
    });

    close.addEventListener('click', () => {
        authContainer.classList.remove('show');
        showAuthBtn.parentElement.classList.remove('hide');
    });
});