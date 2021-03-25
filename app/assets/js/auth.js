const Auth = {
    __form()
    {
        let form = doc.querySelector('#form-auth')

        let listener = ev => {
            ev.preventDefault()

            let formData = new FormData(form)
            let error  = doc.querySelector('.error-txt')

            let url = window.location.pathname === '/login' ? '/api/login' : '/api/register'

            fetch(url, {method: 'POST', body: formData,}).then( r => r.text() )
            .then( r => {
                console.log(r)
                if(r !== 'success') {
                    error.innerText = r
                    error.classList.add('is--active')
                }
                else {
                    error.classList.remove('is--active')
                    window.location.href = '/users';
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

Auth.init();
