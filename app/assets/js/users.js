const searchBar = () => {
    let search = doc.querySelector('.chatapp--search input')
    let users = doc.querySelectorAll('.chatapp--userslist > a')

    let listener = ev => {

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

searchBar();