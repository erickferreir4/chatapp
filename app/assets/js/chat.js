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
    },

    __receiverSocket()
    {
        this.conn.onmessage = function(e) {
            console.log( e.data );
            let msg = e.data

            let span = doc.createElement('span')
            span.classList.add('chatapp--box--wrapper')
            span.classList.add('incoming')
            span.innerHTML = `<p class="chatapp--box--details">${msg}</p>`

            doc.querySelector('#chat-messages').append(span);
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
                //console.log(r)
                msg.innerHTML = r  
            })
    },

    init()
    {
        this.__update();
        this.__sendMessage();
        this.__receiverSocket();
    }
}

Chat.init();

//let sender = doc.querySelector('#form-chat input[name="user-sender"]').value
//let receiver = doc.querySelector('#form-chat input[name="user-receiver"]').value

//var conn = new WebSocket('ws://localhost:9980?id='+sender);
//let form = document.getElementById('form-chat');

//console.log(conn)

//conn.onopen = function(e) {
//    console.log(e)
//}

//form.addEventListener('submit', function (event) {
//    let msg = doc.querySelector('#form-chat input[name="message"]').value
//    event.preventDefault();
//    conn.send(JSON.stringify({'msg': 'test', 'id': receiver}));
//});


//conn.onmessage = function(e) {
//    console.log( e.data );
//}
