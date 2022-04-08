// delete confirmation
function confirmDelete() {
    return confirm('Are you sure you want to delete this item?')
}

// toggle password input on register form
function showHidePassword(txt, img) {
    let password = document.getElementById(txt)
    let icon = document.getElementById(img)

    // if input type is password(hidden), change to text(visible) and toggle icon
    if (password.type == 'password') {
        password.type = 'text'
        icon.src = 'img/hide.png'
    }
    else {
        password.type = 'password'
        icon.src = 'img/show.png'
    }
}
// compare the password and confirm password
function comparePasswords() {
    let password = document.getElementById('password').value
    let confirm = document.getElementById('confirm').value

    if (password == confirm){
        return true
    }
    else{
        alert('Passwords do not match')
        return false
    }
}