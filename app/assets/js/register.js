const Register = {

    __form()
    {
        let form = doc.querySelector('#form-register')

        let listener = ev => {
            ev.preventDefault()

            let formData = new FormData(form)

            fetch('/api/register', {
                method: 'POST',
                body: formData,
            })
            .then( r => r.json() )
            .then( r => {
                console.log(r)
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
