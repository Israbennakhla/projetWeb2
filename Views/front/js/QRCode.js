const input = document.querySelector("input");
const qrImage= document.querySelector("img");
const generateBtn= document.querySelector("#generate");

generateBtn.addEventListener("click",()=>{
    const qrCode=`https://api.qrserver.com/v1/create-qr-code/?size=200x200&data= ${}`;
    qrImage.src=qrCode
})