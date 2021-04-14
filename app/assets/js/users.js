const searchBar = () => {
    let search = doc.querySelector('.chatapp--search input')

    let listener = ev => {

        let users = doc.querySelectorAll('.chatapp--userslist > a')
        let value = ev.target.value

        users.forEach( (el, index) => {

            let name = el.querySelector('.chatapp--user h3').innerText
            let re = new RegExp(value)

            if(re.test(name)) 
                el.classList.remove('is--hide')
            else
                el.classList.add('is--hide')

        })
    }

    search.addEventListener('keyup', listener, false)
}

const getUsers = () => {
    fetch('/api/users').then( r => r.text() )
        .then( r => {
            doc.querySelector('#userslist')
                .innerHTML = r
        })
}

const receiverSocket = () => {
    if(/localhost/.test(win.location.host)){
        let conn = new WebSocket('ws://localhost:9980?id='+doc.querySelector('span[data-id]').dataset.id)
    }
    else {
        let conn = new WebSocket('ws://chatapp.erickferreira.ml:9980?id='+doc.querySelector('span[data-id]').dataset.id)
    }
    conn.onmessage = function(e) {
        setInterval(getUsers, 5000);
    }
}

getUsers();
searchBar();
receiverSocket()
