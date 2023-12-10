const deleteBtns = document.querySelectorAll(".delete")
const checkItems = document.querySelectorAll(".check")
const completeLink = document.querySelector('.complete')
const incompleteTask = document.querySelector('.incomplete')
const allTask = document.querySelector('.allTask')
const feedback = document.querySelector('.feedback')

deleteBtns.forEach((trash)=>{
    trash.addEventListener('click',()=>{
        const id = trash.attributes.id.value
        window.location.replace(`../controllers/deleteTask.php?taskId=${id}`)
    })
})

checkItems.forEach((item)=>{
    item.addEventListener('click',(e)=>{
        const id = item.attributes.id.value
        window.location.replace(`../controllers/completeTask.php?taskId=${id}`)
    })
})

completeLink.addEventListener('click',()=>{
    window.location.replace(`../view/index.php?query=completedTask`)
})
incompleteTask.addEventListener('click',()=>{
    window.location.replace(`../view/index.php?query=incompletedTask`)
})
allTask.addEventListener('click',()=>{
    window.location.replace(`../view/index.php?query=all`)
})
feedback.addEventListener('click',()=>{
    window.location.replace(`https://www.instagram.com/jey_fason/?hl=en`)
})