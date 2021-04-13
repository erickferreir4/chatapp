const Chat = {

    receiver: doc.querySelector('#form-chat input[name="user-receiver"]').value,
    sender: doc.querySelector('#form-chat input[name="user-sender"]').value,
    conn: new WebSocket('ws://localhost:9980?id='+doc.querySelector('#form-chat input[name="user-sender"]').value),

    __sendMessage()
    {
        let form = doc.querySelector('#form-chat')

        let listener = ev => {
            ev.preventDefault()

            let formData = new FormData(form)

            let req = '/api/send';
            fetch(req, {method: 'POST', body: formData,}).then( r => r.text() )


            let msg = form.querySelector('input[name="message"]').value
            this.__senderSocket(msg);

            form.reset();
        }

        form.addEventListener('submit', listener, false)
    },

    __senderSocket(msg)
    {
        this.conn.send(JSON.stringify({'msg': msg, 'id': this.receiver}));

        let span = doc.createElement('span')
        span.classList.add('chatapp--box--wrapper')
        span.classList.add('outgoing')
        span.innerHTML = `<p class="chatapp--box--details">${msg}</p>`

        doc.querySelector('#chat-messages').append(span);
        Chat.updateScroll();
    },

    __receiverSocket()
    {
        this.conn.onmessage = function(e) {
            //console.log( e.data );
            let msg = e.data

            let span = doc.createElement('span')
            span.classList.add('chatapp--box--wrapper')
            span.classList.add('incoming')

            let img = doc.querySelector('#img-src img').getAttribute('data-src')
            span.innerHTML = `<img src="${img}"/><p class="chatapp--box--details">${msg}</p>`

            doc.querySelector('#chat-messages').append(span);

            Chat.updateScroll();
        }
    },

    __update()
    {
        let msg = doc.querySelector('#chat-messages');

        let formData = new FormData()
        formData.append('user-sender', this.sender)
        formData.append('user-receiver', this.receiver)

        let req = '/api/messages';

        fetch(req, {method: 'POST', body: formData,}).then( r => r.text() )
            .then( r => {
                msg.innerHTML = r  
            })
    },


    updateScroll(){
        let msg = doc.querySelector('#chat-messages')

        msg.classList.add('is--message')
        setTimeout(() => {msg.classList.remove('is--message')}, 2000)
    },


    init()
    {
        this.__update();
        this.__sendMessage();
        this.__receiverSocket();
        this.updateScroll();
    }
}

Chat.init();
