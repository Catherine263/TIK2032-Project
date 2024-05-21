/*----- bagian tombol Navigasi -----*/
const sideButton = document.getElementById('sidebutton');
const menu = document.querySelector('.menu');

sideButton.addEventListener('click', function() {
    sideButton.classList.toggle("fa-xmark");
    menu.classList.toggle('active');
});

/*----- bagian animasi Text -----*/
document.addEventListener('DOMContentLoaded', function() {
    const textElement = document.getElementById('text');
    const texts = [
        "Hi",
        "Hallo",
        "안녕하세요",
        "Bonjour",
        "Hola"
    ];
    let index = 0;
    let charIndex = 0;

    function typeText() {
        const currentText = texts[index];
        textElement.textContent = currentText.substring(0, charIndex + 1);

        if (charIndex < currentText.length) {
            charIndex++;
            setTimeout(typeText, 150);
        } else {
            setTimeout(eraseText, 1500);
        }
    }

    function eraseText() {
        const currentText = texts[index];
        textElement.textContent = currentText.substring(0, charIndex);

        if (charIndex > 0) {
            charIndex--;
            setTimeout(eraseText, 50);
        } else {
            index = (index + 1) % texts.length;
            setTimeout(typeText, 500);
        }
    }

    typeText();
});

/*----- bagian animasi Text -----*/
document.addEventListener('DOMContentLoaded', function() {
    const showAllButtons = document.querySelectorAll('.show-all-button');

    showAllButtons.forEach(button => {
        button.addEventListener('click', function() {
            const blogId = button.dataset.blogId;
            // Redirect ke halaman PHP dengan meneruskan ID blog
            window.location.href = `index.php?id=${blogId}`;
        });
    });
});
