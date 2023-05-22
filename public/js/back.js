document.addEventListener('DOMContentLoaded', function () {

    const btn = document.querySelector('.back')

    btn.onclick = () => {
        window.history.back()
    }
})
