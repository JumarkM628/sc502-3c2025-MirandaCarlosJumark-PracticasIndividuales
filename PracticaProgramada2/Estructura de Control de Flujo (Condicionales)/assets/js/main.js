const btnEdad = document.querySelector("#btnEdad");
const estudianteEdad = document.querySelector("#estudianteEdad");
const resultado = document.querySelector("#resultadoEvaluado");

const botonVerificar = () =>{
    btnEdad.addEventListener("click", function(){
        const edad = parseInt(estudianteEdad.value);

        if(edad < 18){
            resultado.textContent = "Eres menor de edad";
        }else{
            resultado.textContent = "Eres mayor de edad";
        }
    });
}






document.addEventListener("DOMContentLoaded", function(){
    console.log("La pagina cargo");
    botonVerificar();  
});