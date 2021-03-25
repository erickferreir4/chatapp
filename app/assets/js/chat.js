const Chat = {


    __sendMessage()
    {
        let form = doc.querySelector('#form-chat')

        let listener = ev => {
            ev.preventDefault()

            let formData = new FormData(form)

            let req = '/api/chat';

            fetch(req, {method: 'POST', body: formData,}).then( r => r.text() )
            .then( r => {
                console.log(r)


                //if(r !== 'success') {
                //    error.innerText = r
                //    error.classList.add('is--active')
                //}
                //else {
                //    error.classList.remove('is--active')
                //    window.location.href = '/users';
                //}
            })

        }

        form.addEventListener('submit', listener, false)
    },








    init()
    {
        this.__sendMessage();
    }
}

Chat.init();
