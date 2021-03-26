const Chat = {


    __sendMessage()
    {
        let form = doc.querySelector('#form-chat')

        let listener = ev => {
            ev.preventDefault()

            let formData = new FormData(form)
            form.reset();

            let req = '/api/send';

            fetch(req, {method: 'POST', body: formData,}).then( r => r.text() )
        }

        form.addEventListener('submit', listener, false)
    },


    __update()
    {
        let sender = doc.querySelector('#form-chat input[name="user-sender"]').value
        let receiver = doc.querySelector('#form-chat input[name="user-receiver"]').value

        let msg = doc.querySelector('#chat-messages');

        let formData = new FormData()
        formData.append('user-sender', sender)
        formData.append('user-receiver', receiver)

        let req = '/api/messages';

        fetch(req, {method: 'POST', body: formData,}).then( r => r.text() )
            .then( r => {
                console.log(r)
                msg.innerHTML = r  
            })
    },


    init()
    {
        this.__sendMessage();
        this.__update();
        //setInterval(Chat.__getMessage, 3000)
    }
}

Chat.init();
