let bddif = document.getElementById("bddif")
let domdif = document.getElementById("domdif")
let newdif = document.getElementById("newdif")
let bandif = document.getElementById("bandif")
let dif = document.getElementById("dif")
domdif.addEventListener("change", () => {
    newdif.value = parseFloat(bddif.value) + parseFloat(domdif.value)
})
bandif.addEventListener("change", () => {
    dif.value = parseFloat(newdif.value) - parseFloat(bandif.value)
})