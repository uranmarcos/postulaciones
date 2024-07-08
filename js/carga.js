const excelInput = document.getElementById("excelInput")
    
excelInput.addEventListener("change", async function(){
    const content = await readXlsxFile(excelInput.files[0])
})