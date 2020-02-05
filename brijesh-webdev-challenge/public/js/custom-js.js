function checkForm(form){
    form.save.disabled = true;
    form.save.innerHTML = "Saving...";
    return true;
}
