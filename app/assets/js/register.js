const Register = {

    __form()
    {
        let form = doc.querySelector('#form-register')

        let listener = ev => {
            ev.preventDefault()

            let formData = new FormData(form)
            let error  = doc.querySelector('.error-txt')

            fetch('/api/register', {
                method: 'POST',
                body: formData,
            })
            .then( r => r.text() )
            .then( r => {
                if(r !== 'success') {
                    error.innerText = r
                    error.classList.add('is--active')
                }
                else {
                    error.classList.remove('is--active')
                }
            })

        }

        form.addEventListener('submit', listener, false)
    },





    init()
    {
        this.__form()
    }
}

Register.init();
