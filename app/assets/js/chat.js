const Chat = {

    receiver: doc.querySelector('#form-chat input[name="user-receiver"]').value,
    sender: doc.querySelector('#form-chat input[name="user-sender"]').value,
    //conn: new WebSocket('ws://localhost:9980?id='+this.sender),

    __sendMessage()
    {
        let conn = new WebSocket('ws://localhost:9980?id='+this.sender);
        conn.onmessage = function(e) {
            console.log( e.data );
        }


        let form = doc.querySelector('#form-chat')

        let listener = ev => {
            ev.preventDefault()

            let formData = new FormData(form)

            let req = '/api/send';
            fetch(req, {method: 'POST', body: formData,}).then( r => r.text() )


            let msg = form.querySelector('input[name="message"]').value
            conn.send(JSON.stringify({'msg': msg, 'id': this.receiver}));


            form.reset();
        }

        form.addEventListener('submit', listener, false)
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
                console.log(r)
                msg.innerHTML = r  
            })
    },

    init()
    {
        this.__update();
        this.__sendMessage();
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
