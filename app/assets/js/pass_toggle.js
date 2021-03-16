const passToggle = () => {
    let eye = doc.querySelector('form .fa-eye')

    let listener = ev => {
        let input = ev.target.previousElementSibling

        ev.target.classList.toggle('is--active')

        if(input.type === 'password')
            input.setAttribute('type', 'text')
        else
            input.setAttribute('type', 'password')
    }

    eye.addEventListener('click', listener, false)
}

passToggle();
