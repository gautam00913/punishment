import axios from 'axios';
import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

const managmentContent = document.getElementById('management-content');
const toast = document.getElementById('toast');

document.addEventListener('click', (e) => {
    if(e.target.classList.contains('management'))
    {
        const url = e.target.dataset.url
        const loader = document.querySelector('#management-content .loading');
        if(url)
        {
            if(!loader)
            {
                managmentContent.innerHTML = `
                <div class="container loading">
                    <div class="my-20 flex justify-center text-primary hover:text-secondary">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="animate-spin w-6 h-6  mr-3">
                            x<path fill-rule="evenodd" d="M12 5.25c1.213 0 2.415.046 3.605.135a3.256 3.256 0 013.01 3.01c.044.583.077 1.17.1 1.759L17.03 8.47a.75.75 0 10-1.06 1.06l3 3a.75.75 0 001.06 0l3-3a.75.75 0 00-1.06-1.06l-1.752 1.751c-.023-.65-.06-1.296-.108-1.939a4.756 4.756 0 00-4.392-4.392 49.422 49.422 0 00-7.436 0A4.756 4.756 0 003.89 8.282c-.017.224-.033.447-.046.672a.75.75 0 101.497.092c.013-.217.028-.434.044-.651a3.256 3.256 0 013.01-3.01c1.19-.09 2.392-.135 3.605-.135zm-6.97 6.22a.75.75 0 00-1.06 0l-3 3a.75.75 0 101.06 1.06l1.752-1.751c.023.65.06 1.296.108 1.939a4.756 4.756 0 004.392 4.392 49.413 49.413 0 007.436 0 4.756 4.756 0 004.392-4.392c.017-.223.032-.447.046-.672a.75.75 0 00-1.497-.092c-.013.217-.028.434-.044.651a3.256 3.256 0 01-3.01 3.01 47.953 47.953 0 01-7.21 0 3.256 3.256 0 01-3.01-3.01 47.759 47.759 0 01-.1-1.759L6.97 15.53a.75.75 0 001.06-1.06l-3-3z" clip-rule="evenodd" />
                        </svg>
                        
                        Chargement...
                    </div>
                </div>
                `;
            }
            window.dispatchEvent(new CustomEvent('open-modal', {detail: 'management-modal'}))
            axios.get(url)
            .then(response => {
                if(response.data)
                {
                    managmentContent.innerHTML = response.data
                }
            })
            .catch(error => {
                if(error.response.status == 401 || error.response.status == 419)
                {
                    window.location.reload()
                }else{
                    console.log(error)
                }
            })
        }
    }

    if(e.target.id == "processingFormBtn")
    {
        processingForm(e);
    }
})

if(toast)
{
    setTimeout(() => {
        toast.remove()
    }, 5000);
}


const processingForm = (e) =>{
    e.preventDefault();
    const form = e.target.parentElement.parentElement;
    const text = e.target.textContent;
    const spinner = `<div class="flex items-center">
        <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
        En cours ... 
    </div>`
    if (form) {
        e.target.innerHTML = spinner
        e.target.classList.add('cursor-progress')
        const data = new FormData(form)
        axios.post(form.action, data)
        .then(response => {
            if(response.data.success){
                window.location.reload();
            }else{
                console.log(response)
            }
        })
        .catch(error => {
            e.target.innerHTML = text
            e.target.classList.remove('cursor-progress')
            const errors = Object.entries(error.response.data.errors)
            console.log(errors);
                errors.forEach((element) => {
                    const domElement = document.getElementById(element[0]);
                    if (domElement) {
                        const errorParagraph = domElement.nextElementSibling
                        domElement.classList.add('border-red-600')
                        if (errorParagraph) {
                            errorParagraph.innerHTML = element[1][0]
                        }else{
                            domElement.insertAdjacentHTML('afterend', `
                            <p class="text-red-600 italic">${element[1][0]}</p>
                            `)
                        }
                    }
                })
        })
    }
}